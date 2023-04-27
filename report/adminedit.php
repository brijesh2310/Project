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
$admin_edit = new admin_edit();

// Run the page
$admin_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$admin_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fadminedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fadminedit = currentForm = new ew.Form("fadminedit", "edit");

	// Validate form
	fadminedit.validate = function() {
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
			<?php if ($admin_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin_edit->id->caption(), $admin_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($admin_edit->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin_edit->name->caption(), $admin_edit->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($admin_edit->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin_edit->_email->caption(), $admin_edit->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($admin_edit->password->Required) { ?>
				elm = this.getElements("x" + infix + "_password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin_edit->password->caption(), $admin_edit->password->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($admin_edit->address->Required) { ?>
				elm = this.getElements("x" + infix + "_address");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin_edit->address->caption(), $admin_edit->address->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($admin_edit->mobile->Required) { ?>
				elm = this.getElements("x" + infix + "_mobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin_edit->mobile->caption(), $admin_edit->mobile->RequiredErrorMessage)) ?>");
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
	fadminedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fadminedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fadminedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $admin_edit->showPageHeader(); ?>
<?php
$admin_edit->showMessage();
?>
<form name="fadminedit" id="fadminedit" class="<?php echo $admin_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="admin">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$admin_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($admin_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_admin_id" class="<?php echo $admin_edit->LeftColumnClass ?>"><?php echo $admin_edit->id->caption() ?><?php echo $admin_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $admin_edit->RightColumnClass ?>"><div <?php echo $admin_edit->id->cellAttributes() ?>>
<span id="el_admin_id">
<span<?php echo $admin_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($admin_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="admin" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($admin_edit->id->CurrentValue) ?>">
<?php echo $admin_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($admin_edit->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_admin_name" for="x_name" class="<?php echo $admin_edit->LeftColumnClass ?>"><?php echo $admin_edit->name->caption() ?><?php echo $admin_edit->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $admin_edit->RightColumnClass ?>"><div <?php echo $admin_edit->name->cellAttributes() ?>>
<span id="el_admin_name">
<input type="text" data-table="admin" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($admin_edit->name->getPlaceHolder()) ?>" value="<?php echo $admin_edit->name->EditValue ?>"<?php echo $admin_edit->name->editAttributes() ?>>
</span>
<?php echo $admin_edit->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($admin_edit->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_admin__email" for="x__email" class="<?php echo $admin_edit->LeftColumnClass ?>"><?php echo $admin_edit->_email->caption() ?><?php echo $admin_edit->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $admin_edit->RightColumnClass ?>"><div <?php echo $admin_edit->_email->cellAttributes() ?>>
<span id="el_admin__email">
<input type="text" data-table="admin" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($admin_edit->_email->getPlaceHolder()) ?>" value="<?php echo $admin_edit->_email->EditValue ?>"<?php echo $admin_edit->_email->editAttributes() ?>>
</span>
<?php echo $admin_edit->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($admin_edit->password->Visible) { // password ?>
	<div id="r_password" class="form-group row">
		<label id="elh_admin_password" for="x_password" class="<?php echo $admin_edit->LeftColumnClass ?>"><?php echo $admin_edit->password->caption() ?><?php echo $admin_edit->password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $admin_edit->RightColumnClass ?>"><div <?php echo $admin_edit->password->cellAttributes() ?>>
<span id="el_admin_password">
<input type="text" data-table="admin" data-field="x_password" name="x_password" id="x_password" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($admin_edit->password->getPlaceHolder()) ?>" value="<?php echo $admin_edit->password->EditValue ?>"<?php echo $admin_edit->password->editAttributes() ?>>
</span>
<?php echo $admin_edit->password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($admin_edit->address->Visible) { // address ?>
	<div id="r_address" class="form-group row">
		<label id="elh_admin_address" for="x_address" class="<?php echo $admin_edit->LeftColumnClass ?>"><?php echo $admin_edit->address->caption() ?><?php echo $admin_edit->address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $admin_edit->RightColumnClass ?>"><div <?php echo $admin_edit->address->cellAttributes() ?>>
<span id="el_admin_address">
<input type="text" data-table="admin" data-field="x_address" name="x_address" id="x_address" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($admin_edit->address->getPlaceHolder()) ?>" value="<?php echo $admin_edit->address->EditValue ?>"<?php echo $admin_edit->address->editAttributes() ?>>
</span>
<?php echo $admin_edit->address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($admin_edit->mobile->Visible) { // mobile ?>
	<div id="r_mobile" class="form-group row">
		<label id="elh_admin_mobile" for="x_mobile" class="<?php echo $admin_edit->LeftColumnClass ?>"><?php echo $admin_edit->mobile->caption() ?><?php echo $admin_edit->mobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $admin_edit->RightColumnClass ?>"><div <?php echo $admin_edit->mobile->cellAttributes() ?>>
<span id="el_admin_mobile">
<input type="text" data-table="admin" data-field="x_mobile" name="x_mobile" id="x_mobile" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($admin_edit->mobile->getPlaceHolder()) ?>" value="<?php echo $admin_edit->mobile->EditValue ?>"<?php echo $admin_edit->mobile->editAttributes() ?>>
</span>
<?php echo $admin_edit->mobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$admin_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $admin_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $admin_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$admin_edit->showPageFooter();
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
$admin_edit->terminate();
?>