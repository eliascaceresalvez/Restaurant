<?php
include("../../bd.php");

if(isset($_GET['txtID'])){

    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";
    
    $sentencia=$conexion->prepare("DELETE FROM tbl_banners WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    header("location:index.php");

}

$sentencia=$conexion->prepare("SELECT * FROM `tbl_banners`");
$sentencia->execute();
$lista_banners= $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php"); 
?>
    <br>
    
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
                        <?php foreach ($lista_banners as $key => $value) { ?>
                        <tr class="">
                            <td><?php echo $value['ID'] ?></td>
                            <td><?php echo $value['titulo'] ?></td>
                            <td><?php echo $value['descripcion'] ?></td>
                            <td><?php echo $value['link'] ?></td>
                            <td>
                                <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $value['ID'] ?>" 
                                role="button">Editar</a>
                                <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $value['ID'] ?>" 
                                role="button">Borrar</a>
                            </td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="card-footer text-muted"></div>
    </div>

<?php include("../../templates/footer.php"); ?>