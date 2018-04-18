<?php

namespace App\Service;

use App\Entity\Catregory;
use Doctrine\ORM\EntityManagerInterface;

class CatregoryGetter 
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
        return $this->em->getRepository(Catregory::class)
                ->findAll();
    }
}
