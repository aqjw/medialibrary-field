<?php

declare(strict_types=1);

namespace Aqjw\MedialibraryField\Tests\Integration;

use Aqjw\MedialibraryField\Tests\TestCase;

class ShowControllerTest extends TestCase
{
    /** @test */
    public function test_can_show_media(): void
    {
        $post = $this->createPostWithMedia();

        $media = $post->media->first();

        $response = $this
            ->getJson("nova-api/aqjw-medialibrary-media/{$media->id}?viaResource=test-posts&viaField=media")
            ->assertSuccessful();

        $this->assertCount(1, $response->decodeResponseJson()['resource']['fields']);
        $this->assertSame('disk', $response->decodeResponseJson()['resource']['fields'][0]['attribute']);
    }
}
