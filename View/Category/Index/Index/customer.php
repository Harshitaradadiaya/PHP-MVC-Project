<br>
<?php $customers = $this->getCustomers();?>

<table class="table table-striped">
	<tr>
		<th>Customer</th>
		<th>SELECT</th>
	</tr>
	<?php foreach ($customers as $key => $customer): ?>
	<tr>
		<td><?php echo $customer->firstName.' '.$customer->lastName;?></td>
		<td><button type="button">SELECT</button></td>
	</tr>
	<?php endforeach ?>
</table>
</div>