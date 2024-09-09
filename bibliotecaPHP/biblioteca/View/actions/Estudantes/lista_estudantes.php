<?php
// Inclui o controlador
require_once '../../../Controller/EstudanteController.php';
require '../../components/footer.php';
require '../../components/menu.php';

use Controller\EstudanteController;

$estudanteController = new EstudanteController();

$estudantes = $estudanteController->listarEstudantes();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Estudantes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.23/dist/tailwind.min.css">
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/main.css">
</head>

<?php HandleMenu() ?>

<body class="bg-gray-100">
    <div class="container-list-est">
        <h1 class="text-2xl font-semibold mb-6">Lista de Estudantes</h1>
        <a href="index.php" class="back-link">Voltar para a página inicial</a>
        <a href="cadastrar_estudante.php" class="back-link">Cadastrar Novo Estudante</a>

        <?php if (!empty($estudantes)) : ?>
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Nome</th>
                        <th class="py-2 px-4 border-b">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- mostra a lista de estudantes -->
                    <?php foreach ($estudantes as $estudante) : ?>
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b"><?php echo $estudante->getIdEstudante(); ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $estudante->getNome(); ?></td>
                            <td class="py-2 px-4 border-b">
                                <a href="editar_estudante.php?id=<?php echo $estudante->getIdEstudante(); ?>" class="btn btn-edit">Editar</a>
                                <a href="excluir_estudante.php?id=<?php echo $estudante->getIdEstudante(); ?>" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir este estudante?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p class="text-gray-600 mt-4">Nenhum estudante cadastrado.</p>
        <?php endif; ?>
        <br>
    </div>
    <footer class="main-footer">
        <?php HandleFooter() ?>
    </footer>
</body>

</html>