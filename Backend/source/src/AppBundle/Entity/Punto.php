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
     * @ORM\Column(type="integer")
     */
    private $id;
    
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
     * Set id
     *
     * @return integer 
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this->id;
    }

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

    /**
     * Set lat
     *
     * @return Punto
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return float 
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @return Punto
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng
     *
     * @return float 
     */
    public function getLng()
    {
        return $this->lng;
    }
}
