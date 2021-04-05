<?php
    include('verifica_login.php');

    // variaveis de conexão
    $nomeservidor = "localhost";
    $database = "escola";
    $username = "root";
    $password = "";
    // Create connection
    $conn = mysqli_connect($nomeservidor, $username, $password, $database);

    //Variaveis globais
    $nome = "";
    $email = "";
    $celular = "";

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    function listar($conexao){
        global $lista;
        $lista = '';
        //lista dos dados da tabela de alunos do banco escola
        if($result = $conexao->query("select * from alunos")){
            while($row = $result->fetch_row()){
                $lista = $lista.'<tr>';
                $lista = $lista.'<td>'.utf8_encode($row[1]).'</td>';
                $lista = $lista.'<td>'.utf8_encode($row[2]).'</td>';
                $lista = $lista.'<td>'.utf8_encode($row[3]).'</td>';
                $lista = $lista.'<td>';
                $lista = $lista.'<button type="button" onclick="editar('.$row[0].')">EDITAR</button>';
                $lista = $lista.'&nbsp;';
                $lista = $lista.'<button type="button" onclick="excluir('.$row[0].')">EXCLUIR</button>';
                $lista = $lista.'</td>';
                $lista = $lista.'<tr>';
            }
        }else{
            echo("Nenhum resgistro encontrado");
        } 
    }
    //$conexao É UMA VARIAVEL DA FUNÇÃO SALVAR
    //TEM QUE PASSAR A CONEXÃO PARA A FUNÇÃO PODER UTLIZAR NA EXECUÇÃO DA QUERY
    function salvar($conexao){
        
        if(!isset($_POST["nome"]) || $_POST["nome"] == null){
            die("Campo nome inválido!!!");
        }else{
            $nome = $_POST["nome"];
        }
        if(!isset($_POST["celular"]) || $_POST["celular"] == null){
            die("Campo telefone inválido!!!");
        }else{
            $celular = $_POST["celular"];
        }
        if(!isset($_POST["email"]) || $_POST["email"] == null){
            die("Campo e-mail inválido!!!");
        }else{
            $email = $_POST["email"];
        }

        //echo("Nome: ".$nome);
        //echo("Celular: ".$celular);
        //echo("E-mail: ".$email);
        //SE PASSOU NA VALIDAÇÃO, DEVE SER EXECUTADA A QUERY DE INSERT DOS DADOS.
        if($_POST['codAluno'] == ''){
            $sql = "insert into alunos (nome,celular,email)";
            $sql = $sql . " values ('".$nome."','".$celular."','".$email."')";
        }else{
            $sql = "update alunos set ";
            $sql = $sql . " nome = '". $nome ."',";
            $sql = $sql . " celular = '". $celular ."',";
            $sql = $sql . " email = '". $email ."'";
            $sql = $sql . " where id = ". $_POST['codAluno'];
        }

        $result = $conexao->query($sql);
        if($result){
            echo("DADOS SALVOS COM SUCESSO!!!");
        }
    }

    function encontrar($conexao){
        global $nome, $email, $celular;
        if($result = $conexao->query("select * from alunos where id = ".$_POST['codAluno'])){
            $row = $result->fetch_row();
            $nome = utf8_encode($row[1]);
            $email = utf8_encode($row[2]);
            $celular = utf8_encode($row[3]);
        }else{
            echo("Aluno não encontrado!!!");
        } 
    }    

    function excluir($conexao){
        if($_POST['codAluno'] != ''){
            $sql = "delete from alunos where id = ". $_POST['codAluno'];
            $result = $conexao->query($sql);
            if($result){
                echo("DADOS EXCLUIDOS COM SUCESSO!!!");
            } 
        }else{
            echo("ALUNO NÃO ENCONTRADO!!!");
        }       
    }

    // VERIFICA SE OS DADOS FORAM SUBMETIDOS PELO (method="POST") NO FORMULÁRIO
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        switch ($_POST['acao']) {
            case 'SALVAR':
                salvar($conn);
                break;
            case 'EDITAR':
                encontrar($conn);
                break;    
            case 'EXCLUIR':
                excluir($conn);
                break;                         
        }
    }

    listar($conn);
    mysqli_close($conn);

?>
<html>
    <head>
        <title> Estácio </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="estilo.css">
        <script type="text/javascript" src="javascript.js"></script>
    </head>
<body>
        <form id="cadAluno" method="POST" action="cadastro.php">
            <!-- Dados de controle -->
            <input type="hidden" id="codAluno" name="codAluno" value="<?=$_POST['codAluno']?>" size="3"/>        
            <input type="hidden" id="acao" name="acao" value="<?=$_POST['acao']?>" size="10"/>        
            <!-- Dados de controle -->
            <h3>CADASTRO DE ALUNOS</h3>            
            <label>Nome</label> 
            <input type="text" id="nome" name="nome" value="<?=$nome?>"/>
            <label>E-mail</label> 
            <input type="text" id="email" name="email" value="<?=$email?>"/>
            <label>Celular</label> 
            <input type="text" id="celular" name="celular" value="<?=$celular?>"/> 
            <button type="button" onclick="salvar()">Salvar</button>
            <button type="button" onclick="limpar()">Limpar</button> 
        </form>
        <p id="mensagem"></p>
        <table>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Celular</th>
                <th>Ações</th>
            </tr>
            <?php echo($lista) ?>
        </table>
</body>
</html>