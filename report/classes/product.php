<?php namespace PHPMaker2020\project1; ?>
<?php

/**
 * Table class for product
 */
class product extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $product_id;
	public $product_code;
	public $product_name;
	public $product_price;
	public $product_img;
	public $product_desc;
	public $subcategory_name;
	public $category_name;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'product';
		$this->TableName = 'product';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`product`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// product_id
		$this->product_id = new DbField('product', 'product', 'x_product_id', 'product_id', '`product_id`', '`product_id`', 3, 11, -1, FALSE, '`product_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->product_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->product_id->IsPrimaryKey = TRUE; // Primary key field
		$this->product_id->Sortable = TRUE; // Allow sort
		$this->product_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['product_id'] = &$this->product_id;

		// product_code
		$this->product_code = new DbField('product', 'product', 'x_product_code', 'product_code', '`product_code`', '`product_code`', 200, 10, -1, FALSE, '`product_code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->product_code->Nullable = FALSE; // NOT NULL field
		$this->product_code->Required = TRUE; // Required field
		$this->product_code->Sortable = TRUE; // Allow sort
		$this->fields['product_code'] = &$this->product_code;

		// product_name
		$this->product_name = new DbField('product', 'product', 'x_product_name', 'product_name', '`product_name`', '`product_name`', 200, 50, -1, FALSE, '`product_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->product_name->Nullable = FALSE; // NOT NULL field
		$this->product_name->Required = TRUE; // Required field
		$this->product_name->Sortable = TRUE; // Allow sort
		$this->fields['product_name'] = &$this->product_name;

		// product_price
		$this->product_price = new DbField('product', 'product', 'x_product_price', 'product_price', '`product_price`', '`product_price`', 131, 11, -1, FALSE, '`product_price`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->product_price->Nullable = FALSE; // NOT NULL field
		$this->product_price->Required = TRUE; // Required field
		$this->product_price->Sortable = TRUE; // Allow sort
		$this->product_price->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['product_price'] = &$this->product_price;

		// product_img
		$this->product_img = new DbField('product', 'product', 'x_product_img', 'product_img', '`product_img`', '`product_img`', 200, 255, -1, FALSE, '`product_img`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->product_img->Nullable = FALSE; // NOT NULL field
		$this->product_img->Required = TRUE; // Required field
		$this->product_img->Sortable = TRUE; // Allow sort
		$this->fields['product_img'] = &$this->product_img;

		// product_desc
		$this->product_desc = new DbField('product', 'product', 'x_product_desc', 'product_desc', '`product_desc`', '`product_desc`', 200, 255, -1, FALSE, '`product_desc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->product_desc->Nullable = FALSE; // NOT NULL field
		$this->product_desc->Required = TRUE; // Required field
		$this->product_desc->Sortable = TRUE; // Allow sort
		$this->fields['product_desc'] = &$this->product_desc;

		// subcategory_name
		$this->subcategory_name = new DbField('product', 'product', 'x_subcategory_name', 'subcategory_name', '`subcategory_name`', '`subcategory_name`', 200, 20, -1, FALSE, '`subcategory_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->subcategory_name->Nullable = FALSE; // NOT NULL field
		$this->subcategory_name->Required = TRUE; // Required field
		$this->subcategory_name->Sortable = TRUE; // Allow sort
		$this->fields['subcategory_name'] = &$this->subcategory_name;

		// category_name
		$this->category_name = new DbField('product', 'product', 'x_category_name', 'category_name', '`category_name`', '`category_name`', 200, 20, -1, FALSE, '`category_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->category_name->Nullable = FALSE; // NOT NULL field
		$this->category_name->Required = TRUE; // Required field
		$this->category_name->Sortable = TRUE; // Allow sort
		$this->fields['category_name'] = &$this->category_name;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`product`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = Config("USER_ID_ALLOW");
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->product_id->setDbValue($conn->insert_ID());
			$rs['product_id'] = $this->product_id->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('product_id', $rs))
				AddFilter($where, QuotedName('product_id', $this->Dbid) . '=' . QuotedValue($rs['product_id'], $this->product_id->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->product_id->DbValue = $row['product_id'];
		$this->product_code->DbValue = $row['product_code'];
		$this->product_name->DbValue = $row['product_name'];
		$this->product_price->DbValue = $row['product_price'];
		$this->product_img->DbValue = $row['product_img'];
		$this->product_desc->DbValue = $row['product_desc'];
		$this->subcategory_name->DbValue = $row['subcategory_name'];
		$this->category_name->DbValue = $row['category_name'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`product_id` = @product_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('product_id', $row) ? $row['product_id'] : NULL;
		else
			$val = $this->product_id->OldValue !== NULL ? $this->product_id->OldValue : $this->product_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@product_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "productlist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "productview.php")
			return $Language->phrase("View");
		elseif ($pageName == "productedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "productadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "productlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("productview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("productview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "productadd.php?" . $this->getUrlParm($parm);
		else
			$url = "productadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("productedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("productadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("productdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "product_id:" . JsonEncode($this->product_id->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->product_id->CurrentValue != NULL) {
			$url .= "product_id=" . urlencode($this->product_id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("product_id") !== NULL)
				$arKeys[] = Param("product_id");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->product_id->CurrentValue = $key;
			else
				$this->product_id->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->product_id->setDbValue($rs->fields('product_id'));
		$this->product_code->setDbValue($rs->fields('product_code'));
		$this->product_name->setDbValue($rs->fields('product_name'));
		$this->product_price->setDbValue($rs->fields('product_price'));
		$this->product_img->setDbValue($rs->fields('product_img'));
		$this->product_desc->setDbValue($rs->fields('product_desc'));
		$this->subcategory_name->setDbValue($rs->fields('subcategory_name'));
		$this->category_name->setDbValue($rs->fields('category_name'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// product_id
		// product_code
		// product_name
		// product_price
		// product_img
		// product_desc
		// subcategory_name
		// category_name
		// product_id

		$this->product_id->ViewValue = $this->product_id->CurrentValue;
		$this->product_id->ViewCustomAttributes = "";

		// product_code
		$this->product_code->ViewValue = $this->product_code->CurrentValue;
		$this->product_code->ViewCustomAttributes = "";

		// product_name
		$this->product_name->ViewValue = $this->product_name->CurrentValue;
		$this->product_name->ViewCustomAttributes = "";

		// product_price
		$this->product_price->ViewValue = $this->product_price->CurrentValue;
		$this->product_price->ViewValue = FormatNumber($this->product_price->ViewValue, 2, -2, -2, -2);
		$this->product_price->ViewCustomAttributes = "";

		// product_img
		$this->product_img->ViewValue = $this->product_img->CurrentValue;
		$this->product_img->ViewCustomAttributes = "";

		// product_desc
		$this->product_desc->ViewValue = $this->product_desc->CurrentValue;
		$this->product_desc->ViewCustomAttributes = "";

		// subcategory_name
		$this->subcategory_name->ViewValue = $this->subcategory_name->CurrentValue;
		$this->subcategory_name->ViewCustomAttributes = "";

		// category_name
		$this->category_name->ViewValue = $this->category_name->CurrentValue;
		$this->category_name->ViewCustomAttributes = "";

		// product_id
		$this->product_id->LinkCustomAttributes = "";
		$this->product_id->HrefValue = "";
		$this->product_id->TooltipValue = "";

		// product_code
		$this->product_code->LinkCustomAttributes = "";
		$this->product_code->HrefValue = "";
		$this->product_code->TooltipValue = "";

		// product_name
		$this->product_name->LinkCustomAttributes = "";
		$this->product_name->HrefValue = "";
		$this->product_name->TooltipValue = "";

		// product_price
		$this->product_price->LinkCustomAttributes = "";
		$this->product_price->HrefValue = "";
		$this->product_price->TooltipValue = "";

		// product_img
		$this->product_img->LinkCustomAttributes = "";
		$this->product_img->HrefValue = "";
		$this->product_img->TooltipValue = "";

		// product_desc
		$this->product_desc->LinkCustomAttributes = "";
		$this->product_desc->HrefValue = "";
		$this->product_desc->TooltipValue = "";

		// subcategory_name
		$this->subcategory_name->LinkCustomAttributes = "";
		$this->subcategory_name->HrefValue = "";
		$this->subcategory_name->TooltipValue = "";

		// category_name
		$this->category_name->LinkCustomAttributes = "";
		$this->category_name->HrefValue = "";
		$this->category_name->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// product_id
		$this->product_id->EditAttrs["class"] = "form-control";
		$this->product_id->EditCustomAttributes = "";
		$this->product_id->EditValue = $this->product_id->CurrentValue;
		$this->product_id->ViewCustomAttributes = "";

		// product_code
		$this->product_code->EditAttrs["class"] = "form-control";
		$this->product_code->EditCustomAttributes = "";
		if (!$this->product_code->Raw)
			$this->product_code->CurrentValue = HtmlDecode($this->product_code->CurrentValue);
		$this->product_code->EditValue = $this->product_code->CurrentValue;
		$this->product_code->PlaceHolder = RemoveHtml($this->product_code->caption());

		// product_name
		$this->product_name->EditAttrs["class"] = "form-control";
		$this->product_name->EditCustomAttributes = "";
		if (!$this->product_name->Raw)
			$this->product_name->CurrentValue = HtmlDecode($this->product_name->CurrentValue);
		$this->product_name->EditValue = $this->product_name->CurrentValue;
		$this->product_name->PlaceHolder = RemoveHtml($this->product_name->caption());

		// product_price
		$this->product_price->EditAttrs["class"] = "form-control";
		$this->product_price->EditCustomAttributes = "";
		$this->product_price->EditValue = $this->product_price->CurrentValue;
		$this->product_price->PlaceHolder = RemoveHtml($this->product_price->caption());
		if (strval($this->product_price->EditValue) != "" && is_numeric($this->product_price->EditValue))
			$this->product_price->EditValue = FormatNumber($this->product_price->EditValue, -2, -2, -2, -2);
		

		// product_img
		$this->product_img->EditAttrs["class"] = "form-control";
		$this->product_img->EditCustomAttributes = "";
		if (!$this->product_img->Raw)
			$this->product_img->CurrentValue = HtmlDecode($this->product_img->CurrentValue);
		$this->product_img->EditValue = $this->product_img->CurrentValue;
		$this->product_img->PlaceHolder = RemoveHtml($this->product_img->caption());

		// product_desc
		$this->product_desc->EditAttrs["class"] = "form-control";
		$this->product_desc->EditCustomAttributes = "";
		if (!$this->product_desc->Raw)
			$this->product_desc->CurrentValue = HtmlDecode($this->product_desc->CurrentValue);
		$this->product_desc->EditValue = $this->product_desc->CurrentValue;
		$this->product_desc->PlaceHolder = RemoveHtml($this->product_desc->caption());

		// subcategory_name
		$this->subcategory_name->EditAttrs["class"] = "form-control";
		$this->subcategory_name->EditCustomAttributes = "";
		if (!$this->subcategory_name->Raw)
			$this->subcategory_name->CurrentValue = HtmlDecode($this->subcategory_name->CurrentValue);
		$this->subcategory_name->EditValue = $this->subcategory_name->CurrentValue;
		$this->subcategory_name->PlaceHolder = RemoveHtml($this->subcategory_name->caption());

		// category_name
		$this->category_name->EditAttrs["class"] = "form-control";
		$this->category_name->EditCustomAttributes = "";
		if (!$this->category_name->Raw)
			$this->category_name->CurrentValue = HtmlDecode($this->category_name->CurrentValue);
		$this->category_name->EditValue = $this->category_name->CurrentValue;
		$this->category_name->PlaceHolder = RemoveHtml($this->category_name->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->product_id);
					$doc->exportCaption($this->product_code);
					$doc->exportCaption($this->product_name);
					$doc->exportCaption($this->product_price);
					$doc->exportCaption($this->product_img);
					$doc->exportCaption($this->product_desc);
					$doc->exportCaption($this->subcategory_name);
					$doc->exportCaption($this->category_name);
				} else {
					$doc->exportCaption($this->product_id);
					$doc->exportCaption($this->product_code);
					$doc->exportCaption($this->product_name);
					$doc->exportCaption($this->product_price);
					$doc->exportCaption($this->product_img);
					$doc->exportCaption($this->product_desc);
					$doc->exportCaption($this->subcategory_name);
					$doc->exportCaption($this->category_name);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->product_id);
						$doc->exportField($this->product_code);
						$doc->exportField($this->product_name);
						$doc->exportField($this->product_price);
						$doc->exportField($this->product_img);
						$doc->exportField($this->product_desc);
						$doc->exportField($this->subcategory_name);
						$doc->exportField($this->category_name);
					} else {
						$doc->exportField($this->product_id);
						$doc->exportField($this->product_code);
						$doc->exportField($this->product_name);
						$doc->exportField($this->product_price);
						$doc->exportField($this->product_img);
						$doc->exportField($this->product_desc);
						$doc->exportField($this->subcategory_name);
						$doc->exportField($this->category_name);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>