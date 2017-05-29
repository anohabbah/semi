<?php

namespace App\Http\Controllers\Admin;

use App\Attachment;
use App\Http\Requests\AttachmentRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class AttachmentController extends Controller
{
    public function store(AttachmentRequest $request)
    {
        $id = $request->input('attachable_id');
        $type = $request->input('attachable_type');
        $file = $request->file('file');

        if (class_exists($type) && method_exists($type, 'attachment')) {

            $target = call_user_func($type . '::find', $id);
            if ($target) {
                // S'assurer que 2 fichiers ne soient pas associés
                // à un même document
                if ($target->attachment) {
                    $target->attachment->delete();
                }

                $attachment = new Attachment($request->only('attachable_type', 'attachable_id'));
                $attachment->uploadFile($file);
                $attachment->save();

                return $attachment;
            } else {
                return new JsonResponse(['attachable_id' => 'Impossible d\'associer un fichier à cet objet.']);
            }

        } else {
            return new JsonResponse(['attachable_type' => 'On ne peut pas associé de fichier à cet objet.'], 422);
        }
    }
}
