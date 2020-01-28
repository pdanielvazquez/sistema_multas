<!-- Begin Page Content -->
<div class="container-fluid">
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
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Lista de precios de multas.</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <?php
                                            foreach ($list as $key => $value) {
                                                var_dump($value);
                                                
                                            }
                                            ?>
                                            
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Año</th>
                                                <th>Activo</th>
                                                <th>precio</th>
                                                <th>Personal</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <tr>
                                                <td>28100</td>
                                                <td>Libro</td>
                                                <td>Algebra Lineal</td>
                                                <td>Algebra Lineal</td>
                                            </tr>
                                            
                                            
                                        </tbody>
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