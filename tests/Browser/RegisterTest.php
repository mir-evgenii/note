<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    /**
     * Fail register. Check name input validation.
     *
     * @return void
     */
    public function testFailName()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', '')
                    ->type('email', env('TEST_USER_2_EMAIL'))
                    ->type('password', env('TEST_USER_2_PASSWORD'))
                    ->type('password_confirmation', env('TEST_USER_2_PASSWORD'))
                    ->press('Register')
                    ->assertPathIs('/register');
        });
    }

    /**
     * Fail register. Check email input validation.
     *
     * @return void
     */
    public function testFailEmail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', env('TEST_USER_2_NAME'))
                    ->type('email', 'failmail')
                    ->type('password', env('TEST_USER_2_PASSWORD'))
                    ->type('password_confirmation', env('TEST_USER_2_PASSWORD'))
                    ->press('Register')
                    ->assertPathIs('/register');
        });
    }

    /**
     * Fail register. Check password input validation.
     *
     * @return void
     */
    public function testFailPassword()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', env('TEST_USER_2_NAME'))
                    ->type('email', env('TEST_USER_2_EMAIL'))
                    ->type('password', '123')
                    ->type('password_confirmation', env('TEST_USER_2_PASSWORD'))
                    ->press('Register')
                    ->assertPathIs('/register');
        });
    }

    /**
     * Fail register. Check password_confirm input validation.
     *
     * @return void
     */
    public function testFailPasswordConfirm()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', env('TEST_USER_2_NAME'))
                    ->type('email', env('TEST_USER_2_EMAIL'))
                    ->type('password', env('TEST_USER_2_PASSWORD'))
                    ->type('password_confirmation', '123')
                    ->press('Register')
                    ->assertPathIs('/register');
        });
    }

    /**
     * Success register test user 2.
     *
     * @return void
     */
    public function testSuccessRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', env('TEST_USER_2_NAME'))
                    ->type('email', env('TEST_USER_2_EMAIL'))
                    ->type('password', env('TEST_USER_2_PASSWORD'))
                    ->type('password_confirmation', env('TEST_USER_2_PASSWORD'))
                    ->press('Register')
                    ->assertPathIs('/dashboard');
        });
    }
}
