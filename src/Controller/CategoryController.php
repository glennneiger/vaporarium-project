<?php

namespace App\Controller;

use App\Service\Categorys;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @var Categorys
     */
    private $categorys;

    public function __construct(
        Categorys $categorys
    )
    {
        $this->categorys = $categorys;
    }


    /**
     * @Route("/category/{id}", name="category_show")
     */
    public function categoryShow($id, Request $request){
        $result = $this->categorys->showCategoryById($id,$request);
        $category = $result['category'];
        return $this->render('category/show.html.twig',[
            'category' => $category]);
    }
}
