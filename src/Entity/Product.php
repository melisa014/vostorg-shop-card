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
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
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
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    protected $vendorCode;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable = true)
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
     * @var File | null
     */
    protected $photoFile;

    /**
     * @var string | null
     *
     * @ORM\Column(type="text", name="photo_path", nullable = true)
     */
    protected $photoPath;

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
     * @param File | null $file
     */
    public function __construct(File $file = null)
    {
        $this->colors = new ArrayCollection();
        $this->photoFile = $file;

        $this->upload(
            dirname(__DIR__, 2),
            !empty($this->firm) ? $this->firm->getName(): ''
        );
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
        return !empty($this->photoPath) ? new File(dirname(__DIR__, 2).'/public'.$this->photoPath) : null;
    }

    /**
     * @param string $fileName
     * @param string $firmName
     *
     * @return self
     */
    public function setPhotoPath(string $fileName, string $firmName = ''): self
    {
        $this->photoPath = !empty($firmName) ? "/images/products/$firmName/": '/images/products/';

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
        return !empty($firmName) ? "/images/products/$firmName/": '/images/products/';
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

        $this->photoFile->move($this->getUploadRootDir($basepath).$this->getUploadDir($firmName), $fileName);

        $this->photoFile = null;
    }
}
