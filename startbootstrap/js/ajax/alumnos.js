//peticion para saber el nombre del alumno
function get_nombre_alumno() {
    var matricula = document.getElementById("matricula").value;
    $.ajax({
        url: '../Alumno/get_name',
        data: { matricula },
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            // console.log(data);
            //let res = data[0];
            document.getElementById("name_alumno").value = data.nombre;
        },
        error: function (err) {
            console.log(err.fail().responseText);
            console.error('error en la petición');
        }
    });
}

//peticion para saber el nombre del maestro
function get_nombre_maestro() {
    var id = document.getElementById("id_maestro").value;
    $.ajax({
        url: '../Maestro/get_name',
        data: { id },
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            // console.log(data);
            document.getElementById("name_maestro").value = data.nombre;
        },
        error: function (err) {
            //console.log(err.fail().responseText);
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
        notificacion('Días de retraso debe de ser mayor o igual 1', 'error');
    }
}

function calcularPrecio() {
    let personal = document.getElementById("tipo_personal").value;
    let dias = document.getElementById("dias_retraso").value;
    if (dias != 'Error') {
        if (personal == 'alumno') {
            document.getElementById('alumno').className = "row animated bounceInRight ";
            document.getElementById('maestro').className = "d-none";
            get_precio(personal);
        } else {
            if (personal == 'profesor') {
                document.getElementById('maestro').className = "row animated bounceInRight ";
                document.getElementById('alumno').className = "d-none";
                get_precio(personal);
            }
        }
    } else {
        notificacion('Días de retraso debe de ser mayor o igual 1', 'error');
    }

}

/**
 * funcion que hace una peticion ajax para saber el precio activo
 * documentacion de libreria
 * 
 */
function get_precio(personal) {
    $.ajax({
        url: '../multas/get_precio_multa',
        data: { personal },
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            //console.log(data);
            precio = data[0].precio;
            let dias = document.getElementById("dias_retraso").value;
            precio = dias * precio;
            //llamado a la funcion de formato de los precios
            let precios = formatoPrecio(precio);
            document.getElementById("monto_numero").value = precios["numero"];
            document.getElementById("monto_texto").value = precios["numeroLetras"];
        },
        error: function (err) {
            return err;
        }
    });
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
function notificacion(msg, err) {
    /**
     * configuracion
     */
    toastr.options.progressBar = true;
    toastr.options.closeMethod = 'slideUp';
    toastr.options.closeDuration = 300;
    toastr.options.closeEasing = 'swing';
    if (err == "success") {
        toastr.success(msg, 'Correcto')
    } else if (err == "error") {
        toastr.error(msg, 'Error')
    } else if (err == "advertencia") {
        toastr.warning(msg, 'Advertencia')
    }
}
/**
 * manda los datos al controlador de multas para generar la multa 
 */
function multar() {
    let dias = document.getElementById("dias_retraso").value;
    //validacion de dias de retraso que sea 1 o mayor
    if (dias != 'Error') {
        //banderas
        let Bpersonal = Bmaterial = Bmonto = Btipo_material = 0;
        let personal = document.getElementById("tipo_personal").value;
        (personal == 'Seleccionar') ? notificacion('Debes seleccionar tipo de personal', 'error') : Bpersonal = 1;
        let material = document.getElementById("etiqueta").value;
        (material == 'Seleccionar') ? notificacion('Debes seleccionar tipo de material', 'error') : Bmaterial = 1;
        let monto = document.getElementById("monto_numero").value;
        (monto == '') ? notificacion('Asigna fecha valida', 'error') : Bmonto = 1;
        let articulo = document.getElementById("articulo1").value;
        if(articulo.length==0){
            notificacion('No has agregado ningun material', 'error')
        }else{
            Bno_inventario =Btipo_material= 1;
        }
        if (Bpersonal && Bmaterial && Bmonto && Btipo_material&&Bno_inventario) {
            notificacion('validacion completa', 'success');
            let fecha_limite = get_Valor('fecha_lim_dev');
            let fecha_devolucion = get_Valor('fecha_dev');
            let diasrestraso = get_Valor('dias_retraso');
            let tipo_persona = get_Valor('tipo_personal');
            let monto = get_Valor('monto_numero');
            let etiqueta = get_Valor('etiqueta');
            let identidicador;
            let nombre;
            if (tipo_persona == 'alumno') {
                identidicador = get_Valor('matricula');
                nombre = get_Valor('name_alumno');
            } else if (tipo_persona == 'profesor') {
                identidicador = get_Valor('id_maestro');
                nombre = get_Valor('name_maestro');
            }
            let material1='null';
            let material2='null';
            if(document.getElementById('articulo1')){
                material1=get_Valor('articulo1');
            }
            if(document.getElementById('articulo2')){
                material2=get_Valor('articulo2');  
            }   
            let montoText=get_Valor('monto_texto');  
            let diasAtrasados=get_Valor('dias_retraso');       
            if (monto != "$0.00") {
                //console.log(montoText);
                $.ajax({
                    url: '../multas/multar',
                    data: {
                        nombre,
                        identidicador,
                        fecha_limite,
                        fecha_devolucion,
                        diasrestraso,
                        tipo_persona,
                        monto,
                        montoText,
                        diasAtrasados,
                        etiqueta,
                        material1,
                        material2
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function (data) {
                        //console.log(data);
                        //window.location=data.datos.ruta;      
                        window.open(data.datos.ruta, '_blank');

                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            } else {
                notificacion('Monto a pagar no puede ser de $0.00', 'error')
            }
        }
    } else {
        notificacion('Días de retraso debe de ser mayor o igual 1', 'error');
    }
}

/**
 * sirve para gregar articulos
 */
function addArticulo() {
    let Btipo_material = Bno_inventario = 0;
    let no_inventario = get_Valor('no_inventario');
    (no_inventario == '') ? notificacion('Agrega No. Inventario', 'error') : Bno_inventario = 1;
    let tipo_material = get_Valor('tipo_material');
    (tipo_material == 'Seleccionar') ? notificacion('Debes seleccionar tipo de material', 'error') : Btipo_material = 1;
    if (Btipo_material && Bno_inventario) {
        let otro_tipo_Material = get_Valor('otro_material');
        let descripcion = get_Valor('descripcion_material');
        var Elemento = document.getElementById("lista");

        if (document.getElementById('material2')) {
            notificacion('No puedes agregar mas de 2 materiales', 'advertencia');
        } else {
            
            if (document.getElementById('material1')) {

                Elemento.innerHTML +=  item_forman(2,no_inventario,tipo_material,otro_tipo_Material,descripcion);                
                notificacion('Material agregado', 'success');
                document.getElementById('articulo2').value = `${no_inventario},${tipo_material},${otro_tipo_Material},${descripcion}`;
                console.log(get_Valor('articulo2'));
            }
            else {
                if (!document.getElementById('material1')) {
                    Elemento.innerHTML = item_forman(1,no_inventario,tipo_material,otro_tipo_Material,descripcion);
                    notificacion('Material agregado', 'success');
                    document.getElementById('articulo1').value = `${no_inventario},${tipo_material},${otro_tipo_Material},${descripcion}`;
                    console.log(get_Valor('articulo1'));
                }
            }
        }
        clear_inputs();
    }
}

function clear_inputs() {
    document.getElementById('no_inventario').value = "";
    document.getElementById('tipo_material').onselect = true;
    document.getElementById('otro_material').value = "";
    document.getElementById('descripcion_material').value = "";
}

/**
 * @param {int} numero sirve para poner el id 
 * @param {String} no_inventario 
 * @param {String} otro_tipo_Material 
 * @param {String} descripcion 
 */

function item_forman(numero,no_inventario,tipo_material, otro_tipo_Material, descripcion) {
    var nameTipe;
    //dependiendo del id de la bd jala la palabra
    if (tipo_material == 1) nameTipe = "REVISTA";
    if (tipo_material == 2) nameTipe = "LIBRO";
    if (tipo_material == 3) nameTipe = "CD";
    if (tipo_material == 4) nameTipe = "OTRO";
    if (tipo_material != '', descripcion == '') {
        return `<li class="list-group-item" id="material${numero}">No. inventario: ${no_inventario} Tipo: ${nameTipe} Otro tipo: ${otro_tipo_Material} </li>`;
    } else {
        if (tipo_material == '', descripcion != '') {
            return  `<li class="list-group-item" id="material${numero}">No. inventario: ${no_inventario} Tipo: ${nameTipe} Descripción: ${descripcion} </li>`;
        } else {
            if (tipo_material != '', descripcion != '') {
                return `<li class="list-group-item" id="material${numero}">No. inventario: ${no_inventario} Tipo: ${nameTipe} Otro tipo: ${otro_tipo_Material} Descripción: ${descripcion} </li>`;
            } else {
                if(tipo_material == '', descripcion == '') {
                    return `<li class="list-group-item " id="material${numero}">No. inventario: ${no_inventario} Tipo: ${nameTipe} </li>`;
                }
            }
        }
    }
}