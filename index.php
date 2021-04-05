<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Estácio</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <section class="form-section">
      <h1>Login de Acesso para Cadastro de Alunos</h1>

      <div class="form-wrapper">
        <form class="form"  action="login.php" method="POST">
          <div class="input-block">
            <label for="email"><input type="email" name="email" id="email" placeholder="seu.email@email.com" required></label>
          </div>
          <div class="input-block">  
            <label for="password"><input type="password" name="password" id="password"  placeholder="&#9679 &#9679 &#9679 &#9679 &#9679 &#9679" required></label>
          </div>
                <button class="btn btn-white">Entrar</button>
        </form>
      </div>
    </section>

    <ul class="squares"></ul>

    <script src="script.js"></script>
  </body>
</html>