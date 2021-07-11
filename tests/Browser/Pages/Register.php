<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class Register extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/register';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@element' => '#selector',
        ];
    }

    /**
     * Fail register. Check name input validation.
     *
     * @return void
     */
    public function testFailName(Browser $browser)
    {
        $browser->visit('/register')
                ->type('name', '')
                ->type('email', env('TEST_USER_2_EMAIL'))
                ->type('password', env('TEST_USER_2_PASSWORD'))
                ->type('password_confirmation', env('TEST_USER_2_PASSWORD'))
                ->press('Register')
                ->assertPathIs('/register');
    }

    /**
     * Fail register. Check email input validation.
     *
     * @return void
     */
    public function testFailEmail(Browser $browser)
    {
        $browser->visit('/register')
                ->type('name', env('TEST_USER_2_NAME'))
                ->type('email', 'failmail')
                ->type('password', env('TEST_USER_2_PASSWORD'))
                ->type('password_confirmation', env('TEST_USER_2_PASSWORD'))
                ->press('Register')
                ->assertPathIs('/register');
    }

    /**
     * Fail register. Check password input validation.
     *
     * @return void
     */
    public function testFailPassword(Browser $browser)
    {
        $browser->visit('/register')
                ->type('name', env('TEST_USER_2_NAME'))
                ->type('email', env('TEST_USER_2_EMAIL'))
                ->type('password', '123')
                ->type('password_confirmation', env('TEST_USER_2_PASSWORD'))
                ->press('Register')
                ->assertPathIs('/register');
    }

    /**
     * Fail register. Check password_confirm input validation.
     *
     * @return void
     */
    public function testFailPasswordConfirm(Browser $browser)
    {
        $browser->visit('/register')
                ->type('name', env('TEST_USER_2_NAME'))
                ->type('email', env('TEST_USER_2_EMAIL'))
                ->type('password', env('TEST_USER_2_PASSWORD'))
                ->type('password_confirmation', '123')
                ->press('Register')
                ->assertPathIs('/register');
    }

    /**
     * Success register test user 2.
     *
     * @return void
     */
    public function testSuccessRegister(Browser $browser)
    {
        $browser->visit('/register')
                ->type('name', env('TEST_USER_2_NAME'))
                ->type('email', env('TEST_USER_2_EMAIL'))
                ->type('password', env('TEST_USER_2_PASSWORD'))
                ->type('password_confirmation', env('TEST_USER_2_PASSWORD'))
                ->press('Register')
                ->assertPathIs('/dashboard');
    }
}
