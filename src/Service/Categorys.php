<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Category;

class Categorys
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

    public function getChildrenHierarchy(){
        return $this->publishCategory($this->em->getRepository(Category::class)->childrenHierarchy());
    }

    private function publishCategory($arrChildrenHierarchy){
        $this->arrPublish($arrChildrenHierarchy);
        return $arrChildrenHierarchy;
    }

    private function arrPublish(&$arrChildrenHierarchy){
        $i = 0;
        foreach ($arrChildrenHierarchy as &$arr){
            if ($arr['publish'] == false){
                unset($arrChildrenHierarchy[$i]);
            }   $i++;
            if(isset($arr) AND $arr['__children'] != null){
            $this->arrPublish($arr['__children']);
            }
        }
    }

    public function showCategoryById($id){
        $rep = $this->em->getRepository(Category::class);

        $dbCat = $rep->createQueryBuilder('cat');
        $dbCat
            ->leftJoin('cat.subcategories', 'subcat')
            ->select('cat,subcat')
            ->where('cat.id = :id AND cat.publish = true AND subcat.publish = true')
            ->setParameter('id',$id);
        $category = $dbCat->getQuery()->getOneOrNullResult();
        $result['category'] = $category;


        $categoryOne = $rep->find($id);
        $subcategoryIsNotNull = false;
        foreach ($categoryOne->getSubcategories() as $item){
            $subcategoryIsNotNull = true;
            break;
        }

        if($result['category'] == null && $subcategoryIsNotNull == true){
            foreach ($categoryOne->getSubcategories() as $subcategory){
                $categoryOne->removeSubcategory($subcategory);
            }
            $result['category'] = $categoryOne;
        }

        if($subcategoryIsNotNull == false){
            $dbCat = $rep->createQueryBuilder('cat');
            $dbCat
                ->leftJoin('cat.subcategories', 'subcat')
                ->leftJoin('cat.products', 'products')
                ->leftJoin('cat.characteristicItemForCategory', 'characteristic')
                ->leftJoin('characteristic.CharacteristicProduct', 'characteristicProduct')
                ->leftJoin('characteristicProduct.characteristicValue', 'characteristicValue')
                ->select('cat,subcat,products,characteristic,characteristicProduct,characteristicValue')
                ->where('cat.id = :id AND cat.publish = true')
                ->setParameter('id',$id);
            $categoryResult = $dbCat->getQuery()->getOneOrNullResult();
            $result['category'] = $categoryResult;
        }

        return $result;

}

}