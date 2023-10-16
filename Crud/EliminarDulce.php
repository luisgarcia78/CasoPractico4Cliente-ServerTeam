<?php 
$id = $_GET['id'];


$dulces = new SoapClient(
  null, array(
      'location' => 'http://localhost:8080/servidorCasoPRac4/DulceService.php',
      'uri' => 'http://localhost:8080/servidorCasoPRac4/DulceService.php',
      'trace' => 1
  )
);

try {
  $respuest = $dulces-> __soapCall("EliminarDulce",[$id]);
 
  if ($respuest==1) {
    echo 'Se elimino correctamente';

    header("refresh:2;url=/CasoPractico4/index.php");
   
  }else{
    echo 'error al eliminar';
  }
 

} catch (SoapFault $e) {
    echo $e->getMessage();
}
?>