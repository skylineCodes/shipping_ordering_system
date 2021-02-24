@extends('layouts.master')

@section('title', 'All Customers')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="c-body">
        <main class="c-main">
          <div class="container-fluid">
            <div class="fade-in">
              <div class="row">
                <h1>Customer Order</h1>
                <div class="col-md-4">
                @foreach ($customer->orders as $order)
                  <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                          <label class="col-md-4 col-form-label">Item Name</label>
                          <div class="col-md-8">
                            <div>{{ $order->item_name }}</div>
                          </div>
                        </div>
                          <div class="form-group row">
                            <label for="col-md-3 col-form-label">Item Description</label>
                            <div class="col-md-9">
                                <p>{{ $order->item_description }}</p>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="col-md-3 col-form-label">Transport mode</label>
                            <div class="col-md-9">
                                <p>{{ $order->transport_mode }}</p>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="col-md-3 col-form-label">Item Weight</label>
                            <div class="col-md-9">
                                <p>{{ $order->item_weight }} kg</p>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="col-md-3 col-form-label">Country of origin</label>
                            <div class="col-md-9">
                                <p>{{ $order->country_of_origin }}</p>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="col-md-3 col-form-label">Email</label>
                            <div class="col-md-9">
                                <p id="email">{{ $order->customer->email }}</p>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="col-md-3 col-form-label">Shipping Cost</label>
                            <div class="col-md-9">
                                <p>{{ $order->shipping_cost }}</p>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="col-md-3 col-form-label">Custom Tax</label>
                            <div class="col-md-9">
                                <p>{{ $order->custom_tax }}</p>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="col-md-3 col-form-label">Total Cost</label>
                            <div class="col-md-9">
                                <p id="total_cost">{{ $order->total }}</p>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="col-md-3 col-form-label">Payment Status</label>
                            @if($order->is_paid)
                            <div class="col-md-9">
                                <p>Paid</p>
                            </div>
                            @else
                            <div class="col-md-9">
                                <p>Not Paid</p>
                            </div>
                            @endif
                          </div>
                    </div>
                  </div>
                @endforeach
                </div>
              </div>
            </div>
          </div>
        </main>
        </div>
    </div>
  </div>
</div>

@endSection