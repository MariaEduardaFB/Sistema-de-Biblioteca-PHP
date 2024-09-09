<?php
require_once '../../../Controller/EstudanteController.php';
require '../../components/footer.php';
require '../../components/menu.php';

use Controller\EstudanteController;

//verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //pega o valor do campo 'nome'
    $nome = trim($_POST['nome']);

    //verifica se o campo não está vazio
    if (!empty($nome)) {

        $estudanteController = new EstudanteController();

        $estudanteController->cadastrarEstudante($nome);

        
        echo "<script>alert('Estudante cadastrado com sucesso!'); window.location.href = 'lista_estudantes.php';</script>";
    } else {
        echo "<p>Por favor, preencha o nome do estudante.</p>";
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
    <title>Cadastrar Estudante</title>
</head>
<body>
    <?php HandleMenu() ?>
    <div class="container-cad-est">
        <h2>Cadastrar Estudante</h2>

        <form action="cadastrar_estudante.php" method="POST" class="form">
        <a href="../../index.php" class="back-link">Voltar para a página inicial</a>
            <div class="form-group">
                <label for="nome">Nome do Estudante:</label>
                <input type="text" id="nome" name="nome" required class="input">
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

