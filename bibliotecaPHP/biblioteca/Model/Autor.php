<?php
namespace Model;

class Autor {
    private $idAutor;
    private $nome;
    private $nacionalidade;

    public function __construct($idAutor, $nome, $nacionalidade) {
        $this->idAutor = $idAutor;
        $this->nome = $nome;
        $this->nacionalidade = $nacionalidade;
    }

    public function getIdAutor() {
        return $this->idAutor;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNacionalidade() {
        return $this->nacionalidade;
    }

    public function setNacionalidade($nacionalidade) {
        $this->nacionalidade = $nacionalidade;
    }
}
?>
