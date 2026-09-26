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

    public function test_movies_index_shows_all_movies_without_filters(): void
    {
        $this->get('/movies')
            ->assertStatus(200)
            ->assertSee('The Shawshank Redemption')
            ->assertSee('The Godfather')
            ->assertSee('The Dark Knight')
            ->assertSee('Pulp Fiction')
            ->assertSee('Forrest Gump');
    }

    public function test_movies_index_filters_by_year(): void
    {
        $this->get('/movies?year=2008')
            ->assertStatus(200)
            ->assertSee('The Dark Knight')
            ->assertDontSee('The Godfather');
    }

    public function test_movies_index_filters_by_genre(): void
    {
        $this->get('/movies?genre=Drama')
            ->assertStatus(200)
            ->assertSee('The Shawshank Redemption')
            ->assertSee('Forrest Gump')
            ->assertDontSee('The Godfather');
    }

    public function test_movies_index_applies_both_filters_together(): void
    {
        $this->get('/movies?year=1994&genre=Crime')
            ->assertStatus(200)
            ->assertSee('Pulp Fiction')
            ->assertDontSee('The Shawshank Redemption')
            ->assertDontSee('The Godfather');
    }

    public function test_movie_filter_links_preserve_the_other_filter_and_can_clear_both(): void
    {
        $response = $this->get('/movies?year=1994&genre=Drama');

        $response->assertStatus(200)
            ->assertSee(route('movies.index', ['year' => 2008, 'genre' => 'Drama']))
            ->assertSee(route('movies.index', ['year' => 1994, 'genre' => 'Crime']))
            ->assertSee(route('movies.index'))
            ->assertSee('Showing movies with genre: Drama and year: 1994');
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
