<?php

require_once '../../../../negocio/basedatos/mysql/dto/EventoDTO.php';
require_once '../../../../negocio/basedatos/mysql/Conexion.php';
require_once '../../../../negocio/basedatos/interfaz/IEventoDAO.php';

class EventoDAO extends Conexion implements IEventoDAO {

    function EventoDAO() {
        parent::conexion();
    }

    public function listarEventosNoInscritasPorEquipo(EventoDTO $evento) {
        $id = $this->traerEquipoID($evento->getEquipo());
        $fecha = date("Y-m-d");
        $arreglo = array();
        $sql = "select e1.id_evento,e1.nombre,e1.fecha_inicio,e1.hora_inicio,e1.fecha_fin,e1.hora_fin from evento e1 where e1.fecha_inicio>=? "
                . " and e1.id_evento not in (select e.id_evento "
                . " from evento e,equipo eq, equipo_evento ee where eq.id_equipo=? and e.fecha_inicio>=? and ee.id_equipo=eq.id_equipo and "
                . " ee.id_evento=e.id_evento) order by 3,4";
        $stmt = $this->db_conexion->prepare($sql);
        $stmt->execute(array($fecha, $id, $fecha));
        for ($index = 0; $res = $stmt->fetch(PDO::FETCH_ASSOC); $index++) {
            $arreglo[$index] = $res;
        }
        $stmt->closeCursor();
        $this->db_conexion = null;
        return $arreglo;
    }

    private function traerEquipoID($usuario) {
        $sql = "select id_equipo from equipo where usuario=?";
        $stmt = $this->db_conexion->prepare($sql);
        $stmt->execute(array($usuario));
        $res = $stmt->fetch()[0];
        $stmt->closeCursor();
        return $res;
    }
    public function listarEventosInscritasPorEquipo(EventoDTO $evento) {
        $evento->setEquipo($this->traerEquipoID($evento->getEquipo()));
        $fecha = date("Y-m-d");
        $arreglo = array();
        $sql = "select e.id_evento,e.nombre,e.fecha_inicio,e.hora_inicio,e.fecha_fin,e.hora_fin from evento e,equipo eq, equipo_evento ee where eq.id_equipo=? and e.fecha_fin>=? and "
                . " ee.id_equipo=eq.id_equipo and ee.id_evento=e.id_evento order by 3,4";
        $stmt = $this->db_conexion->prepare($sql);
        $stmt->execute(array($evento->getEquipo(), $fecha));
        for ($index = 0; $res = $stmt->fetch(PDO::FETCH_ASSOC); $index++) {
            $arreglo[$index] = $res;
        }
        $stmt->closeCursor();
        $this->db_conexion = null;
        return $arreglo;
    }

    public function desinscribirseEvento(EventoDTO $evento) {
        $id = $this->traerEquipoID($evento->getEquipo());
        $val = false;
        $sql = "delete  from equipo_evento where id_equipo=? and id_evento=?";
        $stmt = $this->db_conexion->prepare($sql);
        if ($stmt->Execute(array($id, $evento->getId()))) {
            $val = true;
        }
        $stmt->closeCursor();
        $this->db_conexion = null;
        return $val;
    }

    public function inscribirseEvento(EventoDTO $evento) {
        $val = false;
        $sql = "select e1.id_equipo from equipo e1 where e1.usuario=?";
        $stmt = $this->db_conexion->prepare($sql);
        if ($stmt->execute(array($evento->getEquipo()))) {
            $evento->setEquipo($stmt->fetch()[0]);
            $stmt->closeCursor();
            $sql = "insert into equipo_evento values(?,?,1)";
            $stmt = $this->db_conexion->prepare($sql);
            if ($stmt->execute(array($evento->getEquipo(), $evento->getId()))) {
                $val = true;
            }
        }

        $stmt->closeCursor();
        $this->db_conexion = null;
        return $val;
    }

    public function eliminarEvento(EventoDTO $evento) {
        $val = false;
        $sql = "delete  from evento where id_evento=?";
        $stmt = $this->db_conexion->prepare($sql);
        if ($stmt->Execute(array($evento->getId()))) {
            $val = true;
        }
        $stmt->closeCursor();
        $this->db_conexion = null;
        return $val;
    }

    private function buscarUltimoEvento() {
        $sql = "select max(e1.id_evento) from evento e1";
        $stmt = $this->db_conexion->prepare($sql);
        $stmt->execute();
        $var = $stmt->fetch();
        $stmt->closeCursor();
        return $var[0];
    }

    public function registrarEvento(EventoDTO $evento) {
        $val = false;
        $sql = "select e1.id_docente from docente e1 where e1.usuario=?";
        $stmt = $this->db_conexion->prepare($sql);
        if ($stmt->execute(array($evento->getDocente())) && $stmt->rowCount() > 0) {
            $id = $stmt->fetch()[0];
            $stmt->closeCursor();
            $sql = "insert into evento values(0,?,?,?,?,?,?)";
            $stmt = $this->db_conexion->prepare($sql);
            if ($stmt->execute(array($id, $evento->getNombre(), $evento->getFecha_inicio(), $evento->getHora_inicio(), $evento->getFecha_fin(), $evento->getHora_fin())) && $stmt->rowCount() > 0) {
                $stmt->closeCursor();
                $ultimoEvento = $this->buscarUltimoEvento();
                $val = true;
                $array = $evento->getProblemas();
                $sql = "insert into problema_evento values(0,?,?,0,0)";
                $stmt = $this->db_conexion->prepare($sql);
                for ($index = 0; $index < count($array); $index++) {
                    $stmt->execute(array($array[$index], $ultimoEvento));
                }
            }
        }
        $stmt->closeCursor();
        $this->db_conexion = null;
        return $val;
    }

    public function listarEventosDocente(EventoDTO $evento) {
        $fecha = date("Y-m-d");
        $arreglo = array();
        $sql = "select id_docente from docente  where usuario=?";
        $stmt = $this->db_conexion->prepare($sql);
        if ($stmt->execute(array($evento->getDocente())) && $stmt->rowCount() > 0) {
            $id = $stmt->fetch()[0];
            $stmt->closeCursor();
            $sql = "select e1.id_evento,e1.nombre,e1.fecha_inicio,e1.hora_inicio,e1.fecha_fin,e1.hora_fin from evento e1  where e1.fecha_inicio >=? "
                    . " and e1.id_docente=? order by 3,4";
            $stmt = $this->db_conexion->prepare($sql);
            $stmt->execute(array($fecha, $id));
            for ($index = 0; $res = $stmt->fetch(PDO::FETCH_ASSOC); $index++) {
                $arreglo[$index] = $res;
            }
        }
        $stmt->closeCursor();
        $this->db_conexion = null;
        return $arreglo;
    }

    public function CargarProblemasMaraton(EventoDTO $evento) {
        $arreglo = array();
        $sql = "select p1.id_problema from problema_evento p1 where p1.id_evento=?";
        $stmt = $this->db_conexion->prepare($sql);
        $stmt->execute(array($evento->getId()));
        for ($index = 0; $res = $stmt->fetch(PDO::FETCH_ASSOC); $index++) {
            $arreglo[$index] = $res;
        }
        $stmt->closeCursor();
        $this->db_conexion = null;
        return $arreglo;
    }
    
    public function listarProblemasMaraton(EventoDTO $evento){
        $arreglo = array();
        $sql = "select p2.id_problema,p2.id_docente,p2.nombre,p2.tiempo_limite,p2.entrada,p2.salida,p2.enunciado,p2.entradasT,p2.salidasT"
                . " from problema_evento p1 join problema p2 on p1.id_evento=? and p1.id_problema=p2.id_problema";
        $stmt = $this->db_conexion->prepare($sql);
        $stmt->execute(array($evento->getId()));
        for ($index = 0; $res = $stmt->fetch(PDO::FETCH_ASSOC); $index++) {
            $arreglo[$index] = $res;
        }
        $stmt->closeCursor();
        $this->db_conexion = null;
        return $arreglo;
    }
    
}
