<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    /**
     * @Route("/home")
     */
    public function home()
    {
    
        $test = "bitch";
        return $this->render('home.html.twig', [
           'bitch' => $test,
        ]);
    }
}