<?php

namespace App\Service;

use App\Entity\Firm;
use Doctrine\ORM\EntityManagerInterface;

class FirmGetter 
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
        return $this->em->getRepository(Firm::class)
                ->findAll();
    }
    
    /**
     * @return array
     */
    public function getLabels(): array
    {
        $firms = $this->em->getRepository(Firm::class)
                ->findAll();
         
        return array_map(function($firm){
            return $firm->getLabel();
        },$firms);
    }
}
