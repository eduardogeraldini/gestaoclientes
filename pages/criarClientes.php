<?php
    require_once("header.php");
    require_once(__DIR__."/../classes/Cliente.php");
    require_once(__DIR__."/../classes/Endereco.php");
?>

<div class="container-fluid">

    <?php

    if(isset($_POST["nome"])){

        $c = new Cliente();
        $e = new Endereco();

        $c->setNome($_POST["nome"]);
        $c->setDtNascimento($_POST["data"]);
        $c->setCpf($_POST["cpf"]);
        $c->setRg($_POST["rg"]);

        $e->setLogradouro($_POST["logradouro"]);
        $e->setNumero($_POST["numero"]);
        $e->setComplemento($_POST["complemento"]);
        $e->setCep($_POST["cep"]);
        $e->setBairro($_POST["bairro"]);
        $e->setCidade($_POST["cidade"]);
        $e->setEstado($_POST["estado"]);
        $e->setPais($_POST["pais"]);
        
        $c = json_decode($c->criar($e),true);

        if(!$c['error']){

            echo '
            <div class="alert alert-success my-4" role="alert">
            '.$c['message'].'<br>
            Veja mais informações na lista de clientes!
            </div> 
            ';

        } else {

            echo '
            <div class="alert alert-danger my-4" role="alert">
            '.$c['message'];'
            </div> 
            ';

        }

    }

    ?>
    
    <form method="POST">

        <div class="card my-4">
        
            <div class="card-body">

                <h5 class="mb-3">Informações Principais</h5>
                
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="inputNome" class="col-form-label">Nome:</label>
                        <input type="text" class="form-control" id="inputNome" name="nome" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputData" class="col-form-label">Data de Nascimento:</label>                      
                        <input type="date" class="form-control" id="inputData" name="data" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCpf" class="col-form-label">C.P.F.:</label>
                        <input type="text" class="form-control" id="inputCpf" minlength="11" maxlength="11" name="cpf" required>                   
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputRg" class="col-form-label">R.G.:</label>
                        <input type="text" class="form-control" id="inputRg" minlength="9" maxlength="9" name="rg" required>    
                    </div>
                </div>

                <hr class="mb-4">

                <h5 class="mb-2">Endereço Principal</h5>
                <p class="mb-3">Novos endereços podem ser adicionados posteriormente.</p>

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