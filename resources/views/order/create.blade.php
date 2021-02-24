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
                  <div class="card">
                    <div class="card-header">Order form</div>
                    <div class="card-body">
                      <form method="POST" action="/order/store">
                      @csrf
                      <div class="form-group">
                        <label for="item_name">Item Name</label>
                        <input class="form-control" id="item_name" type="text" name="item_name" placeholder="Item Name">
                      </div>
                      <div class="form-group">
                        <label for="item_description">Item Description</label>
                        <input class="form-control" id="item_description" type="text" name="item_description" placeholder="Item description">
                      </div>
                      <div class="form-group">
                          <label for="transport_mode">Mode of transport</label>
                            <select class="form-control" id="select1" name="transport_mode">
                              <option value="0" selected>Please select</option>
                              <option value="air">Air - NGN 50k</option>
                              <option value="sea">Sea - NGN 15k</option>
                            </select>
                        </div>
                      <div class="form-group">
                        <label for="item_weight">Item Weight (kg)</label>
                        <input class="form-control" id="item_weight" type="number" name="item_weight" placeholder="Item weight">
                      </div>
                      <div class="form-group">
                        <label for="country">Country of origin</label>
                            <select class="form-control" id="select1" name="country_of_origin">
                              <option value="0" selected>Please select</option>
                              <option value="us">US - NGN 1,500</option>
                              <option value="uk">UK - NGN 800</option>
                            </select>
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" id="email" type="email" name="email" placeholder="Enter your email">
                      </div>
                      <div class="card-footer">
                        <button class="btn btn-sm btn-primary" type="submit"> Submit</button>
                      </div>
                      </form>
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

@endSection