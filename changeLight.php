<?PHP

include("config.php");

$status = $_GET['status'];
exec('sudo -u www-data python ' . $python_script_path . ' ' . $status);

?>
