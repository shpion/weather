<?php

namespace Acme\AdminBundle\Features\Context;

use Symfony\Component\HttpKernel\KernelInterface;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Behat\MinkExtension\Context\MinkContext;

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use Acme\WeatherBundle\Entity\Endpoint;
use Symfony\Component\DependencyInjection\Container;
use Doctrine\ORM\EntityManager;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Feature context.
 */
class FeatureContext extends MinkContext //MinkContext if you want to test web
                  implements KernelAwareInterface
{
    private $kernel;
    private $parameters;

    /**
     * Initializes context with parameters from behat.yml.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * Sets HttpKernel instance.
     * This method will be automatically called by Symfony2Extension ContextInitializer.
     *
     * @param KernelInterface $kernel
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

//
// Place your definition and hook methods here:
//
//    /**
//     * @Given /^I have done something with "([^"]*)"$/
//     */
//    public function iHaveDoneSomethingWith($argument)
//    {
//        $container = $this->kernel->getContainer();
//        $container->get('some_service')->doSomethingWith($argument);
//    }
//

//    /**
//     * @Given /^there are users:$/
//     */
//    public function thereAreUsers(TableNode $table)
//    {
////        $userManager = $this->getContainer()->get('fos_user.user_manager');
//        foreach ($table->getHash() as $hash) {
//
//            $endpoint = new Endpoint();
//            $endpoint->setServiceName($hash['serviceName']);
//            $endpoint->setEndpoint($hash['endpoint']);
//            $endpoint->setEnabled($hash['enabled']);
//            $endpoint->setParser($hash['parser']);
//
//
////            $user = $userManager->createUser();
////            $user->setUsername($hash['username']);
////            $user->setPlainPassword($hash['password']);
////            $user->setEmail($hash['email']);
////            $user->setEnabled(true);
////            $userManager->updateUser($user);
//
////            $controller = new Conntroller();
////            $em = $controller->getDoctrine()->getManager();
//
////            $em = $this->getContainer()->get('doctrine.orm.entity_manager');
////            $em->persist($endpoint);
////            $em->flush();
//
//            $em = $this->getContainer()->get('@AcmeAdminBundle.Endpoint');
////            $em->createQuery('DELETE LTSpringBundle:Testimonial')->execute();
////            $em->createQuery('DELETE LTSpringBundle:Project')->execute();
////            $em->flush();
//
//
//        }
//    }
}
