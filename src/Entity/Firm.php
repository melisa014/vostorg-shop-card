<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use ItForFree\rusphp\File\Image\ImageResizer;

/**
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 * @ORM\Entity
 * @ORM\Table(name="firm")
 */
class Firm
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
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $label;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $description;

    /**
     * @var DateTime
     *
     * @Gedmo\Timestampable(on="update")
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Product", mappedBy="firm")
     */
    protected $products;

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

    public function __construct()
    {
        $this->products = new ArrayCollection();
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
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
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
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param DateTime $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param Product $product
     *
     * @return self
     */
    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    /**
     * @param Product $product
     *
     * @return self
     */
    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
        }

        return $this;
    }

    /**
     * @return Collection | Product[]
     */
    public function getProducts(): ?Collection
    {
        return $this->products;
    }

    public function showPhoto()
    {
        return ImageResizer::resizeAsInFormat(
            dirname(__DIR__, 2).'/public'.$this->getUploadDir(),
            '350x230xSxCxP'
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

        $this->upload(dirname(__DIR__, 2));

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
     *
     * @return self
     */
    public function setPhotoPath(string $fileName): self
    {
        $this->photoPath = '/images/mainPage/'.$fileName;

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
     * @return string
     */
    public function getUploadDir(): string
    {
        return '/images/mainPage/';
    }

    /**
     * @param string $basepath
     */
    public function upload(string $basepath): void
    {
        if (null === $this->photoFile) {
            return;
        }

        if (null === $basepath) {
            return;
        }

        $fileName = $this->photoFile->getClientOriginalName();

        $this->setPhotoPath($fileName);

        $this->photoFile->move($this->getUploadRootDir($basepath).$this->getUploadDir(), $fileName);

        $this->photoFile = null;
    }
}
