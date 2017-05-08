<?php

  class Usuario{
    public $nomeCompleto;
    public $email;
    public $dataNascimento;
    public $genero;
    public $cpf;
    public $rg;
    public $endereco;
    public $cep;
    public $telefone;
    public $senha;
    public $dataCriacao;

    // Construtor
    public static function create($nomeCompleto, $email, $dataNascimento,
    $genero, $cpf, $rg, $endereco, $cep, $telefone, $senha, $dataCriacao){
      $instance = new self();
      $instance->nomeCompleto = $nomeCompleto;
      $instance->email = $email;
      $instance->dataNascimento = $dataNascimento;
      $instance->genero = $genero;
      $instance->cpf = $cpf;
      $instance->rg = $rg;
      $instance->endereco = $endereco;
      $instance->cep = $cep;
      $instance->telefone = $telefone;
      $instance->senha = $senha;
      $instance->dataCriacao = $dataCriacao;
      return $instance;
    }

    // Construtor
    public function __construct(){
      $this->nomeCompleto = "";
      $this->email = "";
      $this->dataNascimento = "";
      $this->genero = "";
      $this->cpf = "";
      $this->rg = "";
      $this->endereco = "";
      $this->cep = "";
      $this->telefone = "";
      $this->senha = "";
      $this->dataCriacao = "";
    }

    // Retorna objeto usuário
    public static function selectByEmail($conn, $email){
      $res = Usuario::getUsuarioByEmail($conn, $email);
      $usuario = new self();
      $usuario->nomeCompleto = $res['nomeCompleto'];
      $usuario->email = $res['email'];
      $usuario->dataNascimento = $res['dataNascimento'];
      $usuario->genero = $res['genero'];
      $usuario->cpf = $res['cpf'];
      $usuario->rg = $res['rg'];
      $usuario->endereco = $res['endereco'];
      $usuario->cep = $res['cep'];
      $usuario->telefone = $res['telefone'];
      $usuario->senha = $res['senha'];
      $usuario->dataCriacao = $res['dataCriacao'];
      return $usuario;
    }

    // Retorna objeto usuário
    public static function selectByCPF($conn, $cpf){
      $res = Usuario::getUsuarioByCPF($conn, $cpf);
      $usuario = new self();
      $usuario->nomeCompleto = $res['nomeCompleto'];
      $usuario->email = $res['email'];
      $usuario->dataNascimento = $res['dataNascimento'];
      $usuario->genero = $res['genero'];
      $usuario->cpf = $res['cpf'];
      $usuario->rg = $res['rg'];
      $usuario->endereco = $res['endereco'];
      $usuario->cep = $res['cep'];
      $usuario->telefone = $res['telefone'];
      $usuario->senha = $res['senha'];
      $usuario->dataCriacao = $res['dataCriacao'];
      return $usuario;
    }

    // Pegar Usuário pelo E-mail
    public static function getUsuarioByEmail($conn, $email){
      $result = $conn->query("SELECT * FROM usuario WHERE email = '$email'");
      if($result)
        return $result->fetch(PDO::FETCH_ASSOC);
      else
      return $result;
    }

    // Pegar Usuário pelo E-mail
    public static function getUsuarioByCPF($conn, $email){
      $result = $conn->query("SELECT * FROM usuario WHERE cpf = '$email'");
      if($result)
        return $result->fetch(PDO::FETCH_ASSOC);
      else
      return $result;
    }

    // Pega os privilégios de um usuário
    public function getPrivilegios($conn){
      $priv = array();
      $res = $conn->query("SELECT nivel FROM perfil WHERE email='$this->email'")->fetchAll(PDO::FETCH_ASSOC);
      foreach ($res as $row) {
        $priv[$row['nivel']] = true;
      }
      return $priv;
    }

    // Pega o os dois primeiros nomes do usuário
    public function getNome(){
      $nome = $this->nomeCompleto;
      $nome = explode(" ", $nome);
      return $nome[0] . ' ' . $nome[1];
    }

    // Insere o Usuário com os dados armazenados no DB
    public function insert($conn){
      // Criando SQL Query
      $query =
        "INSERT INTO usuario(
          nomeCompleto, email, dataNascimento, genero,
          cpf, rg, endereco, cep, telefone, senha, dataCriacao
        )
        VALUES(
          :nomeCompleto, :email, :dataNascimento, :genero, :cpf, :rg,
          :endereco, :cep, :telefone, :senha, :dataCriacao
        )";

        // Preparando Statement
        $stmt = $conn->prepare($query);

        // Atribuindo Parametros
        $stmt->bindParam(':nomeCompleto', $this->nomeCompleto);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':dataNascimento', $this->dataNascimento);
        $stmt->bindParam(':genero', $this->genero);
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->bindParam(':rg', $this->rg);
        $stmt->bindParam(':endereco', $this->endereco);
        $stmt->bindParam(':cep', $this->cep);
        $stmt->bindParam(':telefone', $this->telefone);
        // Criptografando Senha
        $senha = password_hash($this->senha, PASSWORD_BCRYPT);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':dataCriacao', $this->dataCriacao);

        // Executando Statement
        if(!$stmt->execute()){
          print_r($stmt->errorInfo());
        } else {
          $conn->query("INSERT INTO perfil(email, nivel) VALUES('$this->email', 'pesquisador')");
        }
    }

    // Atualiza o Usuário com os dados armazenados
    public function update($conn, $email){
      $query =
        "UPDATE usuario SET nomeCompleto=:nomeCompleto, email=:email,
        dataNascimento=:dataNascimento, genero=:genero, cpf=:cpf, rg=:rg,
        endereco=:endereco, cep=:cep, telefone=:telefone
        WHERE email='$email'";
      $stmt = $conn->prepare($query);

      // Atribuindo Parametros
      $stmt->bindParam(':nomeCompleto', $this->nomeCompleto);
      $stmt->bindParam(':email', $this->email);
      $stmt->bindParam(':dataNascimento', $this->dataNascimento);
      $stmt->bindParam(':genero', $this->genero);
      $stmt->bindParam(':cpf', $this->cpf);
      $stmt->bindParam(':rg', $this->rg);
      $stmt->bindParam(':endereco', $this->endereco);
      $stmt->bindParam(':cep', $this->cep);
      $stmt->bindParam(':telefone', $this->telefone);

      // Executando Statement
      if(!$stmt->execute()){
        print_r($stmt->errorInfo());
      }
    }

    // Muda senha usuário
    public function changePassword($conn){
      $query =
        "UPDATE usuario SET senha=:senha WHERE email='". $this->email."'";
      $stmt = $conn->prepare($query);

      // Criptografando Senha
      $senha = password_hash($this->senha, PASSWORD_BCRYPT);
      $stmt->bindParam(':senha', $senha);

      // Executando Statement
      if(!$stmt->execute()){
        print_r($stmt->errorInfo());
      }
    }

}

 ?>
