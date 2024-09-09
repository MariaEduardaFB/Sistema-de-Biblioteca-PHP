<?php

namespace Repository;

require_once '../../../db/Database.php';
include_once '../../../Model/Estudante.php';

use Model\Estudante;
use db\Database;

class EstudanteRepository {
  
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function create(Estudante $estudante) {
        $conn = $this->db->getConnection();

        //cria um novo estudante
        $sql = "INSERT INTO estudante (nome) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $nome = $estudante->getNome();
        
        //pega o nome no estudante e coloca no comando
        $stmt->bind_param("s", $nome);

        $stmt->execute();
        $stmt->close();
    }

    public function update(Estudante $estudante) {
        $conn = $this->db->getConnection();

        //atualiza o estudante com o id fornecido
        $sql = "UPDATE estudante SET nome=? WHERE idEstudante=?";
        $stmt = $conn->prepare($sql);

        //pega o nome e o id do estudante e os usa no comando
        $nome = $estudante->getNome();
        $id = $estudante->getIdEstudante();
        $stmt->bind_param("si", $nome, $id);

        $stmt->execute();
        $stmt->close();
    }

    public function delete($id){
        $conn = $this->db->getConnection();

        //remove o estudante da tabela
        $sql = "DELETE FROM estudante WHERE idEstudante=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        $stmt->execute();
        $stmt->close();
    }

    //
    public function findById($id) {
        $conn = $this->db->getConnection();
        //busca um estudante pelo id
        $sql = "SELECT idEstudante, nome FROM estudante WHERE idEstudante=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $nome);

        if ($stmt->fetch()) {
            $stmt->close();
            return new Estudante($id, $nome);
        }

        $stmt->close();
        return null;
    }


    public function findAll() {
        $conn = $this->db->getConnection();

        //busca todos os estudantes da tabela
        $sql = "SELECT idEstudante, nome FROM estudante";
        $result = $conn->query($sql);

        $estudantes = [];

        //pega cada linha do resultado e cria um objeto Estudante com os dados
        while ($row = $result->fetch_assoc()) {
            $estudantes[] = new Estudante($row['idEstudante'], $row['nome']);
        }

        $result->free();
        return $estudantes;
    }
}
?>