<head>
    <script>
        console.log("loaded");
        function closeWidget(widget) {
            widget.remove();
        }
    </script>
</head>
<body>
<div id="top_bars">
    <div id="motto_bar">
        <a href="/home"><img id="logo" src="{{ asset('svg/LOGOS_JEUNES.svg') }}" height="100%"
                             xmlns="http://www.w3.org/2000/svg"/></a>
        <h1 id="motto_text">{{ $message ?? ""}}</h1>
    </div>
    <div id="tab_bar">
        <a id="account_button" href="/account">MON COMPTE</a>
        <a id="settings_button" href="/settings">PARAMÈTRES</a>
        <a id="partners_button" href="/partners">PARTENAIRES</a>
    </div>
    @foreach($errors->all() as $error)
        <div class="notif error">
            <img src="{{ asset('img/white-cross.png') }}" alt="Croix blanche" onclick="closeWidget(this.parentNode)"/>
            <p>{{$error}}</p>
        </div>
    @endforeach

    @foreach(Session::get("notifications") ?? [] as $type => $messages) <!--["ok" => [...], "warn" => [...]]-->
        @foreach($messages as $msg)
            <div class="notif {{ $type }}">
                <img src="{{ asset('img/white-cross.png') }}" alt="Croix blanche" onclick="closeWidget(this.parentNode)"/>
                <p>{{$msg}}</p>
            </div>
        @endforeach
    @endforeach
</div>
</body>


