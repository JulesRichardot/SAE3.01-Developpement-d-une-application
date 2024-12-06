<?php

class Model
{
    private $bd;
    private static $instance = null;

    private function __construct()
    {
        $dsn = // pgsql:dbname=;host=
        $username = ''; // Nom de l'utilisateur
        $password = ''; // Mot de passe

        try {
            $this->bd = new PDO($dsn, $username, $password);
            $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->bd->query("SET NAMES 'utf8'");
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Model();
        }
        return self::$instance;
    }
}

?>
