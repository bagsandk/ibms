<div class="row layout-spacing">
	<div class="col-lg-12">
		<div class="statbox widget box box-shadow">
			<div class="widget-content widget-content-area">
				<div class="table-responsive mb-4">
					<div id="style-3_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
						<div class="row">
							<div class="col-sm-12">
								<table id="style-3" class="table style-3 table-hover dataTable no-footer" role="grid" aria-describedby="style-3_info">
									<thead>
										<tr role="row">
											<th class="">#</th>
											<th class="">Foto</th>
											<th class="">Nama</th>
											<th class="">Email</th>
											<th class="">No HP</th>
											<th class="">Role</th>
											<th class="">Status</th>
											<th class="">Login</th>
											<th class="">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1;
										foreach ($user as $list) { ?>
											<tr role="row">
												<td class="text-center"><?= $no++ ?></td>
												<td class="text-center">
													<span><img src="<?= base_url() ?>assets/dark/main/img/90x90.jpg" class="profile-img" alt="avatar"></span>
												</td>
												<td><?= $list['nama_user'] ?></td>
												<td><?= $list['email'] ?></td>
												<td><?= $list['no_hp'] ?></td>
												<td class="text-uppercase <?= $list['role'] == 'user' ? 'text-success' : 'text-danger' ?>"><?= $list['role'] ?></td>
												<td class="text-center">
													<?= $list['aktif'] == 1 ? '	<span class="shadow-none badge badge-primary">Aktif</span>' : '<span class="shadow-none badge badge-warning">Nonaktif</span>'
													?>

												</td>
												<td><?= $list['terakhir_login'] ?></td>
												<td class="text-center">
													<ul class="table-controls">
														<li><a href="javascript:void(0);" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1">
																	<path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
																</svg></a></li>
														<li><a href="javascript:void(0);" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1">
																	<polyline points="3 6 5 6 21 6"></polyline>
																	<path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
																</svg></a></li>
													</ul>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>