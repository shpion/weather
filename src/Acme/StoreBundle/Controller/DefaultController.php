<?php

namespace Acme\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Acme\StoreBundle\Entity\Product;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
//        $product = new Product();
//        $product->setName($name);
//        $product->setPrice('19.99');
//        $product->setDescription('Lorem ipsum dolor');
//
//        $em = $this->getDoctrine()->getEntityManager();
//        $em->persist($product);
//        $em->flush();

//        $em = $this->getDoctrine()->getEntityManager();
//        $query = $em->createQuery(
//            'SELECT p FROM AcmeStoreBundle:Product p WHERE p.name = :name ORDER BY p.price ASC'
//        )->setParameter('name', $name);
//
//        $product = $query->getSingleResult();
//


        $em = $this->getDoctrine()->getEntityManager();
        $products = $em->getRepository('AcmeStoreBundle:Product')->findAllOrderedByName();

        return $this->render('AcmeStoreBundle:Default:index.html.twig', array('name' => $name, 'products' => $products));
    }

    public function createAction()
    {
        $product = new Product();
        $product->setName('A Foo Bar');
        $product->setPrice('19.99');
        $product->setDescription('Lorem ipsum dolor');

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($product);
        $em->flush();

        return new Response('Created product id '.$product->getId());
    }
}
