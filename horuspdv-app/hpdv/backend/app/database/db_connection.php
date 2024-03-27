<?php

class DbConnection
{
    private $host = "localhost";
    private $dbname = "pdv";
    private $user = "root";
    private $pass = "";

    public function getConnection()
    {
        try {
            $connect = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                "$this->user",
                "$this->pass"
            );
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connect;
        } catch (PDOException $e) {
            $e = $e->getMessage();
            echo "Erro: $e";
        } catch (Exception $e) {
            $e = $e->getMessage();
            echo "Erro: $e";
        }
    }
}
