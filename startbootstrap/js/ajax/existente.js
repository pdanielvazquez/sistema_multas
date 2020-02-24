
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
                document.getElementById('formato').className='animated pulse';
            }else{
                document.getElementById('formato').className='d-none';
                notificacion('Folio no existe', 'error');
            }
            console.log(data);            
        },
        error: function (err) {
            console.log(err.fail().responseText);
            console.error('error en la petición');
        }
    });
}
  