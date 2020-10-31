<?php

namespace App\Lib\Files;

class Folder extends BaseFile
{
    public function path()
    {
        return $this->basePath;
    }
}
