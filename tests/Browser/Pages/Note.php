<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class Note extends Page
{
    const PAUSE = 300;

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
                ->pause(self::PAUSE)
                ->type('@title', $title)
                ->type('@content', $content)
                ->pause(self::PAUSE)
                ->click('@save')
                ->assertSee($title);
    }

    /**
     * Update note.
     *
     * @return void
     */
    public function updateNote(Browser $browser, $oldTitle, $newTitle, $content)
    {
        $browser->visit('/note')
                ->click("@edit-note {$oldTitle}")
                ->clear('@title-edit')
                ->type('@title-edit', $newTitle)
                ->clear('@content-edit')
                ->type('@content-edit', $content)
                ->pause(self::PAUSE)
                ->click('@save-edit')
                ->assertSee($newTitle);
    }

    /**
     * Delete note in edit form.
     *
     * @return void
     */
    public function deleteNote(Browser $browser, $title)
    {
        $browser->visit('/note')
                ->click("@edit-note {$title}")
                ->pause(self::PAUSE)
                ->click('@delete-edit')
                ->pause(self::PAUSE)
                ->assertSee("Do you really want to delete note: \"{$title}\"")
                ->click('@confirm-delete-edit')
                ->pause(self::PAUSE)
                ->assertDontSee($title);
    }
}
