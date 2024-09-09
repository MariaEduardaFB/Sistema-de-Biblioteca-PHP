<?php

namespace Controller;

include_once '../../../Model/Autor.php';
include_once '../../../Repository/AutorRepository.php';
require_once '../../../db/Database.php';

use Model\Autor;
use Repository\AutorRepository;
use db\Database;

class AutorController
{
    private $repository;

    public function __construct()
    {
        $this->repository = new AutorRepository();
    }

    public function cadastrarAutor($nome, $nacionalidade)
    {
        $autor = new Autor(null, $nome, $nacionalidade);
        $autor->setNome($nome);
        $autor->setNacionalidade($nacionalidade);
        

        $autorRepository = new AutorRepository();
        $autorRepository->save($autor);
    }


    public function editarAutor($id, $nome, $nacionalidade)
    {
        $autor = new Autor($id, $nome, $nacionalidade);
        return $this->repository->update($autor);
    }

    public function excluirAutor($id)
    {
        $this->repository->delete($id);
    }

    public function listarAutores(): array
    {
        return $this->repository->findAll();
    }

    public function getAutorById($id)
    {
        return $this->repository->findById($id);
    }
}
