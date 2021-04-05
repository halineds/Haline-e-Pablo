<?php
// variaveis de conexão
$servername = "localhost";
$database = "escola";
$username = "root";
$password = "";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "CONEXÃO REALIZADA COM SUCESSO!!!! <br/><br/>";

if($result = $conn->query("select * from alunos")){

    //print_r($result);
  

    while ($row = $result->fetch_row()) {
        $lista = '';
        $lista = '<ul>';
        $lista = $lista.'<li> <b>Id:</b> '.utf8_encode($row[0]);
        $lista = $lista.'<li> <b>Nome:</b> '.utf8_encode($row[1]);
        $lista = $lista.'<li> <b>Email:</b>'.utf8_encode($row[2]);
        $lista = $lista.'<li> <b>Telefone:</b> '.utf8_encode($row[3]);
        $lista = $lista.'</ul>';

        print_r($lista);
    }      

}else{
    print_r("nenhum resgistro encontrado");
}

mysqli_close($conn);

?>