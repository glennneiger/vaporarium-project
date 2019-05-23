<?php

namespace App\Service;


use App\Entity\BaseConfig;
use App\Entity\Stock;
use Doctrine\ORM\EntityManagerInterface;

class Base
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(
        EntityManagerInterface $em
    )
    {
        $this->em = $em;
    }

    public function getBaseContent(){
        $rep = $this->em->getRepository(BaseConfig::class);
        $base = $rep->findOneBy(array('publish'=>true));
        return $base;

    }

    public function getStock(){
        $rep = $this->em->getRepository(Stock::class);
        $stock = $rep->findAll();
        return $stock;
    }

}