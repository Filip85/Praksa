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
    }
}

        /*$stmt = $db->prepare("SELECT uidUser, pwdUser FROM users WHERE uidUser=?");
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':username', $username);
        $stmt->execute([$username]);

        if($stmt->rowCount()) {
            while ($row = $stmt->fetch()) {
                echo $row['uidUser'];
            }*/