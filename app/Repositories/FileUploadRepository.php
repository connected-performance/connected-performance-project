<?php

namespace App\Repositories;

use App\Exceptions\ApiOperationFailedException;
use App\Traits\ImageTrait;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ChatRepository
 */
class FileUploadRepository
{
    /**
     * @param  UploadedFile  $file
     * @return string|void
     *
     * @throws ApiOperationFailedException
     */
    public function addAttachment($file, $path)
    {
        $extension = strtolower($file->getClientOriginalExtension());

        if (! in_array(
            $extension,
            [
                'xls', 'pdf', 'doc', 'docx', 'xlsx', 'jpg', 'gif', 'jpeg', 'png', 'mp4', 'mkv', 'avi', 'txt', 'mp3',
                'ogg', 'wav', 'aac', 'alac', 'mpeg', 'ogg', 'mp4', 'webm', '3gp', 'mov', 'flv', 'avi', 'wmv', 'ts', 'qt', 'pdf',
            ]
        )) {
            // return 'bad file';
            throw new ApiOperationFailedException('You can not upload this file.', Response::HTTP_BAD_REQUEST);
        }

        if (in_array($extension, ['jpg', 'gif', 'png', 'jpeg'])) {
            $fileName = ImageTrait::makeImage($file, $path, []);

            return $fileName;
        }

        if (in_array($extension, ['xls', 'pdf', 'doc', 'docx', 'xlsx', 'txt'])) {
            $fileName = ImageTrait::makeAttachment($file, $path);

            return $fileName;
        }

        if (in_array($extension, ['mp4', 'mkv', 'avi', 'mp4', 'webm', '3gp', 'mov', 'flv', 'avi', 'wmv', 'ts', 'qt', 'pdf'])) {
            $fileName = ImageTrait::uploadVideo($file, $path);

            return $fileName;
        }

        if (in_array($extension, ['mp3', 'ogg', 'wav', 'aac', 'alac'])) {
            $fileName = ImageTrait::uploadFile($file, $path);

            return $fileName;
        }
    }
}
