<?php

require_once '../../../../negocio/basedatos/mysql/dao/ConexionApi.php';
require_once '../../../../negocio/basedatos/mysql/dto/EnvioDTO.php';
require_once '../../../../negocio/basedatos/mysql/Conexion.php';
require_once '../../../../negocio/basedatos/interfaz/IEnvioDAO.php';

class EnvioDAO extends Conexion implements IEnvioDAO {

    private $api;
    private $token = "a8caf15ddaa18d37b7719f16c83d0b3ffcbd49a8";

    public function EnvioDAO() {
        parent::conexion();
        $this->api = new HackApi();
        $this->api->set_client_secret($this->token);
    }
                
    public function enviarEjercicio(EnvioDTO $envio) {
        $val=false;
        $sql="select id_problema_evento from problema_evento where id_problema=? and id_evento=?";
        $stmt = $this->db_conexion->prepare($sql);
        if($stmt->execute(array($envio->getId_problema(),$envio->getId_evento()))&&$stmt->rowCount()>0){
            $id=$stmt->fetch()[0];
             $stmt->closeCursor();
             $sql="insert into envio values(0,?,?,?,?)";
              $stmt = $this->db_conexion->prepare($sql);
              if($stmt->execute(array($id,$envio->getId_evento(),$envio->getId_equipo(),$this->comprobarSolucion($envio)))){
                  $val=true;
              }
        }
         $stmt->closeCursor();
         $this->db_conexion=null;
         return $val;
    }

    private function comprobarSolucion(EnvioDTO $envio) {
        $ch = curl_init();
        $arreglo = $this->IOProblemas($envio->getId_problema());
        $this->api->init("JAVA", curl_escape($ch, $envio->getResultado()), $arreglo["entradasT"]);
        $this->api->run();
        curl_close($ch);
        //falta colocar un metodo que quite los espacios en blanco
        $resultados = $this->api->output_html;
        $resultados=trim($resultados);
        if (str_replace("<br>","",$resultados)==str_replace(" ","",$arreglo["salidasT"])) {
            return 1;
        }else{
            return 0;
        }
    }

    private function IOProblemas($id_problema) {
        $sql = "select p1.entradasT,p1.salidasT from problema p1 where p1.id_problema=?";
        $stmt = $this->db_conexion->prepare($sql);
        $stmt->execute(array($id_problema));
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $res;
    }

}
