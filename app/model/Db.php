<?php


class Db {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $charset;
    protected $pdo;

    public function connect()
    {
        $this->servername = "localhost";
        $this->username = "admin";
        $this->password = "secretpassword";
        $this->dbname = "User";
        $this->charset = "utf8mb4";
        $this->pdo="con";

        try {
            $dsn = "mysql:host=" . $this->servername . ";dbname=" . $this->dbname . ";charset=" . $this->charset;
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (PDOException $e) {
            echo "Connect failed: " . $e->getMessage();
        }
        echo "Konekcija ok";
    }
}
