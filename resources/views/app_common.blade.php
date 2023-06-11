<!-- This PHP file contains code/structure that's used on almost every page of the website. 
Most notably, the background of the body and the topbar. -->

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

	<!-- This is the area at the top of the page containing the logo and the message, and the account that's in use. -->
    <div id="motto_bar">
        <a href="/home"><img id="logo" src="{{ asset('svg/LOGOS_JEUNES.svg') }}" height="100%" xmlns="http://www.w3.org/2000/svg"/></a>
        <div id="right_side">
            <div id="account_management_area">
                @auth
                    <p id="account_name">{{ substr(Auth::user()["first_name"] . " " . Auth::user()["last_name"],0,34) ?? ""}}</p>
                    <p id="account_separation">-</p>
                    <a id="account_interaction" href="/logout">Se déconnecter</a>
                @else
                    <a id="account_interaction" href="/login">Se connecter</a>
                @endauth
            </div>
            <h1 id="motto_text">{{ $message ?? ""}}</h1>
        </div>
    </div>

	<!-- This is the area at the top of the page containing the tabs that lead to the different pages of the website. -->
    <div id="tab_bar">
        @if(Auth::check() && Auth::user()->admin)
            <a id="admin_button" href="/admin">ADMINISTRATION</a>
        @endif
        <a id="account_button" href="/account">MON COMPTE</a>
        <a id="settings_button" href="/settings">PARAMÈTRES</a>
        <a id="partners_button" href="/partners">PARTENAIRES</a>
    </div>

	<!-- This is the notification system. It's used to display errors and other messages to the user. -->
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


