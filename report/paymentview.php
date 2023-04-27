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
$payment_view = new payment_view();

// Run the page
$payment_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payment_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$payment_view->isExport()) { ?>
<script>
var fpaymentview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpaymentview = currentForm = new ew.Form("fpaymentview", "view");
	loadjs.done("fpaymentview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$payment_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $payment_view->ExportOptions->render("body") ?>
<?php $payment_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $payment_view->showPageHeader(); ?>
<?php
$payment_view->showMessage();
?>
<form name="fpaymentview" id="fpaymentview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payment">
<input type="hidden" name="modal" value="<?php echo (int)$payment_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($payment_view->a_id->Visible) { // a_id ?>
	<tr id="r_a_id">
		<td class="<?php echo $payment_view->TableLeftColumnClass ?>"><span id="elh_payment_a_id"><?php echo $payment_view->a_id->caption() ?></span></td>
		<td data-name="a_id" <?php echo $payment_view->a_id->cellAttributes() ?>>
<span id="el_payment_a_id">
<span<?php echo $payment_view->a_id->viewAttributes() ?>><?php echo $payment_view->a_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payment_view->o_id->Visible) { // o_id ?>
	<tr id="r_o_id">
		<td class="<?php echo $payment_view->TableLeftColumnClass ?>"><span id="elh_payment_o_id"><?php echo $payment_view->o_id->caption() ?></span></td>
		<td data-name="o_id" <?php echo $payment_view->o_id->cellAttributes() ?>>
<span id="el_payment_o_id">
<span<?php echo $payment_view->o_id->viewAttributes() ?>><?php echo $payment_view->o_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payment_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $payment_view->TableLeftColumnClass ?>"><span id="elh_payment_name"><?php echo $payment_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $payment_view->name->cellAttributes() ?>>
<span id="el_payment_name">
<span<?php echo $payment_view->name->viewAttributes() ?>><?php echo $payment_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payment_view->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $payment_view->TableLeftColumnClass ?>"><span id="elh_payment__email"><?php echo $payment_view->_email->caption() ?></span></td>
		<td data-name="_email" <?php echo $payment_view->_email->cellAttributes() ?>>
<span id="el_payment__email">
<span<?php echo $payment_view->_email->viewAttributes() ?>><?php echo $payment_view->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payment_view->mobile_no->Visible) { // mobile_no ?>
	<tr id="r_mobile_no">
		<td class="<?php echo $payment_view->TableLeftColumnClass ?>"><span id="elh_payment_mobile_no"><?php echo $payment_view->mobile_no->caption() ?></span></td>
		<td data-name="mobile_no" <?php echo $payment_view->mobile_no->cellAttributes() ?>>
<span id="el_payment_mobile_no">
<span<?php echo $payment_view->mobile_no->viewAttributes() ?>><?php echo $payment_view->mobile_no->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payment_view->billing_address->Visible) { // billing_address ?>
	<tr id="r_billing_address">
		<td class="<?php echo $payment_view->TableLeftColumnClass ?>"><span id="elh_payment_billing_address"><?php echo $payment_view->billing_address->caption() ?></span></td>
		<td data-name="billing_address" <?php echo $payment_view->billing_address->cellAttributes() ?>>
<span id="el_payment_billing_address">
<span<?php echo $payment_view->billing_address->viewAttributes() ?>><?php echo $payment_view->billing_address->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payment_view->shipping_address->Visible) { // shipping_address ?>
	<tr id="r_shipping_address">
		<td class="<?php echo $payment_view->TableLeftColumnClass ?>"><span id="elh_payment_shipping_address"><?php echo $payment_view->shipping_address->caption() ?></span></td>
		<td data-name="shipping_address" <?php echo $payment_view->shipping_address->cellAttributes() ?>>
<span id="el_payment_shipping_address">
<span<?php echo $payment_view->shipping_address->viewAttributes() ?>><?php echo $payment_view->shipping_address->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payment_view->city->Visible) { // city ?>
	<tr id="r_city">
		<td class="<?php echo $payment_view->TableLeftColumnClass ?>"><span id="elh_payment_city"><?php echo $payment_view->city->caption() ?></span></td>
		<td data-name="city" <?php echo $payment_view->city->cellAttributes() ?>>
<span id="el_payment_city">
<span<?php echo $payment_view->city->viewAttributes() ?>><?php echo $payment_view->city->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payment_view->state->Visible) { // state ?>
	<tr id="r_state">
		<td class="<?php echo $payment_view->TableLeftColumnClass ?>"><span id="elh_payment_state"><?php echo $payment_view->state->caption() ?></span></td>
		<td data-name="state" <?php echo $payment_view->state->cellAttributes() ?>>
<span id="el_payment_state">
<span<?php echo $payment_view->state->viewAttributes() ?>><?php echo $payment_view->state->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payment_view->pincode->Visible) { // pincode ?>
	<tr id="r_pincode">
		<td class="<?php echo $payment_view->TableLeftColumnClass ?>"><span id="elh_payment_pincode"><?php echo $payment_view->pincode->caption() ?></span></td>
		<td data-name="pincode" <?php echo $payment_view->pincode->cellAttributes() ?>>
<span id="el_payment_pincode">
<span<?php echo $payment_view->pincode->viewAttributes() ?>><?php echo $payment_view->pincode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payment_view->payment_method->Visible) { // payment_method ?>
	<tr id="r_payment_method">
		<td class="<?php echo $payment_view->TableLeftColumnClass ?>"><span id="elh_payment_payment_method"><?php echo $payment_view->payment_method->caption() ?></span></td>
		<td data-name="payment_method" <?php echo $payment_view->payment_method->cellAttributes() ?>>
<span id="el_payment_payment_method">
<span<?php echo $payment_view->payment_method->viewAttributes() ?>><?php echo $payment_view->payment_method->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payment_view->card_no->Visible) { // card_no ?>
	<tr id="r_card_no">
		<td class="<?php echo $payment_view->TableLeftColumnClass ?>"><span id="elh_payment_card_no"><?php echo $payment_view->card_no->caption() ?></span></td>
		<td data-name="card_no" <?php echo $payment_view->card_no->cellAttributes() ?>>
<span id="el_payment_card_no">
<span<?php echo $payment_view->card_no->viewAttributes() ?>><?php echo $payment_view->card_no->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payment_view->expiry_date->Visible) { // expiry_date ?>
	<tr id="r_expiry_date">
		<td class="<?php echo $payment_view->TableLeftColumnClass ?>"><span id="elh_payment_expiry_date"><?php echo $payment_view->expiry_date->caption() ?></span></td>
		<td data-name="expiry_date" <?php echo $payment_view->expiry_date->cellAttributes() ?>>
<span id="el_payment_expiry_date">
<span<?php echo $payment_view->expiry_date->viewAttributes() ?>><?php echo $payment_view->expiry_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payment_view->order_date->Visible) { // order_date ?>
	<tr id="r_order_date">
		<td class="<?php echo $payment_view->TableLeftColumnClass ?>"><span id="elh_payment_order_date"><?php echo $payment_view->order_date->caption() ?></span></td>
		<td data-name="order_date" <?php echo $payment_view->order_date->cellAttributes() ?>>
<span id="el_payment_order_date">
<span<?php echo $payment_view->order_date->viewAttributes() ?>><?php echo $payment_view->order_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payment_view->product_name->Visible) { // product_name ?>
	<tr id="r_product_name">
		<td class="<?php echo $payment_view->TableLeftColumnClass ?>"><span id="elh_payment_product_name"><?php echo $payment_view->product_name->caption() ?></span></td>
		<td data-name="product_name" <?php echo $payment_view->product_name->cellAttributes() ?>>
<span id="el_payment_product_name">
<span<?php echo $payment_view->product_name->viewAttributes() ?>><?php echo $payment_view->product_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payment_view->product_quantity->Visible) { // product_quantity ?>
	<tr id="r_product_quantity">
		<td class="<?php echo $payment_view->TableLeftColumnClass ?>"><span id="elh_payment_product_quantity"><?php echo $payment_view->product_quantity->caption() ?></span></td>
		<td data-name="product_quantity" <?php echo $payment_view->product_quantity->cellAttributes() ?>>
<span id="el_payment_product_quantity">
<span<?php echo $payment_view->product_quantity->viewAttributes() ?>><?php echo $payment_view->product_quantity->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payment_view->product_price->Visible) { // product_price ?>
	<tr id="r_product_price">
		<td class="<?php echo $payment_view->TableLeftColumnClass ?>"><span id="elh_payment_product_price"><?php echo $payment_view->product_price->caption() ?></span></td>
		<td data-name="product_price" <?php echo $payment_view->product_price->cellAttributes() ?>>
<span id="el_payment_product_price">
<span<?php echo $payment_view->product_price->viewAttributes() ?>><?php echo $payment_view->product_price->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payment_view->total_price->Visible) { // total_price ?>
	<tr id="r_total_price">
		<td class="<?php echo $payment_view->TableLeftColumnClass ?>"><span id="elh_payment_total_price"><?php echo $payment_view->total_price->caption() ?></span></td>
		<td data-name="total_price" <?php echo $payment_view->total_price->cellAttributes() ?>>
<span id="el_payment_total_price">
<span<?php echo $payment_view->total_price->viewAttributes() ?>><?php echo $payment_view->total_price->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$payment_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$payment_view->isExport()) { ?>
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
$payment_view->terminate();
?>