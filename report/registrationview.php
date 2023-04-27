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
$registration_view = new registration_view();

// Run the page
$registration_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$registration_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$registration_view->isExport()) { ?>
<script>
var fregistrationview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fregistrationview = currentForm = new ew.Form("fregistrationview", "view");
	loadjs.done("fregistrationview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$registration_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $registration_view->ExportOptions->render("body") ?>
<?php $registration_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $registration_view->showPageHeader(); ?>
<?php
$registration_view->showMessage();
?>
<form name="fregistrationview" id="fregistrationview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="registration">
<input type="hidden" name="modal" value="<?php echo (int)$registration_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($registration_view->registration_id->Visible) { // registration_id ?>
	<tr id="r_registration_id">
		<td class="<?php echo $registration_view->TableLeftColumnClass ?>"><span id="elh_registration_registration_id"><?php echo $registration_view->registration_id->caption() ?></span></td>
		<td data-name="registration_id" <?php echo $registration_view->registration_id->cellAttributes() ?>>
<span id="el_registration_registration_id">
<span<?php echo $registration_view->registration_id->viewAttributes() ?>><?php echo $registration_view->registration_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($registration_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $registration_view->TableLeftColumnClass ?>"><span id="elh_registration_name"><?php echo $registration_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $registration_view->name->cellAttributes() ?>>
<span id="el_registration_name">
<span<?php echo $registration_view->name->viewAttributes() ?>><?php echo $registration_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($registration_view->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $registration_view->TableLeftColumnClass ?>"><span id="elh_registration__email"><?php echo $registration_view->_email->caption() ?></span></td>
		<td data-name="_email" <?php echo $registration_view->_email->cellAttributes() ?>>
<span id="el_registration__email">
<span<?php echo $registration_view->_email->viewAttributes() ?>><?php echo $registration_view->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($registration_view->password->Visible) { // password ?>
	<tr id="r_password">
		<td class="<?php echo $registration_view->TableLeftColumnClass ?>"><span id="elh_registration_password"><?php echo $registration_view->password->caption() ?></span></td>
		<td data-name="password" <?php echo $registration_view->password->cellAttributes() ?>>
<span id="el_registration_password">
<span<?php echo $registration_view->password->viewAttributes() ?>><?php echo $registration_view->password->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($registration_view->address->Visible) { // address ?>
	<tr id="r_address">
		<td class="<?php echo $registration_view->TableLeftColumnClass ?>"><span id="elh_registration_address"><?php echo $registration_view->address->caption() ?></span></td>
		<td data-name="address" <?php echo $registration_view->address->cellAttributes() ?>>
<span id="el_registration_address">
<span<?php echo $registration_view->address->viewAttributes() ?>><?php echo $registration_view->address->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($registration_view->city->Visible) { // city ?>
	<tr id="r_city">
		<td class="<?php echo $registration_view->TableLeftColumnClass ?>"><span id="elh_registration_city"><?php echo $registration_view->city->caption() ?></span></td>
		<td data-name="city" <?php echo $registration_view->city->cellAttributes() ?>>
<span id="el_registration_city">
<span<?php echo $registration_view->city->viewAttributes() ?>><?php echo $registration_view->city->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($registration_view->area->Visible) { // area ?>
	<tr id="r_area">
		<td class="<?php echo $registration_view->TableLeftColumnClass ?>"><span id="elh_registration_area"><?php echo $registration_view->area->caption() ?></span></td>
		<td data-name="area" <?php echo $registration_view->area->cellAttributes() ?>>
<span id="el_registration_area">
<span<?php echo $registration_view->area->viewAttributes() ?>><?php echo $registration_view->area->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($registration_view->postalcode->Visible) { // postalcode ?>
	<tr id="r_postalcode">
		<td class="<?php echo $registration_view->TableLeftColumnClass ?>"><span id="elh_registration_postalcode"><?php echo $registration_view->postalcode->caption() ?></span></td>
		<td data-name="postalcode" <?php echo $registration_view->postalcode->cellAttributes() ?>>
<span id="el_registration_postalcode">
<span<?php echo $registration_view->postalcode->viewAttributes() ?>><?php echo $registration_view->postalcode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($registration_view->gender->Visible) { // gender ?>
	<tr id="r_gender">
		<td class="<?php echo $registration_view->TableLeftColumnClass ?>"><span id="elh_registration_gender"><?php echo $registration_view->gender->caption() ?></span></td>
		<td data-name="gender" <?php echo $registration_view->gender->cellAttributes() ?>>
<span id="el_registration_gender">
<span<?php echo $registration_view->gender->viewAttributes() ?>><?php echo $registration_view->gender->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($registration_view->mobile->Visible) { // mobile ?>
	<tr id="r_mobile">
		<td class="<?php echo $registration_view->TableLeftColumnClass ?>"><span id="elh_registration_mobile"><?php echo $registration_view->mobile->caption() ?></span></td>
		<td data-name="mobile" <?php echo $registration_view->mobile->cellAttributes() ?>>
<span id="el_registration_mobile">
<span<?php echo $registration_view->mobile->viewAttributes() ?>><?php echo $registration_view->mobile->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$registration_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$registration_view->isExport()) { ?>
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
$registration_view->terminate();
?>