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

include('../../../../_setup.php');
include ('../../../../classes/faq.php');
$faqs = new faq($mysqli);



$rID  = $_GET['rID'];




if(empty($rID))
{


	$faqs->create_faq();

	?>










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

					var message = $("#rulemessage").val();

					var answer = $("#ruleanswer").val();

					var cat = $("#rulecat").val();

					$('#loadingspiral').show();





					$.post("<?php echo $MAIN_ROOT; ?>members/include/admin/faq/savefaq.php",

						{

							ruletitle:title, rulemessage:message, rulecat: cat,ruleanswer:answer

						}, function(data)

						{



							$('#postResponse').html(data);

							$('#loadingspiral').hide();

						});



				});



		}



	</script>
	<?php
}
else
{
	
	?>
	<div class='formDiv'>





		Use the form below to modify your website's Rules.<br><br>



		<div class='errorDiv' id='errorDiv' style='display: none'>

			<strong>

				Unable to save website settings because the following errors occurred:

			</strong><br><br>

			<span id='errorMessage'>

			</span>

		</div>



	<?php $faqs->edit_faq($rID); ?>





			<tr>

				<td colspan='2' align='center'>

					<p align='center' class='main'>

						<span id='loadingspiral' style='display: none'>

							<br><img src='<?php echo $MAIN_ROOT; ?>themes/<?php echo $THEME; ?>/images/loading-spiral2.gif' style='margin-bottom: 5px'><br>

							<i>

								Saving...

							</i>

						</span>

						<span id='saveMessage'>

						</span>

					</p>

				</td>

			</tr>

		</table>
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

					var message = $("#rulemessage").val();

					var answer = $("#ruleanswer").val();

					var cat = $("#rulecat").val();
					var id = $("#ruleid").val();

					$('#loadingspiral').show();





					$.post("<?php echo $MAIN_ROOT; ?>members/include/admin/faq/savefaq1.php",

						{

							ruletitle:title, rulemessage:message, rulecat: cat,ruleanswer:answer,ruleid:id

						}, function(data)

						{

							$('#postResponse').html(data);

							$('#loadingspiral').hide();

						});



				});



		}



	</script>
	<?php
}
?>
<div id='postResponse' style='display: none'>

</div>







