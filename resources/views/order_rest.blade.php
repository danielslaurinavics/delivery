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
			
			<h2>{{ __('order.title') }}</h2>
			@if($orders->isEmpty())
				<p>{{ __('messages.emptytable') }}</p>
			@else
			<table>
				<thead>
					<tr>
						<th>{{ __('order.id') }}</th>
						<th>{{ __('order.dtime') }}</th>
						<th>{{ __('order.rest') }}</th>
						<th>{{ __('order.dish') }}</th>
						<th>{{ __('order.cour') }}</th>
						<th>{{ __('order.address') }}</th>
						<th>{{ __('order.status') }}</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($orders as $order)
						<tr>
							<td>{{ $order->id }}</td>
							<td>{{ date('d.m.Y. H:i', strtotime($order->ordered_at)) }}</td>
							<td>{{ $restaurants[$order->made_by] }}</td>
							<td>{{ $dishes[$order->dish_id]->name }}</td>
							<td>{{ $order->courier_id ? $couriers[$order->courier_id] : '-' }}</td>
							<td>{{ $order->address }}</td>
							<td>{{ __('order.'. $order->status) }}</td>
							<td>
								@if($order->status === 'pending')
									<form action="{{ route('orders.setprep', $order->id) }}" method="POST">
										@csrf
										@method('PUT')
										<button type="submit">{{ __('order.markasbp')}}</button>
									</form>
								@elseif($order->status === 'preparation')
									<form action="{{ route('orders.setr', $order->id) }}" method="POST">
										@csrf
										@method('PUT')
										<button type="submit">{{ __('order.markasr')}}</button>
									</form>
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			<table>
			@endif
		@endif
	</section>
</body>
</html>