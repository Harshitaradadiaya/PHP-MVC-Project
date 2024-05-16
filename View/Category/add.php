
<?php $category = $this->getCategory(); ?>
<?php $categories = $this->getCategories();?>
<button type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('grid');?>'); Ajax.load();">View</button>
<form method="POST" id="addCategory" action="">
    <table border="1px" cellpadding="4" width="100%">
        <tr>
            <td>Choose Parent Category</td>
            <td>
                <select name=category[parentCategory] multiple>
                    <?php foreach ($categories as $key => $value): ?>
                    <option value="<?php echo $key; ?>" <?php echo ($category->id == $key)? 'DISABLED': '';?> 
                    <?php echo ($category->parentCategory == $key)? 'SELECTED': '';?>>
                        <?php echo $value; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>name</td>
            <td><input type="text" name="category[name]" value="<?php echo $category->name; ?>"></td>
        </tr>
        <tr>
            <td>description</td>
            <td><input type="text" name="category[description]" value="<?php echo $category->description; ?>"></td>
        </tr>
        <tr>
            <td>url_key</td>
            <td><input type="text" name="category[url_key]" value="<?php echo $category->url_key; ?>"></td>
        </tr>
        <tr>
            <td>status</td>
            <td>
                <select name="category[status]">
                <?php foreach($this->getCategory()->getStatusOption() as $key => $option):?>
                    <option value="<?php echo $key;?>" <?php echo ($category->status == $key)? 'SELECTED': '';?>><?php echo $option;?></option>    
                <?php endforeach;?>
            </select></td>
        </tr>
        <tr>
            <td><input type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('save', null, ['i'=>$category->id]); ?>'); Ajax.setForm('addCategory'); Ajax.saveForm();" value="submit"></td>
        </tr>
    </table>
</form>
