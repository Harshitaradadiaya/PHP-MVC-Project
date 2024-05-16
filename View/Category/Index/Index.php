
<style type="text/css">
  .sidenav {
        height: auto;
        padding: 15px;
      }
</style>

<div class="row content">
<?php echo $this->getChild('category')->toHtml();?>
<?php echo $this->getChild('product')->toHtml();?>
<?php echo $this->getChild('cart')->toHtml();?>
<?php echo $this->getChild('customer')->toHtml();?>
<!-- <div class="col-sm-3" style="background-color: pink"> -->
  
</div>
</div>