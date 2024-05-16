<!DOCTYPE html>
<html>
<head>
	<title>AddMethod</title>
</head>
<body>
	<?php $method = $this->getMethod(); ?>
	<form method="POST" action="<?php echo $this->getUrl('save', null, ['i' => $method->id]);?>">
		<table border="1" cellpadding="4" border="1px">
			<tr>
				<td>Name</td>
				<td><input type="text" name="method[name]" value="<?php echo $method->name;?>"></td>
			</tr>
			<tr>
				<td>status</td>
				<td>
					<select name="method[status]">
						<option value="0" <?php echo ($method->status == 0)? 'SELECTED': '';?>>DISABLE</option>
						<option value="1" <?php echo ($method->status == 1)? 'SELECTED': '';?>>ENABLE</option>
					</select>
				</td>
			</tr>
		</table>
		<input type="submit" name="submit">
	</form>
</body>
</html>