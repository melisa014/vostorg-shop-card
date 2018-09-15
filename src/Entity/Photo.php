<?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\File\File;
use ItForFree\rusphp\File\Image\ImageResizer;

class Photo
{
    /**
     * Поле для хранения загружаемого файла
     */
    private $file;

    public function __construct(File $file = null, string $uploadRootDir)
    {
        $this->file = $file;
        
        $this->upload($uploadRootDir);
    }
    
    /**
     * @param string $uploadRootDir
     */
    public function upload(string $uploadRootDir): void
    {
        if (null === $this->file) {
            return;
        }

        if (null == $uploadRootDir) {
            return;
        }
        
        $fileName = $this->file->getClientOriginalName();
        
        $this->file->move($uploadRootDir, $fileName);
        
        ImageResizer::resize($uploadRootDir.$fileName, 1300, 731);
        
        $this->file = null;
    }
}
