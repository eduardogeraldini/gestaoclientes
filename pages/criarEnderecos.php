<?php
    require_once("header.php");
    require_once(__DIR__."/../classes/Endereco.php");
?>

<div class="container-fluid">

    <?php

    if(isset($_POST["logradouro"])){

        $e = new Endereco();

        $e->setLogradouro($_POST["logradouro"]);
        $e->setNumero($_POST["numero"]);
        $e->setComplemento($_POST["complemento"]);
        $e->setCep($_POST["cep"]);
        $e->setBairro($_POST["bairro"]);
        $e->setCidade($_POST["cidade"]);
        $e->setEstado($_POST["estado"]);
        $e->setPais($_POST["pais"]);
        $e->setIdCliente($_GET["cliente"]);
        
        $e = json_decode($e->criar(),true);

        if(!$e['error']){

            echo '
            <div class="alert alert-success my-4" role="alert">
            '.$e['message'].'
            </div> 
            ';

        } else {

            echo '
            <div class="alert alert-danger my-4" role="alert">
            '.$e['message'].'
            </div> 
            ';

        }

    }

    ?>
    
    <form method="POST">

        <div class="card my-4">
        
            <div class="card-body">

                <h5 class="mb-2">Novo endereco</h5>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputCep" class="col-form-label">C.E.P.:</label>
                        <input type="text" class="form-control" id="inputCep" name="cep" required>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="inputLogradouro" class="col-form-label">Logradouro:</label>
                        <input type="text" class="form-control" id="inputLogradouro" name="logradouro" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputN" class="col-form-label">Nº:</label>                      
                        <input type="text" class="form-control" id="inputN" name="numero" required>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="inputComplemento" class="col-form-label">Complemento:</label>
                        <input type="text" class="form-control" id="inputComplemento" name="complemento" required>                   
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputBairro" class="col-form-label">Bairro:</label>
                        <input type="text" class="form-control" id="inputBairro" name="bairro" required>                   
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputCidade" class="col-form-label">Cidade:</label>
                        <input type="text" class="form-control" id="inputCidade" name="cidade" required>    
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEstado" class="col-form-label">Estado:</label>
                        <input type="text" class="form-control" id="inputEstado" name="estado" required>                   
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPais" class="col-form-label">País:</label>
                        <input type="text" class="form-control" id="inputPais" name="pais" required>    
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cadastrar</button>  
            </div>

        </div>

    </form>

</div>

<?php
    require_once("footer.php");
?>