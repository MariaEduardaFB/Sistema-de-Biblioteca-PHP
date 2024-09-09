<?php

namespace Controller;

require_once '../../../Model/Emprestimo.php';
require_once '../../../Repository/EmprestimoRepository.php';
require_once '../../../Model/Livro.php';
require_once '../../../Model/Estudante.php';
require_once '../../../Controller/LivroController.php';

use Model\Emprestimo;
use Model\Livro;
use Model\Estudante;
use Repository\EmprestimoRepository;
use Controller\LivroController;

class EmprestimoController
{
    private $emprestimoRepository;

    public function __construct()
    {
        $this->emprestimoRepository = new EmprestimoRepository();
    }

    public function emprestarLivro(Livro $livro, Estudante $estudante, $dataEmprestimo, $dataDevolucao = null) {
        $sucesso = $this->emprestimoRepository->emprestarLivro($livro, $estudante, $dataEmprestimo, $dataDevolucao);
        
        if ($sucesso) {
            echo "<script>alert('Empréstimo realizado com sucesso.');</script>";
        } else {
            echo "<script>alert('O livro já está emprestado e não pode ser emprestado novamente.');</script>";
        }
    }
    

    public function devolverLivro(Livro $livro, Estudante $estudante): bool
    {
        return $this->emprestimoRepository->devolverLivro($livro, $estudante);
    }

    public function listarEmprestimos(): array
    {
        return $this->emprestimoRepository->listarEmprestimos();
    }

    public function excluir($idEmprestimo): bool
{
    $sucesso = $this->emprestimoRepository->excluirEmprestimo($idEmprestimo);

    return $sucesso;
}





    public function getEmprestimoById($idEmprestimo)
    {
        return $this->emprestimoRepository->getById($idEmprestimo);
    }

    public function atualizarEmprestimo($idEmprestimo, $idLivro, $idEstudante, $dataEmprestimo, $dataDevolucao): bool
    {
        $emprestimo = $this->emprestimoRepository->getById($idEmprestimo);
        if ($emprestimo) {
            $livro = new Livro($idLivro, '', 0, 0); // Assumindo que não é necessário setar o título e ano aqui
            $estudante = new Estudante($idEstudante, '');
            $emprestimo->setLivro($livro);
            $emprestimo->setEstudante($estudante);
            $emprestimo->setDataEmprestimo($dataEmprestimo);
            $emprestimo->setDataDevolucao($dataDevolucao);
            $this->emprestimoRepository->update($emprestimo);
            return true;
        }
        return false;
    }
}
