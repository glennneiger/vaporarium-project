<?php

namespace App\Service;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Search
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(
        EntityManagerInterface $em,
        ContainerInterface $container
    )
    {
        $this->em = $em;
        $this->container = $container;
    }

    public function getSearchResult($request){
        $query = $this->cleanQuerySQL($request->get('search'));
        if($query == null){
            return null;
        }
        $paginator = $this->container->get('knp_paginator');
        $repProducts = $this->em->getRepository(Product::class);
        $dbProducts = $repProducts->createQueryBuilder('prod');
        $dbProducts
            ->select('prod')
            ->where("prod.name LIKE '%$query%'");
        $productsResult = $paginator->paginate(
            $dbProducts->getQuery(), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            12/*limit per page*/
        );
        return $productsResult;
    }

    public function cleanQuerySQL($query){
        $query = htmlspecialchars(trim($query));
        if($query == '' || mb_strlen($query)<3){
            return null;
        }
        $workSymbols = ['@','#','$','%',':',';','&','*',',','/','\'','`','"','[',']','{','}','.'];
        $substitutionWorkSymbols = ['','','','','','','','','','','','','','','','','',''];
        $sqlRequestArray = ['SHOW','DATABASES','CREATE','USE','SOURCE','DROP','TABLES','TABLE','DESCRIBE','INSERT','INTO','VALUES','UPDATE','SET','WHERE','DELETE','FROM','SELECT','DISTINCT','GROUP BY','COUNT','HAVING','ORDER BY','ASC','DESC','BETWEEN','LIKE','JOIN','VIEW','AMP','QUOT'];
        $substitutionSqlRequestArray = ['','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''];
        $query = str_replace($workSymbols,$substitutionWorkSymbols,$query);
        $query = str_ireplace($sqlRequestArray,$substitutionSqlRequestArray,$query);
        $query = trim($query);
        if($query == '' || mb_strlen($query)<3){
            return null;
        }
        $query = str_replace(' ','%',$query);
        return $query;
    }

}