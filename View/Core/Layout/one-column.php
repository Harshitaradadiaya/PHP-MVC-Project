<!DOCTYPE html>
<html>
<head>
	<title>One-Column</title>
	<script type="text/javascript" src="skin/admin/js/core/jquery-3.4.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript" src="skin/admin/js/ajax.js" ></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<!-- <link rel="stylesheet" type="text/css" href="skin/admin/css/list-style.css"> -->
</head>
<body>
	<script type="text/javascript" src="skin/admin/js/core/jquery-3.4.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="skin/admin/css/list_style.css">

<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-heading">
    	<?php echo $this->getChild('header')->toHtml();?>
    </div>
    <div class="panel-body">
    	<?php echo $this->getChild('content')->toHtml();?>
    </div>
    <div class="panel-footer">
    	<?php echo $this->getChild('footer')->toHtml();?>
    </div>
  </div>
</div>

</body>
</html>