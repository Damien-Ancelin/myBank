<?php

  namespace Damien\MyBank;

  class User {
    private int $id;
    private string $email;
    private string $password;
    private string $firstname;
    private string $lastname;
    private string $created_at;
    private ?string $updated_at;

    public function __construct()
    {
      $this->password = $this->hash_password($this->password);
    }

    public function addSession (User $data): bool
    {
      if (session_status() === PHP_SESSION_NONE){
        session_start();
      }

      if (!isset($data->id, $data->firstname, $data->lastname)) {
        return false;
      }

      $_SESSION['id'] = $data->id;
      $_SESSION['firstname'] = $data->firstname;
      $_SESSION['lastname'] = $data->lastname;
      return true;
    }

    public static function disconnect(): bool
    {
      if (session_status() === PHP_SESSION_NONE){
        session_start();
      }
      $_SESSION = [];
      session_destroy();
      return true;
    }

    public static function isConnected(): bool
    {
      if (session_status() === PHP_SESSION_NONE){
        session_start();
      }
      return isset($_SESSION['id']) && isset($_SESSION['firstname']) && isset($_SESSION['lastname']);
    }

    public function hash_password(string $password): string
    {
      return password_hash($password, PASSWORD_ARGON2ID);
    }

    public function verify_password(string $password, string $hash): bool
    {
      return password_verify($password, $hash);
    }
  }
  
?>