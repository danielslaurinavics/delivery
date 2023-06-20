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
			<h2>{{ __('order.addratt', ['id'=>$order->id]) }}</h2>
			<p>{{ __('order.ratquest') }}</p>
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<form action="{{ route('ratings.store') }}" method="POST">
				@csrf
				<input type="hidden" id="order-id" name="order-id" value="{{ $order->id }}">
				<p>{{ __('order.ratordd') }}</p>
				<label for="order-rating">{{ __('order.ratord') }}<label>
				<input type="text" id="order-rating" name="order-rating" value="{{ old('order-rating') }}">
				<br>
				<p>{{ __('order.ratcoud') }}</p>
				<label for="courier-rating">{{ __('order.ratcou') }}<label>
				<input type="text" id="courier-rating" name="courier-rating" value="{{ old('courier-rating') }}">
				<br>
				<button type="submit">{{ __('order.ratcrt') }}</button>
			</form>
			<form action="{{ route('orders.index') }}" method="GET">
				<button type="sumbit">{{ __('order.back') }}</button>
			</form>
		@endif
	</section>
</body>
</html>