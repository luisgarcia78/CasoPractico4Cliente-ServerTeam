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
                        <input type="text" class="form-control" name="Nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="Descripcion">Descripcion</label>
                        <textarea name="Descripcion" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Precio">Precio</label>
                        <input type="number" id="precio" name="Precio" step="any" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Origen">Origen</label>
                        <input type="text" class="form-control" name="Origen" required>
                    </div>
                    <div class="form-group">
                        <label for="Stock">Stock</label>
                        <input type="number" class="form-control" name="Stock" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="index.php" type="button" class="btn btn-outline-danger">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
    
   
</body>
</html>
