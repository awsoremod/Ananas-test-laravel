<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
        $response = $this->postJson('api/posts'); // ['Accept' => 'application/json']
        $response->assertStatus(401);
    }

    public function test_store_validate_no_description()
    {
        $user = User::where('id', 1)->first();
        $response = $this->actingAs($user)
            ->postJson('api/posts');

        $response->assertStatus(422);
    }

    public function test_store_fin_insert_the_same()
    {
        $user = User::where('id', 1)->first();
        $response = $this->actingAs($user)
            ->postJson('api/posts', ['description' => 'test description qwer']);
        $user = Post::where('description', 'test description qwer')->first();

        $response->assertStatus(200);
    }

    // public function test_store_fin_worked()
    // {
    //     $response = $this->post('api/posts');

    //     $response->assertStatus(200);
    // }


    // public function test_destroy_auth_nonauthorized()
    // {
    //     $response = $this->delete('api/posts');

    //     $response->assertStatus(200);
    // }

    // public function test_destroy_validate_no_id()
    // {
    //     $response = $this->delete('api/posts');

    //     $response->assertStatus(200);
    // }

    // public function test_destroy_validate_id_letters()
    // {
    //     $response = $this->delete('api/posts');

    //     $response->assertStatus(200);
    // }

    // public function test_destroy_validate_id_is_not_in_the_database()
    // {
    //     $response = $this->delete('api/posts');

    //     $response->assertStatus(200);
    // }

    // public function test_destroy_auth_foreign_post()
    // {
    //     $response = $this->delete('api/posts');

    //     $response->assertStatus(200);
    // }

    // public function test_destroy_old_message()
    // {
    //     $response = $this->delete('api/posts');

    //     $response->assertStatus(200);
    // }

    // public function test_destroy_fin()
    // {
    //     // проверить совершение удаления и возврат api
    //     $response = $this->delete('api/posts');

    //     $response->assertStatus(200);
    // }
}
