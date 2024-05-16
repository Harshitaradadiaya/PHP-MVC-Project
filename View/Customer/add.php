<?php $customer = $this->getCustomer();?>
<button type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('grid');?>');Ajax.load();">View</button>
<form action="" id="addCustomer" method="POST">
	<table border="1px" cellpadding="4" width="100%">
		<tr>
            <td>firstName</td>
            <td><input type="text" name="customer[firstName]" value="<?php echo $customer->firstName;?>"></td>
        </tr>
        <tr>
            <td>lastName</td>
            <td><input type="text" name="customer[lastName]" value="<?php echo $customer->lastName;?>"></td>
        </tr>
        <tr>
            <td>email</td>
            <td><input type="text" name="customer[email]" value="<?php echo $customer->email;?>"></td>
        </tr>
        <tr>
            <td>phoneNumber</td>
            <td><input type="text" name="customer[phoneNumber]" value="<?php echo $customer->phoneNumber;?>"></td>
        </tr>
        <tr>
            <td>password</td>
            <td><input type="password" name="customer[password]" value="<?php echo $customer->password;?>"></td>
        </tr>
	</table>
	<input type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('save', null, ['i'=> $customer->id]);?>'); Ajax.setForm('addCustomer'); Ajax.saveForm();" value="submit" >
</form>