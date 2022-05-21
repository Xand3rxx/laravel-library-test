<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookCheckoutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A test to assertain that a book can be checked out by an authenticated user.
     * @test
     * @var \Illuminate\Contracts\Auth\Authenticatable $user
     * @return void
     */
    public function authenticated_user_can_checkout_book()
    {
        // Disable exception handling
        $this->withoutExceptionHandling();

        $this->actingAs($this->data()['user'], 'web')->post('/reservations', $data = $this->data());

        // First reservation record
        $reservation =  Reservation::first();

        $this->assertCount(1, Reservation::all());
        $this->assertEquals($data['user_id'], $reservation['user_id']);
        $this->assertEquals($data['borrower_id'], $reservation['borrower_id']);
        $this->assertEquals($data['book_id'], $reservation['book_id']);
        $this->assertEquals(now(), $reservation['checked_out_time']);
    }

    /**
     * A test to assertain that a book can only be checked out by an authenticated user.
     * @test
     * @return void
     */
    public function only_authenticated_user_can_checkout_book()
    {
        $this->post('/reservations', $this->data())
            ->assertRedirect('/login');

        $this->assertCount(0, Reservation::all());
    }

    // /**
    //  * A test to assertain that a book id exost in the database
    //  * @test
    //  * @return voidd
    //  */
    // public function book_id_exists()
    // {
    //     $this->get('/books/', ['124'])
    //     ->assertStatus(404);

    //     $this->assertCount(0, Reservation::all());
    // }

    /**
     * A test to assertain that a book can be checked in by an authenticated user.
     * @test
     * @var \Illuminate\Contracts\Auth\Authenticatable $user
     * @return void
     */
    public function authenticated_user_can_checkin_book()
    {
        // Disable exception handling
        $this->withoutExceptionHandling();

        // Create reaervation record
        $this->actingAs($this->data()['user'], 'web')->post('/reservations', $data = $this->data());

        $reservation =  Reservation::first();

        // Update reservation record
        $com = $this->actingAs($data['user'], 'web')->patch($reservation->path(), array_merge((array) $data, ['checked_in_time' => now()]));
        // $reservation->update(['checked_in_time' => now()]);

        // New first reservation record
        // $reservation =  $reservation->fresh();
        // dd($reservation);

        $this->assertCount(1, Reservation::all());
        $this->assertEquals($data['user_id'], $reservation['user_id']);
        $this->assertEquals($data['borrower_id'], $reservation['borrower_id']);
        $this->assertEquals($data['book_id'], $reservation['book_id']);
        $this->assertEquals(now(), $reservation['checked_out_time']);
        $this->assertEquals(now(), $reservation['checked_in_time']);
    }

    private function data()
    {
        // dd($book);

        // Create book record with factory
        $book = Book::factory()->create();

        // Create borrower user record with factory
        $borrower = User::factory()->create();

        /**
         * Create user record with factory.
         * @var \Illuminate\Contracts\Auth\Authenticatable $user
         */
        $user = User::factory()->create();

        return [
            'user_id'           => $user['id'],
            'borrower_id'       => $borrower['id'],
            'book_id'           => $book['id'],
            'checked_out_time'  => now(),
            'user'              => $user
        ];
    }
}
