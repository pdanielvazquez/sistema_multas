<!-- Begin Page Content -->
<div class="container-fluid ">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $titulo_seccion ?></h1>
    <div class="content">

        <div class="row ">
            <div class="col-6 col-sm-4">
                <div class="form-group col-12">
                    <label for="yearinicio">Año</label>
                    <input type="number" name="yearinicio" id="yearinicio" class=" form-control" placeholder="Ingresar año" />
                </div>

                <div class="form-group col-12">
                    <label for="mesinicio">Mes</label>
                    <select name="mesinicio" id="mesinicio" class="form-control">
                        <option selected disabled>Seleccionar mes</option>col-6 col-sm-4
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octube</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                </div>
            </div>

            <div class="col-6 col-sm-4">
                <div class="form-group col-12">
                    <label for="yearfin">Año</label>
                    <input type="number" name="yearfin" id="yearfin" class=" form-control" placeholder="Ingresar año" />
                </div>

                <div class="form-group col-12 ">
                    <label for="mesfin">Mes</label>
                    <select name="mesfin" id="mesfin" class="form-control">
                        <option selected disabled>Seleccionar mes</option>col-6 col-sm-4
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octube</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                </div>
            </div>
            <div class="col-6 col-sm-2 mt-5">
                <button type="submit" class="btn btn-primary" onclick="viewtable()">
                    Buscar
                </button>
            </div>
            <!-- .row4 -->
        </div>
        <div class="col-12">
            <table id="ejemplo" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Folio</th>
                        <th>Fecha Creada</th>
                        <th>monto</th>
                        <th>nombre</th>
                        <th>status</th>                        
                    </tr>
                </thead>
                <tbody id="cuerpo">
                    
                    
                </tbody>
                <tfoot>
                    <tr>
                        <th>Folio</th>
                        <th>Fecha Creada</th>
                        <th>monto</th>
                        <th>nombre</th>
                        <th>status</th>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
</div>
</div>
</div>
<!-- /.container-fluid -->