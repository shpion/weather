<?php

namespace Acme\WeatherBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Endpoint
 *
 * @ORM\Table(name="endpoint")
 * @ORM\Entity(repositoryClass="Acme\WeatherBundle\Entity\EndpointRepository")
 */
class Endpoint
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="serviceName", type="string", length=255)
     */
    private $serviceName;

    /**
     * @var string
     *
     * @ORM\Column(name="endpoint", type="string", length=255)
     */
    private $endpoint;

    /**
     * @var integer
     *
     * @ORM\Column(name="enabled", type="integer", length=1)
     */
    private $enabled;


    /**
     * @var string
     *
     * @ORM\Column(name="parser", type="string", length=100)
     */
    private $parser;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set serviceName
     *
     * @param string $serviceName
     * @return Endpoint
     */
    public function setServiceName($serviceName)
    {
        $this->serviceName = $serviceName;
    
        return $this;
    }

    /**
     * Get serviceName
     *
     * @return string 
     */
    public function getServiceName()
    {
        return $this->serviceName;
    }

    /**
     * Set endpoint
     *
     * @param string $endpoint
     * @return Endpoint
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    
        return $this;
    }

    /**
     * Get endpoint
     *
     * @return string 
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * Set enabled
     *
     * @param integer $enabled
     * @return Endpoint
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    
        return $this;
    }

    /**
     * Get enabled
     *
     * @return integer 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }


    /**
     * Set parser
     *
     * @param string $parser
     * @return Endpoint
     */
    public function setParser($parser)
    {
        $this->parser = $parser;
    
        return $this;
    }

    /**
     * Get parser
     *
     * @return string 
     */
    public function getParser()
    {
        return $this->parser;
    }
}