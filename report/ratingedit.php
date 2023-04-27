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
$rating_edit = new rating_edit();

// Run the page
$rating_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rating_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fratingedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fratingedit = currentForm = new ew.Form("fratingedit", "edit");

	// Validate form
	fratingedit.validate = function() {
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
			<?php if ($rating_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rating_edit->id->caption(), $rating_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rating_edit->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rating_edit->name->caption(), $rating_edit->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rating_edit->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rating_edit->_email->caption(), $rating_edit->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rating_edit->rate->Required) { ?>
				elm = this.getElements("x" + infix + "_rate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rating_edit->rate->caption(), $rating_edit->rate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_rate");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rating_edit->rate->errorMessage()) ?>");

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
	fratingedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fratingedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fratingedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $rating_edit->showPageHeader(); ?>
<?php
$rating_edit->showMessage();
?>
<form name="fratingedit" id="fratingedit" class="<?php echo $rating_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rating">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$rating_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($rating_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_rating_id" class="<?php echo $rating_edit->LeftColumnClass ?>"><?php echo $rating_edit->id->caption() ?><?php echo $rating_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rating_edit->RightColumnClass ?>"><div <?php echo $rating_edit->id->cellAttributes() ?>>
<span id="el_rating_id">
<span<?php echo $rating_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rating_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="rating" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($rating_edit->id->CurrentValue) ?>">
<?php echo $rating_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rating_edit->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_rating_name" for="x_name" class="<?php echo $rating_edit->LeftColumnClass ?>"><?php echo $rating_edit->name->caption() ?><?php echo $rating_edit->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rating_edit->RightColumnClass ?>"><div <?php echo $rating_edit->name->cellAttributes() ?>>
<span id="el_rating_name">
<input type="text" data-table="rating" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($rating_edit->name->getPlaceHolder()) ?>" value="<?php echo $rating_edit->name->EditValue ?>"<?php echo $rating_edit->name->editAttributes() ?>>
</span>
<?php echo $rating_edit->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rating_edit->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_rating__email" for="x__email" class="<?php echo $rating_edit->LeftColumnClass ?>"><?php echo $rating_edit->_email->caption() ?><?php echo $rating_edit->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rating_edit->RightColumnClass ?>"><div <?php echo $rating_edit->_email->cellAttributes() ?>>
<span id="el_rating__email">
<input type="text" data-table="rating" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($rating_edit->_email->getPlaceHolder()) ?>" value="<?php echo $rating_edit->_email->EditValue ?>"<?php echo $rating_edit->_email->editAttributes() ?>>
</span>
<?php echo $rating_edit->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rating_edit->rate->Visible) { // rate ?>
	<div id="r_rate" class="form-group row">
		<label id="elh_rating_rate" for="x_rate" class="<?php echo $rating_edit->LeftColumnClass ?>"><?php echo $rating_edit->rate->caption() ?><?php echo $rating_edit->rate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rating_edit->RightColumnClass ?>"><div <?php echo $rating_edit->rate->cellAttributes() ?>>
<span id="el_rating_rate">
<input type="text" data-table="rating" data-field="x_rate" name="x_rate" id="x_rate" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($rating_edit->rate->getPlaceHolder()) ?>" value="<?php echo $rating_edit->rate->EditValue ?>"<?php echo $rating_edit->rate->editAttributes() ?>>
</span>
<?php echo $rating_edit->rate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$rating_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $rating_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $rating_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$rating_edit->showPageFooter();
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
$rating_edit->terminate();
?>