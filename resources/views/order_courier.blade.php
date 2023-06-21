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
			
			<table>
				<thead>
					<tr>
						<th>{{ __('courier.id') }}</th>
						<th>{{ __('courier.dtime') }}</th>
						<th>{{ __('courier.rest') }}</th>
						<th>{{ __('courier.dish') }}</th>
						<th>{{ __('courier.cour') }}</th>
						<th>{{ __('courier.address') }}</th>
						<th>{{ __('courier.status') }}</th>
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
								@if($order->status === 'ready')
								<form action="{{ route('orders.sete', $order->id) }}" method="POST">
									@csrf
									@method('PUT')
									<button type="submit">{{ __('order.markase')}}</button>
								</form>
								@elseif($order->status === 'enroute')
								<form action="{{ route('orders.setd', $order->id) }}" method="POST">
									@csrf
									@method('PUT')
									<button type="submit">{{ __('order.markasc')}}</button>
								</form>
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			<table>
		@endif
	</section>
</body>
</html>