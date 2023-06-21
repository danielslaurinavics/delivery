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
			
			@if($dishes->isEmpty())
				<p>{{ __('messages.emptytable') }}</p>
			@else
			<table>
				<thead>
					<tr>
						<th>{{ __('dish.name') }}</th>
						<th>{{ __('dish.price') }}</th>
						<th>{{ __('dish.maker') }}</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				@foreach ($dishes as $dish)
					<tr>
						<td>{{ $dish->name }} </td>
						<td>{{ $dish->price }}</td>
						<td>{{ $dish->maker_name }}</td>
						<td>
							<form action="{{ route('dishes.edit', $dish->id) }}" method="GET">
								<button type="submit">{{ __('dish.edit') }}</button>
							</form>
							<form action="{{ route('dishes.delete', $dish->id) }}" method="GET">
								<button type="submit">{{ __('dish.delete') }}</button>
							</form>
						</td>
					</tr>
				@endforeach
				</tbody>					
			</table>
			@endif
		@endif
	</section>
</body>
</html>