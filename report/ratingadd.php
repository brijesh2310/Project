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
$rating_add = new rating_add();

// Run the page
$rating_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rating_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fratingadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fratingadd = currentForm = new ew.Form("fratingadd", "add");

	// Validate form
	fratingadd.validate = function() {
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
			<?php if ($rating_add->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rating_add->name->caption(), $rating_add->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rating_add->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rating_add->_email->caption(), $rating_add->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rating_add->rate->Required) { ?>
				elm = this.getElements("x" + infix + "_rate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rating_add->rate->caption(), $rating_add->rate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_rate");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rating_add->rate->errorMessage()) ?>");

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
	fratingadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fratingadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fratingadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $rating_add->showPageHeader(); ?>
<?php
$rating_add->showMessage();
?>
<form name="fratingadd" id="fratingadd" class="<?php echo $rating_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rating">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$rating_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($rating_add->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_rating_name" for="x_name" class="<?php echo $rating_add->LeftColumnClass ?>"><?php echo $rating_add->name->caption() ?><?php echo $rating_add->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rating_add->RightColumnClass ?>"><div <?php echo $rating_add->name->cellAttributes() ?>>
<span id="el_rating_name">
<input type="text" data-table="rating" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($rating_add->name->getPlaceHolder()) ?>" value="<?php echo $rating_add->name->EditValue ?>"<?php echo $rating_add->name->editAttributes() ?>>
</span>
<?php echo $rating_add->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rating_add->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_rating__email" for="x__email" class="<?php echo $rating_add->LeftColumnClass ?>"><?php echo $rating_add->_email->caption() ?><?php echo $rating_add->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rating_add->RightColumnClass ?>"><div <?php echo $rating_add->_email->cellAttributes() ?>>
<span id="el_rating__email">
<input type="text" data-table="rating" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($rating_add->_email->getPlaceHolder()) ?>" value="<?php echo $rating_add->_email->EditValue ?>"<?php echo $rating_add->_email->editAttributes() ?>>
</span>
<?php echo $rating_add->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rating_add->rate->Visible) { // rate ?>
	<div id="r_rate" class="form-group row">
		<label id="elh_rating_rate" for="x_rate" class="<?php echo $rating_add->LeftColumnClass ?>"><?php echo $rating_add->rate->caption() ?><?php echo $rating_add->rate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rating_add->RightColumnClass ?>"><div <?php echo $rating_add->rate->cellAttributes() ?>>
<span id="el_rating_rate">
<input type="text" data-table="rating" data-field="x_rate" name="x_rate" id="x_rate" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($rating_add->rate->getPlaceHolder()) ?>" value="<?php echo $rating_add->rate->EditValue ?>"<?php echo $rating_add->rate->editAttributes() ?>>
</span>
<?php echo $rating_add->rate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$rating_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $rating_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $rating_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$rating_add->showPageFooter();
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
$rating_add->terminate();
?>