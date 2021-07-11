<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class Login extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/login';
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
     * Login user 1.
     *
     * @return void
     */
    public function loginUser1(Browser $browser)
    {
        $browser->visit('/login')
            ->type('email', env('TEST_USER_1_EMAIL'))
            ->type('password', env('TEST_USER_1_PASSWORD'))
            ->press('Log in')
            ->assertPathIs('/dashboard');
    }
}
