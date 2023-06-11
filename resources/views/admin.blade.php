<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		@include('head_common')
		<script src="{{ asset('js/admin.js') }}"></script>
		<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
	</head>

	<body>
		@include('app_common', ['message' => "Mes références"])
		<div hidden>
			<form id="user_remove_form" action="/api/admin/users/remove" method="post">
				@csrf
				<input name="selected" type="text">
			</form>
			<form id="user_select_form" action="/admin" method="get">
				<input name="selected" type="text">
			</form>
			<form id="ref_remove_form" action="/api/admin/references/remove" method="post">
				@csrf
				<input name="selected" type="text">
				@if(isset($current))
					<input name="current" type="text" value="{{ $current->id }}">
				@endif
			</form>
		</div>
		<div id="account_management_divs">
			<div class="account_settings_area" id="account_list">
				<div class="user_actions">
					<button class="user_area_button" onclick="removeSelectedUsers()">Supprimer</button>
				</div>
				@foreach(\App\Models\User::all() as $user)
					@if(!$user->admin)
						<div class="user">
							<input class="select" name="{{ $user->id }}" type="checkbox">
							<div class="user_content" onclick="displayUser({{ $user->id }})">
								<label class="name">Nom : {{ $user->first_name }} {{ strtoupper($user->last_name) }}</label>
							</div>
						</div>
					@endif
				@endforeach
			</div>
			<div class="reference_list account_settings_area">
				<div class="reference_actions">
					<button class="reference_area_button" onclick="removeSelectedReferences()">Supprimer</button>
				</div>
				@if(isset($current))
					@foreach($current->references as $ref)
						<div class="reference">
							<input class="select" name="{{ $ref->id }}" type="checkbox">
							<div class="reference_content">
								<label class="summary">Référent : {{ $ref->ref_first_name }} {{ strtoupper($ref->ref_last_name) }}</label><br>
								<label>Lieu : {{ $ref->area }}</label><br>
                                @if(!$ref->isConfirmed())
                                    <label class="unconfirmed">Non confirmée</label><br>
                                @endif
								<br>
								<label class="description_summary">{{ trim(substr($ref->description, 0, 30)) }}...</label>
							</div>
						</div>
					@endforeach
				@endif
			</div>
		</div>
	</body>

</html>
