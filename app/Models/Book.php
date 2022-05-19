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
}
