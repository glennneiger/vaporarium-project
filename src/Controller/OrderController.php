<?php

namespace App\Controller;

use App\Entity\OrderItem;
use App\Entity\Product;
use App\Form\OrderType;
use App\Service\Orders;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OrderController extends Controller
{
    /**
     * @Route("/cart/add/{id}/{quantity}", name="order_add_to_cart")
     */
    public function addToCart(Orders $orders, Request $request, Product $product,  $quantity=1)
    {
        $orders->addToCart($product, $quantity, $this->getUser());

        if($request->isXmlHttpRequest()){
            return $this->render('order/header_cart.html.twig', [
                'cart'=> $orders->getCart()
            ]);
        }

        return $this->redirect($request->headers->get('referer','/'));
    }

    /**
     * @Route("/order", name="order_cart")
     */
    public function cart(Orders $orders, Request $request)
    {
        $cart = $orders->getCart($this->getUser());
        $form = $this->createForm(OrderType::class, $cart);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $orders->makeOrder($cart);

            return $this->redirectToRoute('order_thanks');
        }


        return $this->render('order/cart.html.twig',[
            'order'=>$cart,
            'form'=>$form->createView()
        ]);

    }

    /**
     * @Route("cart/header", name="order_header_cart")
     */
    public function headerCart(Orders $orders){
        return $this->render('order/header_cart.html.twig', [
            'cart'=> $orders->getCart()
        ]);
    }

    /**
     * @Route("cart/update/{id}/{quantity}", name="order_update_item_quantity")
     */
    public function updateCartQuantity(Orders $orders, OrderItem $orderItem, $quantity){

        $quantity = (int)$quantity;
        if($quantity<1){
            $quantity = $orderItem->getQuantity();
        }

        $orders->updateCartItem($orderItem, $quantity);

        $cart = $orders->getCart($this->getUser());
        $form = $this->createForm(OrderType::class, $cart);

        return $this->render('order/cart_table.html.twig', [
            'order'=> $cart,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/order/item/delete/{id}" , name="delete_order_item")
     */
    public function deleteItem(OrderItem $orderItem ,Orders $orders)
    {
        $orders->deleteOrderItem($orderItem);

        $cart = $orders->getCart($this->getUser());
        $form = $this->createForm(OrderType::class, $cart);

        return $this->render('order/cart_table.html.twig', [
            'order'=>$cart,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("cart/thanks", name="order_thanks")
     */
    public function orderThanks()
    {
        return $this->render('order/thanks.html.twig');
    }

}