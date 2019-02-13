<?php

// src/Controller/EstablishmentController.php
namespace App\Controller;

use App\Entity\Establishment;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class EstablishmentController extends AbstractController
{   
    /**
    * @Route("/establishment/new")
    */
    public function new(Request $request)
    {
        $establishment = new Establishment();
        // $establishment->setEstablishment('33');

        $establishmentForm = $this->createFormBuilder($establishment)
            ->add('establishment', TextType::class)
            ->add('establishmentDescription', TextType::class)
            ->add('address', TextType::class)
            ->add('telephone', IntegerType::class)
            ->add('email', EmailType::class)
            ->add('facebook', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Establishment'])
            ->getForm();

            $establishmentForm->handleRequest($request);

            if ($establishmentForm->isSubmitted() && $establishmentForm->isValid()) {

                echo 'test';
                // $form->getData() holds the submitted values
                // but, the original `$task` variable has also been updated
          
                // ... perform some action, such as saving the establishment to the database
                // for example, if Establishment is a Doctrine entity, save it!
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($establishment);
                $entityManager->flush();
               
                return $this->redirectToRoute('establishment_success');
            }
            
        return $this->render('establishment/new.html.twig', [
            'establishmentForm' => $establishmentForm->createView(),
        ]);
    }

     /**
     *
     * @Route("/establishment/success", name="establishment_success")
     * 
     */
    public function establishment_success() {
        $this->addFlash('success', 'yolo');
        return $this->render('establishment/success.html.twig', []);
    }
}