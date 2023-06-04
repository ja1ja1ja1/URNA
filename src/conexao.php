<?php
    $servername = "localhost"; /* pode deixar localhost */
    $username = "root"; /* nome do usuario do banco de dados */ 
    $password = ""; /* senha do banco de dados caso exista senao deixa $password = "" */
    $dbname = "urna"; /* nome do seu banco de dados*/

    // Criando a conexão com o banco de dados
    $con = new mysqli($servername, $username, $password, $dbname);
    // Checando a conexão com o banco de dados
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    } 
?>