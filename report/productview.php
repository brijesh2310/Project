<?php
namespace PHPMaker2020\project1;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$product_view = new product_view();

// Run the page
$product_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$product_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$product_view->isExport()) { ?>
<script>
var fproductview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fproductview = currentForm = new ew.Form("fproductview", "view");
	loadjs.done("fproductview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$product_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $product_view->ExportOptions->render("body") ?>
<?php $product_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $product_view->showPageHeader(); ?>
<?php
$product_view->showMessage();
?>
<form name="fproductview" id="fproductview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="product">
<input type="hidden" name="modal" value="<?php echo (int)$product_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($product_view->product_id->Visible) { // product_id ?>
	<tr id="r_product_id">
		<td class="<?php echo $product_view->TableLeftColumnClass ?>"><span id="elh_product_product_id"><?php echo $product_view->product_id->caption() ?></span></td>
		<td data-name="product_id" <?php echo $product_view->product_id->cellAttributes() ?>>
<span id="el_product_product_id">
<span<?php echo $product_view->product_id->viewAttributes() ?>><?php echo $product_view->product_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($product_view->product_code->Visible) { // product_code ?>
	<tr id="r_product_code">
		<td class="<?php echo $product_view->TableLeftColumnClass ?>"><span id="elh_product_product_code"><?php echo $product_view->product_code->caption() ?></span></td>
		<td data-name="product_code" <?php echo $product_view->product_code->cellAttributes() ?>>
<span id="el_product_product_code">
<span<?php echo $product_view->product_code->viewAttributes() ?>><?php echo $product_view->product_code->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($product_view->product_name->Visible) { // product_name ?>
	<tr id="r_product_name">
		<td class="<?php echo $product_view->TableLeftColumnClass ?>"><span id="elh_product_product_name"><?php echo $product_view->product_name->caption() ?></span></td>
		<td data-name="product_name" <?php echo $product_view->product_name->cellAttributes() ?>>
<span id="el_product_product_name">
<span<?php echo $product_view->product_name->viewAttributes() ?>><?php echo $product_view->product_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($product_view->product_price->Visible) { // product_price ?>
	<tr id="r_product_price">
		<td class="<?php echo $product_view->TableLeftColumnClass ?>"><span id="elh_product_product_price"><?php echo $product_view->product_price->caption() ?></span></td>
		<td data-name="product_price" <?php echo $product_view->product_price->cellAttributes() ?>>
<span id="el_product_product_price">
<span<?php echo $product_view->product_price->viewAttributes() ?>><?php echo $product_view->product_price->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($product_view->product_img->Visible) { // product_img ?>
	<tr id="r_product_img">
		<td class="<?php echo $product_view->TableLeftColumnClass ?>"><span id="elh_product_product_img"><?php echo $product_view->product_img->caption() ?></span></td>
		<td data-name="product_img" <?php echo $product_view->product_img->cellAttributes() ?>>
<span id="el_product_product_img">
<span<?php echo $product_view->product_img->viewAttributes() ?>><?php echo $product_view->product_img->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($product_view->product_desc->Visible) { // product_desc ?>
	<tr id="r_product_desc">
		<td class="<?php echo $product_view->TableLeftColumnClass ?>"><span id="elh_product_product_desc"><?php echo $product_view->product_desc->caption() ?></span></td>
		<td data-name="product_desc" <?php echo $product_view->product_desc->cellAttributes() ?>>
<span id="el_product_product_desc">
<span<?php echo $product_view->product_desc->viewAttributes() ?>><?php echo $product_view->product_desc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($product_view->subcategory_name->Visible) { // subcategory_name ?>
	<tr id="r_subcategory_name">
		<td class="<?php echo $product_view->TableLeftColumnClass ?>"><span id="elh_product_subcategory_name"><?php echo $product_view->subcategory_name->caption() ?></span></td>
		<td data-name="subcategory_name" <?php echo $product_view->subcategory_name->cellAttributes() ?>>
<span id="el_product_subcategory_name">
<span<?php echo $product_view->subcategory_name->viewAttributes() ?>><?php echo $product_view->subcategory_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($product_view->category_name->Visible) { // category_name ?>
	<tr id="r_category_name">
		<td class="<?php echo $product_view->TableLeftColumnClass ?>"><span id="elh_product_category_name"><?php echo $product_view->category_name->caption() ?></span></td>
		<td data-name="category_name" <?php echo $product_view->category_name->cellAttributes() ?>>
<span id="el_product_category_name">
<span<?php echo $product_view->category_name->viewAttributes() ?>><?php echo $product_view->category_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$product_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$product_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$product_view->terminate();
?>