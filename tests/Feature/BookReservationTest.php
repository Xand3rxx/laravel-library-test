<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A test to assertain that a book title is required to create a new book record in the library.
     * @test
     * @return void
     */
    public function book_title_is_required()
    {
        // Disable exception handling
        // $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title'     => '',
            'author'    => 'John Doe'
        ]);

        $response->assertSessionHasErrors('title');
    }

    /**
     * A test to assertain that a book author is required to create a new book record in the library.
     * @test
     * @return void
     */
    public function book_author_is_required()
    {
        $response = $this->post('/books', [
            'title'     => 'How to make money',
            'author'    => '',
        ]);

        $response->assertSessionHasErrors('author');
    }


    /**
     * A test to create a new book record in the library.
     * @test
     * @return void
     */
    public function can_create_book_record()
    {
        $response = $this->post('/books', [
            'title'     => 'Laravel PHP Framework',
            'author'    => 'Taylor Otwell'
        ]);

        $response->assertStatus(201);
        $this->assertCount(1, Book::all());
    }

    /**
     * A test to update an existing book record in the library.
     * @test
     * @return void
     */
    public function can_update_book_record()
    {
        // Disable exception handling
        $this->withoutExceptionHandling();

        $this->post('/books', [
            'title'     => 'Laravel PHP Framework',
            'author'    => 'Taylor Otwell'
        ]);

        $book = Book::first();

        $response = $this->patch('/books/' .$book['id'], [
            'title'     => 'Tips for writing clean code in Laravel',
            'author'    => 'Josh Thackeray'
        ]);

        $this->assertEquals('Tips for writing clean code in Laravel', Book::first()->title);
        $this->assertEquals('Josh Thackeray', Book::first()->author);
    }
}
