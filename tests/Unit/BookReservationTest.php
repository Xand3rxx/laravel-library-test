<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use App\Models\Author;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A test to assertain that a book can be checked out by a librarian.
     * @test
     * @return void
     */
    public function can_checkout_book()
    {
        // Create book record with factory
        $book = Book::factory()->create();

        // Create borrower user record with factory
        $borrower = User::factory()->create();

        // Create librarian user record with factory
        $user = User::factory()->create();

        // Create checkout record
        $book->checkout($user, $borrower, $book);

        // First reservation record
        $reservation =  Reservation::first();

        $this->assertCount(1, Reservation::all());
        $this->assertEquals($user['id'], $reservation['user_id']);
        $this->assertEquals($borrower['id'], $reservation['borrower_id']);
        $this->assertEquals($book['id'], $reservation['book_id']);
        $this->assertEquals(now(), $reservation['checked_out_time']);
    }

    /**
     * A test to assertain that a book can be checked in by a librarian.
     * @test
     * @return void
     */
    public function can_checkin_book()
    {
        // Create book record with factory
        $book = Book::factory()->create();

        // Create borrower user record with factory
        $borrower = User::factory()->create();

        // Create librarian user record with factory
        $user = User::factory()->create();

        // Create checkout record
        $book->checkout($user, $borrower, $book);

        // Create checkin record
        $book->checkin($user, $borrower, $book);

        // First reservation record
        $reservation =  Reservation::first();

        $this->assertCount(1, Reservation::all());
        $this->assertEquals($user['id'], $reservation['user_id']);
        $this->assertEquals($borrower['id'], $reservation['borrower_id']);
        $this->assertEquals($book['id'], $reservation['book_id']);
        $this->assertNotNull($reservation['checked_in_time']);
        $this->assertEquals(now(), $reservation['checked_in_time']);
    }

    /**
     * A test to assertain that a book can be checked out by a librarian.
     * @test
     * @return void
     */
    public function throw_exception_if_book_is_not_checkedout()
    {
        // Throw exception
        $this->expectException(\Exception::class);

        // Create book record with factory
        $book = Book::factory()->create();

        // Create borrower user record with factory
        $borrower = User::factory()->create();

        // Create librarian user record with factory
        $user = User::factory()->create();

        // Create checkin record
        $book->checkin($user, $borrower, $book);
    }

    /**
     * A test to assertain that a book can be checked more than once.
     * @test
     * @return void
     */
    public function can_checkout_book_again()
    {
        // Create book record with factory
        $book = Book::factory()->create();

        // Create borrower user record with factory
        $borrower = User::factory()->create();

        // Create librarian user record with factory
        $user = User::factory()->create();

        // Create checkout record
        $book->checkout($user, $borrower, $book);

        // Create checkin record
        $book->checkin($user, $borrower, $book);

        // Create another checkout record
        $book->checkout($user, $borrower, $book);

        // First reservation record
        $reservation =  Reservation::find(2);

        $this->assertCount(2, Reservation::all());
        $this->assertEquals($user['id'], $reservation['user_id']);
        $this->assertEquals($borrower['id'], $reservation['borrower_id']);
        $this->assertEquals($book['id'], $reservation['book_id']);
        $this->assertNull($reservation['checked_in_time']);
        $this->assertEquals(now(), $reservation['checked_out_time']);

        // Create checkin record
        $book->checkin($user, $borrower, $book);
        $reservation =  $reservation->fresh();

        $this->assertCount(2, Reservation::all());
        $this->assertEquals($user['id'], $reservation['user_id']);
        $this->assertEquals($borrower['id'], $reservation['borrower_id']);
        $this->assertEquals($book['id'], $reservation['book_id']);
        $this->assertNotNull($reservation['checked_in_time']);
        $this->assertEquals(now(), $reservation['checked_in_time']);
    }
}
