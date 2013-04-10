<?php

namespace Acme\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeAdminBundle:Default:index.html.twig');
    }

    public function loginAction()
    {
        return $this->render('AcmeAdminBundle:Default:login.html.twig');
    }
}
