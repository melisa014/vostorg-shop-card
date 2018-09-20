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
     * @var string | null
     *
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var string | null
     *
     * @ORM\Column(type="string")
     */
    protected $label;

    /**
     * @var string | null
     *
     * @ORM\Column(type="string", nullable=true)
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

    public function __construct(File $file = null)
    {
        $this->products = new ArrayCollection();

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
     * @return string
     */
    public function getUploadDir(): string
    {
        return '/images/mainPage/';
    }
}
