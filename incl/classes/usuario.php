<?php
/* "INSERT INTO usuario(nomeCompleto, email, dataNascimento, genero,
  cpf, rg, endereco, cep, telefone, senha, dataCriacao) VALUES(
  :nomeCompleto, :email, :dataNascimento, :genero, :cpf, :rg, :endereco, :cep, :telefone, :senha
)" */
  class Usuario{
    private $nomeCompleto;
    private $email;
    private $dataNascimento;
    private $genero;
    private $cpf;
    private $rg;
    private $endereco;
    private $cep;
    private $telefone;
    private $senha;
    private $dataCriacao;
    private $idUsuario;

    // Construtor
    public function __construct($nomeCompleto, $email, $dataNascimento,
    $genero, $cpf, $rg, $endereco, $cep, $telefone, $senha, $dataCriacao){
      $this->nomeCompleto = $nomeCompleto;
      $this->email = $email;
      $this->dataNascimento = $dataNascimento;
      $this->genero = $genero;
      $this->cpf = $cpf;
      $this->rg = $rg;
      $this->endereco = $endereco;
      $this->cep = $cep;
      $this->telefone = $telefone;
      $this->senha = $senha;
      $this->dataCriacao = $dataCriacao;
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
        $stmt->execute();
    }



  }

 ?>
