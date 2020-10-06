<?php
    require_once("header.php");
    require_once(__DIR__."/../classes/Cliente.php");
    require_once(__DIR__."/../classes/Endereco.php");
?>

<div class="container-fluid">

    <div class="row my-4">
        <div class="col-4">
            <div class="card border-success mb-3 text-center">
                <div class="card-body text-success">
                    <h5 class="card-title">Clientes (Ativos)</h5>
                    <h1>
                        <?php 
                            $f = new Cliente();
                            $f = json_decode($f->gerarAtivos(),true);

                            echo count($f);

                        ?>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card border-danger mb-3 text-center">
                <div class="card-body text-danger">
                    <h5 class="card-title">Clientes (Inativos)</h5>
                    <h1>
                        <?php 
                            $f = new Cliente();
                            $f = json_decode($f->gerarInativos(),true);

                            echo count($f);
                        ?>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card border-info mb-3 text-center">
                <div class="card-body text-info">
                    <h5 class="card-title">Clientes (Total)</h5>
                    <h1>
                        <?php 
                            $d = new Cliente();
                            $d = json_decode($d->listarTodos(),true);

                            echo count($d); 
                        ?>
                    </h1>
                </div>
            </div>
        </div>  
    </div>

    <div class="card mb-3">
         <div class="card-header">
            Clientes x Mês
        </div>
        <div class="card-body text-info">
            <canvas id="myChart"></canvas>
        </div>
    </div>



</div>

<?php
    require_once("footer.php");
?>

<?php 
    $d = new Cliente();
    $d = json_decode($d->gerarGrafico(),true);
?>

<script>

var ctx = document.getElementById('myChart').getContext('2d');

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php for ($i=0; $i < count($d); $i++) { 
                    echo "'". $d[$i]['DATA'] . "'" . ',';
                } ?>],
        datasets: [{
            label: 'Qnt de Clientes',
            data: [<?php for ($i=0; $i < count($d); $i++) { 
                    echo $d[$i]['TOTAL'] . ',';
                } ?>],
            backgroundColor: 'rgba(255, 99, 132, 0.5)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>