<?php

use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

require 'vendor/autoload.php';

MercadoPagoConfig::setAccessToken("TEST-4631252351137526-110419-559d6f2ef72e7ed77d30930925f0cd2c-1423518295");

$client = new PreferenceClient();

$preference = $client->create([

    "items" => [
        [
            "id" => "DEP-0001",
            "title" => "Ensalada greca",
            "quantity" => 1,
            "unit_price" => 5.49
        ],
    ],

    "statement_descriptor" => "Restaurante La Sombra",
    "external_reference" => "CDP001"

]);

include("admin/bd.php");

$sentencia=$conexion->prepare("SELECT * FROM tbl_banners ORDER BY id ASC limit 1");
$sentencia->execute();
$lista_banners=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia=$conexion->prepare("SELECT * FROM tbl_colaboradores ORDER BY id ASC");
$sentencia->execute();
$lista_colaboradores=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia=$conexion->prepare("SELECT * FROM tbl_testimonios ORDER BY id DESC limit 2");
$sentencia->execute();
$lista_testimonios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia=$conexion->prepare("SELECT * FROM tbl_menu ORDER BY id DESC limit 4");
$sentencia->execute();
$lista_menu=$sentencia->fetchAll(PDO::FETCH_ASSOC);

if($_POST){

    $nombre=filter_var($_POST["nombre"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $correo=filter_var($_POST["correo"], FILTER_VALIDATE_EMAIL);
    $mensaje=filter_var($_POST["mensaje"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if($nombre && $correo && $mensaje){

        $sql="INSERT INTO tbl_comentarios (nombre, correo, mensaje) VALUES (:nombre, :correo, :mensaje)";
        $resultado = $conexion->prepare($sql);

        $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $resultado->bindParam(":correo", $correo, PDO::PARAM_STR);
        $resultado->bindParam(":mensaje", $mensaje, PDO::PARAM_STR);
        $resultado->execute();

    }

    header("location:index.php");

}

?>

<!doctype html>
<html lang="en">
    <head>
        <title>La Sombra</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://sdk.mercadopago.com/js/v2"></script>
        <link 
            rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
            crossorigin="anonymous" referrencepolicy="no-referrer"/>
    </head>

    <body class="bg-light">

        <!--Navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Fifth navbar example">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"> <i class="fas fa-utiensils"></i>Restaurant</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar05" aria-controls="navbar05" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbar05">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#inicio">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#menu">Menú del día</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#chefs">Chefs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#testimonios">Testimonio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contacto">Contacto</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Seccion Banners -->
        <section id="inicio" class="container-fluid p-0">

            <div class="banner-img" style="position:relative; background:url('images/slider-image1.jpg') center/cover no-repeat; height:400px; ">
                <div class="banner-text" style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%); text-align:center" >
                    
                    <?php foreach($lista_banners as $banner){ ?>

                    <h1 class="text-light"><?php echo $banner['titulo']?></h1>
                    <p class="text-light"><?php echo $banner['descripcion']?></p>
                    <a href="<?php echo $banner['link']?>" class="btn btn-primary">Ver menú</a>

                    <?php } ?>
                </div>
            </div>

        </section>

        <!-- Carrusel -->
        <section class="container mt-4 text-center">
            <div class="slide">
                <div class="slide-inner">
                    <input class="slide-open" type="radio" id="slide-1" 
                        name="slide" aria-hidden="true" hidden="" checked="checked">
                    <div class="slide-item">
                        <img src="/images/carrusel/carrusel1.jpg">
                    </div>
                    <input class="slide-open" type="radio" id="slide-2" 
                        name="slide" aria-hidden="true" hidden="">
                    <div class="slide-item">
                        <img src="https://www.migueltroyano.com/wp-content/uploads/2020/09/postgres_copy.png">
                    </div>
                    <input class="slide-open" type="radio" id="slide-3" 
                        name="slide" aria-hidden="true" hidden="">
                    <div class="slide-item">
                        <img src="https://www.migueltroyano.com/wp-content/uploads/2020/09/excel_guardar_como_csv.jpg">
                    </div>
                    <label for="slide-3" class="slide-control prev control-1">‹</label>
                    <label for="slide-2" class="slide-control next control-1">›</label>
                    <label for="slide-1" class="slide-control prev control-2">‹</label>
                    <label for="slide-3" class="slide-control next control-2">›</label>
                    <label for="slide-2" class="slide-control prev control-3">‹</label>
                    <label for="slide-1" class="slide-control next control-3">›</label>
                    <ol class="slide-indicador">
                        <li>
                            <label for="slide-1" class="slide-circulo">•</label>
                        </li>
                        <li>
                            <label for="slide-2" class="slide-circulo">•</label>
                        </li>
                        <li>
                            <label for="slide-3" class="slide-circulo">•</label>
                        </li>
                    </ol>
                </div>
            </div>
        </section>

        <!--Bienvenida-->
        <section id="id" class="container mt-4 text-center">

            <div class="jumbotron bg-dark text-white">
                    <br>
                    <h2>Bienvenido al Restaurant</h2>
                    <p>Descubre una experiencia culinaria única</p>
                </br>
            </div>

        </section>

        <!--Chefs-->
        <section id="chefs" class="container mt-4 text-center">
            <h2>Nuestros Chefs</h2>

            <div class="row">

                <?php foreach($lista_colaboradores as $colaborador){ ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="images/colaboradores/<?php echo $colaborador["foto"];?>" alt="Chef" class="card-img-top">
                        <div class="card-body">
                            <div class="card-title">
                                <p class="card-text"><?php echo $colaborador["titulo"]; ?></p>
                                <p class="card-text"><?php echo $colaborador["descripcion"]; ?></p>
                                <div class="social-icons mt-3">
                                    <a href="<?php echo $colaborador["linkfacebook"]; ?>" class="text-dark me-2"><i class="fab fa-facebook"></i></a>
                                    <a href="<?php echo $colaborador["linkinstagram"]; ?>" class="text-dark me-2"><i class="fab fa-instagram"></i></a>
                                    <a href="<?php echo $colaborador["linklinkedin"]; ?>" class="text-dark me-2"><i class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </div>
        </section>
        <br><br>

        <!--Testimonios-->
        <section id="testimonios" class="bg-light py-5">
            <div class="container">
                <h2 class="text-center mb-4">Testimonios</h2>

                <div class="row">
                    <?php foreach($lista_testimonios as $testimonio) { ?>
                    <div class="col-md-6 d-flex">
                        <div class="card mb-4 w-100">
                            <div class="card-body">
                                <p class="card-text"><?php echo $testimonio["opinion"]; ?></p>
                            </div>
                            <div class="card-footer text-muted"><?php echo $testimonio["nombre"]; ?></div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                
            </div>
        </section>

        <!--Menú-->
        <section class="container mt-4" id="menu">

            <h2 class="text-center">Menú (nuestra recomendación)</h2>
            <br>
            <div class="row">

            <?php foreach($lista_menu as $menu){ ?>

                <div class="col-lg-4 col-sm-4">
                    <div class="card">
                        <img src="images/menu/<?php echo $menu["foto"];?>" alt="Greek Salmon" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $menu["nombre"]; ?></h5>
                            <h6 class="card-title"><strong><?php echo $menu["ingredientes"]; ?></strong></h6>
                            <p class="card-text"><strong>Precio:</strong> <?php echo $menu["precio"]; ?></p>
                        </div>
                    </div>
                </div>

            <?php } ?>

            </div>

        </section>

        <!--Contacto-->
        <section class="container mt-4" id="contacto">
            <div class="container-fluid col-lg-12 row">
                <div class="col-lg-6">
                    <h2>Contacto</h2>
                    <p>Estamos aquí para servirle</p>

                    <form action="?" method="post">
                        
                        <div class="mb-3">
                            <label for="name">Nombre:</label><br>
                            <input type="text" class="form-control" name="nombre" placeholder="Escriba su nombre" required><br>
                        </div>
                        <div class="mb-3">
                            <label for="email">Correo electrónico:</label>
                            <input type="email" class="form-control" name="correo" placeholder="Escriba su correo electrónico" required><br>
                        </div>
                        <div class="mb-3">
                            <label for="message">Mensaje:</label><br>
                            <textarea name="mensaje" class="form-control" id="message" rows="6" cols="50"></textarea><br>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck">
                            <label class="form-check-label" for="invalidCheck">
                                Deseo que me lleguen correos del menú del día.
                            </label>
                        </div>
                        <input type="submit" class="btn btn-primary"value="Enviar mensaje">
                        
                    </form>
                </div>
                <div class="d-flex col-lg-6 align-items-center">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3543.2704633175954!2d-55.90746952490747!3d-27.367267512348846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9457be3a4b954e33%3A0x6225064c71c3cd99!2sE.P.E.T.%20N%C2%B01%20%22UNESCO%22!5e0!3m2!1ses-419!2sar!4v1717525123408!5m2!1ses-419!2sar" width="100%" height="90%"></iframe>
                </div>
            </div>
        </section>
        <br><br>

        <!--Horario-->
        <div class="text-center bg-light p-4">

            <h3 class="mb-4">Horario de atención</h3>
            
            <div class="container-fluid">
                
                <div class="row">

                    <div>
                        <p><strong>Lunes a Viernes</strong></p>
                        <p><strong>11:00 am - 10:00 pm</strong></p>
                    </div>

                    <div>
                        <p><strong>Sabado</strong></p>
                        <p><strong>12:00 pm - 05:00 pm</strong></p>
                    </div>

                    <div>
                        <p><strong>Domingo</strong></p>
                        <p><strong>07:00 am - 02:00 pm</strong></p>
                    </div>

                </div>

            </div>

        </div>
        <div id="wallet_container"></div>

        <!-- Footer -->
        <footer class="bg-dark text-light text-center py-1">
            place footer here
            <p> &copy; 2023 Chest Gab, todos los derechos reservados </p>
        </footer>

        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
        <script>
            const mp = new MercadoPago('TEST-f2bdc11a-dcb6-4ba3-be13-3ea01f941f0d', {
                locale: 'es-MX'
            });

            mp.bricks().create("wallet", "wallet_container", {
                initialization: {
                    preferenceId: "<?php echo $preference->id; ?>",
                },
                customization: {
                    texts: {
                        valueProp: 'smart_option',
                    },
                },
            });

        </script>

    </body>
</html>