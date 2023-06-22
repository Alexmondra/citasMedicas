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
                         
                        <a href="<?php echo BASE_URL?>persona/frmRegistrar" class="btn btn-success">NUEVO REGISTRO</a>
                          
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
                        <div class="table-responsive">
                        <!-- .table -->
                        <table class="table table-striped">
                          <!-- thead -->
                          <thead class="thead-">
                            <tr>
                              <th> # </th>
                              <th> Nombre Completo </th>
                              <th> Correo </th>
                              <th> Usuario</th>
                              <th> Constraseña</th>
                              <th> Perfil</th>
                              <th> Opciones</th>
                            </tr>
                          </thead><!-- /thead -->
                          <!-- tbody -->
                          <tbody>
                            <?php $cont=0; foreach($data["personas"] as $row): $cont++;?>
                            <tr>
                              <td><?php echo $cont;?></td>
                              <td><?php echo $row["nombres"]." ".$row["apPaterno"]." ".$row["apMaterno"]?></td>
                              <td><?php echo $row["correo"]?></td>
                              <td><?php echo $row["usuario"]?></td>
                              <td><?php echo $row["contrasenia"]?></td>
                              <td><?php echo $row["idPerfil"]?></td>
                              <td>
                              <a href="<?php echo BASE_URL;?>persona/registrarDatos/action id=<?php  echo $row["id_persona"]?>" class="btn btn-info btn-sm">editar 
                              <i class="fa fa-edit"></i> </a>
                              <a href="<?php echo BASE_URL;?>persona/eliminar/<?php echo $row["id_persona"]?>" class="btn btn-dark btn-sm">eliminar 
                              <i class="fa fa-trash"></i></a>



                              </td>
                            </tr>
                            <?php endforeach?>
                          </tbody><!-- /tbody -->
                        </table><!-- /.table -->
                      </div>
                        </div><!-- metric column -->
                     
                    </div><!-- /metric row -->
                </div><!-- /.section-block -->
                
            </div><!-- /.page-section -->
        </div><!-- /.page-inner -->
    </div><!-- /.page -->
</div>