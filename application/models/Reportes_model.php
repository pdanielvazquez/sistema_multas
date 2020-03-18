<?php

class Reportes_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }
    /*
    * se utiliza para saber el tipo de materiales|libro|revista|cd 
    */
    public function get_datos(){
        $sql="SELECT m.folio,m.fecha_creada,m.fecha_limite as 'fecha_vencido',e.nombre as etiqueta,p.nombre as personal,m.multado as id_multado,l.nombre as nombre_multado,m.total as cobrado 
            from multas m INNER JOIN etiqueta e 
            on m.etiqueta=e.id_etiqueta INNER JOIN personal p 
            on m.tipo_personal=p.id_personal INNER JOIN lista l 
            on m.multado=l.id";
        $resultados = $this->db->query($sql);
        return $resultados->result();
    }

    public function get_reporte($yearInicio,$yearFin,$mesInicio,$mesFin){
        $sql="CALL historial($yearInicio,$yearFin,$mesInicio,$mesFin) ";
        $resultados = $this->db->query($sql);
        return $resultados->result();
    }
}
?>