<?php

class User extends Db {
    public function insert($username, $mail, $password)
    {
        $db = Db::getInstance();

        $stmt = $db->prepare("INSERT INTO users (uidUser, emailUser, pwdUser) VALUES (?, ?, ?)");
        $stmt->execute([$username, $mail, $password]);
    }

    public function getUser($username, $password)
    {
        $db = Db::getInstance()->prepare("SELECT uidUser, pwdUser FROM users WHERE uidUser=?");
        $db->execute([$username]);

        $row = $db->fetchAll();

        foreach ($row as $r) {
            return $r['uidUser'];
            break;
        }
    }

    public function updateUser($username, $password) {
        $db = Db::getInstance()->prepare('UPDATE users SET pwdUser=? WHERE uidUser=?     ');
        $db->execute([$username, $password]);
    }

    public function insertPicture($username, $imgName) {
        $db = Db::getInstance()->prepare('INSERT INTO images (uidUser, imageName) VALUES (?, ?)');
        $db->execute([$username, $imgName]);
    }

    public function getPictures() {
        $db = Db::getInstance()->prepare("SELECT imageName, uidUser FROM images");
        $db->execute();

        $row = $db->fetchAll();

        return $row;
    }

    public function deletePicture($username) {
        $db = Db::getInstance()->prepare("DELETE FROM images WHERE uidUser=?");
        $db->execute([$username]);
    }
}