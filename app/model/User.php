<?php

class User extends Db{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $charset;
    public function insert($username, $mail, $password) {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $db = new Db();
        $db->connect();

        $stmt = $db->pdo->prepare("INSERT INTO users (uidUser, emailUser, pwdUser) VALUES (:username, :mail, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        echo "U bazi je";

        return $db->pdo;
    }

    //selectati određenog korisnika kako ne bih imao više korisnika sa istim username-om u bazi

}