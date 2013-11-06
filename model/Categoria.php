<?php

class Categoria{
    
    public $idCategoria;
    public $categoria;
    
    public function __construct() {
        $this->idCategoria = NULL;
        $this->categoria = NULL;
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
