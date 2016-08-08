<?php



/*

* Bluethrust Clan Scripts v4

* Copyright 2014

*

* Author: Bluethrust Web Development

* E-mail: support@bluethrust.com

* Website: http://www.bluethrust.com

*

* License: http://www.bluethrust.com/license.php

*

*/



if(!isset($member) || substr($_SERVER['PHP_SELF'], - 11) != "console.php"){

	exit();

}

else

{

	$memberInfo = $member->get_info_filtered();

	$consoleObj->select($_GET['cID']);

	if(!$member->hasAccess($consoleObj)){

		exit();

	}

}








$rID = $_GET['rID'];



include('../../../../_setup.php');
include ('../../../../classes/faq.php');
$faqs = new faq($mysqli);


$faqs->edit_cat($rID);
?>





<div id='postResponse' style='display: none'>

</div>





<script type='text/javascript'>



	var blnSkip = false;





	$('#btnSaveSettings').click(function()

		{



			saveSettings();







		});













	function saveSettings()

	{







		$(document).ready(function()

			{

				var title = $("#ruletitle").val();
var id = $("#ruleid").val();
				$('#loadingspiral').show();





				$.post("<?php echo $MAIN_ROOT; ?>members/include/admin/faq/editcat.php",

					{

						ruletitle:title, ruleid:id

					}, function(data)

					{



						$('#postResponse').html(data);

						$('#loadingspiral').hide();

					});



			});



	}



</script>

