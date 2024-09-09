<?php
namespace Model;

class Livro {
    private $id;
    private $titulo;
    private $ano;
    private $idAutor;
    private $disponivel; // Novo atributo para disponibilidade

    public function __construct($id, $titulo, $ano, $idAutor, $disponivel = true) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->ano = $ano;
        $this->idAutor = $idAutor;
        $this->disponivel = $disponivel; // Valor padrão é 'true' (disponível)
    }

    // Getters e Setters
    public function getIdLivro() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getAno() {
        return $this->ano;
    }

    public function setAno($ano) {
        $this->ano = $ano;
    }

    public function getIdAutor() {
        return $this->idAutor;
    }

    public function setIdAutor($idAutor) {
        $this->idAutor = $idAutor;
    }

    // Métodos para Disponibilidade
    public function getDisponivel() {
        return $this->disponivel;
    }

    public function setDisponivel($disponivel) {
        $this->disponivel = $disponivel;
    }
}
?>
