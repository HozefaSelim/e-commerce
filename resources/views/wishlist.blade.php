@extends('layouts.master')

@section('title', 'Your Wishlist')

@section('main-content')
    <h1 style="text-align: center;  margin-bottom: 3rem;">Your Wishlist</h1>

   <div class="container">
    <div class="row">
        @if ($wishlist->count() > 0)
        @foreach ($wishlist as $product)
        <div class="col-md-4 col-xs-6">
            <div class="product">
                <div class="product-img">
                    <img src="{{ asset('front/img') }}/product01.png" alt="">
                    <div class="product-label">
                        <span class="sale">-30%</span>
                        <span class="new">NEW</span>
                    </div>
                </div>
                <div class="product-body">
                    <p class="product-category">{{ $product->category->name }}</p>
                    <h3 class="product-name"><a href="#">{{ $product->name }}</a></h3>
                    <h4 class="product-price"> {{ $product->price }}<del class="product-old-price">{{ $product->price  + 30}}</del></h4>
                    <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <div class="product-btns">
                        <form action="{{ route('wishlist.remove', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" style="background-color: #ff5c5c; color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 5px; cursor: pointer; font-size: 1rem;">Remove from Wishlist</button>
                        </form>
                      
                        <a  href="{{ route('products.show', $product->id) }}" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Show Details</span></a>
                    </div>
                </div>
                <div class="add-to-cart">
                    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                </div>
            </div>
        </div>
        @endforeach
        @else
            <h4 class="text-center">There isn't any favorite product</h4>
    @endif
    </div>
   </div>
@endsection
