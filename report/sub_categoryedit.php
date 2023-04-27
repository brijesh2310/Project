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
$sub_category_edit = new sub_category_edit();

// Run the page
$sub_category_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sub_category_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsub_categoryedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fsub_categoryedit = currentForm = new ew.Form("fsub_categoryedit", "edit");

	// Validate form
	fsub_categoryedit.validate = function() {
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
			<?php if ($sub_category_edit->subcategory_id->Required) { ?>
				elm = this.getElements("x" + infix + "_subcategory_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sub_category_edit->subcategory_id->caption(), $sub_category_edit->subcategory_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sub_category_edit->subcategory_name->Required) { ?>
				elm = this.getElements("x" + infix + "_subcategory_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sub_category_edit->subcategory_name->caption(), $sub_category_edit->subcategory_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sub_category_edit->subcategory_img->Required) { ?>
				elm = this.getElements("x" + infix + "_subcategory_img");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sub_category_edit->subcategory_img->caption(), $sub_category_edit->subcategory_img->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sub_category_edit->category_name->Required) { ?>
				elm = this.getElements("x" + infix + "_category_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sub_category_edit->category_name->caption(), $sub_category_edit->category_name->RequiredErrorMessage)) ?>");
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
	fsub_categoryedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsub_categoryedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsub_categoryedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $sub_category_edit->showPageHeader(); ?>
<?php
$sub_category_edit->showMessage();
?>
<form name="fsub_categoryedit" id="fsub_categoryedit" class="<?php echo $sub_category_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sub_category">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$sub_category_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($sub_category_edit->subcategory_id->Visible) { // subcategory_id ?>
	<div id="r_subcategory_id" class="form-group row">
		<label id="elh_sub_category_subcategory_id" class="<?php echo $sub_category_edit->LeftColumnClass ?>"><?php echo $sub_category_edit->subcategory_id->caption() ?><?php echo $sub_category_edit->subcategory_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sub_category_edit->RightColumnClass ?>"><div <?php echo $sub_category_edit->subcategory_id->cellAttributes() ?>>
<span id="el_sub_category_subcategory_id">
<span<?php echo $sub_category_edit->subcategory_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($sub_category_edit->subcategory_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="sub_category" data-field="x_subcategory_id" name="x_subcategory_id" id="x_subcategory_id" value="<?php echo HtmlEncode($sub_category_edit->subcategory_id->CurrentValue) ?>">
<?php echo $sub_category_edit->subcategory_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sub_category_edit->subcategory_name->Visible) { // subcategory_name ?>
	<div id="r_subcategory_name" class="form-group row">
		<label id="elh_sub_category_subcategory_name" for="x_subcategory_name" class="<?php echo $sub_category_edit->LeftColumnClass ?>"><?php echo $sub_category_edit->subcategory_name->caption() ?><?php echo $sub_category_edit->subcategory_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sub_category_edit->RightColumnClass ?>"><div <?php echo $sub_category_edit->subcategory_name->cellAttributes() ?>>
<span id="el_sub_category_subcategory_name">
<input type="text" data-table="sub_category" data-field="x_subcategory_name" name="x_subcategory_name" id="x_subcategory_name" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($sub_category_edit->subcategory_name->getPlaceHolder()) ?>" value="<?php echo $sub_category_edit->subcategory_name->EditValue ?>"<?php echo $sub_category_edit->subcategory_name->editAttributes() ?>>
</span>
<?php echo $sub_category_edit->subcategory_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sub_category_edit->subcategory_img->Visible) { // subcategory_img ?>
	<div id="r_subcategory_img" class="form-group row">
		<label id="elh_sub_category_subcategory_img" for="x_subcategory_img" class="<?php echo $sub_category_edit->LeftColumnClass ?>"><?php echo $sub_category_edit->subcategory_img->caption() ?><?php echo $sub_category_edit->subcategory_img->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sub_category_edit->RightColumnClass ?>"><div <?php echo $sub_category_edit->subcategory_img->cellAttributes() ?>>
<span id="el_sub_category_subcategory_img">
<input type="text" data-table="sub_category" data-field="x_subcategory_img" name="x_subcategory_img" id="x_subcategory_img" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($sub_category_edit->subcategory_img->getPlaceHolder()) ?>" value="<?php echo $sub_category_edit->subcategory_img->EditValue ?>"<?php echo $sub_category_edit->subcategory_img->editAttributes() ?>>
</span>
<?php echo $sub_category_edit->subcategory_img->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sub_category_edit->category_name->Visible) { // category_name ?>
	<div id="r_category_name" class="form-group row">
		<label id="elh_sub_category_category_name" for="x_category_name" class="<?php echo $sub_category_edit->LeftColumnClass ?>"><?php echo $sub_category_edit->category_name->caption() ?><?php echo $sub_category_edit->category_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sub_category_edit->RightColumnClass ?>"><div <?php echo $sub_category_edit->category_name->cellAttributes() ?>>
<span id="el_sub_category_category_name">
<input type="text" data-table="sub_category" data-field="x_category_name" name="x_category_name" id="x_category_name" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($sub_category_edit->category_name->getPlaceHolder()) ?>" value="<?php echo $sub_category_edit->category_name->EditValue ?>"<?php echo $sub_category_edit->category_name->editAttributes() ?>>
</span>
<?php echo $sub_category_edit->category_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$sub_category_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $sub_category_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $sub_category_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$sub_category_edit->showPageFooter();
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
$sub_category_edit->terminate();
?>