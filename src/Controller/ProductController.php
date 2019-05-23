<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\Base;
use App\Service\Products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    /**
     * @var Base
     */
    private $base;

    /**
     * @var Products
     */
    private $products;

    public function __construct(
        Base $base,
        Products $products
    )
    {
        $this->base = $base;
        $this->products = $products;
    }

    /**
     * @Route("/product/{id}", name="product_id")
     */
    public function productById(Product $product){
        return $this->render('product/product_id.html.twig', [
            'product'=>$product,
            'productsIsStock' => $this->products->getProductInStock(),
            'base' => $this->base->getBaseContent()
        ]);
    }

}