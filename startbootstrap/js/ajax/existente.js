
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
                        console.log(data.articulo[0],'respouesta')
                        let articulo='';
                        data.articulo.map((item)=>{
                            console.log(item)
                        });

                      
                        if (data.articulos.length==2) {
                            articulo+=FormatoArticulo(data.no_inventario[0],data.nombre[0],data.otro[0],data.descripcion[0]);
                            articulo+=FormatoArticulo(data.no_inventario[1],data.nombre[1],data.otro[1],data.descripcion[1]);
                        }
                        if (data.articulos.length==1) {
                            articulo+=FormatoArticulo(data.no_inventario[0],data.nombre[0],data.otro[0],data.descripcion[0]);
                        }
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
  