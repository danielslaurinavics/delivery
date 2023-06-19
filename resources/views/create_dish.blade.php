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
			<h2>Izveidot ēdienu</h2>
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<form action="{{ route('dishes.store') }}" method="POST">
			@csrf
				<label for="name">Name </label>
				<input type="text" name="name" id="name" value="{{ old('name') }}"><br>
				<label for="price">Price</label>
				<input type="text" name="price" id="price" value="{{ old('price') }}"><br>
				<label for="maker">Maker</label>
				<select name="maker" id="maker">
					@foreach($restaurants as $restaurant)
						<option value="{{ $restaurant->id }}" {{ old('maker') == $restaurant->id ? 'selected' : '' }}>{{ $restaurant->name }}</option>
					@endforeach
				</select><br>
				<button type="submit">submit</button>
			</form>
		@endif
	</section>
</body>
</html>