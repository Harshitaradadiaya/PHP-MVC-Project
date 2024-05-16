<!DOCTYPE html>
<html>
<head>
	<title>Media-Gallery</title>
</head>
<body>
	<?php 
		$product = $this->getProduct();
		$images = $this->getProductImages();
	?>
	<a href="<?php echo $this->getUrl('view','product');?>">View</a>
	<h1>Media Gallery</h1>
	<form method="POST" action="<?php echo $this->getUrl('changeMedia', null , ['i' => $product->id]);?>">
		<table width="100%" border="1" style="text-align: center;">
			<tr>
				<th>Image</th>
				<th>Thumbnail</th>
				<th>Small</th>
				<th>Base</th>
				<th>Exclude From Media</th>
				<th>Action</th>
			</tr>
			<?php if (!$images) :?>
				<tr>
					<td colspan="6">NO RECORDS</td>
				</tr>
			<?php else: ?>
			<?php foreach($images as $key => $value) :?>
			<tr>
				<td>
					<img alt="Not Available" src="<?php echo 'Media/Catalogue/Product/'.$value->name;?>" width="50px" height="50px">
				</td>
				<td>
					<input type="radio" name="ImageStatus[baseImage]" value="<?php echo $value->id;?>" <?php echo ($product->baseImage == $value->id) ? 'checked' : ''; ?>>
				</td>
				<td>
					<input type="radio" name="ImageStatus[thumbImage]" value="<?php echo $value->id;?>" <?php echo ($product->thumbImage == $value->id) ? 'checked' : ''; ?>>
				</td>
				<td>
					<input type="radio" name="ImageStatus[smallImage]" value="<?php echo $value->id;?>" <?php echo ($product->smallImage == $value->id) ? 'checked' : ''; ?>>
				</td>
				<td>
					<input type="checkbox" name="excludeStatus[]" value="<?php echo $value->id;?>" <?php echo ($value->excludeImageStatus == 1) ? 'checked' : ''; ?>>
				</td>
				<td><a href="<?php echo $this->getUrl('deleteImage',null,['id' => $product->id, 'i' => $value->id]); ?>">DELETE</a></td>
			</tr>
			<?php endforeach;?>
			<?php endif;?>
		</table>
		<input type="submit" name="Update">
	</form>

	<fieldset>
		<legend>Browse Image</legend>
		<form action="<?php echo $this->getUrl('saveImage', null, ['i'=>$product->id]);?>" method="POST" enctype="multipart/form-data">
			<input type="file" name="image">
			<input type="submit" name="Upload">
		</form>
	</fieldset>
</body>
</html>