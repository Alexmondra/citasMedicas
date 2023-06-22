<div class="wrapper">
    <!-- .page -->
    <div class="page">
        <!-- .page-inner -->
        <div class="page-inner">
            <!-- .page-title-bar -->
            <header class="page-title-bar">
                <div class="d-flex flex-column flex-md-row">
                    <p class="lead">
                        <span class="font-weight-bold"><?php echo $data["titulo"]?></span> 
                        <!--<span class="d-block text-muted">Here’s what’s happening with your business today.</span>-->
                    </p>
                    <div class="ml-auto">
                        <!-- .dropdown -->
                        <div class="dropdown">
                        
                           
                        </div><!-- /.dropdown -->
                    </div>
                </div>
            </header><!-- /.page-title-bar -->
            <!-- .page-section -->
            <div class="page-section">
                <!-- .section-block -->
                <div class="section-block">
                    <!-- metric row -->
                    <div class="metric-row">
                        <div class="col-lg-12">
                  
<form action="<?php echo BASE_URL;?>persona/registrarDatos" method="POST" autocomplete="off">
<!-- Form Name -->
<legend>Form Name</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Nombres:</label>  
  <div class="col-md-4">
  <input id="textinput" name="txtNombres" type="text" placeholder="" class="form-control input-md" value="<?php echo $_REQUEST["txtNombres"]?>">
    <?php if(isset($data["errores"]["nombre"])):?>
      <div style="color:red">
        <?php echo $data["errores"]["nombre"];?>
      </div>
    <?php endif;?>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Apellido Paterno:</label>  
  <div class="col-md-4">
  <input id="textinput" name="txtApPaterno" type="text" placeholder="" class="form-control input-md" value="<?php echo $_REQUEST["txtApPaterno"]?>">
  <?php if(isset($data["errores"]["paterno"])):?>
      <div style="color:red">
        <?php echo $data["errores"]["paterno"];?>
      </div>
    <?php endif;?>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Apellido Materno:</label>  
  <div class="col-md-4">
  <input id="textinput" name="txtApMaterno" type="text" placeholder="" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Correo:</label>  
  <div class="col-md-4">
  <input id="textinput" name="txtCorreo" type="text" placeholder="" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Usuario:</label>  
  <div class="col-md-4">
  <input id="textinput" name="txtUsuario" type="text" placeholder="" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Contraseña:</label>  
  <div class="col-md-4">
  <input id="textinput" name="txtContrasenia" type="text" placeholder="" class="form-control input-md">
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Perfil:</label>
  <div class="col-md-4">
    <select id="selectbasic" name="cboPerfil" class="form-control">
      <option value="1">Administrador</option>
      <option value="2">Docente</option>
    </select>
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="button1id"></label>
  <div class="col-md-8">
    <input type="submit" value="REGISTRAR DATOS" class="btn btn-success">
    <a href="<?php echo BASE_URL?>persona" class="btn btn-danger">CANCELAR REGISTRO</a>
  </div>
</div>

</fieldset>
</form>
                        </div><!-- metric column -->
                     
                    </div><!-- /metric row -->
                </div><!-- /.section-block -->
                
            </div><!-- /.page-section -->
        </div><!-- /.page-inner -->
    </div><!-- /.page -->
</div>