<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    protected $guarded = [];

    public function attachable()
    {
        return $this->morphTo();
    }

    /**
     * @inheritdoc
     */
    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($item) {
            $item->deleteFile();
        });
    }

    /**
     * Uploads files.
     *
     * @param UploadedFile $file
     * @return $this
     */
    public function uploadFile(UploadedFile $file)
    {
        $file = $file->storePublicly("/uploads/" . normalizeDir($this->attachable_type) . "/{$this->attachable_id}",
            ['disk' => 'public']);

        $this->name = basename($file);

        return $this;
    }

    /**
     * Efface physiquement le fichier du serveur.
     */
    public function deleteFile()
    {
        Storage::disk('public')
            ->delete('/uploads/' . normalizeDir($this->attachable_type) . "/{$this->attachable_id}/{$this->name}}");
    }
}
