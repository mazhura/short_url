<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GenerateLinkTest extends TestCase
{
    use DatabaseTransactions;

    public function test_link_validator_fail()
    {
        $response = $this->put('/', ['inputUrl' => '']);
        $response->assertStatus(400);

        $response = $this->put('/', ['inputUrl' => 'php']);
        $response->assertStatus(400);
    }

    public function test_link_was_generated()
    {
        $response = $this->put('/', ['inputUrl' => 'http://google.com']);

        $response->assertStatus(200);
    }

    public function test_link_redirect()
    {
        $url = 'http://google.com';

        $response = $this->put('/', ['inputUrl' => $url]);
        $response->assertStatus(200);

        $outputUrl = $response->json('outputUrl');

        $redirectRequest = $this->get($outputUrl);
        $redirectRequest->assertStatus(302);
        $redirectRequest->assertRedirect($url);
    }
}
