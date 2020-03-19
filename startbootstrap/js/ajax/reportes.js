function grafica(event) {
    
    event.preventDefault();
    year=document.getElementById('year').value;
    alert(year)
    $.ajax({
        url: 'Reportes/get_data_grafica',
        data: { year },
        type: 'POST',
        dataType: 'json',
        success: function (res) {
            //console.log(res);
            let valores={
                pagados:[0,0,0,0,0,0,0,0,0,0,0,0],
                nopagados:[0,0,0,0,0,0,0,0,0,0,0,0]
            }
            res.no_pagada.forEach(element => {
                valores.nopagados[(element.mes-1)]=parseInt(element.total);
            });
            res.pagada.forEach(item => {
                valores.pagados[(item.mes-1)]=parseInt(item.total);
            });
            //valores.pagados[1]=500;

            console.log(valores)
            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line', // also try bar or other graph types
                // The data for our dataset
                data: {
                    labels: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    // Information about the dataset
                    datasets: [{
                        label: "Pagadas",
                        //backgroundColor: 'lightblue',
                        borderColor: 'royalblue',
                        data: valores.pagados,
                    }, {
                        label: "No pagadas",
                        //backgroundColor: 'red',
                        borderColor: 'red',
                        
                        data: valores.nopagados,
                    }
                    ]
                },
                // Configuration options
                options: {
                    layout: {
                        padding: 10,
                    },
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                        text: 'Gráfica de multas'
                    },
                    scales: {
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Número de multas'
                            }
                        }],
                        xAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Reporte de multas'
                            }
                        }]
                    }
                }
            });
        },
        error: function (err) {
            console.log(err.fail().responseText);
            console.error('error en la petición');
        }
    });



}


