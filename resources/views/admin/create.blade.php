@extends('layouts.master')

@section('title', 'Create Admin')

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
                    <div class="card-header">Add admin</div>
                    <div class="card-body">
                      <form method="POST" action="/admin/store">
                      @csrf
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" id="email" type="email" name="admin_email" placeholder="Enter your email">
                      </div>
                      <div class="card-footer">
                        <button class="btn btn-sm btn-primary" type="submit">Submit</button>
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