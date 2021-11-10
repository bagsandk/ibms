<div class="card">
	<div class="card-body">
		<div class="row d-flex justify-content-between p-3">
			<h4 class="card-title">Tambah Admin</h4>
		</div>
		<?php echo form_open('admin/add', array("class" => "form-horizontal")); ?>

		<div class="form-group">
			<label for="nama" class="col-md-4 control-label">Nama</label>
			<div class="col-md-6">
				<input type="text" name="nama" value="<?php echo $this->input->post('nama'); ?>" class="form-control" id="nama" />
				<span class="text-danger"><?php echo form_error('nama'); ?></span>
			</div>
		</div>
		<div class="form-group">
			<label for="email" class="col-md-4 control-label">Email</label>
			<div class="col-md-6">
				<input type="text" name="email" value="<?php echo $this->input->post('email'); ?>" class="form-control" id="email" />
				<span class="text-danger"><?php echo form_error('email'); ?></span>
			</div>
		</div>
		<div class="form-group">
			<label for="hp" class="col-md-4 control-label">Hp</label>
			<div class="col-md-6">
				<input type="text" name="hp" value="<?php echo $this->input->post('hp'); ?>" class="form-control" id="hp" />
				<span class="text-danger"><?php echo form_error('hp'); ?></span>
			</div>
		</div>
		<div class="form-group">
			<label for="password" class="col-md-4 control-label">Password</label>
			<div class="col-md-6">
				<input type="password" name="password" value="<?php echo $this->input->post('password'); ?>" class="form-control" id="password" />
				<span class="text-danger"><?php echo form_error('password'); ?></span>
			</div>
		</div>


		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-8">
				<button type="submit" class="btn btn-success">Save</button>
			</div>
		</div>

		<?php echo form_close(); ?>
	</div>
</div>