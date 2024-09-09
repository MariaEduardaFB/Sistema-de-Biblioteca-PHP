<?php
namespace Repository;

require_once '../../../db/Database.php';

use db\Database;
use Model\Emprestimo;
use Model\Livro;
use Model\Estudante;

class EmprestimoRepository {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function emprestarLivro(Livro $livro, Estudante $estudante, $dataEmprestimo, $dataDevolucao = null): bool {

        $conn = $this->db->getConnection();
    
        //atribuição de variáveis
        $idEstudante = $estudante->getIdEstudante();
        $idLivro = $livro->getIdLivro();
    
        //verificação de empréstimo de livros
        $sql = "SELECT COUNT(*) as total FROM Emprestimo WHERE idLivro = ? AND dataDevolucao IS NULL";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idLivro);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
    
        //retorna false se o livro estiver emprestado
        if ($row['total'] > 0) {
            return false; 
        }
    
        //adiciona o novo empréstimo
        $sql = "INSERT INTO Emprestimo (idLivro, idEstudante, dataEmprestimo, dataDevolucao) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiss", $idLivro, $idEstudante, $dataEmprestimo, $dataDevolucao);
        $stmt->execute();
        $stmt->close();
    
        return true;
    }
    
    

    public function devolverLivro(Livro $livro, Estudante $estudante): bool {
        $conn = $this->db->getConnection();


        //comando para atualizar a data de devolução
        //somente se o livro ainda não tiver sido devolvido, por isso a dataDevolução é null
        $sql = "UPDATE Emprestimo SET dataDevolucao = NOW() WHERE idLivro = ? AND idEstudante = ? AND dataDevolucao IS NULL";
        $stmt = $conn->prepare($sql);
        $idLivro = $livro->getIdLivro();
        $idEstudante = $estudante->getIdEstudante();
        $stmt->bind_param("ii", $idLivro, $idEstudante);
        $stmt->execute();
        $result = $stmt->affected_rows > 0;
        $stmt->close();

        return $result;
    }
    

    public function listarEmprestimos() {

        //comando que busca todos os empréstimos e inclui informações dos livros e estudantes associados
        $sql = "SELECT emprestimo.idEmprestimo, emprestimo.dataEmprestimo, emprestimo.dataDevolucao, 
                       livro.idLivro as livroId, livro.titulo as livroTitulo, 
                       estudante.idEstudante as estudanteId, estudante.nome as estudanteNome
                FROM emprestimo
                JOIN livro ON emprestimo.idLivro = livro.idLivro
                JOIN estudante ON emprestimo.idEstudante = estudante.idEstudante";
        
        $conn = $this->db->getConnection();
        $stmt = $conn->query($sql);
        $resultados = $stmt->fetch_all(MYSQLI_ASSOC); 

        //cria um array vazio que vai armazenar os objetos de empréstimo que vão ser construídos
        $emprestimos = [];

        //iteração sobre cada linha do resultado dp comando de busca
        //criação de objetos com os resultados da busca
        foreach ($resultados as $linha) {
            $livro = new Livro($linha['livroId'], $linha['livroTitulo'], null, null);
            $estudante = new Estudante($linha['estudanteId'], $linha['estudanteNome']);
            $emprestimo = new Emprestimo($linha['idEmprestimo'], $livro, $estudante, $linha['dataEmprestimo'], $linha['dataDevolucao']);
            //adiciona o objeto de empréstimo criado no array de empréstimos
            $emprestimos[] = $emprestimo;
        }

        return $emprestimos;//retorna a lista de objetos
    }

    public function getById($idEmprestimo) {

        //busca um emprestimo especifico com base no idEmprestimo e traz informações dos livros e estudantes que estão associados
        $sql = "SELECT emprestimo.idEmprestimo, emprestimo.dataEmprestimo, emprestimo.dataDevolucao, 
                       livro.idLivro as livroId, livro.titulo as livroTitulo, 
                       estudante.idEstudante as estudanteId, estudante.nome as estudanteNome
                FROM emprestimo
                JOIN livro ON emprestimo.idLivro = livro.idLivro
                JOIN estudante ON emprestimo.idEstudante = estudante.idEstudante
                WHERE emprestimo.idEmprestimo = ?";
        
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idEmprestimo);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();
        
        //se a busca retornou os resultados cria objetos do livro e do estudante
        if ($resultado) {
            $livro = new Livro($resultado['livroId'], $resultado['livroTitulo'], null, null);
            $estudante = new Estudante($resultado['estudanteId'], $resultado['estudanteNome']);
            return new Emprestimo($resultado['idEmprestimo'], $livro, $estudante, $resultado['dataEmprestimo'], $resultado['dataDevolucao']);
        }

        //se não houver resultados retorna null
        return null;
    }

    public function update(Emprestimo $emprestimo) {

        //atualiza os dados de um emprestimo especifico
        $sql = "UPDATE emprestimo 
                SET idLivro = ?, idEstudante = ?, dataEmprestimo = ?, dataDevolucao = ?
                WHERE idEmprestimo = ?";
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare($sql);

        //pega os valores que vão ser usados na atualização dos dados
        $idLivro = $emprestimo->getLivro()->getIdLivro();
        $idEstudante = $emprestimo->getEstudante()->getIdEstudante();
        $dataEmprestimo = $emprestimo->getDataEmprestimo();
        $dataDevolucao = $emprestimo->getDataDevolucao();
        $idEmprestimo = $emprestimo->getIdEmprestimo();
        $stmt->bind_param("iisss", $idLivro, $idEstudante, $dataEmprestimo, $dataDevolucao, $idEmprestimo);
        $stmt->execute();
        $stmt->close();
    }
    

    // Em EmprestimoRepository.php
    public function excluirEmprestimo($idEmprestimo): bool {
        $conn = $this->db->getConnection();

        //exclui o emprestimo da tabela
        $sql = "DELETE FROM emprestimo WHERE idEmprestimo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idEmprestimo);
        $stmt->execute();

        //verifica se a exclusão afetou alguma linha
        $result = $stmt->affected_rows > 0;
        $stmt->close();

        return $result;
    }



    
    

    
    
}
?>
