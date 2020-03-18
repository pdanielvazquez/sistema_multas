function viewtable() {
    alert(3)

    yearOne=document.getElementById('yearinicio').value;
    yearTwo=document.getElementById('yearfin').value;

    mesOne=document.getElementById('mesinicio').value;
    mesTwo=document.getElementById('mesfin').value;

    $.ajax({
        url: 'Reportes/get_informe',
        data: { yearOne,yearTwo,mesOne,mesTwo},
        type: 'POST',
        dataType: 'json',
        success: function (res) {                        
           //console.log(res);
            
           body=``;
            res.table.forEach(item => {
               body=`<tr>
                            <th>${item.folio}</th>
                            <th>${item.fecha_creada}</th>
                            <th>${item.monto}</th>
                            <th>${item.nombre}</th>
                            <th>${item.status}</th>                            
                    <tr>`;
                document.getElementById("ejemplo").insertRow().innerHTML = body;
            });
        },
        error: function (err) {
            console.log(err.fail().responseText);
            console.error('error en la petición');
        }
    });    

   
    
}