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
        $response = $this->post('/authors', $this->data());

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

    /**
     * A test to determine if author name is provided.
     * @test
     * @return void
     */
    public function name_of_author_is_required()
    {
        $response = $this->post('/authors', array_merge($this->data(), ['name' => '']));

        $response->assertSessionHasErrors('name');
    }

    /**
     * A test to determine if author country is provided.
     * @test
     * @return void
     */
    public function country_of_author_is_required()
    {
        $response = $this->post('/authors', array_merge($this->data(), ['country' => '']));

        $response->assertSessionHasErrors('country');
    }

    /**
     * A test to determine if author date of birth is provided.
     * @test
     * @return void
     */
    public function dob_of_author_is_required()
    {
        $response = $this->post('/authors', array_merge($this->data(), ['dob' => '']));

        $response->assertSessionHasErrors('dob');
    }

    private function data()
    {
        return [
            'name'      => 'Taylor Otwell',
            'country'   => 'USA',
            'dob'       => '05/14/1988'
        ];
    }
}
