<?php
	session_start();
?>
<!DOCTYPE html>


<html lang="pt-br">
<head>
	<meta charset="UTF-8">

	<title>Sistema de Login</title>
	<meta name="description" content="sistema de login">
  	<meta name="keywords" content="PHP,aula,teste, login">
  	<meta name="author" content="Valkiria Marcon">
	<link rel="stylesheet" href="css/style.css">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Comic+Neue&display=swap" rel="stylesheet"> 
</head>
<body>
	<main id="main" class="col-10">
<?php
if (isset($_POST['enviar']))
{

    function checaRegular($input)
    {
        $regex = '/^[a-zA-Z0-9]+$/i';
        return preg_match($regex, $input);
    }

    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];

    $email = $_SESSION['email'];
    $password = $_SESSION['password'];

    if (checaRegular($password))
    {
        $password = md5($password);
        $loginIsMd5 = true;
    }

    $dados = fopen('dados.txt', 'r');

    if ($dados == false)
    {
        die("<h1>acesso impossível</h1>");
    }

    $conteudo = file('dados.txt');

    foreach ($conteudo as $linha)
    {

        $linha = trim($linha);

        $valor = explode('|', $linha);

        for ($i = 0;$i < count($valor);$i++)
        {
            if ("$email$password" == "$valor[$i]" and $loginIsMd5 == true)
            {
                echo "<img id='logado' src='imagens/ok.webp'>";
                break;

            }
            else if ("$email$password" != "$valor[$i]" and isset($_POST['enviar']))
            {
                echo "<div id='desLogado'></div>";
                break;
            }
        }
    }
    if ($loginIsMd5 == true)
    {
        fclose($dados); // fecha
        
    }

}


?>

		
			<h1>login</h1>
			<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">

				<h3 class="text_input">Email:</h3>
				<input id="email" class="col-9 input" type="email" name="email">

				<h3 class="text_input">Senha:</h3>
				<input id="senha" class="col-9 input" type="password" name="password" pattern="^[a-zA-Z0-9]+$">

				<input class="col-3" id="enviar" type="submit" name="enviar" value="enviar">
			</form>
	</main>
	 <footer>
  		Valkiria Marcon © 2021
	</footer>
	<script type="text/javascript">
		

		var enviar = document.getElementById("enviar");


		var email = document.getElementById("email");
		var inputPasswordLogin = document.getElementById("senha");


		var desLogado = document.getElementById("naoLogado");
		var logado = document.getElementById("logado");


		setTimeout(function () {
			logado.style.display = 'none';
		},2000);



	</script>
</body>
</html>

