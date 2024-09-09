<?php
namespace Model;

class Emprestimo {
    private $idEmprestimo;
    private $livro;
    private $estudante;
    private $dataEmprestimo;
    private $dataDevolucao;
    

    public function __construct($idEmprestimo, Livro $livro, Estudante $estudante, $dataEmprestimo, $dataDevolucao = null ) {
        $this->idEmprestimo = $idEmprestimo;
        $this->livro = $livro;
        $this->estudante = $estudante;
        $this->dataEmprestimo = $dataEmprestimo;
        $this->dataDevolucao = $dataDevolucao;
        
    }

    public function getIdEmprestimo() {
        return $this->idEmprestimo;
    }

    public function getLivro() {
        return $this->livro;
    }

    public function setLivro(Livro $livro) {
        $this->livro = $livro;
    }

    public function getEstudante() {
        return $this->estudante;
    }

    public function setEstudante(Estudante $estudante) {
        $this->estudante = $estudante;
    }

    public function getDataEmprestimo() {
        return $this->dataEmprestimo;
    }

    public function setDataEmprestimo($dataEmprestimo) {
        $this->dataEmprestimo = $dataEmprestimo;
    }

    public function getDataDevolucao() {
        return $this->dataDevolucao;
    }

    public function setDataDevolucao($dataDevolucao) {
        $this->dataDevolucao = $dataDevolucao;
    }

   
}
?>
