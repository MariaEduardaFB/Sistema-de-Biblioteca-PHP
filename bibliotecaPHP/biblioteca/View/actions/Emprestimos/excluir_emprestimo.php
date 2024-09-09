<?php
require_once '../../../Controller/EmprestimoController.php';

use Controller\EmprestimoController;

if (isset($_POST['idEmprestimo'], $_POST['dataDevolucao'])) {
    $controller = new EmprestimoController();
    $idEmprestimo = $_POST['idEmprestimo'];
    $dataDevolucao = $_POST['dataDevolucao'];

    // Excluir o empréstimo
    $sucesso = $controller->excluir($idEmprestimo);

    if ($sucesso) {
        // Redireciona para a listagem com uma mensagem de sucesso
        header("Location: listar_emprestimos.php?mensagem=Empréstimo excluído com sucesso após registrar a devolução.");
    } else {
        // Redireciona com mensagem de erro
        header("Location: listar_emprestimos.php?erro=Falha ao excluir o empréstimo.");
    }
}
?>
