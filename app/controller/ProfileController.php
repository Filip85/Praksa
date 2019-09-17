<?php

class ProfileController {
    public function index() {
        Session::start();

        $session = Session::get('username');

        $user = new User();

        $img = $user->getPicturesInformation();
        $imgObject = new ArrayObject(array());
        $nameObject = new ArrayObject(array());

        foreach ($img as $username) {
            $status = $user->getStatus($username['uidUser']);

            if($status['userStatus'] === 'public' || $username['uidUser'] === $session) {
                $imgObject->append($username['imageName']);
                $nameObject->append($username['uidUser']);
            }

        }

        $view = new View();
        $view->render('profile', [
            'homeMessage' => $nameObject,
            'imageName' => $imgObject,
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
                    $fileDestination = BP. 'pub/img/'.$fileNameNew;

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

        if(isset($_POST['name'])) {
            $user = new User();
            $user->deletePicture($_POST['name']);
            $path = BP. 'pub/img/'.$_POST['name'];
            unlink($path);
        }
        header('Location: /profile');
    }
}