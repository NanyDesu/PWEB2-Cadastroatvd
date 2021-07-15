<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/global.css">
    <link rel="stylesheet" href="public/css/signIn.css">
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <form action="?class=User&action=signIn" method="post">
            <div class="form-control">
                <label for="email">Email</label>
                <input placeholder="email *" type="email" name="email" id="email" required>
            </div>
            <div class="form-control">
                <label for="password">Senha</label>
                <input placeholder="senha *" type="password" name="password" id="password" required>
            </div>
            <button type="submit">Entrar</button>
            <div class="vocative">
                <span>Não possui uma conta?</span>
                <a href="?view=signUp">Crie uma conta aqui</a>
            </div>
        </form>
    </div>
</body>

</html>