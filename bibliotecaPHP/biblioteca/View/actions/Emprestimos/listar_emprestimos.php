<?php
require_once '../../../Controller/EmprestimoController.php';
require_once '../../../Controller/LivroController.php';
require_once '../../../Controller/EstudanteController.php';
require '../../components/footer.php';
require '../../components/menu.php';

use Controller\EmprestimoController;
use Controller\LivroController;
use Controller\EstudanteController;

// Instância do controlador de empréstimo
$emprestimoController = new EmprestimoController();

// Obtém a lista de todos os empréstimos
$emprestimos = $emprestimoController->listarEmprestimos();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Empréstimos</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.23/dist/tailwind.min.css">
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/main.css">

    <?php HandleMenu() ?>
</head>

<body>
    <div class="container-list-emp">
        <h1 class="text-2xl font-semibold mb-4">Listagem de Empréstimos</h1>
        <a href="../../index.php" class="back-link">Voltar para a página inicial </a>
        <a href="cadastrar_emprestimo.php" class="back-link">Cadastrar Novo Empréstimo</a>

        <table class="list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Livro</th>
                    <th>Estudante</th>
                    <th>Data de Empréstimo</th>
                    <th>Data de Devolução</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($emprestimos as $emprestimo): ?>
                    <tr>
                        <td><?php echo $emprestimo->getIdEmprestimo(); ?></td>
                        <td><?php echo $emprestimo->getLivro()->getTitulo(); ?></td>
                        <td><?php echo $emprestimo->getEstudante()->getNome(); ?></td>
                        <td><?php echo $emprestimo->getDataEmprestimo(); ?></td>
                        <td><?php echo $emprestimo->getDataDevolucao() ? $emprestimo->getDataDevolucao() : 'Não devolvido'; ?></td>
                        <td>


                            <a href="editar_emprestimo.php?id=<?php echo $emprestimo->getIdEmprestimo(); ?>" class="btn btn-edit">Editar</a>
                            <button class="btn btn-register ml-2" onclick="abrirModal(<?php echo $emprestimo->getIdEmprestimo(); ?>)">Registrar Devolução</button>
                            </>

                        </td>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="fecharModal()">&times;</span>
                <h2 class="text-xl font-semibold mb-4">Registrar Devolução e Excluir Empréstimo</h2>
                <p>Por favor, insira a data de devolução para este empréstimo antes de excluir.</p>
                <form id="excluirForm" method="post" action="excluir_emprestimo.php" class="modal-form">
                    <input type="hidden" id="idEmprestimo" name="idEmprestimo">
                    <label for="dataDevolucao">Data de Devolução:</label>
                    <input type="date" id="dataDevolucao" name="dataDevolucao" required>
                    <br><br>
                    <input type="submit" value="Confirmar Devolução e Excluir">
                </form>
            </div>
        </div>

    </div>

    </div>

    <script>
        // Função para abrir o modal
        function abrirModal(idEmprestimo) {
            document.getElementById('idEmprestimo').value = idEmprestimo;
            document.getElementById('modal').style.display = 'flex';
        }

        // Função para fechar o modal
        function fecharModal() {
            document.getElementById('modal').style.display = 'none';
        }

        // Fechar o modal ao clicar fora dele
        window.onclick = function(event) {
            if (event.target == document.getElementById('modal')) {
                fecharModal();
            }
        }
    </script>
    <footer class="main-footer">
        <?php HandleFooter() ?>
    </footer>
</body>

</html>