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
                <h1>All Customers</h1>
                <div class="col-md-4">
                @foreach ($customers as $customer)
                  <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h4>{{ $customer->email }}</h4>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('customer.order', ['id' => $customer->id]) }}">View Orders</a>
                            </div>
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