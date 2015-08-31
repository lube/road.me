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
    protected $id;
    
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
     * @ORM\ManyToMany(targetEntity="Punto")
     * @ORM\JoinTable(name="tramo_puntos",
     *      joinColumns={@ORM\JoinColumn(name="tramo_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="punto_id", referencedColumnName="id")}
     *      )
     */
    private $puntos;
    
    public function __construct($nombre, $puntos, $status = STATUS_TRANSITABLE) {
        $this->puntos = $puntos;
        $this->estado = $status;
        $this->nombre = $nombre;
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
     * Add puntos
     *
     * @param \AppBundle\Entity\Punto $puntos
     * @return Tramo
     */
    public function addPunto(\AppBundle\Entity\Punto $puntos)
    {
        $this->puntos[] = $puntos;

        return $this;
    }

    /**
     * Remove puntos
     *
     * @param \AppBundle\Entity\Punto $puntos
     */
    public function removePunto(\AppBundle\Entity\Punto $puntos)
    {
        $this->puntos->removeElement($puntos);
    }

    /**
     * Get puntos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPuntos()
    {
        return $this->puntos;
    }
}
