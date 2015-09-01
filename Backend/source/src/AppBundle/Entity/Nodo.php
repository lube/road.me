<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Table()
 * @ORM\Entity
 */
class Nodo {

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Tramo", inversedBy="nodos")
     * @ORM\JoinColumn(name="tramo_id", referencedColumnName="id")
     **/
    private $tramo;
    
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Punto")
     * @ORM\JoinColumn(name="punto_id", referencedColumnName="id")
     **/
    private $punto;

    /**
     * @ORM\Id
     * @var type integer
     * @ORM\Column(type="integer")
     */
    private $orden;

    /**
     * Set orden
     *
     * @param integer $orden
     * @return Nodo
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return integer 
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set tramo
     *
     * @param \AppBundle\Entity\Tramo $tramo
     * @return Nodo
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
     * Set punto
     *
     * @param \AppBundle\Entity\Punto $punto
     * @return Nodo
     */
    public function setPunto(\AppBundle\Entity\Punto $punto = null)
    {
        $this->punto = $punto;

        return $this;
    }

    /**
     * Get punto
     *
     * @return \AppBundle\Entity\Punto 
     */
    public function getPunto()
    {
        return $this->punto;
    }
}
