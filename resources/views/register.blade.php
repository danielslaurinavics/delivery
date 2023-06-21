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
		<h2>{{__('messages.register')}}</h2>
		<p>{{__('messages.pl_register')}}</p>
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<form action="{{ route('register.store') }}" method="POST">
				@csrf
				<label for="email">{{__('messages.email')}}</label>
				<input type="text" name="email">
				<br>
				<label for="name">{{__('messages.name')}}</label>
				<input type="text" name="name">
				<br>
				<label for="password">{{__('messages.passw')}}</label>
				<input type="password" name="password">
				<br>
				<label for="password_confirmation">{{__('messages.passwc')}}</label>
				<input type="password" name="password_confirmation">
				<br>
				<button type="submit">{{__('messages.register')}}</button>
			</form>
	</section>
</body>
</html>