<section class="jumbotron text-center">
    <div class="container">	
        <h1 class="jumbotron-heading"><i class="fa fa-shopping-bag"></i>LISTING-VIEW</h1>
        <p class="lead text-muted mb-0"></p>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="category.html">Category</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sub-category</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div id="content">
<?php
	$children = $this->getAllChild();
	// echo "<pre>";
	// print_r($children);
	// die();
	foreach ($children as $child) {
		echo $child->toHtml();
	}
?>

</div>