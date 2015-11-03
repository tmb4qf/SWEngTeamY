DROP TABLE IF EXISTS address;
CREATE TABLE address(
	addrID serial PRIMARY KEY,
	street varchar(50), 
	city varchar(25),
	state varchar(2),
	country varchar(3), 
	zipcode varchar(5)
);

DROP TABLE IF EXISTS person;
CREATE TABLE person(
	id varchar(8) PRIMARY KEY,
	fname varchar(20),
	lname varchar(25)
	pawprint varchar(6),
	phone_number varchar(10),
	title varchar(20),
	FOREIGN KEY(addrID) references address ON DELETE CASCADE
);

DROP TABLE IF EXISTS organization;
CREATE TABLE organization(
	orgID serial PRIMARY KEY,
	name varchar (20)
);

DROP TABLE IF EXISTS applicant;
CREATE TABLE applicant(
	FOREIGN KEY(id) REFERENCES person ON DELETE CASCADE,
	FOREIGN KEY(organizationID) references organization(orgID) ON DELETE CASCADE,
	isStudentWorker boolean,
	PRIMARY KEY(id)
);

DROP TABLE IF EXISTS accessType;
CREATE TABLE accessType(
	accessID serial PRIMARY KEY,
	type varchar(15)
);

DROP TABLE IF EXISTS applicationProcessor;
CREATE TABLE applicationProcessor(
	FOREIGN KEY(id) REFERENCES person ON DELETE CASCADE,
	jobTitle varchar(15),
	PRIMARY KEY(id)
);

DROP TABLE IF EXISTS ferpaScores;
CREATE TABLE ferpaScores(
	FOREIGN KEY(id) REFERENCES person ON DELETE CASCADE,
	score varchar(2),
	PRIMARY KEY(id)
);

DROP TABLE IF EXISTS careerTypes;
CREATE TABLE careerTypes(
	typeID serial PRIMARY KEY, 
	department varchar(7)
);

DROP TABLE IF EXISTS applicationTypes;
CREATE TABLE applicationTypes(
	typeID serial PRIMARY KEY,
	type varchar(10)
);

DROP TABLE IF EXISTS application;
CREATE TABLE application(
	appID serial PRIMARY KEY,
	FOREIGN KEY(id) REFERENCES person ON DELETE CASCADE,
	FOREIGN KEY(access_type) REFERENCES applicationTypes ON DELETE CASCADE
);

DROP TABLE IF EXISTS requestedCareerTypes;
CREATE TABLE requestedCareerTypes(
	FOREIGN KEY(appID) REFERENCES application ON DELETE CASCADE,
	FOREIGN KEY(id) REFERENCES person ON DELETE CASCADE,
	FOREIGN KEY(typeID) REFERENCES careerTypes ON DELETE CASCADE,
	PRIMARY KEY(appID, id, typeID)
);

DROP TABLE IF EXISTS admissionsTestTypes;
CREATE TABLE admissionsTestTypes(
	testID serial PRIMARY KEY, 
	name varchar(5)
);

DROP TABLE IF EXISTS admissionsTest;
CREATE TABLE admissionsTest(
	admTestID serial PRIMARY KEY,
	FOREIGN KEY(applicationID) REFERENCES application(appID) ON DELETE CASCADE,
	FOREIGN KEY(admTypeID) REFERENCES admissionsTestTypes(typeID) ON DELETE CASCADE
);

DROP TABLE IF EXISTS roleType;
CREATE TABLE roleType(
	typeID serial PRIMARY KEY, 
	name varchar(20)
);

DROP TABLE IF EXISTS roles;
CREATE TABLE roles(
	roleID serial PRIMARY KEY,
	FOREIGN KEY(roleType) REFERENCES roleType(typeID) ON DELETE CASCADE,
	roleDesc varchar(150),
	isViewable boolean, 
	isUpdateable boolean
);

DROP TABLE IF EXISTS roleAccessRequest;
CREATE TABLE roleAccessRequest(
	roleAccessID serial PRIMARY KEY,
	FOREIGN KEY(appID) REFERENCES application ON DELETE CASCADE,
	FOREIGN KEY(roleID) REFERENCES roles ON DELETE CASCADE,
	isViewRequest
	isUpdateRequest
);