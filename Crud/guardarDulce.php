<?php
$nombre = $_POST['Nombre'];
$descripcion = $_POST['Descripcion'];
$precio = $_POST['Precio'];
$origen = $_POST['Origen'];
$stock = $_POST['Stock'];

$dulces = new SoapClient(
    null, array(
        'location' => 'https://wsdulcestipicosmexicanos.000webhostapp.com//DulceService.php',
        'uri' => 'https://wsdulcestipicosmexicanos.000webhostapp.com//DulceService.php',
        'trace' => 1
    )
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insersion</title>
    <link rel="stylesheet" href="Css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    

<?php
try {
    $respuest = $dulces->__soapCall("InsertarDulce", [$nombre, $descripcion, $precio, $origen, $stock]);

    if ($respuest == 1) {
        echo '<script>
            Swal.fire({
                title: "Éxito",
                text: "Se insertó correctamente:  ' . $nombre . '",
                icon: "success",
                confirmButtonText: "OK"
            }).then(function() {
                window.location.href = "/CasoPractico4/index.php";
            });
        </script>';
    } else {
        echo '<script>
            Swal.fire({
                title: "Error",
                text: "Error al insertar",
                icon: "error",
                confirmButtonText: "OK"
            });
        </script>';
    }
} catch (SoapFault $e) {
    echo '<script>
        Swal.fire({
            title: "Error",
            text: "' . $e->getMessage() . '",
            icon: "error",
            confirmButtonText: "OK"
        });
    </script>';
}

?>
</body>
</html>
