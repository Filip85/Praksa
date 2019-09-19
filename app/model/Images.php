<?php

class Images {
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

    public function countAllImages() {
        $db = Db::getInstance()->prepare("SELECT COUNT(imageName) FROM images");
        $db->execute();

        return $row = $db->fetch();
    }
}