<?php
include("conexao.php"); 
$numero = array();
$candidato = array();

if($_GET['nivel'] != 1){
    $sql = "SELECT * FROM tbCandidato where cargo = 'Vereador'";
    $result = $con->query($sql);
    

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $numero[] = $row['numero'];
            $candidato[] = $row['nome_candidato'];
        }
    }else{
        echo "SEM CANDIDATOS";
    }
}else{
    $sql = "SELECT * FROM tbCandidato where cargo = 'Prefeito'";
    $result = $con->query($sql);
    $numero = array();
    $candidato = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $numero[] = $row['numero'];
            $candidato[] = $row['nome_candidato'];
        }
    }else{
        echo "SEM CANDIDATOS";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css.CSS">
<script>

var asdas;

var envio = 0;


    function number(n){
       var vt = document.frm.voto.value;
 
       //alert(document.frm.nivel.value)
       if(vt == "branco"){
        location.reload();
       }
        if(vt.length == 0){
            document.getElementById("cx1").innerHTML = n;
            document.frm.voto.value = n;
        }
        if(vt.length == 1){
            document.getElementById("cx2").innerHTML = n;
            document.frm.voto.value += n;
        }
        if(document.frm.nivel.value != "1"){
            if(vt.length == 2){
                document.getElementById("cx3").innerHTML = n;
                document.frm.voto.value += n;
            }
        }
        if(document.frm.nivel.value != "1"){
            if(vt.length == 3){
                document.getElementById("cx4").innerHTML = n;
                document.frm.voto.value += n;
            }
        }
        if(document.frm.nivel.value != "1"){
            if(vt.length == 4){
                document.getElementById("cx5").innerHTML = n;
                document.frm.voto.value += n;
            }
        }

    }
    function branco(){
        document.frm.voto.value = "branco";
        document.getElementById("cx1").style.display = "none"
        document.getElementById("cx2").style.display = "none"
        document.getElementById("cx3").style.display = "none"
        document.getElementById("cx4").style.display = "none"
        document.getElementById("cx5").style.display = "none"
        document.getElementById("branco").style.display = "block"
    }
    function corrigir(){
        var vt = document.frm.voto.value;
        if(vt == "branco"){
            location.reload();
        }
        if(vt == "nulo"){
            location.reload();
        }
        if(vt.length == 1){
            document.getElementById("cx1").innerHTML = "";
            document.frm.voto.value = ""
        }
        if(vt.length == 2){
            document.getElementById("cx2").innerHTML = "";
            document.frm.voto.value = document.frm.voto.value.substring(0, 1);
        }
        if(vt.length == 3){
            document.getElementById("cx3").innerHTML = "";
            document.frm.voto.value = document.frm.voto.value.substring(0, 2);
        }
        if(vt.length == 4){
            document.getElementById("cx4").innerHTML = "";
            document.frm.voto.value = document.frm.voto.value.substring(0, 3);
        } 
        if(vt.length == 5){
            document.getElementById("cx5").innerHTML = "";
            document.frm.voto.value = document.frm.voto.value.substring(0, 4);
        }
    }
    window.onpopstate = function(event) {
            // Faz algo quando o usuário clica no botão Voltar do navegador
        history.back();
        };
    
    function confirmar(){
        var envio = 0;
        var vt = document.frm.voto.value;
        var nvl = document.frm.nivel.value;
        


        if(nvl != 1){
            if(vt.length == 5 || vt == "branco"){
                for(i=0;i<5;i++){
                    if(document.getElementsByName("cand")[i].value == vt || vt == "branco"){
                        document.frm.submit();
                        return;
                    }
                }
                
                nulo();
            }else{
                
                nulo();
            }
        }else{
           // alert(vt.length)
             
            if(vt.length == 2 || vt == "branco"){
                for(i=0;i<5;i++){
                    if(document.getElementsByName("cand")[i].value == vt || vt == "branco"){
                        document.frm.submit();
                        return;
                    }
                }
                nulo();
            }else{
                
                nulo();
            }
        }
    }
    function nulo(){
       //alert(envio)
        if(envio > 0){
            
            document.frm.submit();
        }else{
            document.frm.voto.value = "nulo";
            envio = 1;
            document.getElementById("nulo").style.display = "block";
            
        }
    }
    
</script>
<title>URNA</title>
</head>
<body id="body-cad" onload="load()">


<div id="cab">
<a href="PaginaInicial.php?cidadao=<?php echo $_GET['cidadao']; ?>" id="bt-back"><img src="img/back.png" alt="" width="50px" height="50px"></a>
        <h1>Justiça Eleitoral</h1>
    </div>
    
    <div id="maquina">
        <form action="urnaBD.php" method="post" name="frm">
            <input type="hidden" name="opcao" value = "urna">
            <!-- <input type="hidden" name="opcao" value = "<?php //echo $vereador; ?>"> -->
            <input type="hidden" name="voto">
            <input type="hidden" name="nivel" value="<?php if(isset($_GET['nivel'])){echo $_GET['nivel'];} ?>">
            <input type="hidden" name="cidadao" value="<?php if(isset($_GET['cidadao'])){echo $_GET['cidadao'];} ?>">
        <table id="urna">
            <tr><td rowspan="6">
                <div id="visor">
                    <div id="branco">CONFIRMAR VOTO EM BRANCO</div>
                    <div id="nulo">CONFIRMAR VOTO NULO</div>
                    <div class="numV" id="cx1"></div>
                    <div class="numV" id="cx2"></div>
                    <div class="numV" id="cx3" name="Vpf"<?php if($_GET['nivel'] == "1"){echo "style='display:none;'";} ?>></div>
                    <div class="numV" id="cx4" name="Vpf"<?php if($_GET['nivel'] == "1"){echo "style='display:none;'";} ?>></div>
                    <div class="numV" id="cx5" name="Vpf"<?php if($_GET['nivel'] == "1"){echo "style='display:none;'";} ?>></div>
                </div>
            </td><td colspan="2"><img src="img/justicaLogo.jpg" alt="" id="logo"></td><td class="cinza"colspan="2">JUSTIÇA ELEITORAL</td></tr>
            <tr><td><input type="button" class="bt-num" onclick="number(1)" value="1"></td><td><input type="button"class="bt-num" onclick="number(2)" value="2"></td><td><input type="button"class="bt-num" onclick="number(3)" value="3"></td></tr>
            <tr><td><input type="button"class="bt-num" onclick="number(4)" value="4"></td><td><input type="button"class="bt-num" onclick="number(5)" value="5"></td><td><input type="button"class="bt-num" onclick="number(6)" value="6"></td></tr>
            <tr><td><input type="button"class="bt-num" onclick="number(7)" value="7"></td><td><input type="button"class="bt-num" onclick="number(8)" value="8"></td><td><input type="button"class="bt-num" onclick="number(9)" value="9"></td></tr>
            <tr><td colspan="3"><input type="button"class="bt-num0" onclick="number(0)" value="0"></td></tr>
            <tr>
            <td><input type="button" class="bt-click" onclick="branco()" value="BRANCO"></td>
            <td><input type="button" class="bt-click" onclick="corrigir()" value="CORRIGIR" id="Corrigir"></td>
            <td><input type="button" class="bt-click" onclick="confirmar()" value="CONFIRMAR" id="Confirmar"></td>
            </tr>
        </div>
        </table>
        
        <div id="Visorcand" >
            <div class="candidatos">
                <input type="hidden" id="cand1" name="cand" value="<?php echo $numero[0]?>">
                <?php if($_GET['nivel'] == "1"){ echo "<img src='./img/avatar7.png' alt='avatar1'>";}
                    else{echo "<img src='./img/avatar8.png' alt='avatar1'>";}?>
                <br> <?php echo $candidato[0]?> <br><?php echo $numero[0]?>
            </div>
            <div class="candidatos">
                <input type="hidden" id="cand2" name="cand" value="<?php echo $numero[1]?>">
                
                <?php if($_GET['nivel'] == "1"){echo "<img src='./img/avatar6.png' alt='avatar6'>";}
                        else{echo "<img src='./img/avatar9.png' alt='avatar6'>";}?>
                <br> <?php echo $candidato[1]?> <br><?php echo $numero[1]?>
            </div>
            <div class="candidatos">
                <input type="hidden" id="cand3" name="cand" value="<?php echo $numero[2]?>">
                
                <?php if($_GET['nivel'] == "1"){echo "<img src='./img/avatar3.png' alt='avatar3'>";}
                        else{echo "<img src='./img/avBat.png' alt='avatar3'>";}?>
                <br> <?php echo $candidato[2]?> <br><?php echo $numero[2]?>
            </div>
            <div class="candidatos">
                <input type="hidden" id="cand4" name="cand" value="<?php echo $numero[3]?>">
                
                <?php if($_GET['nivel'] == "1"){echo "<img src='./img/avatar4.png' alt='avatar4'>";}
                        else{echo "<img src='./img/avatar11.png' alt='avatar4'>";}?>
                <br><?php echo $candidato[3]?> <br><?php echo $numero[3]?>
            </div>
            <div class="candidatos">
                <input type="hidden" id="cand5" name="cand" value="<?php echo $numero[4]?>">
                
                <?php if($_GET['nivel'] == "1"){echo "<img src='./img/avatar5.png' alt='avatar5'>";}
                      else{echo "<img src='./img/avatar12.png' alt='avatar5'>";}?>
                <br> <?php echo $candidato[4]?> <br><?php echo $numero[4]?>
            </div>
            
        </div>
    </form> 
    </div>
</body>

</html>