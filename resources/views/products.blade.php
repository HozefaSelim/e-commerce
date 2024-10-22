@extends('layouts.master')

@section('title','Products Page')
@section('prodcuts_active','active')
@section('main-content')
	<!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                
                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <form method="GET" action="{{ route('products.index') }}">
                        <!-- aside Widget -->
                        <div class="aside">
                            <h3 class="aside-title">Categories</h3>
                            @foreach ($categories as $category)
                            <div class="checkbox-filter">
                                <div class="input-checkbox">
                                    <input type="checkbox" id="category-{{ $category->id }}" name="categories[]" value="{{ $category->id }}" {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}>
                                    <label for="category-{{ $category->id }}">
                                        <span></span>
                                        {{ $category->name }}
                                        <small>{{ $category->products_count }} </small>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- /aside Widget -->

                        <!-- aside Widget -->
                        <div class="aside">
                            <h3 class="aside-title">Price</h3>
                            <div class="price-filter">
                                <div id="price-slider"></div>
                                <div class="input-number price-min">
                                    <input id="price-min" type="number" name="price_min" value="{{ request('price_min', 0) }}">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                                <span>-</span>
                                <div class="input-number price-max">
                                    <input id="price-max" type="number" name="price_max" value="{{ request('price_max', 1000) }}">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- /aside Widget -->

                        <!-- aside Widget -->
                        <div class="aside">
                            <h3 class="aside-title">Brand</h3>
                            <div class="checkbox-filter">
                                <div class="input-checkbox">
                                    <input type="checkbox" id="brand-1" name="brands[]" value="SAMSUNG">
                                    <label for="brand-1">
                                        <span></span>
                                        SAMSUNG
                                        <small>(578)</small>
                                    </label>
                                </div>
                                <div class="input-checkbox">
                                    <input type="checkbox" id="brand-2" name="brands[]" value="LG">
                                    <label for="brand-2">
                                        <span></span>
                                        LG
                                        <small>(125)</small>
                                    </label>
                                </div>
                                <div class="input-checkbox">
                                    <input type="checkbox" id="brand-3" name="brands[]" value="SONY">
                                    <label for="brand-3">
                                        <span></span>
                                        SONY
                                        <small>(755)</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- /aside Widget -->

                        <!-- زر "Apply" -->
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                    </form>
                </div>
                <!-- /ASIDE -->

                <!-- STORE -->
                <div id="store" class="col-md-9">
                    <!-- store top filter -->
                    <div class="store-filter clearfix">
                     <form method="GET" action="{{ route('products.index') }}">

                        <div class="store-sort" style="padding: 15px;">
                            <label>
                                Sort By:
                                <select name="order" onchange="this.form.submit()" style="padding: 10px;">
                                    <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>low to high</option>
                                    <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>high to low</option>
                                </select>
                            </label>

                            <label>
                                Show:
                                <select name="paginate" onchange="this.form.submit()" style="padding: 10px;">
                                    <option value="2" {{ request('paginate') == 2 ? 'selected' : '' }}>2</option>
                                    <option value="5" {{ request('paginate') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('paginate') == 10 ? 'selected' : '' }}>10</option>
                                </select>
                            </label>
                        </div>


                        <ul class="store-grid">
                            <li class="active"><i class="fa fa-th"></i></li>
                            <li><a href="#"><i class="fa fa-th-list"></i></a></li>
                        </ul>
                    </div>
                </form>
                    <!-- /store top filter -->

                    <!-- store products -->
                    <div class="row">
                        <!-- product -->
                        @foreach ($products as $product)
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
                                    <h3 class="product-name"><a href="#">{{ $product->name_en }}</a></h3>
                                    <h4 class="product-price"> {{ $product->price }}<del class="product-old-price">{{ $product->price  + 30}}</del></h4>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product-btns">
                                        <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="add-to-wishlist">
                                                <i class="fa fa-heart"></i>
                                            </button>
                                        </form>
                                        <a  href="{{ route('products.show', $product->id) }}" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Show Details</span></a>
                                    </div>
                                </div>
                                <div class="add-to-cart">
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <!-- Add hidden input for quantity -->
                                        <input type="hidden" name="quantity" value="1">
                                        
                                        <button type="submit" class="add-to-cart-btn">
                                            <i class="fa fa-shopping-cart"></i> Add to Cart
                                        </button>
                                    </form>
                                </div>
                                
                                
                            </div>
                        </div>
                        @endforeach
                        <!-- /product -->

                    </div>
                    <!-- /store products -->
                </div>
                <!-- /STORE -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

@endsection
