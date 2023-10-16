<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar nuevo dulce</title>
    <link rel="stylesheet" href="Css/style.css">
    <!-- Agregar enlaces a Bootstrap CSS y JavaScript -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-image: url('img/fondoForm.jpg');" class="formAdd">
    <div class="container" style="margin-top: 10%;">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                
                <form action="Crud/guardarDulce.php" method="post">
                <h1 style="text-align: center;">Agregar </h1>
                    <div class="form-group">
                        <label for="Nombre">Nombre</label>
                        <input type="text" class="form-control" name="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="Descripcion">Descripcion</label>
                        <textarea name="Descripcion" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Precio">Precio</label>
                        <input type="text" class="form-control" name="Precio">
                    </div>
                    <div class="form-group">
                        <label for="Origen">Origen</label>
                        <input type="text" class="form-control" name="Origen">
                    </div>
                    <div class="form-group">
                        <label for="Stock">Stock</label>
                        <input type="text" class="form-control" name="Stock">
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="index.php" type="button" class="btn btn-outline-danger">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
    
    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
                echo '<a href="/CasoPractico4/index.php">Regresar</a>';
            } else {
                echo 'Error al insertar';
            }
        } catch (SoapFault $e) {
            echo $e->getMessage();
        }
    }
    ?>
</body>
</html>
