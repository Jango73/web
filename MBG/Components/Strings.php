<?php

class Strings
{
	var $Data;
	var $Lang;

	public function __construct($Lang)
	{
		$this->Lang = $Lang;

		$this->Data = Array(
			"en" => Array(
				"HOME" => "Home",
				"GROUPS" => "Groups",
				"COMPANIES" => "Companies",
				"BANK" => "Bank",
				"MARKET" => "Bank",
				"LAW" => "Law",
				"UNDERGROUND" => "Underground",
				"LOGIN" => "Log in",
				"LOGOUT" => "Log out",
				"CREATEACCOUNT" => "Create account",

				"MYGROUPS" => "My groups",
				"SEARCHGROUPS" => "Search groups",
				"CREATEGROUP" => "Create group",
				"MYCOMPANIES" => "My companies",
				"SEARCHCOMPANIES" => "Search companies",
				"CREATECOMPANY" => "Create company",
				"MYBANKACCOUNTS" => "My accounts",
				"CREATEBANKACCOUNT" => "Sign up account",
				"VIEWMARKET" => "View market",
				"VIEWAFFAIRS" => "View affairs",
				"LAWYERS" => "Lawyers",
				"CONTACTS" => "Contacts",
				"MAIL" => "Mail",

				"CURRENCY_SINGULAR" => "Credit",
				"CURRENCY_PLURAL" => "Credits",
				"NAME" => "Name",
				"PASSWORD" => "Password",
				"TYPE" => "Type",
				"NUMBER" => "Number",
				"BALANCE" => "Balance",
				"OWNER" => "Owner",
				"SUBMITCREATION" => "Submit creation",
				"COMMERCIALID" => "Commercial ID",
				"CEO" => "CEO",
				"COMPANYCASH" => "Cash",
				"MANAGE" => "Manage",
				"LOCATEDIN" => "Located in",
				"MARKETPERCENT" => "Market percent",
				"PERIODICITYMONTHS" => "Periodicity in months",
				"PERIODICITYDAYS" => "Periodicity in days",
				"ACCOUNTNUMBER" => "Account number",
				"CONTRACTNUMBER" => "Contract number",
				"SOMECUBICMETERSOFSOMETHING" => "%d cubic meters of %s",
				"SOMESQUAREMETERSOFSOMETHING" => "%d square meters of %s",
				"RESIDENTIALSURFACE" => "Residential surface",
				"INDUSTRIALSURFACE" => "Industrial surface",
				"COMMERCIALSURFACE" => "Commercial surface",
				"STORAGESURFACE" => "Storage surface",
				"USAGEOFBRAND" => "the right to use the brand %s",

				"GOLD" => "Gold",
				"OIL" => "Oil",
				"IRON" => "Iron",
				"PLASTIC" => "Plastic",
				"RUBBER" => "Rubber",
				"RICE" => "Rice",
				"WHEAT" => "Wheat",

				"PERSONAL" => "Personal",
				"PROFESSIONAL" => "Professional",

				"RENT" => "Rent",
				"BRAND_USAGE" => "Brand usage",
				"RESOURCE_SALE" => "Resource sale",
				"PRODUCT_SALE" => "Product sale",
				"BRAND_SALE" => "Brand sale",
				"ESTATE_SALE" => "Estate sale",
				"COMPANY_PART_SALE" => "Company part sale",
				"COMPANY_SALE" => "Company sale",
				"GROUP_SALE" => "Group sale",
				"RESOURCE_TRANSPORT" => "Resource transport",
				"PRODUCT_TRANSPORT" => "Product transport",

				"CONTRACTLINE1" => "Introduction<br><br>The present document defines a %s contract between %s and %s.<br><br>",
				"CONTRACTLINE2" => "Contract terms<br><br>%s will provide %s to %s.<br>In return, %s will provide %s to %s.<br><br>",
				"CONTRACTLINE3" => "",
				"CONTRACTLINE4" => "Contract termination<br><br>If either of the involved parties wishes to terminate this contract before the original contract end date, they will notify the other party within a minimum of %d days before the desired termination date, and will pay the other party a fee of %s %s.<br>",

				"WELCOMETEXT" => "Welcome to Mass Business Game.<br>This game aims at one single goal : making (virtual) money.<br><br>If you are new to this game, click 'Create account'.<br>If you own an account, click 'Log in'.",
				"PLEASEIDENTIFY" => "Please identify yourself by entering your name and password.",
				"ALREADYLOGGEDIN" => "You are already logged in...<br> Select Log out in the main menu if you want to login as another user.",
				"PLEASEENTERNAME" => "Please enter your name.",
				"PLEASEENTERPASS" => "Please enter your password.",
				"PASSNOMATCH" => "Password does not match. Please check.",
				"USERNOTFOUND" => "User not found. Please check your name.",
				"PROVIDECOMPANYNAME" => "Please provide a company name.",
				"NOACCESSIFNOLOGGED" => "No access to this page if not logged in.",
				"PAGENOTEXIST" => "Oups, this page does not exist...",

				"SUSPECTCHEAT" => "WARNING.<br>We have detected that you are trying to cheat.<br>If your cheat counter goes too high, your account will be deleted.",
			),

			"fr" => Array(
				"HOME" => "Accueil",
				"GROUPS" => "Groupes",
				"COMPANIES" => "Soci�t�s",
				"BANK" => "Banque",
				"MARKET" => "March�",
				"LAW" => "Loi",
				"UNDERGROUND" => "Underground",
				"LOGIN" => "Connexion",
				"LOGOUT" => "D�connexion",
				"CREATEACCOUNT" => "Cr�er compte",

				"MYGROUPS" => "Mes groupes",
				"SEARCHGROUPS" => "Registre des groupes",
				"CREATEGROUP" => "Cr�er groupe",
				"MYCOMPANIES" => "Mes soci�t�s",
				"SEARCHCOMPANIES" => "Registre des soci�t�s",
				"CREATECOMPANY" => "Cr�er soci�t�",
				"MYBANKACCOUNTS" => "Mes comptes",
				"CREATEBANKACCOUNT" => "Cr�er un compte",
				"VIEWMARKET" => "Voir le march�",
				"VIEWAFFAIRS" => "Affaires en cours",
				"LAWYERS" => "Avocats",
				"CONTACTS" => "Contacts",
				"MAIL" => "Courier",

				"CURRENCY_SINGULAR" => "Credit",
				"CURRENCY_PLURAL" => "Credits",
				"NAME" => "Nom",
				"PASSWORD" => "Mot de passe",
				"TYPE" => "Type",
				"NUMBER" => "Num�ro",
				"BALANCE" => "Solde",
				"OWNER" => "Propri�taire",
				"SUBMITCREATION" => "Soumettre creation",
				"COMMERCIALID" => "Num�ro commercial",
				"CEO" => "PDG",
				"COMPANYCASH" => "Capital",
				"MANAGE" => "G�rer",
				"LOCATEDIN" => "Localis� �",
				"MARKETPERCENT" => "Pourcentage du march�",
				"PERIODICITYMONTHS" => "Periodicit� en mois",
				"PERIODICITYDAYS" => "Periodicit� en jours",
				"ACCOUNTNUMBER" => "Compte num�ro",
				"CONTRACTNUMBER" => "Contrat num�ro",
				"SOMECUBICMETERSOFSOMETHING" => "%d m3 de %s",
				"SOMESQUAREMETERSOFSOMETHING" => "%d m2 de %s",
				"RESIDENTIALSURFACE" => "Surface r�sidentielle",
				"INDUSTRIALSURFACE" => "Surface industrielle",
				"COMMERCIALSURFACE" => "Surface commerciale",
				"STORAGESURFACE" => "Surface de stockage",
				"USAGEOFBRAND" => "le droit d'utilisation de la marque %s",

				"GOLD" => "Or",
				"OIL" => "P�trole",
				"IRON" => "Fer",
				"PLASTIC" => "Plastique",
				"RUBBER" => "Caoutchouc",
				"RICE" => "Riz",
				"WHEAT" => "Bl�",

				"PERSONAL" => "Personnel",
				"PROFESSIONAL" => "Professionnel",

				"RENT" => "Location",
				"BRAND_USAGE" => "Franchise",
				"RESOURCE_SALE" => "Vente de ressource",
				"PRODUCT_SALE" => "Vente de produit",
				"BRAND_SALE" => "Vente de marque",
				"ESTATE_SALE" => "Vente d'immobilier",
				"COMPANY_PART_SALE" => "Vente de parts de soci�t�",
				"COMPANY_SALE" => "Vente de soci�t�",
				"GROUP_SALE" => "Vente de groupe",
				"RESOURCE_TRANSPORT" => "Transport de ressource",
				"PRODUCT_TRANSPORT" => "Transport de produit",

				"CONTRACTLINE1" => "Introduction<br><br>Le pr�sent document d�finie un contrat de %s entre %s et %s.<br><br>",
				"CONTRACTLINE2" => "Termes du contrat<br><br>%s devra fournir %s � %s.<br>En retour, %s devra fournir %s � %s.<br><br>",
				"CONTRACTLINE3" => "",
				"CONTRACTLINE4" => "Terminaison du contrat<br><br>Si l'une des deux parties souhaite mettre un terme au contrat avant l'�ch�ance d'origine, celle-ci devra notifier l'autre partie dans un minimum de %d jours avant la date souhait�e de terminaison, et devra payer un forfait de %s %s � l'autre partie.<br>",

				"WELCOMETEXT" => "Bienvenue dans Mass Business Game.<br>Ce jeu comporte un principe simple : faire de l'argent (virtuel).<br><br>If you are new to this game, click 'Create account'.<br>If you own an account, click 'Log in'.",
				"PLEASEIDENTIFY" => "Veuillez vous identifier en saisissant votre nom et mot de passe.",
				"ALREADYLOGGEDIN" => "Vous �tes d�j� connect�...<br> Cliquer sur D�connexion dans le menu principal pour vous connecter sous un autre nom.",
				"PLEASEENTERNAME" => "Veuillez saisir votre nom",
				"PLEASEENTERPASS" => "Veuillez saisir votre mot de passe.",
				"PASSNOMATCH" => "Le mot de passe saisi ne correspond pas.",
				"USERNOTFOUND" => "Utilisateur introuvable. Veuillez v�rifier le nom.",
				"PROVIDECOMPANYNAME" => "Veuillez saisir un nom de soci�t�.",
				"NOACCESSIFNOLOGGED" => "Pas d'acc�s � cette page si vous n'�tes pas connect�.",
				"PAGENOTEXIST" => "Oups, cette page n'existe pas...",

				"SUSPECTCHEAT" => "AVERTISSEMENT.<br>Nous avons d�tect� une tentative de triche.<br>Si votre compteur de triche monte trop haut, votre compte sera effac�.",
			),
		);
	}

	public function GetString($Code)
	{
		if (isset($this->Data[$this->Lang]))
		{
			if (isset($this->Data[$this->Lang][$Code]))
			{
				return $this->Data[$this->Lang][$Code];
			}
		}

		return $Code;
	}
}

?>
