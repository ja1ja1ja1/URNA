<?php

include("conexao.php"); 

$Xcpf= $_GET['cpf'];
$cmd = $con->query("SELECT * FROM tbcidadao where cpf = $Xcpf") or die ("Erro na consulta: " . $con->error);

if($cmd->num_rows!=0){
$dados = $cmd->fetch_assoc();
$nome = $dados['nome'];
    $cpf = $dados['cpf'];
    $Codigo = $dados['senha'];
    $vt1 = $dados['vtVereador'];
    $vt2 = $dados['vtPrefeito'];

    // Extrair os três primeiros dígitos do número
    $primeiraParte = substr ($cpf, 0, 3);
    $segundaParte = substr ($cpf, 3, 3);
    $terceiraParte = substr ($cpf, 6, 3);
    $quartaParte = substr ($cpf, -2);
        
    $cpf = $primeiraParte . "." . $segundaParte . "." . $terceiraParte . "-" . $quartaParte;


    //CHECANDO SE JÁ VOTOU EM ALGUEM
    if($vt1 !="" && $vt1 !="nulo" && $vt1 !="branco" ){
        $cmd = $con->query("SELECT * FROM tbCandidato where numero = $vt1 ;") or die ("Erro na consulta: " . $con->error);
        $dados = $cmd->fetch_assoc();
        $Vereador = $dados['nome_candidato'];        
        }else{
            if($vt1 == "nulo"){
                $Vereador = $vt1;
            }
            if($vt1 == "branco"){
                $Vereador = $vt1;
            }
        }
        
    if($vt2 !="" && $vt2 !="nulo" && $vt2 !="branco" ){
        $cmd = $con->query("SELECT * FROM tbCandidato where numero = $vt2 ;") or die ("Erro na consulta: " . $con->error);
        $dados = $cmd->fetch_assoc();
        $Prefeito = $dados['nome_candidato']; 
    }else{
        if($vt2 == "nulo"){
            $Prefeito = $vt2;
        }
        if($vt2 == "branco"){
            $Prefeito = $vt2;
        }
    }
    if(!isset($Vereador)){
        $Vereador ="";
    }
    if(!isset($Prefeito)){
        $Prefeito ="";
    }
//CRIANDO O XML
    header('Content-Type: text/xml');


        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo "<xml>";
        echo "<cidadao nome='$nome'  cpf='$cpf'  vt1='$Vereador - $vt1'   vt2='$Prefeito - $vt2'  cod='$Codigo' >$nome</cidadao>";
        echo "</xml>";
}else{
    
    header('Content-Type: text/xml');


        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo "<xml>";
        echo "<cidadao nome='Não Existe'    cpf='Não Existe'  vt1=''   vt2=''  cod='Não Existe' />";
        echo "</xml>";
}


?>