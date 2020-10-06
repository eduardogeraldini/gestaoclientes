<?php

require_once("DB.php");

class Autenticacao extends DB{

    private $nome;
    private $email;
    private $senha;

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }

    public function getSenha(){
        return $this->senha;
    }


    public function autenticar(){

        $DB = new DB();

        $consulta = $DB->conn->prepare("SELECT * FROM tb_usuarios WHERE email = ?");
        $consulta->execute([
            $this->getEmail()
        ]);

        $usuario = $consulta->fetchAll(PDO::FETCH_OBJ);  

        if ($usuario && password_verify($this->getSenha(), $usuario[0]->senha))
        {   

            $_SESSION['usuario'] = $usuario[0]->email;
            header('Location: pages/inicio.php');

            return json_encode([
                'error' => false,
                'message' => 'Autenticado com sucesso!'
            ]);
        } else {
            return json_encode([
                'error' => true,
                'message' => 'Erro ao autenticar-se, verifique suas credências!'
            ]);
        }

    }

    public function registrar(){

        $DB = new DB();

        try {
            $DB->conn->beginTransaction();

            $consulta = $DB->conn->prepare("SELECT * FROM tb_usuarios WHERE email = ?");
            $consulta->execute([
                $this->getEmail()
            ]);

            $usuario = $consulta->fetchAll(PDO::FETCH_OBJ);  

            if ($usuario) {
                return json_encode([
                    'error' => true,
                    'message' => 'E-mail já cadastrado!'
                ]); 
            }

            $hashSenha = password_hash($this->getSenha(), PASSWORD_DEFAULT);

            $gravar = $DB->conn->prepare("INSERT INTO tb_usuarios (nome,email,senha) VALUES(?,?,?)");
            $gravar->execute([
                $this->getNome(),
                $this->getEmail(),
                $hashSenha
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

}

?>