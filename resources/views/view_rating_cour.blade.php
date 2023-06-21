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
			<input type="hidden" name="_method" value="POST">
		</form>
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
			<h2>{{ __('order.viewcratings') }}</h2>
			
			<ul>
				<li>
					<p>{{ __('order.ordersdel', ['count' => $countord]) }}</p>
				</li>
				<li>
					<p>{{ __('order.amongrat', ['count' => $countrat ]) }}</p>
				</li>
				<li>
					<p><label for="avg-rat">{{ __('order.avgrat') }}</label>
					<meter id="avg-rat" value={{ $avgratf }} min="0" max="5"></meter>  {{ __('order.avgrat2', ['avgrat' => $avgratf]) }}</p>
				</li>
				<li>
					@if ($avgratf >= 4.5) <p>{{ __('order.great') }}</p>
					@elseif ($avgratf < 4.5 && $avgratf >= 3.5) <p>{{ __('order.well') }}</p>
					@elseif ($avgratf < 3.5 && $avgratf >= 2.5) <p>{{ __('order.okay') }}</p>
					@else <p>{{ __('order.poor') }}</p>
					@endif
				</li>
			</ul>
			
		@endif
	</section>
</body>
</html>