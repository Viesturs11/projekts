<?php // This file is the place to store all basic functions 

function confirm_query($result_set) {
  if (!$result_set) {
    die("Die motherfucker");
  }
}
function get_all_subjects() {
  global $mysqli;
  $query = "SELECT *  
  FROM subjects 
  ORDER BY position ASC";
  $subject_set = $mysqli -> query($query);
  confirm_query($subject_set);
  return $subject_set;
}

function get_pages_for_subjects($subject_id) {
  global $mysqli;
$query = "SELECT * 
FROM pages 
Where subject_id = {$subject_id} 
ORDER BY position ASC";
$page_set = $mysqli -> query($query);
confirm_query($page_set);
return $page_set;


}

function get_subject_by_id($subject_id) {
  global $mysqli;
  $query = "SELECT * ";
  $query .= "FROM subjects ";
  $query .= "WHERE id=" . $subject_id ." ";
  $query .= "LIMIT 1";
  $result_set = $mysqli->query($query);
  confirm_query($result_set);
  //REMEBER:
  //if no rows are returned, fetch_array will return false
  if ($subject = mysqli_fetch_array($result_set)) {
    return $subject;
  } else {
    return NULL;
  }
}

function get_page_by_id($page_id) {
  global $mysqli;
  $query = "SELECT * ";
  $query .= "FROM pages ";
  $query .= "WHERE id=" . $page_id ." ";
  $query .= "LIMIT 1";
  $result_set = $mysqli->query($query);
  confirm_query($result_set);
  //REMEBER:
  //if no rows are returned, fetch_array will return false
  if ($page = mysqli_fetch_array($result_set)) {
    return $page;
  } else {
    return NULL;
  }
}
?>

