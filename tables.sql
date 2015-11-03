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
	addrID serial,
	fname varchar(20),
	lname varchar(25),
	pawprint varchar(6),
	phone_number varchar(10),
	title varchar(20),
	FOREIGN KEY(addrID) REFERENCES address ON DELETE CASCADE
);

DROP TABLE IF EXISTS authentication;
CREATE TABLE authentication (
	id varchar(9) PRIMARY KEY,
	password_hash CHAR(40) NOT NULL,
	salt CHAR(40) NOT NULL,
	FOREIGN KEY (id) REFERENCES person
);

DROP TABLE IF EXISTS organization;
CREATE TABLE organization(
	orgID serial PRIMARY KEY,
	name varchar (20)
);

DROP TABLE IF EXISTS applicant;
CREATE TABLE applicant(
	id varchar(9) PRIMARY KEY,
	organizationID serial,
	FOREIGN KEY(id) REFERENCES person ON DELETE CASCADE,
	FOREIGN KEY(organizationID) references organization(orgID) ON DELETE CASCADE,
	isStudentWorker boolean
);

DROP TABLE IF EXISTS accessType;
CREATE TABLE accessType(
	accessID serial PRIMARY KEY,
	type varchar(15)
);

DROP TABLE IF EXISTS applicationProcessor;
CREATE TABLE applicationProcessor(
	id varchar(9) PRIMARY KEY,
	FOREIGN KEY(id) REFERENCES person ON DELETE CASCADE,
	jobTitle varchar(15)
);

DROP TABLE IF EXISTS ferpaScores;
CREATE TABLE ferpaScores(
	id varchar(9) PRIMARY KEY,
	FOREIGN KEY(id) REFERENCES person ON DELETE CASCADE,
	score varchar(2)
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
	id varchar(9), 
	access_type serial,
	FOREIGN KEY(id) REFERENCES person ON DELETE CASCADE,
	FOREIGN KEY(access_type) REFERENCES applicationTypes(typeID) ON DELETE CASCADE
);

DROP TABLE IF EXISTS requestedCareerTypes;
CREATE TABLE requestedCareerTypes(
	appID serial, 
	id varchar(9),
	typeID serial,
	FOREIGN KEY(appID) REFERENCES application ON DELETE CASCADE,
	FOREIGN KEY(id) REFERENCES person ON DELETE CASCADE,
	FOREIGN KEY(typeID) REFERENCES careerTypes ON DELETE CASCADE,
	PRIMARY KEY(appID, id, typeID)
);

DROP TABLE IF EXISTS admissionsTestTypes;
CREATE TABLE admissionsTestTypes(
	typeID serial PRIMARY KEY, 
	name varchar(5)
);

DROP TABLE IF EXISTS admissionsTest;
CREATE TABLE admissionsTest(
	admTestID serial PRIMARY KEY,
	applicationID serial,
	admTypeID serial,
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
	roleType serial,
	FOREIGN KEY(roleType) REFERENCES roleType(typeID) ON DELETE CASCADE,
	roleDesc varchar(150),
	isViewable boolean, 
	isUpdateable boolean
);

DROP TABLE IF EXISTS roleAccessRequest;
CREATE TABLE roleAccessRequest(
	roleAccessID serial PRIMARY KEY,
	appID serial,
	roleID serial,
	FOREIGN KEY(appID) REFERENCES application ON DELETE CASCADE,
	FOREIGN KEY(roleID) REFERENCES roles ON DELETE CASCADE,
	isViewRequest boolean, 
	isUpdateRequest boolean
);