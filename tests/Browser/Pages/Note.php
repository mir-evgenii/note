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
    public function createNewNote(Browser $browser, $title, $content)
    {
        $browser->visit('/note')
                ->click('@new-note')
                ->type('@title', $title)
                ->type('@content', $content)
                ->click('@save')
                ->assertSee($title);
    }

    /**
     * Update note.
     *
     * @return void
     */
    public function updateNote(Browser $browser, $title, $content)
    {
        
    }
}
