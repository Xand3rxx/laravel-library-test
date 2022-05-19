<?php

namespace Tests\Unit;

use App\Models\Author;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A test to determine if dob for author record can be nullable.
     * @test
     * @return void
     */
    public function dob_is_nullable()
    {
        Author::firstOrCreate([
            'name'      => 'Taylor Otwell',
            'country'   => 'USA',
            'dob'       => ''
        ]);

        //Verify if a author record was added
        $this->assertCount(1, Author::all());
    }

    /**
     * A test to determine if name for author record is required.
     * @test
     * @return void
     */
    public function author_name_is_required()
    {
        Author::firstOrCreate([
            'name'      => 'Taylor Otwell',
            'country'   => 'USA',
            'dob'       => '05/14/1988'
        ]);

        //Verify if a author record was added
        $this->assertCount(1, Author::all());
    }
}
