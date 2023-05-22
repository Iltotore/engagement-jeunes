<link rel="icon" type="image/svg+xml" href="{{ asset('svg/LOGOS_JEUNES_ICON.svg') }}">
<title>JEUNES 6.4</title>
<meta charset="utf-8">

<style>
	body {
		--color1: #fafafa;
		--color2: #eaeaea;
		--dark-color: #cbcbcb;
		--less-dark-color: #cfcfcf;

		--jeune-color: rgb(218, 8, 89);
		--referent-color: green;
		--consultant-color: rgb(0, 153, 255);
		--partners-color: grey;

		--jeune-alt-color: rgb(255, 207, 225);
		--referent-alt-color: rgb(182, 214, 38);
		--consultant-alt-color: rgb(177, 224, 255);

		margin: 0;
		text-align:center;
		font-family: 'Arial', sans-serif;
		overflow: auto;
		background-image: radial-gradient(circle at top, rgba(250,250,250,1) 90%, rgba(210,210,210,1) 99%);

		/* Prevents the background from not filling the whole page */
		/* Raphaël, please don't remove this again. ;) */
		min-height: 100vh;
	}

	div#motto_bar {
		height: 10vw;
		min-height: 100px;

		display: flex;
		flex-direction: row;
		vertical-align: bottom;
		text-align: left;
		max-width: 100vw;
		background-image: radial-gradient(circle at bottom 0% left 21%, var(--color1) , var(--dark-color) 20%);
	}

	img#logo {
		height: 100%;
		margin-left: 2.5%;
	}

	h1#motto_text {
		justify-content: right;
		text-align: right;
		letter-spacing: 0.05em;
		font-weight:1;
		margin-bottom: 0.5em;
		margin-top: 0em;
		margin-right: 0.7em;
		margin-left: auto;
		font-size: max(2.7vw,1.5em);
		color: white;
		align-self: flex-end;
	}

	div#tab_bar {
		display: flex;
		margin-left: auto;
		margin-right: auto;
		flex-orientation: row;
		text-align: center;

		width: fit-content;

		justify-content: center;
		max-height: fit-content;
		background-image: radial-gradient(circle at top 0% left 20%, var(--color2), var(--less-dark-color) 40%);

		gap: 3vw;
		padding-left: 3vw;
		padding-right: 3vw;
		padding-top: 0.8vw;
		padding-bottom: 0.8vw;
	}

	div#tab_bar a {
		flex-grow: 1;
		text-decoration: none;
		font-weight: lighter;
		font-size: max(1.3vw,1em);
	}

	a#jeune_button {
		color: var(--jeune-color)
	}

	a#referent_button {
		color: var(--referent-color)
	}

	a#consultant_button {
		color: var(--consultant-color)
	}

	a#partners_button {
		color: var(--partners-color)
	}
</style>
