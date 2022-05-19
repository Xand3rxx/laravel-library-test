<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## About Laravel Library Test

Laravel is a web application framework with expressive, elegant syntax. This application is simply to test if some basic functions of a book library can be executed without hassle.

## Misconceptions
When talking about automated tests or unit tests in any programming language, there are two groups of people:

- Those who believe that writing automated tests is a waste of time.
- Those who do write tests can't imagine working without them.

## Why You Need Automated Tests

Automated tests are simple: they just execute portions of your code for you and indicate any issues. That's the most straightforward way to describe them. Imagine you're introducing a new feature in your app, and your personal robot helper goes to personally test it for you, making sure the new code doesn't damage anything in the existing features.

## Code Sample
```php:
    /**
     * A test to create a new book record in the library.
     * @test
     * @return void
     */
    public function can_create_book_record()
    {
        $response = $this->post('/books', [
            'title'     => 'How to make money',
            'author'    => 'John Doe'
        ]);

        $response->assertStatus(201);
        $this->assertCount(1, Book::all());
    }
```
