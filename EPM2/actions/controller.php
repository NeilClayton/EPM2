<?php
	
	class Controller
	{

		//default constructor
		function _construct()
		{
		}

		//iteration used to populate property table
		function printPropertyTable($PropertyInformation)
		{

			while ($row = $PropertyInformation->fetch(PDO::FETCH_ASSOC)) {
				echo "<tr>";
				echo "<td>" . $row['propertyref'] . "</td>";
				echo "<td>" . $row['county'] . "</td>";
				echo "<td>" . $row['postcode'] . "</td>";
				echo "</tr>";
			}

		}

		//iteration used to populate jobs table
		function printJobsTable($JobInformation)
		{

			while ($row = $JobInformation->fetch(PDO::FETCH_ASSOC)) {
				echo "<tr>";
				echo "<td>" . $row['propertyref'] . "</td>";
				echo "<td>" . $row['jobdescription'] . "</td>";
				echo "<td>" . $row['description'] . "</td>";
				echo "</tr>";
			}

		}

		//iteration used to print contractor table
		function printContractorTable($ContractorInfomration)
		{

			while ($row = $ContractorInfomration->fetch(PDO::FETCH_ASSOC)) {
				echo "<tr>";
				echo "<td>" . $row['companyname'] . "</td>";
				echo "<td>" . $row['contact'] . "</td>";
				echo "<td>" . $row['town'] . "</td>";
				echo "<td>" . $row['tel'] . "</td>";
				echo "<td>" . $row['mobile'] . "</td>";
				echo "<td>" . $row['email'] . "</td>";
				echo "</tr>";

			}
		}


		//iteration populates properties in a table for user to select the one relevant to the job to be added
		function printPropertiesToAddJobs($PropertyInformation)
		{
			while ($row = $PropertyInformation->fetch(PDO::FETCH_ASSOC)) {
				$value = $row['propertyID'];
				echo "<tr>";
				echo "<td>" . $row['propertyref'] . "</td>";
				echo "<td>" . $row['county'] . "</td>";
				echo "<td>" . $row['postcode'] . "</td>";
				echo "<td>" . "<input type='submit' name=" . $value . " value='Add Job' class = 'JobFormRedirect'>" . "</td>";
				echo "</tr>";


			}
		}

		function printUpdateableJobs($jobsInformation)
		{
			while ($row = $jobsInformation->fetch(PDO::FETCH_ASSOC)){
				$value = $row['jobID'];
				echo "<tr>";
				echo "<td>" . $row['propertyref'] . "</td>";
				echo "<td>" . $row['jobdescription'] . "</td>";
				echo "<td>" . $row['description'] . "</td>";
				echo "<td>" . "<input type='submit' name=" . $value . " value='Update' class = 'updateThisJob'>" . "</td>";
				echo "</tr>";
			}
		}
		function printPropertiesToUpdate($PropertyInformation)
		{
			while ($row = $PropertyInformation->fetch(PDO::FETCH_ASSOC)) {
				$value = $row['propertyID'];
				echo "<tr>";
				echo "<td>" . $row['propertyref'] . "</td>";
				echo "<td>" . $row['county'] . "</td>";
				echo "<td>" . $row['postcode'] . "</td>";
				echo "<td>" . "<input type='submit' name=" . $value . " value='Update' class = 'updateThisProperty'>" . "</td>";
				echo "</tr>";

			}
		}

		function printDeletableProperties($PropertyInformation)
		{
			while ($row = $PropertyInformation->fetch(PDO::FETCH_ASSOC)) {
				$value = $row['propertyID'];
				echo "<tr>";
				echo "<td>" . $row['propertyref'] . "</td>";
				echo "<td>" . $row['county'] . "</td>";
				echo "<td>" . $row['postcode'] . "</td>";
				echo "<td>" . "<input type='submit' name=" . $value . " value='Delete' class = 'deleteThisProperty'>" . "</td>";
				echo "</tr>";
			}

		}

		function printDeletableContractors($contractorInformation)
		{
			while ($row = $contractorInformation->fetch(PDO::FETCH_ASSOC)) {
				$value = $row['contractorID'];
				echo "<tr>";
				echo "<td>" . $row['companyname'] . "</td>";
				echo "<td>" . $row['contact'] . "</td>";
				echo "<td>" . $row['town'] . "</td>";
				echo "<td>" . $row['tel'] . "</td>";
				echo "<td>" . $row['mobile'] . "</td>";
				echo "<td>" . $row['email'] . "</td>";
				echo "<td>" . "<input type='submit' name=" . $value . " value='Delete' class = 'deleteThisContractor'>" . "</td>";
				echo "</tr>";
			}
		}

		function printDeletableJobs($jobInformation)
		{
			while ($row = $jobInformation->fetch(PDO::FETCH_ASSOC)) {
				$value = $row['jobID'];
				echo "<tr>";
				echo "<td>" . $row['propertyref'] . "</td>";
				echo "<td>" . $row['jobdescription'] . "</td>";
				echo "<td>" . $row['description'] . "</td>";
				echo "<td>" . "<input type='submit' name=" . $value . " value='Delete' class = 'deleteThisJob'>" . "</td>";
				echo "</tr>";
			}

		}
		function printContractorToUpdate($contractorInformation)
		{
			while ($row = $contractorInformation->fetch(PDO::FETCH_ASSOC)) {
				$value = $row['contractorID'];
				echo "<tr>";
				echo "<td>" . $row['companyname'] . "</td>";
				echo "<td>" . $row['contact'] . "</td>";
				echo "<td>" . $row['town'] . "</td>";
				echo "<td>" . $row['tel'] . "</td>";
				echo "<td>" . $row['mobile'] . "</td>";
				echo "<td>" . $row['email'] . "</td>";
				echo "<td>" . "<input type='submit' name=" . $value . " value='Update' class = 'updateThisContractor'>" . "</td>";
				echo "</tr>";
			}
		}


	}

?>
