<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Delivery.lv</title>
</head>
<body>
	<section id="center">
		<a href="{{ url('/') }}">
			<div class="upper-head">
				<h1>Delivery.lv</h1>
				<p>{{__('messages.phrase')}}</p>
			</div>
		</a>
		<form action="{{ route('switchLanguage') }}" method="POST">
			@csrf
			<select name="locale" onchange="this.form.submit()">
				<option value="lv" {{ App::getLocale() === 'lv' ? 'selected' : '' }}>Latviešu</option>
				<option value="en" {{ App::getLocale() === 'en' ? 'selected' : '' }}>English</option>
			</select>
		</form>
		<h2>{{__('messages.welcome')}}</h2>
		@if(auth()->check())
			@php
				$user = auth()->user();
				$logged = __('messages.loggedin', ['name' => $user->name]);
			@endphp
			<h5>{{ $logged }}</h5>
			<form action="{{ route('logout') }}" method="POST">
				@csrf
				<button type="submit">{{ __('messages.logout') }}</button>
			</form>
			<br>
			<h3>{{ __('messages.choice') }}</h3>
			<ul>
			<li><a href="{{ route('dishes.index') }}">{{ __('choice.view_offers') }}</a></li>
			<li><a href="{{ route('orders.index') }}">{{ __('choice.view_my_order') }}</a></li>
			<li><a href="{{ route('dishes.create') }}">{{ __('choice.add_dish') }}</a></li>
			<li><a href="{{ route('users.index') }}">{{ __('choice.manage_users') }}</a></li>
			<li><a href="{{ route('courier.index') }}">{{ __('choice.view_orders_cour') }}</a></li>
			<li><a href="{{ route('rest.index') }}">{{ __('choice.view_orders_rest') }}</a></li>
			<li><a href="{{ route('ratings.restrat' , auth()->user()->id ) }}">{{ __('choice.view_rating_rest') }}</a></li>
			<li><a href="{{ route('ratings.courrat', auth()->user()->id ) }}">{{ __('choice.view_rating_cour') }}</a></li>
			<li><a href="">{{ __('choice.make_profile_changes')}}</a></li>
			</ul>
		@endif
	</section>
</body>
</html>