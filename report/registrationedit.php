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
$registration_edit = new registration_edit();

// Run the page
$registration_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$registration_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fregistrationedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fregistrationedit = currentForm = new ew.Form("fregistrationedit", "edit");

	// Validate form
	fregistrationedit.validate = function() {
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
			<?php if ($registration_edit->registration_id->Required) { ?>
				elm = this.getElements("x" + infix + "_registration_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $registration_edit->registration_id->caption(), $registration_edit->registration_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($registration_edit->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $registration_edit->name->caption(), $registration_edit->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($registration_edit->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $registration_edit->_email->caption(), $registration_edit->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($registration_edit->password->Required) { ?>
				elm = this.getElements("x" + infix + "_password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $registration_edit->password->caption(), $registration_edit->password->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($registration_edit->address->Required) { ?>
				elm = this.getElements("x" + infix + "_address");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $registration_edit->address->caption(), $registration_edit->address->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($registration_edit->city->Required) { ?>
				elm = this.getElements("x" + infix + "_city");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $registration_edit->city->caption(), $registration_edit->city->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($registration_edit->area->Required) { ?>
				elm = this.getElements("x" + infix + "_area");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $registration_edit->area->caption(), $registration_edit->area->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($registration_edit->postalcode->Required) { ?>
				elm = this.getElements("x" + infix + "_postalcode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $registration_edit->postalcode->caption(), $registration_edit->postalcode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($registration_edit->gender->Required) { ?>
				elm = this.getElements("x" + infix + "_gender");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $registration_edit->gender->caption(), $registration_edit->gender->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($registration_edit->mobile->Required) { ?>
				elm = this.getElements("x" + infix + "_mobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $registration_edit->mobile->caption(), $registration_edit->mobile->RequiredErrorMessage)) ?>");
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
	fregistrationedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fregistrationedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fregistrationedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $registration_edit->showPageHeader(); ?>
<?php
$registration_edit->showMessage();
?>
<form name="fregistrationedit" id="fregistrationedit" class="<?php echo $registration_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="registration">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$registration_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($registration_edit->registration_id->Visible) { // registration_id ?>
	<div id="r_registration_id" class="form-group row">
		<label id="elh_registration_registration_id" class="<?php echo $registration_edit->LeftColumnClass ?>"><?php echo $registration_edit->registration_id->caption() ?><?php echo $registration_edit->registration_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $registration_edit->RightColumnClass ?>"><div <?php echo $registration_edit->registration_id->cellAttributes() ?>>
<span id="el_registration_registration_id">
<span<?php echo $registration_edit->registration_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($registration_edit->registration_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="registration" data-field="x_registration_id" name="x_registration_id" id="x_registration_id" value="<?php echo HtmlEncode($registration_edit->registration_id->CurrentValue) ?>">
<?php echo $registration_edit->registration_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($registration_edit->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_registration_name" for="x_name" class="<?php echo $registration_edit->LeftColumnClass ?>"><?php echo $registration_edit->name->caption() ?><?php echo $registration_edit->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $registration_edit->RightColumnClass ?>"><div <?php echo $registration_edit->name->cellAttributes() ?>>
<span id="el_registration_name">
<input type="text" data-table="registration" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($registration_edit->name->getPlaceHolder()) ?>" value="<?php echo $registration_edit->name->EditValue ?>"<?php echo $registration_edit->name->editAttributes() ?>>
</span>
<?php echo $registration_edit->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($registration_edit->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_registration__email" for="x__email" class="<?php echo $registration_edit->LeftColumnClass ?>"><?php echo $registration_edit->_email->caption() ?><?php echo $registration_edit->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $registration_edit->RightColumnClass ?>"><div <?php echo $registration_edit->_email->cellAttributes() ?>>
<span id="el_registration__email">
<input type="text" data-table="registration" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($registration_edit->_email->getPlaceHolder()) ?>" value="<?php echo $registration_edit->_email->EditValue ?>"<?php echo $registration_edit->_email->editAttributes() ?>>
</span>
<?php echo $registration_edit->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($registration_edit->password->Visible) { // password ?>
	<div id="r_password" class="form-group row">
		<label id="elh_registration_password" for="x_password" class="<?php echo $registration_edit->LeftColumnClass ?>"><?php echo $registration_edit->password->caption() ?><?php echo $registration_edit->password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $registration_edit->RightColumnClass ?>"><div <?php echo $registration_edit->password->cellAttributes() ?>>
<span id="el_registration_password">
<input type="text" data-table="registration" data-field="x_password" name="x_password" id="x_password" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($registration_edit->password->getPlaceHolder()) ?>" value="<?php echo $registration_edit->password->EditValue ?>"<?php echo $registration_edit->password->editAttributes() ?>>
</span>
<?php echo $registration_edit->password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($registration_edit->address->Visible) { // address ?>
	<div id="r_address" class="form-group row">
		<label id="elh_registration_address" for="x_address" class="<?php echo $registration_edit->LeftColumnClass ?>"><?php echo $registration_edit->address->caption() ?><?php echo $registration_edit->address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $registration_edit->RightColumnClass ?>"><div <?php echo $registration_edit->address->cellAttributes() ?>>
<span id="el_registration_address">
<input type="text" data-table="registration" data-field="x_address" name="x_address" id="x_address" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($registration_edit->address->getPlaceHolder()) ?>" value="<?php echo $registration_edit->address->EditValue ?>"<?php echo $registration_edit->address->editAttributes() ?>>
</span>
<?php echo $registration_edit->address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($registration_edit->city->Visible) { // city ?>
	<div id="r_city" class="form-group row">
		<label id="elh_registration_city" for="x_city" class="<?php echo $registration_edit->LeftColumnClass ?>"><?php echo $registration_edit->city->caption() ?><?php echo $registration_edit->city->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $registration_edit->RightColumnClass ?>"><div <?php echo $registration_edit->city->cellAttributes() ?>>
<span id="el_registration_city">
<input type="text" data-table="registration" data-field="x_city" name="x_city" id="x_city" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($registration_edit->city->getPlaceHolder()) ?>" value="<?php echo $registration_edit->city->EditValue ?>"<?php echo $registration_edit->city->editAttributes() ?>>
</span>
<?php echo $registration_edit->city->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($registration_edit->area->Visible) { // area ?>
	<div id="r_area" class="form-group row">
		<label id="elh_registration_area" for="x_area" class="<?php echo $registration_edit->LeftColumnClass ?>"><?php echo $registration_edit->area->caption() ?><?php echo $registration_edit->area->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $registration_edit->RightColumnClass ?>"><div <?php echo $registration_edit->area->cellAttributes() ?>>
<span id="el_registration_area">
<input type="text" data-table="registration" data-field="x_area" name="x_area" id="x_area" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($registration_edit->area->getPlaceHolder()) ?>" value="<?php echo $registration_edit->area->EditValue ?>"<?php echo $registration_edit->area->editAttributes() ?>>
</span>
<?php echo $registration_edit->area->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($registration_edit->postalcode->Visible) { // postalcode ?>
	<div id="r_postalcode" class="form-group row">
		<label id="elh_registration_postalcode" for="x_postalcode" class="<?php echo $registration_edit->LeftColumnClass ?>"><?php echo $registration_edit->postalcode->caption() ?><?php echo $registration_edit->postalcode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $registration_edit->RightColumnClass ?>"><div <?php echo $registration_edit->postalcode->cellAttributes() ?>>
<span id="el_registration_postalcode">
<input type="text" data-table="registration" data-field="x_postalcode" name="x_postalcode" id="x_postalcode" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($registration_edit->postalcode->getPlaceHolder()) ?>" value="<?php echo $registration_edit->postalcode->EditValue ?>"<?php echo $registration_edit->postalcode->editAttributes() ?>>
</span>
<?php echo $registration_edit->postalcode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($registration_edit->gender->Visible) { // gender ?>
	<div id="r_gender" class="form-group row">
		<label id="elh_registration_gender" for="x_gender" class="<?php echo $registration_edit->LeftColumnClass ?>"><?php echo $registration_edit->gender->caption() ?><?php echo $registration_edit->gender->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $registration_edit->RightColumnClass ?>"><div <?php echo $registration_edit->gender->cellAttributes() ?>>
<span id="el_registration_gender">
<input type="text" data-table="registration" data-field="x_gender" name="x_gender" id="x_gender" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($registration_edit->gender->getPlaceHolder()) ?>" value="<?php echo $registration_edit->gender->EditValue ?>"<?php echo $registration_edit->gender->editAttributes() ?>>
</span>
<?php echo $registration_edit->gender->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($registration_edit->mobile->Visible) { // mobile ?>
	<div id="r_mobile" class="form-group row">
		<label id="elh_registration_mobile" for="x_mobile" class="<?php echo $registration_edit->LeftColumnClass ?>"><?php echo $registration_edit->mobile->caption() ?><?php echo $registration_edit->mobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $registration_edit->RightColumnClass ?>"><div <?php echo $registration_edit->mobile->cellAttributes() ?>>
<span id="el_registration_mobile">
<input type="text" data-table="registration" data-field="x_mobile" name="x_mobile" id="x_mobile" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($registration_edit->mobile->getPlaceHolder()) ?>" value="<?php echo $registration_edit->mobile->EditValue ?>"<?php echo $registration_edit->mobile->editAttributes() ?>>
</span>
<?php echo $registration_edit->mobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$registration_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $registration_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $registration_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$registration_edit->showPageFooter();
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
$registration_edit->terminate();
?>