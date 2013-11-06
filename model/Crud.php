<?php

require_once 'Banco.php';

class Crud extends Banco {

    public $table = NULL;
    public $fields = array();
    public $fieldpk = NULL;
    public $valuepk = NULL;
    public $fieldOrder = NULL;
    public $order = NULL;
    public $limit = NULL;

    public function insert($obj) {
        //INSERT INTO tabela (campo1, campo2, campoN) values (valor1, valor2, valorN);

        $sql = "INSERT INTO " . $obj->table . " (";
        $k = "";
        $v = "";

        $count = 1;

        if (isset($obj->valuepk)) {
            $k .= $obj->fieldpk . ", ";
            $v .= is_numeric($obj->valuepk) ? $obj->valuepk : "'" . $obj->valuepk . "'";
        }

        foreach ($obj->fields as $key => $value) {
            $k .= $key;

            $v .= is_numeric($value) ? $value : "'" . $value . "'";

            if ($count < count($obj->fields)) {
                $k .= ", ";
                $v .= ", ";
            }
            $count++;
        }
        $sql .= $k . ") VALUES (" . $v . ");";

        try {
            $exec = $this->conn->prepare($sql);
            $exec->execute();
            $rs = $exec->rowCount();
            unset($exec);
            $this->conn = NULL;
            return $rs;
        } catch (PDOException $e) {
            return array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode()
            );
        }
    }

    public function update($obj) {
        //UPDATE tabela SET campo1='valor1', campo2='valor2', campoN='valorN' WHERE id='1';
        $sql = "UPDATE " . $obj->table . " SET ";
        $count = 1;
        $aux = array();

        foreach ($obj->fields as $k => $v) {
            if (isset($v))
                $aux[$k] = $v;
        }

        foreach ($aux as $k => $v) {
            $sql .= $k . " = ";
            $sql .= is_numeric($v) ? $v : "'" . $v . "'";

            if ($count < count($aux)) {
                $sql .= ", ";
            }
            $count++;
        }
        $sql .= " WHERE " . $obj->fieldpk . " = ";
        $sql .= is_numeric($obj->valuepk) ? $obj->valuepk . ";" : "'" . $obj->valuepk . "';";

        try {
            $exec = $this->conn->prepare($sql);
            $exec->execute();
            $rs = $exec->rowCount();
            unset($exec);
            $this->conn = NULL;
            return $rs;
        } catch (PDOException $e) {
            return array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode()
            );
        }
    }

    public function delete($obj) {
        //DELETE FROM tabela WHERE campopk = valorpk;
        $sql = "DELETE FROM " . $obj->table . " WHERE " . $obj->fieldpk . " = ";
        $sql .= is_numeric($obj->valuepk) ? $obj->valuepk : "'" . $obj->valuepk . "'";

        try {
            $exec = $this->conn->prepare($sql);
            $exec->execute();
            $rs = $exec->rowCount();
            unset($exec);
            $this->conn = NULL;
            return $rs;
        } catch (PDOException $e) {
           return array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode()
            );
        }
    }

    public function select($obj, $sql = NULL) {

        $count = 1;
        $aux = array();

        if ($sql == null) {
            $selecao = "SELECT *";
            $condicao = " WHERE ";

            foreach ($obj->fields as $k => $v) {
                if (isset($v)) {
                    $aux[$k] = $v;
                }
            }

            if (count($aux) == 0) {
                $condicao = "";
            } else {
                if (isset($obj->valuepk)) {
                    $aux[$obj->fieldpk] = $obj->valuepk;
                }
                foreach ($aux as $k => $v) {
                    $condicao .= $k . " = ";
                    $condicao .= is_numeric($v) ? $v : "'" . $v . "'";
                    if ($count < count($aux)) {
                        $condicao .= "AND ";
                    }
                    $count++;
                }
            }

            $sql = $selecao . " FROM " . $obj->table . $condicao;

            if (isset($obj->order) && isset($obj->fieldOrder)) {
                $sql .= " ORDER BY " . $obj->fieldOrder . " " . $obj->order;
            }
            if (isset($obj->limit)) {
                $sql .= " LIMIT " . $obj->limit;
            }
        }

        try {
            $exec = $this->conn->prepare($sql);
            $exec->execute();
            $rs = $exec->fetchAll(PDO::FETCH_OBJ);
            unset($exec);
            $this->conn = NULL;
            return $rs;
        } catch (PDOException $e) {
            return array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode()
            );
        }
    }
}
?>
