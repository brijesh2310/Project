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
$rating_view = new rating_view();

// Run the page
$rating_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rating_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$rating_view->isExport()) { ?>
<script>
var fratingview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fratingview = currentForm = new ew.Form("fratingview", "view");
	loadjs.done("fratingview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$rating_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $rating_view->ExportOptions->render("body") ?>
<?php $rating_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $rating_view->showPageHeader(); ?>
<?php
$rating_view->showMessage();
?>
<form name="fratingview" id="fratingview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rating">
<input type="hidden" name="modal" value="<?php echo (int)$rating_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($rating_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $rating_view->TableLeftColumnClass ?>"><span id="elh_rating_id"><?php echo $rating_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $rating_view->id->cellAttributes() ?>>
<span id="el_rating_id">
<span<?php echo $rating_view->id->viewAttributes() ?>><?php echo $rating_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rating_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $rating_view->TableLeftColumnClass ?>"><span id="elh_rating_name"><?php echo $rating_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $rating_view->name->cellAttributes() ?>>
<span id="el_rating_name">
<span<?php echo $rating_view->name->viewAttributes() ?>><?php echo $rating_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rating_view->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $rating_view->TableLeftColumnClass ?>"><span id="elh_rating__email"><?php echo $rating_view->_email->caption() ?></span></td>
		<td data-name="_email" <?php echo $rating_view->_email->cellAttributes() ?>>
<span id="el_rating__email">
<span<?php echo $rating_view->_email->viewAttributes() ?>><?php echo $rating_view->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rating_view->rate->Visible) { // rate ?>
	<tr id="r_rate">
		<td class="<?php echo $rating_view->TableLeftColumnClass ?>"><span id="elh_rating_rate"><?php echo $rating_view->rate->caption() ?></span></td>
		<td data-name="rate" <?php echo $rating_view->rate->cellAttributes() ?>>
<span id="el_rating_rate">
<span<?php echo $rating_view->rate->viewAttributes() ?>><?php echo $rating_view->rate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$rating_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$rating_view->isExport()) { ?>
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
$rating_view->terminate();
?>