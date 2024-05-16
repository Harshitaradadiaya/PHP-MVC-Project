<!DOCTYPE html>
<html>
<head>
	<title>Layout</title>
</head>
<body>
	<table width="100%" cellpadding="4" border="1">
		<tr>
			<td height="100px">
				<?php echo $this->getChild('header')->toHtml();?>
			</td>
		</tr>
		<tr>
			<td height="400px">
				<?php echo $this->getChild('content')->toHtml();?>
			</td>
		</tr>
		<tr>
			<td height="100px">
				<?php echo $this->getChild('footer')->toHtml();?>
			</td>
		</tr>
	</table>
</body>
</html>