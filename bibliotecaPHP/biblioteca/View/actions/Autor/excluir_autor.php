<?php
require_once '../../../Controller/AutorController.php';

use Controller\AutorController;

//verifica se o parâmetro 'id' foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $autorController = new AutorController();
    $autorController->excluirAutor($id);

    //Chama o método excluirAutor para remover o autor com o ID fornecido
    header('Location: lista_autor.php'); //redireciona após a exclusão
    exit();
} else {
    echo "ID do autor não fornecido.";
}
?>
