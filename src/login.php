
<?php
$cpf ="56040199860";
if(isset($_GET["votou"])){
    $votou = $_GET['votou'];
}
if(isset($_GET["cpf"])){
    $cpf = $_GET['cpf'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>LOGIN</title>
    <script>
        var votou = "nao";
        function entrar(){

            if(document.frm.cpf.value == ""){
                alert("Preencha o campo CPF!");
                document.frm.cpf.focus()
                return;
            }
            if(document.frm.sen.value == ""){
                alert("Preencha o campo CODIGO DE ELEITOR!");
                document.frm.sen.focus()
                return;
            }
            
            document.frm.action = "urnaBD.php"
            document.frm.submit()
            
        }
        function cadastro(){
            document.frm.action = "cadastro.php";
        }
        
    </script>
</head>
<body id="body-cad">
    <div id="cab">
        <h1>Justiça Eleitoral</h1>
    </div>
    
    <form action="" method="post" name="frm">  
        <input type="hidden" name="opcao" value="login">  
        <input type="hidden" name="votou" value="<?php echo $votou ?>">
        <input type="hidden" name="id" value="">
        <input type="hidden" name="id" value="">  
        <table id="corpo-cad">
            <div >
            <tr><td colspan="2"><h2 style="color:#fff;margin-left:80px">ENTRAR</h2></td></tr>
                
                <tr><td><label for="sen" id="lab-cad"><b>CPF</b></label></td></tr>
                <?php
                if($cpf!=""){
                echo "<tr><td><label style='color=#fff'>esse cpf já votou!!</label></td></tr>"; 
                } 
                
                ?>
                <tr><td colspan="2"><input type="text" id="cpf" name="cpf" class="inp-log" value="<?php echo $cpf?>"></td></tr>
                <tr><td><label for="sen" id="lab-cad"><b>Código de eleitor</b></label></tr>
                
                <tr><td colspan="2"><input type="text" id="sen" name="sen" class="inp-log" value="adm123"></td></tr>
                <?php 
                if(isset($_GET["ext"])){
                    echo "<tr><td><label  style='color=#fff'>CPF OU CODIGO ERRADO!!</label></td></tr>"; 
                    } 
                ?>
                <tr><td style="text-align:center"><input type="button" value="Entrar" class="bt-log" onclick="entrar()"></td></tr>
            </div>
        </table>   
    </form>
    <div id="rod">
        <!--rodapé-->
    </div>
    <script>
  // Limpar histórico ao carregar a página de login
  window.onload = function() {
    window.history.clear();
  }
</script>
</body>
</html>