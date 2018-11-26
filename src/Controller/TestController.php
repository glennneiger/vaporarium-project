<?php

namespace App\Controller;

use App\Entity\BaseConfig;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class TestController extends AbstractController
{
    /**
     * @Route("/", name="test")
     */
    public function index(EntityManagerInterface $em)
    {
        $rep = $em->getRepository(BaseConfig::class);
        $base = $rep->findOneBy(array('publish'=>true),array());

        return $this->render('test/index.html.twig',
            ['base' => $base]
        );
    }
}
