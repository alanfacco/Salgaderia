<?php
//header('Content-type: text/json');
//header('Content-type: application/json');
//require_once './model/Produto.Class';
//require_once './model/TipoProduto.Class';
//$produto = new Produto();
//
//-----------Inserir no banco de dados-----------
//
//$produto->setValue('nome', 'Palmito');
//$produto->setValue('descricao', 'Pastel de palmito com porções de batatas em tipo purê.');
//$produto->setValue('idTipo', '1');
//$produto->insert($produto);
//
//$produto->valuepk = "4";
//$produto->setValue("nome", "Cigarrete");
//$produto->setValue("descricao", "Pastel enrolado em formato cumprido recheado de presunto e mussarela.");
//$produto->setValue("idTipo", "1");
//$produto->insert($produto);
//
//-----------Excluir do banco de dados-----------
//$produto->valuepk = 5;
//$produto->delete($produto);
//
//-----------Alterar do banco de dados-----------
//$produto->valuepk = 4;
//$produto->setValue("nome", "Cigarrete");
//$produto->setValue("idTipo", "1");
//$produto->update($produto);
//
//-----------Listar do banco de dados-----------
//
//$produto->fieldSet[] = 'nome';
//$produto->fieldSet[] = 'descricao';
//$produto->fieldOrder = 'nome';
//$produto->order = 'ASC';
//$produto->fieldOrder = 'nome';
//$produto->limit = 2;
//$produto->selectField($produto);
//while ($row = $produto->returnDate('assoc')) {
//    print_r($row);
//}
//
//-----------Executar comando SQL-----------
//$sql = "SELECT produto.id, produto.nome, produto.descricao, tipoproduto.nome as tipo FROM salgaderia.produto, salgaderia.tipoproduto
//where produto.idTipo = tipoproduto.id;";
//$produto->execSQL($sql);
//
//while ($r = $produto->returnDate('assoc')) {
//    print_r($r);
//}
?>