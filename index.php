<!DOCTYPE html>
<html>

<?php

//Load language files default = gb
$lang = "gb";

if(isset($_GET['lang'])){
	$lang = $_GET['lang'];
}

$lng = json_decode(file_get_contents("lang/" . $lang . ".json"));
?>

<head>
	<meta charset="utf-8"/>
	<title>SmartHome</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/flag-icon.css">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.bundle.js"></script>
	<script>

	$(document).ready(function(){

		$('#lightsOff').click(function(){
			//alert("Turn off the lights!");

			$.ajax({
				url: "changeLight.php",
				type: "GET",
				data: "status=0",
				success: function(data){
					return false;
				}
			});
			return false;

		});

		$('#lightsOn').click(function(){
			//alert("Turn on the lights!");

			$.ajax({
				url: "changeLight.php",
				type: "GET",
				data: "status=1",
				success: function(data){
					return false;
				}
			});
			return false;

		});

	});

	</script>
</head>
<body>

	<nav class="navbar navbar-default">
	  <div class="container">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#">eKalyptus SmartHome</a>
	    </div>

	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li class="active"><a href="#"><?= $lng->navbar->dashboard ?> <span class="sr-only">(current)</span></a></li>

	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?= $lng->navbar->room_title ?> <span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="#">Room 1</a></li>
	            <li><a href="#">Room 2</a></li>
	            <li><a href="#">Room 3</a></li>
	            <li class="divider"></li>
	            <li><a href="#"><?= $lng->navbar->add_room ?></a></li>
	          </ul>
	        </li>

	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="#"><?= $lng->navbar->settings ?></a></li>

	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="flag-icon flag-icon-<?= $lang?>"></span> <span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            
		          <?php

		          $avail_lang = json_decode(file_get_contents("lang/languages.json"));
		          foreach($avail_lang->languages as $key => $cont){
		          	if($key != $lang){
		          		echo '<li><a href="?lang='.$key.'"><span class="flag-icon flag-icon-'.$key.'" style="margin-right: 10px;"></span>'.$cont.'</a></li>';
		          	}
		          }

		          ?>

	          </ul>
	        </li>

	      </ul>
	    </div>
	  </div>
	</nav>


	<div class="container">

		<h2><?= $lng->navbar->overview ?></h2>
		<div class="row">

			<div class="col-lg-4">
				<canvas id="myChart" width="200" height="200"></canvas>
			</div>
			<div class="col-lg-4">
				<canvas id="myChart2" width="200" height="200"></canvas>
			</div>
			<div class="col-lg-4">
				<canvas id="myChart3" width="200" height="200"></canvas>
			</div>
		</div>

		<h3 style="margin-top: 30px;"><?=$lng->global_actions->global_actions?></h3>
		<div class="btn-group btn-group-justified">
		  <a href="#" class="btn btn-default" id="lightsOff"><?=$lng->global_actions->light_off?></a>
		  <a href="#" class="btn btn-default" id="lightsOn"><?=$lng->global_actions->light_on?></a>
		  <a href="#" class="btn btn-default"><?=$lng->global_actions->lock_door?></a>
		  <a href="#" class="btn btn-default"><?=$lng->global_actions->unlock_door?></a>
		</div>

	</div>


</body>

<script>
	    var ctx = document.getElementById("myChart");
		var ctx = document.getElementById("myChart").getContext("2d");
		var ctx = $("#myChart");

		var data = {
    labels: ["27. <?= $lng->general->months->september ?>", "28. <?= $lng->general->months->september ?>", "29. <?= $lng->general->months->september ?>", "30. <?= $lng->general->months->september ?>", "1. <?= $lng->general->months->october ?>", "2. <?= $lng->general->months->october ?>", "3. <?= $lng->general->months->october ?>"],
    datasets: [
        {
            label: "<?= $lng->graphs->daily_temperature ?>",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "#bee6cf",
            borderColor: "#27ae60",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "#27ae60",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "#27ae60",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: [20, 19, 23, 16, 18, 20, 17],
            spanGaps: false,
        }
    ]
};

		var myLineChart = Chart.Line(ctx, {
		    data: data,
		    options: {}
		});

		var ctx2 = document.getElementById("myChart2");
		var ctx2 = document.getElementById("myChart2").getContext("2d");
		var ctx2 = $("#myChart2");

		var data2 = {
    labels: ["<?= $lng->general->months->april ?>", "<?= $lng->general->months->may ?>", "<?= $lng->general->months->june ?>", "<?= $lng->general->months->july ?>", "<?= $lng->general->months->august ?>", "<?= $lng->general->months->september ?>", "<?= $lng->general->months->october ?>"],
    datasets: [
        {
            label: "<?= $lng->graphs->monthly_temperature ?>",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(75,192,192,0.4)",
            borderColor: "rgba(75,192,192,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(75,192,192,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: [20, 23, 25, 28, 30, 22, 19],
            spanGaps: false,
        }
    ]
};

		var myLineChart2 = Chart.Line(ctx2, {
		    data: data2,
		    options: {}
		});

		var ctx3 = document.getElementById("myChart3");
		var ctx3 = document.getElementById("myChart3").getContext("2d");
		var ctx3 = $("#myChart3");

		var data3 = {
    labels: ["<?= $lng->general->months->april ?>", "<?= $lng->general->months->may ?>", "<?= $lng->general->months->june ?>", "<?= $lng->general->months->july ?>", "<?= $lng->general->months->august ?>", "<?= $lng->general->months->september ?>", "<?= $lng->general->months->october ?>"],
    datasets: [
        {
            label: "<?= $lng->graphs->sun_hours ?>",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "#f1cbb2",
            borderColor: "#d35400",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "#d35400",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "#d35400",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: [10, 10, 11, 12, 12, 11, 10],
            spanGaps: false,
        }
    ]
};

		var myLineChart3 = Chart.Line(ctx3, {
		    data: data3,
		    options: {}
		});
	</script>
</html>