<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		@include('head_common')
		<script src="{{ asset('js/skill.js') }}"></script>
		<link rel="stylesheet" href="{{ asset('css/reference_display.css') }}">
	</head>

	<body>
		 <!-- This page is used to display a reference to the linked referent. From there, the referent can also modify the reference. -->

		@include('app_common', ['message' => "Référence de ".$reference->user->first_name])

		<!-- Hidden form used by the JS side to perform requests from other kinds of HTML elements or fake forms -->
		<form id="edit_form" action="/api/references/edit" method="post" hidden>
			@csrf
			<input type="hidden" name="token" value="{{ $reference->token }}">
			<input type="text" name="hard_skills">
			<input type="text" name="soft_skills">
			<input type="text" name="ref_first_name">
			<input type="text" name="ref_last_name">
			<input type="date" name="ref_birth_date">
		</form>

		<div>
			<!-- This is the area that contains the information about the user and small details of the reference.-->
			<fieldset id="info_zone">
				<legend>Informations</legend>
				<label class="static_text">Jeune : </label><label>{{ $reference->user->first_name }} {{ $reference->user->last_name }}</label><br>
				<label class="static_text">Description :</label><br>
				<p>{{ $reference->description }}</p>
				<label class="static_text">Lieu : </label><label>{{ $reference->area }}</label><br>
				<label class="static_text">Durée : </label><label>{{ $reference->timeDuration() / (24*3600) }} jours</label><br>
			</fieldset>

			<!-- This is the area that contains the reference itself, and allows the referent to modify it.-->
			<fieldset id="modif_zone">
				<legend>Modifier la référence</legend>
				<label for="ref_first_name" class="static_text">Prénom du référent : <input type="text" name="ref_first_name" required value="{{ $reference->ref_first_name }}"></label><br>
				<label for="ref_last_name" class="static_text">Nom du référent : <input type="text" name="ref_last_name" required value="{{ $reference->ref_last_name }}"></label><br>
				<label for="ref_birth_date" class="static_text">Date de naissance du référent : <input type="date" name="ref_birth_date" required value="{{ $reference->ref_birth_date }}"></label><br>
				<div>
					<label class="static_text">Savoir-faire :</label>
					<input name="hard_skill" type="text">
					<button onclick="addSkill('hard')">Ajouter</button>
					<ul id="hard_skills">
						@foreach($reference->hardSkills() as $skill)
							<li id="ref_{{ $skill }}">{{ $skill }} <button onclick="this.parentNode.remove()">-</button></li>
						@endforeach
					</ul>
				</div>
				<br>
				<div>
					<label class="static_text">Savoir-être :</label>
					<input name="soft_skill" type="text">
					<button onclick="addSkill('soft')">Ajouter</button>
					<ul id="soft_skills">
						@foreach($reference->softSkills() as $skill)
							<li id="ref_{{ $skill }}">{{ $skill }} <button onclick="this.parentNode.remove()">-</button></li>
						@endforeach
					</ul>
				</div>
				<br>
				<button onclick="sendEdit()">Confirmer les modifications</button>
			</fieldset>

			<!-- This is the area that contains the button to confirm the reference.-->
			<form action="/api/references/confirm" method="post">
				@csrf
				<input type="hidden" name="token" value="{{ $reference->token }}">
				<input type="submit" value="Confirmer la référence">
			</form>
		</div>
	</body>
	
</html>
