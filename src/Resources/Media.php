<?php

declare(strict_types=1);

namespace Aqjw\MedialibraryField\Resources;

use Aqjw\MedialibraryField\MedialibraryFieldResolver;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;
use Laravel\Nova\Resource;

class Media extends Resource
{
    public static $model = \Spatie\MediaLibrary\MediaCollections\Models\Media::class;

    public static $displayInNavigation = false;

    public static $globallySearchable = false;

    public static $trafficCop = false;

    public static function uriKey(): string
    {
        return 'aqjw-medialibrary-media';
    }

    public function fields(NovaRequest $request): array
    {
        $resource = Nova::resourceInstanceForKey($request->input('viaResource'));

        $field = call_user_func(new MedialibraryFieldResolver(
            $request,
            $resource,
            $request->input('viaField')
        ));

        if (is_null($field)) {
            return [];
        }

        return call_user_func($field->fieldsCallback->bindTo($this), $request);
    }
}
