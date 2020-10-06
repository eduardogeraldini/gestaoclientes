<?php
    require_once("header.php");
    require_once(__DIR__."/../classes/Cliente.php");
?>

<div class="container-fluid">

    <?php

    if(isset($_POST["nome"])){

        $c = new Cliente();

        $c->setNome($_POST["nome"]);
        $c->setDtNascimento($_POST["data"]);
        $c->setCpf($_POST["cpf"]);
        $c->setRg($_POST["rg"]);
        $c->setAtivo($_POST["ativo"]);
        $c->setId($_GET["editar"]);
        
        $c = json_decode($c->editar(),true);

        if(!$c['error']){

            echo '
            <div class="alert alert-success my-4" role="alert">
            '.$c['message'].'
            </div> 
            ';

        } else {

            echo '
            <div class="alert alert-danger my-4" role="alert">
            '.$c['message'].'
            </div> 
            ';

        }

    }

    ?>

    <?php

    if(isset($_GET["editar"])){

        $eAtual = new Cliente();   
        $eAtual->setId($_GET["editar"]);                 
        $eAtual = json_decode($eAtual->listarApenasUmCliente(),true);

    } 

    ?>
    
    <form method="POST">

        <div class="card my-4">
        
            <div class="card-body">

                <h5 class="mb-3">Editar Cliente</h5>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputAtivo">Ativo ?</label>
                        <select class="form-control" id="inputAtivo" name="ativo" value="<?php echo $eAtual[0]["ativo"];?>" required>
                            <option value="1" <?php echo $eAtual[0]["ativo"] == 1 ? 'selected' : '';?>>Sim</option>
                            <option value="0" <?php echo $eAtual[0]["ativo"] == 0 ? 'selected' : '';?>>Não</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="inputNome" class="col-form-label">Nome:</label>
                        <input type="text" class="form-control" id="inputNome" name="nome" value="<?php echo $eAtual[0]["nome"]; ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputData" class="col-form-label">Data de Nascimento:</label>                      
                        <input type="date" class="form-control" id="inputData" name="data" value="<?php echo date("Y-m-d", strtotime($eAtual[0]["dataNascimento"])); ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCpf" class="col-form-label">C.P.F.:</label>
                        <input type="text" class="form-control" id="inputCpf" name="cpf" minlength="11" maxlength="11" value="<?php echo $eAtual[0]["CPF"]; ?>" required>                   
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputRg" class="col-form-label">R.G.:</label>
                        <input type="text" class="form-control" id="inputRg" name="rg" minlength="9" maxlength="9" value="<?php echo $eAtual[0]["RG"]; ?>" required>    
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