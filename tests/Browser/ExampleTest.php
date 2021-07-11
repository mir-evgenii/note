<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Pages\Login;
use Tests\Browser\Pages\Register;
use Tests\Browser\Pages\Note;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new Login)
                    ->loginUser1()
                    ->visit(new Note)
                    // ->createNewNote('Title 123', 'Content.')
                    ->updateNote('Title 123', 'Title 1234', 'Content 123.');
        });
    }
}
