<?php

namespace App\Controller;

use App\Service\Categorys;
use App\Service\Products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @var Categorys
     */
    private $categorys;

    /**
     * @var Products
     */
    private $products;

    public function __construct(
        Categorys $categorys,
        Products $products
    )
    {
        $this->categorys = $categorys;
        $this->products = $products;
    }


    /**
     * @Route("/category/{id}", name="category_show")
     */
    public function categoryShow($id, Request $request){

        $paramsValues = $this->products->getFiltersParams($request, true);
        $sortedByPrice = $this->products->getSortedByPrice($request);
        $result = $this->categorys->showCategoryById($id);
        $category = $result['category'];
        $products = $this->products->getProductInCategory($id, $request);

        return $this->render('category/show.html.twig',[
            'category' => $category,
            'products' => $products,
            'paramsValues' => $paramsValues,
            'sortedByPrice' => $sortedByPrice
        ]);
    }
}
