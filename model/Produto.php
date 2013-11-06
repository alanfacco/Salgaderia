<?php

class Produto {

    public $idProduto;
    public $produto;
    public $descricao;
    public $categoria;
    public $final;

    public function __construct() {
        require_once 'Categoria.php';
        
        $this->idProduto = NULL;
        $this->produto = NULL;
        $this->descricao = NULL;
        $this->categoria = new Categoria;
        $this->final = NULL;
    }

    public function __set($name, $value) {
        if (array_key_exists($name, $this)) {
            $this->$name = $value;
        }
    }

    public function __get($name) {
        if (array_key_exists($name, $this)) {
            return $this->$name;
        }
    }

    public function __destruct() {
        foreach ($this as $k => $value) {
            unset($this->$k);
        }
    }

}

?>
