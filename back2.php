
<?php
//Prepared Statements

	session_start();

	$_SESSION["EMPLOYEENO"] = $objResult["EMPLOYEENO"]; 
	echo $_SESSION["EMPLOYEENO"];

	include 'connect.php';
	
	$strSQL = "SELECT employeeno,email,idcard FROM employee_new inner join employee on employee_new.employeeno = employee.EMPLOYEENO
	WHERE employee.EMAIL = '".($_POST['email'])."' and employee.IDCARD = '".($_POST['idcard'])."'";


	$objQuery = sqlsrv_query($conn, $strSQL);
	$objResult = sqlsrv_fetch_array($objQuery);

	
	if(!$objResult)
	{
			echo "email and password Incorrect!";
	}
	else
	{

		if($objResult["login_Status"] == "1")
		{
			echo "'".($_POST['email'])."' Exists login!";
			exit();
		}
		else
		{
			//*** Update Status Login
			$sql = "UPDATE employee_new SET login_Status = '1' , last_update = GETDATE() WHERE employee_new.employeeno = '".$objResult["employeeno"]."' ";
			$query = sqlsrv_query($conn,$sql);
		
		
			$_SESSION["EMPLOYEENO"] = $objResult["EMPLOYEENO"];
			$_SESSION["role"] = ($objResult["role"]);
			$_SESSION["digital"] = ($objResult["digital"]);
			


			//digital department
			$_SESSION["DEPARTMENT"] = $objResult["DEPARTMENT"];
			$_SESSION["DIVISION"] = $objResult["DIVISION"];

			$_SESSION["last_login"] = time();
			session_write_close();
			
			if($objResult["digital"] == 'Digital')
			{
                
				header("location:list_digital.php");
			}
			elseif($objResult["role"] == 'Officer')
			{
				header("location:form_list.php");
			}
			elseif($objResult["role"] == 'Manager')
			{	
				//echo $_SESSION["POSITIONEN1"];
				echo "ผู้จัดการ";
				header("location:form_list.php");
			}
            elseif($objResult["role"] == 'Engineer')
            {
                //echo substr($objResult["POSITION"],0,18);
				header("location:form_list.php");
            }
            else
            {
                header("location:form_list.php");
            }
		}
	}
	sqlsrv_close($conn);
    
?>