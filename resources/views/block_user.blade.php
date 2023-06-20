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
			<h2>{{ __('users.blockt', ['name'=>$user->name]) }}</h2>
			<p>{{ __('users.are-u-sure', ['name'=>$user->name]) }}</p>
			<p>{{ __('users.explintro') }}</p>
			@if ($user->role === 'user')
			<ul>
				<li>{{ __('users.loseaccess') }}</li>
			</ul>
			@elseif ($user->role === 'restaurant')
			<ul>
				<li>{{ __('users.restlose') }}</li>
				<li>{{ __('users.delorders') }}</li>
				<li>{{ __('users.unavdish') }}</li>
				<li>{{ __('users.unavvdish') }}</li>
			</ul>
			@elseif ($user->role === 'courier')
			<ul>
				<li>{{ __('users.courlose') }}</li>
				<li>{{ __('users.movorders') }}</li>
			</ul>
			@elseif ($user->role === 'admin')
			<ul>
				<li>{{ __('users.block-admin') }}</li>
			</ul>
			@endif
			
			@if ($user->role != 'admin')
			<form action="{{ route('users.block', $user->id) }}" method="POST">
				@csrf
				<button type="submit">{{ __('users.yes') }}</button>
			</form>
			@else
				<button type="button" disabled>{{ __('users.yes') }}</button>
			@endif
			<form action="{{ route('users.index') }}" method="GET">
				<button type="submit">{{ __('users.no') }}</button>
			</form>
		@endif
	</section>
</body>
</html>