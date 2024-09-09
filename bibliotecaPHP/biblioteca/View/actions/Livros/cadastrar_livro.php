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
    $titulo = $_POST['titulo'];
    $ano = $_POST['ano'];
    $idAutor = $_POST['idAutor'];

    $livroController->cadastrarLivro($titulo, $ano, $idAutor);
    header('Location: lista_livros.php');
    exit;
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
    <title>Cadastrar Livro</title>
</head>
<body>
<?php HandleMenu() ?>
    <div class="container">
        <h1>Cadastrar Novo Livro</h1>
        <a href="index.php" class="back-link">Voltar para a página inicial</a>
        <form action="cadastrar_livro.php" method="post" class="form">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required class="input">
            </div>
            <div class="form-group">
                <label for="ano">Ano:</label>
                <input type="number" id="ano" name="ano" required class="input">
            </div>
            <div class="form-group">
                <label for="idAutor">Autor:</label>
                <select id="idAutor" name="idAutor" required class="input">
                    <option value="">Selecione o autor</option>
                    <?php foreach ($autores as $autor): ?>
                        <option value="<?php echo $autor->getIdAutor(); ?>">
                            <?php echo $autor->getNome(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
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

