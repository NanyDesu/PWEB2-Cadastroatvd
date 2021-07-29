<?php

require_once "app/db/Connection.php";

class User
{
    private Int $id;
    private String $username;
    private String $email;
    private String $full_name;
    private String $password;

    function __construct(String $email, String $username, String $full_name, String $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->full_name = $full_name;
        $this->password = $password;
    }

    public function saveOnDatabase()
    {
        try {
            $this->hashpassword();
            $username = $this->getUsername();
            $email =  $this->getEmail();
            $full_name = $this->getFull_name();
            $password = $this->getPassword();

            $stmt = Connection::getConnection()->prepare('INSERT INTO user (username, email, full_name, password) VALUES (:username, :email, :full_name, :password)');
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":full_name", $full_name);
            $stmt->bindParam(":password", $password);
            $stmt->execute();
        } catch (Exception $err) {
            echo `<div class="exception">` . $err->getMessage() . `</div>`;
            return false;
        }
    }

    private function hashpassword()
    {
       $this->setPassword(password_hash($this->getPassword(), PASSWORD_DEFAULT));
    }

    public static function search(String $queryString){
        $stmt =  Connection::getConnection()->prepare('SELECT * FROM users WHERE email LIKE :query_string or username LIKE :query_string or fullname LIKE :query_string');
        $queryString = '%' . $queryString . '%';
        $stmt->bindParam(":query_string", $queryString);
        $fetchAll = $stmt->execute();
        $fetchAll = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $users = User::mapUser($fetchAll);
        return $users;
    }

    public static function listUser()
    {
        try {
            $query = Connection::getConnection()->query('SELECT * FROM user');
            $list = $query->fetchAll(PDO::FETCH_ASSOC);
            $users = User::mapUser($list);
            return $users;
        } catch (Exception $err) {
            echo `<div class="exeption">` . $err->getMessage() . `</div>`;
            return false;
        }
    }

    private static function mapUser($list){
        return array_map(function ($e) {
            $user =  new User($e['email'], $e['username'], $e['full_name'], $e['password']);
            $user->setId($e['id']);
            return $user;
        }, $list);
    }

    public static function signIn(String $email, String $password)
    {
        try {
            $stmt = Connection::getConnection()->prepare('SELECT * FROM user WHERE email = :email');
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $user = sizeof($result) > 0 ? $result[0] : NULL;
            if (is_null($user)) {
                throw new Exception("User not found");
            }
            if (!password_verify($password, $user['password'])) {
                throw new Exception("Invalid password");
            }
            $return = new User($user['email'], $user['username'], $user['full_name'], $user['password']);
            $return->setId($user['id']);
            return $return;
        } catch (Exception $err) {
            echo `<div class="exeption">` . $err->getMessage() . `</div>`;
            return false;
        }
    }

    public function getFull_name(){
        return $this->full_name;
    }

    public function setFull_name(String $full_name)
    {
        $this->full_name = $full_name;

        return $this;
    }

    public function getId(){
        return $this->id;
    }
    public function setId(Int $id){
        $this->id = $id;

        return $this;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setUsername(String $username){
        $this->username = $username;

        return $this;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail(String $email){
        $this->email = $email;

        return $this;
    }

    public function getpassword(){
        return $this->password;
    }

    public function setPassword(String $password){
        $this->password = $password;

        return $this;
    }
}
