
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
                        console.log(data.articulos.length,'respouesta')
                        let articulo='';
                        if (data.articulos.length==2) {
                            articulo+=FormatoArticulo(data.no_inventario,data.nombre,data.otro,data.descripcion);
                            articulo+=FormatoArticulo(data.no_inventario,data.nombre,data.otro,data.descripcion);
                        }
                        if (data.articulos.length==2) {
                            articulo+=FormatoArticulo(data.no_inventario,data.nombre,data.otro,data.descripcion);
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
  