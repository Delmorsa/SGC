<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 3/5/2019 15:09 2019
 * FileName: perfil.php
 */
?>

<div class="content-wrapper" style="min-height: 1126px;">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $this->uri->segment(1)?>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">

		<div class="row">
			<div class="col-md-3">

				<!-- Profile Image -->
				<div class="box box-danger">
					<div class="box-body box-profile">
						<?php
						$img = '';
						if ($this->session->userdata("sexo") == 1) {
							$img = 'user2.png';
						}else{
							$img = 'female.jpg';
						}
						echo "<img src='".base_url()."/assets/img/".$img."' alt='".$this->session->userdata('user')."'
						  class='profile-user-img img-responsive img-circle'/>";
						?>
						<h3 class="profile-username text-center">
							<?php echo $this->session->userdata('user');?>
						</h3>

						<p class="text-muted text-center"><?php echo $this->session->userdata('rol')?></p>
						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<strong><i class="fa fa-pencil margin-r-5"></i> <?php echo $this->session->userdata('nombre')?></strong>
							</li>
							<li class="list-group-item">
								<strong><i class="fa fa-pencil-square-o margin-r-5"></i> <?php echo $this->session->userdata('apellidos')?></strong>
							</li>
							<li class="list-group-item">
								<strong><i class="fa fa-envelope margin-r-5"></i> <?php echo $this->session->userdata('correo')?></strong>
							</li>
							<li class="list-group-item">
								<strong><i class="fa fa-intersex scale margin-r-5"></i>
									<?php
									if($this->session->userdata('sexo') == 1){
										echo "Hombre";
									}else{
										echo "Mujer";
									}
									?></strong>
							</li>
						</ul>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
			<div class="col-md-6">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs nav-tabs-justified">
						<li class="active"><a class="" href="#settings" data-toggle="tab">Información personal</a></li>
						<li><a href="#ChangePass" data-toggle="tab">Cambiar Contraseña</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="settings">
							<div class="form-horizontal">
								<div class="form-group">
									<label for="inputName" class="col-sm-2 control-label">Name</label>

									<div class="col-sm-10">
										<input type="email" class="form-control" id="inputName" placeholder="Name">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail" class="col-sm-2 control-label">Email</label>

									<div class="col-sm-10">
										<input type="email" class="form-control" id="inputEmail" placeholder="Email">
									</div>
								</div>
								<div class="form-group">
									<label for="inputName" class="col-sm-2 control-label">Name</label>

									<div class="col-sm-10">
										<input type="text" class="form-control" id="inputName" placeholder="Name">
									</div>
								</div>
								<div class="form-group">
									<label for="inputExperience" class="col-sm-2 control-label">Experience</label>

									<div class="col-sm-10">
										<textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
									</div>
								</div>
								<div class="form-group">
									<label for="inputSkills" class="col-sm-2 control-label">Skills</label>

									<div class="col-sm-10">
										<input type="text" class="form-control" id="inputSkills" placeholder="Skills">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<button type="button" class="btn btn-primary">Actualizar</button>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="ChangePass">

							<div class="form-horizontal">
								<div class="form-group">
									<label for="currentPass" class="col-sm-4 control-label">Contraseña actual</label>

									<div class="col-sm-8">
										<input type="password" class="form-control" id="currentPass" placeholder="">
									</div>
								</div>
								<div class="form-group">
									<label for="newPass" class="col-sm-4 control-label ">Nueva Contraseña</label>

									<div class="col-sm-8">
										<input type="password" class="form-control" id="newPass" placeholder="">
									</div>
								</div>
								<div class="form-group">
									<label for="confirmPass" class="col-sm-4 control-label">Confirmar Contraseña</label>

									<div class="col-sm-8">
										<input type="password" class="form-control" id="confirmPass" placeholder="">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-4 col-sm-10">
										<button type="button" class="btn btn-primary">Actualizar</button>
									</div>
								</div>
							</div>
						</div>
						<!-- /.tab-pane -->
					</div>
					<!-- /.tab-content -->
				</div>
				<!-- /.nav-tabs-custom -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->

	</section>
	<!-- /.content -->
</div>
