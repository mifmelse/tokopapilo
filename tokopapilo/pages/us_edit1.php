<?php
include('../includes/connection.php');

			$zz = $_POST['id'];
			$a = $_POST['firstname'];
            $b = $_POST['lastname'];
            // $c = $_POST['gender'];
            $d = $_POST['username'];
            $e = $_POST['password'];
            // $f = $_POST['email'];
            // $g = $_POST['phone'];
		
	 			$query = 'UPDATE users u 
	 						join employee e on e.EMPLOYEE_ID=u.EMPLOYEE_ID
	 						join location l on l.LOCATION_ID=e.LOCATION_ID
	 						set e.FIRST_NAME="'.$a.'", e.LAST_NAME="'.$b.'", USERNAME="'.$d.'", PASSWORD = sha1("'.$e.'")
							  WHERE
					ID ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));							
?>
				<script type="text/javascript">
	                alert("Anda telah berhasil memperbarui akun Anda.");
	                window.location = "user.php";
            	</script>