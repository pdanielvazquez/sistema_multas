		<!-- Begin Page Content -->
        <div class="container-fluid" >

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $titulo_seccion ?></h1>
          
          <div class="content">
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
          								<input type="text" name="folio" id="folio" placeholder="No. de folio" class="form-control">
          							</div>
          						</div>
          					</div>
                    <!-- .row:1 -->
                    <!-- row:2 -->
                    <div class="row">
                      <div class="col-xs-12 col-md-5 form-group">
                        <label>Fecha límite de devolución</label>
                        <input type="date" name="fecha_lim_dev" id="fecha_lim_dev" class="form-control" onchange="diff_fechas()">
                      </div>
                      <div class="col-xs-12 col-md-4 form-group">
                        <label>Fecha de devolución</label>
                        <input type="text" value="<?= $fecha ?>" name="fecha_dev" id="fecha_dev" class="form-control" disabled>
                      </div>
                      <div class="col-xs-12 col-md-3 form-group">
                        <label>Días de atraso</label>
                        <input type="text" name="dias_retrso" id="dias_retraso" class="form-control" disabled/>
                      </div>
                    </div>
                    <!-- .row:2 -->

                    <!-- .row:3 -->
                    <div class="row">
                      <div class="col-xs-12 col-md-6 form-group">
                        <label for="tipo_personal">Tipo de personal</label>
                        <select name="tipo_personal" id="tipo_personal" class="form-control" onchange="calcularPrecio()" >
                          <option disabled selected >Seleccionar</option>
                          <option value="alumno">Alumno</option>
                          <option value="profesor">Profesor</option>
                        </select>
                      </div>
                      
                      <div class="col-xs-12 col-md-6 form-group">
                        <label for="etiqueta">Material</label>
                        <select name="etiqueta" id="etiqueta" class="form-control" >
                          <option disabled selected >Seleccionar</option>
                          <option value="blanca">Etiqueta Blanca</option>
                          <option value="verde">Etiqueta Verde</option>
                        </select>
                      </div>
                    </div>
                    <br/>

                    <!-- row:3 -->
                    <div class="row">
                      <div class="col-xs-12 col-md-4 form-group">
                        <label>Monto económico</label>
                        <input type="text" name="monto_numero" id="monto_numero" class="form-control" placeholder="00.00" disabled/>
                      </div>
                      <div class="col-xs-12 col-md-8">
                        <label>&nbsp;</label>
                        <input type="text" name="monto_texto" id="monto_texto" class="form-control" placeholder="Cantidad en texto" disabled/>
                      </div>
                    </div>                                      
                    <div class="row">
                      <div class="col-xs-12 col-md-4 form-group">
                        <label for="matricula">Matricula</label>
                        
                        <select class=" form-control select2 " name="matricula" id="matricula"  style="width:100%;height:30px;" onchange="get_data()" >
                          <option disabled selected >Seleccionar</option>
                          <?php foreach ($lista as $key => $valor) {                              
                                  echo "<option value='".$valor->matricula."'>".$valor->matricula."</option>";
                                }
                          ?>                       
                        </select>
                      </div>
                      <div class="col-xs-12 col-md-8 form-group">
                        <div class="form-group">
                          <label for="name">Nombre</label>
                          <input type="text" name="name" id="name" class="form-control" placeholder="Nombre" disabled />
                        </div>
                      </div>
                    </div>
                    <br/><br/>

                    <!-- row4 -->
                    <div class="row">
                      <div class="col-xs-12 col-md-12">
                        <!-- DataTale -->
                        <div class="card shadow mb-4">
                          <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Materiales entregados de manera extemporanea</h6>
                          </div>
                          <div class="card-body">

                            <div id="agregar_material">
                              <fieldset>
                                <legend><a href="#"><i class="far fa-plus-square"></i> Agregar material</a></legend>
                                <div class="content">
                                  <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                      <div class="form-group">
                                        <label>No. de inventario del material</label>
                                        <input type="text" name="no_inventario" id="no_inventario" class="form-control" placeholder="Por ejemplo: 12345">
                                      </div>
                                      <div class="form-group">
                                        <label>Tipo de material</label>
                                        <select name="tipo_material" id="tipo_material" class="form-control">
                                          <option>Libro</option>
                                          <option>Revista</option>
                                          <option>CD</option>
                                          <option>Otro</option>
                                        </select>
                                      </div>
                                      <label>Otro tipo de material</label>
                                        <input type="text" name="otro_material" id="otro_material" class="form-control" placeholder="Por ejemplo: Tesina, Reporte de servicio, Periodico, etc.">
                                      <div class="form-group">
                                        <label>Descripción</label>
                                        <textarea name="descripcion_material" id="descripcion_material" class="form-control" placeholder="Por ejemplo: Nombre del Libro, Revista, Disco, etc.">
                                        </textarea>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <button class="btn btn-primary">Agregar</button>
                                </div>
                              </fieldset>
                            </div>

                            <div class="table-responsive">
                              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                    <th>No. Inventario</th>
                                    <th>Tipo de material</th>
                                    <th>Descripción</th>
                                  </tr>
                                </thead>
                                <tfoot>
                                  <tr>
                                    <th>No. Inventario</th>
                                    <th>Tipo de material</th>
                                    <th>Descripción</th>
                                  </tr>
                                </tfoot>
                                <tbody>
                                  <tr>
                                    <td>28100</td>
                                    <td>Libro</td>
                                    <td>Algebra Lineal</td>
                                  </tr>
                                  <tr>
                                    <td>15983</td>
                                    <td>Revista</td>
                                    <td>Almanaque 2018 - IEEE</td>
                                  </tr>
                                  <tr>
                                    <td>35741</td>
                                    <td>Revista</td>
                                    <td>Junior Technical</td>
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
          				<div class="card-footer">
          					<button class="btn btn-success">Aceptar</button>
                    <button class="btn btn-warning">Cancelar</button>
          				</div>
          			</div>
          		</div>
          	</div>
          </div>
        </div>
        <!-- /.container-fluid -->