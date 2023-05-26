<div id="top_bars">
	<div id="motto_bar">
		<a href="/home"><img id="logo" src="{{ asset('svg/LOGOS_JEUNES.svg') }}" height="100%" xmlns="http://www.w3.org/2000/svg"/></a>
		<h1 id="motto_text">{{ $message ?? ""}}</h1>
	</div>
	<div id="tab_bar">
		<a id="jeune_button" href="/jeune">JEUNE</a>
		<a id="referent_button" href="/referent">RÉFÉRENT</a>
		<a id="consultant_button" href="/consultant">CONSULTANT</a>
		<a id="partners_button" href="/partners">PARTENAIRES</a>
	</div>
</div>
@foreach($errors->all() as $error)
    <label class="error">{{ $error }}</label><br>
@endforeach
