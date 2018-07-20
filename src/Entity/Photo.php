<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable = true)
     */
    protected $description;

    /**
     * @var Product | null
     *
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="photos")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $product;

    /**
     * @var Firm | null
     *
     * @ORM\OneToOne(targetEntity="Firm", inversedBy="photo")
     */
    protected $firm;


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
    public function getPathToPhoto(): ?string
    {
        return $this->path.$this->name;
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
     * @param string $description
     *
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string  | null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param Product $product
     *
     * @return Photo
     */
    public function setProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return Product | null
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Firm $firm
     *
     * @return self
     */
    public function setFirm(Firm $firm): self
    {
        $this->firm = $firm;

        return $this;
    }

    /**
     * @return Firm | null
     */
    public function getFirm(): ?Firm
    {
        return $this->firm;
    }

    /**
     * @param UploadedFile $file
     *
     * @return self
     */
    public function setFile(UploadedFile $file = null): self
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @return UploadedFile
     */
    public function getFile(): UploadedFile
    {
        return $this->file;
    }

    /**
     * @param string $basepath
     *
     * @return string
     */
    protected function getUploadRootDir(string $basepath, string $entityName = '', string $firmName = ''): string
    {
        return $basepath.$this->getUploadDir($entityName, $firmName);
    }

    /**
     * @param string $entityName
     * @param string $firmName
     *
     * @return string
     */
    protected function getUploadDir(string $entityName = '', string $firmName = ''): string
    {
        if ('firm' == $entityName) {
            return "/public/images/mainPage";
        } elseif ('products' == $entityName) {
            return "/public/images/products/$firmName";
        } else {
            return "/public/images";
        }
    }

    /**
     * @param string $basepath
     */
    public function upload(string $basepath, string $entityName = '', string $firmName = ''): void
    {
        if (null === $this->file) {
            return;
        }

        if (null === $basepath) {
            return;
        }

        $this->file->move($this->getUploadRootDir($basepath, $entityName, $firmName), $this->file->getClientOriginalName());

        $this->name = $this->file->getClientOriginalName();
        $this->path = $this->getUploadDir($entityName, $firmName);

        $this->file = null;
    }
}
