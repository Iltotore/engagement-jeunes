<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head_common')
</head>
<body>
@include('app_common', ['message' => "Référence de ".$reference->user->first_name])
@foreach($errors->all() as $error)
    <label class="error">{{ $error }}</label><br>
@endforeach
<div>
    <label>Jeune: {{ $reference->user->first_name }} {{ $reference->user->last_name }}</label><br>
    <label>Description:</label><br>
    <p>{{ $reference->description }}</p>
    <label>Lieu: {{ $reference->area }}</label><br>
    <label>Durée: {{ $reference->timeDuration() / (24*3600) }} jours</label><br>
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
</body>
</html>