<?php
$hostname = "localhost";
$bancodedados = "urna";
$usuario = "root";
$senha = "";
$id = $_POST['idCid'];

$res = array();

$con = new mysqli("localhost", "root", "", "urna");
    if ($con->connect_errno) {
        // Corrigido o uso de connect_errno e adicionado o uso correto de connect_error
        echo "Falha ao conectar: (" . $con->connect_errno . ") " . $con->connect_error;
        return; // Adicionado um return para interromper a execu��o em caso de falha de conex�o
    }
if(isset($_POST["opcao"])){

  $opcao = $_POST["opcao"];
  
}
else{
  echo "<script>alert('DEU RUIM')</script>";
};

echo $_POST["opcao"];



switch ($opcao) {
    
    case "atualizar":
      atualizar();
      header("Location: cadastro.php?feito=sim");
      exit();
      break;
      case "cadastrar":
////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////       CADASTRO        ////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
  $nome = $_POST["nome"];
  //$dtNasc = '2711-20-03';$_POST["nasc"];
  $cpf = $_POST["cpf"];
  $senha = $_POST["sen"];
  $adm = $_POST["adm"];
      // Adicionado o uso das vari�veis $nome, $sobrenome, $dtNasc, $cpf, $senha e $adm, que devem ser definidas anteriormente
    $sql = "INSERT INTO tbcidadao (nome, cpf, senha, adm)
    VALUES ('$nome', '$cpf', '$senha', '$adm')";

// Corrigido o uso do m�todo query() para execu��o da query SQL
$con->query($sql) or die ("Erro na consulta: " . $con->error);

// Adicionado o fechamento da conex�o ap�s a execu��o bem-sucedida da query
$con->close();

      header("Location: pesquisar.php?cidadao=$id&cpf=$cpf");
      exit();
      break;
    case "login":
////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////       LOGIN        ///////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////




$cpf = $_POST["cpf"];
$senha = $_POST["sen"];
$sql = "SELECT * FROM tbCidadao where cpf = '$cpf' and senha= '$senha' ";
$cmd = $con->query($sql) or die ("Erro na consulta: " . $con->error);

if($cmd->num_rows!=0){
  $dados = $cmd->fetch_assoc();
  $cidadao = $dados['idCid'];
  if($dados['adm'] == "Sim"){
    header("location:PaginaInicial.php?cidadao=$cidadao&adm=Sim");
    exit();
  }
  else{
    if($dados['vtVereador'] == ""){
      header("location:PaginaInicial.php?cidadao=$cidadao");
    }else{
      if($dados['vtPrefeito'] == ""){
        header("location:PaginaInicial.php?cidadao=$cidadao&nivel=1");
      }else{
        header("location:PaginaInicial.php?cidadao=$cidadao&nivel=2");
      }
    }
  }
}else{
  header("location:login.php?ext=nao");
}


      $con->close();
    
      //header("Location: urna.php?feito=sim");
      //header("Location: PaginaInicial.php?feito=sim");
      exit();
      break;
    
////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////       URNA        ////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
    case "urna":

      $cidadao = $_POST["cidadao"];
      $voto = $_POST["voto"];
      $nivel = $_POST["nivel"];
      //nivel 0, voto em vereador
      if($nivel == ""){
        //VOTO NULO
        if($voto == ""){
          $sql = "UPDATE tbCidadao SET vtVereador = '$voto' WHERE idCid = $cidadao;";
          $cmd = $con->query($sql) or die ("Erro na consulta: " . $con->error);

            header("location:urna.php?cidadao=$cidadao&nivel=1");

        }elseif($voto != "branco"){

          $sql = "UPDATE tbCidadao SET vtVereador = '$voto' WHERE idCid = $cidadao;";
          $cmd = $con->query($sql) or die ("Erro na consulta: " . $con->error);
          
            header("location:urna.php?cidadao=$cidadao&nivel=1");
        }else{
        //se o cara votou em branco
          $sql = "UPDATE tbCidadao SET vtVereador = '$voto' WHERE idCid = $cidadao;";
          $cmd = $con->query($sql) or die ("Erro na consulta: " . $con->error);
          header("location:urna.php?cidadao=$cidadao&nivel=1");
        }
        //nivel 1, voto em prefeito
      }elseif($nivel == "1"){
        //se o cara nao votou em branco
        //VOTO NULO
        if($voto == ""){

          $sql = "UPDATE tbCidadao SET vtPrefeito = '$voto' WHERE idCid = $cidadao;";
          $cmd = $con->query($sql) or die ("Erro na consulta: " . $con->error);

          header("location:PaginaInicial.php?cidadao=$cidadao&nivel=1");

        }elseif($voto != "branco"){

          $sql = "UPDATE tbCidadao SET vtPrefeito = '$voto' WHERE idCid = $cidadao;";
          $cmd = $con->query($sql) or die ("Erro na consulta: " . $con->error);

          header("location:PaginaInicial.php?cidadao=$cidadao&nivel=2");

          }else{
        //se o cara votou em branco

            $sql = "UPDATE tbCidadao SET vtPrefeito = '$voto' WHERE idCid = $cidadao;";
            $cmd = $con->query($sql) or die ("Erro na consulta: " . $con->error);

            header("location:PaginaInicial.php?cidadao=$cidadao&nivel=2");
          }

      }else{
        //se o cara j� votou nos dois candidatos
        header("location:PaginaInicial.php?cidadao=$cidadao&nivel=2");
      }
      $con->close();
      exit();
      break;
    case "vtPrefeito":
      vtPrefeito();
      header("Location: cadastro.php?feito=sim");
      exit();
      break;
    default:
      echo "Your favorite color is neither red, blue, nor green!";
  }



  function cadastro(){
    
    
    
}

function atualizar(){
  $con = new mysqli("localhost", "root", "", "urna");
    if ($con->connect_errno) {
        // Corrigido o uso de connect_errno e adicionado o uso correto de connect_error
        echo "Falha ao conectar: (" . $con->connect_errno . ") " . $con->connect_error;
        return; 
    }
    

    $sql = "UPDATE tbusuarios SET
            Nome = '$nome',
            Sobrenome = '$sobrenome',
            dtNasc = '$dtNasc',
            senha = '$senha',
            adm = '$adm'
            cpf = '$cpf'
            WHERE idusuario = '' ";
    
    
    if (!$con->query($sql)) {
        echo "Erro na execu��o da query: (" . $con->errno . ") " . $con->error;
        $con->close(); 
        return;
    }

    
    $con->close();
}

function candidatar(){
  $con = new mysqli("localhost", "root", "", "urna");
  if ($con->connect_errno) {
      
      echo "Falha ao conectar: (" . $con->connect_errno . ") " . $con->connect_error;
      return;
  }
  

  $sql = "INSERT INTO tbcandidato (Nome, Sobrenome, dtNasc, cpf, senha, adm)
          VALUES ('$nome', '$sobrenome', '$dtNasc', '$cpf', '$senha', '$adm')";
  

  if (!$con->query($sql)) {
      echo "Erro na execu��o da query: (" . $con->errno . ") " . $con->error;
      $con->close(); 
      return;
  }


  $con->close();
}

function login(){
  if($cmd->num_rows!=0){
    
    $cmd = $con->query("SELECT * FROM tbCidadao where cpf = '$cpf' and senha= '$senha' 
    and vtVereador is null and vtPrefeito is null") or die ("Erro na consulta: " . $con->error);
    if($cmd->num_rows!=0){
      $dados = $cmd->fetch_assoc();
      $cidadao = $dados['idCid'];
      
      header("location: PaginaInicial.php?cidadao=$cidadao");
    }else{
      header("location:Login.php?votou=sim");
    }
}else{
  header("Location: Login.php?ext=nao");
}
}

  
?>