<?php
// Inclui o controlador AutorController
require_once '../../../Controller/AutorController.php';
require '../../components/footer.php';
require '../../components/menu.php';

use Controller\AutorController;

//verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //pega os dados do formulário
    $nome = trim($_POST['nome']);
    $nacionalidade = trim($_POST['nacionalidade']);

    //verifica se os campos foram preenchidos
    if (!empty($nome) && !empty($nacionalidade)) {
        //instancia o AutorController
        $autorController = new AutorController();

        //cadastra o novo autor
        $autorController->cadastrarAutor($nome, $nacionalidade);
 
        echo "<script>alert('Autor cadastrado com sucesso!'); window.location.href = 'lista_autor.php';</script>";
    } else {
       
        echo "<p>Por favor, preencha todos os campos.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.23/dist/tailwind.min.css">
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/main.css">
    <title>Cadastrar Autor</title>
</head>
<body>
    <?php HandleMenu() ?>
    <div class="container-cad-autor">
        <h1>Cadastrar Novo Autor</h1>
        <a href="../../index.php" class="back-link">Voltar para a página inicial</a>
        <form action="cadastrar_autor.php" method="POST" class="form">
            <div class="form-group">
                <label for="nome">Nome do Autor:</label>
                <input type="text" id="nome" name="nome" required class="input">
            </div>
            <div class="form-group">
                <label for="nacionalidade">Nacionalidade:</label>
                <input type="text" id="nacionalidade" name="nacionalidade" required class="input">
            </div>
            <div class="form-group">
                <input type="submit" value="Cadastrar" class="button">
            </div>
        </form>
    </div>
    <footer class="main-footer">
        <?php HandleFooter() ?>
    </footer>
</body>
</html>
