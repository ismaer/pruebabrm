<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start();
session_start();

if (!isset($_SESSION['nombre'])) {
  header("Location: login.php");
}
else{
require 'header.php';

?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h1 class="box-title">Productos <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th> Opciones</th>
                            <th> Nombre</th>
                            <th> Marca</th>
                            <th> Observaciones</th>
                            <th> Cant_disp</th>
                            <th> Fecha</th>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                            <th> Opciones</th>
                            <th> Nombre</th>
                            <th> Marca</th>
                            <th> Observaciones</th>
                            <th> Cant_disp</th>
                            <th> Fecha</th>
                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body"  id="formularioregistros">
                      <form name="formulario" id="formulario" method="POST">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                          <label>Nombre(*):</label>
                          <input type="hidden" class="form-control" name="idproducto" id="idproducto">
                          <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                          <label>Marca(*):</label>
                          <select id="idmarca" name="idmarca" class="form-control selectpicker"  data-live-search="true"  required>
                            
                          </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                          <label>Observaciones:</label>
                          <input type="text" class="form-control" name="observaciones" id="observaciones" maxlength="256" placeholder="Descripcion">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                          <label>Cantidad Disponible(*):</label>
                          <input type="number" class="form-control" name="cant_invto" id="cant_invto" required>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" id="btnGuardar" > <i class="fa fa-save"> </i> Guardar </button>
                          <button class="btn btn-danger" onclick="cancelarform()" type="button" id="btnCancelar" > <i class="fa fa-arrow-circle-left"> </i> Cancelar </button>
                        </div>
                      </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->

<?php
require 'footer.php';
?>
<script type="text/javascript" src="../public/js/JsBarcode.all.min.js"> </script>
<script type="text/javascript" src="../public/js/jquery.PrintArea.js"> </script>
<script type="text/javascript" src="scripts/producto.js"> </script>

<?php
}
ob_end_flush();
?>