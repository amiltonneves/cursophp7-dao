<?php


class Usuario{

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function getIdusuario(){
        return $this->idusuario;
    }

    public function setIdusuario($value){
        $this->idusuario = $value;
    }

    public function getDeslogin(){
        return $this->deslogin;
    }

    public function setDeslogin($value){
        $this->deslogin = $value;
    }

    public function getDessenha(){
        return $this->dessenha;
    }

    public function setDessenha($value){
        $this->dessenha = $value;
    }

    public function getDtcadastro(){
        return $this->dtcadastro;
    }

    public function setDtcadastro($value){
        $this->dtcadastro = $value;
    }

    public function loadById($id){
        $sql = new Sql();
        $results = $sql->select("select * from tb_usuario where idusuario = :ID", array(":ID"=>$id));
        if (count($results) > 0) {
            $row = $results[0];
            $this->setData($results[0]);
        }
    }
    public static function getList(){
        $sql = new Sql();
        return $sql->select("select * from tb_usuario order by deslogin;");

    }

    public static function search($login){
        $sql = new Sql();
        return $sql->select("select * from tb_usuario where deslogin like :SEARCH", array(
            ':SEARCH'=>"%".$login."%"
        ));
    }

    public function login($login, $password){
        $sql = new Sql();
        $results = $sql->select("select * from tb_usuario where deslogin = :LOGIN and dessenha = :PASSWORD", array(
            ":LOGIN"=>$login,
            ":PASSWORD"=>$password
        ));
        if (count($results) > 0) {
            $this->setData($results[0]);
        } else {
            throw new Exception("Usuario ou senha invalidos.");
        }
    }

    public function setData($data){
        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));
    }

    public function insert(){
        $sql = new Sql();
        $results = $sql->select("Call sp_usuarios_insert(:LOGIN, :PASSWORD)",array(
            ":LOGIN"=>$this->getDeslogin(),
            ":PASSWORD"=>$this->getDessenha()
        ));
        if (count($results) > 0) {
            $this->setData($results[0]);
        }
    }
    public function update($login, $password){
        
        $this->setDeslogin($login);
        $this->setDessenha($password);

        $sql = new Sql();
        $results = $sql->select("update tb_usuario set deslogin = :LOGIN, dessenha = :PASSWORD where idusuario = :ID",array(
            ":LOGIN"=>$this->getDeslogin(),
            ":PASSWORD"=>$this->getDessenha(),
            ":ID"=>$this->getIdusuario()
        ));
        if (count($results) > 0) {
            $this->setData($results[0]);
        }
    }
    public function __construct($login="", $password=""){
        $this->setDeslogin($login);
        $this->setDessenha($password);
    }
    public function __toString(){
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }
}


 ?>
