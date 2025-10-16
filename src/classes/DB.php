<?php

  namespace Damien\MyBank;
  use \PDO;
  use \PDOException;
  use \Exception;
  use \Dotenv;
  use \stdClass;

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
      $this->db_host = $_ENV['POSTGRES_HOST'] ?? "localhost";
      $this->db_port = $_ENV['POSTGRES_PORT'];
      $this->db_name = $_ENV['POSTGRES_DB'];
      $this->db_user = $_ENV['POSTGRES_USER'];
      $this->db_password = $_ENV['POSTGRES_PASSWORD'];
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

    // ? Account methods
    /**
     * Get all accounts for a specific user
     *
     * @param int $user_id
     * @return array|false
     */
    public function getAccounts(int $user_id): array|false
    {
      try {
        $pdo = self::connect();
        $query = $pdo->prepare('SELECT * FROM account WHERE user_id = :id');
        $query->execute([
          ':id' => $user_id
        ]);
        $results = $query->fetchAll();
        return $results;
      } catch (PDOException $e) {
        throw new Exception("Error during query for getAccounts.");
      }
    }

    /**
     * Get a specific user's account by user ID and account ID
     *
     * @param int $user_id
     * @param int $account_id
     * @return array|false
     */
    public function getOneUserAccount(int $user_id, int $account_id): stdClass|false
    {
      try {
        $pdo = self::connect();
        $query = $pdo->prepare('SELECT * FROM account WHERE user_id = :user_id AND id = :account_id');
        $query->execute([
          ':user_id' => $user_id,
          ':account_id' => $account_id
        ]);
        $result = $query->fetch();
        return $result;
      } catch (PDOException $e) {
        throw new Exception("Error during query for getUserAccount.");
      }
    }

    // ? Loan methods
    /**
     * Get all loans for a specific user
     *
     * @param int $user_id
     * @return array|false
     */
    public function getLoans(int $user_id): array|false
    {
      try {
        $pdo = self::connect();
        $query = $pdo->prepare('SELECT * FROM loan_summary WHERE user_id = :id');
        $query->execute([
          ':id' => $user_id
        ]);
        $results = $query->fetchAll();
        return $results;
      } catch (PDOException $e) {
        throw new Exception("Error during query for getLoans.");
      }
    }

    // ? transaction methods
    public function getTransactionToAccountId(int $user_id, int $account_id): array|false
    {
      try{
        $pdo = self::connect();
        $query = $pdo->prepare(
          'SELECT "transaction".*, "counterparty"."IBAN" as "counterparty_iban", "category"."name" as "category_name", "operation_type"."name" as "operation_name"
          FROM transaction 
          LEFT JOIN counterparty ON transaction.counterparty_id = counterparty.id
          JOIN category ON transaction.category_id = category.id
          JOIN operation_type ON transaction.operation_type_id = operation_type.id
          WHERE transaction.user_id = :user_id AND account_id = :account_id'
        );
        $query->execute([
          ':user_id' => $user_id,
          ':account_id' => $account_id,
        ]);
        $results = $query->fetchAll();
        return $results;
      } catch (PDOException $e) {
        throw new Exception("Error during query for getTransactionToAccountId.");
      }
      return [];
    }

    public function getTransactionToLoanId(int $user_id, int $loan_id): array|false
    {
      try{
        $pdo = self::connect();
        $query = $pdo->prepare(
          'SELECT "transaction".*, "operation_type"."name" as "operation_name"
          FROM transaction 
          JOIN operation_type ON transaction.operation_type_id = operation_type.id
          WHERE transaction.user_id = :user_id AND loan_id = :loan_id'
        );
        $query->execute([
          ':user_id' => $user_id,
          ':loan_id' => $loan_id,
        ]);
        $results = $query->fetchAll();
        return $results;
      } catch (PDOException $e) {
        throw new Exception("Error during query for getTransactionToLoanId.");
      }
      return [];
    }
  }

?>