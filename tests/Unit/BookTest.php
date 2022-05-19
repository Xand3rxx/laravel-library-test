<?php

namespace Tests\Unit;

use App\Models\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A test to determine if an an author id can be recorded for a new book record.
     * @test
     * @return void
     */
    public function author_id_is_created()
    {
        Book::create([
            'title'     => 'Laravel PHP Framework',
            'author_id' => 1,
        ]);

        //Verify if a author record was added
        $this->assertCount(1, Book::all());
    }
}
