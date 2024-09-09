<?php
require_once '../../../Controller/EmprestimoController.php';
require_once '../../../Controller/LivroController.php';
require_once '../../../Controller/EstudanteController.php';
require '../../components/footer.php';
require '../../components/menu.php';

use Controller\EmprestimoController;
use Controller\LivroController;
use Controller\EstudanteController;

$emprestimoController = new EmprestimoController();
$livroController = new LivroController();
$estudanteController = new EstudanteController();

//obtém a lista de livros e estudantes
$livros = $livroController->listarLivros();
$estudantes = $estudanteController->listarEstudantes();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idLivro = $_POST['idLivro'];
    $idEstudante = $_POST['idEstudante'];
    $dataEmprestimo = $_POST['dataEmprestimo'];
    $dataDevolucao = $_POST['dataDevolucao'];

    $livro = $livroController->getLivroById($idLivro);
    $estudante = $estudanteController->getEstudanteById($idEstudante);

    if ($livro && $estudante) {
        if ($emprestimoController->emprestarLivro($livro, $estudante, $dataEmprestimo, $dataDevolucao)) {
            header('Location: listar_emprestimos.php'); //redireciona para a página de listagem
            exit;
        } else {
            //echo "Não foi possível cadastrar o empréstimo. O livro pode já estar emprestado.";
        }
    } else {
        echo "Livro ou estudante não encontrado.";
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

    <title>Cadastrar Empréstimo</title>
</head>
<body>
    <?php HandleMenu() ?>
    <div class="container-cad-emp">
        <h1 class="h1-emp">Cadastrar Empréstimo</h1>
        <a href="../../index.php" class="back-link-emp">Voltar para a página inicial</a>

        <form action="cadastrar_emprestimo.php" method="post" class="form">
            <div class="form-group">
                <label for="idLivro">Livro:</label>
                <select id="idLivro" name="idLivro" required class="input">
                    <option value="">Selecione um livro</option>
                    <?php foreach ($livros as $livro): ?>
                        <option value="<?php echo $livro->getIdLivro(); ?>">
                            <?php echo $livro->getTitulo(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="idEstudante">Estudante:</label>
                <select id="idEstudante" name="idEstudante" required class="input">
                    <option value="">Selecione um estudante</option>
                    <?php foreach ($estudantes as $estudante): ?>
                        <option value="<?php echo $estudante->getIdEstudante(); ?>">
                            <?php echo $estudante->getNome(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="dataEmprestimo">Data de Empréstimo:</label>
                <input type="date" id="dataEmprestimo" name="dataEmprestimo" required class="input">
            </div>

            <div class="form-group">
                <label for="dataDevolucao">Data de Devolução:</label>
                <input type="date" id="dataDevolucao" name="dataDevolucao" class="input">
            </div>

            <div class="form-group">
                <input type="submit" value="Cadastrar Empréstimo" class="button">
            </div>
        </form>
    </div>

    <footer class="main-footer">
        <?php HandleFooter() ?>
    </footer>
</body>
</html>

