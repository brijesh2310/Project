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
$mail_delete = new mail_delete();

// Run the page
$mail_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mail_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmaildelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fmaildelete = currentForm = new ew.Form("fmaildelete", "delete");
	loadjs.done("fmaildelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $mail_delete->showPageHeader(); ?>
<?php
$mail_delete->showMessage();
?>
<form name="fmaildelete" id="fmaildelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mail">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($mail_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($mail_delete->id->Visible) { // id ?>
		<th class="<?php echo $mail_delete->id->headerCellClass() ?>"><span id="elh_mail_id" class="mail_id"><?php echo $mail_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($mail_delete->name->Visible) { // name ?>
		<th class="<?php echo $mail_delete->name->headerCellClass() ?>"><span id="elh_mail_name" class="mail_name"><?php echo $mail_delete->name->caption() ?></span></th>
<?php } ?>
<?php if ($mail_delete->_email->Visible) { // email ?>
		<th class="<?php echo $mail_delete->_email->headerCellClass() ?>"><span id="elh_mail__email" class="mail__email"><?php echo $mail_delete->_email->caption() ?></span></th>
<?php } ?>
<?php if ($mail_delete->telephone->Visible) { // telephone ?>
		<th class="<?php echo $mail_delete->telephone->headerCellClass() ?>"><span id="elh_mail_telephone" class="mail_telephone"><?php echo $mail_delete->telephone->caption() ?></span></th>
<?php } ?>
<?php if ($mail_delete->message->Visible) { // message ?>
		<th class="<?php echo $mail_delete->message->headerCellClass() ?>"><span id="elh_mail_message" class="mail_message"><?php echo $mail_delete->message->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$mail_delete->RecordCount = 0;
$i = 0;
while (!$mail_delete->Recordset->EOF) {
	$mail_delete->RecordCount++;
	$mail_delete->RowCount++;

	// Set row properties
	$mail->resetAttributes();
	$mail->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$mail_delete->loadRowValues($mail_delete->Recordset);

	// Render row
	$mail_delete->renderRow();
?>
	<tr <?php echo $mail->rowAttributes() ?>>
<?php if ($mail_delete->id->Visible) { // id ?>
		<td <?php echo $mail_delete->id->cellAttributes() ?>>
<span id="el<?php echo $mail_delete->RowCount ?>_mail_id" class="mail_id">
<span<?php echo $mail_delete->id->viewAttributes() ?>><?php echo $mail_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mail_delete->name->Visible) { // name ?>
		<td <?php echo $mail_delete->name->cellAttributes() ?>>
<span id="el<?php echo $mail_delete->RowCount ?>_mail_name" class="mail_name">
<span<?php echo $mail_delete->name->viewAttributes() ?>><?php echo $mail_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mail_delete->_email->Visible) { // email ?>
		<td <?php echo $mail_delete->_email->cellAttributes() ?>>
<span id="el<?php echo $mail_delete->RowCount ?>_mail__email" class="mail__email">
<span<?php echo $mail_delete->_email->viewAttributes() ?>><?php echo $mail_delete->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mail_delete->telephone->Visible) { // telephone ?>
		<td <?php echo $mail_delete->telephone->cellAttributes() ?>>
<span id="el<?php echo $mail_delete->RowCount ?>_mail_telephone" class="mail_telephone">
<span<?php echo $mail_delete->telephone->viewAttributes() ?>><?php echo $mail_delete->telephone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mail_delete->message->Visible) { // message ?>
		<td <?php echo $mail_delete->message->cellAttributes() ?>>
<span id="el<?php echo $mail_delete->RowCount ?>_mail_message" class="mail_message">
<span<?php echo $mail_delete->message->viewAttributes() ?>><?php echo $mail_delete->message->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$mail_delete->Recordset->moveNext();
}
$mail_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $mail_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$mail_delete->showPageFooter();
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
$mail_delete->terminate();
?>