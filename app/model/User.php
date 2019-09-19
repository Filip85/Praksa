<?php

class User{
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

    public function insert($username, $mail, $password) {
        $db = Db::getInstance();

        $stmt = $db->prepare("INSERT INTO users (uidUser, emailUser, pwdUser) VALUES (?, ?, ?)");
        $stmt->execute([$username, $mail, $password]);
    }

    public function getAllUsers() {
        $db = Db::getInstance()->prepare("SELECT * FROM users");
        $db->execute();

        $row = $db->fetchAll();

        return $row;
    }

    public function getUser($username) {
        $users = [];
        $db = Db::getInstance()->prepare("SELECT uidUser FROM users WHERE uidUser=?");
        $db->execute([$username]);

        $row = $db->fetchAll();

        foreach ($row as $r) {
            return $r['uidUser'];
            break;
        }

        /*foreach ($row = $db->fetchAll() as $user) {
            $users[] = new User($user->id, $user->username, $user->email, $user->password, $user->status);
        }

        return $users;*/
    }

    public function getPassword($username) {
        $db = Db::getInstance()->prepare("SELECT pwdUser FROM users WHERE uidUser=?");
        $db->execute([$username]);

        $row = $db->fetchAll();

        foreach ($row as $r) {
            return $r['pwdUser'];
            break;
        }
    }

    public function updateUser($username, $password) {
        $db = Db::getInstance()->prepare('UPDATE users SET pwdUser=? WHERE uidUser=?');
        $db->execute([$password, $username]);
    }

    public function insertPicture($username, $imgName) {
        $db = Db::getInstance()->prepare('INSERT INTO images (uidUser, imageName) VALUES (?, ?)');
        $db->execute([$username, $imgName]);
    }

    public function getPicturesInformation() {
        $db = Db::getInstance()->prepare("SELECT uidUser, imageName FROM images");
        $db->execute();

        return $row = $db->fetchAll();

    }

    public function deletePicture($imagename) {
        $db = Db::getInstance()->prepare("DELETE FROM images WHERE imageName=?");
        $db->execute([$imagename]);
    }

    public function getStatus($username) {
        $db = Db::getInstance()->prepare("SELECT userStatus FROM users WHERE uidUser=?");
        $db->execute([$username]);

        return $row = $db->fetch();
    }

    public function changeStatus($status, $username) {
        $db = Db::getInstance()->prepare('UPDATE users SET userStatus=? WHERE uidUser=?');
        $db->execute([$status, $username]);
    }

    public function countAllImages() {
        $db = Db::getInstance()->prepare("SELECT COUNT(imageName) FROM images");
        $db->execute();

        return $row = $db->fetch();
    }
}