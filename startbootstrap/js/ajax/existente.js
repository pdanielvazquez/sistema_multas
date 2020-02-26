
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
                        data.articulos.forEach(item => {                            
                            articulo+=FormatoArticulo(item.no_inventario,item.nombre,item.otro,item.descripcion);
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

function FormatoArticulo(inventario,tipo,otro,descripcion){
    let dato='';
    dato+='<li class="list-group-item  text-center"> No inventario: '+inventario+' Tipo: '+tipo;
    if (otro.length>0) {
        dato+=' Otro: '+otro;
    }
    if (descripcion.length>0) {
        dato+=' Descripción: '+otro;
    }
    return dato+='</li>';
}



function renuevaMulta(){
    let folio =document.getElementById('folioM').value;
    let fecha =document.getElementById('fecha_dev').value;
    let monto =document.getElementById('monto_numero').value;
    $.ajax({
        url:"multas/renueva",
        data:{folio,fecha,monto},
        type:'POST',
        dataType:'json',
        success:(res)=>{
            console.log(res);

            if(res.status=='success'){
                notificacion(res.msg, 'success');
                
            }else{
                if (res.status=='error') {
                    notificacion(res.msg, 'error');
                }
            }
            //success

            
        },
        error:(err)=>{
            console.log(err);
        }
    });
}
  