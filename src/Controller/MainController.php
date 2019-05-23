<?php

namespace App\Controller;

use App\Form\QuestionType;
use App\Service\Base;
use App\Service\Categorys;
use App\Service\Products;
use App\Service\Mailer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @var Base
     */
    private $base;

    /**
     * @var Categorys
     */
    private $categorys;

    /**
     * @var Products
     */
    private $products;

    public function __construct(
        Base $base,
        Categorys $categorys,
        Products $products

    )
    {
        $this->base = $base;
        $this->categorys = $categorys;
        $this->products = $products;
    }

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('base/home.html.twig',[
            'base' => $this->base->getBaseContent(),
            'productsIsTop' => $this->products->getProductInIsTop(),
            'productsIsStock' => $this->products->getProductInStock()
            ]
        );
    }

    public function background()
    {
        return $this->render('background.html.twig', ['base' => $this->base->getBaseContent()]);
    }

    public function menu()
    {
        return $this->render('base/menu.html.twig',[
                'category'=> $this->categorys->getChildrenHierarchy()
            ]
        );
    }

    public function sliderBase()
    {
        return $this->render('base/sliderBase.html.twig',[
            'base'=> $this->base->getBaseContent()
            ]
        );
    }

    public function stockSlider(){
        return $this->render('base/stock_slider.html.twig',[
            'stockSlider' => $this->base->getStock()
            ]
        );
    }

    public function footer()
    {
        $form = $this->createForm(QuestionType::class);

        return $this->render('base/footer.html.twig',[
            'base' => $this->base->getBaseContent(),
            'formQuestion'=>$form->createView()
            ]
        );
    }

    /**
     * @Route("/contacts", name="contacts")
     */
    public function contacts()
    {
        return $this->render('base.html.twig');
    }

    /**
     * @Route("sendquestion", name="sendquestion")
     */
    public function sendQuestion(Request $request, Mailer $mailer)
    {
        $form = $this->createForm(QuestionType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $task = $form->getData();
            $mailer->sendMessage(
                'question/message.msg.twig',
                ['task' =>$task],
                $mailer->getFromMail(),
                $mailer->getToMail()
            );
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();
            return $this->redirectToRoute('thanksForQuestion');
        }
    }

    /**
     * @Route("/thanks", name="thanksForQuestion")
     */
    public function thanksForQuestion()
    {
        return $this->render('question/thanks_for_question.html.twig');
    }
}
