<?php

namespace Controller;

use Model\Estudante;
use Repository\EstudanteRepository;

require_once '../../../Repository/EstudanteRepository.php';

class EstudanteController
{
    private $repository;

    public function __construct()
    {
        $this->repository = new EstudanteRepository();
    }

    public function cadastrarEstudante($nome)
    {
        $estudante = new Estudante(null, $nome);
        $this->repository->save($estudante);
    }

    public function editarEstudante($id, $nome)
    {
        $estudante = $this->repository->findById($id);
        if ($estudante) {
            $estudante->setNome($nome);
            $this->repository->save($estudante);
        }
    }

    public function excluirEstudante($id)
    {
        $this->repository->delete($id);
    }

    public function listarEstudantes(): array
    {
        return $this->repository->findAll();
    }

    public function getEstudanteById($id)
    {
        return $this->repository->findById($id);
    }
}
