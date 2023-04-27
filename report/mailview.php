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
$mail_view = new mail_view();

// Run the page
$mail_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mail_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$mail_view->isExport()) { ?>
<script>
var fmailview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fmailview = currentForm = new ew.Form("fmailview", "view");
	loadjs.done("fmailview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$mail_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $mail_view->ExportOptions->render("body") ?>
<?php $mail_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $mail_view->showPageHeader(); ?>
<?php
$mail_view->showMessage();
?>
<form name="fmailview" id="fmailview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mail">
<input type="hidden" name="modal" value="<?php echo (int)$mail_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($mail_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $mail_view->TableLeftColumnClass ?>"><span id="elh_mail_id"><?php echo $mail_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $mail_view->id->cellAttributes() ?>>
<span id="el_mail_id">
<span<?php echo $mail_view->id->viewAttributes() ?>><?php echo $mail_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mail_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $mail_view->TableLeftColumnClass ?>"><span id="elh_mail_name"><?php echo $mail_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $mail_view->name->cellAttributes() ?>>
<span id="el_mail_name">
<span<?php echo $mail_view->name->viewAttributes() ?>><?php echo $mail_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mail_view->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $mail_view->TableLeftColumnClass ?>"><span id="elh_mail__email"><?php echo $mail_view->_email->caption() ?></span></td>
		<td data-name="_email" <?php echo $mail_view->_email->cellAttributes() ?>>
<span id="el_mail__email">
<span<?php echo $mail_view->_email->viewAttributes() ?>><?php echo $mail_view->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mail_view->telephone->Visible) { // telephone ?>
	<tr id="r_telephone">
		<td class="<?php echo $mail_view->TableLeftColumnClass ?>"><span id="elh_mail_telephone"><?php echo $mail_view->telephone->caption() ?></span></td>
		<td data-name="telephone" <?php echo $mail_view->telephone->cellAttributes() ?>>
<span id="el_mail_telephone">
<span<?php echo $mail_view->telephone->viewAttributes() ?>><?php echo $mail_view->telephone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mail_view->message->Visible) { // message ?>
	<tr id="r_message">
		<td class="<?php echo $mail_view->TableLeftColumnClass ?>"><span id="elh_mail_message"><?php echo $mail_view->message->caption() ?></span></td>
		<td data-name="message" <?php echo $mail_view->message->cellAttributes() ?>>
<span id="el_mail_message">
<span<?php echo $mail_view->message->viewAttributes() ?>><?php echo $mail_view->message->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$mail_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$mail_view->isExport()) { ?>
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
$mail_view->terminate();
?>