		CREATE TABLE address(
			addrID serial PRIMARY KEY,
			street varchar(50), 
			city varchar(25),
			state varchar(2),
			country varchar(3), 
			zipcode varchar(5)
		);

		CREATE TABLE person(
			id varchar(8) PRIMARY KEY,
			fname varchar(20),
			lname varchar(25)
			pawprint varchar(6),
			phone_number varchar(10),
			title varchar(20),
			FOREIGN KEY(addrID) references address
		);

		CREATE TABLE organization(
			orgID serial PRIMARY KEY,
			name varchar (20)
		);

		CREATE TABLE applicant(
			FOREIGN KEY(id) REFERENCES person,
			FOREIGN KEY(organizationID) references organization(orgID),
			isStudentWorker boolean,
			PRIMARY KEY(id)
		);

		CREATE TABLE accessType(
			accessID serial PRIMARY KEY,
			type varchar(15)
		);
		
		CREATE TABLE applicationProcessor(
			FOREIGN KEY(id) REFERENCES person,
			jobTitle varchar(15),
			FOREIGN KEY(access_type_ID) REFERENCES accessType(id),
			PRIMARY KEY(id)
		);

		CREATE TABLE ferpaScores(
			score varchar(3),
			FOREIGN KEY(id) REFERENCES person,
			PRIMARY KEY(id)
		);



CREATE TABLE application_types(
	
);

CREATE TABLE (

);

CREATE TABLE 

);

CREATE TABLE (

);

CREATE TABLE (

);

CREATE TABLE 

);