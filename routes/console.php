<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command("user:register {mail} {password} {firstName} {lastName} {birthDate}", function (string $mail, string $password, string $firstName, string $lastName, string $birthDate) {
    User::create(["email" => $mail, "password" => $password, "first_name" => $firstName, "last_name" => $lastName, "birth_date" => $birthDate]);
    info("Registered: $mail, $password, $firstName, $lastName, $birthDate");
})->purpose("Register a user");

Artisan::command("mail:send {to} {subject} {content}", function(string $to, string $subject, string $content) {
    echo $to;
    Mail::raw($content, function ($m) use($to, $subject, $content) {
        $m->to($to)->subject($subject);
    });
})->purpose("Send a mail");
