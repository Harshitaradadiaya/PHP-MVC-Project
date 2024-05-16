<table border="1" width="100%" cellpadding="4">
<?php $children = $this->getAllChild(); ?>
<?php if ($children) : ?>
<?php foreach ($children as $key => $child): ?>
		<td>
		<?php echo $child->toHtml(); ?>
		</td>
<?php endforeach;?>
<?php endif;?>

</table>