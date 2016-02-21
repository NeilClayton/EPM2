<?php
	
	class Controller{	
	
		function _construct(){
		}
	
		function printPropertyTable ($PropertyInformation){
			
			while($row=$PropertyInformation->fetch(PDO::FETCH_ASSOC)){
				echo "<tr>";
				echo "<td>".$row['propertyref']."</td>";
				echo "<td>".$row['county']."</td>";
				echo "<td>".$row['postcode']."</td>";
				echo "</tr>";
			}
		
		}
		
		function printJobsTable ($JobInformation){
		
			while($row=$JobInformation->fetch(PDO::FETCH_ASSOC)){
				echo "<tr>";
				echo "<td>".$row['propertyref']."</td>";
				echo "<td>".$row['jobID']."</td>";
				echo "<td>".$row['jobdescription']."</td>";
				echo "</tr>";
			}
		
		}

		function printContractorTable ($ContractorInfomration){

			while($row=$ContractorInfomration->fetch(PDO::FETCH_ASSOC)){
				echo "<tr>";
				echo "<td>".$row['companyname']."</td>";
				echo "<td>".$row['contact']."</td>";
				echo "<td>".$row['town']."</td>";
				echo "<td>".$row['tel']."</td>";
				echo "<td>".$row['mobile']."</td>";
				echo "<td>".$row['email']."</td>";
				echo"</tr>";

			}
		}

		function printPropertiesToAddJobs($PropertyInformation){


			while($row=$PropertyInformation->fetch(PDO::FETCH_ASSOC)){
				$value = $row['propertyID'];
				echo "<tr>";
				echo "<td>".$row['propertyref']."</td>";
				echo "<td>".$row['county']."</td>";
				echo "<td>".$row['postcode']."</td>";
				echo "<td>"."<input type='submit' name='".$value."' value='Add Job' class = 'JobFormRedirect'>"."</td>";
				echo "</tr>";


			}
		}
	
	}
	
?>
