
function busca_multa(evt) {
    evt.preventDefault();
    folio=document.getElementById('folio').value;
    

    $.ajax({
        url: 'multas/existente',
        data: { folio },
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            console.log(data);            
        },
        error: function (err) {
            console.log(err.fail().responseText);
            console.error('error en la petición');
        }
    });
}
  