<?php
namespace PHPMaker2020\project1;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
	$MenuRelativePath = "";
	$MenuLanguage = &$Language;
} else { // Compat reports
	$LANGUAGE_FOLDER = "../lang/";
	$MenuRelativePath = "../";
	$MenuLanguage = new Language();
}

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(1, "mi_admin", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "adminlist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(2, "mi_area", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "arealist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(3, "mi_cart", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "cartlist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(4, "mi_category", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "categorylist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(5, "mi_city", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "citylist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(6, "mi_mail", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "maillist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(7, "mi_otp_expiry", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "otp_expirylist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(8, "mi_payment", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "paymentlist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(9, "mi_product", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "productlist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(10, "mi_rating", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "ratinglist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(11, "mi_registration", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "registrationlist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(12, "mi_sub_category", $MenuLanguage->MenuPhrase("12", "MenuText"), $MenuRelativePath . "sub_categorylist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(13, "mi_view1", $MenuLanguage->MenuPhrase("13", "MenuText"), $MenuRelativePath . "view1list.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>