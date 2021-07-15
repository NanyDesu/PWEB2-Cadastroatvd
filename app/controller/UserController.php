<?php

require_once "app/model/User.php";

class UserController{
    public function signUp()
    {
        $username = $_POST["username"];
        $full_name = $_POST["full_name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        if (!isset($username) || !isset($full_name) || !isset($email) || !isset($password)) {
            require_once "app/view/signUp.php";
        } else {
            $user = new User($email, $username, $full_name, $password);
            $result = $user->saveOnDatabase();
            if (!is_bool($result)) {
                require_once "app/view/signIn.php";
            } else {
                require_once "app/view/signUp.php";
            }
        }
    }

    public function signIn()
    {
        $email = $_POST["email"];
        $password = $_POST["password"];
        if (!isset($email) || !isset($password)) {
            require_once "app/view/signUp.php";
        } else {
            $result = User::signIn($email, $password);
            if (!is_bool($result)) {
                $_SESSION["loggedUser"] = array("id" => $result->getId(), "username" => $result->getUsername(), "email" => $result->getEmail());
                require_once "app/view/dashboard.php";
            } else {
                require_once "app/view/signIn.php";
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: ?view=signIn");
    }
}