<?php

header('Content-type: text/json');
header('Content-type: application/json; charset=utf-8');

if ($_GET['v'] == 'categoria') {
    require_once '../model/Categoria.php';
    $c = new Categoria();
    $sql = "SELECT c.idCategoria , c.categoria
            FROM salgaderia.categoria as c, salgaderia.subcategoria as s
            WHERE c.idCategoria = s.idSubcategoria
            AND c.idCategoria = s.idCategoria
            ORDER BY c.idCategoria;";
    echo json_encode($c->select($c), JSON_UNESCAPED_UNICODE);
}
if ($_GET['v'] == 'subcategoria' AND isset($_GET['id'])) {
    require_once '../model/Subcategoria.php';
    $s = new Subcategoria();
    $sql = "SELECT c.idCategoria , c.categoria
            FROM salgaderia.categoria as c, salgaderia.subcategoria as s
            WHERE s.idCategoria = " . $_GET['id'] . " 
            AND c.idCategoria = s.idSubcategoria;";
    echo json_encode($s->select($s, $sql), JSON_UNESCAPED_UNICODE);
}

if ($_GET['v'] == 'ingrediente') {
    require_once '../model/Ingrediente.php';
    $i = new Ingrediente();
    $sql = "SELECT idProduto as idIngrediente, produto as ingrediente 
            FROM salgaderia.produto
            WHERE idCategoria = 5
            ORDER BY ingrediente;";

    echo json_encode($i->select($i, $sql), JSON_UNESCAPED_UNICODE);
}

if ($_GET['v'] == 'painel') {
    require_once '../model/Ingrediente.php';

    $i = new Ingrediente();
    var_dump($i);
}
?>