<?php
require_once '../../../Controller/AutorController.php';
require '../../components/footer.php';
require '../../components/menu.php';

use Controller\AutorController;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $nacionalidade = $_POST['nacionalidade'];

    $autorController = new AutorController();
    $autorController->editarAutor($id, $nome, $nacionalidade);

    header('Location: lista_autor.php'); //redireciona após a edição
    exit();
} else {
    $id = $_GET['id'];

    $autorController = new AutorController();
    $autor = $autorController->getAutorById($id);

    if (!$autor) {
        echo "Autor não encontrado.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Autor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.23/dist/tailwind.min.css">
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/main.css">
</head>
<?php HandleMenu() ?>
<body>
    <div class="container-form">
        <h2 class="text-2xl font-semibold mb-4">Editar Autor</h2>
        <form action="editar_autor.php" method="POST" class="form">
            <input type="hidden" name="id" value="<?php echo $autor->getIdAutor(); ?>">
            
            <label for="nome" class="block mb-2 font-medium">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $autor->getNome(); ?>" required
                class="form-input mb-4">

            <label for="nacionalidade" class="block mb-2 font-medium">Nacionalidade:</label>
            <input type="text" id="nacionalidade" name="nacionalidade" value="<?php echo $autor->getNacionalidade(); ?>"
                required class="form-input mb-4">

            <input type="submit" value="Salvar" class="btn btn-register">
        </form>
    </div>
    <footer class="main-footer">
        <?php HandleFooter() ?>
    </footer>
</body>

</html>

