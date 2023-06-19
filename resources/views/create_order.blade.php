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
		@if(auth()->check())
			<h2>{{ __('dish.create') }}</h2>
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<form action="{{ route('orders.store') }}" method="POST">
			@csrf
				<label for="restaurant">{{ __('order.resto') }}</label>
				<input type="text" name="restaurant" id="restaurant" value="{{ $restaurant->name }}" readonly>
				<input type="hidden" name="restaurant-id" id="restaurant-id" value="{{ $restaurant->id }}" readonly><br>
				<label for="dish">{{ __('order.disho') }}</label>
				<input type="text" name="dish" id="dish" value="{{ $dish->name }}" readonly>
				<input type="hidden" name="dish-id" id="dish-id" value="{{ $dish->id }}" readonly><br>
				<label for="price">{{ __('order.priceo') }}</label>
				<input type="text" name="price" id="price" value="{{ $dish->price }}" readonly><br>
				<label for="address">{{ __('order.addresso') }}</label>
				<input type="text" name="address" id="address"><br>
				<button type="submit">{{ __('order.create') }}</button>
			</form>
		@endif
	</section>
</body>
</html>