<?php
    require_once("header.php");
    require_once(__DIR__."/../classes/Cliente.php");
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
        $e->setId($_GET["endereco"]);

        $e = json_decode($e->editar(),true);

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

    <?php

    if(isset($_GET["endereco"])){

        $eAtual = new Endereco();   
        $eAtual->setId($_GET["endereco"]);                 
        $eAtual = json_decode($eAtual->listarPorId(),true);

    } 

    ?>
    
    <form method="POST">

        <div class="card my-4">
        
            <div class="card-body">
                
                <h5 class="mb-2">Editar endereço</h5>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputCep" class="col-form-label">C.E.P.:</label>
                        <input type="text" class="form-control" id="inputCep" name="cep" value="<?php echo $eAtual[0]["cep"]; ?>" required>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="inputLogradouro" class="col-form-label">Logradouro:</label>
                        <input type="text" class="form-control" id="inputLogradouro" name="logradouro" value="<?php echo $eAtual[0]["logradouro"]; ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputN" class="col-form-label">Nº:</label>                      
                        <input type="text" class="form-control" id="inputN" name="numero" value="<?php echo $eAtual[0]["numero"]; ?>" required>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="inputComplemento" class="col-form-label">Complemento:</label>
                        <input type="text" class="form-control" id="inputComplemento" name="complemento" value="<?php echo $eAtual[0]["complemento"]; ?>" required>                   
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputBairro" class="col-form-label">Bairro:</label>
                        <input type="text" class="form-control" id="inputBairro" name="bairro"  value="<?php echo $eAtual[0]["bairro"]; ?>" required>                   
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputCidade" class="col-form-label">Cidade:</label>
                        <input type="text" class="form-control" id="inputCidade" name="cidade" value="<?php echo $eAtual[0]["cidade"]; ?>" required>    
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEstado" class="col-form-label">Estado:</label>
                        <input type="text" class="form-control" id="inputEstado" name="estado" value="<?php echo $eAtual[0]["estado"]; ?>" required>                   
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPais" class="col-form-label">País:</label>
                        <input type="text" class="form-control" id="inputPais" name="pais" value="<?php echo $eAtual[0]["pais"]; ?>" required>    
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Atualizar</button>  
            </div>

        </div>

    </form>

</div>

<?php
    require_once("footer.php");
?>