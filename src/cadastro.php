<?php
 include("conexao.php");

 if(isset($_POST["nome"])){
   
$nome = $_POST["nome"];
$sobrenome = $_POST["sobrenome"];//NAO PRECISA DE SOBRENOME
//$dtNasc = $_POST["dtNasc"];
$cpf = $_POST["cpf"];
$senha = $_POST["senha"];//vai ser o codigo de eleitor
$adm = $_POST["adm"];

 
$sql = "INSERT INTO cidadao VALUES (NULL, '$nome', '$cpf', '$senha', '$adm')";
$res = mysqli_query($conn,$sql);
$conn->close();

}
if(isset($_GET['feito'])){
$feito = $_GET['feito'];
}else{
    $feito = "";
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
            document.frm.action = "";
            location = "login.php"
        }
        function cadastrar(){
            // Definir caracteres poss�veis para a senha
            const caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            let isenha = "";

            // Gerar senha com 8 caracteres aleat�rios
            for (let i = 0; i < 8; i++) {
                isenha += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
            }
            //checkCPF();
            document.frm.sen.value = isenha;            
            document.frm.submit();
        }

        

        
    
        
    </script>
    
    
    <title>CADASTRO</title>
</head>
<body id="body-cad">

    <div id="cab">
    <a href="PaginaInicial.php?cidadao=<?php echo $_GET['cidadao']; ?>" id="bt-back"><img src="img/back.png" alt="" width="50px" height="50px"></a>

        <h1>Justiça Eleitoral</h1>
    </div>
    
    <form action="urnaBD.php" method="post" name="frm">  
        <input type="hidden" name="opcao" value="cadastrar"> 
        <input type="hidden" name="sen" value="">  
        <input type="hidden" name="idCid" value="<?php echo $_GET['cidadao']; ?>">
        <input type="hidden" name="id" value="">
        
            <div id="corpo-cad">
            

            

                <h2 style="color:#fff;margin-left:80px">CADASTRO</h2>
                
                <label for="nome" id="lab-cad"><b>Nome</b></label><input type="text" name="nome" id="nome" class="inp-cad" value="">
                <label for="cpf" id="lab-cad"><b>CPF</b></label><input type="text" id="cpf" name="cpf" class="inp-cad"  value="">                
                <label for="adm" id="lab-cad"><b>ADM</b></label></td>
                    <select name="adm">
                        <?php
                        //if($feito !=""){
                        // echo "<option>$adm</option>";
                        //}  
                         ?>                        
                        <option>Não</option>
                        <option>Sim</option>
                    </select>
                
                <!--<label for="codE" id="lab-cad"><b>Código de eleitor</b></label><input type="text" id="codE" class="inp-cad"></td></tr>-->
                <!--<label for="sen" id="lab-cad"><b>Senha</b></label><input type="password" id="sen" name="sen" class="inp-cad">-->
                <input type="button" value="Cadastrar" onclick="cadastrar()" class="bt-cad">
                
            </div>
           
    </form>
    <div id="rod">
        <!--rodapé-->
        <button id="bt-saida"><img src="img/saida.png" alt="" width="50px" height="45px"  onclick="goback()"></button>
    </div>
</body>

</html>