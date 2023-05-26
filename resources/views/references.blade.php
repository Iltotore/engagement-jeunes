<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head_common')
</head>
<body>
@include('app_common', ['message' => "Mes références"])
<div>
    <form action="api/references/add" method="get">
        <fieldset>
            <legend>Références</legend>
            <label for="descritpion">Description : <br><textarea name="description" rows="3" cols="40" style="resize: both;" required></textarea></label><br>
            <label for="area">Lieu : <input type="text" name="area" required></label><br>
            <label for="hard_skills">Savoir faire : <input type="text" name="hard_skills" required></label><br>
            <label for="soft_skills">Savoir être : <input type="text" name="soft_skills" required></label><br>
            <label for="begin_date">Date début : <input type="date" name="begin_date" required></label>
            <label for="end_date">Date fin : <input type="date" name="end_date" required></label><br>
            <label for="email">Email du référent: <input type="email" name="email"  required></label><br>
            <label for="first_name">Prénom du référent: <input type="text" name="first_name"  required></label><br>
            <label for="last_name">Nom du référent: <input type="text" name="last_name"  required></label><br>
            <label for="birth_date">Date de naissance du référent: <input type="date" name="birth_date"  required></label><br><br>
            <input type="submit" value="Ajouter référence">
        </fieldset>
    </form>
</div>

</body>
</html>
