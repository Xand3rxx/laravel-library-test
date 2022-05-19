<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Author;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A test to create a new author record.
     * @test
     * @return void
     */
    public function can_create_author_record()
    {
        // Disable exception handling
        $this->withoutExceptionHandling();

        // Execute create author record
        $response = $this->post('/authors', [
            'name'      => 'Taylor Otwell',
            'country'   => 'USA',
            'dob'       => '05/14/1988'
        ]);

        // Check if authors table has at least one author record
        $author = Author::all();

        //Verify if a author record was added
        $this->assertCount(1, $author);

        $this->assertInstanceOf(Carbon::class, $author->first()->dob);

        // Check if created author dob equals a specific date format
        $this->assertEquals('1988/14/05', $author->first()->dob->format('Y/d/m'));

        // Redirect to book show page
        $response->assertRedirect($author->first()->path());
    }
}
