<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * 
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
     * @ORM\Column(type="string", nullable = true) 
     */
    protected $name;
    
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
     * @var int
     * 
     * @ORM\Column(type="integer", nullable = true) 
     */
    protected $price;
    
    /**
     * @var DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * 
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;
    
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
     * @var Collection | Photo[]
     * 
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="product")
     */
    protected $photos;
    
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

    public function __construct()
    {
        $this->photos = new ArrayCollection();
        $this->colors = new ArrayCollection();
    }
    
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string | null $name
     *
     * @return self
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }
    
    /**
     * @return string | null
     */
    public function getName(): ?string
    {
        return $this->name;
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
     * @param int $price | null
     *
     * @return self
     */
    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return int  | null
     */
    public function getPrice(): ?int 
    {
        return $this->price;
    }

    /**
     * @param DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
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
     * @param Photo $photo
     *
     * @return self
     */
    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
        }

        return $this;
    }

    /**
     * @param Photo $photo
     *
     * @return self
     */
    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->contains($photo)) {
            $this->photos->removeElement($photo);
        }
        
        return $this;
    }

    /**
     * @return Collection | Photo[] | null
     */
    public function getPhotos(): ?Collection
    {
        return $this->photos;
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
}
