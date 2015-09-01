<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Table()
 * @ORM\Entity
 */
class Tramo {

    const STATUS_TRANSITABLE = 'TN';
    const STATUS_NO_TRANSITABLE = 'INT';
    const STATUS_TRANSITABLE_PRECAUCION = 'TP';
    const STATUS_TRANSITABLE_PRECAUCION_EXTREMA = 'TEP';

    /**
     *
     * @var type integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     *
     * @var type string
     * @ORM\Column(type="string")
     */
    private $nombre;
    
    /**
     *
     * @var type string
     * @ORM\Column(type="string")
     */
    private $estado;

    /**
     * @ORM\OneToMany(targetEntity="Nodo", mappedBy="tramo")
     **/
    private $nodos;
     
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
     * Constructor
     */
    public function __construct()
    {
        $this->punto = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     * @return Tramo
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Tramo
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Add punto
     *
     * @param \AppBundle\Entity\Punto $punto
     * @return Tramo
     */
    public function addPunto(\AppBundle\Entity\Punto $punto)
    {
        $this->punto[] = $punto;

        return $this;
    }

    /**
     * Remove punto
     *
     * @param \AppBundle\Entity\Punto $punto
     */
    public function removePunto(\AppBundle\Entity\Punto $punto)
    {
        $this->punto->removeElement($punto);
    }

    /**
     * Get punto
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPunto()
    {
        return $this->punto;
    }

    /**
     * Add nodos
     *
     * @param \AppBundle\Entity\Nodo $nodos
     * @return Tramo
     */
    public function addNodo(\AppBundle\Entity\Nodo $nodos)
    {
        $this->nodos[] = $nodos;

        return $this;
    }

    /**
     * Remove nodos
     *
     * @param \AppBundle\Entity\Nodo $nodos
     */
    public function removeNodo(\AppBundle\Entity\Nodo $nodos)
    {
        $this->nodos->removeElement($nodos);
    }

    /**
     * Get nodos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNodos()
    {
        return $this->nodos;
    }
}
