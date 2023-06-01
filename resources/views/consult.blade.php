<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head_common')
</head>
<body>
@include('app_common', ['message' => "Références de ".$consult->user->first_name])
<div>
    <div class="user_info">
        <label>Jeune: {{ $consult->user->first_name }} {{ $consult->user->last_name }}</label>
        <label>Email: {{ $consult->user->email }}</label>
        <label>Date de naissance: {{ $consult->user->birth_date }}</label>
    </div>
    <div class="reference_list">
        @foreach($consult->references as $reference)
            <div class="reference">
                <label>Lieu: {{ $reference->area }}</label>
                <label>Référent: {{ $reference->ref_first_name }} {{ $reference->ref_last_name }}</label>
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
</div>
</body>
