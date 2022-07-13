<?php declare(strict_types=1);

namespace Aqjw\MedialibraryField\Integrations\Nova4DependencyContainer;

use Alexwenzel\DependencyContainer\DependencyContainer;
use Aqjw\MedialibraryField\Fields\Medialibrary;
use Laravel\Nova\Fields\FieldCollection;

class ResolveFromNova4DependencyContainerFields
{
    public function __invoke(FieldCollection $fields, string $attribute): ?Medialibrary
    {
        return $fields->map(function ($field) {
            if (!is_a($field, DependencyContainer::class)) {
                return $field;
            }

            return $field->meta['fields'];
        })
            ->flatten()
            ->whereInstanceOf(Medialibrary::class)
            ->findFieldByAttribute($attribute);
    }
}
