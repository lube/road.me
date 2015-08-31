<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Table()
 * @ORM\Entity
 */
class Punto {

    /**
     *
     * @var type integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /**
     *
     * @ORM\Column(type="float")
     */
    private $lat;
    
    /**
     *
     * @var type Punto
     * @ORM\Column(type="float")
     */
    private $lng;

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
     * Set latitud
     *
     * @param float $latitud
     * @return Punto
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;

        return $this;
    }

    /**
     * Get latitud
     *
     * @return float 
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * Set longitud
     *
     * @param float $longitud
     * @return Punto
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;

        return $this;
    }

    /**
     * Get longitud
     *
     * @return float 
     */
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * Set tramo
     *
     * @param \AppBundle\Entity\Tramo $tramo
     * @return Punto
     */
    public function setTramo(\AppBundle\Entity\Tramo $tramo = null)
    {
        $this->tramo = $tramo;

        return $this;
    }

    /**
     * Get tramo
     *
     * @return \AppBundle\Entity\Tramo 
     */
    public function getTramo()
    {
        return $this->tramo;
    }
}