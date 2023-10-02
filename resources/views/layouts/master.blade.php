<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
	
	<title>{{ config('app.name') }} - @yield('title', 'Home')</title>
	
	<link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
	
	<link href="{{asset('assets/vendor/icons/icofont.min.css')}}" rel="stylesheet" type="text/css">
	
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/slick/slick.min.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/slick/slick-theme.min.css')}}" />
	
	<link href="{{asset('assets/vendor/select-tool/dist/css/select2.min.css')}}" rel="stylesheet">
	
	<link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
	
	<link href="{{asset('assets/vendor/sidebar/demo.css')}}" rel="stylesheet">
	
	@livewireStyles
</head>
<body class="bg-light">

	@yield('content')
	
	@if(!request()->routeIs('bus') && !request()->routeIs('bus-seats') && !request()->routeIs('make-payment'))
		
		@include('partial.footer-menu')
		
	@endif
	
	{{--@include('partial.sidebar')--}}
	
	<script src="{{asset('assets/vendor/jquery/jquery.min.js')}}" type="37da261c20641f79014ade4f-text/javascript"></script>
	<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}" type="37da261c20641f79014ade4f-text/javascript"></script>
	
	<script type="37da261c20641f79014ade4f-text/javascript" src="{{asset('assets/vendor/slick/slick.min.js')}}"></script>
	
	<script src="{{asset('assets/vendor/select-tool/dist/js/select2.min.js')}}" type="37da261c20641f79014ade4f-text/javascript"></script>
	
	<script type="37da261c20641f79014ade4f-text/javascript" src="{{asset('assets/vendor/sidebar/hc-offcanvas-nav.js')}}"></script>
	
	<script src="{{asset('assets/js/custom.js')}}" type="37da261c20641f79014ade4f-text/javascript"></script>
	<script src="https://cdn.jsdelivr.net/npm/rocket-loader@2.4.0/build/js/loader.min.js"></script>
	<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v8b253dfea2ab4077af8c6f58422dfbfd1689876627854" integrity="sha512-bjgnUKX4azu3dLTVtie9u6TKqgx29RBwfj3QXYt5EKfWM/9hPSAI/4qcV5NACjwAo8UtTeWefx6Zq5PHcMm7Tg==" data-cf-beacon='{"rayId":"7ecf3c411a9769f0","version":"2023.7.0","r":1,"b":1,"token":"dd471ab1978346bbb991feaa79e6ce5c","si":100}' crossorigin="anonymous"></script>

	@livewireScripts
	
	@yield('scripts')
</body>
</html>