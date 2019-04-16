<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_can_everyone_visit_login_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://talkinator.test/login')
                    ->assertSee('Login');
        });
    }

    public function test_can_someone_login()
    {
        $this->browse(function (Browser $browser) {

            $user = factory(User::class, 1)->create();

            $browser->visit('http://talkinator.test/login')
                    ->type('email', $user->first()->email)
                    ->type('password', 'secret')
                    ->press("Login")
                    ->assertSee('You are logged in!');
        });
    }
}
