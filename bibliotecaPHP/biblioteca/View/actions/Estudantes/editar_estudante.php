<?php
require_once '../../../Controller/EstudanteController.php';
require '../../components/footer.php';
require '../../components/menu.php';

use Controller\EstudanteController;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];

    $estudanteController = new EstudanteController();
    $estudanteController->editarEstudante($id, $nome);

    header('Location: lista_estudantes.php'); //redireciona após a edição
    exit();
} else {
    $id = $_GET['id'];

    $estudanteController = new EstudanteController();
    $estudante = $estudanteController->getEstudanteById($id);

    if (!$estudante) {
        echo "Estudante não encontrado.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estudante</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.23/dist/tailwind.min.css">
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/main.css">
</head>

<?php HandleMenu() ?>
<body>
    <div class="container-form">
        <h1 class="text-2xl font-semibold mb-4">Editar Estudante</h1>
        <a href="lista_estudantes.php" class="text-blue-500 hover:underline">Voltar para a listagem de estudantes</a>

        <form action="editar_estudante.php" method="POST" class="form">
            <input type="hidden" name="id" value="<?php echo $estudante->getIdEstudante(); ?>">

            <label for="nome" class="block mb-2 font-medium">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $estudante->getNome(); ?>" required class="form-input mb-4">

            <input type="submit" value="Salvar" class="btn btn-register">
        </form>
    </div>
    <footer class="main-footer">
        <?php HandleFooter() ?>
    </footer>

    <script src="../../biblioteca/View/public/js/menu.js"></script>
    <script src="../../biblioteca/View/public/js/footer.js"></script>
</body>

</html>
