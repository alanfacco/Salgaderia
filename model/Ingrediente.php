<?php

require_once 'Produto.php';

class Ingrediente extends Produto {

    public $idIngrediente;

    public function __construct() {
        parent::__construct();

        $this->idIngrediente = NULL;
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
        parent::__destruct();
    }

}

?>
