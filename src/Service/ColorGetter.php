<?php

namespace App\Service;

use App\Entity\Color;
use Doctrine\ORM\EntityManagerInterface;

class ColorGetter 
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->em->getRepository(Color::class)
                ->findAll();
    }
}
