<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){

    $txtID = (isset($_GET["txtID"]) && is_numeric($_GET["txtID"])) ? intval($_GET["txtID"]) : 0;

    $sentencia = $conexion->prepare("SELECT * FROM `tbl_carrusel` WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $registro_foto = $sentencia->fetch(PDO::FETCH_LAZY);

    if (isset($registro_foto['foto']) && !empty($registro_foto['foto'])) {
        $ruta_archivo = "../../images/carrusel/" . $registro_foto['foto'];
        if (file_exists($ruta_archivo)) {
            unlink($ruta_archivo);
        }
    }    

    $sentencia=$conexion->prepare("DELETE FROM `tbl_carrusel` WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    header("location:index.php");

}

$sentencia=$conexion->prepare("SELECT * FROM `tbl_carrusel`");
$sentencia->execute();
$lista_carrusel = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header text-end">

        <a name="" id="" class="btn btn-primary" href="crear.php" role="button"><i class="bi bi-plus-circle"></i> Agregar Registros</a>
    
    </div>
    <div class="card-body">

        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Título</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Enlace</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_carrusel as $key => $value) { ?>
                    <tr class="">
                        <td><?php echo $value['ID'] ?></td>
                        <td><?php echo $value['titulo'] ?></td>
                        <td><?php echo $value['link'] ?></td>
                        <td>
                            <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $value['ID'] ?>" 
                            role="button">Editar</a>
                            <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $value['ID'] ?>" 
                            role="button" onclick="return confirm('Esta seguro que desea eliminar este registro?')">Borrar</a>
                        </td>
                        <?php } ?>
                    </tr>
                </tbody>
            </table>
        </div>
    <div class="card-footer text-muted"></div>
</div>


<?php
include("../../templates/footer.php");
?>