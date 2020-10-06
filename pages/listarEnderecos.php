<?php
    require_once("header.php");
    require_once(__DIR__."/../classes/Cliente.php");
    require_once(__DIR__."/../classes/Endereco.php");
?>

<div class="container-fluid">

    <a class="btn btn-success mt-4 mb-0" href="criarEnderecos.php?cliente=<?php echo $_GET["cliente"]?>" role="button">+ NOVO ENDEREÇO</a>

    <?php
    if(isset($_GET["deletar"])){
        $e = new Endereco();
        
        $e->setId($_GET["deletar"]);
        $e = json_decode($e->excluir(),true);

        if(!$e['error']){
            echo '
            <div class="alert alert-success mt-4 mb-0" role="alert">
            '.$e['message'].'
            </div> 
            ';
        } else {
            echo '
            <div class="alert alert-danger mt-4 mb-0" role="alert">
            '.$e['message'].'
            </div> 
            ';
        }
    }
    ?>

    <div class="row">

    <?php  
    $e = new Endereco();

    $e->setIdCliente($_GET["cliente"]);

    $e = json_decode($e->listarEnderecoPorCliente(),true);

    for ($i=0; $i < count($e); $i++) { ?>

        <div class="col-md-3 my-4">
            <div class="card">
                <iframe 
                    class="card-img-top" 
                    frameBorder="0" 
                    src="https://maps.google.com/maps?q=<?php echo $e[$i]["logradouro"] . ',' .  
                                                                   $e[$i]["numero"] . ' - ' .  
                                                                   $e[$i]["bairro"] . ' ' .  
                                                                   $e[$i]["cidade"] . ' - ' .
                                                                   $e[$i]["estado"];?>&output=embed">
                </iframe>
                <div class="card-body">
                    <p class="card-text m-0"><b>Logradouro:</b> <?php echo $e[$i]["logradouro"]; ?></p>
                    <p class="card-text m-0"><b>Número:</b> <?php echo $e[$i]["numero"]; ?></p>
                    <p class="card-text m-0"><b>Complemento:</b> <?php echo $e[$i]["complemento"]; ?></p>
                    <p class="card-text m-0"><b>Bairro:</b> <?php echo $e[$i]["bairro"]; ?></p>
                    <p class="card-text m-0"><b>Cidade:</b> <?php echo $e[$i]["cidade"]; ?></p>
                    <p class="card-text m-0"><b>Estado:</b> <?php echo $e[$i]["estado"]; ?></p>
                    <p class="card-text m-0"><b>País:</b> <?php echo $e[$i]["pais"]; ?></p>
                </div>
                <div class="card-footer">
                    <a href="editarEnderecos.php?endereco=<?php echo $e[$i]["id"]?>" class="btn btn-primary btn-sm">Editar</a>
                    <a href="listarEnderecos.php?cliente=<?php echo $_GET["cliente"]?>&deletar=<?php echo $e[$i]["id"]?>" class="btn btn-danger btn-sm">Excluir</a>
                </div>
            </div>
        </div>

        <?php } ?>

    </div>

</div>


<?php
    require_once("footer.php");
?>