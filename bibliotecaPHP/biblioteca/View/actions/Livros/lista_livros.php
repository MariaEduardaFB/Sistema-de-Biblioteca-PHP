<?php

require_once '../../../Controller/LivroController.php';
require_once '../../../Controller/AutorController.php';
require '../../components/footer.php';
require '../../components/menu.php';

use Controller\LivroController;
use Controller\AutorController;

$livroController = new LivroController();
$autorController = new AutorController();

$livros = $livroController->listarLivros();

$autores = $autorController->listarAutores();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Livros</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/main.css">
</head>
<?php HandleMenu() ?>

<body>
    <div class="container-list-livros">
        <h1 class="text-2xl font-semibold mb-4">Lista de Livros</h1>
        <a href="cadastrar_livro.php" class="back-link">Cadastrar Novo Livro</a>
        <a href="../../index.php" class="back-link">Página Inicial</a>

        <table class="list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Ano</th>
                    <th>Autor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($livros)) : ?>
                    <?php foreach ($livros as $livro) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($livro->getIdLivro()); ?></td>
                            <td><?php echo htmlspecialchars($livro->getTitulo()); ?></td>
                            <td><?php echo htmlspecialchars($livro->getAno()); ?></td>
                            <td>
                                <?php 
                                //busca o nome do autor correspondente
                                $autorId = $livro->getIdAutor();
                                $autorNome = "Desconhecido";
                                foreach ($autores as $autor) {
                                    if ($autor->getIdAutor() == $autorId) {
                                        $autorNome = $autor->getNome();
                                        break;
                                    }
                                }
                                echo htmlspecialchars($autorNome);
                                ?>
                            </td>
                            <td>
                                <a href="editar_livro.php?idLivro=<?php echo htmlspecialchars($livro->getIdLivro()); ?>" class="btn btn-edit">Editar</a>
                                <a href="excluir_livros.php?idLivro=<?php echo htmlspecialchars($livro->getIdLivro()); ?>" class="btn btn-delete" onclick="return confirm('Tem certeza de que deseja excluir este livro?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5">Nenhum livro cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <footer class="main-footer">
        <?php HandleFooter() ?>
    </footer>
</body>

</html>

