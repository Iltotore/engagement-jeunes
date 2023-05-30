<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head_common')
</head>
<body>
@include('app_common', ['message' => "Références de ".$consult->user->first_name])
<div>
    @foreach($consult->references as $reference)
        <div class="reference">
            <label>Lieu: {{ $reference->area }}</label>
            <label>Durée: {{ $reference->timeDuration() / (24*3600) }} jours</label>
            <label>Description:</label>
            <p>{{ $reference->description }}</p>
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
            </ul>
        </div>
    @endforeach
</div>
</body>