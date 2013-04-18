<?php
// src/Acme/WeatherBundle/Entity/CodeWeather.php
namespace Acme\WeatherBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Acme\WeatherBundle\Entity\CodeWeatherRepository")
 * @ORM\Table(name="code_weather")
 */
class CodeWeather
{
  /**
 * @ORM\Id
 * @ORM\Column(type="integer")
 * @ORM\GeneratedValue(strategy="AUTO")
 */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $dayIcon;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $nightIcon;

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
     * Set code
     *
     * @param integer $code
     * @return CodeWeather
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get code
     *
     * @return integer 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set desc
     *
     * @param string $description
     * @return CodeWeather
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get desc
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dayIcon
     *
     * @param string $dayIcon
     * @return CodeWeather
     */
    public function setDayIcon($dayIcon)
    {
        $this->dayIcon = $dayIcon;
    
        return $this;
    }

    /**
     * Get dayIcon
     *
     * @return string 
     */
    public function getDayIcon()
    {
        return $this->dayIcon;
    }

    /**
     * Set nightIcon
     *
     * @param string $nightIcon
     * @return CodeWeather
     */
    public function setNightIcon($nightIcon)
    {
        $this->nightIcon = $nightIcon;
    
        return $this;
    }

    /**
     * Get nightIcon
     *
     * @return string 
     */
    public function getNightIcon()
    {
        return $this->nightIcon;
    }
}