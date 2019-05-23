<?php

namespace App\Service;

use App\Entity\CharacteristicItemForProduct;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Products
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

    public function getProductInIsTop(){
        $repProducts = $this->em->getRepository(Product::class);
        $dbProducts = $repProducts->createQueryBuilder('prod');
        $dbProducts
            ->leftJoin('prod.group', 'gr')
            ->select('prod.id')
            ->where("gr.publishIsTop = true")
        ;
        $productsId = $dbProducts->getQuery()->getResult();
        if($productsId == []){
            return null;
        }
        if(count($productsId)<=6){
            $dbProducts
                ->select('prod, gr')
                ->where('gr.publishIsTop = true');
        $productsResult = $dbProducts->getQuery()->getResult();
        return $productsResult;
        }
        foreach ($productsId as $id){
            $arr[] = $id['id'];
        }
        shuffle($arr);
        $strQuery = "";
        for($i=0;$i<6;$i++){
            $strQuery .= ",$arr[$i]";
        }
        $strQuery = ltrim($strQuery,',');
        $dbProducts
            ->select('prod')
            ->where("prod.id IN ($strQuery)");
        $productsResult = $dbProducts->getQuery()->getResult();
        return $productsResult;
    }

    public function getProductInStock(){
        $repProducts = $this->em->getRepository(Product::class);
        $dbProducts = $repProducts->createQueryBuilder('prod');
        $dbProducts
            ->leftJoin('prod.group', 'gr')
            ->select('prod.id')
            ->where("gr.publishInStock = true")
        ;
        $productsId = $dbProducts->getQuery()->getResult();
        if($productsId == []){
            return null;
        }
        if(count($productsId)<=6){
            $dbProducts
                ->select('prod, gr')
                ->where('gr.publishInStock = true');
            $productsResult = $dbProducts->getQuery()->getResult();
            return $productsResult;
        }
        foreach ($productsId as $id){
            $arr[] = $id['id'];
        }
        shuffle($arr);
        $strQuery = "";
        for($i=0;$i<6;$i++){
            $strQuery .= ",$arr[$i]";
        }
        $strQuery = ltrim($strQuery,',');
        $dbProducts
            ->select('prod')
            ->where("prod.id IN ($strQuery)");
        $productsResult = $dbProducts->getQuery()->getResult();
        return $productsResult;
    }

    public function getProductInCategory($categoryId, $request){
        $filterParamsArr = $this->getFiltersParams($request,false);
        $sorted = $this->getSortedByPrice($request);
        $paginator = $this->container->get('knp_paginator');
        if($filterParamsArr !== null){
            $repCharacteristicItemForProduct = $this->em->getRepository(CharacteristicItemForProduct::class);
            $resultForCharItemMod = [];
            $charI = 0;
            foreach($filterParamsArr as $itemProductCharacteristic =>$values){
                $valueStr = "";
                foreach ($values as $value){
                    $valueStr .= ",".$value;
                }
                $valueStr = ltrim($valueStr,",");
                $dbCharProdItem = $repCharacteristicItemForProduct->createQueryBuilder('char');
                $dbCharProdItem
                    ->leftJoin('char.product','product')
                    ->leftJoin('product.category', 'cat')
                    ->select('product.id')
                    ->where("cat.id = $categoryId AND char.productCharacteristic = $itemProductCharacteristic AND char.characteristicValue IN ($valueStr)");
                $resultForCharItem = $dbCharProdItem->getQuery()->getResult();

                foreach ($resultForCharItem as $item =>$val){
                    $resultForCharItemMod[$charI][] = $val['id'];
                }
                $charI++;
            }
            if($resultForCharItemMod == []){
                return null;
            }
            $arrResult = $resultForCharItemMod[0];
            if(count($resultForCharItemMod) > 1){
                    for( $i = 0 ; $i < $charI-1 ; $i++){
                    $arrResult = array_intersect($arrResult,$resultForCharItemMod[$i+1]);
                }
            }
            $resultStr = "";
            foreach ($arrResult as $resItem=>$val){
                $resultStr .=','.$val;
            }
            $resultStr = ltrim($resultStr,',');
            if($resultStr == ""){
                return null;
            }
            $repProducts = $this->em->getRepository(Product::class);
            $dbProducts = $repProducts->createQueryBuilder('prod');
            $dbProducts
                ->leftJoin('prod.group', 'gr')
                ->leftJoin('prod.characteristicItemForProduct', 'characteristicItemForProduct')
                ->leftJoin('characteristicItemForProduct.productCharacteristic', 'productCharacteristic')
                ->leftJoin('characteristicItemForProduct.characteristicValue', 'characteristicValue');
            if($sorted){
                $dbProducts->orderBy("prod.price",$sorted);
            }
            $dbProducts
                ->select('prod, gr,characteristicItemForProduct,productCharacteristic,characteristicValue')
                ->where('prod.category = :id AND gr.publishInCategory = true')
                ->andWhere("prod.id IN ($resultStr)")
                ->setParameter('id', $categoryId);
            $productsResult = $paginator->paginate(
                $dbProducts->getQuery(), /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                12/*limit per page*/
            );
            return $productsResult;
        }

        $repProductsValid = $this->em->getRepository(Product::class);
        $dbProductsValid = $repProductsValid->createQueryBuilder('prod');
        $dbProductsValid
            ->leftJoin('prod.group', 'gr')
            ->select('prod, gr')
            ->where('prod.category = :id AND gr.publishInCategory = true ')
            ->setParameter('id',$categoryId)
            ->setMaxResults(1);
        $resultValid = $dbProductsValid->getQuery()->getResult();
        if($resultValid == []){
            return null;
        }

        $repProducts = $this->em->getRepository(Product::class);
        $dbProducts = $repProducts->createQueryBuilder('prod');
        $dbProducts
            ->leftJoin('prod.group', 'gr')
            ->select('prod, gr');
        if($sorted){
            $dbProducts->orderBy("prod.price",$sorted);
        }
        $dbProducts
            ->where('prod.category = :id AND gr.publishInCategory = true ')
            ->setParameter('id',$categoryId);
        $productsResult = $paginator->paginate(
            $dbProducts->getQuery(), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            12/*limit per page*/
        );

        return $productsResult;
    }

    public function getSortedByPrice($request){
        $price = $request->get('price');
        if($price == "up"){
            $sorted = "ASC";
        } elseif ($price == "down"){
            $sorted = "DESC";
        } else {
            return null;
        }
        return $sorted;
    }

    public function getFiltersParams($request, $min = false){
        $characteristicArr = $request->get('characteristic');
        if($characteristicArr){
            foreach ($characteristicArr as $item=>$value){
                list($characteristicId, $characteristicValue) = explode("-",$value);
                    $paramsArr[(int)$characteristicId][] = (int)$characteristicValue;
                    $paramsValues[] = (int)$characteristicValue;
            }
            if($min == true){
                return $paramsValues;
            } else {
                return $paramsArr;
            }
        }
        return null;
    }

}