<?php
require_once '../../../Controller/LivroController.php';
use Controller\LivroController;

if (isset($_GET['idLivro'])) {
    $idLivro = $_GET['idLivro'];

    $livroController = new LivroController();

    //verificar se o livro está emprestado
    if ($livroController->isLivroEmprestado($idLivro)) {
        echo "<script>alert('Não é possível excluir um livro que está emprestado.'); window.location.href='lista_livros.php';</script>";
    } else {
        //exclui o livro
        $livroController->excluirLivro($idLivro);
        header('Location: lista_livros.php');
        exit;
    }
} else {
    echo "ID do livro não especificado.";
    exit;
}
?>
