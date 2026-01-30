<?php

namespace App\Library\Media;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class DefaultPathGenerator implements PathGenerator
{
    /*
     * Get the path for the given media, relative to the root storage path.
     */
    public function getPath(Media $media): string
    {
        return $this->getBasePath($media).'/';
    }

    /*
     * Get the path for conversions of the given media, relative to the root storage path.
     */
    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media);
    }

    /*
     * Get the path for responsive images of the given media, relative to the root storage path.
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getBasePath($media).'/responsive-images/';
    }

    /*
     * Get a unique base path for the given media.
     */
    protected function getBasePath(Media $media): string
    {
        $prefix = config('media-library.prefix', '');
        $explodeModelType = explode('\\', $media->model_type);
        $modelName = strtolower(end($explodeModelType));
        $basePath = '';

        if ('' !== $prefix) {
            $basePath = md5("$prefix/$modelName/$media->model_id/$media->collection_name".config('app.key'));
        } else {
            $basePath = md5("$modelName/$media->model_id/$media->collection_name".config('app.key'));
        }

        return "$basePath/$media->order_column";
    }
}
