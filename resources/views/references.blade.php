<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		@include('head_common')
		<link rel="stylesheet" href="{{ asset('css/references.css') }}">
		<script src="{{ asset('js/references.js') }}"></script>
		<script src="{{ asset('js/skill.js') }}"></script>
	</head>

	<body>
		<!-- This is the page that displays the references of a user, along with his consultations. Along with ways to manage them. -->

		@include('app_common', ['message' => "Mes références"])
		<div id="account_management_divs">
			<!-- The reference management area of the user panel -->
			<div id="reference_zone" class="account_settings_area">
				<div>

					<!-- Hidden forms used by the JS side to perform requests from other kinds of HTML elements or fake forms -->
					<div hidden>
						<form id="add_form" action="api/references/add" method="post" hidden>
							@csrf
							<label for="descritpion">Description :
								<br>
								<textarea name="description" rows="3" cols="40" style="resize: both;" required></textarea>
							</label><br>
							<label for="area">Lieu :<input type="text" name="area" required></label>
							<label for="hard_skills">Savoir faire :<input type="text" name="hard_skills" required></label>
							<label for="soft_skills">Savoir être :<input type="text" name="soft_skills" required></label>
							<label for="begin_date">Date début :<input type="date" name="begin_date" required></label>
							<label for="end_date">Date fin :<input type="date" name="end_date" required></label>
							<label for="email">Email du référent:<input type="email" name="email" required></label>
							<label for="first_name">Prénom du référent:<input type="text" name="first_name" required></label>
							<label for="last_name">Nom du référent:<input type="text" name="last_name" required></label>
							<label for="birth_date">Date de naissance du référent:<input type="date" name="birth_date" required></label>
						</form>

						<form id="ref_remove_form" action="/api/references/remove" method="post">
							@csrf
							<input name="selected" type="text">
						</form>

						<form id="ref_send_form" action="/api/references/send" method="post">
							@csrf
							<input name="selected" type="text">
							<input name="email" type="email">
							<input name="duration" type="number">
						</form>

						<form id="consult_remove_form" action="/api/consults/remove" method="post">
							@csrf
							<input name="selected" type="text">
						</form>

						<form id="generation_form" action="/references/summarize" method="post">
							@csrf
							<input name="selected" type="text">
							<input type="radio" name="summary_type" value="PDF" checked>
							<label for="PDF">PDF</label>
							<input type="radio" name="summary_type" value="HTML">
							<label for="HTML">HTML</label>
						</form>
					</div>

					<h1>Liste des références</h1>

					<!-- Reference management buttons -->
					<div class="reference_actions">
						<button class="account_area_button" onclick="toggleAddMenu()">Ajouter</button>
						<button class="account_area_button" onclick="removeSelectedReferences()">Supprimer</button>
						<button class="account_area_button" onclick="toggleConsultMenu()">Envoyer à un consultant</button>
						<button class="account_area_button" onclick="toggleMenu(document.getElementById('generation_menu'))">Générer une page de résumé</button>
					</div>

					<!-- Reference management menus -->
					<div id="actions_menu">
							<fieldset id="add_menu" hidden>
								<legend>Ajouter une référence</legend>
								<label for="descritpion">Description :
									<br>
									<textarea name="description" rows="3" cols="40" style="resize: both;" required></textarea>
								</label>
								<br><br>
								<label for="area">Lieu :
									<input type="text" name="area" required>
								</label>
								<br><br>
								<label>Savoir-faire:</label>
								<div id="hard_skill_div">
									<input name="hard_skill" type="text">
									<button onclick="addSkill('hard')">Ajouter</button>
									<ul id="hard_skills">
									</ul>
								</div>
								<label>Savoir-être:</label>
								<div id="soft_skill_div">
									<input name="soft_skill" type="text">
									<button onclick="addSkill('soft')">Ajouter</button>
									<ul id="soft_skills">
									</ul>
								</div>
								<label for="begin_date">Date début :<input type="date" name="begin_date" required></label>
								<label for="end_date">Date fin :<input type="date" name="end_date" required></label><br><br>
								<label for="email">Email du référent:<input type="email" name="email" required></label><br>
								<label for="first_name">Prénom du référent:<input type="text" name="first_name" required></label><br>
								<label for="last_name">Nom du référent:<input type="text" name="last_name" required></label><br>
								<label for="birth_date">Date de naissance du référent:<input type="date" name="birth_date" required></label><br>
								<br>
								<button onclick="addReference()">Ajouter la référence</button>
							</fieldset>
							<fieldset id="consult_menu" hidden>
								<legend>Envoyer à un consultant</legend>
								<label for="email">Email: <input name="email" type="email"></label>
								<label for="duration">
									Expire dans: 
									<select name="duration">
										<option value="1">1 Jour</option>
										<option value="7" selected>1 Semaine</option>
										<option value="14">2 Semaines</option>
										<option value="30">1 Mois</option>
									</select>
								</label>
								<button onclick="sendReferences()">Envoyer</button>
							</fieldset>

							<div id="generation_menu" hidden>
								<fieldset>
									<legend>Générer une page de résumé</legend>
									<input type="radio" name="summary_type" value="PDF" checked>
									<label for="PDF">PDF</label>
									</br>
									<input type="radio" name="summary_type" value="HTML">
									<label for="HTML">HTML</label>
									</br>
									<button onclick="generateSummary()">Générer le résumé</button>
								</fieldset>
							</div>
						</div>
				</div>

				<!-- The reference list of the user panel -->
				<div class="reference_list">
					@foreach(Auth::user()->references as $ref)
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
				</div>
			</div>

			<!-- The consultation management area of the user panel -->
			<div id="consultation_zone" class="account_settings_area">
				<h1>Liste des consultations</h1>
				<div class="consult_actions">
					<button class="account_area_button" onclick="removeSelectedConsults()">Supprimer</button>
				</div>
				<div class="consult_list">
					@foreach(Auth::user()->consults as $consult)
						<div class="consult">
							<input class="select" name="{{ $consult->id }}" type="checkbox">
							<div class="consult_content">
								<label>Envoyée à : {{ $consult->email }}</label></br>
								<label>Références : </label>
								<button onclick="toggleReferences(this)">+</button>
								<ul class="reference_container" hidden>
									@foreach($consult->references as $ref)
										<li class="reference_content">
											<label class="summary">Référent : {{ $ref->ref_first_name }} {{ strtoupper($ref->ref_last_name) }}</label></br>
											<label>Lieu : {{ $ref->area }}</label></br>
											</br>
											<label class="description_summary">{{ trim(substr($ref->description, 0, 30)) }}...</label>
										</li>
									@endforeach
								</ul>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</body>

</html>
