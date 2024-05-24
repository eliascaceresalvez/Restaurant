<!doctype html>
<html lang="en">
    <head>
        <title>Login</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        
        <main>

            <div class="container d-flex justify-content-center">
                <div class="row col-12">

                    <div class="col"></div>

                    <div class="col text-center">

                        <!--Login-->
                        <div class="card text-center">
                            <div class="card-header">Login</div>
                            <div class="card-body">
                                <form action="index.php" method="post">
                                    
                                    <div class="mb-3">
                                        <label for="" class="form-label">Usuario</label>
                                        <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Ingrese su usuario">
                                    </div>

                                    <div class="mb-3">
                                        <label for="" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Introduzca su contraseña">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Entrar</button>
                                    
                                </form>
                                
                            </div>
                        </div>
                        
                    </div>

                    <div class="col"></div>

                </div>
                
            </div>
            


        </main>
        
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        >
        </script>
    </body>
</html>
