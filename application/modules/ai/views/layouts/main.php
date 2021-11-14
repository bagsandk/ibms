<?php $this->load->view('layouts/header') ?>

<body class="alt-menu sidebar-noneoverflow">
	<!-- BEGIN LOADER -->
	<div id="load_screen" style="display: block;">
		<div class="loader-parrent">
			<div class="loader-content">
				<div class="loadingio-spinner-pulse-ib2bujl9udn">
					<div class="ldio-qu8p9jaut2k">
						<div></div>
						<div></div>
						<div></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--  END LOADER -->

	<div class="header-container">
		<header class="header navbar navbar-expand-sm">

			<a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
					<line x1="3" y1="12" x2="21" y2="12"></line>
					<line x1="3" y1="6" x2="21" y2="6"></line>
					<line x1="3" y1="18" x2="21" y2="18"></line>
				</svg></a>

			<div class="nav-logo align-self-center">
				<a class="navbar-brand" href="index.html"><img alt="logo" src="<?= base_url() ?>assets/light/pln1.png"> <span class="navbar-brand-name">Anggaran Investasi</span></a>
			</div>

			<ul class="navbar-item ml-auto flex-row nav-dropdowns">
				<li class="nav-item dropdown user-profile-dropdown order-lg-0 order-1">
					<a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="user-profile-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<div class="media">
							<img src="<?= base_url() ?>assets/light/main/img/90x90.jpg" class="img-fluid" alt="admin-profile">
							<div class="media-body align-self-center">
								<h6><span>Hi,</span> Alan</h6>
							</div>
						</div>
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
							<polyline points="6 9 12 15 18 9"></polyline>
						</svg>
					</a>
					<div class="dropdown-menu position-absolute animated fadeInUp" aria-labelledby="user-profile-dropdown">
						<div class="">
							<div class="dropdown-item">
								<a class="" href="user_profile.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
										<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
										<circle cx="12" cy="7" r="4"></circle>
									</svg> My Profile</a>
							</div>
							<div class="dropdown-item">
								<a class="" href="auth_login.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
										<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
										<polyline points="16 17 21 12 16 7"></polyline>
										<line x1="21" y1="12" x2="9" y2="12"></line>
									</svg> Sign Out</a>
							</div>
						</div>
					</div>

				</li>
			</ul>
		</header>
	</div>

	<!--  BEGIN MAIN CONTAINER  -->
	<div class="main-container" id="container">

		<div class="overlay"></div>
		<div class="search-overlay"></div>

		<!--  BEGIN NAVBAR  -->
		<?php $this->load->view('layouts/navbar') ?>
		<!--  END NAVBAR  -->

		<!--  BEGIN CONTENT PART  -->
		<div id="content" class="main-content">
			<div class="layout-px-spacing">

				<div class="page-header">
					<div class="page-title">
						<h3><?= $title ?></h3>
					</div>
				</div>

				<div class="row layout-top-spacing">
					<?php if (isset($_view) && $_view)
						$this->load->view($_view);
					?>
				</div>
				<?php $this->load->view('layouts/footer') ?>