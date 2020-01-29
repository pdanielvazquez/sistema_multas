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
                                <h6 class="m-0 font-weight-bold text-primary m-auto">Lista de precios de multas.</h6>
                                <button type="button" class="btn btn-link float-right mt-altura" data-toggle="modal" data-target="#exampleModalCenter">
                                    <h6>nueva <i class="fas fa-plus icono"></i></h6>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Año</th>
                                                <th>Activo</th>
                                                <th>precio</th>
                                                <th>Personal</th>
                                                <th>Activar</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Año</th>
                                                <th>Activo</th>
                                                <th>precio</th>
                                                <th>Personal</th>
                                                <th>Activar</th>
                                            </tr>
                                        </tfoot >
                                        <tbody>
                                            <?php
                                            foreach ($list as $key => $value) {
                                                if ($value->activo) {
                                                    $html = "
                                                        <tr style='background: rgba(2, 121, 219, 0.1);'>
                                                            <td class='text-center'>" . $value->years . "</td>
                                                            <td class='text-center'  >Si</td>
                                                            <td class='text-center'>$ " . $value->precio . ".00</td>
                                                            <td class='text-center'>" . $value->nombre . "</td>
                                                            <td class='text-center'>
                                                                <button class='btn' onclick='activa();' disabled>
                                                                    <i class='far fa-check-circle'></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        ";
                                                } else {
                                                    $var1="luis E";
                                                    $html = "
                                                        <tr>
                                                            <td class='text-center'>" . $value->years . "</td>
                                                            <td class='text-center'>No</td>
                                                            <td class='text-center'>$ " . $value->precio . ".00</td>
                                                            <td class='text-center'>" . $value->nombre . "</td>
                                                            <td class='text-center'>
                                                                <button class='btn' onclick='activa('1','2');'>
                                                                    <i class='far fa-check-circle'></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    ";
                                                }
                                                echo $html;
                                            }
                                            ?>
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
    <!--Ventana modal --->
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-center bg-primary text-white">
                    <h5 class="modal-title text-c" id="exampleModalCenterTitle">Nuevo precio</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label for="year">Año</label>
                            <input type="number" name="year"  id="year" class=" form-control" placeholder="Año"/>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="number" name="precio"  id="precio" class=" form-control" placeholder="Precio de la Nueva multa"/>
                        </div>
                        <div class="form-group">
                            <label for="persona">Tipo Persona</label>
                            <select name="persona" id="persona" class="form-control">
                                <option disabled selected>Seleccionar</option>
                                <option value="alumno">Alumno</option>
                                <option value="profesor">Maestro</option>
                            </select>
                        </div>
                        <button type="submit" class=" btn btn-primary col-12" onclick="Guardaprecios()">
                            Guardar &nbsp;<i class="far fa-save"></i>
                        </button>
                        </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar Precio</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- /.container-fluid -->