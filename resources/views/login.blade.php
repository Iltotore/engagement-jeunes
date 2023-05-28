<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	@include('head_common')
	<link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
	@include('app_common', ['message' => "Je m'engage"])

	<div id="account_area_div">
		<div id="login_div" class="account_info_area">
			<form action="/api/login" method="post">
                @csrf
				<fieldset>
					<legend>CONNEXION</legend>
					<input type="hidden" name="redirect" value="{{ request()->get('redirect') ?? '/home' }}">
					<label for="email">Entrer votre adresse mail : <input type="email" name="email" value="{{ old('email') }}" required></label><br>
					<label for="password">Entrer votre mot de passe : <input type="password" name="password" required></label><br>
					<label for="remember">Se souvenir de moi<input type="checkbox" name="remember" value="{{ old('remember') }}"></label>
					<input type="submit" value="Se connecter">
				</fieldset>
			</form>
		</div>
		<div id="register_div" class="account_info_area">
			<form action="/api/register" method="post">
                @csrf
				<fieldset>
					<legend>INSCRIPTION</legend>
					<label for="email">Email : <input type="email" name="email" value="{{ old('email') }}" required></label><br>
					<label for="password">Mot de passe (8 caractères minimum) : <input type="password" name="password" minlength="8" required></label><br>
					<label for="confirm">Confirmer le mot de passe : <input type="password" name="confirm" required></label><br>
					<br>
					<label for="first_name">Prénom : <input type="text" name="first_name" value="{{ old('first_name') }}" required></label><br>
					<label for="last_name">Nom : <input type="text" name="last_name" value="{{ old('last_name') }}" required></label><br>
					<br>
					<label for="birth_date">Date de naissance : <input type="date" name="birth_date" value="{{ old('birth_date') }}" required></label><br>
					<input type="submit" value="S'inscrire">
				</fieldset>
			</form>
		</div>
	</div>
</body>
</html>
