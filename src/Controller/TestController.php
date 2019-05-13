<?php

namespace App\Controller;

use App\Entity\BaseConfig;
use App\Entity\Product;
use App\Entity\Test;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class TestController extends AbstractController
{
    /**
     * @Route("test", name="test")
     */
    public function index(EntityManagerInterface $em)
    {
        $rep = $em->getRepository(BaseConfig::class);
        $base = $rep->findOneBy(array('publish'=>true),array());

        $rep1 = $em->getRepository(Test::class);
        $test = $rep1->findAll();

        $rep2 = $em->getRepository(Product::class);
        $product = $rep2->findAll();

        return $this->render('test/index.html.twig',
            [
                'base' => $base,
                'test' => $test,
                'products' => $product
            ]
        );
    }
    public function showCategoryById($id, $request){
        $rep = $this->em->getRepository(Category::class);

        $categoryOne = $rep->find($id);
        $subcategoryIsNotNull = false;
        foreach ($categoryOne->getSubcategories() as $item){
            $subcategoryIsNotNull = true;
            break;
        }
        if($subcategoryIsNotNull == false){
            $dbCat = $rep->createQueryBuilder('cat');
            $dbCat
                ->leftJoin('cat.subcategories', 'subcat')
                ->select('cat,subcat')
                ->where('cat.id = :id AND cat.publish = true')
                ->setParameter('id',$id);
            $category = $dbCat->getQuery()->getOneOrNullResult();
            $result['category'] = $category;
            return $result;
        } else {
            $dbCat = $rep->createQueryBuilder('cat');
            $dbCat
                ->leftJoin('cat.subcategories', 'subcat')
                ->select('cat,subcat')
                ->where('cat.id = :id AND subcat.publish = true')
                ->setParameter('id',$id);
            $category = $dbCat->getQuery()->getOneOrNullResult();
            $result['category'] = $category;
            return $result;
        }



    }

}

