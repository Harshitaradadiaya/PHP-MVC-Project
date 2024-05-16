<!DOCTYPE html>
<html>
<head>
	<title>View</title>
</head>
<body>
	<?php $methods = $this->getMethods();?>
	<a href="<?php echo $this->getUrl('add');?>">Add Method</a>
	<form method="POST" action="<?php echo $this->getUrl('delete');?>">
		<table cellpadding="4" border="1" width="100%">
			<tr>
				<th>id</th>
				<th>Name</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
			<?php if (!$methods) :?>
				<tr>
					<td colspan="3">NO RECORD</td>
				</tr>
			<?php else: ?>
			<?php foreach($methods as $key => $value) :?>
				<tr>
					<td><input type="checkbox" name="multipleDelete[]" value="<?php echo $value->id;?>"></td>
					<td><?php echo $value->name;?></td>
					<td><?php echo $value->status;?></td>
					<td>
						<a href="<?php echo $this->getUrl('edit', null, ['i' => $value->id]);?>">UPDATE</a>
						<a href="<?php echo $this->getUrl('delete', null, ['i' => $value->id]);?>">DELETE</a>
					</td>
				</tr>
			<?php endforeach;?>
			<?php endif;?>
		</table>
		<input type="submit" value="DELETE">
	</form>
</body>
</html>