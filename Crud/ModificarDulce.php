<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $origen = $_POST['origen'];
    $stock = $_POST['stock'];

    // Llamar a la función ActualizarDulce
    $dulces=new SoapClient(
        null,array(
          'location' => 'http://localhost:8080/servidorCasoPRac4/DulceService.php',
          'uri' => 'http://localhost:8080/servidorCasoPRac4/DulceService.php',
          'trace' => 1
        )
    );

    try {
        $respuest = $dulces->__soapCall("ActualizarDulce", [$id, $nombre, $descripcion, $precio, $origen, $stock]);
       
        if ($respuest==1) {
          echo 'Se Actualizo correctamente   '.$nombre;
          
          header("refresh:2;url=/CasoPractico4/index.php");
         
        }else{
          echo 'error al Actualizar';
        }
       
      
      } catch (SoapFault $e) {
          echo $e->getMessage();
      }
}
