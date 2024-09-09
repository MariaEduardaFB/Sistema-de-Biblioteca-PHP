<?php
require_once '../../../Controller/EstudanteController.php';

use Controller\EstudanteController;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $estudanteController = new EstudanteController();
    $estudanteController->excluirEstudante($id);

    header('Location: lista_estudantes.php'); //redireciona após a exclusão
    exit();
} else {
    echo "ID de estudante não fornecido.";
}
?>
