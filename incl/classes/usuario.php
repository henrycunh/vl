<?php

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


    // Pegar Usuário pelo ID
    public static function getUsuarioById($conn, $id){
      $result = $conn->query("SELECT * FROM usuario WHERE idUsuario = $id");
      if(!$result)
        return $result;
      else
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    // Pegar Usuário pelo E-mail
    public static function getUsuarioByEmail($conn, $email){
      $result = $conn->query("SELECT * FROM usuario WHERE email = '$email'");
      if($result)
        return $result->fetch(PDO::FETCH_ASSOC);
      else
      return $result;
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




    /**
     * Get the value of Nome Completo
     *
     * @return mixed
     */
    public function getNomeCompleto()
    {
        return $this->nomeCompleto;
    }

    /**
     * Set the value of Nome Completo
     *
     * @param mixed nomeCompleto
     *
     * @return self
     */
    public function setNomeCompleto($nomeCompleto)
    {
        $this->nomeCompleto = $nomeCompleto;

        return $this;
    }

    /**
     * Get the value of Email
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of Email
     *
     * @param mixed email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of Data Nascimento
     *
     * @return mixed
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * Set the value of Data Nascimento
     *
     * @param mixed dataNascimento
     *
     * @return self
     */
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    /**
     * Get the value of Genero
     *
     * @return mixed
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set the value of Genero
     *
     * @param mixed genero
     *
     * @return self
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get the value of Cpf
     *
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set the value of Cpf
     *
     * @param mixed cpf
     *
     * @return self
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Get the value of Rg
     *
     * @return mixed
     */
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * Set the value of Rg
     *
     * @param mixed rg
     *
     * @return self
     */
    public function setRg($rg)
    {
        $this->rg = $rg;

        return $this;
    }

    /**
     * Get the value of Endereco
     *
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set the value of Endereco
     *
     * @param mixed endereco
     *
     * @return self
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get the value of Cep
     *
     * @return mixed
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set the value of Cep
     *
     * @param mixed cep
     *
     * @return self
     */
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get the value of Telefone
     *
     * @return mixed
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set the value of Telefone
     *
     * @param mixed telefone
     *
     * @return self
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get the value of Senha
     *
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of Senha
     *
     * @param mixed senha
     *
     * @return self
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get the value of Data Criacao
     *
     * @return mixed
     */
    public function getDataCriacao()
    {
        return $this->dataCriacao;
    }

    /**
     * Set the value of Data Criacao
     *
     * @param mixed dataCriacao
     *
     * @return self
     */
    public function setDataCriacao($dataCriacao)
    {
        $this->dataCriacao = $dataCriacao;

        return $this;
    }

    /**
     * Get the value of Id Usuario
     *
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set the value of Id Usuario
     *
     * @param mixed idUsuario
     *
     * @return self
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

}

 ?>
