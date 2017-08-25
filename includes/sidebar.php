<!-- Blog Sidebar Widgets Column -->
<div class="<?php echo isset($mp)?'col-xl-4':'col-lg-4';?> pt-4">
	<!-- Blog Search Well -->
	<div class="card">
		<div class="card-block">
			<h4 class="card-title">Search</h4>
			<form action="search.php" method="get">
				<div class="input-group">
					<input name="search" type="text" class="form-control">
					<button name="" class="input-group-addon" type="submit">
						<i class="fa fa-search"></i>
					</button>
				</div>
			</form><!-- search form -->
			<!-- /.input-group -->
		</div>
	</div>
	<span class="p-3"></span>
	<!-- Login -->
	<?php if(!isset($_SESSION['username'])): ?>
	<div class="card">
		<div class="card-block pt-3">
			<h4 class="card-title">Login</h4>
			<form action="includes/login.php" method="post">
				<div class="form-group">
					<input name="username" type="text" class="form-control" placeholder="Enter Username">
				</div>
				<div class="form-group">
					<input name="password" type="password" class="form-control" placeholder="Enter Password">
					<span class="input-group-btn pt-3">
						<button class="btn btn-primary" name="login" type="submit">Submit
						</button>
					</span>
				</div>
			</form><!-- search form -->
			<!-- /.input-group -->
		</div>
	</div>
	<?php endif; ?>
	<span class="p-3"></span>
	<!-- Blog Categories Well -->
	<div class="card">
		<div class="card-block">
			<?php
			$query = "SELECT * FROM categories";
			$select_categories_sidebar = mysqli_query($connection, $query);
			?>
			<h4 class="card-title">Blog Categories</h4>
			<ul class="list-unstyled card-text">
				<?php while($row = mysqli_fetch_assoc($select_categories_sidebar)) {
					$cat_title = $row['cat_title'];
					$cat_id = $row['cat_id'];

					echo "<li><a class='card-link' href='category.php?category=$cat_id'>{$cat_title}</a></li>";
				}?>
			</ul>
		</div>
	</div>
	<span class="p-3"></span>
	<div class="card">
		<div class="card-block">
			<h4 class="card-title">Side Widget Well</h4>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
		</div>
	</div>
</div>