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
			<h2>{{ __('users.chutitle', ['name'=>$user->name]) }}</h2>
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<form action="{{ route('users.update', $user->id) }}" method="POST">
			@csrf
			@method('PUT')
				<label for="name">{{ __('users.yname') }}</label>
				<input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"><br>
				<label for="email">{{ __('users.yemail') }}</label>
				<input type="text" name="email" id="email" value="{{ $user->email }}" readonly><br>
				<label for="role">{{ __('users.yrole') }}</label>
				<input type="text" name="role" id="role" value="{{ __('users.'.$user->role) }}" readonly><br>
				<button type="submit">{{ __('users.confirm') }}</button>
			</form>
			<form action="{{ route('welcome') }}" method="GET">
				<button type="submit">{{ __('users.return') }}</button>
			</form>
			<br>
			<h3>{{ __('users.chp') }}</h3>
			<p>{{ __('users.chpe') }}</p>
			<form action="{{ route('users.changepass', $user->id) }}" method="POST">
			@csrf
				<label for="op">{{ __('users.op') }}</label>
				<input type="password" name="op" id="op"><br>
				<label for="np">{{ __('users.np') }}</label>
				<input type="password" name="np" id="np"><br>
				<label for="cp">{{ __('users.cp') }}</label>
				<input type="password" name="np_confirmation" id="np_confirmation"><br>
				<button type="submit">{{ __('users.chp') }}</button>
			</form>
		@endif
	</section>
</body>
</html>