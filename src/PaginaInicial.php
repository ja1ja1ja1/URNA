<?php
include("conexao.php"); 

$Vereador ="";
$Prefeito ="";
    include("conexao.php"); 
    
    if(isset($_GET["cidadao"])){
        $idCid= $_GET['cidadao'];
        $cmd = $con->query("SELECT * FROM tbcidadao where idCid = $idCid") or die ("Erro na consulta: " . $con->error);
        if($cmd->num_rows!=0){
            $dados = $cmd->fetch_assoc();
            $cidadao = $dados['idCid'];
            $nome = $dados['nome'];
            $cpf = $dados['cpf'];
            $Codigo = $dados['senha'];
            $vt1 = $dados['vtVereador'];
            $vt2 = $dados['vtPrefeito'];
            $adm = $dados['adm'];
        }
        if($vt1 !="" && $vt1 !="nulo" && $vt1 !="branco" ){
        $cmd = $con->query("SELECT * FROM tbCandidato where numero = $vt1 ;") or die ("Erro na consulta: " . $con->error);
        $dados = $cmd->fetch_assoc();
        $Vereador = $dados['nome_candidato'];        
        }
        if($vt2 !="" && $vt2 !="nulo" && $vt1 !="branco"){
        $cmd = $con->query("SELECT * FROM urna.tbCandidato where numero = $vt2 ;") or die ("Erro na consulta: " . $con->error);
        $dados = $cmd->fetch_assoc();
        $Prefeito = $dados['nome_candidato'];   
        }
        if($vt1 == "nulo"){
            $Vereador = $vt1;
        }
        if($vt2 =="nulo"){
            $Prefeito = $vt2;
        }
        if($vt1 == "branco"){
            $Vereador = $vt1;
        }
        if($vt2 =="branco"){
            $Prefeito = $vt2;
        }
    }  
    //echo "SELECT * FROM tbCandidato where numero = $vt2 ;";

    // Extrair os três primeiros dígitos do número
    $primeiraParte = substr ($cpf, 0, 3);
    $segundaParte = substr ($cpf, 3, 3);
    $terceiraParte = substr ($cpf, 6, 3);
    $quartaParte = substr ($cpf, -2);
        
    $cpf = $primeiraParte . "." . $segundaParte . "." . $terceiraParte . "-" . $quartaParte;
      
     

$adm ="";
$nivel = "";
if(isset($_GET['cidadao'])){
    $cidadao = $_GET['cidadao'];
    $cmd = $con->query("SELECT * FROM tbCidadao where idCid = $cidadao") or die ("Erro na consulta: " . $con->error);
    if($cmd->num_rows==0){
        header("location:login.php");
    }
}else{
    header("location:login.php");
}
if(isset($_GET['cidadao'])){
$sql = "SELECT * FROM tbCidadao where idCid = $cidadao  ";
$cmd = $con->query($sql) or die ("Erro na consulta: " . $con->error);
$dados = $cmd->fetch_assoc();

if($dados['adm'] == "Sim"){
    $adm = "sim";
}
if($dados['vtVereador'] != ""){
    $nivel = 1;
}
if($dados['vtPrefeito'] != ""){
    $nivel = 2;
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <script>
   
        function goback(){
            location ="login.php"
        }
    </script>
    <title>Justiça Eleitoral</title>
</head>
<body id="body-cad">
    <div id="cab">
        <h1>Justiça Eleitoral</h1>
    </div>
    
        <table id="corpo-PI">
            <tr><td>
                <?php if($nivel != 2){
                    echo "<a href='urna.php?cidadao=$cidadao&nivel=$nivel' class='bt-pi'>VOTAR</a>";
                }else{
                    echo "<div class='bt-pi'>VOTO REGISTRADO</div>";
                }
                ?>
                <?php
                if ($adm != ""){
                echo "<a href='pesquisar.php?cidadao=$cidadao&adm=$adm' class='bt-pi'>PESQUISAR</a>";
                echo "<a href='cadastro.php?cidadao=$cidadao&adm=$adm' class='bt-pi'>CADASTRAR</a>";
                }
                ?>
            </td></tr>
        </table>
        <table >
        <div style="width:100px"></div>
            <div id="corpo-cad">
                <?php if($adm == "Sim"){echo "<img src='img/adm.png' alt='adm' title='adm' width='50px' height='50px'>";}?>
                
                <h2 style="color:#fff;margin-left:80px">MEUS DADOS</h2>
                <label id="lab-cad"><b>Nome</b></label>
                <div class="inp-dados"><b>
                    <?php
                        if(isset($nome)){
                            echo $nome;
                        }
                    ?></b>
                </div>               
                <label id="lab-cad"><b>CPF</b></label>
                <div class="inp-dados"><b>
                <?php
                        if(isset($cpf)){
                            echo $cpf;
                        }
                    ?></b>
                </div>
                <label id="lab-cad"><b>Voto Vereador</b></label>
                <div class="inp-dados"><b>
                <?php
                        if(isset($vt1)){
                            echo $Vereador;
                        }
                    ?></b>
                </div>
                <label id="lab-cad"><b>Voto Prefeito</b></label>
                <div class="inp-dados"><b>
                <?php
                        if(isset($vt2)){
                            echo $Prefeito;
                        }
                    ?></b>
                </div>
                <label id="lab-cad"><b>Código de eleitor</b>
                <div class="inp-dados"><b>
                <?php
                        if(isset($Codigo)){
                            echo $Codigo;
                        }
                    ?></b>
                </div>
            </div>
    
    </div>
    <div id="rod">
    <button id="bt-saida"><img src="img/saida.png" alt="" width="50px" height="45px" onclick="goback()"></button><!--rodapé-->
    </div>

    <script>
  
</script>
</body>
</html>