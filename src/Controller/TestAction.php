<?php

namespace App\Controller;

use App\Model\MyObject;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestAction extends AbstractController
{
    #[Route('/test')]
    public function __invoke(Request $request): Response
    {
        $obj = new MyObject();
        $obj->setValue(1);

        $form = $this->createFormBuilder($obj)
            ->setMethod('POST')
            ->add('value', IntegerType::class, [
                'getter' => fn(MyObject $object) => $object->getConfiguredValue(),
            ])
            ->add('save', SubmitType::class, ['label' => 'Submit'])
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $obj = $form->getData();
            dump($obj);
        }

        return new Response($this->renderView('test.html.twig', [
            'form' => $form->createView(),
        ]));
    }
}
