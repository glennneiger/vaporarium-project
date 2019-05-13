<?php


namespace App\Service;


use App\Entity\BaseConfig;
use Doctrine\ORM\EntityManagerInterface;
use FOS\UserBundle\Mailer\TwigSwiftMailer;
use Symfony\Component\Routing\RouterInterface;

class Mailer extends TwigSwiftMailer
{
    private $em;

    public function __construct(\Swift_Mailer $mailer, RouterInterface $router,
                                \Twig_Environment $twig, EntityManagerInterface $em)
    {
        parent::__construct($mailer, $router, $twig, []);
        $this->em = $em;
    }

    public function sendMessage($templateName, $context, $fromEmail, $toEmail)
    {
        parent::sendMessage($templateName, $context, $fromEmail, $toEmail); // TODO: Change the autogenerated stub
    }

    public function getFromMail(){
        $rep =$this->em->getRepository(BaseConfig::class);
        $base = $rep->findOneBy(array('publish'=>true),array());
        return $base->getFromEmail();
    }

    public function getToMail(){
        $rep = $this->em->getRepository(BaseConfig::class);
        $base = $rep->findOneBy(array('publish'=>true),array());
        return $base->getToEmail();
    }

}

