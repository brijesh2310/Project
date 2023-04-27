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
$otp_expiry_view = new otp_expiry_view();

// Run the page
$otp_expiry_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$otp_expiry_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$otp_expiry_view->isExport()) { ?>
<script>
var fotp_expiryview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fotp_expiryview = currentForm = new ew.Form("fotp_expiryview", "view");
	loadjs.done("fotp_expiryview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$otp_expiry_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $otp_expiry_view->ExportOptions->render("body") ?>
<?php $otp_expiry_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $otp_expiry_view->showPageHeader(); ?>
<?php
$otp_expiry_view->showMessage();
?>
<form name="fotp_expiryview" id="fotp_expiryview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="otp_expiry">
<input type="hidden" name="modal" value="<?php echo (int)$otp_expiry_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($otp_expiry_view->otp_id->Visible) { // otp_id ?>
	<tr id="r_otp_id">
		<td class="<?php echo $otp_expiry_view->TableLeftColumnClass ?>"><span id="elh_otp_expiry_otp_id"><?php echo $otp_expiry_view->otp_id->caption() ?></span></td>
		<td data-name="otp_id" <?php echo $otp_expiry_view->otp_id->cellAttributes() ?>>
<span id="el_otp_expiry_otp_id">
<span<?php echo $otp_expiry_view->otp_id->viewAttributes() ?>><?php echo $otp_expiry_view->otp_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($otp_expiry_view->otp->Visible) { // otp ?>
	<tr id="r_otp">
		<td class="<?php echo $otp_expiry_view->TableLeftColumnClass ?>"><span id="elh_otp_expiry_otp"><?php echo $otp_expiry_view->otp->caption() ?></span></td>
		<td data-name="otp" <?php echo $otp_expiry_view->otp->cellAttributes() ?>>
<span id="el_otp_expiry_otp">
<span<?php echo $otp_expiry_view->otp->viewAttributes() ?>><?php echo $otp_expiry_view->otp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($otp_expiry_view->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $otp_expiry_view->TableLeftColumnClass ?>"><span id="elh_otp_expiry__email"><?php echo $otp_expiry_view->_email->caption() ?></span></td>
		<td data-name="_email" <?php echo $otp_expiry_view->_email->cellAttributes() ?>>
<span id="el_otp_expiry__email">
<span<?php echo $otp_expiry_view->_email->viewAttributes() ?>><?php echo $otp_expiry_view->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$otp_expiry_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$otp_expiry_view->isExport()) { ?>
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
$otp_expiry_view->terminate();
?>