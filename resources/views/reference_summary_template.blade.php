<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<style>
			* {
				font-family: Arial, Helvetica, sans-serif;
			}

			h1 {
				color: rgb(218, 8, 89);
			}

			label {
				font-weight: bold
			}

			div.reference_content {
				margin-left: 20px;
			}

			mark {
				background-color: rgb(218, 8, 89);
				color: white;
				padding: 5px;
			}
		</style>
	</head>
	<body>
		<h1>Liste des références pour <mark>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</mark>:</h1>
		<ol id="reference_area">
			@foreach($references as $reference)
				<li class="reference_list_member">
					<h2>{{ $reference->area }} - {{ $reference->timeDuration() / (24*3600) }} jours</h2>
					<div class="reference_content">
						<label class="summary">Référent : </label>{{ $reference->ref_first_name }} {{ strtoupper($reference->ref_last_name) }}<br>
						<label class="description_summary">Description :</label>
						<p>{{ $reference->description }}</p>
						<label>Lieu : </label>{{ $reference->area }}<br>
						<label>Durée : </label>{{ $reference->timeDuration() / (24*3600) }} jours<br>
						<label>Savoir-faire:</label>
						<ul>
							@foreach($reference->hardSkills() as $skill)
								<li>{{ $skill }}</li>
							@endforeach
						</ul>
						<label>Savoir-être:</label>
						<ul>
							@foreach($reference->softSkills() as $skill)
								<li>{{ $skill }}</li>
							@endforeach
						</ul><br>
					</div>
				</li>
			@endforeach
		</ol>
	</body>
</html>
