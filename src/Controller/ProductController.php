<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\Categorys;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/{id}", name="product_id")
     */
    public function productById(Product $product){
        return $this->render('product/product_id.html.twig', ['product'=>$product]);
    }
}