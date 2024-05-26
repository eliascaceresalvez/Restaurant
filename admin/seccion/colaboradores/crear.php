<?php
include("../../bd.php");

if($_POST){
    print_r($_POST);
}

include("../../templates/header.php");
?>

<br>
<div class="card">
    <div class="card-header">Colaboradores</div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="foto" class="form-label">Foto:</label>
                <input type="file" class="form-control" name="foto" id="foto" placeholder="" aria-describedby="fileHelpId">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Escriba el nombre">
            </div>
            
            <div class="mb-3">
                <label for="" class="form-label">Descripcion:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion"
                    aria-describedby="helpId" placeholder="Agregue una descripcion">
            </div>
            
            <div class="mb-3">
                <label for="" class="form-label">Facebook:</label>
                <input type="text" class="form-control" name="linkfacebook" id="linkfacebook"
                    aria-describedby="helpId" placeholder="Link Facebook">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Instagram:</label>
                <input type="text" class="form-control" name="linkinstagram" id="linkinstagram"
                    aria-describedby="helpId" placeholder="Link Instagram">
            </div>
            
            
            <div class="mb-3">
                <label for="" class="form-label">Linkedin:</label>
                <input type="text" class="form-control" name="linklinkedin" id="linklinkedin"
                    aria-describedby="helpId"  placeholder="Link Linkedin">
            </div>
            
            <button type="submit" class="btn btn-success">Agregar Colaborador</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php
include("../../templates/footer.php");
?>