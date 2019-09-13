<?php

class ProfileController {
    public function index() {
        Session::start();

        $session = Session::get('username');

        $user = new User();

        $imgName = $user->getPictures();

        $view = new View();
        $view->render('profile', [
            'homeMessage' => $imgName,
            'session' => $session
        ]);
    }

    public function uploadImage() {
        Session::start();

        if(isset($_POST['uploadImage'])) {
            $file = $_FILES['file'];

            $_fileName = $_FILES['file']['name'];
            $_fileError = $_FILES['file']['error'];
            $_fileTmpName = $_FILES['file']['tmp_name'];
            $fileType = $_FILES['file']['type'];

            $fileExt = explode('.', $_fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png');

            if(in_array($fileActualExt, $allowed)) {
                if($_fileError > 0) {
                    echo 'There was an error uploading your file!';
                }
                else {
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = '/var/www/praksa.com/pub/img/'.$fileNameNew;

                    move_uploaded_file($_fileTmpName, $fileDestination);

                    $username = Session::get('username');

                    $user = new User();
                    $user->insertPicture($username, $fileNameNew);
                }
            }

            header('Location: /profile');
        }
    }

    public function deleteImg() {
        /*if(isset($_POST['$img[\'imageName\']'])) {
            echo $_POST['$img[\'imageName\']'];
        }*/

        if(isset($_POST['fdf'])) {
            header('Location: /profile');
            echo array_keys($_POST);
        }   //ovo vidjeti
    }
}