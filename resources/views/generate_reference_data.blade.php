<!-- {{ Auth::user()->references; }}
</br> -->
<h1>Liste des références pour {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}:</h1>
<div id="reference_area">
	@foreach(Auth::user()->references as $reference)
		<div class="reference_list_member">
			<h2>{{ $reference->area }} pendant {{ $reference->timeDuration() / (24*3600) }} jours</h2>
			<div class="reference_content">
				<label class="summary">Référent : {{ $reference->ref_first_name }} {{ strtoupper($reference->ref_last_name) }}</label><br>
				<label class="description_summary">Description :</label>
				<p>{{ $reference->description }}</p>
				<label>Lieu: {{ $reference->area }}</label><br>
    			<label>Durée: {{ $reference->timeDuration() / (24*3600) }} jours.</label><br>
				<label>Savoir-faire:</label>
				<ul>
					@foreach($reference->hardSkills() as $skill)
						<li>{{ $skill }}</li>
					@endforeach
				</ul><br>
				<label>Savoir-être:</label>
				<ul>
					@foreach($reference->softSkills() as $skill)
						<li>{{ $skill }}</li>
					@endforeach
				</ul><br>
			</div>
		</div>
	@endforeach
</div>