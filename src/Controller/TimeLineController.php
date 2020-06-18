<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TimeLineController extends AbstractController
{
    /**
     * @Route("/timelines", name="timelines")
     */
    public function index()
    {
        return $this->render('timeline/index.html.twig', [
            'controller_name' => 'TimeLineController',
        ]);
    }
}
