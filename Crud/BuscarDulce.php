<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];

    // Llamar a la función BuscarDulcePorNombre
    $dulces = new SoapClient(
        null, array(
            'location' => 'https://wsdulcestipicosmexicanos.000webhostapp.com/DulceService.php',
            'uri' => 'https://wsdulcestipicosmexicanos.000webhostapp.com/DulceService.php',
            'trace' => 1
        )
    );

   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>resultados de busqueda</title>
    <link rel="shortcut icon" href="/CasoPractico4/img/banner.jpg" type="image/x-icon">

    <link rel="stylesheet" href="Css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php 
    
    try {
        $respuesta = $dulces->__soapCall("BuscarDulcePorOrigen", [$nombre]);

        if (!empty($respuesta)) {
            echo " <div class='divban' style= 'text-align: center;'>
                     <h1 style=' background: linear-gradient(45deg, green, white, red);'>Dulces típicos Mexicanos</h1>
                     <img src='/CasoPractico4/img/images.jpeg' alt='Banner' style='width: 100%';>
                 </div>";
            echo "<h2>Resultados de la búsqueda:</h2>";
            echo '<table class="table table-bordered table-striped" style="max-height: 400px; overflow-y: scroll;">';
            echo '<thead><tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Precio</th><th>Origen</th><th>Stock</th></tr></thead>';
            echo '<tbody>';

            foreach ($respuesta as $dulce) {
                echo '<tr>';
                echo '<td>' . $dulce['ID'] . '</td>';
                echo '<td>' . $dulce['Nombre'] . '</td>';
                echo '<td>' . $dulce['Descripcion'] . '</td>';
                echo '<td>' . $dulce['Precio'] . '</td>';
                echo '<td>' . $dulce['Origen'] . '</td>';
                echo '<td>' . $dulce['Stock'] . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<div class="alert alert-warning">No se encontraron resultados.</div>';
        }
    } catch (SoapFault $e) {
        echo '<div class="alert alert-danger">Error al buscar dulces: ' . $e->getMessage() . '</div>';
    }
    
    ?>
<div> <a href="/CasoPractico4/index.php" class="btn btn-primary" style="float: right; ">Regresar</a></div>
</body>
</html>