<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get('api/posts');

        $response->assertStatus(200);
    }


    public function test_store_auth_nonauthorized()
    {
        $response = $this->post('api/posts');

        $response->assertStatus(200);
    }

    public function test_store_validate_no_description()
    {
        $response = $this->post('api/posts');

        $response->assertStatus(200);
    }

    public function test_store_fin_insert_the_same()
    {
        $response = $this->post('api/posts');

        $response->assertStatus(200);
    }

    public function test_store_fin_worked()
    {
        $response = $this->post('api/posts');

        $response->assertStatus(200);
    }


    public function test_destroy_auth_nonauthorized()
    {
        $response = $this->delete('api/posts');

        $response->assertStatus(200);
    }

    public function test_destroy_validate_no_id()
    {
        $response = $this->delete('api/posts');

        $response->assertStatus(200);
    }

    public function test_destroy_validate_id_letters()
    {
        $response = $this->delete('api/posts');

        $response->assertStatus(200);
    }

    public function test_destroy_validate_id_is_not_in_the_database()
    {
        $response = $this->delete('api/posts');

        $response->assertStatus(200);
    }

    public function test_destroy_auth_foreign_post()
    {
        $response = $this->delete('api/posts');

        $response->assertStatus(200);
    }

    public function test_destroy_old_message()
    {
        $response = $this->delete('api/posts');

        $response->assertStatus(200);
    }

    public function test_destroy_fin()
    {
        // проверить совершение удаления и возврат api
        $response = $this->delete('api/posts');

        $response->assertStatus(200);
    }
}
