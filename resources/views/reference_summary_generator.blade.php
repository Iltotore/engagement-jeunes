<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		@include('head_common')
	</head>
	<body>
		@include('app_common', ['message' => "Je résume mes engagements"])
		<form action="/references/summarize" method="post">
			@csrf

			<fieldset>
				@foreach(Auth::user()->references as $ref)
					<div class="reference">
						<input class="select" name="{{ $ref->id }}" type="checkbox" checked>
						<div class="reference_content">
							<label class="summary">{{ $ref->ref_first_name }} {{ strtoupper($ref->ref_last_name) }}: {{ $ref->area }}</label><br>
							<label class="description_summary">{{ trim(substr($ref->description, 0, 30)) }}...</label>
						</div>
					</div>
				@endforeach

				<input type="radio" name="summary_type" value="PDF" checked><label for="PDF">PDF</label></br>
				<input type="radio" name="summary_type" value="HTML"><label for="HTML">HTML</label></br>
				<input type="submit" value="Générer le résumé">
			</fieldset>
    	</form>
	</body>
</html>