<?php

namespace Repository;

require_once '../../../db/Database.php';
include_once '../../../Model/Autor.php';

use Model\Autor;
use db\Database;

class AutorRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function save(Autor $autor)
    {
        $conn = $this->db->getConnection();

        //atribuição de variáveis
        $nome = $autor->getNome();
        $nacionalidade = $autor->getNacionalidade();

        $sql = "INSERT INTO autor (nome, nacionalidade) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }

        $stmt->bind_param("ss", $nome, $nacionalidade);

        if ($stmt->execute()) {
            return true;
        } else {
            echo "<script>alert('Erro na execução da consulta: " . $stmt->error . "');</script>";
            $stmt->close();
            return false;
        }
    }


    public function update(Autor $autor)
    {
        $conn = $this->db->getConnection();

        //atribuição de variáveis
        $nome = $autor->getNome();
        $nacionalidade = $autor->getNacionalidade();
        $idAutor = $autor->getIdAutor();  

        $sql = "UPDATE autor SET nome = ?, nacionalidade = ? WHERE idAutor = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }

        //bind dos parâmetros, utilizando a variável $idAutor
        $stmt->bind_param("ssi", $nome, $nacionalidade, $idAutor);

        //executa a consulta
        $executed = $stmt->execute();

        if ($executed) {
            if ($stmt->affected_rows > 0) {
                $stmt->close();
                return true;
            } else {
                echo "<script>alert('Nenhuma mudança foi feita.');</script>";
                $stmt->close();
                return false;
            }
        } else {
            echo "<script>alert('Erro na execução da consulta: " . $stmt->error . "');</script>";
            $stmt->close();
            return false;
        }
    }



    public function delete($id)
    {
        $conn = $this->db->getConnection();

        //deleta autor na tabela
        $sql = "DELETE FROM autor WHERE idAutor=?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro ao deletar autor: ' . $conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function findById($id)
    {
        $conn = $this->db->getConnection();

        $sql = "SELECT idAutor, nome, nacionalidade FROM autor WHERE idAutor=?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro ao consultar autor: ' . $conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $nome, $nacionalidade);

        if ($stmt->fetch()) {
            $stmt->close();
            return new Autor($id, $nome, $nacionalidade);
        }

        $stmt->close();
        return null;
    }

    public function findAll()
    {
        $conn = $this->db->getConnection();

        $sql = "SELECT idAutor, nome, nacionalidade FROM autor";
        $result = $conn->query($sql);

        if ($result === false) {
            die('Erro ao consultar os autores: ' . $conn->error);
        }

        $autores = [];
        while ($row = $result->fetch_assoc()) {
            $autores[] = new Autor($row['idAutor'], $row['nome'], $row['nacionalidade']);
        }

        $result->free();
        return $autores;
    }

    public function __destruct()
    {
        $this->db->closeConnection(); //fecha a conexão quando o objeto for destruído
    }
}
