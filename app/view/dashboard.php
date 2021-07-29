<?php
require_once "app/model/User.php";
$user = $_SESSION["loggedUser"];
if (isset($_GET["search"])){
    $users = User::search($_GET["search"]);
}else{
    $users = User::listUser();
}
function logOut()
{
    session_destroy();
    header("Location: /");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Home</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/global.css">
    <link rel="stylesheet" href="public/css/dashboard.css">
</head>

<body>
    <div class="container">
        <section>
            <h1> Seja Bem Vindo <?= $user['username'] ?></h1>
            <form action="?view=home" method="get">
                <label for="">Pesquisar usuarios</label>
                <input id="search" name="search" type="text">
                <button type="submit">Buscar</button>
            </form>
            <table>
                <thead>
                    <th>Id</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Nome completo</th>
                </thead>
                <?php foreach ($users as $key => $value) : ?>
                    <tr>
                        <td><?= $value->getId() ?></td>
                        <td><?= $value->getEmail() ?></td>
                        <td><?= $value->getUsername() ?></td>
                        <td><?= $value->getFull_name() ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <form action="?class=User&action=logout" method="post" required>
                <button type="submit">Sair</button>
            </form>
        </section>
    </div>
</body>

</html>