<?php

class User {
    private $id;
    private $username;
    private $email;
    private $password;
    private $status;

    /*public function __construct($id, $username, $email, $password, $status) {
        $this->setId($id);
        $this->setUsername($username);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setStatus($status);
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }*/

    public static function insert($username, $mail, $password) {
        $db = Db::getInstance();

        $stmt = $db->prepare("INSERT INTO users (uidUser, emailUser, pwdUser) VALUES (?, ?, ?)");
        $stmt->execute([$username, $mail, $password]);
    }

    public static function getAllUsers() {
        $db = Db::getInstance()->prepare("SELECT * FROM users");
        $db->execute();

        $row = $db->fetchAll();

        return $row;
    }

    public static function getUser($username) {
        $users = [];
        $db = Db::getInstance()->prepare("SELECT uidUser FROM users WHERE uidUser=?");
        $db->execute([$username]);

        $row = $db->fetchAll();

        foreach ($row as $r) {
            return $r['uidUser'];
            break;
        }

        /*foreach ($row = $db->fetch() as $user) {
            $users[] = new User("sa", "sasa", $user->email, $user->password, $user->status);
        }

        return $users;*/
    }

    public static function getPassword($username) {
        $db = Db::getInstance()->prepare("SELECT pwdUser FROM users WHERE uidUser=?");
        $db->execute([$username]);

        $row = $db->fetchAll();

        foreach ($row as $r) {
            return $r['pwdUser'];
            break;
        }
    }

    public static function updateUser($username, $password) {
        $db = Db::getInstance()->prepare('UPDATE users SET pwdUser=? WHERE uidUser=?');
        $db->execute([$password, $username]);
    }

    public static function getStatus($username) {
        $db = Db::getInstance()->prepare("SELECT userStatus FROM users WHERE uidUser=?");
        $db->execute([$username]);

        return $row = $db->fetch();
    }

    public static function changeStatus($status, $username) {
        $db = Db::getInstance()->prepare('UPDATE users SET userStatus=? WHERE uidUser=?');
        $db->execute([$status, $username]);
    }

}