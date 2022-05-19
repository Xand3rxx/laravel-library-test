<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['dob'];

    public function path()
    {
        return '/authors/' . $this->id;
    }

    public function setDobAttribute(string $dob)
    {
        $this->attributes['dob'] = Carbon::parse($dob);
    }
}
