<?php
namespace db;

use mysqli;

class Database {
    private $conn;

    public function __construct() {
        $servername = "127.0.0.1";
        $username = "root";
        $password = ""; 
        $dbname = "bibliotecadb"; 

        // cria a conexão
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica a conexão
        if ($this->conn->connect_error) {
            die("Conexão falhou: " . $this->conn->connect_error);
        } else {
            //echo"Conexão bem-sucedida!" . PHP_EOL; 
        }
    }

    public function getConnection(): mysqli{
        return $this->conn;
    }

    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}

new Database();
?>
