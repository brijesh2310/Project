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
$otp_expiry_add = new otp_expiry_add();

// Run the page
$otp_expiry_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$otp_expiry_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fotp_expiryadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fotp_expiryadd = currentForm = new ew.Form("fotp_expiryadd", "add");

	// Validate form
	fotp_expiryadd.validate = function() {
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
			<?php if ($otp_expiry_add->otp->Required) { ?>
				elm = this.getElements("x" + infix + "_otp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $otp_expiry_add->otp->caption(), $otp_expiry_add->otp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($otp_expiry_add->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $otp_expiry_add->_email->caption(), $otp_expiry_add->_email->RequiredErrorMessage)) ?>");
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
	fotp_expiryadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fotp_expiryadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fotp_expiryadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $otp_expiry_add->showPageHeader(); ?>
<?php
$otp_expiry_add->showMessage();
?>
<form name="fotp_expiryadd" id="fotp_expiryadd" class="<?php echo $otp_expiry_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="otp_expiry">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$otp_expiry_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($otp_expiry_add->otp->Visible) { // otp ?>
	<div id="r_otp" class="form-group row">
		<label id="elh_otp_expiry_otp" for="x_otp" class="<?php echo $otp_expiry_add->LeftColumnClass ?>"><?php echo $otp_expiry_add->otp->caption() ?><?php echo $otp_expiry_add->otp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $otp_expiry_add->RightColumnClass ?>"><div <?php echo $otp_expiry_add->otp->cellAttributes() ?>>
<span id="el_otp_expiry_otp">
<input type="text" data-table="otp_expiry" data-field="x_otp" name="x_otp" id="x_otp" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($otp_expiry_add->otp->getPlaceHolder()) ?>" value="<?php echo $otp_expiry_add->otp->EditValue ?>"<?php echo $otp_expiry_add->otp->editAttributes() ?>>
</span>
<?php echo $otp_expiry_add->otp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($otp_expiry_add->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_otp_expiry__email" for="x__email" class="<?php echo $otp_expiry_add->LeftColumnClass ?>"><?php echo $otp_expiry_add->_email->caption() ?><?php echo $otp_expiry_add->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $otp_expiry_add->RightColumnClass ?>"><div <?php echo $otp_expiry_add->_email->cellAttributes() ?>>
<span id="el_otp_expiry__email">
<input type="text" data-table="otp_expiry" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($otp_expiry_add->_email->getPlaceHolder()) ?>" value="<?php echo $otp_expiry_add->_email->EditValue ?>"<?php echo $otp_expiry_add->_email->editAttributes() ?>>
</span>
<?php echo $otp_expiry_add->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$otp_expiry_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $otp_expiry_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $otp_expiry_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$otp_expiry_add->showPageFooter();
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
$otp_expiry_add->terminate();
?>