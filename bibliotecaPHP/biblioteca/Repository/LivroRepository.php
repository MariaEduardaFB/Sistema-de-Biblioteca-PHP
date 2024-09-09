<?php

namespace Repository;

require_once '../../../db/Database.php';
require_once '../../../Model/Livro.php';
use Model\Livro;
use db\Database;

class LivroRepository {
    private $db;

    
    public function __construct() {
        $this->db = new Database();
    }

   
    public function save(Livro $livro) {
        $conn = $this->db->getConnection();

        //Pegamos as informações do livro
        $titulo= $livro->getTitulo();
        $ano= $livro->getAno();
        $idAutor=$livro->getidAutor();
        $idLivro= $livro->getidLivro();

        // Se o livro já existe ele tem um id, então ele é atualizado
        if ($livro->getIdLivro()) {
            $sql = "UPDATE livro SET titulo=?, ano=?, idAutor=? WHERE idLivro=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("siii", $titulo, $ano, $idAutor, $idLivro);
        } else {
            // Se o livro não tem id, então ele é criado
            $sql = "INSERT INTO livro (titulo, ano, idAutor) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sii", $titulo, $ano, $idAutor);
        }

        $stmt->execute();
        $stmt->close();
    }

    public function delete($id) {
        $conn = $this->db->getConnection();
        
        //verifica se o livro está emprestado antes de deletar
        $sql = "SELECT COUNT(*) FROM emprestimo WHERE idLivro=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        //se o livro está emprestado, não podemos deletar
        if ($count > 0) {
            return false; 
        }

        //se não está emprestado, pode deletar
        $sql = "DELETE FROM livro WHERE idLivro=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        return true;
    }

    public function findById($id) {
        $conn = $this->db->getConnection();
        
        //busca o livro com o id fornecido
        $sql = "SELECT idLivro, titulo, ano, idAutor FROM livro WHERE idLivro=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $titulo, $ano, $idAutor);

        //se encontrar, retorna o livro como um objeto
        if ($stmt->fetch()) {
            $stmt->close();
            return new Livro($id, $titulo, $ano, $idAutor);
        }

        //se não encontrar, retorna null
        $stmt->close();
        return null;
    }

    //
    public function findAll() {
        $conn = $this->db->getConnection();
        
        //comando para pegar todos os livros do banco
        $sql = "SELECT idLivro, titulo, ano, idAutor FROM livro";
        $result = $conn->query($sql);
        $livros = [];

        //cada livro encontrado, cria um objeto Livro e adiciona ao array
        while ($row = $result->fetch_assoc()) {
            $livros[] = new Livro($row['idLivro'], $row['titulo'], $row['ano'], $row['idAutor']);
        }

        //retorna a lista de livros
        $result->free();
        return $livros;
    }

    
    public function __destruct() {
        $this->db->closeConnection();
    }

    //atualiza a disponibilidade de um livro
    public function update(Livro $livro) {
        $sql = "UPDATE Livro SET disponivel = ? WHERE idLivro = ?";
        $stmt = $this->db->getConnection()->prepare($sql);

        //pega a disponibilidade do livro e o id
        $disponivel = $livro->getDisponivel();
        $idLivro = $livro->getIdLivro();
        $stmt->bind_param("ii", $disponivel, $idLivro);
        $stmt->execute();
    }

    public function isEmprestado($idLivro) {
        $conn = $this->db->getConnection();
        
        //verifica quantos empréstimos existem para esse livro
        $sql = "SELECT COUNT(*) FROM emprestimo WHERE idLivro=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idLivro);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        
        $stmt->close();
        return $count > 0;
    }
}

?>
