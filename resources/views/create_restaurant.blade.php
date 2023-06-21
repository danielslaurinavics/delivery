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
			<h2>{{ __('users.crrest') }}</h2>
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<form action="{{ route('users.assrest', $userr->id) }}" method="POST">
			@csrf
				<label for="name">{{ __('users.crname') }}</label>
				<input type="text" name="name" id="name" value="{{ old('name') }}"><br>
				<label for="address">{{ __('users.craddr') }}</label>
				<input type="text" name="address" id="address" value="{{ old('price') }}"><br>
				<label for="manager">{{ __('users.crman') }}</label>
				<input type="text" name="manager" id="manager" value="{{ $userr->name }}" readonly><br>
				<label>{{ __('users.crconf') }} <br> {{ __('users.crconf2') }}</label><br>
				<button type="submit">{{ __('users.crrest') }}</button>
			</form>
		@endif
	</section>
</body>
</html>