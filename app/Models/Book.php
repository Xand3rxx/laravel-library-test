<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function path()
    {
        // return '/books/' . $this->id.'-'.Str::slug($this->title);
        return '/books/' . $this->id;
    }

    public static function checkout($user, $borrower, $book)
    {
        $book->reservations()->create([
            'user_id'           => $user['id'],
            'borrower_id'       => $borrower['id'],
            'book_id'           => $book['id'],
            'checked_out_time'  => now(),
        ]);
    }

    public static function checkin($user, $borrower, $book)
    {
        $bookInstance = $book->fresh()->first();

        // Find where librarian id, borrower id, and book id is not checked in
        $reservation = \App\Models\Reservation::where([
            // $reservation = $bookInstance->reservations()->where([
            'user_id'           => $user['id'],
            'borrower_id'       => $borrower['id'],
            'book_id'           => $book['id'],
        ])->whereNotNull('checked_out_time')
            ->whereNull('checked_in_time')
            ->first();

        // Check if reservation was initially created for this book
        if (is_null($reservation)) {
            throw new \Exception();
        }

        // Update checked in time
        $reservation->update([
            'checked_in_time'  => now(),
        ]);
    }

    public function setAuthorIdAttribute($author)
    {
        $this->attributes['author_id'] = (Author::firstOrCreate([
            'name'      => $author,
            'country'   => 'USA',
            'dob'       => '05/14/1988'
        ]))->id;
    }

    /**
     * Get the author who created a member
     */
    public function author()
    {
        return $this->belongsTo(Author::class, 'id', 'author_id');
    }

    /**
     * Get the reservations related to a book
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'id', 'book_id');
    }
}
