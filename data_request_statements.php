//$conn is return variable from using pg_connect()
//$result is the array of data returned from database query
//in each query, change the text "database" to the the actual name of our database once it is determined
//		eg: SWENGTeamY.authentication instead of database.authentication


//gets user password hash, salt value from database using id
		$result = pg_prepare($conn, "salt_pass", "SELECT password_hash, salt FROM database.authentication WHERE id = $1");
		$result = pg_execute($conn, "salt_pass", array($id));
		
//gets bio info from database for the auto populate on the form
		$result = pg_prepare($conn, "user_bio", "SELECT * FROM database.person WHERE id = $1;");
		$result = pg_execute($conn, "user_bio", array($id));
		
//gets demo info from database for auto populate
//must use last value in the result array from bio info request, addrID, to access info in request
		$result = pg_prepare($conn, "user_demo", "SELECT * FROM database.address WHERE addrID = $1;");
		$result = pg_execute($conn, "user_demo", array($addrID));

//insert ferpa score to database
		$result = pg_prepare($conn, "ferpa", "INSERT INTO database.ferpaScores VALUES($1, $2);");
		$result = pg_execute($conn, "ferpa", array($id, $ferpaScore));		
		
//create applicant record
		$result = pg_prepare($conn, "applicant", "INSERT INTO database.applicant VALUES($1, $2, $3);");
		$result = pg_execute($conn, "applicant", array($id, $$orgID, $isStudentWorker));
		
//create application
		$result = pg_prepare($conn, "application", "INSERT INTO database.application VALUES($1, $2, $3);");
		$result = pg_execute($conn, "application", array($appID, $userID, $accessType));
		
//insert users requested career type
		$result = pg_prepare($conn, "career_type", "INSERT INTO database.requestedCareerTypes VALUES($1, $2, $3);");
		$result = pg_execute($conn, "career_type", array($appID, $userID, $typeID));
		
//insert user admissions test request
		$result = pg_prepare($conn, "admissions", "INSERT INTO database.admissionsTestRequest VALUES($1, $2, $3);");
		$result = pg_execute($conn, "admissions", array($admTestID, $appID, $admTypeID));

//insert users role access request
		$result = pg_prepare($conn, "role_access, "INSERT INTO database.roleAccessRequest VALUES($1, $2, $3, $4, $5);");
		$result = pg_execute($conn, "role_access", array($roleAccessID, $appID, $roleID, $isViewRequest, $isUpdateRequest));

		

		
	