<?php
require '../../components/footer.php';
require '../../components/menu.php';?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Autores</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/main.css">
</head>
<?php HandleMenu() ?>
<body>

    <main class="container-list-emp">
        <h2 class="text-2xl font-semibold mb-4">Lista de Autores</h2>
        <a href="../../index.php" class="back-link">Voltar para a página inicial</a>
        <a href="cadastrar_autor.php" class="back-link">Cadastrar Autor</a>
        <table class="list mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Nacionalidade</th>
                    <th>Ações</th> 
                </tr>
            </thead>
            <tbody>
                <?php
            
                require_once '../../../Controller/AutorController.php';
                

                use Controller\AutorController;

                $autorController = new AutorController();

                $autores = $autorController->listarAutores();

                //itera sobre a lista e exibe os dados
                foreach ($autores as $autor) {
                    echo "<tr>";
                    echo "<td>{$autor->getIdAutor()}</td>";
                    echo "<td>{$autor->getNome()}</td>";
                    echo "<td>{$autor->getNacionalidade()}</td>";
                    //ações de editar e excluir
                    echo "<td>";
                    echo "<a href='editar_autor.php?id={$autor->getIdAutor()}' class='btn btn-edit'>Editar</a>  ";  //link para a página de edição
                    echo "<a href='excluir_autor.php?id={$autor->getIdAutor()}' class='btn btn-delete' onclick='return confirm(\"Tem certeza que deseja excluir este autor?\");'>Excluir</a>";  //link para exclusão com confirmação
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </main>

    <footer class="main-footer">
        <?php HandleFooter() ?>
    </footer>
</body>

</html>
