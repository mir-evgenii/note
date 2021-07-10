<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', env('TEST_USER_1_EMAIL'))
                ->type('password', env('TEST_USER_1_PASSWORD'))
                ->press('Log in')
                ->assertPathIs('/dashboard');
        });
    }
}
