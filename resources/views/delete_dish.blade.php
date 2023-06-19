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
			<h2>{{ __('dish.delette', ['name'=>$dish->name]) }}</h2>
			<p>{{ __('dish.sure_to_delete', ['name'=>$dish->name]) }}</p>
			<form action="{{ route('dishes.destroy', $dish->id) }}" method="POST">
			@csrf
			@method('DELETE')
			<button type="submit">{{ __('dish.yes') }}</button>
			</form>
			<form action="{{ route('dishes.index') }}" method="GET">
			@csrf
			<button type="submit">{{ __('dish.no') }}</button>
			</form>
		@endif
	</section>
</body>
</html>