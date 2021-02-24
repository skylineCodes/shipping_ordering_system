<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Mail\SendMailAdmin;
use App\Models\Customer;
use App\Models\Order;
use App\Utils\Utils;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    protected $customer;

    protected $order;

    protected $utils;

    public function __construct(Order $order, Customer $customer, Utils $utils)
    {
        $this->order = $order;

        $this->customer = $customer;

        $this->utils = $utils;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
        // Validate Input
        $validator = validator($request->all(), [
            'item_name' => 'required|string',
            'item_description' => 'required|string',
            'transport_mode' => 'required|string',
            'item_weight' => 'required|integer',
            'country_of_origin' => 'required|string',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return $this->respondWithErrorMessage($validator);
        }

        // Find customer by email or create if not available
        $customer = $this->customer->firstOrCreate(
            [ 'email' => $request->email ]
        );

        // Get transport mode cost
        $transport_mode = $request->transport_mode === 'air' ? 50000 : 15000;

        // Calculate transport mode fee per kilogram
        $cost_per_transport_mode = $request->transport_mode === 'air' ? 10000 : 2000;

        // Calculate item cost per kilo and transport mode
        $item_cost_per_kilo = $request->item_weight * $cost_per_transport_mode;

        // Per country cost
        $per_country_cost = $request->country_of_origin === 'us' ? 1500 : 800;

        // Shipping cost
        $shipping_cost = $this->utils->shipping_cost($transport_mode, $item_cost_per_kilo, $per_country_cost);

        // Custom tax
        $custom_tax = $this->utils->custom_tax($shipping_cost);

        // Total cost
        $total = $this->utils->total();

        // Save to database
        $order = $this->order->create([
            'item_name' => $request->item_name,
            'item_description' => $request->item_description,
            'transport_mode' => $request->transport_mode,
            'item_weight' => $request->item_weight,
            'country_of_origin' => $request->country_of_origin,
            'customer_id' => $customer->id,
            'custom_tax' => $custom_tax,
            'shipping_cost' => $shipping_cost,
            'total' => $total
        ]);
        
        // Redirect to single page to view item
        return redirect('/order/' . $order->id);
        } catch (Exception $e) {
            Log::emergency("File: " . $e->getFile() . PHP_EOL .
                "Line: " . $e->getLine() . PHP_EOL .
                "Message: " . $e->getMessage());

            $output = ['success' => 0,
                                'msg' => __("messages.something_went_wrong")
                            ];
            return redirect('order')->with('status', $output);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = $this->order->where('id', $id)->first();

        return view('order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function update_price(Request $request, $id)
    {
        $order = $this->order->where('id', $id)->first();

        if (request()->ajax()) {
            $order->reference_no = $request->reference;
            $order->is_paid = true;

            $order->save();

            // Send email to customer
            Mail::to($order->customer->email)->send(new SendMail());

            // Send email to admin
            $admin = $this->customer->where('is_admin', true)->first();

            Mail::to($admin->email)->send(new SendMailAdmin());
        }

        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
