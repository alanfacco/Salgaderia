<?php

class Banco {

    private $dsn = "mysql:dbname=salgaderia;host=127.0.0.1";
    private $usuario = "salgaderia";
    private $senha = "123456";

    public $conn = NULL;

    public function __construct() {
        try {
            if ($this->conn == NULL) {
                $this->conn = new PDO($this->dsn, $this->usuario, $this->senha);
            }
            return $this->conn;
        } catch (PDOException $e) {
            return array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode()
            );
        }
    }
    public function __destruct() {
        foreach ($this as $k => $value) {
            unset($this->$k);
        }
        $this->conn = NULL;
    }
}
?>
