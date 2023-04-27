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
$category_edit = new category_edit();

// Run the page
$category_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$category_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcategoryedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcategoryedit = currentForm = new ew.Form("fcategoryedit", "edit");

	// Validate form
	fcategoryedit.validate = function() {
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
			<?php if ($category_edit->category_id->Required) { ?>
				elm = this.getElements("x" + infix + "_category_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $category_edit->category_id->caption(), $category_edit->category_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($category_edit->category_name->Required) { ?>
				elm = this.getElements("x" + infix + "_category_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $category_edit->category_name->caption(), $category_edit->category_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($category_edit->category_img->Required) { ?>
				elm = this.getElements("x" + infix + "_category_img");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $category_edit->category_img->caption(), $category_edit->category_img->RequiredErrorMessage)) ?>");
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
	fcategoryedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcategoryedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcategoryedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $category_edit->showPageHeader(); ?>
<?php
$category_edit->showMessage();
?>
<form name="fcategoryedit" id="fcategoryedit" class="<?php echo $category_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="category">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$category_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($category_edit->category_id->Visible) { // category_id ?>
	<div id="r_category_id" class="form-group row">
		<label id="elh_category_category_id" class="<?php echo $category_edit->LeftColumnClass ?>"><?php echo $category_edit->category_id->caption() ?><?php echo $category_edit->category_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $category_edit->RightColumnClass ?>"><div <?php echo $category_edit->category_id->cellAttributes() ?>>
<span id="el_category_category_id">
<span<?php echo $category_edit->category_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($category_edit->category_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="category" data-field="x_category_id" name="x_category_id" id="x_category_id" value="<?php echo HtmlEncode($category_edit->category_id->CurrentValue) ?>">
<?php echo $category_edit->category_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($category_edit->category_name->Visible) { // category_name ?>
	<div id="r_category_name" class="form-group row">
		<label id="elh_category_category_name" for="x_category_name" class="<?php echo $category_edit->LeftColumnClass ?>"><?php echo $category_edit->category_name->caption() ?><?php echo $category_edit->category_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $category_edit->RightColumnClass ?>"><div <?php echo $category_edit->category_name->cellAttributes() ?>>
<span id="el_category_category_name">
<input type="text" data-table="category" data-field="x_category_name" name="x_category_name" id="x_category_name" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($category_edit->category_name->getPlaceHolder()) ?>" value="<?php echo $category_edit->category_name->EditValue ?>"<?php echo $category_edit->category_name->editAttributes() ?>>
</span>
<?php echo $category_edit->category_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($category_edit->category_img->Visible) { // category_img ?>
	<div id="r_category_img" class="form-group row">
		<label id="elh_category_category_img" for="x_category_img" class="<?php echo $category_edit->LeftColumnClass ?>"><?php echo $category_edit->category_img->caption() ?><?php echo $category_edit->category_img->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $category_edit->RightColumnClass ?>"><div <?php echo $category_edit->category_img->cellAttributes() ?>>
<span id="el_category_category_img">
<input type="text" data-table="category" data-field="x_category_img" name="x_category_img" id="x_category_img" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($category_edit->category_img->getPlaceHolder()) ?>" value="<?php echo $category_edit->category_img->EditValue ?>"<?php echo $category_edit->category_img->editAttributes() ?>>
</span>
<?php echo $category_edit->category_img->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$category_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $category_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $category_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$category_edit->showPageFooter();
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
$category_edit->terminate();
?>