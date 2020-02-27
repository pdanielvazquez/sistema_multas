
function busca_multa(evt) {
    evt.preventDefault();
    document.getElementById('formato').className='d-none';
    folio=document.getElementById('folio').value;
    $.ajax({
        url: 'multas/find_Multa',
        data: { folio },
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            if (data.datos.length!=0) {               
                let datos=data.datos[0];
                document.getElementById('formato').className='animated pulse';
                console.log(datos)
                document.getElementById('fecha_lim_dev').value=datos.fecha_limite;
                diff_fechas();
                document.getElementById('tipo_personal').value=datos.personal;
                calcularPrecio();
                document.getElementById('identificador').value=datos.id_multado;
                document.getElementById('nombre').value=datos.nombre_multado
                document.getElementById('etiqueta').value='Etiqueta '+datos.etiqueta;
                document.getElementById('folioM').value=datos.folio;
                $.ajax({
                    url: 'multas/find_articulo',
                    data: { folio },
                    type: 'POST',
                    dataType: 'json',
                    success: function (data) {                        
                        let articulo='';
                        let id=1;
                        data.articulos.forEach(item => {                            
                            articulo+=FormatoArticulo(id,item.no_inventario,item.nombre,item.otro,item.descripcion);
                            id++;
                        });
                        document.getElementById('lista').innerHTML=articulo;
                        console.log(articulo);
                    },
                    error: function (err) {
                        console.log(err.fail().responseText);
                        console.error('error en la petición');
                    }
                });                                
            }else{
                document.getElementById('formato').className='d-none';
                notificacion('Folio no existe', 'error');
            }           
        },
        error: function (err) {
            console.log(err.fail().responseText);
            console.error('error en la petición');
        }
    });
}

function FormatoArticulo(id,inventario,tipo,otro,descripcion){
    let dato='';
    dato+='<li class="list-group-item  text-center" id="articulo'+id+'"> No inventario: '+inventario+' Tipo: '+tipo;
    if (otro.length>0) {
        dato+=' Otro: '+otro;
    }
    if (descripcion.length>0) {
        dato+=' Descripción: '+otro;
    }
    return dato+='</li>';
}

const obj={
    Tipo_personal: "Alumno",
    dias_arasados: "5",
    etiqueta: "1",
    fecha_creada: "26/02/2020",
    fecha_limite: "21/02/2020",
    folio: 10,
    material1: "No. de inventario: 8823 Tipo de material: OTRO Otro material: formulario descripcion: formulario de calculo",
    material2: "No. de inventario: 7893 Tipo de material: LIBRO",
    monto: "$35.00",
    montoText: "TREINTA Y CINCO PESOS MEXICANOS ",
    multado: "UTP0000021",
    nombre: "NORMA MARIAN  CRUZ GONZALEZ",
    
}
function renuevaMulta(){
    let Tipo_personal=document.getElementById('tipo_personal').value;
    let dias_atrasados=document.getElementById('dias_retraso').value;
    let etiqueta=document.getElementById('etiqueta').value;
    let fecha_creada=document.getElementById('fecha_dev').value;
    let fecha_limite=document.getElementById('fecha_lim_dev').value;
    let folio =document.getElementById('folioM').value;
    let material1=document.getElementById('articulo1').textContent;
    let material2='';
    if(document.getElementById('articulo2')){
        let material2=document.getElementById('articulo2').textContent;
    }
    let monto =document.getElementById('monto_numero').value;
    let montoText=document.getElementById('monto_texto').value;
    let multado=document.getElementById('identificador').value;
    let nombre=document.getElementById('nombre').value;
    let fecha =document.getElementById('fecha_dev').value;
    $.ajax({
        url:"multas/renueva",
        data:{
            Tipo_personal,dias_atrasados,etiqueta,
            fecha_creada,fecha_limite,material1,
            material2,monto,montoText,
            multado,nombre,folio,fecha,
        },
        type:'POST',
        dataType:'json',
        success:(res)=>{
            console.log(res);
            if(res.status=='success'){
                notificacion(res.msg, 'success');
                window.open(res.datos.ruta, '_blank');                           
            }else{
                if (res.status=='error') {
                    notificacion(res.msg, 'error');
                }
            }
        },
        error:(err)=>{
            console.log(err);
        }
    });
}
  