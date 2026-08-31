<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_movies_page_returns_a_successful_response(): void
    {
        $response = $this->get('/movies');

        $response->assertStatus(200);
    }

    public function test_movie_detail_page_shows_the_correct_movie(): void
    {
        $response = $this->get('/movies/1');

        $response->assertStatus(200)
            ->assertSee('The Shawshank Redemption')
            ->assertSee('1994')
            ->assertDontSee('Frank Darabont');
    }

    public function test_movie_detail_page_for_a_different_id_is_not_the_same_movie(): void
    {
        $response = $this->get('/movies/3');

        $response->assertStatus(200)
            ->assertSee('The Dark Knight')
            ->assertDontSee('The Shawshank Redemption');
    }

    public function test_featured_movie_page_shows_the_featured_pick(): void
    {
        $response = $this->get('/movies/featured');

        $response->assertStatus(200)
            ->assertSee('The Dark Knight');
    }

    public function test_movies_filter_page_shows_only_matching_movies(): void
    {
        $response = $this->get('/movies/filter/1994');

        $response->assertStatus(200)
            ->assertSee('Filtered by year: 1994')
            ->assertSee('The Shawshank Redemption')
            ->assertSee('Pulp Fiction')
            ->assertSee('Forrest Gump')
            ->assertDontSee('The Dark Knight');
    }

    public function test_movies_filter_page_without_value_shows_all_movies(): void
    {
        $response = $this->get('/movies/filter');

        $response->assertStatus(200)
            ->assertSee('All items are shown')
            ->assertSee('The Shawshank Redemption')
            ->assertSee('The Dark Knight')
            ->assertSee('Forrest Gump');
    }

    public function test_invalid_movie_id_returns_a_clean_404_page(): void
    {
        $response = $this->get('/movies/999');

        $response->assertStatus(404)
            ->assertDontSee('file');
    }
}
