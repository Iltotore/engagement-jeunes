<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ValidationTest extends TestCase {
    use RefreshDatabase;

    private function register(string|null $email = null, string|null $password = null, string|null $confirm = null, string|null $firstName = null, string|null $lastName = null, string|null $birthDate = null): TestResponse {
        $password = $password == null ? fake()->password(8, 50) : $password;

        return $this->post("/api/register", data: [
            "email" => $email == null ? fake()->email() : $email,
            "password" => $password,
            "confirm" => $confirm == null ? $password : $confirm,
            "first_name" => $firstName == null ? fake()->firstName() : $firstName,
            "last_name" => $lastName == null ? fake()->lastName() : $lastName,
            "birth_date" => $birthDate == null ? fake()->dateTimeBetween("1970-01-01 - 30 years", "1970-01-01 - 16 years")->format("Y-m-d") : $birthDate
        ]);
    }

    private function addReference(string|null $description = null, string|null $area = null, string|null $hardSkills = null, string|null $softSkills = null, string|null $beginDate = null, string|null $endDate = null, string|null $email = null, string|null $firstName = null, string|null $lastName = null, string|null $birthDate = null) {

        $beginDate = $beginDate == null ? fake()->date() : $beginDate;

        return $this->post("/api/references/add", data: [
            "description" => $description == null ? fake()->sentence(5) : $description,
            "area" => $area == null ? fake()->word() : $area,
            "hard_skills" => $hardSkills == null ? implode(",", fake()->words(6)) : $hardSkills,
            "soft_skills" => $softSkills == null ? implode(",", fake()->words(6)) : $softSkills,
            "begin_date" => $beginDate,
            "end_date" => $endDate == null ? "$beginDate + 1month" : $endDate,
            "email" => $email == null ? fake()->email() : $email,
            "first_name" => $firstName == null ? fake()->firstName() : $firstName,
            "last_name" => $lastName == null ? fake()->lastName() : $lastName,
            "birth_date" => $birthDate == null ? fake()->date() : $birthDate,
        ]);
    }

    public function test_register_email(): void {
        $this->register(email: fake()->word())->assertSessionHasErrors();
        $this->register(email: fake()->email())->assertSessionDoesntHaveErrors();
    }

    public function test_register_password(): void {
        $this->register(password: "abc")->assertSessionHasErrors();
        $this->register(password: fake()->password(51, 51))->assertSessionHasErrors();
        $this->register(password: "abcd1234", confirm: "abcd1235")->assertSessionHasErrors();
        $this->register(password: fake()->password(8, 50))->assertSessionDoesntHaveErrors();
    }

    public function test_register_first_name(): void {
        $this->register(firstName: "Simon01")->assertSessionHasErrors();
        $this->register(firstName: "Simon_Marc")->assertSessionHasErrors();
        $this->register(firstName: "Simon")->assertSessionDoesntHaveErrors();
        $this->register(firstName: "Raphaël")->assertSessionDoesntHaveErrors();
        $this->register(firstName: "Jean-Paul")->assertSessionDoesntHaveErrors();
        $this->register(firstName: "Raphaël Marc Jean Paul")->assertSessionDoesntHaveErrors();
    }

    public function test_register_last_name(): void {
        $this->register(lastName: "Simon01")->assertSessionHasErrors();
        $this->register(lastName: "Simon_Marc")->assertSessionHasErrors();
        $this->register(lastName: "Simon")->assertSessionDoesntHaveErrors();
        $this->register(lastName: "Raphaël")->assertSessionDoesntHaveErrors();
        $this->register(lastName: "Jean-Paul")->assertSessionDoesntHaveErrors();
        $this->register(lastName: "Raphaël Marc Jean Paul")->assertSessionDoesntHaveErrors();
    }

    public function test_register_birth_date(): void {
        $this->register(birthDate: "1970-01-01 - 31 years")->assertSessionHasErrors();
        $this->register(birthDate: "1970-01-01 - 15 years")->assertSessionHasErrors();
        $this->register(birthDate: "1970-01-01 - 20 years")->assertSessionDoesntHaveErrors();
    }

    public function test_reference_description(): void {
        $user = User::factory()->create();
        Auth::login($user);

        $this->addReference(description: str_repeat("a", 101))->assertSessionHasErrors();
        $this->addReference(description: str_repeat("a", 30))->assertSessionDoesntHaveErrors();
    }

    public function test_reference_area() {
        $user = User::factory()->create();
        Auth::login($user);

        $this->addReference(area: str_repeat("a", 511))->assertSessionHasErrors();
        $this->addReference(area: str_repeat("a", 30))->assertSessionDoesntHaveErrors();
    }

    public function test_reference_date(): void {
        $user = User::factory()->create();
        Auth::login($user);

        $begin = fake()->date();
        $this->addReference(beginDate: $begin, endDate: "$begin - 1month")->assertSessionHasErrors();
        $this->addReference(beginDate: $begin, endDate: "$begin + 1month")->assertSessionDoesntHaveErrors();
    }
}
