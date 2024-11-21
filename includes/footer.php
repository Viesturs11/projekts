<?php
session_start();  // Start the session to track login status

?>

</div>
<div id="footer">Copyright <?php echo date('Y'); ?>, Widget Copr</div>

</body>
</html>
<?php //5. Close connection
if (isset($connection)) {
$mysqli -> close();
}
?>
