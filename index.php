<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start(); ?>

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
  <?php if (!is_null($sel_subject)) { //subject selected ?>
<h2><?php echo $sel_subject['menu_name']; ?></h2>
<?php } elseif (!is_null($sel_page)) { //page selected ?>
  <h2><?php echo $sel_page['menu_name']; ?></h2>
  <?php } else { // nothing selected ?>
  	<?php
  	
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			echo '<h2>You can make migration</h2>';
		} else {
			echo '<h2>For special functionality, please login.</h2>';
		}
  	?>
    
<?php }?>

</td>
</tr>
</table>
<?php require("includes/footer.php"); ?>
