<!-- Begin Page Content -->
<div class="container-fluid ">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $titulo_seccion ?></h1>
    <div class="content">


        <form action="<?= base_url('informe') ?>" method="post" class="col-12 row">
            <div class="col-6 col-sm-4">
                <div class="form-group col-12">
                    <label for="yearOne">Año</label>
                    <input type="number" name="yearOne" id="yearOne" class=" form-control" placeholder="Ingresar año" />
                </div>

                <div class="form-group col-12">
                    <label for="mesOne">Mes</label>
                    <select name="mesOne" id="mesOne" class="form-control">
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
                    <label for="yearTwo">Año</label>
                    <input type="number" name="yearTwo" id="yearTwo" class=" form-control" placeholder="Ingresar año" />
                </div>

                <div class="form-group col-12 ">
                    <label for="mesTwo">Mes</label>
                    <select name="mesTwo" id="mesTwo" class="form-control">
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
                <button type="submit" class="btn  btn-outline-primary">
                    Buscar
                </button>
                <!--<button type="submit" class="btn btn-primary" onclick="viewtable()">
                        Buscar
                    </button>-->
            </div>
        </form>
        <!-- .row4 -->

        <?php

        ?>
        <?php
        if ($tabla) {
            $visible = 'col-12 ';
        } else {
            $visible = 'col-12 d-none';
        }
        ?>
        <div class="<?= $visible ?>">
            <br><br><br>
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
                    <?php
                    foreach ($tabla as $key => $item) {
                        echo "
                                <tr>
                                    <th class='text-center'>" . $item->folio . "</th>
                                    <th>" . date("d/m/Y", strtotime($item->fecha_creada)) . "</th>
                                    <th>" . $item->monto . "</th>
                                    <th>" . $item->nombre . "</th>
                                    <th>" . $item->status . "</th>                        
                                </tr>
                                ";
                    }
                    ?>

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

    <div class="card-body col-8">
        <div class=" card-header text-center bg-info text-light">
            Gráfica de multas 
        </div>
        <form method="post" onsubmit="grafica(event)" class=" mb-4">
            <label for="year">año</label>
            <input type="number" id="year" placeholder="Escribe el año" class="form-control" />
        </form>
        <canvas id="myChart" width="600" height="400" class=""></canvas>
    </div>
</div>
</div>
</div>
<!-- /.container-fluid -->