<?php
namespace PHPMaker2020\project1;

/**
 * Page class
 */
class payment_add extends payment
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{2F902718-E095-40A0-B9CA-0712EAB83BB8}";

	// Table name
	public $TableName = 'payment';

	// Page object name
	public $PageObjName = "payment_add";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (payment)
		if (!isset($GLOBALS["payment"]) || get_class($GLOBALS["payment"]) == PROJECT_NAMESPACE . "payment") {
			$GLOBALS["payment"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["payment"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'payment');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $payment;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($payment);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "paymentview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['a_id'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->a_id->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!$this->setupApiRequest())
			return FALSE;

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API request
	public function setupApiRequest()
	{
		global $Security;

		// Check security for API request
		If (ValidApiRequest()) {
			return TRUE;
		}
		return FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (!$this->setupApiRequest()) {
			$Security = new AdvancedSecurity();
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->a_id->Visible = FALSE;
		$this->o_id->setVisibility();
		$this->name->setVisibility();
		$this->_email->setVisibility();
		$this->mobile_no->setVisibility();
		$this->billing_address->setVisibility();
		$this->shipping_address->setVisibility();
		$this->city->setVisibility();
		$this->state->setVisibility();
		$this->pincode->setVisibility();
		$this->payment_method->setVisibility();
		$this->card_no->setVisibility();
		$this->expiry_date->setVisibility();
		$this->order_date->setVisibility();
		$this->product_name->setVisibility();
		$this->product_quantity->setVisibility();
		$this->product_price->setVisibility();
		$this->total_price->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		// Check modal

		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("a_id") !== NULL) {
				$this->a_id->setQueryStringValue(Get("a_id"));
				$this->setKey("a_id", $this->a_id->CurrentValue); // Set up key
			} else {
				$this->setKey("a_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("paymentlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "paymentlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "paymentview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->a_id->CurrentValue = NULL;
		$this->a_id->OldValue = $this->a_id->CurrentValue;
		$this->o_id->CurrentValue = NULL;
		$this->o_id->OldValue = $this->o_id->CurrentValue;
		$this->name->CurrentValue = NULL;
		$this->name->OldValue = $this->name->CurrentValue;
		$this->_email->CurrentValue = NULL;
		$this->_email->OldValue = $this->_email->CurrentValue;
		$this->mobile_no->CurrentValue = NULL;
		$this->mobile_no->OldValue = $this->mobile_no->CurrentValue;
		$this->billing_address->CurrentValue = NULL;
		$this->billing_address->OldValue = $this->billing_address->CurrentValue;
		$this->shipping_address->CurrentValue = NULL;
		$this->shipping_address->OldValue = $this->shipping_address->CurrentValue;
		$this->city->CurrentValue = NULL;
		$this->city->OldValue = $this->city->CurrentValue;
		$this->state->CurrentValue = NULL;
		$this->state->OldValue = $this->state->CurrentValue;
		$this->pincode->CurrentValue = NULL;
		$this->pincode->OldValue = $this->pincode->CurrentValue;
		$this->payment_method->CurrentValue = NULL;
		$this->payment_method->OldValue = $this->payment_method->CurrentValue;
		$this->card_no->CurrentValue = NULL;
		$this->card_no->OldValue = $this->card_no->CurrentValue;
		$this->expiry_date->CurrentValue = NULL;
		$this->expiry_date->OldValue = $this->expiry_date->CurrentValue;
		$this->order_date->CurrentValue = NULL;
		$this->order_date->OldValue = $this->order_date->CurrentValue;
		$this->product_name->CurrentValue = NULL;
		$this->product_name->OldValue = $this->product_name->CurrentValue;
		$this->product_quantity->CurrentValue = NULL;
		$this->product_quantity->OldValue = $this->product_quantity->CurrentValue;
		$this->product_price->CurrentValue = NULL;
		$this->product_price->OldValue = $this->product_price->CurrentValue;
		$this->total_price->CurrentValue = NULL;
		$this->total_price->OldValue = $this->total_price->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'o_id' first before field var 'x_o_id'
		$val = $CurrentForm->hasValue("o_id") ? $CurrentForm->getValue("o_id") : $CurrentForm->getValue("x_o_id");
		if (!$this->o_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->o_id->Visible = FALSE; // Disable update for API request
			else
				$this->o_id->setFormValue($val);
		}

		// Check field name 'name' first before field var 'x_name'
		$val = $CurrentForm->hasValue("name") ? $CurrentForm->getValue("name") : $CurrentForm->getValue("x_name");
		if (!$this->name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->name->Visible = FALSE; // Disable update for API request
			else
				$this->name->setFormValue($val);
		}

		// Check field name 'email' first before field var 'x__email'
		$val = $CurrentForm->hasValue("email") ? $CurrentForm->getValue("email") : $CurrentForm->getValue("x__email");
		if (!$this->_email->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_email->Visible = FALSE; // Disable update for API request
			else
				$this->_email->setFormValue($val);
		}

		// Check field name 'mobile_no' first before field var 'x_mobile_no'
		$val = $CurrentForm->hasValue("mobile_no") ? $CurrentForm->getValue("mobile_no") : $CurrentForm->getValue("x_mobile_no");
		if (!$this->mobile_no->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->mobile_no->Visible = FALSE; // Disable update for API request
			else
				$this->mobile_no->setFormValue($val);
		}

		// Check field name 'billing_address' first before field var 'x_billing_address'
		$val = $CurrentForm->hasValue("billing_address") ? $CurrentForm->getValue("billing_address") : $CurrentForm->getValue("x_billing_address");
		if (!$this->billing_address->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->billing_address->Visible = FALSE; // Disable update for API request
			else
				$this->billing_address->setFormValue($val);
		}

		// Check field name 'shipping_address' first before field var 'x_shipping_address'
		$val = $CurrentForm->hasValue("shipping_address") ? $CurrentForm->getValue("shipping_address") : $CurrentForm->getValue("x_shipping_address");
		if (!$this->shipping_address->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->shipping_address->Visible = FALSE; // Disable update for API request
			else
				$this->shipping_address->setFormValue($val);
		}

		// Check field name 'city' first before field var 'x_city'
		$val = $CurrentForm->hasValue("city") ? $CurrentForm->getValue("city") : $CurrentForm->getValue("x_city");
		if (!$this->city->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->city->Visible = FALSE; // Disable update for API request
			else
				$this->city->setFormValue($val);
		}

		// Check field name 'state' first before field var 'x_state'
		$val = $CurrentForm->hasValue("state") ? $CurrentForm->getValue("state") : $CurrentForm->getValue("x_state");
		if (!$this->state->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->state->Visible = FALSE; // Disable update for API request
			else
				$this->state->setFormValue($val);
		}

		// Check field name 'pincode' first before field var 'x_pincode'
		$val = $CurrentForm->hasValue("pincode") ? $CurrentForm->getValue("pincode") : $CurrentForm->getValue("x_pincode");
		if (!$this->pincode->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pincode->Visible = FALSE; // Disable update for API request
			else
				$this->pincode->setFormValue($val);
		}

		// Check field name 'payment_method' first before field var 'x_payment_method'
		$val = $CurrentForm->hasValue("payment_method") ? $CurrentForm->getValue("payment_method") : $CurrentForm->getValue("x_payment_method");
		if (!$this->payment_method->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->payment_method->Visible = FALSE; // Disable update for API request
			else
				$this->payment_method->setFormValue($val);
		}

		// Check field name 'card_no' first before field var 'x_card_no'
		$val = $CurrentForm->hasValue("card_no") ? $CurrentForm->getValue("card_no") : $CurrentForm->getValue("x_card_no");
		if (!$this->card_no->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->card_no->Visible = FALSE; // Disable update for API request
			else
				$this->card_no->setFormValue($val);
		}

		// Check field name 'expiry_date' first before field var 'x_expiry_date'
		$val = $CurrentForm->hasValue("expiry_date") ? $CurrentForm->getValue("expiry_date") : $CurrentForm->getValue("x_expiry_date");
		if (!$this->expiry_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->expiry_date->Visible = FALSE; // Disable update for API request
			else
				$this->expiry_date->setFormValue($val);
		}

		// Check field name 'order_date' first before field var 'x_order_date'
		$val = $CurrentForm->hasValue("order_date") ? $CurrentForm->getValue("order_date") : $CurrentForm->getValue("x_order_date");
		if (!$this->order_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->order_date->Visible = FALSE; // Disable update for API request
			else
				$this->order_date->setFormValue($val);
		}

		// Check field name 'product_name' first before field var 'x_product_name'
		$val = $CurrentForm->hasValue("product_name") ? $CurrentForm->getValue("product_name") : $CurrentForm->getValue("x_product_name");
		if (!$this->product_name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->product_name->Visible = FALSE; // Disable update for API request
			else
				$this->product_name->setFormValue($val);
		}

		// Check field name 'product_quantity' first before field var 'x_product_quantity'
		$val = $CurrentForm->hasValue("product_quantity") ? $CurrentForm->getValue("product_quantity") : $CurrentForm->getValue("x_product_quantity");
		if (!$this->product_quantity->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->product_quantity->Visible = FALSE; // Disable update for API request
			else
				$this->product_quantity->setFormValue($val);
		}

		// Check field name 'product_price' first before field var 'x_product_price'
		$val = $CurrentForm->hasValue("product_price") ? $CurrentForm->getValue("product_price") : $CurrentForm->getValue("x_product_price");
		if (!$this->product_price->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->product_price->Visible = FALSE; // Disable update for API request
			else
				$this->product_price->setFormValue($val);
		}

		// Check field name 'total_price' first before field var 'x_total_price'
		$val = $CurrentForm->hasValue("total_price") ? $CurrentForm->getValue("total_price") : $CurrentForm->getValue("x_total_price");
		if (!$this->total_price->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->total_price->Visible = FALSE; // Disable update for API request
			else
				$this->total_price->setFormValue($val);
		}

		// Check field name 'a_id' first before field var 'x_a_id'
		$val = $CurrentForm->hasValue("a_id") ? $CurrentForm->getValue("a_id") : $CurrentForm->getValue("x_a_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->o_id->CurrentValue = $this->o_id->FormValue;
		$this->name->CurrentValue = $this->name->FormValue;
		$this->_email->CurrentValue = $this->_email->FormValue;
		$this->mobile_no->CurrentValue = $this->mobile_no->FormValue;
		$this->billing_address->CurrentValue = $this->billing_address->FormValue;
		$this->shipping_address->CurrentValue = $this->shipping_address->FormValue;
		$this->city->CurrentValue = $this->city->FormValue;
		$this->state->CurrentValue = $this->state->FormValue;
		$this->pincode->CurrentValue = $this->pincode->FormValue;
		$this->payment_method->CurrentValue = $this->payment_method->FormValue;
		$this->card_no->CurrentValue = $this->card_no->FormValue;
		$this->expiry_date->CurrentValue = $this->expiry_date->FormValue;
		$this->order_date->CurrentValue = $this->order_date->FormValue;
		$this->product_name->CurrentValue = $this->product_name->FormValue;
		$this->product_quantity->CurrentValue = $this->product_quantity->FormValue;
		$this->product_price->CurrentValue = $this->product_price->FormValue;
		$this->total_price->CurrentValue = $this->total_price->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->a_id->setDbValue($row['a_id']);
		$this->o_id->setDbValue($row['o_id']);
		$this->name->setDbValue($row['name']);
		$this->_email->setDbValue($row['email']);
		$this->mobile_no->setDbValue($row['mobile_no']);
		$this->billing_address->setDbValue($row['billing_address']);
		$this->shipping_address->setDbValue($row['shipping_address']);
		$this->city->setDbValue($row['city']);
		$this->state->setDbValue($row['state']);
		$this->pincode->setDbValue($row['pincode']);
		$this->payment_method->setDbValue($row['payment_method']);
		$this->card_no->setDbValue($row['card_no']);
		$this->expiry_date->setDbValue($row['expiry_date']);
		$this->order_date->setDbValue($row['order_date']);
		$this->product_name->setDbValue($row['product_name']);
		$this->product_quantity->setDbValue($row['product_quantity']);
		$this->product_price->setDbValue($row['product_price']);
		$this->total_price->setDbValue($row['total_price']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['a_id'] = $this->a_id->CurrentValue;
		$row['o_id'] = $this->o_id->CurrentValue;
		$row['name'] = $this->name->CurrentValue;
		$row['email'] = $this->_email->CurrentValue;
		$row['mobile_no'] = $this->mobile_no->CurrentValue;
		$row['billing_address'] = $this->billing_address->CurrentValue;
		$row['shipping_address'] = $this->shipping_address->CurrentValue;
		$row['city'] = $this->city->CurrentValue;
		$row['state'] = $this->state->CurrentValue;
		$row['pincode'] = $this->pincode->CurrentValue;
		$row['payment_method'] = $this->payment_method->CurrentValue;
		$row['card_no'] = $this->card_no->CurrentValue;
		$row['expiry_date'] = $this->expiry_date->CurrentValue;
		$row['order_date'] = $this->order_date->CurrentValue;
		$row['product_name'] = $this->product_name->CurrentValue;
		$row['product_quantity'] = $this->product_quantity->CurrentValue;
		$row['product_price'] = $this->product_price->CurrentValue;
		$row['total_price'] = $this->total_price->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("a_id")) != "")
			$this->a_id->OldValue = $this->getKey("a_id"); // a_id
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// a_id
		// o_id
		// name
		// email
		// mobile_no
		// billing_address
		// shipping_address
		// city
		// state
		// pincode
		// payment_method
		// card_no
		// expiry_date
		// order_date
		// product_name
		// product_quantity
		// product_price
		// total_price

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// a_id
			$this->a_id->ViewValue = $this->a_id->CurrentValue;
			$this->a_id->ViewCustomAttributes = "";

			// o_id
			$this->o_id->ViewValue = $this->o_id->CurrentValue;
			$this->o_id->ViewCustomAttributes = "";

			// name
			$this->name->ViewValue = $this->name->CurrentValue;
			$this->name->ViewCustomAttributes = "";

			// email
			$this->_email->ViewValue = $this->_email->CurrentValue;
			$this->_email->ViewCustomAttributes = "";

			// mobile_no
			$this->mobile_no->ViewValue = $this->mobile_no->CurrentValue;
			$this->mobile_no->ViewValue = FormatNumber($this->mobile_no->ViewValue, 0, -2, -2, -2);
			$this->mobile_no->ViewCustomAttributes = "";

			// billing_address
			$this->billing_address->ViewValue = $this->billing_address->CurrentValue;
			$this->billing_address->ViewCustomAttributes = "";

			// shipping_address
			$this->shipping_address->ViewValue = $this->shipping_address->CurrentValue;
			$this->shipping_address->ViewCustomAttributes = "";

			// city
			$this->city->ViewValue = $this->city->CurrentValue;
			$this->city->ViewCustomAttributes = "";

			// state
			$this->state->ViewValue = $this->state->CurrentValue;
			$this->state->ViewCustomAttributes = "";

			// pincode
			$this->pincode->ViewValue = $this->pincode->CurrentValue;
			$this->pincode->ViewValue = FormatNumber($this->pincode->ViewValue, 0, -2, -2, -2);
			$this->pincode->ViewCustomAttributes = "";

			// payment_method
			$this->payment_method->ViewValue = $this->payment_method->CurrentValue;
			$this->payment_method->ViewCustomAttributes = "";

			// card_no
			$this->card_no->ViewValue = $this->card_no->CurrentValue;
			$this->card_no->ViewValue = FormatNumber($this->card_no->ViewValue, 0, -2, -2, -2);
			$this->card_no->ViewCustomAttributes = "";

			// expiry_date
			$this->expiry_date->ViewValue = $this->expiry_date->CurrentValue;
			$this->expiry_date->ViewCustomAttributes = "";

			// order_date
			$this->order_date->ViewValue = $this->order_date->CurrentValue;
			$this->order_date->ViewCustomAttributes = "";

			// product_name
			$this->product_name->ViewValue = $this->product_name->CurrentValue;
			$this->product_name->ViewCustomAttributes = "";

			// product_quantity
			$this->product_quantity->ViewValue = $this->product_quantity->CurrentValue;
			$this->product_quantity->ViewValue = FormatNumber($this->product_quantity->ViewValue, 0, -2, -2, -2);
			$this->product_quantity->ViewCustomAttributes = "";

			// product_price
			$this->product_price->ViewValue = $this->product_price->CurrentValue;
			$this->product_price->ViewValue = FormatNumber($this->product_price->ViewValue, 0, -2, -2, -2);
			$this->product_price->ViewCustomAttributes = "";

			// total_price
			$this->total_price->ViewValue = $this->total_price->CurrentValue;
			$this->total_price->ViewValue = FormatNumber($this->total_price->ViewValue, 0, -2, -2, -2);
			$this->total_price->ViewCustomAttributes = "";

			// o_id
			$this->o_id->LinkCustomAttributes = "";
			$this->o_id->HrefValue = "";
			$this->o_id->TooltipValue = "";

			// name
			$this->name->LinkCustomAttributes = "";
			$this->name->HrefValue = "";
			$this->name->TooltipValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";
			$this->_email->TooltipValue = "";

			// mobile_no
			$this->mobile_no->LinkCustomAttributes = "";
			$this->mobile_no->HrefValue = "";
			$this->mobile_no->TooltipValue = "";

			// billing_address
			$this->billing_address->LinkCustomAttributes = "";
			$this->billing_address->HrefValue = "";
			$this->billing_address->TooltipValue = "";

			// shipping_address
			$this->shipping_address->LinkCustomAttributes = "";
			$this->shipping_address->HrefValue = "";
			$this->shipping_address->TooltipValue = "";

			// city
			$this->city->LinkCustomAttributes = "";
			$this->city->HrefValue = "";
			$this->city->TooltipValue = "";

			// state
			$this->state->LinkCustomAttributes = "";
			$this->state->HrefValue = "";
			$this->state->TooltipValue = "";

			// pincode
			$this->pincode->LinkCustomAttributes = "";
			$this->pincode->HrefValue = "";
			$this->pincode->TooltipValue = "";

			// payment_method
			$this->payment_method->LinkCustomAttributes = "";
			$this->payment_method->HrefValue = "";
			$this->payment_method->TooltipValue = "";

			// card_no
			$this->card_no->LinkCustomAttributes = "";
			$this->card_no->HrefValue = "";
			$this->card_no->TooltipValue = "";

			// expiry_date
			$this->expiry_date->LinkCustomAttributes = "";
			$this->expiry_date->HrefValue = "";
			$this->expiry_date->TooltipValue = "";

			// order_date
			$this->order_date->LinkCustomAttributes = "";
			$this->order_date->HrefValue = "";
			$this->order_date->TooltipValue = "";

			// product_name
			$this->product_name->LinkCustomAttributes = "";
			$this->product_name->HrefValue = "";
			$this->product_name->TooltipValue = "";

			// product_quantity
			$this->product_quantity->LinkCustomAttributes = "";
			$this->product_quantity->HrefValue = "";
			$this->product_quantity->TooltipValue = "";

			// product_price
			$this->product_price->LinkCustomAttributes = "";
			$this->product_price->HrefValue = "";
			$this->product_price->TooltipValue = "";

			// total_price
			$this->total_price->LinkCustomAttributes = "";
			$this->total_price->HrefValue = "";
			$this->total_price->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// o_id
			$this->o_id->EditAttrs["class"] = "form-control";
			$this->o_id->EditCustomAttributes = "";
			if (!$this->o_id->Raw)
				$this->o_id->CurrentValue = HtmlDecode($this->o_id->CurrentValue);
			$this->o_id->EditValue = HtmlEncode($this->o_id->CurrentValue);
			$this->o_id->PlaceHolder = RemoveHtml($this->o_id->caption());

			// name
			$this->name->EditAttrs["class"] = "form-control";
			$this->name->EditCustomAttributes = "";
			if (!$this->name->Raw)
				$this->name->CurrentValue = HtmlDecode($this->name->CurrentValue);
			$this->name->EditValue = HtmlEncode($this->name->CurrentValue);
			$this->name->PlaceHolder = RemoveHtml($this->name->caption());

			// email
			$this->_email->EditAttrs["class"] = "form-control";
			$this->_email->EditCustomAttributes = "";
			if (!$this->_email->Raw)
				$this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
			$this->_email->EditValue = HtmlEncode($this->_email->CurrentValue);
			$this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

			// mobile_no
			$this->mobile_no->EditAttrs["class"] = "form-control";
			$this->mobile_no->EditCustomAttributes = "";
			$this->mobile_no->EditValue = HtmlEncode($this->mobile_no->CurrentValue);
			$this->mobile_no->PlaceHolder = RemoveHtml($this->mobile_no->caption());

			// billing_address
			$this->billing_address->EditAttrs["class"] = "form-control";
			$this->billing_address->EditCustomAttributes = "";
			if (!$this->billing_address->Raw)
				$this->billing_address->CurrentValue = HtmlDecode($this->billing_address->CurrentValue);
			$this->billing_address->EditValue = HtmlEncode($this->billing_address->CurrentValue);
			$this->billing_address->PlaceHolder = RemoveHtml($this->billing_address->caption());

			// shipping_address
			$this->shipping_address->EditAttrs["class"] = "form-control";
			$this->shipping_address->EditCustomAttributes = "";
			if (!$this->shipping_address->Raw)
				$this->shipping_address->CurrentValue = HtmlDecode($this->shipping_address->CurrentValue);
			$this->shipping_address->EditValue = HtmlEncode($this->shipping_address->CurrentValue);
			$this->shipping_address->PlaceHolder = RemoveHtml($this->shipping_address->caption());

			// city
			$this->city->EditAttrs["class"] = "form-control";
			$this->city->EditCustomAttributes = "";
			if (!$this->city->Raw)
				$this->city->CurrentValue = HtmlDecode($this->city->CurrentValue);
			$this->city->EditValue = HtmlEncode($this->city->CurrentValue);
			$this->city->PlaceHolder = RemoveHtml($this->city->caption());

			// state
			$this->state->EditAttrs["class"] = "form-control";
			$this->state->EditCustomAttributes = "";
			if (!$this->state->Raw)
				$this->state->CurrentValue = HtmlDecode($this->state->CurrentValue);
			$this->state->EditValue = HtmlEncode($this->state->CurrentValue);
			$this->state->PlaceHolder = RemoveHtml($this->state->caption());

			// pincode
			$this->pincode->EditAttrs["class"] = "form-control";
			$this->pincode->EditCustomAttributes = "";
			$this->pincode->EditValue = HtmlEncode($this->pincode->CurrentValue);
			$this->pincode->PlaceHolder = RemoveHtml($this->pincode->caption());

			// payment_method
			$this->payment_method->EditAttrs["class"] = "form-control";
			$this->payment_method->EditCustomAttributes = "";
			if (!$this->payment_method->Raw)
				$this->payment_method->CurrentValue = HtmlDecode($this->payment_method->CurrentValue);
			$this->payment_method->EditValue = HtmlEncode($this->payment_method->CurrentValue);
			$this->payment_method->PlaceHolder = RemoveHtml($this->payment_method->caption());

			// card_no
			$this->card_no->EditAttrs["class"] = "form-control";
			$this->card_no->EditCustomAttributes = "";
			$this->card_no->EditValue = HtmlEncode($this->card_no->CurrentValue);
			$this->card_no->PlaceHolder = RemoveHtml($this->card_no->caption());

			// expiry_date
			$this->expiry_date->EditAttrs["class"] = "form-control";
			$this->expiry_date->EditCustomAttributes = "";
			if (!$this->expiry_date->Raw)
				$this->expiry_date->CurrentValue = HtmlDecode($this->expiry_date->CurrentValue);
			$this->expiry_date->EditValue = HtmlEncode($this->expiry_date->CurrentValue);
			$this->expiry_date->PlaceHolder = RemoveHtml($this->expiry_date->caption());

			// order_date
			$this->order_date->EditAttrs["class"] = "form-control";
			$this->order_date->EditCustomAttributes = "";
			if (!$this->order_date->Raw)
				$this->order_date->CurrentValue = HtmlDecode($this->order_date->CurrentValue);
			$this->order_date->EditValue = HtmlEncode($this->order_date->CurrentValue);
			$this->order_date->PlaceHolder = RemoveHtml($this->order_date->caption());

			// product_name
			$this->product_name->EditAttrs["class"] = "form-control";
			$this->product_name->EditCustomAttributes = "";
			if (!$this->product_name->Raw)
				$this->product_name->CurrentValue = HtmlDecode($this->product_name->CurrentValue);
			$this->product_name->EditValue = HtmlEncode($this->product_name->CurrentValue);
			$this->product_name->PlaceHolder = RemoveHtml($this->product_name->caption());

			// product_quantity
			$this->product_quantity->EditAttrs["class"] = "form-control";
			$this->product_quantity->EditCustomAttributes = "";
			$this->product_quantity->EditValue = HtmlEncode($this->product_quantity->CurrentValue);
			$this->product_quantity->PlaceHolder = RemoveHtml($this->product_quantity->caption());

			// product_price
			$this->product_price->EditAttrs["class"] = "form-control";
			$this->product_price->EditCustomAttributes = "";
			$this->product_price->EditValue = HtmlEncode($this->product_price->CurrentValue);
			$this->product_price->PlaceHolder = RemoveHtml($this->product_price->caption());

			// total_price
			$this->total_price->EditAttrs["class"] = "form-control";
			$this->total_price->EditCustomAttributes = "";
			$this->total_price->EditValue = HtmlEncode($this->total_price->CurrentValue);
			$this->total_price->PlaceHolder = RemoveHtml($this->total_price->caption());

			// Add refer script
			// o_id

			$this->o_id->LinkCustomAttributes = "";
			$this->o_id->HrefValue = "";

			// name
			$this->name->LinkCustomAttributes = "";
			$this->name->HrefValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";

			// mobile_no
			$this->mobile_no->LinkCustomAttributes = "";
			$this->mobile_no->HrefValue = "";

			// billing_address
			$this->billing_address->LinkCustomAttributes = "";
			$this->billing_address->HrefValue = "";

			// shipping_address
			$this->shipping_address->LinkCustomAttributes = "";
			$this->shipping_address->HrefValue = "";

			// city
			$this->city->LinkCustomAttributes = "";
			$this->city->HrefValue = "";

			// state
			$this->state->LinkCustomAttributes = "";
			$this->state->HrefValue = "";

			// pincode
			$this->pincode->LinkCustomAttributes = "";
			$this->pincode->HrefValue = "";

			// payment_method
			$this->payment_method->LinkCustomAttributes = "";
			$this->payment_method->HrefValue = "";

			// card_no
			$this->card_no->LinkCustomAttributes = "";
			$this->card_no->HrefValue = "";

			// expiry_date
			$this->expiry_date->LinkCustomAttributes = "";
			$this->expiry_date->HrefValue = "";

			// order_date
			$this->order_date->LinkCustomAttributes = "";
			$this->order_date->HrefValue = "";

			// product_name
			$this->product_name->LinkCustomAttributes = "";
			$this->product_name->HrefValue = "";

			// product_quantity
			$this->product_quantity->LinkCustomAttributes = "";
			$this->product_quantity->HrefValue = "";

			// product_price
			$this->product_price->LinkCustomAttributes = "";
			$this->product_price->HrefValue = "";

			// total_price
			$this->total_price->LinkCustomAttributes = "";
			$this->total_price->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->o_id->Required) {
			if (!$this->o_id->IsDetailKey && $this->o_id->FormValue != NULL && $this->o_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->o_id->caption(), $this->o_id->RequiredErrorMessage));
			}
		}
		if ($this->name->Required) {
			if (!$this->name->IsDetailKey && $this->name->FormValue != NULL && $this->name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->name->caption(), $this->name->RequiredErrorMessage));
			}
		}
		if ($this->_email->Required) {
			if (!$this->_email->IsDetailKey && $this->_email->FormValue != NULL && $this->_email->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_email->caption(), $this->_email->RequiredErrorMessage));
			}
		}
		if ($this->mobile_no->Required) {
			if (!$this->mobile_no->IsDetailKey && $this->mobile_no->FormValue != NULL && $this->mobile_no->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->mobile_no->caption(), $this->mobile_no->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->mobile_no->FormValue)) {
			AddMessage($FormError, $this->mobile_no->errorMessage());
		}
		if ($this->billing_address->Required) {
			if (!$this->billing_address->IsDetailKey && $this->billing_address->FormValue != NULL && $this->billing_address->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->billing_address->caption(), $this->billing_address->RequiredErrorMessage));
			}
		}
		if ($this->shipping_address->Required) {
			if (!$this->shipping_address->IsDetailKey && $this->shipping_address->FormValue != NULL && $this->shipping_address->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->shipping_address->caption(), $this->shipping_address->RequiredErrorMessage));
			}
		}
		if ($this->city->Required) {
			if (!$this->city->IsDetailKey && $this->city->FormValue != NULL && $this->city->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->city->caption(), $this->city->RequiredErrorMessage));
			}
		}
		if ($this->state->Required) {
			if (!$this->state->IsDetailKey && $this->state->FormValue != NULL && $this->state->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->state->caption(), $this->state->RequiredErrorMessage));
			}
		}
		if ($this->pincode->Required) {
			if (!$this->pincode->IsDetailKey && $this->pincode->FormValue != NULL && $this->pincode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pincode->caption(), $this->pincode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->pincode->FormValue)) {
			AddMessage($FormError, $this->pincode->errorMessage());
		}
		if ($this->payment_method->Required) {
			if (!$this->payment_method->IsDetailKey && $this->payment_method->FormValue != NULL && $this->payment_method->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->payment_method->caption(), $this->payment_method->RequiredErrorMessage));
			}
		}
		if ($this->card_no->Required) {
			if (!$this->card_no->IsDetailKey && $this->card_no->FormValue != NULL && $this->card_no->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->card_no->caption(), $this->card_no->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->card_no->FormValue)) {
			AddMessage($FormError, $this->card_no->errorMessage());
		}
		if ($this->expiry_date->Required) {
			if (!$this->expiry_date->IsDetailKey && $this->expiry_date->FormValue != NULL && $this->expiry_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->expiry_date->caption(), $this->expiry_date->RequiredErrorMessage));
			}
		}
		if ($this->order_date->Required) {
			if (!$this->order_date->IsDetailKey && $this->order_date->FormValue != NULL && $this->order_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->order_date->caption(), $this->order_date->RequiredErrorMessage));
			}
		}
		if ($this->product_name->Required) {
			if (!$this->product_name->IsDetailKey && $this->product_name->FormValue != NULL && $this->product_name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->product_name->caption(), $this->product_name->RequiredErrorMessage));
			}
		}
		if ($this->product_quantity->Required) {
			if (!$this->product_quantity->IsDetailKey && $this->product_quantity->FormValue != NULL && $this->product_quantity->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->product_quantity->caption(), $this->product_quantity->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->product_quantity->FormValue)) {
			AddMessage($FormError, $this->product_quantity->errorMessage());
		}
		if ($this->product_price->Required) {
			if (!$this->product_price->IsDetailKey && $this->product_price->FormValue != NULL && $this->product_price->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->product_price->caption(), $this->product_price->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->product_price->FormValue)) {
			AddMessage($FormError, $this->product_price->errorMessage());
		}
		if ($this->total_price->Required) {
			if (!$this->total_price->IsDetailKey && $this->total_price->FormValue != NULL && $this->total_price->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->total_price->caption(), $this->total_price->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->total_price->FormValue)) {
			AddMessage($FormError, $this->total_price->errorMessage());
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// o_id
		$this->o_id->setDbValueDef($rsnew, $this->o_id->CurrentValue, "", FALSE);

		// name
		$this->name->setDbValueDef($rsnew, $this->name->CurrentValue, "", FALSE);

		// email
		$this->_email->setDbValueDef($rsnew, $this->_email->CurrentValue, "", FALSE);

		// mobile_no
		$this->mobile_no->setDbValueDef($rsnew, $this->mobile_no->CurrentValue, 0, FALSE);

		// billing_address
		$this->billing_address->setDbValueDef($rsnew, $this->billing_address->CurrentValue, "", FALSE);

		// shipping_address
		$this->shipping_address->setDbValueDef($rsnew, $this->shipping_address->CurrentValue, "", FALSE);

		// city
		$this->city->setDbValueDef($rsnew, $this->city->CurrentValue, "", FALSE);

		// state
		$this->state->setDbValueDef($rsnew, $this->state->CurrentValue, "", FALSE);

		// pincode
		$this->pincode->setDbValueDef($rsnew, $this->pincode->CurrentValue, 0, FALSE);

		// payment_method
		$this->payment_method->setDbValueDef($rsnew, $this->payment_method->CurrentValue, "", FALSE);

		// card_no
		$this->card_no->setDbValueDef($rsnew, $this->card_no->CurrentValue, 0, FALSE);

		// expiry_date
		$this->expiry_date->setDbValueDef($rsnew, $this->expiry_date->CurrentValue, "", FALSE);

		// order_date
		$this->order_date->setDbValueDef($rsnew, $this->order_date->CurrentValue, "", FALSE);

		// product_name
		$this->product_name->setDbValueDef($rsnew, $this->product_name->CurrentValue, "", FALSE);

		// product_quantity
		$this->product_quantity->setDbValueDef($rsnew, $this->product_quantity->CurrentValue, 0, FALSE);

		// product_price
		$this->product_price->setDbValueDef($rsnew, $this->product_price->CurrentValue, 0, FALSE);

		// total_price
		$this->total_price->setDbValueDef($rsnew, $this->total_price->CurrentValue, 0, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("paymentlist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>