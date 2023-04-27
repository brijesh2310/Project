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
$area_add = new area_add();

// Run the page
$area_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$area_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fareaadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fareaadd = currentForm = new ew.Form("fareaadd", "add");

	// Validate form
	fareaadd.validate = function() {
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
			<?php if ($area_add->area_name->Required) { ?>
				elm = this.getElements("x" + infix + "_area_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $area_add->area_name->caption(), $area_add->area_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($area_add->city_name->Required) { ?>
				elm = this.getElements("x" + infix + "_city_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $area_add->city_name->caption(), $area_add->city_name->RequiredErrorMessage)) ?>");
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
	fareaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fareaadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fareaadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $area_add->showPageHeader(); ?>
<?php
$area_add->showMessage();
?>
<form name="fareaadd" id="fareaadd" class="<?php echo $area_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="area">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$area_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($area_add->area_name->Visible) { // area_name ?>
	<div id="r_area_name" class="form-group row">
		<label id="elh_area_area_name" for="x_area_name" class="<?php echo $area_add->LeftColumnClass ?>"><?php echo $area_add->area_name->caption() ?><?php echo $area_add->area_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $area_add->RightColumnClass ?>"><div <?php echo $area_add->area_name->cellAttributes() ?>>
<span id="el_area_area_name">
<input type="text" data-table="area" data-field="x_area_name" name="x_area_name" id="x_area_name" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($area_add->area_name->getPlaceHolder()) ?>" value="<?php echo $area_add->area_name->EditValue ?>"<?php echo $area_add->area_name->editAttributes() ?>>
</span>
<?php echo $area_add->area_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($area_add->city_name->Visible) { // city_name ?>
	<div id="r_city_name" class="form-group row">
		<label id="elh_area_city_name" for="x_city_name" class="<?php echo $area_add->LeftColumnClass ?>"><?php echo $area_add->city_name->caption() ?><?php echo $area_add->city_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $area_add->RightColumnClass ?>"><div <?php echo $area_add->city_name->cellAttributes() ?>>
<span id="el_area_city_name">
<input type="text" data-table="area" data-field="x_city_name" name="x_city_name" id="x_city_name" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($area_add->city_name->getPlaceHolder()) ?>" value="<?php echo $area_add->city_name->EditValue ?>"<?php echo $area_add->city_name->editAttributes() ?>>
</span>
<?php echo $area_add->city_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$area_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $area_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $area_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$area_add->showPageFooter();
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
$area_add->terminate();
?>