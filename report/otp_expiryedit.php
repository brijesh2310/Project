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
$otp_expiry_edit = new otp_expiry_edit();

// Run the page
$otp_expiry_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$otp_expiry_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fotp_expiryedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fotp_expiryedit = currentForm = new ew.Form("fotp_expiryedit", "edit");

	// Validate form
	fotp_expiryedit.validate = function() {
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
			<?php if ($otp_expiry_edit->otp_id->Required) { ?>
				elm = this.getElements("x" + infix + "_otp_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $otp_expiry_edit->otp_id->caption(), $otp_expiry_edit->otp_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($otp_expiry_edit->otp->Required) { ?>
				elm = this.getElements("x" + infix + "_otp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $otp_expiry_edit->otp->caption(), $otp_expiry_edit->otp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($otp_expiry_edit->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $otp_expiry_edit->_email->caption(), $otp_expiry_edit->_email->RequiredErrorMessage)) ?>");
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
	fotp_expiryedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fotp_expiryedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fotp_expiryedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $otp_expiry_edit->showPageHeader(); ?>
<?php
$otp_expiry_edit->showMessage();
?>
<form name="fotp_expiryedit" id="fotp_expiryedit" class="<?php echo $otp_expiry_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="otp_expiry">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$otp_expiry_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($otp_expiry_edit->otp_id->Visible) { // otp_id ?>
	<div id="r_otp_id" class="form-group row">
		<label id="elh_otp_expiry_otp_id" class="<?php echo $otp_expiry_edit->LeftColumnClass ?>"><?php echo $otp_expiry_edit->otp_id->caption() ?><?php echo $otp_expiry_edit->otp_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $otp_expiry_edit->RightColumnClass ?>"><div <?php echo $otp_expiry_edit->otp_id->cellAttributes() ?>>
<span id="el_otp_expiry_otp_id">
<span<?php echo $otp_expiry_edit->otp_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($otp_expiry_edit->otp_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="otp_expiry" data-field="x_otp_id" name="x_otp_id" id="x_otp_id" value="<?php echo HtmlEncode($otp_expiry_edit->otp_id->CurrentValue) ?>">
<?php echo $otp_expiry_edit->otp_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($otp_expiry_edit->otp->Visible) { // otp ?>
	<div id="r_otp" class="form-group row">
		<label id="elh_otp_expiry_otp" for="x_otp" class="<?php echo $otp_expiry_edit->LeftColumnClass ?>"><?php echo $otp_expiry_edit->otp->caption() ?><?php echo $otp_expiry_edit->otp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $otp_expiry_edit->RightColumnClass ?>"><div <?php echo $otp_expiry_edit->otp->cellAttributes() ?>>
<span id="el_otp_expiry_otp">
<input type="text" data-table="otp_expiry" data-field="x_otp" name="x_otp" id="x_otp" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($otp_expiry_edit->otp->getPlaceHolder()) ?>" value="<?php echo $otp_expiry_edit->otp->EditValue ?>"<?php echo $otp_expiry_edit->otp->editAttributes() ?>>
</span>
<?php echo $otp_expiry_edit->otp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($otp_expiry_edit->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_otp_expiry__email" for="x__email" class="<?php echo $otp_expiry_edit->LeftColumnClass ?>"><?php echo $otp_expiry_edit->_email->caption() ?><?php echo $otp_expiry_edit->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $otp_expiry_edit->RightColumnClass ?>"><div <?php echo $otp_expiry_edit->_email->cellAttributes() ?>>
<span id="el_otp_expiry__email">
<input type="text" data-table="otp_expiry" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($otp_expiry_edit->_email->getPlaceHolder()) ?>" value="<?php echo $otp_expiry_edit->_email->EditValue ?>"<?php echo $otp_expiry_edit->_email->editAttributes() ?>>
</span>
<?php echo $otp_expiry_edit->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$otp_expiry_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $otp_expiry_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $otp_expiry_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$otp_expiry_edit->showPageFooter();
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
$otp_expiry_edit->terminate();
?>