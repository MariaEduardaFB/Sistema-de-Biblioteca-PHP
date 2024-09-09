<?php
require_once '../../../Controller/EmprestimoController.php';

use Controller\EmprestimoController;

$emprestimoController = new EmprestimoController();

//obtém os dados do formulário
$idEmprestimo = $_POST['idEmprestimo'];
$idLivro = $_POST['idLivro'];
$idEstudante = $_POST['idEstudante'];
$dataEmprestimo = $_POST['dataEmprestimo'];
$dataDevolucao = $_POST['dataDevolucao'] ?? null;

// Atualiza o empréstimo
$atualizado = $emprestimoController->atualizarEmprestimo($idEmprestimo, $idLivro, $idEstudante, $dataEmprestimo, $dataDevolucao);

if ($atualizado) {
    header('Location: listar_emprestimos.php');
    exit;
} else {
    echo 'Erro ao atualizar o empréstimo.';
}
?>
