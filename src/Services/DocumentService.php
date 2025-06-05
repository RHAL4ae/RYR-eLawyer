<?php

namespace RYReLawyer\Services;

use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\HasMedia;

class DocumentService
{
    protected HasMedia $model;

    public function __construct(HasMedia $model)
    {
        $this->model = $model;
    }

    /**
     * Store the given file in the media library.
     *
     * @param File $file
     * @return Media
     */
    public function storeDocument(File $file): Media
    {
        // In a real Laravel app, we would do:
        // return $this->model->addMedia($file)->toMediaCollection('documents');
        throw new \RuntimeException('Media storage not implemented in this skeleton.');
    }
}
