<?php

class Interpreter{
$texto="";

    /**
     * Interpreter constructor.
     */
    public function __construct($texto)
    {
        $this->
    }

    public function getDatosPersonales(){
$linea = "";
$antLinea = "";

$datapersonal=array();
while (!isFin()){
$antLinea = $linea;
$linea = $getLinea();
//           switch (antLinea){
//               case "O CN":
//                   datapersonal.setCi(linea);
//                   break;
//               default  :
//                   break;
//           }
//           if (//search.getText().toString().equalsIgnoreCase((String) listaDeContactos.get(i).getName().subSequence(0, textlength))
//                   listaDeContactos.get(i).getName().toLowerCase().contains(search.getText().toString().toLowerCase())) {
//               listaDeContactosFiltrados.add(listaDeContactos.get(i));
//           }
if (linea.contains("pertenece")){
datapersonal.setCi(antLinea);
}
if (linea.contains("Nacido el")){
datapersonal.setFechaNacimiento(linea.substring(10));
datapersonal.setNombres(antLinea);
}

}
return datapersonal;

}
public function getLinea(){
$linea ="";
while ( $index < $TextComplete.length()) {
if (TextComplete.charAt(getIndex())==('\n')) {
setIndex(index+1);
return linea;
}
linea +=TextComplete.charAt(getIndex());
setIndex(index+1);
}
setIndex(0);
setFin(true);
return linea;
}
}