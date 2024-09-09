<?php

define('BASE_URL0', 'http://localhost/bibliotecaPHP/biblioteca/View/index.php');
define('BASE_URL1', 'http://localhost/bibliotecaPHP/biblioteca/View/actions/Livros/lista_livros.php');
define('BASE_URL2', 'http://localhost/bibliotecaPHP/biblioteca/View/actions/Autor/lista_autor.php');
define('BASE_URL3', 'http://localhost/bibliotecaPHP/biblioteca/View/actions/Estudantes/lista_estudantes.php');
define('BASE_URL4', 'http://localhost/bibliotecaPHP/biblioteca/View/actions/Emprestimos/listar_emprestimos.php');
define('IMAGEM_LOGO', '/bibliotecaPHP/biblioteca/View/public/images/book.png');

//os links de página só funcionaram assim :(
function HandleMenu()
{
    $caminhoLogo = IMAGEM_LOGO;
    
    echo '
        <link rel="stylesheet" href="../../biblioteca/View/styles/global.css">
        <header class="main-header">
    <h3 class="header-title">
         <img class="logo" src="' . $caminhoLogo . '" >
        Gerenciamento de Biblioteca</h3>
    <nav>
        <ul class="nav-list">
                    <li><a href="' . BASE_URL0 . '" class="nav-link">Início</a></li>
                    <li><a href="' . BASE_URL1 . '" class="nav-link">Livros</a></li>
                    <li><a href="' . BASE_URL2 . '" class="nav-link">Autores</a></li>
                    <li><a href="' . BASE_URL3 . '" class="nav-link">Estudantes</a></li>
                    <li><a href="' . BASE_URL4 . '" class="nav-link">Empréstimos</a></li>
        </ul>
    </nav>
</header>';
} 
?>
