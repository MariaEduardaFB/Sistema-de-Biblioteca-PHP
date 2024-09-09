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

//obtém o id do empréstimo da URL
$idEmprestimo = isset($_GET['id']) ? intval($_GET['id']) : 0;

//obtém o empréstimo a ser editado
$emprestimo = $emprestimoController->getEmprestimoById($idEmprestimo);

// Se o empréstimo não for encontrado, redireciona para a listagem
if (!$emprestimo) {
    header('Location: listar_emprestimos.php');
    exit;
}

// Obtém a lista de livros e estudantes
$livros = $livroController->listarLivros();
$estudantes = $estudanteController->listarEstudantes();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empréstimo</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.23/dist/tailwind.min.css"> <!-- utilizando as classes do tailwindcss -->
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/main.css">
</head>
<?php HandleMenu() ?>
<body class="bg-gray-100">
<div class="container-form">
        <h1 class="text-2xl font-semibold mb-4">Editar Empréstimo</h1>
        <a href="listar_emprestimos.php" class="back-link">Voltar para a listagem de empréstimos</a>

        <form action="atualizar_emprestimo.php" method="post" class="form">
            <input type="hidden" name="idEmprestimo" value="<?php echo $emprestimo->getIdEmprestimo(); ?>">
            
            <label for="idLivro" class="block mb-2 font-medium">Livro:</label>
            <select id="idLivro" name="idLivro" class="form-select mb-4">
                <?php foreach ($livros as $livro): ?>
                    <option value="<?php echo $livro->getIdLivro(); ?>"
                        <?php echo $livro->getIdLivro() == $emprestimo->getLivro()->getIdLivro() ? 'selected' : ''; ?>>
                        <?php echo $livro->getTitulo(); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="idEstudante" class="block mb-2 font-medium">Estudante:</label>
            <select id="idEstudante" name="idEstudante" class="form-select mb-4">
                <?php foreach ($estudantes as $estudante): ?>
                    <option value="<?php echo $estudante->getIdEstudante(); ?>"
                        <?php echo $estudante->getIdEstudante() == $emprestimo->getEstudante()->getIdEstudante() ? 'selected' : ''; ?>>
                        <?php echo $estudante->getNome(); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="dataEmprestimo" class="block mb-2 font-medium">Data de Empréstimo:</label>
            <input type="date" id="dataEmprestimo" name="dataEmprestimo" value="<?php echo $emprestimo->getDataEmprestimo(); ?>" required class="form-input mb-4">

            <label for="dataDevolucao" class="block mb-2 font-medium">Data de Devolução:</label>
            <input type="date" id="dataDevolucao" name="dataDevolucao" value="<?php echo $emprestimo->getDataDevolucao() ? $emprestimo->getDataDevolucao() : ''; ?>" class="form-input mb-4">

            <input type="submit" value="Salvar" class="btn btn-register">
        </form>
    </div>

   <footer class="main-footer">
        <?php HandleFooter() ?>
    </footer>
</body>
</html>
