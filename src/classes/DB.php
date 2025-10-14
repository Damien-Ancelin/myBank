<?php

  namespace Damien\MyBank;
  use \PDO;
  use \PDOException;
  use \Exception;
  use \Dotenv;

  # env loading
  $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
  $dotenv->safeLoad();

  class DB {
    private $db_host;
    private $db_port;
    private $db_name;
    private $db_user;
    private $db_password;
    private $dsn;

    const OPTIONS = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ];

    public function __construct()
    {
      $this->db_host = $_ENV['DB_HOST'];
      $this->db_port = $_ENV['DB_PORT'];
      $this->db_name = $_ENV['DB_NAME'];
      $this->db_user = $_ENV['DB_USER'];
      $this->db_password = $_ENV['DB_PASS'];
      $this->dsn = "pgsql:host={$this->db_host};port={$this->db_port};dbname={$this->db_name}";
    }

    public function connect()
    {
      try {
        $pdo = new PDO(
          $this->dsn,
          $this->db_user,
          $this->db_password,
          self::OPTIONS
        );
        return $pdo;
      } catch (PDOException $e) {
        throw new Exception("Database connection failed: {$e->getMessage()}");
      }
    }
  }



?>