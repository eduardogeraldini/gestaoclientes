<?php

require_once("DB.php");

class Cliente extends DB{

    private $id;
    private $nome;
    private $dtNascimento;
    private $cpf;
    private $rg;
    private $ativo;

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setDtNascimento($dtNasmimento){
        $this->dtNasmimento = $dtNasmimento;
    }

    public function getDtNasmimento(){
        return $this->dtNasmimento;
    }

    public function setCpf($cpf){
        $this->cpf = $cpf;
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function setRg($rg){
        $this->rg = $rg;
    }

    public function getRg(){
        return $this->rg;
    }

    public function setAtivo($ativo){
        $this->ativo = $ativo;
    }

    public function getAtivo(){
        return $this->ativo;
    }


    public function listarTodos(){

        $DB = new DB();

        $consulta = $DB->conn->prepare("SELECT * FROM tb_clientes");
        $consulta->execute();

        return json_encode($consulta->fetchAll(PDO::FETCH_OBJ));

    }

    public function listarApenasUmCliente(){

        $DB = new DB();

        $consulta = $DB->conn->prepare("SELECT * FROM tb_clientes WHERE id = ?");
        $consulta->execute([
            $this->getId()
        ]);

        return json_encode($consulta->fetchAll(PDO::FETCH_OBJ));
    }

    public function criar($e){

        $DB = new DB();

        try {
            $DB->conn->beginTransaction();

            $gravar = $DB->conn->prepare("INSERT INTO tb_clientes (nome,dataNascimento,cpf,rg) values(?,?,?,?)");
            $gravar->execute([
                $this->getNome(),
                $this->getDtNasmimento(),
                $this->getCpf(),
                $this->getRg()
            ]);

            $idCliente = $DB->conn->lastInsertId();

            $gravar = $DB->conn->prepare("INSERT INTO tb_enderecos (idCliente, logradouro, numero, complemento, cep, bairro, cidade, estado, pais) VALUES (?,?,?,?,?,?,?,?,?)");
            $gravar->execute([
                $idCliente,
                $e->getLogradouro(),
                $e->getNumero(),
                $e->getComplemento(),
                $e->getCep(),
                $e->getBairro(),
                $e->getCidade(),
                $e->getEstado(),
                $e->getPais()
            ]);

            $DB->conn->commit();

            return json_encode([
                'error' => false,
                'message' => 'Cadastro realizado com sucesso!'
            ]);

        } catch (Exception $e) {
            
            $DB->conn->roolBack();

            return json_encode([
                'error' => true,
                'message' => 'Falha ao cadastrar!'
            ]);
        }

    }

    public function editar(){

        $DB = new DB();

        $gravar = $DB->conn->prepare("UPDATE tb_clientes SET nome = ? , dataNascimento = ?, cpf = ?, rg = ?, ativo = ? WHERE id = ?");
        $gravar->execute([
            $this->getNome(),
            $this->getDtNasmimento(),
            $this->getCpf(),
            $this->getRg(),
            $this->getAtivo(),
            $this->getId()
        ]);

        if($gravar)
        {
            return json_encode([
                'error' => false,
                'message' => 'Atualização realizada com sucesso!'
            ]);
        }
        else
        {
            return json_encode([
                'error' => true,
                'message' => 'Falha ao atualizar!'
            ]);
        }

    }

    public function excluir(){

        $DB = new DB();

        try {
            $DB->conn->beginTransaction();

            $exclusao = $DB->conn->prepare("DELETE FROM tb_enderecos WHERE idCLiente = ?");
            $exclusao->execute([
                $this->getId()
            ]);
            
            $exclusao = $DB->conn->prepare("DELETE FROM tb_clientes WHERE id = ?");
            $exclusao->execute([
                $this->getId()
            ]);

            $DB->conn->commit();

            return json_encode([
                'error' => false,
                'message' => 'Cliente deletado com sucesso!'
            ]);

        } catch (Exception $e) {
            
            $DB->conn->roolBack();

            return json_encode([
                'error' => true,
                'message' => 'Falha ao cadastrar!'
            ]);
        }

    }

    public function gerarAtivos() {

        $DB = new DB();

        $consulta = $DB->conn->prepare("SELECT *
                                          FROM tb_clientes
                                         WHERE ativo = 1");
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_OBJ);

        return json_encode($consulta);

    }

    public function gerarInativos() {

        $DB = new DB();

        $consulta = $DB->conn->prepare("SELECT *
                                          FROM tb_clientes
                                         WHERE ativo = 0");
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_OBJ);

        return json_encode($consulta);

    }

    public function gerarGrafico() {

        $DB = new DB();

        $consulta = $DB->conn->prepare("SELECT COUNT(1) TOTAL, DATE_FORMAT(dtCriacao, '%m/%Y') AS DATA
                                          FROM tb_clientes
                                         WHERE dtCriacao BETWEEN DATE_ADD(now(), INTERVAL -12 MONTH) AND now()
                                         GROUP BY MONTH(dtCriacao)
                                         ORDER BY dtCriacao");
        $consulta->execute();

        return json_encode($consulta->fetchAll(PDO::FETCH_OBJ));

    }

}

?>