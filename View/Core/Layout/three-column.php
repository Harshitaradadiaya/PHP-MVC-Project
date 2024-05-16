<!DOCTYPE html>
<html>
<head>
	<title>Three-Column</title>
	<script src="skin/admin/js/core/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="skin/admin/js/ajax.js" ></script>
</head>
<body>
	<table width="100%" cellpadding="4" border="1">
		<tr>
			<td height="100px" colspan="3">
				<?php echo $this->getChild('header')->toHtml();?>
			</td>
		</tr>
		<tr>
			<td height="400px" width="50px">
				<?php echo $this->getChild('left')->toHtml();?>
			</td>
			<td height="400px">
				<?php echo $this->getChild('content')->toHtml();?>
			</td>
			<td height="400px" width="50px">
				<?php echo $this->getChild('right')->toHtml();?>
			</td>
		</tr>
		<tr>
			<td height="100px" colspan="3">
				<?php echo $this->getChild('footer')->toHtml();?>
			</td>
		</tr>
	</table>
</body>
</html>