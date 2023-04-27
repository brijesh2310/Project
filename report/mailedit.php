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
$mail_edit = new mail_edit();

// Run the page
$mail_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mail_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmailedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fmailedit = currentForm = new ew.Form("fmailedit", "edit");

	// Validate form
	fmailedit.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "F")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($mail_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mail_edit->id->caption(), $mail_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mail_edit->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mail_edit->name->caption(), $mail_edit->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mail_edit->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mail_edit->_email->caption(), $mail_edit->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mail_edit->telephone->Required) { ?>
				elm = this.getElements("x" + infix + "_telephone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mail_edit->telephone->caption(), $mail_edit->telephone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mail_edit->message->Required) { ?>
				elm = this.getElements("x" + infix + "_message");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mail_edit->message->caption(), $mail_edit->message->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fmailedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmailedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fmailedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $mail_edit->showPageHeader(); ?>
<?php
$mail_edit->showMessage();
?>
<form name="fmailedit" id="fmailedit" class="<?php echo $mail_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mail">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$mail_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($mail_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_mail_id" class="<?php echo $mail_edit->LeftColumnClass ?>"><?php echo $mail_edit->id->caption() ?><?php echo $mail_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mail_edit->RightColumnClass ?>"><div <?php echo $mail_edit->id->cellAttributes() ?>>
<span id="el_mail_id">
<span<?php echo $mail_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mail_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="mail" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($mail_edit->id->CurrentValue) ?>">
<?php echo $mail_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mail_edit->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_mail_name" for="x_name" class="<?php echo $mail_edit->LeftColumnClass ?>"><?php echo $mail_edit->name->caption() ?><?php echo $mail_edit->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mail_edit->RightColumnClass ?>"><div <?php echo $mail_edit->name->cellAttributes() ?>>
<span id="el_mail_name">
<input type="text" data-table="mail" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($mail_edit->name->getPlaceHolder()) ?>" value="<?php echo $mail_edit->name->EditValue ?>"<?php echo $mail_edit->name->editAttributes() ?>>
</span>
<?php echo $mail_edit->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mail_edit->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_mail__email" for="x__email" class="<?php echo $mail_edit->LeftColumnClass ?>"><?php echo $mail_edit->_email->caption() ?><?php echo $mail_edit->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mail_edit->RightColumnClass ?>"><div <?php echo $mail_edit->_email->cellAttributes() ?>>
<span id="el_mail__email">
<input type="text" data-table="mail" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($mail_edit->_email->getPlaceHolder()) ?>" value="<?php echo $mail_edit->_email->EditValue ?>"<?php echo $mail_edit->_email->editAttributes() ?>>
</span>
<?php echo $mail_edit->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mail_edit->telephone->Visible) { // telephone ?>
	<div id="r_telephone" class="form-group row">
		<label id="elh_mail_telephone" for="x_telephone" class="<?php echo $mail_edit->LeftColumnClass ?>"><?php echo $mail_edit->telephone->caption() ?><?php echo $mail_edit->telephone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mail_edit->RightColumnClass ?>"><div <?php echo $mail_edit->telephone->cellAttributes() ?>>
<span id="el_mail_telephone">
<input type="text" data-table="mail" data-field="x_telephone" name="x_telephone" id="x_telephone" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($mail_edit->telephone->getPlaceHolder()) ?>" value="<?php echo $mail_edit->telephone->EditValue ?>"<?php echo $mail_edit->telephone->editAttributes() ?>>
</span>
<?php echo $mail_edit->telephone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mail_edit->message->Visible) { // message ?>
	<div id="r_message" class="form-group row">
		<label id="elh_mail_message" for="x_message" class="<?php echo $mail_edit->LeftColumnClass ?>"><?php echo $mail_edit->message->caption() ?><?php echo $mail_edit->message->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mail_edit->RightColumnClass ?>"><div <?php echo $mail_edit->message->cellAttributes() ?>>
<span id="el_mail_message">
<input type="text" data-table="mail" data-field="x_message" name="x_message" id="x_message" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($mail_edit->message->getPlaceHolder()) ?>" value="<?php echo $mail_edit->message->EditValue ?>"<?php echo $mail_edit->message->editAttributes() ?>>
</span>
<?php echo $mail_edit->message->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$mail_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $mail_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $mail_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$mail_edit->showPageFooter();
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
$mail_edit->terminate();
?>