<?php
class Database {
  private $dbhost = DB_HOST;
  private $dbname = DB_NAME;
  private $dbuser = DB_USER;
  private $dbpass = DB_PASSWORD;
  private $dbchar = DB_CHARSET;

  public $pdo;
  public $dsn;
  public $opt;

  public function connect() {
    $this->pdo = null;

    $this->dsn = "mysql:host=" . $this->dbhost . ";dbname=" . $this->dbname . ";charset=" . $this->dbchar;

    $this->opt = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
      PDO::ATTR_EMULATE_PREPARES => false
    ];

    try {
      $this->pdo = new PDO($this->dsn, $this->dbuser, $this->dbpass, $this->opt);
    } catch(\PDOException $e) {
      throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }

    return $this->pdo;
  }
}