<!-- Begin Page Content -->
<div class="container-fluid ">
    <!-- Page Heading -->
    <h1 class="h3 text-gray-800"><?= $titulo_seccion ?></h1>
    <div class="content">
        <div class="row">
            <form onsubmit="busca_multa(event)" >
                <div class="input-group">
                    <input type="text" id="folio" class="form-control" placeholder="Folio de la multa existente"/>
                    <div class="div">
                        <button type="submit" class="btn btn-primary btn-borde">
                        <i class="fas fa-search"></i> Buscar 
                    </button>
                    </div>
                                                     
                </div>
            </form>
        </div>
    </div>

</div>
</div>
</div>

<!-- /.container-fluid -->