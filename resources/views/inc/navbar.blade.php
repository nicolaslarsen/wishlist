<nav class="navbar navbar-expand-md navbar-dark bg-primary">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
					<button type="button" class="navbar-toggler" data-toggle="collapse"
					data-target="#app-navbar-collapse" aria-expanded="false">
                       <span class="navbar-toggler-icon"></span> 
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
						@if (Auth::check())
						<li class="nav-item">
							<a class="nav-link"
								href="/home">
								Din ønskeseddel	
							</a>	
						</li>
						@endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
							<li class="nav-item">
								<a class="nav-link" href="{{ route('login') }}">Log ind</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{ route('register') }}">Ny bruger</a>
							</li>
                        @else
                            <li class="nav-item dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" 
								role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu">
									<a class="dropdown-item" href="{{ route('home') }}">
										Instrumentbræt
									</a>
									<a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
										Log ud
                                 	</a>
									<form id="logout-form" action="{{ route('logout') }}"
										 method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                  	</form>
                               </div>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
