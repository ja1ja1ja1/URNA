<?php
 include("conexao.php");
 $cpf = "";
 if(isset($_GET["cpf"])){
   $cpf = $_GET["cpf"];
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

        function procura(cpf){
            //alert(id.value);
            var oXml = oGetXML("cadastro_xml.php?cpf=" + cpf.value);
            
            document.frm.nome.value = oXml.childNodes[0].getAttribute("nome");
            document.frm.cpf.value = oXml.childNodes[0].getAttribute("cpf");
            document.frm.vt1.value = oXml.childNodes[0].getAttribute("vt1");
            document.frm.vt2.value = oXml.childNodes[0].getAttribute("vt2");
            document.frm.cod.value = oXml.childNodes[0].getAttribute("cod");

        }
        function oGetXML(szParams_){
            var oRequest;
            try{
                oRequest = new ActiveXObject("Microsoft.XMLHTTP");
                //alert(oRequest);
            }
            catch(e){
                try{
                    oRequest = new ActiveXObject("Msxml2.XMLHTTP");
                    //alert(oRequest);
                }
                catch(ex){
                    try{
                        oRequest = new XMLHttpRequest();
                    }
                    catch(exc){
                        alert("Falha na Comunicação XML");
                        oRequest = null;
                    }
                }
            }
            oRequest.open("POST", szParams_, false);
            oRequest.send(szParams_);
            //alert(oRequest.responsetext);
            return oRequest.responseXML.documentElement;
        }

        /*function checkCPF(){
        var cpf = document.frm.cpf.value
            cpf = cpf.replace(/\.|-/g,"");
        let soma = 0;
        soma += cpf[0] * 10;
        soma += cpf[1] * 9;
        soma += cpf[2] * 8;
        soma += cpf[3] * 7;
        soma += cpf[4] * 6;
        soma += cpf[5] * 5;
        soma += cpf[6] * 4;
        soma += cpf[7] * 3;
        soma += cpf[8] * 2;
        soma = (soma * 10) % 11;
        if(soma==10 || soma == 11)
            soma = 0;
        
        if(soma != cpf[9])
            return false
        soma += cpf[0] * 11;
        soma += cpf[1] * 10;
        soma += cpf[2] * 9;
        soma += cpf[3] * 8;
        soma += cpf[4] * 7;
        soma += cpf[5] * 6;
        soma += cpf[6] * 5;
        soma += cpf[7] * 4;
        soma += cpf[8] * 3;
        soma += cpf[9] * 2;
        soma = (soma * 10) % 11;
        
        if(soma==10 || soma == 11)
            soma = 0;
        
        if(soma !=cpf[10])
        return false
       
        
        
        return true;
    }*/
        function focus(){
            document.frm.butao_xml.focus();
        }
    </script>
    
    
    <title>CADASTRO</title>
</head>
<body id="body-cad" onload="focus()">

    <div id="cab">
    <a href="PaginaInicial.php?cidadao=<?php echo $_GET['cidadao']; ?>" id="bt-back"><img src="img/back.png" alt="" width="50px" height="50px"></a>
        <h1>Justiça Eleitoral</h1>
    </div>
    
    <form action="" method="post" name="frm">  
        <input type="hidden" name="opcao" value="cadastrar"> 
        <input type="hidden" name="sen" value="">  
        <input type="hidden" name="id" value="">
        <input type="hidden" name="id" value="">
        
            <div id="corpo-cad" style="top:32px">
            <!-- <img src="img/adm.png" alt="adm" title="adm" width="50px" heigth="30px" > -->

            

                <div style="text-align:center;font-size:x-large;color:#fff;">Pesquisa</div>
                <input type="text" name="butao_xml" onblur="procura(this)" value="<?php echo $cpf;?>" placeholder="DIGITE O CPF..." />
                <div style="color:black; background:#fff;cursor:pointer;text-align:center">Pesquisar</div>
                <label for="nome" id="lab-cad"><b>Nome</b></label><input type="text" name="nome" id="nome" class="inp-cad" value="" disabled>
                <label for="cpf" id="lab-cad"><b>CPF</b></label><input type="text" id="cpf" name="cpf" class="inp-cad"  value=""disabled>
                <label for="vt1" id="lab-cad"><b>Vereador</b></label><input type="text" id="vt1" name="vt1" class="inp-cad"  value=""disabled>
                <label for="vt2" id="lab-cad"><b>Prefeito</b></label><input type="text" id="vt2" name="vt2" class="inp-cad"  value=""disabled>
                <label for="cod" id="lab-cad"><b>Código</b></label><input type="text" id="cod" name="cod" class="inp-cad"  value=""disabled>
                
                
                <!--<label for="codE" id="lab-cad"><b>Código de eleitor</b></label><input type="text" id="codE" class="inp-cad"></td></tr>-->
                <!--<label for="sen" id="lab-cad"><b>Senha</b></label><input type="password" id="sen" name="sen" class="inp-cad">-->
                <!-- <input type="button" value="Cadastrar" onclick="cadastrar()" class="bt-cad"> -->
                
            </div>
           
    </form>
    <div id="rod">
        <!--rodapé-->
        
    </div>
</body>

</html>