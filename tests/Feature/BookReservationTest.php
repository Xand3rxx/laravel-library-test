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
        // Disable exception handling
        $this->withoutExceptionHandling();
        // Execute create book record
        $response = $this->post('/books', [
            'title'     => 'Laravel PHP Framework',
            'author'    => 'Taylor Otwell'
        ]);

        // Check if books table has at least one book record
        $book = Book::first();

        //Verify if a book record was added
        $this->assertCount(1, Book::all());
        $response->assertRedirect($book->path());
    }

    /**
     * A test to update an existing book record in the library.
     * @test
     * @return void
     */
    public function can_update_book_record()
    {
        // Disable exception handling
        // $this->withoutExceptionHandling();

       // Create a new book record
       $this->can_create_book_record();

       // Check if books table has at least one book record
       $book = Book::first();

        // Execute update book record
        $response = $this->patch('/books/' .$book['id'], [
            'title'     => 'Tips for writing clean code in Laravel',
            'author'    => 'Josh Thackeray'
        ]);

        // Check if updated book title and author equals initial book record
        $this->assertEquals('Tips for writing clean code in Laravel', Book::first()->title);
        $this->assertEquals('Josh Thackeray', Book::first()->author);

        // Redirect to book show page
        $response->assertRedirect($book->fresh()->path());
    }

    /**
     * A test to delete an existing book record in the library.
     * @test
     * @return void
     */
    public function can_delete_book_record()
    {
        // Create a new book record
        $this->can_create_book_record();

        // Check if books table has at least one book record
        $book = Book::first();

        //Verify if a book record was added
        $this->assertCount(1, Book::all());

        // Execute delete book record
        $response = $this->delete('/books/' .$book['id']);
        $response->assertStatus(302);

        //Verify if a book record was successfully deleted
        $this->assertCount(0, Book::all());

        // Redirect to book index page
        $response->assertRedirect('/books/');
    }
}
