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
    function Insert_multa($year,$precio,$persona){
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
        //hacemos el insert
        $this->db->insert('multas',$data);        
        //verificamos que se inserto
        return ($this->db->affected_rows()!= 1)?false:true;
        /*$seRegistro=false;
        ($this->db->affected_rows()!= 1) ? $seRegistro=false : $seRegistro=true;
        */        
            //buscamos el folio para regresarlo                                            
        /*
          
          $name='';
            foreach ($datos as $key => $item) {
            $name=$item->nombre;
            }
        */
        //$seRegistro=false;
        //($this->db->affected_rows() != 1) ? $seRegistro=false : $seRegistro=true;
        /*if ($seRegistro) {
            $folio= $this->db->insert_id();
            insertamos los articulos 
            $arti1=explode(',',$articulo1);
            if ($arti1[0]!=''&&$arti1[1]!='') {
                $articulo=array(
                'id'=>'null',
                'multa'=>$folio,
                'no_inventario'=>$arti1[3],
                'material'=>$arti1[2],
                'otro'=>$arti1[1],
                'descripcion'=>$arti1[0]
                );
                $this->db->insert('materiales',$articulo);
            }
            $arti2=explode(',',$articulo2);
            if($arti2[0]!=''&&$arti2[1]!=''){
                $articulo2=array(
                    'id'=>'null',
                    'multa'=>$folio,
                    'no_inventario'=>$arti2[3],
                    'material'=>$arti2[2],
                    'otro'=>$arti2[1],
                    'descripcion'=>$arti2[0]
                );
                $this->db->insert('materiales',$articulo2);
            }            
        }*/
    }

    

    public function add_Materiales($folio,$No_inventario,$material,$otro,$descripcion){
        $articulo=array(
            'id'=>'null',
            'multa'=>$folio,
            'no_inventario'=>$No_inventario,
            'material'=>$material,
            'otro'=>$otro,
            'descripcion'=>$descripcion
        );
        $this->db->insert('materiales',$articulo);
    }

    /**
     * regresa el ultimo folio insertado de una multa
    */   
    function get_Folio(){
        return $this->db->insert_id();
    }
}
