
<div class="loadArea whiteOpacity col-md-8 col-md-offset-2 col-sm-12">


	<div id = "propertyTable">
		<div class="centre"><h1>Your Properties</h1></div>
		<table class="center striped">
			<th>Property Ref</th>
			<th>County</th>
			<th>Postcode</th>

			<?php
			session_start();
			include "../actions/main_action.php";
			$action2 = new action();
			$action2->grabPropertyData();

			?>
		</table>

	</div> <!-- Closes propertyTable-->
</div>