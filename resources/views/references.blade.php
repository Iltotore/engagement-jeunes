<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head_common')
</head>
<body>
@include('app_common', ['message' => "Mes références"])
@foreach($errors->all() as $error)
    <label class="error">{{ $error }}</label><br>
@endforeach

<div>
    <form action="/references" method="post">
        @csrf
        <fieldset>
            <legend>Références</legend>
            <label for="descritpion">Description : <br><textarea name="description" rows="3" cols="40" style="resize: both;" required></textarea></label><br>
            <label for="area">Lieu : <input type="text" name="area" required></label><br>
            <label for="hard_skill">Savoir faire : <input type="text" name="hard_skill" required></label><br>
            <label for="soft_skill">Savoir être : <input type="text" name="soft_skill" required></label><br>
            <label for="duration">Date début : <input type="date" name="duration" required></label>
            <label for="duration">Date fin : <input type="date" name="duration" required></label><br>
            <label for="email">Email : <input type="email" name="email"  required></label><br>
            <label for="first_name">Prénom : <input type="text" name="first_name"  required></label><br>
            <label for="last_name">Nom : <input type="text" name="last_name"  required></label><br>
            <label for="birth_date">Date de naissance : <input type="date" name="birth_date"  required></label><br><br>
            <input type="submit" value="Ajouter référence">
        </fieldset>
    </form>
</div>

</body>
</html>
