<?php
/**
 * Created by PhpStorm.
 * User: Harold
 * Date: 21/11/2016
 * Time: 3:48
 */
$target_path = "uploads/";
$target_path = $target_path . basename($_FILES['uploadedfile']['name']);
if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    echo "El archivo " . basename($_FILES['uploadedfile']['name']) . " ha sido subido";
} else {
    echo "Ha ocurrido un error, trate de nuevo!";
}