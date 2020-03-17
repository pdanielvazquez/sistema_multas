<!-- Begin Page Content -->
<div class="container-fluid ">
    <!-- Page Heading -->
    <h1 class="h3 text-gray-800"><?= $titulo_seccion ?></h1>
    <div class="content">
        <div class="row">
            <form onsubmit="busca_multa_apagar(event)">
                <div class="input-group">
                    <input type="text" id="folio" class="form-control" placeholder="Folio de la multa existente" />
                    <div class="div">
                        <button type="submit" class="btn btn-primary btn-borde">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="d-none" id="formato">
        <br /><br />
        <div class="row">
            <div class="col-xs-12 col-md-10 col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        Datos de la multa
                    </div>
                    <div class="card-body">
                        <!-- row:1 -->
                        <div class="row">
                            <div class="col-xs-1 col-md-2">
                                <img src="<?= base_url('startbootstrap/img/utp.ico') ?>" class="img_logo">
                            </div>
                            <div class="col-xs-12 col-md-8" id="titulo_formato">
                                <h5>Universidad Tecnológica de Puebla</h5>
                                <h6>Centro de Información</h6>
                                <h6>"Ing. Carlos Vallejo Márquez"</h6>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <div class="form-group">
                                    <input type="text" id="folioM" class=" form-control" disabled />
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12 col-md-6 form-group">
                                <label for="tipo_personal">Tipo de personal</label>
                                <select name="tipo_personal" id="tipo_personal" class="form-control" onchange="calcularPrecio()" disabled>
                                    <option disabled selected>Seleccionar</option>
                                    <option value="alumno">Alumno</option>
                                    <option value="profesor">Profesor</option>
                                </select>
                            </div>
                            <div class="col-xs-12 col-md-6 form-group">
                                <label for="etiqueta">Material</label>
                                <input type="text" id="etiqueta" class=" form-control" disabled />
                            </div>
                        </div>
                        <br />                        
                        
                        <!--contenedor con matricula y nombre de alumnos-->
                        <div class="row">
                            <div class="col-xs-12 col-md-4 form-group">
                                <label for="matricula">id/Matricula</label>
                                <input type="text" id="identificador" class="form-control" disabled />
                            </div>
                            <div class="col-xs-12 col-md-8 form-group">
                                <div class="form-group">
                                    <label for="name_alumno">Nombre</label>
                                    <input type="text" id="nombre" class="form-control" placeholder="Nombre" disabled />
                                </div>
                            </div>
                        </div>
                        <br /><br />
                        <!-- row4 -->
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <!-- DataTale -->
                                <div class="card shadow mb-12">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Materiales entregados de manera extemporanea</h6>
                                    </div>
                                    <div class="card-body">
                                        <div id="agregar_material">
                                            <!-- Button trigger modal -->
                                            <div class="content">
                                                <div class="row">
                                                    <ul class="list-group col-12" id="lista">
                                                        <li class="list-group-item  text-center">Listado Materiales</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- .card-body -->
                                </div>
                                <!-- .DataTale -->
                            </div>
                        </div>
                        <!-- .row4 -->
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success" onclick="pagar();">Pagar multa</button>
                        <button class="btn btn-warning">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<!-- /.container-fluid -->