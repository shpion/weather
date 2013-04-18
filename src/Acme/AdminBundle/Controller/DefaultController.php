<?php

namespace Acme\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Acme\WeatherBundle\Entity\Endpoint;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $endpoint = new Endpoint();
        $form = $this->createFormBuilder($endpoint)
            ->add('enabled', 'checkbox', array('required' => false, 'attr' => array('checked' => 'checked')))
            ->add('serviceName', 'text')
            ->add('endpoint', 'text', array('trim' => true))
            ->add('parser', 'text', array('trim' => true))
            ->getForm();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $task = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($task);
                $em->flush();
            }
        }

        $em = $this->getDoctrine()->getManager();
        $endpoints = $em->getRepository('AcmeWeatherBundle:Endpoint')->getEndpoins();

        return $this->render('AcmeAdminBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
            'endpoints' => $endpoints,
        ));
    }

    public function loginAction()
    {
        return $this->render('AcmeAdminBundle:Default:login.html.twig');
    }

    public function disabledEndpointAction($id){

        $endpoint = $this->getDoctrine()->getRepository('AcmeWeatherBundle:Endpoint')->find($id);
        if($endpoint){
            if($endpoint->getEnabled())
                $endpoint->setEnabled(0);
            else
                $endpoint->setEnabled(1);

            $em = $this->getDoctrine()->getManager();
            $em->persist($endpoint);
            $em->flush();

            $disabled = 1;
        }
        else
            $disabled = 0;

        return $this->render('AcmeAdminBundle:Default:disabledEndpoint.html.twig', array('disabled'=>$disabled));
    }
}
