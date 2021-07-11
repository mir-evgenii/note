<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class Note extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/note';
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
     * Create new note.
     *
     * @return void
     */
    public function testNewNote(Browser $browser)
    {
        $browser->visit('/note')
                ->click('body > div.navbar.fixed-top.navbar-light.bg-light.border-bottom > nav > button')
                ->type('title', 'Title new note 1')
                ->type('content', 'Content new note.')
                ->click('Save')
                ->assertSee('Title new note 1');
    }
}
