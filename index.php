<?php

require_once("config.php");
// $sql = new Sql();
//$usuarios = $sql->select("select * from tb_usuario");
//echo json_encode($usuarios);

//$root = new Usuario();
//$root->loadById(3);
//echo $root;

// carergando lista de $usuarios
//$lista = Usuario::getList();
//echo json_encode($lista);

// carrega uma lista de usuario buscando pelo $login
//$search = Usuario::search("am");
//echo json_encode($search);

//$usuario = new Usuario();
//$usuario->login("root","654321");
//echo $usuario;

$aluno = new Usuario("Adernando","88888");
//$aluno->setDeslogin("aluno2");
//$aluno->setDessenha("565465");
$aluno->insert();

echo $aluno;
 ?>
