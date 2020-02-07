//peticiones para saber el nombre 
function get_data() {
    var matricula = document.getElementById("matricula").value;
    document.getElementById("name").value = '';
    $.ajax({
        url: '../Alumno/get_name',
        data: { matricula },
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            let res = data[0];
            document.getElementById("name").value = res.nombre;
        },
        error: function (err) {
            console.log(err.fail().responseText);
            console.error('error en la petición');
        }
    });
}


/**
 * funcion para saber la diferiencia de dias
 */
function diff_fechas() {
    let fecha_lim_dev = document.getElementById("fecha_lim_dev").value;
    let fecha_dev = document.getElementById("fecha_dev").value;
    //tratramiento de la fecha
    fecha_dev = fecha_dev.split('/');
    let fechaInicio = fecha_dev[2] + '-' + fecha_dev[1] + '-' + fecha_dev[0];

    let fecha1 = moment(fechaInicio);
    let fecha2 = moment(fecha_lim_dev);
    let dias = fecha1.diff(fecha2, 'days');
    if (dias >= 0) {
        document.getElementById("dias_retraso").value = dias;
        //clear inputs
        document.getElementById("monto_numero").value = 0;
        document.getElementById("monto_texto").value = "";
    } else {
        document.getElementById("dias_retraso").value = 'Error';
    }
}

/**
 * Metodo que calcula el precio dependiendo el tipo de persona
*/
function calcularPrecio() {
    let personal = document.getElementById("tipo_personal").value;
    
    
    notificacion('lorem','error');
    notificacion('succes','succes');
    notificacion('advertencia','advertencia');

    if (personal ==='alumno') {
        //llamado a la funcion 
        get_precio(personal);
    } else {
        if (personal === 'profesor') {
            //llamado a la funcion
            get_precio(personal);
        }
    }
}
/**
 * funcion que hace una peticion ajax para saber el precio activo
 * documentacion de libreria
 * //https://codeseven.github.io/toastr/
 */
function get_precio(personal){
    var precio;
    $.ajax({
        url: '../multas/get_precio_multa',
        data: { personal },
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            precio= data[0].precio;  
            let dias = document.getElementById("dias_retraso").value;
            precio=dias*precio;
            //llamado a la funcion de formato de los precios
            let precios = formatoPrecio(precio);
            document.getElementById("monto_numero").value = precios["numero"];
            document.getElementById("monto_texto").value = precios["numeroLetras"];            
        },
        error: function (err) {
            return err;
        }
    });
    return precio;
}

/**
 * funcion para dar formato a los precios ejemplo $12.00 Doce pesos mexicanos
 */
function formatoPrecio(Cantidad) {
    var precios = [];
    const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2
    })
    precios["numero"] = formatter.format(Cantidad);
    let multaLetras = numeroALetras(Cantidad, {
        plural: 'PESOS MEXICANOS',
        singular: 'PESOS MEXICANOS',
        centPlural: 'PESOS',
        centSingular: 'PESOS'
    });
    precios["numeroLetras"] = multaLetras;
    return precios;
}

/*
*convertidor de numeros a letras
*/
var numeroALetras = (function () {
    // Código basado en https://gist.github.com/alfchee/e563340276f89b22042a
    function Unidades(num) {
        switch (num) {
            case 1: return 'UN';
            case 2: return 'DOS';
            case 3: return 'TRES';
            case 4: return 'CUATRO';
            case 5: return 'CINCO';
            case 6: return 'SEIS';
            case 7: return 'SIETE';
            case 8: return 'OCHO';
            case 9: return 'NUEVE';
        }

        return '';
    }//Unidades()

    function Decenas(num) {

        let decena = Math.floor(num / 10);
        let unidad = num - (decena * 10);

        switch (decena) {
            case 1:
                switch (unidad) {
                    case 0: return 'DIEZ';
                    case 1: return 'ONCE';
                    case 2: return 'DOCE';
                    case 3: return 'TRECE';
                    case 4: return 'CATORCE';
                    case 5: return 'QUINCE';
                    default: return 'DIECI' + Unidades(unidad);
                }
            case 2:
                switch (unidad) {
                    case 0: return 'VEINTE';
                    default: return 'VEINTI' + Unidades(unidad);
                }
            case 3: return DecenasY('TREINTA', unidad);
            case 4: return DecenasY('CUARENTA', unidad);
            case 5: return DecenasY('CINCUENTA', unidad);
            case 6: return DecenasY('SESENTA', unidad);
            case 7: return DecenasY('SETENTA', unidad);
            case 8: return DecenasY('OCHENTA', unidad);
            case 9: return DecenasY('NOVENTA', unidad);
            case 0: return Unidades(unidad);
        }
    }//Unidades()

    function DecenasY(strSin, numUnidades) {
        if (numUnidades > 0)
            return strSin + ' Y ' + Unidades(numUnidades)

        return strSin;
    }//DecenasY()

    function Centenas(num) {
        let centenas = Math.floor(num / 100);
        let decenas = num - (centenas * 100);

        switch (centenas) {
            case 1:
                if (decenas > 0)
                    return 'CIENTO ' + Decenas(decenas);
                return 'CIEN';
            case 2: return 'DOSCIENTOS ' + Decenas(decenas);
            case 3: return 'TRESCIENTOS ' + Decenas(decenas);
            case 4: return 'CUATROCIENTOS ' + Decenas(decenas);
            case 5: return 'QUINIENTOS ' + Decenas(decenas);
            case 6: return 'SEISCIENTOS ' + Decenas(decenas);
            case 7: return 'SETECIENTOS ' + Decenas(decenas);
            case 8: return 'OCHOCIENTOS ' + Decenas(decenas);
            case 9: return 'NOVECIENTOS ' + Decenas(decenas);
        }

        return Decenas(decenas);
    }//Centenas()

    function Seccion(num, divisor, strSingular, strPlural) {
        let cientos = Math.floor(num / divisor)
        let resto = num - (cientos * divisor)

        let letras = '';

        if (cientos > 0)
            if (cientos > 1)
                letras = Centenas(cientos) + ' ' + strPlural;
            else
                letras = strSingular;

        if (resto > 0)
            letras += '';

        return letras;
    }//Seccion()

    function Miles(num) {
        let divisor = 1000;
        let cientos = Math.floor(num / divisor)
        let resto = num - (cientos * divisor)

        let strMiles = Seccion(num, divisor, 'UN MIL', 'MIL');
        let strCentenas = Centenas(resto);

        if (strMiles == '')
            return strCentenas;

        return strMiles + ' ' + strCentenas;
    }//Miles()

    function Millones(num) {
        let divisor = 1000000;
        let cientos = Math.floor(num / divisor)
        let resto = num - (cientos * divisor)

        let strMillones = Seccion(num, divisor, 'UN MILLON DE', 'MILLONES DE');
        let strMiles = Miles(resto);

        if (strMillones == '')
            return strMiles;

        return strMillones + ' ' + strMiles;
    }//Millones()

    return function NumeroALetras(num, currency) {
        currency = currency || {};
        let data = {
            numero: num,
            enteros: Math.floor(num),
            centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
            letrasCentavos: '',
            letrasMonedaPlural: currency.plural || 'PESOS CHILENOS',//'PESOS', 'Dólares', 'Bolívares', 'etcs'
            letrasMonedaSingular: currency.singular || 'PESO CHILENO', //'PESO', 'Dólar', 'Bolivar', 'etc'
            letrasMonedaCentavoPlural: currency.centPlural || 'CHIQUI PESOS CHILENOS',
            letrasMonedaCentavoSingular: currency.centSingular || 'CHIQUI PESO CHILENO'
        };

        if (data.centavos > 0) {
            data.letrasCentavos = 'CON ' + (function () {
                if (data.centavos == 1)
                    return Millones(data.centavos) + ' ' + data.letrasMonedaCentavoSingular;
                else
                    return Millones(data.centavos) + ' ' + data.letrasMonedaCentavoPlural;
            })();
        };

        if (data.enteros == 0)
            return 'CERO ' + data.letrasMonedaPlural + ' ' + data.letrasCentavos;
        if (data.enteros == 1)
            return Millones(data.enteros) + ' ' + data.letrasMonedaSingular + ' ' + data.letrasCentavos;
        else
            return Millones(data.enteros) + ' ' + data.letrasMonedaPlural + ' ' + data.letrasCentavos;
    };

})();



/**
 * sirve para mandar los TOAS
 */
function notificacion(msg,err){
    /**
     * configuracion
     */
    toastr.options.progressBar = true;
        toastr.options.timeOut = 3600;
    if(err=="succes"){
        
        toastr.success(msg, 'Correcto')
    }else if (err=="error") {
        //toastr.options.progressBar = true;
        toastr.error(msg, 'Error')
    }else if(err=="advertencia"){
        //toastr.options.progressBar = true;
        toastr.warning(msg,'Advertencia')
    }    
}

function multar(){

    obj=({
        'nombre':'nombre 1',
        'nombre':'nombre 1',
        'nombre':'nombre 1',
        'nombre':'nombre 1',
    })
    $.ajax({
        url: '../multas/GeneraPDF',
        data: {obj },
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            console.log(data);
            alert('succes');
        },
        error: function (err) {
            console.log(err);
        }
    });

}