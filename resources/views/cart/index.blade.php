@extends('layouts.master')

@section('title', 'Your Cart')

@section('main-content')

  <!-- cart + summary -->
<section class="bg-light my-5">
    <div class="container">
      <div class="row">
        <!-- cart -->
        <div class="col-lg-9">
          <div class="panel panel-default">
            <div class="panel-body">
              <h4 class="panel-title mb-4">Your shopping cart</h4>

              <!-- Loop through cart items -->
              @foreach($cartItems as $item)
              <div class="row mb-4">
                <div class="col-lg-5 ">
                  <div class="media">
                    <div class="media-left">
                      <img src="{{ asset('/front/img/' . ($item->image ?? 'default.png')) }}" class="media-object img-thumbnail" style="width: 96px; height: 96px;" alt="{{ $item->name }}" />
                    </div>
                    <div class="media-body">
                      <h4 class="media-heading"><a href="#">{{ $item->name_en }}</a></h4>
                      <p class="text-muted">{{ $item->description }}</p>
                    </div>
                  </div>
                  @if($item->selected_variations)
                  <ul>
                      @foreach($item->selected_variations as $variation)
                          <li>
                              <strong>{{ $variation['variaion_name'] }}:</strong> {{ $variation['option_name'] }}
                          </li>
                      @endforeach
                  </ul>
              @else
                  <p>No variations selected for this item.</p>
              @endif

                </div>
              
              
               
                <div class="col-lg-2 col-sm-6 col-6">
                  <!-- Quantity Form -->
                  <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline-flex">
                      @csrf
                      @method('PATCH')
              
                      <div class="qty-label">
                          Qty
                          <div class="input-number">
                              <!-- Quantity Input -->
                              <input type="number" name="quantity" id="quantity-{{ $item->id }}" value="{{ $item->pivot->quantity }}" min="1" readonly>
                              
                              <!-- Increase Button -->
                              <span class="qty-up">+</span>
              
                              <!-- Decrease Button -->
                              <span class="qty-down">-</span>
                          </div>
                      </div>
              
                      <!-- Price Information -->
                      <h5 id="total-price-{{ $item->id }}" class="mt-2">${{ number_format($item->price * $item->pivot->quantity, 2) }}</h5>
              
                      <!-- Explicit "Update Cart" Button -->
                      <button type="submit" class="btn btn-primary ml-2">Update Cart</button>
                  </form>
              </div>
              
                <div class="col-lg-2 col-sm-6 text-center">
                  <!-- Remove Button -->
                  <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                  </form>
                </div>
              </div>
              @endforeach
              <!-- End Loop -->
            </div>

          </div>
        </div>
        <!-- cart -->

        <div class="col-lg-3">
          <div class="panel panel-default">
              <div class="panel-body">
                  <form action="{{ route('cart.applyCoupon') }}" method="POST">
                      @csrf
                      <div class="form-group">
                          <label>Have a coupon?</label>
                          <div class="input-group">
                              <input type="text" name="coupon_code" class="form-control" placeholder="Enter coupon code" required>
                              <span class="input-group-btn">
                                  <button type="submit" class="btn btn-primary">Apply</button>
                              </span>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      
          <!-- Summary -->
          <div class="panel panel-default">
              <div class="panel-body">
                  <div class="d-flex justify-content-between">
                      <p>Total price:</p>
                      <p>${{ number_format($cartItems->sum(fn($item) => $item->price * $item->pivot->quantity), 2) }}</p>
                  </div>
                  <div class="d-flex justify-content-between">
                      <p>Discount:</p>
                      <p class="text-success">
                          <!-- Check if a discount exists -->
                          - ${{ session('discount', 0) }}
                      </p>
                  </div>
                  <div class="d-flex justify-content-between">
                      <p>Total after discount:</p>
                      <p class="fw-bold">${{ number_format($cartItems->sum(fn($item) => $item->price * $item->pivot->quantity) - session('discount', 0), 2) }}</p>
                  </div>
      
                  <div class="mt-3">
                      <a href="{{ route('cart.checkout') }}" class="btn btn-success btn-block">Checkout</a>
                  </div>
              </div>
          </div>
      </div>
      


      </div>
    </div>
  </section>
  <!-- cart + summary -->

@endsection

