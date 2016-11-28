<?php

/**
 * Created by PhpStorm.
 * User: harold
 * Date: 28/11/2016
 * Time: 3:30
 */
class DatosPersona
{
var $ci;
    var $nombre;
    var $fecha;

    /**
     * DatosPersona constructor.
     * @param $ci
     * @param $nombre
     * @param $fecha
     */
//    public function __construct($ci, $nombre, $fecha)
//    {
//        $this->ci = $ci;
//        $this->nombre = $nombre;
//        $this->fecha = $fecha;
//    }

    /**
     * @return mixed
     */
    public function getCi()
    {
        return $this->ci;
    }

    /**
     * @param mixed $ci
     */
    public function setCi($ci)
    {
        $this->ci = $ci;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }


}