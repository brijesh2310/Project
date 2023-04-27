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
$admin_add = new admin_add();

// Run the page
$admin_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$admin_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fadminadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fadminadd = currentForm = new ew.Form("fadminadd", "add");

	// Validate form
	fadminadd.validate = function() {
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
			<?php if ($admin_add->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin_add->name->caption(), $admin_add->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($admin_add->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin_add->_email->caption(), $admin_add->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($admin_add->password->Required) { ?>
				elm = this.getElements("x" + infix + "_password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin_add->password->caption(), $admin_add->password->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($admin_add->address->Required) { ?>
				elm = this.getElements("x" + infix + "_address");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin_add->address->caption(), $admin_add->address->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($admin_add->mobile->Required) { ?>
				elm = this.getElements("x" + infix + "_mobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin_add->mobile->caption(), $admin_add->mobile->RequiredErrorMessage)) ?>");
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
	fadminadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fadminadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fadminadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $admin_add->showPageHeader(); ?>
<?php
$admin_add->showMessage();
?>
<form name="fadminadd" id="fadminadd" class="<?php echo $admin_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="admin">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$admin_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($admin_add->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_admin_name" for="x_name" class="<?php echo $admin_add->LeftColumnClass ?>"><?php echo $admin_add->name->caption() ?><?php echo $admin_add->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $admin_add->RightColumnClass ?>"><div <?php echo $admin_add->name->cellAttributes() ?>>
<span id="el_admin_name">
<input type="text" data-table="admin" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($admin_add->name->getPlaceHolder()) ?>" value="<?php echo $admin_add->name->EditValue ?>"<?php echo $admin_add->name->editAttributes() ?>>
</span>
<?php echo $admin_add->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($admin_add->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_admin__email" for="x__email" class="<?php echo $admin_add->LeftColumnClass ?>"><?php echo $admin_add->_email->caption() ?><?php echo $admin_add->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $admin_add->RightColumnClass ?>"><div <?php echo $admin_add->_email->cellAttributes() ?>>
<span id="el_admin__email">
<input type="text" data-table="admin" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($admin_add->_email->getPlaceHolder()) ?>" value="<?php echo $admin_add->_email->EditValue ?>"<?php echo $admin_add->_email->editAttributes() ?>>
</span>
<?php echo $admin_add->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($admin_add->password->Visible) { // password ?>
	<div id="r_password" class="form-group row">
		<label id="elh_admin_password" for="x_password" class="<?php echo $admin_add->LeftColumnClass ?>"><?php echo $admin_add->password->caption() ?><?php echo $admin_add->password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $admin_add->RightColumnClass ?>"><div <?php echo $admin_add->password->cellAttributes() ?>>
<span id="el_admin_password">
<input type="text" data-table="admin" data-field="x_password" name="x_password" id="x_password" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($admin_add->password->getPlaceHolder()) ?>" value="<?php echo $admin_add->password->EditValue ?>"<?php echo $admin_add->password->editAttributes() ?>>
</span>
<?php echo $admin_add->password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($admin_add->address->Visible) { // address ?>
	<div id="r_address" class="form-group row">
		<label id="elh_admin_address" for="x_address" class="<?php echo $admin_add->LeftColumnClass ?>"><?php echo $admin_add->address->caption() ?><?php echo $admin_add->address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $admin_add->RightColumnClass ?>"><div <?php echo $admin_add->address->cellAttributes() ?>>
<span id="el_admin_address">
<input type="text" data-table="admin" data-field="x_address" name="x_address" id="x_address" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($admin_add->address->getPlaceHolder()) ?>" value="<?php echo $admin_add->address->EditValue ?>"<?php echo $admin_add->address->editAttributes() ?>>
</span>
<?php echo $admin_add->address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($admin_add->mobile->Visible) { // mobile ?>
	<div id="r_mobile" class="form-group row">
		<label id="elh_admin_mobile" for="x_mobile" class="<?php echo $admin_add->LeftColumnClass ?>"><?php echo $admin_add->mobile->caption() ?><?php echo $admin_add->mobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $admin_add->RightColumnClass ?>"><div <?php echo $admin_add->mobile->cellAttributes() ?>>
<span id="el_admin_mobile">
<input type="text" data-table="admin" data-field="x_mobile" name="x_mobile" id="x_mobile" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($admin_add->mobile->getPlaceHolder()) ?>" value="<?php echo $admin_add->mobile->EditValue ?>"<?php echo $admin_add->mobile->editAttributes() ?>>
</span>
<?php echo $admin_add->mobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$admin_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $admin_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $admin_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$admin_add->showPageFooter();
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
$admin_add->terminate();
?>