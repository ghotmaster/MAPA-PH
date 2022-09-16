<?php

include 'includes/conexao.php';
include 'classes/ouvidoria.php';
$connection = new Banco();
$ouvidoria = new Ouvidoria();

$protocolo = $_POST['protocolo'];
$retorno = $ouvidoria->consultar($connection, $protocolo);

if($retorno){

    $dados = json_decode($retorno);

    if (isset($dados) && !empty($dados)) {
        foreach ($dados as $key =>$value){              
        
            if(!$value->numero){
                $respondido = false;
                $resposta = 'Protocolo não encontrado, favor verificar!';
                $bgcolor = 'p-3 mb-2 bg-warning text-white';
                $dataResposta = new \DateTime($value->dataResposta);
                $dataRespostaFormatada = $dataResposta->format('d/m/Y H:i:s');
            }else{
               if ($value->status == 2) {
                    $respondido = true;
                    $resposta = $value->resposta;
                    $bgcolor = 'p-3 mb-2 bg-success text-white';
                    $dataResposta = new  \DateTime;
                    $dataRespostaFormatada = $dataResposta->format('d/m/Y H:i:s');
                } else {
                    $respondido = false;
                    $resposta = 'Aguardando analise';
                    $bgcolor = 'p-3 mb-2 bg-warning text-white';
                    $dataResposta = new  \DateTime;
                    $dataRespostaFormatada = $dataResposta->format('d/m/Y');
                } 
            }

    ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Ouvidoria ITÚ 21018084-5</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      
    <script type="text/javascript" src="dist/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="dist/bootstrap/js/bootstrap.min.js"></script>
  </head>

  <body>

    <div class="container">
      <div class="text-center" style="margin-top: 20px">
       <a href="index.html"><img src="unicesumar.png" /></a>

        <h2 style="margin-top:20px">PROTOCOLO ATENDIMENTO<br>COOPERATIVA DE CRÉDITO ITÚ</h2>
        <p class="lead">ENTRE EM CONTATO.<br />ESCLARECEMOS COMO UTILIZAR O SERVIÇO.</p>
      </div>

      <div class="row">
          
        <div class="col-md-12">
            <h4>Consultar Manifestação</h4>
            
            <div class="card">
              <div class="card-header">Resposta da Manifestação</div>
                <p class="<?php echo $bgcolor?>">
                    <?php echo $resposta ?>
                    <br /><strong><?php echo $dataRespostaFormatada ?></strong>
                </p>
            </div>
            
            <div class="card">
              <div class="card-header">Detalhes da Manifestação</div>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="text-right">Protocolo</th>
                            <td><?php echo $value->numero?></td>
                        </tr>
                        <tr>
                            <th class="text-right">Nome</th>
                            <td><?php echo $value->solicitante?></td>
                            <th class="text-right">Email</th>
                            <td><?php echo $value->email?></td>
                        </tr>
                        <tr>
                            <th class="text-right">Ano</th>
                            <td><?php echo $value->ano?></td>
                            <th class="text-right">Status</th>
                            <td><?php if($value->status == 1) echo "Aguardando analise";else echo "concluído"; ?></td>
                        </tr>
                        <tr>
                            <th class="text-right">Data Cadastro</th>
                            <td>
                                <?php echo $value->datacadastro?>
                                
                            </td>
                            
                        </tr>
                        
                        
                        
                        <tr>
                            <th class="text-right">Descrição</th>
                            <td colspan="3">
                                <?php echo $value->descricao?>
                            </td>
                    </tbody>
                </table>
            </div>
            <?php 

                }
            }else{?>
                <div class="card">
                     <div class="text-center" style="margin-top: 20px">
                           <a href="index.html"><img src="unicesumar.png" /></a>

                            <h2 style="margin-top:20px">Protocolo de atendimento não encontrado!</h2>
                            <p class="lead">Entre em contato conosco.<br />Nos disponibilizamos a prestar mais esclarecimentos sobre serviço.</p>
                          </div>
                          <a href="index.html">VOLTAR</a>
                    </div>
           <?php }
        }
        else{
            echo "Erro";
        }
        ?>
        </div>
          
      </div>
        
    </div><!-- container -->
  </body>
</html>


