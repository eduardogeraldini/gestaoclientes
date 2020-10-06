<?php

require_once("DB.php");

class Endereco extends DB{

    private $id;
    private $logradouro;
    private $numero;
    private $complemento;
    private $cep;
    private $bairro;
    private $cidade;
    private $estado;
    private $pais;
    private $idCliente;

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getLogradouro(){
		return $this->logradouro;
	}

	public function setLogradouro($logradouro){
		$this->logradouro = $logradouro;
	}

	public function getNumero(){
		return $this->numero;
	}

	public function setNumero($numero){
		$this->numero = $numero;
	}

	public function getComplemento(){
		return $this->complemento;
	}

	public function setComplemento($complemento){
		$this->complemento = $complemento;
	}

	public function getCep(){
		return $this->cep;
	}

	public function setCep($cep){
		$this->cep = $cep;
	}

	public function getBairro(){
		return $this->bairro;
	}

	public function setBairro($bairro){
		$this->bairro = $bairro;
	}

	public function getCidade(){
		return $this->cidade;
	}

	public function setCidade($cidade){
		$this->cidade = $cidade;
	}

	public function getEstado(){
		return $this->estado;
	}

	public function setEstado($estado){
		$this->estado = $estado;
	}

	public function getPais(){
		return $this->pais;
	}

	public function setPais($pais){
		$this->pais = $pais;
    }
    
    public function getIdCliente(){
		return $this->idCliente;
	}

	public function setIdCliente($idCliente){
		$this->idCliente = $idCliente;
	}

    public function listarTodos(){

        $DB = new DB();

        $consulta = $DB->conn->prepare("SELECT * FROM tb_enderecos");
        $consulta->execute();

        return json_encode($consulta->fetchAll(PDO::FETCH_OBJ));

    }

    public function listarPorId(){

        $DB = new DB();

        $consulta = $DB->conn->prepare("SELECT * FROM tb_enderecos WHERE id = ?");
        $consulta->execute([
            $this->getId()
        ]);

        return json_encode($consulta->fetchAll(PDO::FETCH_OBJ));

    }


    public function listarEnderecoPorCliente(){

        $DB = new DB();

        $consulta = $DB->conn->prepare("SELECT * FROM tb_enderecos WHERE idCliente = ?");
        $consulta->execute([
            $this->getIdCliente()
        ]);

        return json_encode($consulta->fetchAll(PDO::FETCH_OBJ));
    }

    public function criar(){

        $DB = new DB();

        $gravar = $DB->conn->prepare("INSERT INTO tb_enderecos (idCliente, logradouro, numero, complemento, cep, bairro, cidade, estado, pais) VALUES (?,?,?,?,?,?,?,?,?)");
        $gravar->execute([
            $this->getIdCliente(),
            $this->getLogradouro(),
            $this->getNumero(),
            $this->getComplemento(),
            $this->getCep(),
            $this->getBairro(),
            $this->getCidade(),
            $this->getEstado(),
            $this->getPais()
        ]);

        if($gravar)
        {
            return json_encode([
                'error' => false,
                'message' => 'Cadastro realizado com sucesso!'
            ]);
        }
        else
        {
            return json_encode([
                'error' => true,
                'message' => 'Falha ao cadastrar!'
            ]);
        }

    }

    public function editar(){

        $DB = new DB();

        $gravar = $DB->conn->prepare("UPDATE tb_enderecos 
                                         SET logradouro = ?, 
                                             numero = ?, 
                                             complemento = ?, 
                                             cep = ?,
                                             bairro = ?, 
                                             cidade = ?, 
                                             estado = ?,
                                             pais = ? 
                                       WHERE id = ?");
        $gravar->execute([
            $this->getLogradouro(),
            $this->getNumero(),
            $this->getComplemento(),
            $this->getCep(),
            $this->getBairro(),
            $this->getCidade(),
            $this->getEstado(),
            $this->getPais(),
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

        $exclusao = $DB->conn->prepare("DELETE FROM tb_enderecos WHERE id = ?");
        $exclusao->execute([
            $this->getId()
        ]);

        if($exclusao)
        {
            return json_encode([
                'error' => false,
                'message' => 'Endereço deleteado com sucesso!'
            ]);
        }
        else
        {
            return json_encode([
                'error' => true,
                'message' => 'Falha ao deletar!'
            ]);
        }

    }


}

?>