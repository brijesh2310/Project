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
$product_delete = new product_delete();

// Run the page
$product_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$product_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproductdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fproductdelete = currentForm = new ew.Form("fproductdelete", "delete");
	loadjs.done("fproductdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $product_delete->showPageHeader(); ?>
<?php
$product_delete->showMessage();
?>
<form name="fproductdelete" id="fproductdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="product">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($product_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($product_delete->product_id->Visible) { // product_id ?>
		<th class="<?php echo $product_delete->product_id->headerCellClass() ?>"><span id="elh_product_product_id" class="product_product_id"><?php echo $product_delete->product_id->caption() ?></span></th>
<?php } ?>
<?php if ($product_delete->product_code->Visible) { // product_code ?>
		<th class="<?php echo $product_delete->product_code->headerCellClass() ?>"><span id="elh_product_product_code" class="product_product_code"><?php echo $product_delete->product_code->caption() ?></span></th>
<?php } ?>
<?php if ($product_delete->product_name->Visible) { // product_name ?>
		<th class="<?php echo $product_delete->product_name->headerCellClass() ?>"><span id="elh_product_product_name" class="product_product_name"><?php echo $product_delete->product_name->caption() ?></span></th>
<?php } ?>
<?php if ($product_delete->product_price->Visible) { // product_price ?>
		<th class="<?php echo $product_delete->product_price->headerCellClass() ?>"><span id="elh_product_product_price" class="product_product_price"><?php echo $product_delete->product_price->caption() ?></span></th>
<?php } ?>
<?php if ($product_delete->product_img->Visible) { // product_img ?>
		<th class="<?php echo $product_delete->product_img->headerCellClass() ?>"><span id="elh_product_product_img" class="product_product_img"><?php echo $product_delete->product_img->caption() ?></span></th>
<?php } ?>
<?php if ($product_delete->product_desc->Visible) { // product_desc ?>
		<th class="<?php echo $product_delete->product_desc->headerCellClass() ?>"><span id="elh_product_product_desc" class="product_product_desc"><?php echo $product_delete->product_desc->caption() ?></span></th>
<?php } ?>
<?php if ($product_delete->subcategory_name->Visible) { // subcategory_name ?>
		<th class="<?php echo $product_delete->subcategory_name->headerCellClass() ?>"><span id="elh_product_subcategory_name" class="product_subcategory_name"><?php echo $product_delete->subcategory_name->caption() ?></span></th>
<?php } ?>
<?php if ($product_delete->category_name->Visible) { // category_name ?>
		<th class="<?php echo $product_delete->category_name->headerCellClass() ?>"><span id="elh_product_category_name" class="product_category_name"><?php echo $product_delete->category_name->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$product_delete->RecordCount = 0;
$i = 0;
while (!$product_delete->Recordset->EOF) {
	$product_delete->RecordCount++;
	$product_delete->RowCount++;

	// Set row properties
	$product->resetAttributes();
	$product->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$product_delete->loadRowValues($product_delete->Recordset);

	// Render row
	$product_delete->renderRow();
?>
	<tr <?php echo $product->rowAttributes() ?>>
<?php if ($product_delete->product_id->Visible) { // product_id ?>
		<td <?php echo $product_delete->product_id->cellAttributes() ?>>
<span id="el<?php echo $product_delete->RowCount ?>_product_product_id" class="product_product_id">
<span<?php echo $product_delete->product_id->viewAttributes() ?>><?php echo $product_delete->product_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($product_delete->product_code->Visible) { // product_code ?>
		<td <?php echo $product_delete->product_code->cellAttributes() ?>>
<span id="el<?php echo $product_delete->RowCount ?>_product_product_code" class="product_product_code">
<span<?php echo $product_delete->product_code->viewAttributes() ?>><?php echo $product_delete->product_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($product_delete->product_name->Visible) { // product_name ?>
		<td <?php echo $product_delete->product_name->cellAttributes() ?>>
<span id="el<?php echo $product_delete->RowCount ?>_product_product_name" class="product_product_name">
<span<?php echo $product_delete->product_name->viewAttributes() ?>><?php echo $product_delete->product_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($product_delete->product_price->Visible) { // product_price ?>
		<td <?php echo $product_delete->product_price->cellAttributes() ?>>
<span id="el<?php echo $product_delete->RowCount ?>_product_product_price" class="product_product_price">
<span<?php echo $product_delete->product_price->viewAttributes() ?>><?php echo $product_delete->product_price->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($product_delete->product_img->Visible) { // product_img ?>
		<td <?php echo $product_delete->product_img->cellAttributes() ?>>
<span id="el<?php echo $product_delete->RowCount ?>_product_product_img" class="product_product_img">
<span<?php echo $product_delete->product_img->viewAttributes() ?>><?php echo $product_delete->product_img->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($product_delete->product_desc->Visible) { // product_desc ?>
		<td <?php echo $product_delete->product_desc->cellAttributes() ?>>
<span id="el<?php echo $product_delete->RowCount ?>_product_product_desc" class="product_product_desc">
<span<?php echo $product_delete->product_desc->viewAttributes() ?>><?php echo $product_delete->product_desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($product_delete->subcategory_name->Visible) { // subcategory_name ?>
		<td <?php echo $product_delete->subcategory_name->cellAttributes() ?>>
<span id="el<?php echo $product_delete->RowCount ?>_product_subcategory_name" class="product_subcategory_name">
<span<?php echo $product_delete->subcategory_name->viewAttributes() ?>><?php echo $product_delete->subcategory_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($product_delete->category_name->Visible) { // category_name ?>
		<td <?php echo $product_delete->category_name->cellAttributes() ?>>
<span id="el<?php echo $product_delete->RowCount ?>_product_category_name" class="product_category_name">
<span<?php echo $product_delete->category_name->viewAttributes() ?>><?php echo $product_delete->category_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$product_delete->Recordset->moveNext();
}
$product_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $product_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$product_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$product_delete->terminate();
?>