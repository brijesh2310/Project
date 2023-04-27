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
$mail_add = new mail_add();

// Run the page
$mail_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mail_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmailadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fmailadd = currentForm = new ew.Form("fmailadd", "add");

	// Validate form
	fmailadd.validate = function() {
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
			<?php if ($mail_add->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mail_add->name->caption(), $mail_add->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mail_add->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mail_add->_email->caption(), $mail_add->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mail_add->telephone->Required) { ?>
				elm = this.getElements("x" + infix + "_telephone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mail_add->telephone->caption(), $mail_add->telephone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mail_add->message->Required) { ?>
				elm = this.getElements("x" + infix + "_message");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mail_add->message->caption(), $mail_add->message->RequiredErrorMessage)) ?>");
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
	fmailadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmailadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fmailadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $mail_add->showPageHeader(); ?>
<?php
$mail_add->showMessage();
?>
<form name="fmailadd" id="fmailadd" class="<?php echo $mail_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mail">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$mail_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($mail_add->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_mail_name" for="x_name" class="<?php echo $mail_add->LeftColumnClass ?>"><?php echo $mail_add->name->caption() ?><?php echo $mail_add->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mail_add->RightColumnClass ?>"><div <?php echo $mail_add->name->cellAttributes() ?>>
<span id="el_mail_name">
<input type="text" data-table="mail" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($mail_add->name->getPlaceHolder()) ?>" value="<?php echo $mail_add->name->EditValue ?>"<?php echo $mail_add->name->editAttributes() ?>>
</span>
<?php echo $mail_add->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mail_add->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_mail__email" for="x__email" class="<?php echo $mail_add->LeftColumnClass ?>"><?php echo $mail_add->_email->caption() ?><?php echo $mail_add->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mail_add->RightColumnClass ?>"><div <?php echo $mail_add->_email->cellAttributes() ?>>
<span id="el_mail__email">
<input type="text" data-table="mail" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($mail_add->_email->getPlaceHolder()) ?>" value="<?php echo $mail_add->_email->EditValue ?>"<?php echo $mail_add->_email->editAttributes() ?>>
</span>
<?php echo $mail_add->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mail_add->telephone->Visible) { // telephone ?>
	<div id="r_telephone" class="form-group row">
		<label id="elh_mail_telephone" for="x_telephone" class="<?php echo $mail_add->LeftColumnClass ?>"><?php echo $mail_add->telephone->caption() ?><?php echo $mail_add->telephone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mail_add->RightColumnClass ?>"><div <?php echo $mail_add->telephone->cellAttributes() ?>>
<span id="el_mail_telephone">
<input type="text" data-table="mail" data-field="x_telephone" name="x_telephone" id="x_telephone" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($mail_add->telephone->getPlaceHolder()) ?>" value="<?php echo $mail_add->telephone->EditValue ?>"<?php echo $mail_add->telephone->editAttributes() ?>>
</span>
<?php echo $mail_add->telephone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mail_add->message->Visible) { // message ?>
	<div id="r_message" class="form-group row">
		<label id="elh_mail_message" for="x_message" class="<?php echo $mail_add->LeftColumnClass ?>"><?php echo $mail_add->message->caption() ?><?php echo $mail_add->message->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mail_add->RightColumnClass ?>"><div <?php echo $mail_add->message->cellAttributes() ?>>
<span id="el_mail_message">
<input type="text" data-table="mail" data-field="x_message" name="x_message" id="x_message" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($mail_add->message->getPlaceHolder()) ?>" value="<?php echo $mail_add->message->EditValue ?>"<?php echo $mail_add->message->editAttributes() ?>>
</span>
<?php echo $mail_add->message->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$mail_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $mail_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $mail_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$mail_add->showPageFooter();
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
$mail_add->terminate();
?>