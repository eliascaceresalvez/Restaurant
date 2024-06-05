<?php
include("../../bd.php");


if($_POST){

    $txtID=(isset($_POST["txtID"]))?$_POST["txtID"]:"";
    $nombre=(isset($_POST["nombre"]))?$_POST["nombre"]:"";
    $ingredientes=(isset($_POST["ingredientes"]))?$_POST["ingredientes"]:"";
    $precio=(isset($_POST["precio"]))?$_POST["precio"]:"";

    $sentencia=$conexion->prepare("UPDATE `tbl_menu` 
                                SET nombre=:nombre, 
                                ingredientes=:ingredientes, 
                                foto=:foto,
                                precio=:precio
                                WHERE ID=:id");

    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":ingredientes", $ingredientes);
    $sentencia->bindParam(":precio", $precio);
    $sentencia->bindParam(":id", $txtID);

    $sentencia->execute();

    //Proceso de actualizar foto
    $foto = isset($_FILES['foto']["name"])?$_FILES['foto']["name"]:"";
        $tmp_foto = $_FILES["foto"]["tmp_name"];
    
    if($foto!=""){
    
        $fecha_foto = new DateTime();
        $nombre_foto = $fecha_foto->getTimestamp()."-".$foto;
    
        move_uploaded_file($tmp_foto,"../../../images/menu/".$nombre_foto);

        $sentencia = $conexion->prepare("SELECT * FROM `tbl_menu` WHERE ID=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
    
        $registro_foto = $sentencia->fetch(PDO::FETCH_LAZY);
    
        if(isset($registro_foto['foto'])){
            if(file_exists("../../../images/menu/".$registro_foto['foto'])){
                unlink("../../../images/menu/".$registro_foto['foto']);
            }
        }

        $sentencia=$conexion->prepare("UPDATE `tbl_menu` 
                                SET foto=:foto
                                WHERE ID=:id");

        $sentencia->bindParam(":foto", $nombre_foto);
        $sentencia->bindParam(":id", $txtID);
    
        $sentencia->execute();

    }

}

if (isset($_GET['txtID'])){
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";

    // Suponiendo que ya se ha establecido la conexión a la base de datos
    $sentencia = $conexion->prepare("SELECT * FROM `tbl_menu` WHERE ID = :id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    if($registro) {
        $nombre = $registro["nombre"];
        $ingredientes = $registro["ingredientes"];
        $foto = $registro["foto"];
        $precio = $registro["precio"];
    } else {
        // Manejar el caso donde no se encuentra el registro
        $nombre = "";
        $ingredientes = "";
        $foto = "";
        $precio = "";
    }
    
}
include("../../templates/header.php");
?>

<br>

<div class="card">
    <div class="card-header">Menú de comida</div>
    <div class="card-body">
        
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="" class="form-label">ID</label>
                <input type="text" class="form-control" value="<?php echo $txtID; ?>" name="" id="" aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Nombre:</label>
                <input type="text" class="form-control" value="<?php echo $nombre; ?>" name="nombre" id="nombre" aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Ingredientes:</label>
                <input type="text" class="form-control" value="<?php echo $ingredientes; ?>" name="ingredientes" id="ingredientes" aria-describedby="helpId" placeholder="">
            </div>
            
            <div class="mb-3">
                <label for="" class="form-label">Foto:</label> <br>
                <img width="100" src="../../../images/menu/<?php echo $foto; ?>" alt="">
                <input type="file" class="form-control" name="foto" id="foto" placeholder="" aria-describedby="fileHelpId">
            </div>
            
            <div class="mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input type="text" class="form-control" value="<?php echo $precio; ?>" name="precio" id="precio" aria-describedby="helpId" placeholder="">
            </div>

            <button type="submit" class="btn btn-success">Modificar comida</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php

include("../../templates/footer.php");

?>