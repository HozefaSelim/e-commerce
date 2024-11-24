	<!-- HEADER -->
    <header>
        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li>
                        <a href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                @endforeach
                </ul>
                <ul class="header-links pull-right">
                    @auth
                    <li >{{ auth()->user()->name }}</li>
                <li>
                        <a href="{{ route('profile.edit') }}">
                          Profile
                        </a>
                    </li>
                    <li>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                               Logout
                            </a>
                        </form>
                    </li>
                  @else
                    <li><a href="{{ route('login') }}"><i class="fa fa-dollar"></i> {{ __('messages.login') }}</a></li>
                    <li><a href="{{ route('register') }}"><i class="fa fa-user-o"></i> {{ __('messages.register') }}</a></li>
                    @endauth
                </ul>
            </div>
        </div>
        <!-- /TOP HEADER -->

        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="#" class="logo">
                                <img src="{{ asset('front/img') }}/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-5">
                        <div class="header-search">
                            <form method="GET" action="{{ route('products.search') }}">
                                <select class="input-select" name="category">
                                    <option value="0">All Categories</option>
                                    @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                                </select>
                                <input class="input" name="query" placeholder="Search here" value="{{ request('query') }}">
                                <button class="search-btn" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-4 clearfix">
                        <div class="header-ctn">

                           
                            <!-- Wishlist -->
                            <div>
                                <a href="{{ route('wishlist.index') }}">
                                    <i class="fa fa-heart-o"></i>
                                    <span>Your Wishlist</span>
                                    <div class="qty">{{ $wishlistCount }}</div> 
                                </a>
                            </div>
                            <!-- /Wishlist -->

                            	<!-- Cart -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty">{{ $cartItems->count() }}</div>
									</a>
                                    
									<div class="cart-dropdown">
                                        @if($cartItems->count() > 0)
                                        <div class="cart-list">
                                            @foreach($cartItems as $item)
                                            <div class="product-widget">
                                                <div class="product-img">
                                                    <img src="{{ asset('/front/img/' . $item->image) }}" alt="">
                                                </div>
                                                <div class="product-body">
                                                    <h3 class="product-name"><a href="#">{{ $item->name }}</a></h3>
                                                    <h4 class="product-price">
                                                        <span class="qty">{{ $item->pivot->quantity }}x</span>
                                                        ${{ $item->price }}
                                                    </h4>
                                                </div>
                                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="delete"><i class="fa fa-close"></i></button>
                                                </form>
                                            </div>
                                        @endforeach
                                        
                                        </div>
                                        
                                        
                                        <div class="cart-summary">
                                            <small>{{ $cartItems->count() }} Item(s) selected</small>
                                            <h5>SUBTOTAL: ${{ number_format($cartItems->sum(fn($item) => $item->price * $item->pivot->quantity), 2) }}</h5>
                                        </div>
                                        <div class="cart-btns">
                                            <a href="{{ route('cart.index') }}">View Cart</a>
                                            <a href="#">Checkout <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                        @endif
                                        <p>Your cart is empty</p>
									</div>
                                 
								</div>
								<!-- /Cart -->

                            <!-- orders -->
                            <div>
                                <a href="{{ route('order.index') }}">
                                    <i class="fa fa-first-order"></i>
                                    <span>Your orders</span>
                                    <div class="qty">{{ $orderCount }}</div> 
                                </a>
                            </div>
                            <!-- /orders -->

                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->

    <!-- NAVIGATION -->
    <nav id="navigation">
        <!-- container -->
        <div class="container">
            <!-- responsive-nav -->
            <div id="responsive-nav">
                <!-- NAV -->
                <ul class="main-nav nav navbar-nav">
                    <li class="@yield('home_active')"><a href="{{ url('/') }}">Home</a></li>
                    <li class="@yield('prodcuts_active')"><a href="{{ route('products.index') }}">Prodcuts</a></li>
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Contact</a></li>
                   
                </ul>
                <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>
    <!-- /NAVIGATION -->