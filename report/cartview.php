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
$cart_view = new cart_view();

// Run the page
$cart_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cart_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cart_view->isExport()) { ?>
<script>
var fcartview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcartview = currentForm = new ew.Form("fcartview", "view");
	loadjs.done("fcartview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$cart_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $cart_view->ExportOptions->render("body") ?>
<?php $cart_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $cart_view->showPageHeader(); ?>
<?php
$cart_view->showMessage();
?>
<form name="fcartview" id="fcartview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cart">
<input type="hidden" name="modal" value="<?php echo (int)$cart_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($cart_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $cart_view->TableLeftColumnClass ?>"><span id="elh_cart_id"><?php echo $cart_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $cart_view->id->cellAttributes() ?>>
<span id="el_cart_id">
<span<?php echo $cart_view->id->viewAttributes() ?>><?php echo $cart_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cart_view->product_id->Visible) { // product_id ?>
	<tr id="r_product_id">
		<td class="<?php echo $cart_view->TableLeftColumnClass ?>"><span id="elh_cart_product_id"><?php echo $cart_view->product_id->caption() ?></span></td>
		<td data-name="product_id" <?php echo $cart_view->product_id->cellAttributes() ?>>
<span id="el_cart_product_id">
<span<?php echo $cart_view->product_id->viewAttributes() ?>><?php echo $cart_view->product_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cart_view->quantity->Visible) { // quantity ?>
	<tr id="r_quantity">
		<td class="<?php echo $cart_view->TableLeftColumnClass ?>"><span id="elh_cart_quantity"><?php echo $cart_view->quantity->caption() ?></span></td>
		<td data-name="quantity" <?php echo $cart_view->quantity->cellAttributes() ?>>
<span id="el_cart_quantity">
<span<?php echo $cart_view->quantity->viewAttributes() ?>><?php echo $cart_view->quantity->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$cart_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cart_view->isExport()) { ?>
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
$cart_view->terminate();
?>