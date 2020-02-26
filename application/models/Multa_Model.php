<?php
class Multa_Model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }
    /*
    * funcion que obtiene el precio dependiendo el tipo de personal estudiante o maestro
    */
    public function get_precio($personal){
        $sql="  SELECT precio 
                FROM preciosmulta INNER JOIN personal  
                on id_personal=tipo_personal
                WHERE nombre='$personal' and activo=true";

        $resultados = $this->db->query($sql);
        return $resultados->result();
    }
    /**
     * funcion que regresa listado de todos los precio para la multa
     */
    public function get_litas_precios(){
        $sql="SELECT id,years,activo,precio,nombre
                 FROM preciosmulta INNER JOIN personal 
                 on tipo_personal= id_personal";
        $resultados = $this->db->query($sql);
        return $resultados->result();
    }

    /**
     * funcion que actualiza el estado del precio 
     */
    public function update_stado_precio($id,$tipoPersona){
        //falta buscar el id activo dependiendo del tipo de persona y cambiarlo a false
        $sql ="UPDATE  preciosmulta set activo=true where id =$id";
    }

    /**
     * funcion que inserta un nuevo precio de la multa
    */
    public function Insert_multa($year,$precio,$persona){
        if($persona=='alumno'){
            $persona='1';
        }else{
            $persona='2';
        }
        $data = array(
            'precio'=>$precio,
            'tipo_personal'=>$persona,
            'years'=>$year,
            'id'=>'null',
            'activo'=>'0'
        );
        $this->db->insert('preciosmulta',$data);
        return ($this->db->affected_rows() != 1) ? false : true;                              
    }
    //folio 	fecha_creada 	fecha_limite 	etiqueta 	tipo_personal 	multado 	total 	no_inventario 	tipo_material 	otro_material 	descripcion 
    public function multar($folio,$fecha_creada,$fecha_limite,$etiqueta,$tipo_personal,$multado,$total,$articulo1,$articulo2){        
        if($tipo_personal=='alumno'){
            $tipo_personal='1';
        }else{
            $tipo_personal='2';
        }
        $data = array(
            'folio'=>$folio,
            'fecha_creada'=>$fecha_creada,
            'fecha_limite'=>$fecha_limite,
            'etiqueta'=>$etiqueta,
            'tipo_personal'=>$tipo_personal,
            'multado'=>$multado,
            'total'=>$total,
        );
        
        $this->db->insert('multas',$data);        
        
        return $this->db->insert_id();                                          
    }

    public function renueva_Multa($folio,$fecha,$monto){
        $data=array(
            'id'=>'null',
            'id_multa'=>$folio,
            'total'=>$monto,
            'fecha_creacion'=>$fecha
        );
        $this->db->insert('multas_atrasadas',$data);
        return ($this->db->affected_rows() != 1) ? false : true;                              
    }

    public function addMateriales($folio,$No_inventario,$material,$otro,$descripcion){        
        $material=array(
            'id'=>'null',
            'multa'=>$folio,
            'no_inventario'=>$No_inventario,
            'material'=>$material,
            'otro'=>$otro,
            'descripcion'=>$descripcion
        );

        $this->db->insert('materiales',$material);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function agregaMateriales($folio,$inventario,$etiqueta,$persona,$descripcion){
        if($persona=='alumno'){
            $persona='1';
        }else{
            $persona='2';
        }
        $data = array(
            'id'=>'null',
            'multa'=>$folio,
            'no_inventario'=>$inventario,
            'material'=>$etiqueta,
            'otro'=>$persona,
            'descripcion'=>$descripcion
        );
        $this->db->insert('materiales',$data);
        return ($this->db->affected_rows() != 1) ? false : true;                              
    }    
    public function asigna_Material($var1,$var2,$var3,$var4,$var5){        
        $data = array(
            'id'=>'null',
            'multa'=>$var1,
            'no_inventario'=>$var2,
            'material'=>$var3,
            'otro'=>$var4,
            'descripcion'=>$var5
        );
        $this->db->insert('materiales',$data);
        return ($this->db->affected_rows() != 1) ? false : true;   
    }
    public function get_multa($folio){
        $sql="SELECT m.folio,m.fecha_creada,m.fecha_limite,e.nombre as etiqueta,p.nombre as personal,m.multado as id_multado,l.nombre as nombre_multado
                from multas m INNER JOIN etiqueta e 
                on m.etiqueta=e.id_etiqueta INNER JOIN personal p 
                on m.tipo_personal=p.id_personal INNER JOIN lista l
                on m.multado=l.id           
                WHERE m.folio=$folio
        ";
        $resultados = $this->db->query($sql);
        return $resultados->result();
    }
    public function get_material_multa($folio){
        
        $sql="SELECT m.no_inventario,t.nombre,m.otro,m.descripcion
                FROM materiales m INNER JOIN tipo_material t 
                on m.material=t.id
            WHERE m.multa=$folio
        ";
        $resultados = $this->db->query($sql);
        return $resultados->result();
        
    }
    
}
