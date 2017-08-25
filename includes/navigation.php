<?php users_online(); ?>
<nav class="navbar navbar-inverse navbar-toggleable-md bg-inverse no-wrap mb-4" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header navbar-header-collapsed">
			<a class="navbar-brand no-wrap" href="index.php">Home</a>
			<button class="navbar-toggler right-collapsed" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		</div>
		<div class="nav navbar-nav right-nav-collapsed">
			<?php if (isset($_SESSION['user_role'])) { ?>
			<ul class="navbar-nav right-collapsed">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <?php echo $_SESSION['username']; ?> <b class="caret"></b></a>
					<div class="dropdown-menu user-menu-collapsed dropdown-menu-right">
						<?php if ($_SESSION['user_role'] == 'admin') { ?>
							<a class="dropdown-item" href="admin"><i class="fa fa-fw fa-user-secret"></i> Admin</a>
							<div class="dropdown-divider"></div>
						<?php } ?>
							<a class="dropdown-item" href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
							<a class="dropdown-item" href="my_posts.php"><i class="fa fa-fw fa-file-text"></i> My Posts</a>
							<a class="dropdown-item" href="my_posts.php?s=add_post"><i class="fa fa-fw fa-plus"></i> Add Post</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
					</div>
				</li>
			</ul>
			<?php } else { ?>
			<ul class="nav navbar-nav right-collapsed">
				<li class="nav-item"><a class="f-r nav-link" href="registration.php"><i class="fa fa-key"></i> Register</a></li>
			</ul>
			<?php } ?>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav cat-nav">
				<?php 
				$query = "SELECT * FROM categories";
				$select_all_categories_query = mysqli_query($connection, $query);
				while($row = mysqli_fetch_assoc($select_all_categories_query)) {
					$cat_id = $row['cat_id'];
					$cat_title = $row['cat_title'];
					echo "<li class='nav-item cat-nav-item'><a class='nav-link' href='category.php?category=$cat_id'><div>{$cat_title}</div></a></li>";
				}
				?>
			</ul>
			<?php if (isset($_SESSION['user_role'])) { ?>
				<ul class="navbar-nav right">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <?php echo $_SESSION['username']; ?> <b class="caret"></b></a>
						<div class="dropdown-menu user-menu dropdown-menu-right">
							<?php if ($_SESSION['user_role'] == 'admin') { ?>
								<a class="dropdown-item" href="admin"><i class="fa fa-fw fa-user-secret"></i> Admin</a>
								<div class="dropdown-divider"></div>
							<?php } ?>
								<a class="dropdown-item" href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
								<a class="dropdown-item" href="my_posts.php"><i class="fa fa-fw fa-file-text"></i> My Posts</a>
								<a class="dropdown-item" href="my_posts.php?s=add_post"><i class="fa fa-fw fa-plus"></i> Add Post</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
						</div>
					</li>
				</ul>
				<?php } else { ?>
				<ul class="nav navbar-nav right">
					<li class="nav-item"><a class="f-r nav-link" href="registration.php"><i class="fa fa-key"></i> Register</a></li>
				</ul>
				<?php } ?>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container -->
	</nav>











