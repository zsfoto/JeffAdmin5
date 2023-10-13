	<!-- top bar navigation -->
	<div class="headerbar">

        <div class="headerbar-left">
			<a href="index.html" class="logo">
				<?= $this->Html->image('jeffAdmin5./assets/images/logo.png', ['alt' => 'Logo']); ?> <span>Admin</span>
			</a>
        </div>

		<nav class="navbar navbar-custom">

			<ul class="list-inline menu-start mb-0">
				<li class="float-start">
					<a class="button-menu-mobile open-left">
						<i class="fa fa-fw fa-bars"></i>
					</a>
				</li>
				<li class="float-start d-none d-md-block">
					<span class="button-menu-mobile">
						Controller name elements
					</span>
				</li>
				
				<!--li class="list-inline-item notif">
					<a role="button" href="#" class="btn btn-warning btn-sm mt-2"><span class="btn-label"><i class="fa fa-eye"></i></span>Megnéz</a>
				</li>
				<li class="list-inline-item notif">
					<a role="button" href="#" class="btn btn-success btn-sm mt-2"><span class="btn-label"><i class="fa fa-plus"></i></span>Új felvitele</a>
				</li>
				<li class="list-inline-item notif">
					<a role="button" href="#" class="btn btn-primary btn-sm mt-2"><span class="btn-label"><i class="fa fa-edit"></i></span>Módosítás</a>
				</li>
				<li class="list-inline-item notif">
					<a role="button" href="#" class="btn btn-danger btn-sm mt-2"><span class="btn-label"><i class="fa fa-minus"></i></span>Töröl</a>
				</li-->
			</ul>
			
			
			<ul class="list-inline float-end mb-0">

				<li class="list-inline-item">
					<a id="search_icon" class="nav-link nav-user" data-bs-toggle="collapse" href="#collapseSearch" role="button" aria-expanded="false" aria-controls="collapseSearch">
						<i class="fa fa-fw fa-search"></i>
					</a>
				</li>

				<li class="dropdown list-inline-item notif">
					<a class="nav-link dropdown-toggle nav-user" data-bs-toggle="dropdown"  href="#" role="button" aria-haspopup="false" aria-expanded="false">
						<?= $this->Html->image('jeffAdmin5./assets/images/avatars/admin.png', ['alt' => 'Profile image', 'class' => 'avatar-rounded']); ?>
					</a>
					<div class="dropdown-menu dropdown-menu-right profile-dropdown">
						<div class="dropdown-item noti-title">
							<h5 class="text-overflow"><small>Hello, admin</small> </h5>
						</div>

						<a href="#" class="dropdown-item notify-item">
							<i class="fa fa-user"></i> <span>Profile</span>
						</a>

						<a href="#" class="dropdown-item notify-item">
							<i class="fa fa-power-off"></i> <span>Logout</span>
						</a>

						<a target="_blank" href="https://www.vzsfoto.hu" class="dropdown-item notify-item">
							<i class="fa fa-external-link"></i> <span>Jeff Admin</span>
						</a>
					</div>
				</li>

				<li class="list-inline-item">
					<a href="logout" class="nav-link nav-user" role="button" aria-haspopup="false" aria-expanded="false">
						<i class="fa fa-fw fa-sign-out"></i>
					</a>
				</li>

			</ul>

		</nav>


	</div><!-- End Navigation -->
