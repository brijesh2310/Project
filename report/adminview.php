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
$admin_view = new admin_view();

// Run the page
$admin_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$admin_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$admin_view->isExport()) { ?>
<script>
var fadminview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fadminview = currentForm = new ew.Form("fadminview", "view");
	loadjs.done("fadminview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$admin_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $admin_view->ExportOptions->render("body") ?>
<?php $admin_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $admin_view->showPageHeader(); ?>
<?php
$admin_view->showMessage();
?>
<form name="fadminview" id="fadminview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="admin">
<input type="hidden" name="modal" value="<?php echo (int)$admin_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($admin_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $admin_view->TableLeftColumnClass ?>"><span id="elh_admin_id"><?php echo $admin_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $admin_view->id->cellAttributes() ?>>
<span id="el_admin_id">
<span<?php echo $admin_view->id->viewAttributes() ?>><?php echo $admin_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($admin_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $admin_view->TableLeftColumnClass ?>"><span id="elh_admin_name"><?php echo $admin_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $admin_view->name->cellAttributes() ?>>
<span id="el_admin_name">
<span<?php echo $admin_view->name->viewAttributes() ?>><?php echo $admin_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($admin_view->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $admin_view->TableLeftColumnClass ?>"><span id="elh_admin__email"><?php echo $admin_view->_email->caption() ?></span></td>
		<td data-name="_email" <?php echo $admin_view->_email->cellAttributes() ?>>
<span id="el_admin__email">
<span<?php echo $admin_view->_email->viewAttributes() ?>><?php echo $admin_view->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($admin_view->password->Visible) { // password ?>
	<tr id="r_password">
		<td class="<?php echo $admin_view->TableLeftColumnClass ?>"><span id="elh_admin_password"><?php echo $admin_view->password->caption() ?></span></td>
		<td data-name="password" <?php echo $admin_view->password->cellAttributes() ?>>
<span id="el_admin_password">
<span<?php echo $admin_view->password->viewAttributes() ?>><?php echo $admin_view->password->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($admin_view->address->Visible) { // address ?>
	<tr id="r_address">
		<td class="<?php echo $admin_view->TableLeftColumnClass ?>"><span id="elh_admin_address"><?php echo $admin_view->address->caption() ?></span></td>
		<td data-name="address" <?php echo $admin_view->address->cellAttributes() ?>>
<span id="el_admin_address">
<span<?php echo $admin_view->address->viewAttributes() ?>><?php echo $admin_view->address->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($admin_view->mobile->Visible) { // mobile ?>
	<tr id="r_mobile">
		<td class="<?php echo $admin_view->TableLeftColumnClass ?>"><span id="elh_admin_mobile"><?php echo $admin_view->mobile->caption() ?></span></td>
		<td data-name="mobile" <?php echo $admin_view->mobile->cellAttributes() ?>>
<span id="el_admin_mobile">
<span<?php echo $admin_view->mobile->viewAttributes() ?>><?php echo $admin_view->mobile->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$admin_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$admin_view->isExport()) { ?>
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
$admin_view->terminate();
?>