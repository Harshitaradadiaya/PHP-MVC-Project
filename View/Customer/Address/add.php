
<?php $address = $this->getAddress();?>
<button type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('view');?>');Ajax.load();">View</button>
<form action="" id="addAddress" method="POST">
	<table width="100%" border="1px">
		<tr>
            <td>addressLine1</td>
            <td><input type="text" name="address[addressLine1]" value="<?php echo $address->addressLine1;?>"></td>
        </tr>
        <tr>
            <td>addressLine2</td>
            <td><input type="text" name="address[addressLine2]" value="<?php echo $address->addressLine2;?>"></td>
        </tr>
        <tr>
            <td>state</td>
            <td><input type="text" name="address[state]" value="<?php echo $address->state;?>"></td>
        </tr>
        <tr>
            <td>contry</td>
            <td><input type="text" name="address[contry]" value="<?php echo $address->contry;?>"></td>
        </tr>
        <tr>
            <td>zipCode</td>
            <td><input type="text" name="address[zipCode]" value="<?php echo $address->zipCode;?>"></td>
        </tr>
	</table>
	<input type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('save', null, ['id'=>$this->user, 'i' => $address->id])?>'); Ajax.setForm('addAddress'); Ajax.saveForm();" value="submit" >
</form>