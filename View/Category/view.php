<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category-View</title>
</head>
<body>
    <?php 
        $categories = $this->getCategories();
    ?>
    <button type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('add'); ?>'); Ajax.load();">Add-Category</button>
    <form method="POST" id="viewCategory" action="">
    <table border="1px" cellpadding="4" width="100%">
        <tr>
            <th>id</th>
            <th>id</th>
            <th>name</th>
            <th>description</th>
            <th>url_key</th>
            <th>status</th>
            <th>Action</th>
        </tr>
        <?php foreach ($categories as $key => $category) :?>
        <tr>
            <td><input type="checkbox" name="multipleDelete[]" value="<?php echo $category->id; ?>"></td>
            <td><?php echo $category->id; ?></td>
            <td><?php echo $category->name; ?></td>
            <td><?php echo $category->description;?></td>
            <td><?php echo $category->url_key;?></td>
            <td><?php echo $category->status;?></td>
            <td>
                <button type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('edit', null, ['i'=>$category->id]);?>'); Ajax.load();">UPDATE</button>
                <button type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('delete', null, ['i'=>$category->id]);?>'); Ajax.load();">DELETE</button>
            </td>
        </tr>
        <?php endforeach ?>
    </table>
    </form>
    <input type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('delete'); ?>'); Ajax.setForm('viewCategory'); Ajax.saveForm();" value="DELETE">
</body>
</html>