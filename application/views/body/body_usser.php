<!-- Begin Page Content -->
<div class="container-fluid ">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $titulo_seccion ?></h1>
    <div class="content">
        <div class="row">
            <div class="col-12">
                <form action="<?= base_url('login/Update') ?>" method="POST" >
                    <div class="row">
                        <div class="form-group col-12 col-lg-6 col-xl-6 col-md-6">
                            <label for="nombres">Nombres</label>
                            <input type="text" name="nombres" class="form-control" placeholder="Nombres"/>
                        </div>
                        <div class="form-group col-12 col-lg-6 col-xl-6 col-md-6">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" name="apellidos"  class="form-control" placeholder="Apellidos" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12 col-lg-6 col-xl-6 col-md-6">
                            <label for="username">Nombre de usuario</label>
                            <input type="text" name="username"  class="form-control" placeholder="Alias" />
                        </div>
                        <div class="form-group col-12 col-lg-6 col-xl-6 col-md-6">
                            <label for="password">Password</label>
                            <input type="text" name="password" class="form-control" placeholder="Contraseña nueva"/>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        mandar datos
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- /.container-fluid -->