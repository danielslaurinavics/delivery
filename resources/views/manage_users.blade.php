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
			
			<h2>{{ __('users.title') }}</h2>
			
			<table>
				<thead>
					<tr>
						<th>{{ __('users.ID') }}</th>
						<th>{{ __('users.name') }}</th>
						<th>{{ __('users.email') }}</th>
						<th>{{ __('users.role') }}</th>
						<th>{{ __('users.blocked') }}</th>
						<th>{{ __('users.ass-rest') }}</th>
						<th>{{ __('users.actions')}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
					<tr>
						<td>{{ $user->id }}</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ __('users.'. $user->role) }}</td>
						@if ($user->is_blocked)
							<td>{{ __('users.bl-yes')}}</td>
						@else
							<td>{{ __('users.bl-no') }}</td>
						@endif

						@if ( $user->role != 'restaurant')
							<td>-</td>
						@else
							<td>{{ $user->restaurants->first()->name }}</td>
						@endif
						<td>
						@if ($user->is_blocked)
						<form action="{{ route('users.unblock', $user->id) }}" method="POST">
							@csrf
							<button type="submit">{{ __('users.unblock') }}</button>
						</form>
						@elseif (!$user->is_blocked && $user->role === 'admin')
							<button type="button" disabled>{{ __('users.block') }}</button>
						@else
						<form action="{{ route('users.blo', $user->id) }}" method="GET">
							<button type="submit">{{ __('users.block') }}</button>
						</form>
						@endif
						
						
						
						</td>
					<tr>
					@endforeach
				</tbody>
			</table>
			
		@endif
	</section>
</body>
</html>