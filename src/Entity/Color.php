<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity
 * @ORM\Table(name="color")
 */
class Color
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $label;

    /**
     * @var File | null
     */
    protected $photoFile;

    /**
     * @var string | null
     *
     * @ORM\Column(type="text", nullable = true)
     */
    protected $photoPath;

    /**
     * @var DateTime
     *
     * @Gedmo\Timestampable(on="update")
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;

    /**
     * @param File | null $file
     */
    public function __construct(File $file = null)
    {
        if (!empty($file)) {
            $this->setPhotoFile($file);
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
      return $this->getLabel() ?? '';
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $label
     *
     * @return self
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param DateTime $updatedAt
     *
     * @return Color
     */
    public function setUpdatedAt($updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

   /**
     * @param File | null $file
     */
    public function setPhotoFile(File $file)
    {
        new Photo($file, $this->getUploadRootDir(dirname(__DIR__, 2))
            .$this->getUploadDir());

        $this->photoPath = $this->getUploadDir().$file->getClientOriginalName();
    }

    /**
     * @return string | null
     */
    public function getPhotoPath(): ?string
    {
        return $this->photoPath;
    }
    
    public function getPhotoFile()
    {
        return null;
        
        // TODO: разобраться, как показывать фалй в форме редактирования, если он уже существует
//        return fopen($this->getUploadRootDir(dirname(__DIR__, 2)).$this->photoPath, 'r');
    }
    
    /**
     * @param string $basepath
     *
     * @return string
     */
    public function getUploadRootDir(string $basepath): string
    {
        return $basepath.'/public';
    }

    /**
     * @param string $firmName
     *
     * @return string
     */
    public function getUploadDir(string $firmName = ''): string
    {
        return !empty($firmName) ? "/images/colors/$firmName/": '/images/colors/';
    }
}
