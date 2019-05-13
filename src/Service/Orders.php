<?php

namespace App\Service;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Orders
{
    const CART_ID = 'cart';

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * @var Base
     */
    private $base;

    public function __construct(
        SessionInterface $session,
        EntityManagerInterface $em,
        Mailer $mailer,
        Base $base
    )
    {
        $this->session = $session;
        $this->em = $em;
        $this->mailer = $mailer;
        $this->base = $base;
    }


    public function hasCart()
    {
        return $this->session->has(self::CART_ID);
    }

    public function getCart(User $user = null) : Order
    {
        $order = null;
        $orderId = $this->session->get(self::CART_ID);

        if($orderId!==null){
            $order = $this->em->find(Order::class, $orderId);
        }
        if($order === null){
            $order = new Order();

        }
        if($user){
            $order->setUser($user);
        }

        return $order;
    }

    public function addToCart(Product $product, $quantity, User $user = null) : Order
    {
        $order = $this->getCart($user);
        $this->em->persist($order);
        $orderItem = null;

        foreach($order->getOrderitems() as $items){
            if($items->getProduct()->getId() == $product->getId()){
                $orderItem = $items;
                break;
            }
        }

        if(!$orderItem){
            $orderItem = new OrderItem();
            $orderItem->setProduct($product);
            $this->em->persist($orderItem);
            $order->addOrderitem($orderItem);
        }

        $orderItem->setQuantity($orderItem->getQuantity()+$quantity);
        $this->em->flush();
        $this->session->set(self::CART_ID, $order->getId());

        return $order;
    }

    public function updateCartItem(OrderItem $orderItem, $quantity){
        $orderItem->setQuantity($quantity);
        $this->em->flush();

        $cart = $this->getCart();
        $cart->updateAmount();
        $this->em->flush();

        return $cart;
    }

    public function deleteOrderItem(OrderItem $orderItem)
    {
        $this->em->remove($orderItem);
        $this->em->flush();
        $this->getCart()->updateAmount();
        $this->em->flush();
    }

    public function makeOrder(Order $order){
        $order->setStatus(Order::STATUS_ORDERED);
        $toClientEmail = null;
        $toClientEmail = $order->getEmail();
        $this->em->flush();
        $this->session->remove(self::CART_ID);

        $this->mailer->sendMessage(
            'order/mail/manager.msg.twig',
            ['order' =>$order],
            $this->mailer->getFromMail(),
            $this->mailer->getToMail()
        );
        if($toClientEmail){
            $this->mailer->sendMessage(
                'order/mail/client.msg.twig',
                ['base' => $this->base->getBaseContent()],
                $this->mailer->getFromMail(),
                $toClientEmail
            );
        }
    }

}