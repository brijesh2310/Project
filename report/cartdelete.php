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
$cart_delete = new cart_delete();

// Run the page
$cart_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cart_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcartdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcartdelete = currentForm = new ew.Form("fcartdelete", "delete");
	loadjs.done("fcartdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $cart_delete->showPageHeader(); ?>
<?php
$cart_delete->showMessage();
?>
<form name="fcartdelete" id="fcartdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cart">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($cart_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($cart_delete->id->Visible) { // id ?>
		<th class="<?php echo $cart_delete->id->headerCellClass() ?>"><span id="elh_cart_id" class="cart_id"><?php echo $cart_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($cart_delete->product_id->Visible) { // product_id ?>
		<th class="<?php echo $cart_delete->product_id->headerCellClass() ?>"><span id="elh_cart_product_id" class="cart_product_id"><?php echo $cart_delete->product_id->caption() ?></span></th>
<?php } ?>
<?php if ($cart_delete->quantity->Visible) { // quantity ?>
		<th class="<?php echo $cart_delete->quantity->headerCellClass() ?>"><span id="elh_cart_quantity" class="cart_quantity"><?php echo $cart_delete->quantity->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$cart_delete->RecordCount = 0;
$i = 0;
while (!$cart_delete->Recordset->EOF) {
	$cart_delete->RecordCount++;
	$cart_delete->RowCount++;

	// Set row properties
	$cart->resetAttributes();
	$cart->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$cart_delete->loadRowValues($cart_delete->Recordset);

	// Render row
	$cart_delete->renderRow();
?>
	<tr <?php echo $cart->rowAttributes() ?>>
<?php if ($cart_delete->id->Visible) { // id ?>
		<td <?php echo $cart_delete->id->cellAttributes() ?>>
<span id="el<?php echo $cart_delete->RowCount ?>_cart_id" class="cart_id">
<span<?php echo $cart_delete->id->viewAttributes() ?>><?php echo $cart_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cart_delete->product_id->Visible) { // product_id ?>
		<td <?php echo $cart_delete->product_id->cellAttributes() ?>>
<span id="el<?php echo $cart_delete->RowCount ?>_cart_product_id" class="cart_product_id">
<span<?php echo $cart_delete->product_id->viewAttributes() ?>><?php echo $cart_delete->product_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cart_delete->quantity->Visible) { // quantity ?>
		<td <?php echo $cart_delete->quantity->cellAttributes() ?>>
<span id="el<?php echo $cart_delete->RowCount ?>_cart_quantity" class="cart_quantity">
<span<?php echo $cart_delete->quantity->viewAttributes() ?>><?php echo $cart_delete->quantity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$cart_delete->Recordset->moveNext();
}
$cart_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cart_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$cart_delete->showPageFooter();
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
$cart_delete->terminate();
?>