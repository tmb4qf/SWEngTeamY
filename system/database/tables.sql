/*
	Create table statement with corresponding drop table statements
*/
DROP TABLE IF EXISTS address CASCADE;
CREATE TABLE address(
	addrID serial PRIMARY KEY,
	street varchar(50), 
	city varchar(25),
	state varchar(2),
	country varchar(3), 
	zipcode varchar(5)
);

DROP TABLE IF EXISTS person CASCADE;
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

DROP TABLE IF EXISTS authentication CASCADE;
CREATE TABLE authentication (
	id varchar(9) PRIMARY KEY,
	password_hash CHAR(40) NOT NULL,
	salt CHAR(40) NOT NULL,
	FOREIGN KEY (id) REFERENCES person
);

DROP TABLE IF EXISTS organization CASCADE;
CREATE TABLE organization(
	orgID serial PRIMARY KEY,
	name varchar (20)
);

DROP TABLE IF EXISTS applicant CASCADE;
CREATE TABLE applicant(
	id varchar(9) PRIMARY KEY,
	organizationID serial,
	FOREIGN KEY(id) REFERENCES person ON DELETE CASCADE,
	FOREIGN KEY(organizationID) references organization(orgID) ON DELETE CASCADE,
	isStudentWorker boolean
);

DROP TABLE IF EXISTS accessType CASCADE;
CREATE TABLE accessType(
	accessID serial PRIMARY KEY,
	type varchar(15)
);

DROP TABLE IF EXISTS applicationProcessor CASCADE;
CREATE TABLE applicationProcessor(
	id varchar(9) PRIMARY KEY,
	FOREIGN KEY(id) REFERENCES person ON DELETE CASCADE,
	jobTitle varchar(15)
);

DROP TABLE IF EXISTS ferpaScores CASCADE;
CREATE TABLE ferpaScores(
	id varchar(9) PRIMARY KEY,
	FOREIGN KEY(id) REFERENCES person ON DELETE CASCADE,
	score varchar(2)
);

DROP TABLE IF EXISTS careerTypes CASCADE;
CREATE TABLE careerTypes(
	typeID serial PRIMARY KEY, 
	department varchar(7)
);

DROP TABLE IF EXISTS applicationTypes CASCADE;
CREATE TABLE applicationTypes(
	typeID serial PRIMARY KEY,
	type varchar(10)
);

DROP TABLE IF EXISTS application CASCADE;
CREATE TABLE application(
	appID serial PRIMARY KEY,
	id varchar(9), 
	access_type serial,
	FOREIGN KEY(id) REFERENCES person ON DELETE CASCADE,
	FOREIGN KEY(access_type) REFERENCES applicationTypes(typeID) ON DELETE CASCADE
);

DROP TABLE IF EXISTS requestedCareerTypes CASCADE;
CREATE TABLE requestedCareerTypes(
	appID serial, 
	id varchar(9),
	typeID serial,
	FOREIGN KEY(appID) REFERENCES application ON DELETE CASCADE,
	FOREIGN KEY(id) REFERENCES person ON DELETE CASCADE,
	FOREIGN KEY(typeID) REFERENCES careerTypes ON DELETE CASCADE,
	PRIMARY KEY(appID, id, typeID)
);

DROP TABLE IF EXISTS admissionsTestTypes CASCADE;
CREATE TABLE admissionsTestTypes(
	typeID serial PRIMARY KEY, 
	name varchar(7)
);

DROP TABLE IF EXISTS admissionsTest CASCADE;
CREATE TABLE admissionsTest(
	admTestID serial PRIMARY KEY,
	applicationID serial,
	admTypeID serial,
	FOREIGN KEY(applicationID) REFERENCES application(appID) ON DELETE CASCADE,
	FOREIGN KEY(admTypeID) REFERENCES admissionsTestTypes(typeID) ON DELETE CASCADE
);

DROP TABLE IF EXISTS roleType CASCADE;
CREATE TABLE roleType(
	typeID serial PRIMARY KEY, 
	name varchar(30)
);

DROP TABLE IF EXISTS roles CASCADE;
CREATE TABLE roles(
	roleID serial PRIMARY KEY,
	roleType serial,
	roleName varchar(45),
	FOREIGN KEY(roleType) REFERENCES roleType(typeID) ON DELETE CASCADE,
	roleDesc varchar(300),
	isViewable boolean, 
	isUpdateable boolean
);

DROP TABLE IF EXISTS roleAccessRequest CASCADE;
CREATE TABLE roleAccessRequest(
	roleAccessID serial PRIMARY KEY,
	appID serial,
	roleID serial,
	FOREIGN KEY(appID) REFERENCES application ON DELETE CASCADE,
	FOREIGN KEY(roleID) REFERENCES roles ON DELETE CASCADE,
	isViewRequest boolean, 
	isUpdateRequest boolean
);


/*
	Insert statements for seed data for the following tables
*/
INSERT INTO careerTypes(department) VALUES('UGRD');
INSERT INTO careerTypes(department) VALUES('GRAD');
INSERT INTO careerTypes(department) VALUES('MED');
INSERT INTO careerTypes(department) VALUES('VET MED');
INSERT INTO careerTypes(department) VALUES('LAW');

INSERT INTO roleType(name) VALUES('Student Records Access');
INSERT INTO roleType(name) VALUES('Student Financials Access');
INSERT INTO roleType(name) VALUES('Student Financial Aid Access');
INSERT INTO roleType(name) VALUES('Reserved Access');

INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Basic Inquiry','Access to basic bio demo and 
	student data: names, address, FERPA directory data, 
	photos, term info, degree information, programs, honors 
	and awards, service indicators (holds) and previous schools.',true, false);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Advanced Inquiry',
	'Includes Basic Inquiry access. Additionally includes relations with institution, 
	citizenship, visa, decedant data, student enrollment, gpa, term history, 3Cs,
	advisors, student groups', true, true);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, '3Cs', 'Checklists, Comments, Communications', true, true);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Advisor Update', 'Adding an advisor to a students record', false, true);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Department SOC Update', 'Scheduling courses, assigning faculty 
	to course, generating permission numbers', false, true);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Service Indicators (Holds)', 'Administrative users with proper 
	security can assign or remove service indicators from a students record',true, true);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Student Group View', 'View groups a student is associated with',true, false);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'View Study List', 'View a students class schedule', true, false);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Registrar Enrollment', 'Adding and dropping a course utilizing 
	Enrollment Request Advisor Student', true, true);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Advisor Student Center', 'Access to students study list, advisor, 
	program/plan, demographic data, e-mail address', true, false);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Class Permission', 'Creating general or student specific class permission numbers', false, true);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Class Permission View', 'View class permission numbers which have been created for a course', true, false);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Class Roster', 'View students enrolled, dropped or withdrawn in a course', true, false);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Block Enrollments', 'Adding and dropping a course utilizing Enrollment Request', true, true);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Report Manager', 'Assists in running various reports', true, false);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Self Service Advisor', 'View Advisee photo, addresses, service indicators, 
	emergency contacts, telephone numbers, grades, class schedule, enrollment appointment, print academic advising profile', false, true);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Fiscal Officer', 'View enrollment summary, term statistics, and UM term statistics', true, false);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Academic Advising Profile', 'Allows printing of the Academic Advising Profile', false, true);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES (2, 'SF General Inquiry', 'For staff outside of the Cashiers Office', true, false);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES (2, 'SF Cash Group Post', 'Also known as "Cost Centers" (for areas that want to apply charges)', true, true);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES (3, 'FA Cash', 'View a students financial aid awards and budget', true, false);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES (3, 'FA Non Financial Aid Staff', 'Also known as "Cost Centers" (for areas that want to apply charges)', true, false);
INSERT INTO roles(roleType, roleName, isViewable, isUpdateable) VALUES(4, 'Immunization view', true, true);
INSERT INTO roles(roleType, roleName, isViewable, isUpdateable) VALUES(4, 'Transfer Credit Admission', true, true);
INSERT INTO roles(roleType, roleName, isViewable, isUpdateable) VALUES(4, 'Relationships', true, true);
INSERT INTO roles(roleType, roleName, isViewable, isUpdateable) VALUES(4, 'Student Groups', false, true);
INSERT INTO roles(roleType, roleName, isViewable, isUpdateable) VALUES(4, 'Accommodate (Student Health)', false, true);
INSERT INTO roles(roleType, roleName, isViewable, isUpdateable) VALUES(4, 'Support Staff (Registrars Office)', true, true);
INSERT INTO roles(roleType, roleName, isViewable, isUpdateable) VALUES(4, 'Advance Standing Report', true, true);	

INSERT INTO admissionsTestTypes(name) VALUES('ACT'),('SAT'),('GRE'),('GMAT'),('TOFEL'),('IELTS'),('LSAT'),('MCAT'),('AP'),('CLEP'),('GED'),('MILLERS'),('PRAX'),('PLA_MU'),('BASE');

INSERT INTO applicationTypes(type) VALUES('new'),('additional');