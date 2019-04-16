<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Support\Str;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_can_everyone_visit_register_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://talkinator.test/register')
                    ->assertSee('Register');
        });
    }

    public function test_can_someone_register()
    {
        $this->browse(function (Browser $browser) {
            $user       = factory(User::class, 1)->make();
            $randomPass = Str::random(15);

            $browser->visit('http://talkinator.test/register')
                    ->type('username', $user->first()->username)
                    ->type('email', $user->first()->email)
                    ->type('password', $randomPass)
                    ->type('password_confirmation', $randomPass)
                    ->press('Register')
                    ->assertSee('You are logged in!');
        });
    }

    public function test_is_error_displayed_when_passwords_dont_match()
    {
        $this->browse(function (Browser $browser) {
            $user       = factory(User::class, 1)->make();
            $randomPass = Str::random(15);

            $browser->visit('http://talkinator.test/register')
                    ->type('username', $user->first()->username)
                    ->type('email', $user->first()->email)
                    ->type('password', $randomPass)
                    ->type('password_confirmation', $randomPass . '1234')
                    ->press('Register')
                    ->assertSee("The password confirmation does not match.");
        });
    }

    public function test_is_error_displayed_when_username_is_already_taken()
    {
        $this->browse(function (Browser $browser) {
            $user       = factory(User::class, 1)->create();
            $randomPass = Str::random(15);

            $browser->visit('http://talkinator.test/logout');

            $browser->visit('http://talkinator.test/register')
                    ->type('username', $user->first()->username)
                    ->type('email', "test@test.com")
                    ->type('password', $randomPass)
                    ->type('password_confirmation', $randomPass)
                    ->press('Register')
                    ->assertSee("The username has already been taken.");
        });
    }

    public function test_is_error_displayed_when_email_is_already_taken()
    {
        $this->browse(function (Browser $browser) {
            $user = factory(User::class, 1)->create();
            $randomPass = Str::random(15);

            $browser->visit('http://talkinator.test/logout');

            $browser->visit('http://talkinator.test/register')
                    ->type('username', "TestUser")
                    ->type('email', $user->first()->email)
                    ->type('password', $randomPass)
                    ->type('password_confirmation', $randomPass)
                    ->press('Register')
                    ->assertSee("The email has already been taken.");
        });
    }
}
