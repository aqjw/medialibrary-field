<?php declare(strict_types=1);

namespace Aqjw\MedialibraryField\Fields\Support;

use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia;

class ResolveMediaCallback
{
    public function __invoke(HasMedia $model, string $collectionName): Collection
    {
        return $model->getMedia($collectionName);
    }
}
