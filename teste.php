<?php

require_once 'model/Categoria.php';
require_once 'model/Subcategoria.php';
require_once 'model/Produto.php';

header('Content-type: application/json; charset=utf-8');
$s = new Subcategoria();
$c = new Categoria();
$p = new Produto();

//$obj->valuepk = 20;
//$obj->fields['categoria'] = 'teste3';
//echo $obj->insert($c);
//echo $obj->update($c);
//echo $obj->delete($c);

$sql = "SELECT s.idSubcategoria, c.categoria FROM salgaderia.subcategoria as s, salgaderia.categoria as c
        WHERE c.idCategoria = s.idCategoria";

echo '"Subcategoria:"';
echo $s->select().PHP_EOL;
echo PHP_EOL;
echo '"Categoria:"';
echo $c->select().PHP_EOL;
echo PHP_EOL;
echo '"Produto:"';
echo $p->select().PHP_EOL;
?>
