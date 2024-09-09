<?php 
require './components/footer.php';
require './components/menu.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gerenciamento de Biblioteca</title>
    <link rel="stylesheet" href="../../biblioteca/View/styles/global.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

</head>

<body class="body-layout">

    <header class="main-header">
        <?php HandleMenu() ?>
    </header>

    <main class="content">
        <section class="intro">
            <h2 class="title">Bem-vindo ao Sistema de Gerenciamento de Biblioteca</h2>
            <p class="description">Utilize os atalhos abaixo para gerenciar o sistema:</p>
        </section>

        <section class="atalhos-section">
            <div class="atalhos">
                <a href="../../biblioteca/View/actions/Livros/cadastrar_livro.php" class="atalho-btn">
                    <img src="../../biblioteca/View/public/images/open-book.png">
                    Cadastrar Livro
                </a>
                <a href="../../biblioteca/View/actions/Autor/cadastrar_autor.php" class="atalho-btn">
                <img src="../../biblioteca/View/public/images/writing.png">Cadastrar Autor</a>
                <a href="../../biblioteca/View/actions/Estudantes/cadastrar_estudante.php" class="atalho-btn">
                <img src="../../biblioteca/View/public/images/graduation.png">Cadastrar Estudante</a>
                <a href="../../biblioteca/View/actions/Emprestimos/cadastrar_emprestimo.php" class="atalho-btn">
                <img src="../../biblioteca/View/public/images/education.png">Realizar Empréstimo</a>
                <a href="../../biblioteca/View/actions/Emprestimos/listar_emprestimos.php" class="atalho-btn">
                <img src="../../biblioteca/View/public/images/return.png">Registrar Devolução de Empréstimo</a>
            </div>
        </section>
    </main>

    <footer class="main-footer">
        <?php HandleFooter() ?>
    </footer>

</body>

</html>
