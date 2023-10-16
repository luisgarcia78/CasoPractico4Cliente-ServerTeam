<?php
// Verificar si se ha enviado un ID para editar
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $dulces = new SoapClient(
        null, array(
            'location' => 'https://wsdulcestipicosmexicanos.000webhostapp.com/DulceService.php',
            'uri' => 'https://wsdulcestipicosmexicanos.000webhostapp.com/DulceService.php',
            'trace' => 1
        )
    );

    try {
        $respuest = $dulces->__soapCall("ObtenerDulcesPorID", [$id]); // Obtener el dulce por ID
        $result = json_encode($respuest, true);
        $datos = json_decode($result, true);

        if (count($datos) > 0) {
            $item = $datos[0]; // Tomar el primer resultado (debe ser único)
        } else {
            echo 'El dulce no se encontró.';
        }
    } catch (\Throwable $th) {
        echo 'Error al obtener detalles del dulce.';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Dulce</title>
    <link rel="shortcut icon" href="img/banner.jpg" type="image/x-icon">
    <link rel="stylesheet" href="Css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style=" background-image: url('img/fondoForm.jpg'); " class="formAdd">

<div class="container" style="margin-top: 10%;">
    <div class="row justify-content-center">
        <div class="col-md-6 form-container">
            <form action="/CasoPractico4/Crud/ModificarDulce.php" method="post">
                <input type="text" name="id" value="<?php echo $item['ID']; ?>" style="display: none;">
                <h1 style="text-align: center;">Editar </h1>
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" value="<?php echo $item['Nombre']; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea name="descripcion" class="form-control"><?php echo $item['Descripcion']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="number" name="precio" value="<?php echo $item['Precio']; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="origen">Origen:</label>
                    <input type="text" name="origen" value="<?php echo $item['Origen']; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="stock">Stock:</label>
                    <input type="number" name="stock" value="<?php echo $item['Stock']; ?>" class="form-control">
                </div>
                <input type="submit" value="Actualizar" class="btn btn-primary">
                <a href="index.php" type="button" class="btn btn-outline-danger">Cancelar</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
