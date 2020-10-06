<!doctype html>
<html lang="en">

<?php
    session_start();
    require_once("classes/Autenticacao.php");
?>


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Gestão de Clientes - Autenticação</title>

</head>

<body>

    <div class="d-flex flex-column justify-content-center align-items-center" style="height: 100vh">

    <?php

    if(isset($_POST["email"]) && isset($_POST["senha"])){

        $a = new Autenticacao();

        $a->setEmail($_POST["email"]);
        $a->setSenha($_POST["senha"]);
        
        $a = json_decode($a->autenticar(),true);

        if($a['error'])
        {
            echo '
            <div class="alert alert-danger mt-4" style="width: 500px" role="alert">
            '.$a['message'].'
            </div> 
            ';
        }

    }

    ?>
    
        <div class="card" style="width: 500px">
            <div class="card-header text-center">
                Autenticar
            </div>
            <form method="POST">
                <div class="card-body">  
                    <div class="form-group">
                        <label for="inputEmail">E-mail:</label>
                        <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp" required>
                    </div>
                    <div class="form-group">
                        <label for="inputSenha">Senha:</label>
                        <input type="password" class="form-control" id="inputSenha" name="senha" required>
                    </div>                
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success mr-2 btn-block">Autenticar</button>
                    <a href="pages/registrar.php" class="btn btn-primary btn-block">Registrar</a>
                </div>
            </form>
            
        </div>

    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>