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
        $this->photoFile = $file;

        $this->upload(dirname(__DIR__, 2));
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

    public function showPhoto()
    {
        return ImageResizer::resizeAsInFormat(
            dirname(__DIR__, 2).'/public'.$this->getUploadDir(),
            '50x50xSxCxP'
        );
    }

    /**
     * @param File $file
     *
     * @return self
     */
    public function setPhotoFile(File $file): self
    {
        $this->photoFile = $file;

        $this->upload(
            dirname(__DIR__, 2),
            !empty($this->firm) ? $this->firm->getName(): ''
        );

        return $this;
    }

    /**
     * @return File | null
     */
    public function getPhotoFile(): ?File
    {
        return null;
        // ToDo: разобраться, как отображать файл при редактировании в форме
//        return file_exists(dirname(__DIR__, 2).'/public'.$this->photoPath)
//            ? new File(dirname(__DIR__, 2).'/public'.$this->photoPath)
//            : null;
    }

    /**
     * @param string $fileName
     * @param string $firmName
     *
     * @return self
     */
    public function setPhotoPath(string $fileName, string $firmName = ''): self
    {
        $this->photoPath = !empty($firmName) ? "/images/colors/$firmName/": '/images/colors/';

        $this->photoPath .= $fileName;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPhotoPath(): ?string
    {
        return $this->photoPath;
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

    /**
     * @param string $basepath
     */
    public function upload(string $basepath, string $firmName = ''): void
    {
        if (null === $this->photoFile) {
            return;
        }

        if (null === $basepath) {
            return;
        }

        $fileName = $this->photoFile->getClientOriginalName();

        $this->setPhotoPath($fileName, $firmName);

        $this->photoFile->move($this->getUploadRootDir($basepath).$this->getUploadDir(), $fileName);

        $this->photoFile = null;
    }
}
