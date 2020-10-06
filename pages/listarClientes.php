<?php
    require_once("header.php");
    require_once(__DIR__."/../classes/Cliente.php");
?>

    <div class="container-fluid">

        <?php
        if(isset($_GET["deletar"])){
            $f = new Cliente();
            
            $f->setId($_GET["deletar"]);
            $f = json_decode($f->excluir(),true);

            if(!$f['error']){
                echo '
                <div class="alert alert-success my-4" role="alert">
                '.$f['message'].'
                </div> 
                ';
            } else {
                echo '
                <div class="alert alert-danger my-4" role="alert">
                '.$f['message'].'
                </div> 
                ';
            }
        }
        ?>

        <table class="table my-4" style="width: '100%'">
            <thead class="">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Dt. Nascimento</th>
                    <th scope="col">C.P.F.</th>
                    <th scope="col">R.G.</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>

            <?php  
            $c = new Cliente();
            $c = json_decode($c->listarTodos(),true);

            for ($i=0; $i < count($c); $i++) { ?>
                <tr>
                    <td class="align-middle"> <?php echo $c[$i]["nome"];?></td>
                    <td class="align-middle"><?php echo date("d/m/Y", strtotime($c[$i]["dataNascimento"])); ?></td>
                    <td class="align-middle"><?php echo vsprintf("%s%s%s.%s%s%s.%s%s%s-%s%s", str_split($c[$i]["CPF"])); ?></td>
                    <td class="align-middle"><?php echo vsprintf("%s%s.%s%s%s.%s%s%s-%s", str_split($c[$i]["RG"])); ?></td>
                    <td class="align-middle"><?php echo ($c[$i]["ativo"] == 1) ? '<span class="badge badge-success">Ativo</span>' : '<span class="badge badge-danger">Inativo</span>' ?></td>
                    <td class="align-middle">
                        <a data-toggle="tooltip" data-placement="top" title="Endereços" href="listarEnderecos.php?cliente=<?php echo $c[$i]["id"]; ?>" class="badge badge-success align-middle"><i class="fa fa-home m-0"> </i></a>
                        <a data-toggle="tooltip" data-placement="top" title="Editar" href="editarClientes.php?editar=<?php echo $c[$i]["id"]; ?>" class="badge badge-primary align-middle"><i class="fa fa-edit m-0"> </i></a>
                        <a data-toggle="tooltip" data-placement="top" title="Excluir" href="listarClientes.php?deletar=<?php echo $c[$i]["id"]; ?>" class="badge badge-danger align-middle"><i class="fa fa-trash m-0"> </i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>

<?php
    require_once("footer.php");
?>
