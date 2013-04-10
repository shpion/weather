<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HelloController extends Controller
{
    public function indexAction($name, $_format)
    {
        /*
         * The action's view can be rendered using render() method
         * or @Template annotation as demonstrated in DemoController.
         *
         */
        if($name == "Roman")
            $year = 123;
        else
            $year = 0;

        if ($name == "Bob") {
            throw new NotFoundHttpException('The name does not exist.');
        }

        return $this->render('AcmeDemoBundle:Hello:index.'.$_format.'.twig', array('name' => $name, 'year' => $year));
    }
}
