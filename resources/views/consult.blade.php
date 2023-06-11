<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		@include('head_common')
		<link rel="stylesheet" href="{{ asset('css/consult.css') }}">
	</head>

	<!-- This is the page that displays the references of a user to a consultant. -->
	<body>
		@include('app_common', ['message' => "Références de ".$consult->user->first_name])

		<div id="consult_zone">
			<!-- This is the area that contains the information about the user.-->
			<fieldset class="user_info">
				<legend>Informations sur le compte</legend>
				<label class="static_text">Jeune : </label><label>{{ $consult->user->first_name }} {{ $consult->user->last_name }}</label></br>
				<label class="static_text">Email : </label><label>{{ $consult->user->email }}</label></br>
				<label class="static_text">Date de naissance : </label><label>{{ $consult->user->birth_date }}</label></br>
			</fieldset>

			<!-- This is the area that contains the references of the user.-->
			<div class="reference_list">
				@foreach($consult->references as $reference)
					<fieldset class="reference">
						<legend>{{ $reference->area }} - Référent : {{ $reference->ref_first_name }} {{ $reference->ref_last_name }}</legend>
						<label class="static_text">Durée : </label><label>{{ $reference->timeDuration() / (24*3600) }} jours</label></br>
						<label class="static_text">Description :</label>
						<p>{{ $reference->description }}</p></br>
						<label class="static_text">Savoir-faire :</label>
						<ul>
							@foreach($reference->hardSkills() as $skill)
								<li>{{ $skill }}</li>
							@endforeach
						</ul>
						<label class="static_text">Savoir-être :</label>
						<ul>
							@foreach($reference->softSkills() as $skill)
								<li>{{ $skill }}</li>
							@endforeach
						</ul>
					</fieldset>
				@endforeach
			</div>
		</div>
	</body>

</html>
