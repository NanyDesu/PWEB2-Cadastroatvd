<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>signIn</title>
</head>

<body>
    <div class="container">
        <h1>Cadastro</h1>
        <form action="?class=User&action=signIn" method="post">
            <div class="form">
                <label for="username">Usuário</label>
                <input placeholder="username *" type="text" name="username" id="username" required>
            </div>
            <div class="form-control">
                <label for="full_name">Nome Completo</label>
                <input placeholder="nome completo *" type="text" name="full_name" id="full_name" required>
            </div>
            <div class="form-control">
                <label for="email">Email</label>
                <input placeholder="email *" type="email" name="email" id="email" required>
            </div>
            <div class="form-control">
                <label for="password">Senha</label>
                <input placeholder="senha *" type="password" name="password" id="password" required>
            </div>
            <button type="submit">Enviar</button>
            <div class="vocative">
                <span>Já possui uma conta?</span>
                <a href="?view=signIn">Realize o login!</a>
            </div>
        </form>
    </div>
</body>

</html>
