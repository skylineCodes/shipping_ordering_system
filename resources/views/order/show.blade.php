@extends('layouts.master')

@section('title', 'Create Order')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="c-body">
        <main class="c-main">
          <div class="container-fluid">
            <div class="fade-in">
              <div class="row">
                <div class="col-md-8 mx-auto">
                  <div class="card" id="paymentForm">
                      <div class="card-header">Order details</div>
                      <div class="card-body">
                          <div class="form-group">
                            <label for="item_name">Item Name</label>
                            <div>{{ $order->item_name }}</div>
                          </div>
                          <hr>
                          <div class="form-group">
                            <label for="item_description">Item Description</label>
                            <p>{{ $order->item_description }}</p>
                          </div>
                          <hr>
                          <div class="form-group">
                            <label for="transport_mode">Transport mode</label>
                            <p>{{ $order->transport_mode }}</p>
                          </div>
                          <hr>
                          <div class="form-group">
                            <label for="item_weight">Item Weight</label>
                            <p>{{ $order->item_weight }} kg</p>
                          </div>
                          <hr>
                          <div class="form-group">
                            <label for="country_of_origin">Country of origin</label>
                            <p>{{ $order->country_of_origin }}</p>
                          </div>
                          <hr>
                          <div class="form-group">
                            <label for="email">Email</label>
                            <p id="email">{{ $order->customer->email }}</p>
                          </div>
                          <hr>
                          <div class="form-group">
                            <label for="shipping_cost">Shipping Cost</label>
                            <p>{{ $order->shipping_cost }}</p>
                          </div>
                          <hr>
                          <div class="form-group">
                            <label for="custom_tax">Custom Tax</label>
                            <p>{{ $order->custom_tax }}</p>
                          </div>
                          <hr>
                          <div class="form-group">
                            <label for="total">Total Cost</label>
                            <p id="total_cost">{{ $order->total }}</p>
                          </div>
                          <hr>
                          <div class="form-group">
                            <label for="is_paid">Payment Status</label>
                            @if($order->is_paid)
                                <p>Paid</p>
                            @else
                                <p>Not Paid</p>
                            @endif
                          </div>
                          @if(!$order->is_paid)
                                <div class="card-footer">
                                    <button class="btn btn-md btn-block btn-primary" type="submit" onclick="payWithPaystack()"> Pay</button>
                                </div>
                           @endif
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
  </div>
</div>

<script  type="text/javascript">
    const order = {!! json_encode($order->toArray()) !!};
    const token = {!! json_encode(csrf_token()) !!};

    const paymentForm = document.getElementById('paymentForm');
    paymentForm.addEventListener("submit", payWithPaystack, false);
    
    function payWithPaystack() {
        let handler = PaystackPop.setup({
            key: 'pk_test_bf426612b7117fa918e8424eb7d31a7b9b1ea8fc',
            email: document.getElementById("email").textContent,
            amount: document.getElementById("total_cost").textContent * 100,

            onClose: function(){
                alert('Something went wrong.');
            },

            callback: function(response){
                let message = 'Payment complete! Reference: ' + response.reference;
                $.ajax({
                    url: `/order/${order.id}`,
                    type: 'PATCH',
                    data: {
                        reference: response.reference,
                        _token: token
                    },
                    success: function(response){
                        // console.log(response);
                    },
                });

                alert(message);
                window.location.reload();
            }
        });

        handler.openIframe();
    }
</script>
@endSection