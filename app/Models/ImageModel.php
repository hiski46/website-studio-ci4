<?php

namespace App\Models;

use CodeIgniter\Model;


class ImageModel extends Model
{
    protected $table            = 'image';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];
}

function uploadImage($file)
{
    if (!$file->hasMoved()) {
        $filepath = WRITEPATH . 'uploads/' . $file->store();

        $data = ['uploaded_fileinfo' => new File($filepath)];

        return true;
    }

    $data = ['errors' => 'The file has already been moved.'];

    return false;
}
