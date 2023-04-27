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
$sub_category_add = new sub_category_add();

// Run the page
$sub_category_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sub_category_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsub_categoryadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fsub_categoryadd = currentForm = new ew.Form("fsub_categoryadd", "add");

	// Validate form
	fsub_categoryadd.validate = function() {
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
			<?php if ($sub_category_add->subcategory_name->Required) { ?>
				elm = this.getElements("x" + infix + "_subcategory_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sub_category_add->subcategory_name->caption(), $sub_category_add->subcategory_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sub_category_add->subcategory_img->Required) { ?>
				elm = this.getElements("x" + infix + "_subcategory_img");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sub_category_add->subcategory_img->caption(), $sub_category_add->subcategory_img->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sub_category_add->category_name->Required) { ?>
				elm = this.getElements("x" + infix + "_category_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sub_category_add->category_name->caption(), $sub_category_add->category_name->RequiredErrorMessage)) ?>");
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
	fsub_categoryadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsub_categoryadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsub_categoryadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $sub_category_add->showPageHeader(); ?>
<?php
$sub_category_add->showMessage();
?>
<form name="fsub_categoryadd" id="fsub_categoryadd" class="<?php echo $sub_category_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sub_category">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$sub_category_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($sub_category_add->subcategory_name->Visible) { // subcategory_name ?>
	<div id="r_subcategory_name" class="form-group row">
		<label id="elh_sub_category_subcategory_name" for="x_subcategory_name" class="<?php echo $sub_category_add->LeftColumnClass ?>"><?php echo $sub_category_add->subcategory_name->caption() ?><?php echo $sub_category_add->subcategory_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sub_category_add->RightColumnClass ?>"><div <?php echo $sub_category_add->subcategory_name->cellAttributes() ?>>
<span id="el_sub_category_subcategory_name">
<input type="text" data-table="sub_category" data-field="x_subcategory_name" name="x_subcategory_name" id="x_subcategory_name" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($sub_category_add->subcategory_name->getPlaceHolder()) ?>" value="<?php echo $sub_category_add->subcategory_name->EditValue ?>"<?php echo $sub_category_add->subcategory_name->editAttributes() ?>>
</span>
<?php echo $sub_category_add->subcategory_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sub_category_add->subcategory_img->Visible) { // subcategory_img ?>
	<div id="r_subcategory_img" class="form-group row">
		<label id="elh_sub_category_subcategory_img" for="x_subcategory_img" class="<?php echo $sub_category_add->LeftColumnClass ?>"><?php echo $sub_category_add->subcategory_img->caption() ?><?php echo $sub_category_add->subcategory_img->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sub_category_add->RightColumnClass ?>"><div <?php echo $sub_category_add->subcategory_img->cellAttributes() ?>>
<span id="el_sub_category_subcategory_img">
<input type="text" data-table="sub_category" data-field="x_subcategory_img" name="x_subcategory_img" id="x_subcategory_img" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($sub_category_add->subcategory_img->getPlaceHolder()) ?>" value="<?php echo $sub_category_add->subcategory_img->EditValue ?>"<?php echo $sub_category_add->subcategory_img->editAttributes() ?>>
</span>
<?php echo $sub_category_add->subcategory_img->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sub_category_add->category_name->Visible) { // category_name ?>
	<div id="r_category_name" class="form-group row">
		<label id="elh_sub_category_category_name" for="x_category_name" class="<?php echo $sub_category_add->LeftColumnClass ?>"><?php echo $sub_category_add->category_name->caption() ?><?php echo $sub_category_add->category_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sub_category_add->RightColumnClass ?>"><div <?php echo $sub_category_add->category_name->cellAttributes() ?>>
<span id="el_sub_category_category_name">
<input type="text" data-table="sub_category" data-field="x_category_name" name="x_category_name" id="x_category_name" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($sub_category_add->category_name->getPlaceHolder()) ?>" value="<?php echo $sub_category_add->category_name->EditValue ?>"<?php echo $sub_category_add->category_name->editAttributes() ?>>
</span>
<?php echo $sub_category_add->category_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$sub_category_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $sub_category_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $sub_category_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$sub_category_add->showPageFooter();
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
$sub_category_add->terminate();
?>