<?php declare(strict_types=1);

namespace Aqjw\MedialibraryField\Tests\Integration;

use Aqjw\MedialibraryField\Tests\TestCase;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SortControllerTest extends TestCase
{
    /** @test */
    public function media_can_be_sorted(): void
    {
        $this->createPostWithMedia(3);

        $this->assertEquals([1 => '1', 2 => '2', 3 => '3'], Media::pluck('order_column', 'id')->all());

        $this->postJson('nova-vendor/aqjw/medialibrary-field/sort', [
            'media' => [3, 2, 1],
        ]);

        $this->assertEquals([1 => '3', 2 => '2', 3 => '1'], Media::pluck('order_column', 'id')->all());
    }
}
