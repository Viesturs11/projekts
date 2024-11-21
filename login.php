<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php 

//echo $_GET['test'];

if (isset($_GET['subj'])) {
  $sel_subject = get_subject_by_id($_GET['subj']);
  $sel_page = NULL;
} elseif (isset($_GET['page'])) {
  $sel_subject = NULL;
  $sel_page = get_page_by_id($_GET['page']);
} else {
  $sel_subject = NULL;
  $sel_page = NULL;
}


?>
<?php include("includes/header.php"); ?>

    <table id="structure">
        <tr>
            <td id="navigation">
              <ul class="subjects">

           <?php 
//3. un 4 Perform query un use returned data
$subject_set = get_all_subjects();
while ($subject = mysqli_fetch_array($subject_set)) {
  echo "<li";

   ///var_dump(array_keys($sel_subject));
//ja no note: if(isset($sel_subject["id"]))
  if(isset($sel_subject["id"])) {
    if ($subject["id"] == $sel_subject["id"]) { echo " class=\"selected\""; }
  }
  
  echo "><a href=\"content.php?subj=" . urlencode($subject["id"]) .
  "\">{$subject["menu_name"]}</a></li>";

  $page_set = get_pages_for_subjects($subject["id"]);
 echo "<ul class=\"pages\">";
 while ($page = mysqli_fetch_array($page_set)) {
  echo "<li";
  if (isset($sel_page['ID'])) {
    if ($page["ID"] == $sel_page['ID']) 
    { echo " class=\"selected\""; }
  }
  echo "><a href=\"content.php?page=" . urlencode($page["ID"]) .
   "\">{$page["menu_name"]}</a></li>";
 }
 
 echo "</ul>";
}

//4. Use returned data
  
?>


</ul>
</td>
<td id="page">
	<?php
					if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    			echo "<h1>Login successful! Welcome, " . $_SESSION['username'] . "!</h1>";
    			echo "<a href='logout.php'>Logout</a>";  // Provide a logout link
    			?>
    				<form action="includes/migration.php" method="POST">
    					<button type="submit">Veidot migrācijas failu</button>
    				</form>
    			<?php
    			if (isset($_GET['success']) && $_GET['success'] == 2) {
        			echo "<p style='color:green;'>Migration successful!</p>";
    			}
			} else {
    			// If not logged in, display the login form or show error messages
    			if (isset($_GET['error']) && $_GET['error'] == 1) {
        			echo "<p style='color:red;'>Invalid username or password.</p>";
    			}
			
    			if (isset($_GET['success']) && $_GET['success'] == 1) {
        			echo "<p style='color:green;'>Login successful!</p>";
    			}
			
			
    			// Display the login form
    			?>
    			<form action="includes/login.php" method="POST">
        			<input type="text" name="username" placeholder="Lietotājvārds" required />
        			<input type="password" name="password" placeholder="Parole" required />
        			<button type="submit">Login</button>
    			</form>
    			<?php
			}
	?>
</td>
</tr>
</table>
<?php require("includes/footer.php"); ?>
