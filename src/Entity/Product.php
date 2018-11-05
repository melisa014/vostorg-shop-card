<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 * @ORM\Entity()
 * @ORM\Table(name="product")
 */
class Product
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
     * @ORM\Column(type="string", length=100)
     */
    protected $vendorCode;

    /**
     * @var string | null
     *
     * @ORM\Column(type="string", nullable = true)
     */
    protected $description;

    /**
     * @var string | null
     *
     * @ORM\Column(type="text", nullable = true)
     */
    protected $keywords;

    /**
     * @var DateTime
     *
     * @Gedmo\Timestampable(on="update")
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @var Firm
     *
     * @ORM\ManyToOne(targetEntity="Firm", inversedBy="products")
     * @ORM\JoinColumn(name="firm_id", referencedColumnName="id")
     */
    protected $firm;

    /**
     * @var string | null
     *
     * @ORM\Column(type="text", name="photo_path", nullable = true)
     */
    protected $photoPath;

    /**
     * @var File | null
     */
    protected $photoFile;

    /**
     * @var Collection | Color[]
     *
     * @ORM\ManyToMany(targetEntity="Color")
     * @ORM\JoinTable(name="products_colors",
     *      joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="color_id", referencedColumnName="id")}
     *      )
     */
    protected $colors;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @param File | null  $file
     */
    public function __construct(File $file = null)
    {
        $this->colors = new ArrayCollection();

        if (!empty($file)) {
            $this->setPhotoFile($file);
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $vendorCode
     *
     * @return self
     */
    public function setVendorCode(string $vendorCode): self
    {
        $this->vendorCode = $vendorCode;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getVendorCode(): ?string
    {
        return $this->vendorCode;
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
     * @param string $keywords
     *
     * @return self
     */
    public function setKeywords(string $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * @return string  | null
     */
    public function getKeywords(): ?string
    {
        return $this->keywords;
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
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param Category $category
     *
     * @return self
     */
    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Category  | null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
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
     * @param Color $color
     *
     * @return self
     */
    public function addColor(Color $color): self
    {
        if (!$this->colors->contains($color)) {
            $this->colors[] = $color;
        }

        return $this;
    }

    /**
     * @param Color $color
     *
     * @return self
     */
    public function removeColor(Color $color): self
    {
        if ($this->colors->contains($color)) {
            $this->colors->removeElement($color);
        }

        return $this;
    }

    /**
     * @return Collection | Color[] | null
     */
    public function getColors(): ?Collection
    {
        return $this->colors;
    }

    /**
     * @return string | null
     */
    public function getPhotoPath(): ?string
    {
        return $this->photoPath;
    }

    /**
     * @param File | null $file
     */
    public function setPhotoFile(File $file)
    {
        new Photo($file, $this->getUploadRootDir(dirname(__DIR__, 2))
            .$this->getUploadDir(!empty($this->firm) ? $this->firm->getName(): ''));

        $this->photoPath = $this->getUploadDir(!empty($this->firm) ? $this->firm->getName(): '')
            .$file->getClientOriginalName();
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
        return !empty($firmName) ? "/images/products/$firmName/": '/images/products/';
    }
}
