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
			<lI><a href="{{ route('ratings.courrat', auth()->user()->id ) }}">{{ __('choice.view_rating_cour') }}</a></li>
			</ul>
		@else
			<p>{{__('messages.pl_login')}}</p>
				@if($errors->has('auth'))
					<div class="alert alert-danger">{{ $errors->first('auth') }}</div>
				@endif
			<form action="{{ route('login') }}" method="POST">
				@csrf
				<label for="email">{{__('messages.email')}}</label>
				<input type="text" name="email">
				@error('email')
					<div class="alert alert-danger">{{ $message }}</div>
				@enderror
				<br>
				<label for="password">{{__('messages.passw')}}</label>
				<input type="password" name="password">
				@error('password')
					<div class="alert alert-danger">{{ $message }}</div>
				@enderror
				<br>
				<button type="submit">{{__('messages.login')}}</button>
			</form>
		@endif
	</section>
</body>
</html>