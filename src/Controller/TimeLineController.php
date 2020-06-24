<?php

namespace App\Controller;

use App\Entity\TimeLine;
use App\Form\TimeLineType;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

        /**
     * permet de créer une timeline
     *
     * @Route("/timelines/new", name="timeline_create")
     * 
     * @IsGranted("ROLE_USER")
     * 
     * 
     * @return Response
     */
    public function create (Request $request)
    {
        $timeline = new TimeLine();
        $form = $this->createForm(TimeLineType::class, $timeline);

        return $this->render('timeline/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
