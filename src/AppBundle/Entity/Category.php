<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="category")
 */
class Category 
{
    /**
     * @var int 
     * 
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="product_photo_pkey")
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
    protected $path;
    
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
     * @var Collection
     * 
     * @ORM\OneToMany(targetEntity="Product", mappedBy="category")
     */
    protected $products;
}
