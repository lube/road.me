<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Table()
 * @ORM\Entity
 */
class Incidente {

    const STATUS_CORTE_TOTAL = 'CORTE TOTAL';
    const STATUS_CORTE_PARCIAL = 'CORTE PARCIAL';

    /**
     *
     * @var type integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups({"client"})
     */
    protected $id;
    
    /**
     *
     * @var type string
     * @ORM\Column(type="string")
     * @Groups({"client"})
     */
    private $nombre;

    /**
     *
     * @var type string
     * @ORM\Column(type="string")
     * @Groups({"client"})
     */
    private $descripcion;

    /**
     *
     * @var type float
     * @ORM\Column(type="float")
     * @Groups({"client"})
     */
    private $lat;

        /**
     *
     * @var type float
     * @ORM\Column(type="float")
     * @Groups({"client"})
     */
    private $lng;
    
    /**
     *
     * @var type string
     * @ORM\Column(type="string")
     * @Groups({"client"})
     */
    private $tipoIncidente;

    /**
     *
     * @var type string
     * @ORM\Column(type="boolean")
     */
    private $estado;

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

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Incidente
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set lat
     *
     * @param float $lat
     * @return Incidente
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
     * @param float $lng
     * @return Incidente
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

    /**
     * Set tipoIncidente
     *
     * @param string $tipoIncidente
     * @return Incidente
     */
    public function setTipoIncidente($tipoIncidente)
    {
        $this->tipoIncidente = $tipoIncidente;

        return $this;
    }

    /**
     * Get tipoIncidente
     *
     * @return string 
     */
    public function getTipoIncidente()
    {
        return $this->tipoIncidente;
    }
}
