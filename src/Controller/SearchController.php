<?php

namespace App\Controller;


use App\Service\Search;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class SearchController extends AbstractController
{
    /**
     * @var Search
     */
    private $search;

    public function __construct(
        Search $search
    )
    {
        $this->search = $search;
    }

    /**
     * @Route("/search", name="search")
     */
    public function search(Request $request){

        $products = $this->search->getSearchResult($request);

        return $this->render('search/search_result.html.twig', ['products'=>$products]);
    }

}