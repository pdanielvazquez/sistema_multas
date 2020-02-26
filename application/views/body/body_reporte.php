<!-- Begin Page Content -->
<div class="container-fluid ">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $titulo_seccion ?></h1>
    <div class="content">
        <div class="row">
            <div class="col-12">
                <!-- row4 -->
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <!-- DataTale -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 ">
                                <h6 class="m-0 font-weight-bold text-primary m-auto">Reporte multas.</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    
                                    <table id="ejemplo" class="table table-striped table-bordered" style="width:100%">                                       
                                        <thead>
                                            <tr>                                                                                                
                                                <th>Folio</th>
                                                <th>Fecha Creada</th>
                                                <th>Fecha vencimiento</th>
                                                <th>Etiqueta</th>
                                                <th>Personal</th>
                                                <th>Identificador</th>
                                                <th>Nombre</th>
                                                <th>Cobrado</th>
                                            </tr>
                                        </thead >
                                        <tbody>
                                            <?php
                                            foreach ($list as $key => $value) {                                            
                                                    $html = "
                                                        <tr>
                                                            <td class='text-center'>" . $value->folio . "</td>                                                            
                                                            <td class='text-center'>" . $value->fecha_creada . "</td>
                                                            <td class='text-center'>" . $value->fecha_vencido . "</td>
                                                            <td class='text-center'>" . $value->etiqueta . "</td>
                                                            <td class='text-center'>" . $value->personal . "</td>
                                                            <td class='text-center'>" . $value->id_multado . "</td>
                                                            <td class='text-center'>" . $value->nombre_multado . "</td>
                                                            <td class='text-center'>" . $value->cobrado  . "</td>
                                                        </tr>
                                                    ";                                                
                                                echo $html;
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>Folio</th>
                                                <th>Fecha Creada</th>
                                                <th>Fecha vencimiento</th>
                                                <th>Etiqueta</th>
                                                <th>Personal</th>
                                                <th>Identificador</th>
                                                <th>Nombre</th>
                                                <th>Cobrado</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- .tabla responsiva -->
                            </div>
                            <!-- .card-body -->
                        </div>
                        <!-- .DataTale -->
                    </div>
                </div>
                <!-- .row4 -->
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- /.container-fluid -->