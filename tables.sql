CREATE TABLE person(
	id varchar(8) PRIMARY KEY,
	username varchar(45),
	pawprint varchar(6),
	phone_number varchar(10),
	FOREIGN KEY(addressID) references address,
	title varchar(20),
	isStaff boolean
);

CREATE TABLE address(
	addressID serial PRIMARY KEY,
	street varchar(50), 
	city varchar(25),
	state varchar(2),
	country varchar(3), 
	zipcode varchar(5)
);

CREATE TABLE applicant(
	id varchar(8) PRIMARY KEY,
	FOREIGN KEY(organizationID) references organization(id),
	FOREIGN KEY(application_type) references applicationType(id),
	career_type
	isStudentWorker boolean
);

CREATE TABLE application_processor(

);

CREATE TABLE ferpa_scores(

);

CREATE TABLE organization(

);

CREATE TABLE (

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