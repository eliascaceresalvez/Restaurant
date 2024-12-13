<?php
include("../../bd.php");

// Eliminar un comentario si se recibe un ID
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";

    $sentencia = $conexion->prepare("DELETE FROM tbl_comentarios WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    header("location:index.php");
    exit;
}

// Consulta para obtener todos los comentarios
$sql = "SELECT id, nombre, correo, telefono, mensaje, recibir_menu_dia FROM tbl_comentarios";
$resultado = $conexion->query($sql); // Ejecuta la consulta
$lista_comentarios = $resultado->fetchAll(PDO::FETCH_ASSOC); // Obtén los resultados como un arreglo asociativo

include("../../templates/header.php");
?>

<br>

<div class="card">
    <div class="card-header text-end">Bandeja de comentarios</div>
    <div class="card-body">

        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Mensaje</th>
                        <th scope="col">Menú Diario</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_comentarios as $registro) { ?>
                    <tr>
                        <td><?php echo $registro["id"]; ?></td>
                        <td><?php echo $registro["nombre"]; ?></td>
                        <td><?php echo $registro["correo"]; ?></td>
                        <td><?php echo $registro["telefono"]; ?></td>
                        <td><?php echo $registro["mensaje"]; ?></td>
                        <td><?php echo ($registro["recibir_menu_dia"] ? "✅" : "❌"); ?></td>
                        <td>
                            <a class="btn btn-danger" href="index.php?txtID=<?php echo $registro['id']; ?>" 
                               role="button">Borrar</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>
