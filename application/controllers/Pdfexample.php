<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pdfexample extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        ob_end_clean();
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);


        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('helvetica', '', 10);

        // add a page
        $pdf->AddPage();

        /* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * $html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */


        // define some HTML content with style
        $html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
.tam {
    margin: auto;
    width: 800px;
}

table#mitabla {
    border-collapse: collapse;
    border: .5px solid rgb(19, 18, 18);
    font-size: 12px;
}

table#mitabla th {
    padding: 5px;
}

table#mitabla td {
    padding: 5px 10px;
}



.info {
    width: 557px;
    float: right;
    
}

.formatoText {
    line-height: 5px;
}

.borde {
    border-top: 1px solid rgb(19, 18, 18);
    border-right: 1px solid rgb(19, 18, 18);
    border-left: 1px solid rgb(19, 18, 18);

}
</style>
<table border="1">
    <tr>
        <th colspan="6"><img src="./utplogo.png" width="50px"></th>
        <th colspan="6">Heading Column Span 9</th>
    </tr>
</table>


<table border="1">
<tr>
<th rowspan="3">Left column</th>
<th colspan="5">Heading Column Span 5</th>
<th colspan="9">Heading Column Span 9</th>
</tr>
<tr>
<th rowspan="2">Rowspan 2<br />This is some text that fills the table cell.</th>
<th colspan="2">span 2</th>
<th colspan="2">span 2</th>
<th rowspan="2">2 rows</th>
<th colspan="8">Colspan 8</th>
</tr>
<tr>
<th>1a</th>
<th>2a</th>
<th>1b</th>
<th>2b</th>
<th>1</th>
<th>2</th>
<th>3</th>
<th>4</th>
<th>5</th>
<th>6</th>
<th>7</th>
<th>8</th>
</tr>
</table>


<div class="tam borde " style="height: 160px;">
        <div class="imagen "style="width: 239px;text-align: justify;float: left;">
            <img src="./utplogo.png" width="50px"><br>
            <p class="formatoText"> Lorem,veniam, voluptatum </p>
            <p class="formatoText"> Lorem,veniam, voluptatum </p>
        </div>
        <div class="info " style="width: 557px;float: right;">
            <p style="float: right;margin-right: 10px;">Folio:xxxxxxxxxx</p>
            <p style="text-align: center;margin-right: 200px;">Universidad Tecnológica de Puebla <br>
                Centro de información <br>
                ing. Carlos Vallejo Márquez <br>
            </p>
            <p style="text-align: justify;"> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Amet reiciendis
                aliquid provident voluptatum atque, vel recusandae error ducimus suscipit fuga labore libero sequi
                tempore quae eum in reprehenderit. Voluptatum, odit!</p>
        </div>
    </div>
    <div class="tam borde" style="height: 92px;">
        <table border="1" class="tam" id="mitabla">
            <tr>
                <th>
                    Fecha limite de devolución
                    <p>xx/xx/xxxx</p>
                </th>
                <th>
                    Fecha de devolucion
                    <p>xx/xx/xxxx</p>
                </th>
                <th>
                    Días de atraso
                    <p>NO Días </p>
                </th>
            </tr>
            <tr>
                <th colspan="3">Monto economico $000.00 (cantidad de pesos mexcanos..)</th>
            </tr>
            <!--<td rowspan="2">Valor</td>
                <th colspan="2">Titulo 2</th>
            -->
        </table>
    </div>
    <div class="tam borde" style="height: auto;">
        <table border="1" class="tam" id="mitabla">
            <tr>
                <th>
                    Materiales
                </th>
                <th>
                    No inventario xxxxxxx Material:Revista <br>
                    No inventario xxxxxxx Material:Revista <br>
                    No inventario xxxxxxx Material:Revista <br>
                    No inventario xxxxxxx Material:Revista <br>
                </th>
            </tr>
            <tr>
                <th colspan="2">
                    <span style="float:left;margin-left: 30px;">Nombre del usuario: Lorem ipsum dolor sit amet
                        consectetur.</span>
                    <span style="float: right; margin-right: 30px;">Docente o Administrativo|Alumno</span>

                </th>
            </tr>

        </table>
    </div>
    <div class="tam borde" style="height: auto;">
        <table border="1" class="tam" id="mitabla">
            <tr>
                <th>
                    N° de matrícula/ N° de ID: xxxxxxxxx
                </th>
                <th><br><br>
                    <p style="border-top: 1px solid rgb(19, 18, 18);width: 200px;margin: auto;">
                        Firma confirmada del usuario
                    </p>
                </th>
            </tr>
        </table>
    </div>
    <div class="tam borde" style="height: auto;">
        <table border="1" class="tam" id="mitabla">
            <tr>
                <th>
                    <br><br><br><br><br><br><br>
                    Nombre de quien sella
                </th>
                <th>

                    concilió
                </th>
                <th>
                    Liberación de no adeudo por parte del Módulo de <br>
                    Atencion del centro de información
                    <br><br><br><br><br><br>
                    Nombre,firma,sello
                </th>
            </tr>
        </table>
    </div>
    <div class="tam " style="height: auto;font-size: 12px;">
        <strong>Nota:</strong> Tiene dis días habiles apartir de la fecha de emición para devolver el formato
        debidamente requisitado al centro de información
    </div>

EOF;

        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->lastPage();
        // ---------------------------------------------------------
        //Close and output PDF document
        $pdf->Output('example_061.pdf', 'I');
    }
}
