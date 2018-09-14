<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use ItForFree\rusphp\File\Image\ImageResizer;

/**
 * @ORM\Entity
 * @ORM\Table(name="photo")
 */
class Photo
{
    const SERVER_PATH_TO_IMAGE_FOLDER = '/public/images';

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * Unmapped property to handle file uploads
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $path;

    public function __construct(File $file = null, string $uploadRootDir)
    {
        $this->file = $file;
        
        $this->upload($uploadRootDir);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
      return $this->getName() ?? '';
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string | null
     */
    public function getPath(): ?string
    {
        return null === $this->name ? null : $this->path;
    }

    /**
     * @return string | null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param UploadedFile $file
     *
     * @return self
     */
//    public function setFile(UploadedFile $file = null): self
//    {
//        $this->file = $file;
//
//        return $this;
//    }

    /**
     * @return UploadedFile | null
     */
//    public function getFile(): ?UploadedFile
//    {
//        return $this->file;
//    }
//
//    /**
//     * @param string $basepath
//     *
//     * @return string
//     */
//    protected function getUploadRootDir(string $basepath, string $entityName = '', string $firmName = ''): string
//    {
//        return $basepath.$this->getUploadDir($entityName, $firmName);
//    }
//
//    /**
//     * @param string $entityName
//     * @param string $firmName
//     *
//     * @return string
//     */
//    protected function getUploadDir(string $entityName = '', string $firmName = ''): string
//    {
//        if ('firm' == $entityName) {
//            return "/public/images/mainPage";
//        } elseif ('product' == $entityName) {
//            return "/public/images/products/$firmName";
//        } elseif ('color' == $entityName) {
//            return "/public/images/colors";
//        } else {
//            return "/public/images";
//        }
//    }

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
