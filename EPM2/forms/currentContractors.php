<div class="loadArea whiteOpacity col-md-8 col-md-offset-2 col-sm-12">


	<div id = "ContractorTable">
		<div class="centre"><h1>Your Contractor</h1></div>
			<table class="center striped">
				<th>Company</th>
				<th>Contact</th>
				<th>Town</th>
                <th>Tel</th>
                <th>Mobile</th>
                <th>Email</th>

	<?php
		session_start();
		include "../actions/main_action.php";
		$action2 = new action();
		$action2->getCurrentContractors();

	?>
</table>

</div> <!-- Closes propertyTable-->
</div>

