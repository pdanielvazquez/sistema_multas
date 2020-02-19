<!-- Begin Page Content -->
<?php
var_dump($this->session->datos); 
?>
<div class="container-fluid col-12 ">
    <div style="clear: both"></div>
    <div class="tam borde " style="height: auto;">
        <div class="imagen ">
            <img src="<?= base_url('startbootstrap/img/utplogo.png') ?>" width="80px"><br>
            <p class=""> Lorem,veniam, voluptatum </p>
            <p class=""> Lorem,veniam, voluptatum </p>
        </div>
        <div class="info ">
            <p style="float: right;margin-right: 10px;">Folio:<?= $folio ?></p>
            <p style="text-align: center;margin-right: 200px;">Universidad Tecnológica de Puebla <br>
                Centro de información <br>
                ing. Carlos Vallejo Márquez <br>
            </p>
            <p style="text-align: justify;"> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Amet reiciendis
                aliquid provident voluptatum atque, vel recusandae error ducimus suscipit fuga labore libero sequi
                tempore quae eum in reprehenderit. Voluptatum, odit!</p>
        </div>
    </div>
    <div class="tam borde" style="height: auto;">
        <table border="1" class="tam mitabla">
            <tr>
                <th>
                    Fecha limite de devolución
                    <p><?= $fecha_limite ?></p>
                </th>
                <th>
                    Fecha de devolucion
                    <p><?= $fecha_creada ?></p>
                </th>
                <th>
                    Días de atraso
                    <p><?= $dias_arasados ?></p>
                </th>
            </tr>
            <tr>
                <th colspan="3">Monto economico <?= $monto?> <?= $montoText?></th>
            </tr>
            
        </table>
    </div>
    <div class="tam borde" style="height: auto;">
        <table border="1" class="tam mitabla">
            <tr>
                <th>
                    Materiales
                </th>
                <th>
                    <?= $material1 ?> <br>
                    <?= $material2 ?> <br>

                </th>
            </tr>
            <tr>
                <th colspan="2">
                    <span style="float:left;margin-left: 30px;">
                        Nombre del usuario: <?= $nombre?>                    
                    </span>
                    <span style="float: right; margin-right: 30px;"><?= $Tipo_personal ?></span>

                </th>
            </tr>

        </table>
    </div>
    <div class="tam borde" style="height: auto;">
        <table border="1" class="tam mitabla" >
            <tr>
                <th>
                    N° de matrícula/ N° de ID: <?= $multado ?>
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
        <table border="1" class="tam mitabla" >
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
        <strong>Nota:</strong> Tiene ds días habiles apartir de la fecha de emición para devolver el formato
        debidamente requisitado al centro de información
    </div>
    <br>

    <!----->

    </body>

    <!-- /.container-fluid -->