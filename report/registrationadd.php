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
$registration_add = new registration_add();

// Run the page
$registration_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$registration_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fregistrationadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fregistrationadd = currentForm = new ew.Form("fregistrationadd", "add");

	// Validate form
	fregistrationadd.validate = function() {
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
			<?php if ($registration_add->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $registration_add->name->caption(), $registration_add->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($registration_add->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $registration_add->_email->caption(), $registration_add->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($registration_add->password->Required) { ?>
				elm = this.getElements("x" + infix + "_password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $registration_add->password->caption(), $registration_add->password->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($registration_add->address->Required) { ?>
				elm = this.getElements("x" + infix + "_address");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $registration_add->address->caption(), $registration_add->address->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($registration_add->city->Required) { ?>
				elm = this.getElements("x" + infix + "_city");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $registration_add->city->caption(), $registration_add->city->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($registration_add->area->Required) { ?>
				elm = this.getElements("x" + infix + "_area");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $registration_add->area->caption(), $registration_add->area->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($registration_add->postalcode->Required) { ?>
				elm = this.getElements("x" + infix + "_postalcode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $registration_add->postalcode->caption(), $registration_add->postalcode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($registration_add->gender->Required) { ?>
				elm = this.getElements("x" + infix + "_gender");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $registration_add->gender->caption(), $registration_add->gender->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($registration_add->mobile->Required) { ?>
				elm = this.getElements("x" + infix + "_mobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $registration_add->mobile->caption(), $registration_add->mobile->RequiredErrorMessage)) ?>");
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
	fregistrationadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fregistrationadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fregistrationadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $registration_add->showPageHeader(); ?>
<?php
$registration_add->showMessage();
?>
<form name="fregistrationadd" id="fregistrationadd" class="<?php echo $registration_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="registration">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$registration_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($registration_add->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_registration_name" for="x_name" class="<?php echo $registration_add->LeftColumnClass ?>"><?php echo $registration_add->name->caption() ?><?php echo $registration_add->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $registration_add->RightColumnClass ?>"><div <?php echo $registration_add->name->cellAttributes() ?>>
<span id="el_registration_name">
<input type="text" data-table="registration" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($registration_add->name->getPlaceHolder()) ?>" value="<?php echo $registration_add->name->EditValue ?>"<?php echo $registration_add->name->editAttributes() ?>>
</span>
<?php echo $registration_add->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($registration_add->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_registration__email" for="x__email" class="<?php echo $registration_add->LeftColumnClass ?>"><?php echo $registration_add->_email->caption() ?><?php echo $registration_add->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $registration_add->RightColumnClass ?>"><div <?php echo $registration_add->_email->cellAttributes() ?>>
<span id="el_registration__email">
<input type="text" data-table="registration" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($registration_add->_email->getPlaceHolder()) ?>" value="<?php echo $registration_add->_email->EditValue ?>"<?php echo $registration_add->_email->editAttributes() ?>>
</span>
<?php echo $registration_add->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($registration_add->password->Visible) { // password ?>
	<div id="r_password" class="form-group row">
		<label id="elh_registration_password" for="x_password" class="<?php echo $registration_add->LeftColumnClass ?>"><?php echo $registration_add->password->caption() ?><?php echo $registration_add->password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $registration_add->RightColumnClass ?>"><div <?php echo $registration_add->password->cellAttributes() ?>>
<span id="el_registration_password">
<input type="text" data-table="registration" data-field="x_password" name="x_password" id="x_password" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($registration_add->password->getPlaceHolder()) ?>" value="<?php echo $registration_add->password->EditValue ?>"<?php echo $registration_add->password->editAttributes() ?>>
</span>
<?php echo $registration_add->password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($registration_add->address->Visible) { // address ?>
	<div id="r_address" class="form-group row">
		<label id="elh_registration_address" for="x_address" class="<?php echo $registration_add->LeftColumnClass ?>"><?php echo $registration_add->address->caption() ?><?php echo $registration_add->address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $registration_add->RightColumnClass ?>"><div <?php echo $registration_add->address->cellAttributes() ?>>
<span id="el_registration_address">
<input type="text" data-table="registration" data-field="x_address" name="x_address" id="x_address" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($registration_add->address->getPlaceHolder()) ?>" value="<?php echo $registration_add->address->EditValue ?>"<?php echo $registration_add->address->editAttributes() ?>>
</span>
<?php echo $registration_add->address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($registration_add->city->Visible) { // city ?>
	<div id="r_city" class="form-group row">
		<label id="elh_registration_city" for="x_city" class="<?php echo $registration_add->LeftColumnClass ?>"><?php echo $registration_add->city->caption() ?><?php echo $registration_add->city->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $registration_add->RightColumnClass ?>"><div <?php echo $registration_add->city->cellAttributes() ?>>
<span id="el_registration_city">
<input type="text" data-table="registration" data-field="x_city" name="x_city" id="x_city" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($registration_add->city->getPlaceHolder()) ?>" value="<?php echo $registration_add->city->EditValue ?>"<?php echo $registration_add->city->editAttributes() ?>>
</span>
<?php echo $registration_add->city->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($registration_add->area->Visible) { // area ?>
	<div id="r_area" class="form-group row">
		<label id="elh_registration_area" for="x_area" class="<?php echo $registration_add->LeftColumnClass ?>"><?php echo $registration_add->area->caption() ?><?php echo $registration_add->area->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $registration_add->RightColumnClass ?>"><div <?php echo $registration_add->area->cellAttributes() ?>>
<span id="el_registration_area">
<input type="text" data-table="registration" data-field="x_area" name="x_area" id="x_area" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($registration_add->area->getPlaceHolder()) ?>" value="<?php echo $registration_add->area->EditValue ?>"<?php echo $registration_add->area->editAttributes() ?>>
</span>
<?php echo $registration_add->area->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($registration_add->postalcode->Visible) { // postalcode ?>
	<div id="r_postalcode" class="form-group row">
		<label id="elh_registration_postalcode" for="x_postalcode" class="<?php echo $registration_add->LeftColumnClass ?>"><?php echo $registration_add->postalcode->caption() ?><?php echo $registration_add->postalcode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $registration_add->RightColumnClass ?>"><div <?php echo $registration_add->postalcode->cellAttributes() ?>>
<span id="el_registration_postalcode">
<input type="text" data-table="registration" data-field="x_postalcode" name="x_postalcode" id="x_postalcode" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($registration_add->postalcode->getPlaceHolder()) ?>" value="<?php echo $registration_add->postalcode->EditValue ?>"<?php echo $registration_add->postalcode->editAttributes() ?>>
</span>
<?php echo $registration_add->postalcode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($registration_add->gender->Visible) { // gender ?>
	<div id="r_gender" class="form-group row">
		<label id="elh_registration_gender" for="x_gender" class="<?php echo $registration_add->LeftColumnClass ?>"><?php echo $registration_add->gender->caption() ?><?php echo $registration_add->gender->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $registration_add->RightColumnClass ?>"><div <?php echo $registration_add->gender->cellAttributes() ?>>
<span id="el_registration_gender">
<input type="text" data-table="registration" data-field="x_gender" name="x_gender" id="x_gender" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($registration_add->gender->getPlaceHolder()) ?>" value="<?php echo $registration_add->gender->EditValue ?>"<?php echo $registration_add->gender->editAttributes() ?>>
</span>
<?php echo $registration_add->gender->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($registration_add->mobile->Visible) { // mobile ?>
	<div id="r_mobile" class="form-group row">
		<label id="elh_registration_mobile" for="x_mobile" class="<?php echo $registration_add->LeftColumnClass ?>"><?php echo $registration_add->mobile->caption() ?><?php echo $registration_add->mobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $registration_add->RightColumnClass ?>"><div <?php echo $registration_add->mobile->cellAttributes() ?>>
<span id="el_registration_mobile">
<input type="text" data-table="registration" data-field="x_mobile" name="x_mobile" id="x_mobile" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($registration_add->mobile->getPlaceHolder()) ?>" value="<?php echo $registration_add->mobile->EditValue ?>"<?php echo $registration_add->mobile->editAttributes() ?>>
</span>
<?php echo $registration_add->mobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$registration_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $registration_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $registration_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$registration_add->showPageFooter();
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
$registration_add->terminate();
?>