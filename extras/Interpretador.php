<?php

// clase base con propiedades y métodos miembro
class Interpretador {

    var $textCompleto;
    var $index;
    var $fin;

    function Interpretador($textCompleto="")
    {
        $this->textCompleto=$textCompleto;
        $this->index=0;
        $this->fin=false;
    }

    /**
     * @return mixed
     */
    public function getTextCompleto()
    {
        return $this->textCompleto;
    }

    /**
     * @param string $textCompleto
     */
    public function setTextCompleto($textCompleto)
    {
        $this->textCompleto = $textCompleto;
    }

    /**
     * @return mixed
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @param mixed $index
     */
    public function setIndex($index)
    {
        $this->index = $index;
    }

    /**
     * @return mixed
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * @param mixed $fin
     */
    public function setFin($fin)
    {
        $this->fin = $fin;
    }
public function getDatosPersonales(){
    $linea="";
    $antLinea="";
    $datosP=new DatosPersona();
    while (!$this->getFin()){
        $antLinea=$linea;
        $linea=$this->getLinea();
        if (strpos($linea,"pertenece")){
            $datosP->setCi($antLinea);
        }
        if (strpos($linea,"Nacido el")){
            $datosP->setFecha(substr($linea,10));
            $datosP->setNombre($antLinea);
        }
    }
    return $datosP;
}
    public function getLinea(){
        $linea="";
        $texto=$this->textCompleto;
        while ($this->index < strlen($texto)){
            if ($texto[$this->getIndex()]=='\n'){
                $this->setIndex($this->getIndex()+1);
                return $linea;
            }
            $linea=$linea.$texto[$this->getIndex()];
            $this->setIndex($this->getIndex());
        }
        $this->setIndex(0);
        $this->setFin(true);
        return $linea;
    }


}