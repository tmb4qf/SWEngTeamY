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
	FOREIGN KEY(addrID) references address ON DELETE CASCADE
);

CREATE TABLE organization(
	orgID serial PRIMARY KEY,
	name varchar (20)
);

CREATE TABLE applicant(
	FOREIGN KEY(id) REFERENCES person ON DELETE CASCADE,
	FOREIGN KEY(organizationID) references organization(orgID) ON DELETE CASCADE,
	isStudentWorker boolean,
	PRIMARY KEY(id)
);

CREATE TABLE accessType(
	accessID serial PRIMARY KEY,
	type varchar(15)
);

CREATE TABLE applicationProcessor(
	FOREIGN KEY(id) REFERENCES person ON DELETE CASCADE,
	jobTitle varchar(15),
	PRIMARY KEY(id)
);

CREATE TABLE ferpaScores(
	FOREIGN KEY(id) REFERENCES person ON DELETE CASCADE,
	score varchar(2),
	PRIMARY KEY(id)
);

CREATE TABLE careerTypes(
	typeID serial PRIMARY KEY, 
	department varchar(7)
);

CREATE TABLE applicationTypes(
	typeID serial PRIMARY KEY,
	type varchar(10)
);

CREATE TABLE application(
	appID serial PRIMARY KEY,
	FOREIGN KEY(id) REFERENCES person ON DELETE CASCADE,
	FOREIGN KEY(access_type) REFERENCES applicationTypes ON DELETE CASCADE
);

CREATE TABLE requestedCareerTypes(
	FOREIGN KEY(appID) REFERENCES application ON DELETE CASCADE,
	FOREIGN KEY(id) REFERENCES person ON DELETE CASCADE,
	FOREIGN KEY(typeID) REFERENCES careerTypes ON DELETE CASCADE,
	PRIMARY KEY(appID, id, typeID)
);

CREATE TABLE admissionsTestTypes(
	testID serial PRIMARY KEY, 
	name varchar(5)
);

CREATE TABLE admissionsTest(
	admTestID serial PRIMARY KEY,
	FOREIGN KEY(applicationID) REFERENCES application(appID) ON DELETE CASCADE,
	FOREIGN KEY(admTypeID) REFERENCES admissionsTestTypes(typeID) ON DELETE CASCADE
);

CREATE TABLE roleType(
	typeID serial PRIMARY KEY, 
	name varchar(20)
);

CREATE TABLE roles(
	roleID serial PRIMARY KEY,
	FOREIGN KEY(roleType) REFERENCES roleType(typeID) ON DELETE CASCADE,
	roleDesc varchar(150),
	isViewable boolean, 
	isUpdateable boolean
);

CREATE TABLE roleAccessRequest(
	roleAccessID serial PRIMARY KEY,
	FOREIGN KEY(appID) REFERENCES application ON DELETE CASCADE,
	FOREIGN KEY(roleID) REFERENCES roles ON DELETE CASCADE,
	isViewRequest
	isUpdateRequest
);