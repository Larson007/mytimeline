<?php

namespace App\Controller;

use App\Repository\TimeLineRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminTimelineController extends AbstractController
{
    /**
     * Gestion des Timelines par l'admin
     * @Route("/admin/timeline", name="admin_timeline")
     */
    public function index(TimeLineRepository $repo)
    {
        return $this->render('admin/timeline/dashboard.html.twig', [
            'timelines' => $repo->findAll() ,
        ]);
    }
}
