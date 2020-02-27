
/**
 * 
 * @param {string} idNuevo 
 * @param {string} persnaNueva 
 */
function activa(id){   
    $.ajax({
        url: 'Precios/get_activos',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            if(data[0].activos<2){
                accion='activa';
                $.ajax({
                    url:'Precios/update_activo',
                    type:'POST',
                    data:{id,accion},
                    dataType:'json',
                    success:(res)=>{
                        console.log(res);
                        notificacion(res.msg, res.status);
                        setInterval(300,location.reload(true));
                        
                    },
                    error:(err)=>{
                        console.log(err)
                    }
                }) 
            }else{
                notificacion('Error no puedes tener mas de dos precios activos', 'error');
            }

        },
        error: function (err) {
            console.log(err.fail().responseText);
            console.error('error en la petición');
        }        
    });    
}

function desactiva(id){
    accion='desactiva';
    $.ajax({
        url:'Precios/update_activo',
        type:'POST',
        data:{id,accion},
        dataType:'json',
        success:(res)=>{
            notificacion(res.msg,res.status);
            location.reload(true);
        },
        error:(err)=>{
            console.log(err)
        }
    })
}