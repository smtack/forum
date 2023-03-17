<?php
class Database
{
  private $dbhost = DB_HOST;
  private $dbname = DB_NAME;
  private $dbuser = DB_USER;
  private $dbpass = DB_PASS;
  private $dbchar = DB_CHAR;

  public $pdo;
  public $dsn;
  public $options;

  public function __construct()
  {
    $this->pdo = null;

    $this->dsn = "mysql:host=" . $this->dbhost . ";dbname=" . $this->dbname . ";charset=" . $this->dbchar;

    $this->options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
      PDO::ATTR_EMULATE_PREPARES => false
    ];

    try
    {
      $this->pdo = new PDO($this->dsn, $this->dbuser, $this->dbpass, $this->options);
    }
    catch(\PDOException $e)
    {
      throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }

    return $this->pdo;
  }

  public function exists($table, $row, $field) {
    $sql = "SELECT * FROM $table WHERE $row = ?";

    $stmt = $this->pdo->prepare($sql);

    $stmt->bindParam(1, $field, PDO::PARAM_STR);

    $stmt->execute();

    if($stmt->rowCount() > 0)
    {
      return true;
    }

    return false;
  }
}