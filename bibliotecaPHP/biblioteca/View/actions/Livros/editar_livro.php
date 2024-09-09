<?php
require_once '../../../Controller/LivroController.php';
require_once '../../../Controller/AutorController.php';
require '../../components/footer.php';
require '../../components/menu.php';

use Controller\LivroController;
use Controller\AutorController;

// Instâncias dos controladores
$livroController = new LivroController();
$autorController = new AutorController();

// Obtém a lista de autores
$autores = $autorController->listarAutores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['idLivro'];
    $titulo = $_POST['titulo'];
    $ano = $_POST['ano'];
    $idAutor = $_POST['idAutor'];

    $livroController->editarLivro($id, $titulo, $ano, $idAutor);
    header('Location: lista_livros.php');
    exit;
} else {
    $id = $_GET['idLivro'];

    $livro = $livroController->getLivroById($id);

    if (!$livro) {
        echo "Livro não encontrado.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.23/dist/tailwind.min.css">
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/main.css">
</head>
<?php HandleMenu() ?>
<body>
    <div class="container-form">
        <h1 class="text-2xl font-semibold mb-4">Editar Livro</h1>
        <a href="index.php" class="text-blue-500 hover:underline">Voltar para a página inicial</a>
        <form action="editar_livro.php" method="post" class="form">
            <input type="hidden" name="idLivro" value="<?php echo $livro->getIdLivro(); ?>">
            
            <label for="titulo" class="block mb-2 font-medium">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $livro->getTitulo(); ?>" required
                class="form-input mb-4">

            <label for="ano" class="block mb-2 font-medium">Ano:</label>
            <input type="number" id="ano" name="ano" value="<?php echo $livro->getAno(); ?>" required
                class="form-input mb-4">

            <label for="idAutor" class="block mb-2 font-medium">Autor:</label>
            <select id="idAutor" name="idAutor" required class="form-select mb-4">
                <?php foreach ($autores as $autor): ?>
                    <option value="<?php echo $autor->getIdAutor(); ?>"
                        <?php if ($autor->getIdAutor() == $livro->getIdAutor()) echo 'selected'; ?>>
                        <?php echo $autor->getNome(); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="submit" value="Salvar" class="btn btn-register">
        </form>
    </div>
    <footer class="main-footer">
        <?php HandleFooter() ?>
    </footer>
</body>

</html>

