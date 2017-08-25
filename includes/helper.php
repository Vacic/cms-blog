<?php 
	function buildArray($query) {

		global $connection;
		$result = mysqli_query($connection, $query);
		$array = array();
		if (!empty($result)) {
			while ($row = mysqli_fetch_assoc($result)) {
				$array[] = $row;
			}
		}
		if (!empty(mysqli_error($connection))) {
			die("Query Failed " . mysqli_error($connection));
		}
		return $array;
	}

	function redirect($location) {
		header("Location: " . $location);
	}

	function deBug($data, $die = false) {
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		if ($die) {
			die();
		}
	}

function confirmQuery($result) {
	global $connection;
	if(!$result) {
		die("QUERY FAILED ." . mysqli_error($connection));
	}
}

function insert_categories() {
	global $connection;
	if(isset($_POST['submit'])) {

		$cat_title = $_POST['cat_title'];

		if($cat_title == "" || empty($cat_title)) {
			echo "This field should not be empty";

		} else {
			$query = "INSERT INTO categories(cat_title) ";
			$query .= "VALUE('{$cat_title}') ";
			$create_category_query = mysqli_query($connection, $query);
			if(!$create_category_query) {
				die('QUERY FAILED' . mysqli_error($connection));
			}
		}
	}
}

function findAllCategories() {
	global $connection;
	$query = "SELECT * FROM categories";
	$select_categories = mysqli_query($connection, $query);

	while($row = mysqli_fetch_assoc($select_categories)) {
		$cat_id = $row['cat_id'];
		$cat_title = $row['cat_title'];

		echo "<tr>";
		echo "<td>{$cat_id}</td>";
		echo "<td>{$cat_title}</td>";
		echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
		echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
		echo "</tr>";
	}
}

function deleteCategories() {
	global $connection;
	if(isset($_GET['delete'])){
		$the_cat_id = $_GET['delete'];
		$query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
		$delete_query = mysqli_query($connection, $query);
		header("Location: categories.php");
	}
}

function comment_img($author) {
	global $connection;
	$query = "SELECT user_image FROM users WHERE username = '$author'";
	$result = buildArray($query);
	foreach ($result as $key => $res) {
		$img = $res['user_image'];
	}
	return $img;
}

function users_online() {
	global $connection;
	$session = session_id();
	$time = time();
	$time_out_in_seconds = 60;
	$time_out = $time - $time_out_in_seconds;

	$query = "SELECT * FROM users_online WHERE session = '$session' ";
	$send_query = mysqli_query($connection, $query);
	$count = mysqli_num_rows($send_query);

	if ($count == NULL) {
		mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time') ");
	} else {
		mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session' ");
	}
	$users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out' ");
	return $count_user = mysqli_num_rows($users_online_query);
}

function pagination($link, $parameter=false) {
	global $count;
	global $per_page;
	global $page;
	if(!isset($_GET['page'])) $first = true; else $first = false;
		echo "<nav><ul class='pagination mt-4 justify-content-center'>";
		for($i = 1; $i <= $count; $i++) {
			if ($i == $page) {
				echo "<li class='page-item active'><a class='page-link' href='{$link}.php?page=$i{$parameter}'>$i</a></li>";
			} elseif($first == true) {
				echo "<li class='page-item active'><a class='page-link' href='{$link}.php?page=$i{$parameter}'>$i</a></li>";
				$first = false;
			} else {
				echo "<li class='page-item'><a class='page-link' href='{$link}.php?page=$i{$parameter}'>$i</a></li>";
			}
		}
	echo "</ul></nav>";
}

function clean_string($string) {
	global $connection;
	return mysqli_real_escape_string($connection, $string);
}

function limit_content($string, $char) {
	$string = (strlen($string) > $char) ? substr($string,0,$char-3).'...' : $string;
	return $string;
}