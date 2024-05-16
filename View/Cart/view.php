<?php 
if (isset($_SESSION['customerId'])) { 
	$cartItems = $this->getCartItems();
} else {
	$cartItems = null;
}
?>
<div class="col-5 col-md-2 col-lg-4">
<table class="table table-striped">
	<tr>
		<th>Name</th>
		<th>Price</th>
		<th>Qty</th>
		<th>Total</th>
		<th>Action</th>
	</tr>
	<?php if (empty($cartItems)) :?>
	<td>-</td>
	<td>-</td>
	<td>-</td>
	<td>-</td>
	<td>-</td>
	<?php else :?>
	<?php foreach ($cartItems as $key => $cartItem): ?>
		<tr>
			<td><?php echo $cartItem['productName']?></td>
			<td><?php echo $cartItem['productPrice']?></td>
			<td><?php echo $cartItem['quantity']?></td>
			<td><?php4echo $cartItem['total']?></td>
			<td><a href="<?php echo $cartItem['id']?>">DELETE</a></td>
		</tr>
	<?php endforeach; ?>
	<?php endif; ?>
</table>
