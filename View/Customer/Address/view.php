
<?php $addresses = $this->getAddress();?>
<button type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('grid', 'customer');?>');Ajax.load();">View</button>
<br>
<button type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('add',null , ['i'=>$this->user]);?>');Ajax.load();">Add-Customer</button>
<form method="POST" id="viewAddress" action="">
	<table width="100%" border="1px" cellpadding="4">
		<tr>
			<th>id</th>
			<th>addressLine1</th>
			<th>addressLine2</th>
			<th>state</th>
			<th>Country</th>
			<th>ZipCord</th>
			<th>Action</th>
		</tr>
			<?php if($addresses == null):?>
				<td colspan="5">No Record</td>
			<?php else:?>
				<?php foreach($addresses as $key => $address):?>
		<tr>
			<td><input type="checkbox" name="multipleDelete[]" value="<?php echo $address->id?>"></td>
			<td><?php echo $address->addressLine1?></td>
			<td><?php echo $address->addressLine2?></td>
			<td><?php echo $address->state?></td>
			<td><?php echo $address->contry?></td>
			<td><?php echo $address->zipCode;?></td>
			<td>
                <button type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('edit', null , ['i'=>$this->user, 'id'=>$address->id]);?>'); Ajax.load();">UPDATE</button>
                <button type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('delete', null , ['i'=>$this->user, 'id'=>$address->id]);?>'); Ajax.load();">DELETE</button>
			</td>
		</tr>
				<?php endforeach;?> 
			<?php endif;?>
	</table>
    <input type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('delete', null, ['i'=>$this->user])?>'); Ajax.setForm('viewAddress'); Ajax.saveForm();" value="DELETE" >
</form>