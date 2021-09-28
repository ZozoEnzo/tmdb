<?php

namespace App\Controller;

use App\Service\CallApiMovie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    /**
     * @Route("/default", name="default")
     */
    public function index(CallApiMovie $callApiMovie): Response
    {
        return $this->render('default/index.html.twig', [
            'allGenre' => $callApiMovie->getListGenreMovie(),
            'mostPopular' => $callApiMovie->getMostPopular(),
        ]);
    }
}
