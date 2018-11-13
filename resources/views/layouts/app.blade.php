<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/material.min.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
                @yield('styles')

    
</head>
<body>
    @if(Auth::check())
    <script>
  window.App = {!! json_encode([
      'user' => Auth::user(),
      'profile' => Auth::user()->profile,
  ])
  !!};
  
 
  
</script>
    @endif
    <div id="app">
      
        <main class="py-4">
            



@if( (new Jenssegers\Agent\Agent)->isMobile() )


@else




<!-- Header-BP -->

<header class="header" id="site-header">
    <div class="container-head">
        <div class="page-title">
            <img src="https://s3.amazonaws.com/meetworks/logo_header.png"/>
	</div>

	<div class="header-content-wrapper">
			@if(Request::route()->getName()=="places")

        <filter-top-map-desktop></filter-top-map-desktop>
@endif

		<div class="control-block">

			
			<div class="author-page author vcard inline-items more">
				<div class="author-thumb">
					<img alt="{{ Auth::user()->name }}" src="{{ Auth::user()->image }}" class="avatar">
					<span class="icon-status online"></span>
					<div class="more-dropdown more-with-triangle">
						<div class="mCustomScrollbar" data-mcs-theme="dark">
							<div class="ui-block-title ui-block-title-small">
								<h6 class="title">Your Account</h6>
							</div>

							<ul class="account-settings">
								<li>
									<a href="29-YourAccount-AccountSettings.html">

										<svg class="olymp-menu-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-menu-icon"></use></svg>

										<span>Profile Settings</span>
									</a>
								</li>
								<li>
									<a href="36-FavPage-SettingsAndCreatePopup.html">
										<svg class="olymp-star-icon left-menu-icon"  data-toggle="tooltip" data-placement="right"   data-original-title="FAV PAGE"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-star-icon"></use></svg>

										<span>Create Fav Page</span>
									</a>
								</li>
								<li>
                                                                        <a  href="{{ route('logout') }}"
                                                                        onclick="event.preventDefault();
                                                                                      document.getElementById('logout-form').submit();">
                                                                                 <svg class="olymp-logout-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-logout-icon"></use></svg>

                                                                                 <span> {{ __('Logout') }}</span>
                                                                         </a>



                                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                            @csrf
                                                                        </form>
								</li>
							</ul>

							<div class="ui-block-title ui-block-title-small">
								<h6 class="title">Chat Settings</h6>
							</div>

							<ul class="chat-settings">
								<li>
									<a href="#">
										<span class="icon-status online"></span>
										<span>Online</span>
									</a>
								</li>
								<li>
									<a href="#">
										<span class="icon-status away"></span>
										<span>Away</span>
									</a>
								</li>
								<li>
									<a href="#">
										<span class="icon-status disconected"></span>
										<span>Disconnected</span>
									</a>
								</li>

								<li>
									<a href="#">
										<span class="icon-status status-invisible"></span>
										<span>Invisible</span>
									</a>
								</li>
							</ul>

							<div class="ui-block-title ui-block-title-small">
								<h6 class="title">Custom Status</h6>
							</div>

							<form class="form-group with-button custom-status">
								<input class="form-control" placeholder="" type="text" value="Space Cowboy">

								<button class="bg-purple">
									<svg class="olymp-check-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-check-icon"></use></svg>
								</button>
							</form>

							<div class="ui-block-title ui-block-title-small">
								<h6 class="title">About Olympus</h6>
							</div>

							<ul>
								<li>
									<a href="#">
										<span>Terms and Conditions</span>
									</a>
								</li>
								<li>
									<a href="#">
										<span>FAQs</span>
									</a>
								</li>
								<li>
									<a href="#">
										<span>Careers</span>
									</a>
								</li>
								<li>
									<a href="#">
										<span>Contact</span>
									</a>
								</li>
							</ul>
						</div>

					</div>
				</div>
				<a href="{{route("profile",Auth::user()->profile->slug)}}" class="author-name fn">
					<div class="author-title">
						{{ Auth::user()->name }} <svg class="olymp-dropdown-arrow-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
					</div>
					<span class="author-subtitle">SPACE COWBOY</span>
				</a>
			</div>

		</div>
	</div>
    </div>
	@if(Request::route()->getName()=="places")
    
        <filter-map-desktop  ></filter-map-desktop>
        @endif
</header>

<!-- ... end Header-BP -->


@endif

<div class="header-spacer"></div>
            
            <div class="container-fluid home-container">

            @yield('content')
            
            </div>
<!-- Window-popup Update Header Photo -->





<a class="back-to-top" href="#">
	<img src="/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
</a>

            
            
        </main>
    </div>
    
    <script>
    Materialize = function () {
	$.material.init();

	$('.checkbox > label').on('click', function () {
		$(this).closest('.checkbox').addClass('clicked');
	})
};

document.addEventListener('DOMContentLoaded', function() {
   	Materialize();


$('.carousel').carousel()

}, false);
 
    
    </script>
</body>
</html>
