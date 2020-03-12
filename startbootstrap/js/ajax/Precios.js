
/**
 * 
 * @param {string} idNuevo 
 * @param {string} persnaNueva 
 */
function activa(id) {
    $.ajax({
        url: 'Precios/get_activos',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            console.log(data)
            if (data[0].activos < 2) {
                accion = 'activa';
                $.ajax({
                    url: 'Precios/update_activo',
                    type: 'POST',
                    data: { id, accion },
                    dataType: 'json',
                    success: (res) => {
                        console.log(res);
                        notificacion(res.msg, res.status);
                        setInterval(100, location.reload(true));
                    },
                    error: (err) => {
                        console.log(err)
                    }
                })
            } else {
                notificacion('Error no puedes tener mas de dos precios activos', 'error');
            }

        },
        error: function (err) {
            console.log(err.fail().responseText);
            console.error('error en la petición');
        }
    });
}

function desactiva(id) {
    accion = 'desactiva';
    $.ajax({
        url: 'Precios/update_activo',
        type: 'POST',
        data: { id, accion },
        dataType: 'json',
        success: (res) => {
            notificacion(res.msg, res.status);
            location.reload(true);
            setTimeout('document.location.reload()', 10000);
        },
        error: (err) => {
            console.log(err)
        }
    })
}
function SavePrecio(event) {
    event.preventDefault();
    let year = document.getElementById('year').value;
    let precio = document.getElementById('precio').value;
    let persona = document.getElementById('persona').value;

    if (year.length == 4) {
        if (precio.length >= 1) {
            $.ajax({
                url: 'Precios/Insertprecio',
                type: 'post',
                data: { year, precio, persona },
                dataType: 'json',
                success: (res) => {
                    console.log(res)
                    notificacion(res.msg, res.status);
                    //clear input
                    document.getElementById('year').value='';
                    document.getElementById('precio').value='';
                    document.getElementById('persona').value='';
                    setTimeout('document.location.reload()', 1000);
                },
                error: (err) => {
                    console.error(err);
                }
            })
        } else {
            notificacion('Precio no valido', 'error');
        }

    } else {
        notificacion('Año no valido', 'error');
    }

}