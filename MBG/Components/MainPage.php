<?php

	require_once "php-entities/Components/RenderContext.php";
	require_once "MainMenu.php";
	require_once "MBGStrings.php";

	require_once "HomePage.php";
	require_once "LogInPage.php";
	require_once "CompaniesPage.php";
	require_once "CompanyPage.php";
	require_once "CompanyCreatePage.php";
	require_once "ContractPage.php";
	require_once "AgencyPage.php";
	require_once "GroupsPage.php";
	require_once "BankAccountsPage.php";
	require_once "BankAccountPage.php";
	require_once "MarketPage.php";
	require_once "ContactsPage.php";
	require_once "WrongPage.php";

	$Context = new RenderContext();
	$MBGStrings = new MBGStrings();

	$Context->GetStrings()->SetData($MBGStrings->GetData());

	$Context->RegisterPage("WrongPage", "WrongPage");
	$Context->RegisterPage("Home", "HomePage");
	$Context->RegisterPage("LogIn", "LogInPage");
	$Context->RegisterPage("Groups", "GroupsPage");
	$Context->RegisterPage("Companies", "CompaniesPage");
	$Context->RegisterPage("Company", "CompanyPage");
	$Context->RegisterPage("CompanyCreate", "CompanyCreatePage");
	$Context->RegisterPage("Contract", "ContractPage");
	$Context->RegisterPage("Agency", "AgencyPage");
	$Context->RegisterPage("BankAccounts", "BankAccountsPage");
	$Context->RegisterPage("BankAccount", "BankAccountPage");
	$Context->RegisterPage("Market", "MarketPage");
	$Context->RegisterPage("Contacts", "ContactsPage");

	// Create main menu

	$Menu = new MainMenu($Context);
	$MessageArea = new Label("MessageArea", "-", 100, 30);

	if ($Context->GetVars()->Event != "")
	{
		$MenuEcho =  $Menu->ProcessEvents($Context);
		$ContextEcho = $Context->ProcessEvents();

		if ($Context->GetVars()->SuspectCheat)
		{
			// echo "<p><b>";
			// echo $Context->GetString("SUSPECTCHEAT");
			// echo "<br><br><a href='?page=Home'>Continue</a>";
			// echo "</b></p>";

			die();
		}

		echo $MenuEcho;
		echo $ContextEcho;

		$Context->GetVars()->Persist();

		die();
	}
	else
	{
		$Context->Clear();
		$Menu->Render($Context);
		$MessageArea->Render($Context);

		$Context->Render();

		if ($Context->GetVars()->SuspectCheat)
		{
			echo "<p><b>";
			echo $Context->GetString("SUSPECTCHEAT");
			echo "<br><br><a href='?page=Home'>Continue</a>";
			echo "</b></p>";

			die();
		}

		$Context->GetVars()->Persist();
	}
?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<title>
	Mass business game
	</title>

	<link rel="stylesheet" href="./jQWidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
	<link rel="stylesheet" href="./jQWidgets/jqwidgets/styles/jqx.classic.css" type="text/css" />
	<script type="text/javascript" src="./jQWidgets/scripts/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="./jQWidgets/jqwidgets/jqxcore.js"></script>
	<script type="text/javascript" src="./jQWidgets/jqwidgets/jqxmenu.js"></script>
	<script type="text/javascript" src="./jQWidgets/jqwidgets/jqxtabs.js"></script>
	<script type="text/javascript" src="./jQWidgets/jqwidgets/jqxpanel.js"></script>
	<script type="text/javascript" src="./jQWidgets/jqwidgets/jqxbuttons.js"></script>

</head>

<body>

<div id='content'>
	<div id='EchoText'></div>

	<script type="text/javascript">
		$(document).ready
		(
			function ()
			{
				jQuery.ajaxSetup({
					async : false
					// url: "/xmlhttp/",
					// global: false,
					// type: "POST"
				});

				<?php echo $Context->GetControlText(); ?>
			}
		);

		function DebugOut(text)
		{
			$("#EchoText").html(text);
		}

		function MessageOut(text)
		{
			$("#MessageArea").html('<p>' + text + '</p>');
		}

		function WarningOut(text)
		{
			$("#MessageArea").html('<p style=\'color:#FF8000;\'><i>' + text + '</i></p>');
		}

		function ErrorOut(text)
		{
			$("#MessageArea").html('<p style=\'color:#FF0000;\'><b><i>' + text + '</i></b></p>');
		}
	</script>

	<div style='width: 100%; display: -webkit-flex; display: flex; -webkit-justify-content: center; justify-content: center;'>
		<div style='width: <?php echo $Context->GetVars()->PageWidth; ?>px; font-size: 13px; font-family: Verdana;' id='jqxWidget'>
			<?php echo $Context->GetText(); ?>
		</div>
	</div>

</div>

<?php

	// include 'Test.php'

?>

</body>

</html>
