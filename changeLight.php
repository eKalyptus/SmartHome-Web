<?PHP

$status = $_GET['status'];
exec('sudo -u www-data python /home/pi/sc.py ' . $status)

?>
