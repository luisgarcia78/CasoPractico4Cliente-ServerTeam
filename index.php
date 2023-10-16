<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="Css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="divban" style="width: 100%; text-align: center;">
        <h1 style=" background: linear-gradient(45deg, green, white, red);">Dulces típicos Mexicanos</h1>
        <img src="img/images.jpeg" alt="Banner">
    </div>
    <div class="container">

       <form id="form-busqueda" class="form-inline" style="width: 100%;" method="post" action="Crud/BuscarDulce.php">
    <div class="form-group">
        <input type="text" name="nombre" class="form-control" placeholder="Origen de dulce">
    </div>
    <button type="submit" class="btn btn-primary" style="margin-left: 1%;">Buscar</button>
</form>

        <a href="nuevoDulce.php" class="btn btn-primary" style="float: right;">Agregar</a>
        <br>

        <div class="table-responsive" style="max-height: 400px; overflow-y: scroll;"><br>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Origen</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                
                    <?php 
                    $dulces = new SoapClient(
                        null, array(
                            'location' => 'https://wsdulcestipicosmexicanos.000webhostapp.com//DulceService.php',
                            'uri' => 'https://wsdulcestipicosmexicanos.000webhostapp.com//DulceService.php',
                            'trace' => 1
                        )
                    );

                    try {
                        $respuest = $dulces->__soapCall("ObtenerDulces", []);
                        $result = json_encode($respuest, true);
                        $datos = json_decode($result, true);

                        foreach ($datos as $item) {
                            echo '<tr>';
                            echo '<td>'.$item['ID'].'</td>';
                            echo '<td>'.$item['Nombre'].'</td>';
                            echo '<td>'.$item['Descripcion'].'</td>';
                            echo '<td>'.$item['Precio'].'</td>';
                            echo '<td>'.$item['Origen'].'</td>';
                            echo '<td>'.$item['Stock'].'</td>';
                            echo '<td><a href="modificar.php?id=' . $item['ID'] . '" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a></td>';
                            echo '<td><a href="#" class="btn btn-danger" onclick="confirmarEliminacion('.$item['ID'].')"><i class="bi bi-x-circle"></i></a></td>';

                            echo '</tr>';
                        }
                    } catch (\Throwable $th) {
                        // Manejo de errores
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <footer class="footer bg-dark text-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p>&copy; <?php echo date("Y"); ?> Dulces Típicos Mexicanos</p>
            </div>
            <div class="col-md-6 text-right">
                <p>Equipo No:</p>
            </div>
        </div>
    </div>
</footer>

</body>
<script>
  // Función para mostrar una confirmación antes de eliminar
  function confirmarEliminacion(id) {
    Swal.fire({
      title: '¿Estás seguro?',
      text: 'Esta acción eliminará el dulce. ¿Deseas continuar?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar',
    }).then((result) => {
      if (result.isConfirmed) {
        // Redirigir al script de eliminación con el ID del dulce
        window.location.href = '/CasoPractico4/Crud/EliminarDulce.php?id=' + id;
      }
    });
  }
</script>
</html>
