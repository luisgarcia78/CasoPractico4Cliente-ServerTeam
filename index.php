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
        <h1>Dulces típicos Mexicanos</h1>
        <img src="img/images.jpeg" alt="Banner">
    </div>

    <div class="container">
        <a href="nuevoDulce.php" class="btn btn-primary" style="float: right;">Agregar</a>
        <br>

        <div class="table-responsive" style="max-height: 400px; overflow-y: scroll;">
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
                            'location' => 'http://localhost:8080/servidorCasoPRac4/DulceService.php',
                            'uri' => 'http://localhost:8080/servidorCasoPRac4/DulceService.php',
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
