<?php

use Doctrine\Common\Annotations\AnnotationRegistry;

$loader = require __DIR__.'/../vendor/autoload.php';

//$loader->registerNamespaces(array(
//    'Behat\BehatBundle' =>  __DIR__.'/../../testsuite.behat/vendor',
//    'Behat\Behat'       =>  __DIR__.'/../../testsuite.behat/vendor/Behat/Behat/src',
//    'Behat\Gherkin'     =>  __DIR__.'/../../testsuite.behat/vendor/Behat/Gherkin/src',
//    'Behat\Mink'        =>  __DIR__.'/../../testsuite.behat/vendor/Behat/Mink/src',
//    'Behat\MinkBundle'  =>  __DIR__.'/../../testsuite.behat/vendor',
//    'Goutte'            =>  __DIR__.'/../../testsuite.behat/vendor/Goutte/src',
//    'Zend'              =>  __DIR__.'/../../testsuite.behat/vendor/Zend/library',
//    'Behat\SahiClient'  =>  __DIR__.'/../../testsuite.behat/vendor/Behat/SahiClient/src',
//    'Buzz'              =>  __DIR__.'/../../testsuite.behat/vendor/Buzz/lib'
//    ));

// intl
if (!function_exists('intl_get_error_code')) {
    require_once __DIR__.'/../vendor/symfony/symfony/src/Symfony/Component/Locale/Resources/stubs/functions.php';
}

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

return $loader;
