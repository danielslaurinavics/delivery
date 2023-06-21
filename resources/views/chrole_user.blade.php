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
			
			<h2>{{ __('users.chrolet', ['name' => $userr->name])}}</h2>
			<p>{{ __('users.usercode', ['id'=> $userr->id])}}</p>
			<p>{{ __('users.currrole', ['role' => __('users.'.$userr->role)])}}
			
			<p>{{ __('users.chroleq') }}</p>
			
			@if ($userr->role === 'user')
				<form action="{{ route('users.asscour', $userr->id ) }}" method="POST">
					@csrf
					@method('PUT')
					<button type="submit">{{ __('users.courier') }}</button>
				</form>
				<form action="{{ route('users.crtrest', $userr->id) }}" method="GET">
					<button type="submit">{{ __('users.restaurant') }}</button>
				</form>
			@elseif ($userr->role === 'courier')
				<form action="{{ route('users.assuser', $userr->id ) }}" method="POST">
					@csrf
					@method('PUT')
					<button type="submit">{{ __('users.user') }}</button>
				</form>
				<form action="{{ route('users.crtrest', $userr->id) }}" method="GET">
					<button type="submit">{{ __('users.restaurant') }}</button>
				</form>
			@elseif ($userr->role === 'restaurant')
				<p>{{ __('users.cannotchange') }}</p>
			@elseif ($userr->role === 'admin')
				<p>{{ __('users.cannotchange') }}</p>				
			@else
				<p>{{ __('users.cannotchange') }}</p>				
			@endif
			<form action="{{ route('users.index') }}" method="GET">
				<button type="submit">{{ __('users.return') }}</button>
			</form>
		@endif
	</section>
</body>
</html>