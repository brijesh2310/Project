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
$payment_delete = new payment_delete();

// Run the page
$payment_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payment_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpaymentdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpaymentdelete = currentForm = new ew.Form("fpaymentdelete", "delete");
	loadjs.done("fpaymentdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $payment_delete->showPageHeader(); ?>
<?php
$payment_delete->showMessage();
?>
<form name="fpaymentdelete" id="fpaymentdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payment">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($payment_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($payment_delete->a_id->Visible) { // a_id ?>
		<th class="<?php echo $payment_delete->a_id->headerCellClass() ?>"><span id="elh_payment_a_id" class="payment_a_id"><?php echo $payment_delete->a_id->caption() ?></span></th>
<?php } ?>
<?php if ($payment_delete->o_id->Visible) { // o_id ?>
		<th class="<?php echo $payment_delete->o_id->headerCellClass() ?>"><span id="elh_payment_o_id" class="payment_o_id"><?php echo $payment_delete->o_id->caption() ?></span></th>
<?php } ?>
<?php if ($payment_delete->name->Visible) { // name ?>
		<th class="<?php echo $payment_delete->name->headerCellClass() ?>"><span id="elh_payment_name" class="payment_name"><?php echo $payment_delete->name->caption() ?></span></th>
<?php } ?>
<?php if ($payment_delete->_email->Visible) { // email ?>
		<th class="<?php echo $payment_delete->_email->headerCellClass() ?>"><span id="elh_payment__email" class="payment__email"><?php echo $payment_delete->_email->caption() ?></span></th>
<?php } ?>
<?php if ($payment_delete->mobile_no->Visible) { // mobile_no ?>
		<th class="<?php echo $payment_delete->mobile_no->headerCellClass() ?>"><span id="elh_payment_mobile_no" class="payment_mobile_no"><?php echo $payment_delete->mobile_no->caption() ?></span></th>
<?php } ?>
<?php if ($payment_delete->billing_address->Visible) { // billing_address ?>
		<th class="<?php echo $payment_delete->billing_address->headerCellClass() ?>"><span id="elh_payment_billing_address" class="payment_billing_address"><?php echo $payment_delete->billing_address->caption() ?></span></th>
<?php } ?>
<?php if ($payment_delete->shipping_address->Visible) { // shipping_address ?>
		<th class="<?php echo $payment_delete->shipping_address->headerCellClass() ?>"><span id="elh_payment_shipping_address" class="payment_shipping_address"><?php echo $payment_delete->shipping_address->caption() ?></span></th>
<?php } ?>
<?php if ($payment_delete->city->Visible) { // city ?>
		<th class="<?php echo $payment_delete->city->headerCellClass() ?>"><span id="elh_payment_city" class="payment_city"><?php echo $payment_delete->city->caption() ?></span></th>
<?php } ?>
<?php if ($payment_delete->state->Visible) { // state ?>
		<th class="<?php echo $payment_delete->state->headerCellClass() ?>"><span id="elh_payment_state" class="payment_state"><?php echo $payment_delete->state->caption() ?></span></th>
<?php } ?>
<?php if ($payment_delete->pincode->Visible) { // pincode ?>
		<th class="<?php echo $payment_delete->pincode->headerCellClass() ?>"><span id="elh_payment_pincode" class="payment_pincode"><?php echo $payment_delete->pincode->caption() ?></span></th>
<?php } ?>
<?php if ($payment_delete->payment_method->Visible) { // payment_method ?>
		<th class="<?php echo $payment_delete->payment_method->headerCellClass() ?>"><span id="elh_payment_payment_method" class="payment_payment_method"><?php echo $payment_delete->payment_method->caption() ?></span></th>
<?php } ?>
<?php if ($payment_delete->card_no->Visible) { // card_no ?>
		<th class="<?php echo $payment_delete->card_no->headerCellClass() ?>"><span id="elh_payment_card_no" class="payment_card_no"><?php echo $payment_delete->card_no->caption() ?></span></th>
<?php } ?>
<?php if ($payment_delete->expiry_date->Visible) { // expiry_date ?>
		<th class="<?php echo $payment_delete->expiry_date->headerCellClass() ?>"><span id="elh_payment_expiry_date" class="payment_expiry_date"><?php echo $payment_delete->expiry_date->caption() ?></span></th>
<?php } ?>
<?php if ($payment_delete->order_date->Visible) { // order_date ?>
		<th class="<?php echo $payment_delete->order_date->headerCellClass() ?>"><span id="elh_payment_order_date" class="payment_order_date"><?php echo $payment_delete->order_date->caption() ?></span></th>
<?php } ?>
<?php if ($payment_delete->product_name->Visible) { // product_name ?>
		<th class="<?php echo $payment_delete->product_name->headerCellClass() ?>"><span id="elh_payment_product_name" class="payment_product_name"><?php echo $payment_delete->product_name->caption() ?></span></th>
<?php } ?>
<?php if ($payment_delete->product_quantity->Visible) { // product_quantity ?>
		<th class="<?php echo $payment_delete->product_quantity->headerCellClass() ?>"><span id="elh_payment_product_quantity" class="payment_product_quantity"><?php echo $payment_delete->product_quantity->caption() ?></span></th>
<?php } ?>
<?php if ($payment_delete->product_price->Visible) { // product_price ?>
		<th class="<?php echo $payment_delete->product_price->headerCellClass() ?>"><span id="elh_payment_product_price" class="payment_product_price"><?php echo $payment_delete->product_price->caption() ?></span></th>
<?php } ?>
<?php if ($payment_delete->total_price->Visible) { // total_price ?>
		<th class="<?php echo $payment_delete->total_price->headerCellClass() ?>"><span id="elh_payment_total_price" class="payment_total_price"><?php echo $payment_delete->total_price->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$payment_delete->RecordCount = 0;
$i = 0;
while (!$payment_delete->Recordset->EOF) {
	$payment_delete->RecordCount++;
	$payment_delete->RowCount++;

	// Set row properties
	$payment->resetAttributes();
	$payment->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$payment_delete->loadRowValues($payment_delete->Recordset);

	// Render row
	$payment_delete->renderRow();
?>
	<tr <?php echo $payment->rowAttributes() ?>>
<?php if ($payment_delete->a_id->Visible) { // a_id ?>
		<td <?php echo $payment_delete->a_id->cellAttributes() ?>>
<span id="el<?php echo $payment_delete->RowCount ?>_payment_a_id" class="payment_a_id">
<span<?php echo $payment_delete->a_id->viewAttributes() ?>><?php echo $payment_delete->a_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payment_delete->o_id->Visible) { // o_id ?>
		<td <?php echo $payment_delete->o_id->cellAttributes() ?>>
<span id="el<?php echo $payment_delete->RowCount ?>_payment_o_id" class="payment_o_id">
<span<?php echo $payment_delete->o_id->viewAttributes() ?>><?php echo $payment_delete->o_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payment_delete->name->Visible) { // name ?>
		<td <?php echo $payment_delete->name->cellAttributes() ?>>
<span id="el<?php echo $payment_delete->RowCount ?>_payment_name" class="payment_name">
<span<?php echo $payment_delete->name->viewAttributes() ?>><?php echo $payment_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payment_delete->_email->Visible) { // email ?>
		<td <?php echo $payment_delete->_email->cellAttributes() ?>>
<span id="el<?php echo $payment_delete->RowCount ?>_payment__email" class="payment__email">
<span<?php echo $payment_delete->_email->viewAttributes() ?>><?php echo $payment_delete->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payment_delete->mobile_no->Visible) { // mobile_no ?>
		<td <?php echo $payment_delete->mobile_no->cellAttributes() ?>>
<span id="el<?php echo $payment_delete->RowCount ?>_payment_mobile_no" class="payment_mobile_no">
<span<?php echo $payment_delete->mobile_no->viewAttributes() ?>><?php echo $payment_delete->mobile_no->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payment_delete->billing_address->Visible) { // billing_address ?>
		<td <?php echo $payment_delete->billing_address->cellAttributes() ?>>
<span id="el<?php echo $payment_delete->RowCount ?>_payment_billing_address" class="payment_billing_address">
<span<?php echo $payment_delete->billing_address->viewAttributes() ?>><?php echo $payment_delete->billing_address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payment_delete->shipping_address->Visible) { // shipping_address ?>
		<td <?php echo $payment_delete->shipping_address->cellAttributes() ?>>
<span id="el<?php echo $payment_delete->RowCount ?>_payment_shipping_address" class="payment_shipping_address">
<span<?php echo $payment_delete->shipping_address->viewAttributes() ?>><?php echo $payment_delete->shipping_address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payment_delete->city->Visible) { // city ?>
		<td <?php echo $payment_delete->city->cellAttributes() ?>>
<span id="el<?php echo $payment_delete->RowCount ?>_payment_city" class="payment_city">
<span<?php echo $payment_delete->city->viewAttributes() ?>><?php echo $payment_delete->city->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payment_delete->state->Visible) { // state ?>
		<td <?php echo $payment_delete->state->cellAttributes() ?>>
<span id="el<?php echo $payment_delete->RowCount ?>_payment_state" class="payment_state">
<span<?php echo $payment_delete->state->viewAttributes() ?>><?php echo $payment_delete->state->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payment_delete->pincode->Visible) { // pincode ?>
		<td <?php echo $payment_delete->pincode->cellAttributes() ?>>
<span id="el<?php echo $payment_delete->RowCount ?>_payment_pincode" class="payment_pincode">
<span<?php echo $payment_delete->pincode->viewAttributes() ?>><?php echo $payment_delete->pincode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payment_delete->payment_method->Visible) { // payment_method ?>
		<td <?php echo $payment_delete->payment_method->cellAttributes() ?>>
<span id="el<?php echo $payment_delete->RowCount ?>_payment_payment_method" class="payment_payment_method">
<span<?php echo $payment_delete->payment_method->viewAttributes() ?>><?php echo $payment_delete->payment_method->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payment_delete->card_no->Visible) { // card_no ?>
		<td <?php echo $payment_delete->card_no->cellAttributes() ?>>
<span id="el<?php echo $payment_delete->RowCount ?>_payment_card_no" class="payment_card_no">
<span<?php echo $payment_delete->card_no->viewAttributes() ?>><?php echo $payment_delete->card_no->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payment_delete->expiry_date->Visible) { // expiry_date ?>
		<td <?php echo $payment_delete->expiry_date->cellAttributes() ?>>
<span id="el<?php echo $payment_delete->RowCount ?>_payment_expiry_date" class="payment_expiry_date">
<span<?php echo $payment_delete->expiry_date->viewAttributes() ?>><?php echo $payment_delete->expiry_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payment_delete->order_date->Visible) { // order_date ?>
		<td <?php echo $payment_delete->order_date->cellAttributes() ?>>
<span id="el<?php echo $payment_delete->RowCount ?>_payment_order_date" class="payment_order_date">
<span<?php echo $payment_delete->order_date->viewAttributes() ?>><?php echo $payment_delete->order_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payment_delete->product_name->Visible) { // product_name ?>
		<td <?php echo $payment_delete->product_name->cellAttributes() ?>>
<span id="el<?php echo $payment_delete->RowCount ?>_payment_product_name" class="payment_product_name">
<span<?php echo $payment_delete->product_name->viewAttributes() ?>><?php echo $payment_delete->product_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payment_delete->product_quantity->Visible) { // product_quantity ?>
		<td <?php echo $payment_delete->product_quantity->cellAttributes() ?>>
<span id="el<?php echo $payment_delete->RowCount ?>_payment_product_quantity" class="payment_product_quantity">
<span<?php echo $payment_delete->product_quantity->viewAttributes() ?>><?php echo $payment_delete->product_quantity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payment_delete->product_price->Visible) { // product_price ?>
		<td <?php echo $payment_delete->product_price->cellAttributes() ?>>
<span id="el<?php echo $payment_delete->RowCount ?>_payment_product_price" class="payment_product_price">
<span<?php echo $payment_delete->product_price->viewAttributes() ?>><?php echo $payment_delete->product_price->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payment_delete->total_price->Visible) { // total_price ?>
		<td <?php echo $payment_delete->total_price->cellAttributes() ?>>
<span id="el<?php echo $payment_delete->RowCount ?>_payment_total_price" class="payment_total_price">
<span<?php echo $payment_delete->total_price->viewAttributes() ?>><?php echo $payment_delete->total_price->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$payment_delete->Recordset->moveNext();
}
$payment_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $payment_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$payment_delete->showPageFooter();
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
$payment_delete->terminate();
?>