function Guardaprecios(){
    let year=get_Valor('year');
    let precio=get_Valor('precio');
    let persona=get_Valor('persona');

    $.ajax({
        url: './../multas/Precios/Insertprecio',
        data: { year,precio,persona },
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            console.log(data);
        },
        error: function (err) {
            console.log(err);
            console.error('error en la petición');
        }
    });
}

/**
 * 
 * @param {string} idNuevo 
 * @param {string} persnaNueva 
 */
function activa(idNuevo,personaNueva){
    alert(idNuevo);
    alert(personaNueva);
   /* const obj=({
        idNuevo,
        personaNueva
    });
    console.log(obj);*/
}


function get_Valor(id){
    var dato = document.getElementById(id).value;
    return dato;
}