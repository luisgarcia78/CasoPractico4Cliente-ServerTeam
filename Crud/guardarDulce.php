<?php
$nombre = $_POST['Nombre'];
$descripcion = $_POST['Descripcion'];
$precio = $_POST['Precio'];
$origen = $_POST['Origen'];
$stock = $_POST['Stock'];

$dulces = new SoapClient(
    null, array(
        'location' => 'http://localhost:8080/servidorCasoPRac4/DulceService.php',
        'uri' => 'http://localhost:8080/servidorCasoPRac4/DulceService.php',
        'trace' => 1
    )
);

try {
    $respuest = $dulces->__soapCall("InsertarDulce", [$nombre, $descripcion, $precio, $origen, $stock]);

    if ($respuest == 1) {
        echo 'Se insertó correctamente ' . $nombre;
        // Redirige automáticamente a la página de inicio después de 2 segundos
        header("refresh:2;url=/CasoPractico4/index.php");
    } else {
        echo 'Error al insertar';
    }
} catch (SoapFault $e) {
    echo $e->getMessage();
}
?>
