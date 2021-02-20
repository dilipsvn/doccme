CREATE TABLE `Doctor` (
  `DoctorId` bigint NOT NULL auto_increment,
  `RegDate` DateTime NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `MiddleName` varchar(100) default NULL,
  `LastName` varchar(100) NOT NULL,
  `Sex` varchar(10) ,
  `Address1` varchar(255) NOT NULL,
  `Address2` varchar(255) default NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `WorkPhone` varchar(50) default NULL,
  `HomePhone` varchar(50) default NULL,
  `Fax` varchar(50) default NULL,
  `MobilePhone` varchar(50) default NULL,
  `Speciality` varchar(250) default NULL,
  `ContactTime` varchar(50) default NULL,	
  `EmailId` varchar(200) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `Remarks` varchar(250) default NULL,
  PRIMARY KEY  (`DoctorId`),
  UNIQUE (`UserName`),
  UNIQUE (`EmailId`)	
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


INSERT INTO `Doctor`(`RegDate`, `FirstName`,`MiddleName`,`LastName`,`Address1`,`Address2`,
  `City`,`State`,`Zip`,`Country`,`WorkPhone`,`HomePhone`,`Fax`,`MobilePhone`,
  `Speciality`,`ContactTime`,`EmailId`,`UserName`,`Password`,`Status`,`Remarks`) 
  VALUES(NOW(), .....)

UPDATE TABLE `Doctor` 
SET `FirstName` = "", `MiddleName` = "", `LastName` = "",
	`Address1` = "", `Address2` = "", `City` = "",
	`State` = "", `Zip` = "", `Country` = "",
	`WorkPhone` = "", `HomePhone` = "", `Fax` = "",
	`MobilePhone` = "", `Speciality` = "", `ContactTime` = "",
	`EmailId` = "", `UserName` = "", `Password` = "",
	`Status` = "", `Remarks` = ""
WHERE `DoctorId` = ""
-------------------------------------------------------------------------------------
CREATE TABLE `DoctorContacts` (
  `DocContactId` bigint NOT NULL auto_increment,
  `ContactedDate` DateTime NOT NULL,
  `Name` varchar(100) NOT NULL,
  `ContactPhone` varchar(50) default NULL,
  `ContactTime` varchar(50) default NULL,	
  `EmailId` varchar(200) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `Remarks` varchar(250) default NULL,
  PRIMARY KEY  (`DoctorContactId`),
   UNIQUE (`EmailId`)	
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


INSERT INTO `DoctorContacts`(`ContactedDate`, `Name`, `ContactPhone`,
  `ContactTime`,`EmailId`,`Status`,`Remarks`) 
  VALUES(NOW(), .....)

UPDATE TABLE `DoctorContacts` 
SET `Name` = "", `ContactPhone` = "", `ContactTime` = "",
	`EmailId` = "", `Status` = "", `Remarks` = ""
WHERE `DocContactId` = ""
-------------------------------------------------------------------------------------
CREATE TABLE `Referrals` (
  `ReferralId` bigint NOT NULL auto_increment,
  `ReferredDate` DateTime NOT NULL,
  `DocUserName` varchar(100) NOT NULL,
  `FriendName` varchar(100) NOT NULL,
  `FriendEmailId` varchar(200) NOT NULL,
  `ContactPhone` varchar(50) default NULL,
  `Status` varchar(50) NOT NULL,
  `Remarks` varchar(250) default NULL,
  PRIMARY KEY  (`ReferralId`),
   UNIQUE (`FriendEmailId`)	
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


INSERT INTO `Referrals`(`ReferredDate`, `DocUserName`, `FriendName`,
						`FriendEmailId`, `ContactPhone`,
  						`Status`,`Remarks`) 
  VALUES(NOW(), .....)

UPDATE TABLE `Referrals` 
SET `FriendName` = "", `ContactPhone` = "", 
	`FriendEmailId` = "", `Status` = "", `Remarks` = ""
WHERE `ReferralId` = ""
----------------------------------------------------------------------------------------------
CREATE TABLE `CMEProvider` (
  `CMEId` bigint NOT NULL auto_increment,
  `RegDate` DateTime NOT NULL,
  `InstituteName` varchar(100) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `MiddleName` varchar(100) default NULL,
  `LastName` varchar(100) NOT NULL,
  `Address1` varchar(100) NOT NULL,
  `Address2` varchar(100) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `WorkPhone` varchar(50) default NULL,
  `HomePhone` varchar(50) default NULL,
  `Fax` varchar(50) default NULL,
  `MobilePhone` varchar(50) default NULL,
  `EmailId` varchar(100) NOT NULL,
  `WebSiteUrl` varchar(100) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
   `Status` varchar(50) NOT NULL,
  `Remarks` varchar(250) default NULL,
  PRIMARY KEY  (`CMEId`),
  UNIQUE (`UserName`),
  UNIQUE (`EmailId`)	
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `CMEProvider`(`RegDate`,`InstituteName`, `FirstName`,`MiddleName`,`LastName`,
  `Address1`, `Address2`,`City`,`State`,`Zip`,`Country`,`WorkPhone`,`HomePhone`,
  `Fax`, `MobilePhone`,`EmailId`, `WebSiteUrl`, `UserName`,`Password`,`Status`,
  `Remarks`) VALUES(NOW(), ..........)
  
UPDATE TABLE `CMEProvider`
SET `InstituteName` = "",`FirstName` = "", `MiddleName` = "", `LastName` = "",
	`Address1` = "", `Address2` = "", `City` = "",`State` = "", `Zip` = "",
	`Country` = "", `WorkPhone` = "", `HomePhone` = "", `Fax` = "",
	`MobilePhone` = "", `EmailId` = "", `WebSiteUrl` = "", `UserName` = "",
	`Password` = "",`Status` = "", `Remarks` = ""
WHERE `CMEId` = ""
-------------------------------------------------------------------------------------
CREATE TABLE `CMECourses`(	
	`CourseId`  bigint NOT NULL auto_increment,
	`CMEId`  bigint NOT NULL,
	`CourseAddDate` DateTime NOT NULL,
	`CourseTitle` varchar(100) NOT NULL,
	`CourseDesc` varchar(200) NOT NULL,
	`Speciality` varchar(100) NOT NULL,
	`Venue_Address1` varchar(100) NOT NULL,
	`Venue_Address2` varchar(100) NOT NULL,
	`Venue_City` varchar(100) default NULL,
	`Venue_State` varchar(100) NOT NULL,
	`Venue_Zip` varchar(100) NOT NULL,
	`Venue_Country` varchar(100) NOT NULL,
	`ContactPerson` varchar(200) NOT NULL,
	`ContactPhone` varchar(100) NOT NULL,
	`ContactFax` varchar(100) NOT NULL,
	`ContactEmail` varchar(100) NOT NULL,
	`CourseStartDate` DATE NOT NULL,
	`CourseEndDate` DATE NOT NULL,
	`LastDate_App` DATE NOT NULL,
	`NearestHotel` varchar(100) DEFAULT NULL,
	`NearestAirport` varchar(100) DEFAULT NULL,
	`CourseFee` varchar(30) NOT NULL,
	`Status` varchar(30) NOT NULL,
	`Remarks` varchar(250) default NULL,
	 PRIMARY KEY  (`CourseId`)
  	 ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `CMECourses`(`CMEId`, `CourseAddDate`, `CourseTitle`,`CourseDesc`,
  `Speciality`, `Venue_Address1`, `Venue_Address2`,`Venue_City`,`Venue_State`,
  `Venue_Zip`,`Venue_Country`,`ContactPerson`,`ContactPhone`,`ContactFax`, 
  `ContactEmail`, `CourseStartDate`, `CourseEndDate`,`LastDate_App`, `NearestHotel`,
  `NearestAirport`, `CourseFee`, `Status`,`Remarks`) VALUES(Session value, NOW(), ..)
  
UPDATE TABLE `CMECourses`
SET `CourseTitle` = "",`CourseDesc` = "", `Speciality` = "", `Venue_Address1` = "", 
	`Venue_Address2` = "", `Venue_City` = "",`Venue_State` = "", `Venue_Zip` = "",
	`Venue_Country` = "", `ContactPerson` = "", `ContactPhone` = "", 
	`ContactFax` = "",`ContactEmail` = "", `CourseStartDate`= "", 
	`CourseEndDate` = "",`LastDate_App` = "", `NearestHotel` = "",
	`NearestAirport` = "", `CourseFee` = "", `Status` = "", `Remarks` = ""
WHERE `CourseId` = ""

-------------------------------------------------------------------------------------

CREATE TABLE `States`(
	`State_Code` varchar(10) NOT NULL ,
	`State_Name` varchar(50) NOT NULL,
	PRIMARY KEY  (`State_Code`)
	) ENGINE=MyISAM DEFAULT CHARSET=latin1;
	
INSERT INTO 'States` VALUES();

UPDATE TABLE `States` SET
	`State_Code` = "", `State_Name` = ""
	WHERE `State_Code` = ""
-------------------------------------------------------------------------------------

CREATE TABLE `Speciality`(
	`Speciality_Code` varchar(50) NOT NULL ,
	`Speciality_Name` varchar(50) NOT NULL,
	PRIMARY KEY  (`Speciality_Code`)
	) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO 'Speciality` VALUES();

UPDATE TABLE `Speciality` SET
	`Speciality_Code` = "", `Speciality_Name` = ""
	WHERE `Speciality_Code` = ""
-------------------------------------------------------------------------------------
	
CREATE TABLE `PaymentModes`(
	`PaymentMode_Code` varchar(3)NOT NULL,
	`PaymentMode _Name` varchar(10) NOT NULL,
	PRIMARY KEY  (`PaymentModeId`)
	) ENGINE=MyISAM DEFAULT CHARSET=latin1;	

INSERT INTO `PaymentModes` VALUES();

UPDATE TABLE `PaymentModes` SET
	`PaymentMode_Code` = "", `Paymentmode_Name` = ""
	WHERE `PaymentMode_Code` = ""
		
-------------------------------------------------------------------------------------
	
CREATE TABLE `AppliedCourses`(
	`BookingId` bigint NOT NULL auto_increment,
	`DoctorId` bigint NOT NULL,
	`CourseId` bigint NOT NULL,
	`BookingDate` DateTime NOT NULL,
	`BookingType` varchar(50) NOT NULL,
	`PaymentMode` varchar(20) NOT NULL,
	`Amount` int NOT NULL,
	`AgentId` varchar(50) default NULL,
	`BookStatus` varchar(50) NOT NULL,
	PRIMARY KEY  (`BookingId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;	

INSERT INTO `AppliedCourses`(`DoctorId`, `CourseId`, `BookingDate`, `BookingType`,
	`PaymentMode`, `Amount`, `AgentId`, `BookStatus`)
	 VALUES(.., .., NOW(),....);

UPDATE TABLE `AppliedCourses` SET
	`BookStatus` = "" WHERE BookingId = ""
-------------------------------------------------------------------------------------
	

CREATE TABLE `TransactionTable`(
	`TransactionId` bigint NOT NULL,
	`BookingId` bigint NOT NULL,
	`DoctorId` bigint NOT NULL,
	`CourseId` bigint NOT NULL,
	`TransactionDate` DateTime NOT NULL,
	`PaymentMode` varchar(20) NOT NULL,
	`KeyLinkDesc` varchar(50) NOT NULL,
	`TransactionStatus` varchar(50) NOT NULL,
	PRIMARY KEY  (`TransactionId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;	

INSERT INTO `TransactionTable`(`TransactionId`, `DoctorId`, `CourseId`,
	 `TransactionDate`, `TransactionType`, `PaymentMode`, 
	 `KeyLinkDesc`, `TransactionStatus`)
	  VALUES(.., .., ...,  NOW(),....);

-------------------------------------------------------------------------------------

CREATE TABLE `Users`(
	`UserId` bigint NOT NULL auto_increment,
	`RegDate` DateTime NOT NULL,
	`FirstName` varchar(100) NOT NULL,
	`MiddleName` varchar(100) default NULL,
 	`LastName` varchar(100) NOT NULL,
	`ContactPhone` varchar(50) NOT NULL,
    `EmailId` varchar(200) NOT NULL,
  	`UserName` varchar(50) NOT NULL,
  	`Password` varchar(50) NOT NULL,
  	`Status` varchar(50) NOT NULL,
  	`Remarks` varchar(250) default NULL,
  	PRIMARY KEY  (`UserId`),
  	UNIQUE (`UserName`),
  	UNIQUE (`EmailId`)	
 	) ENGINE=MyISAM DEFAULT CHARSET=latin1;
 	
INSERT INTO  `Users`(`RegDate`, `FirstName`, `MiddleName`, `LastName`,
	`ContactPhone`,`EmailId`,`UserName`,
	`Password`,`Status`,`Remarks`)
	VALUES(NOW(), "Rwoof", "", "Reshi", "89679867",
  	"reshi@yahoo.com", "admin", "admin123",
  	"admin", "admin");
  	
UPDATE TABLE `Users` SET
	`FirstName` = "", `MiddleName` = "",`LastName` = "", `ContactPhone` =  "",
	`EmailId` = "", `UserName` = "", `Password` = "", `Status` = "", `Remarks` = ""
	WHERE `UserId` = ""

-------------------------------------------------------------------------------------

CREATE TABLE `Status`(
	`Status_Code` varchar(30) NOT NULL,
	`Status_Name` varchar(30) NOT NULL,
	) ENGINE=MyISAM DEFAULT CHARSET=latin1;	

INSERT INTO `Status` VALUES();

UPDATE TABLE `Status` SET
	`Status_Code` = "", `Status_Name` = ""
	WHERE `Status_Code` = ""

-------------------------------------------------------------------------------------
	
CREATE TABLE `AccessList`(
	`UserId` bigint NOT NULL,
	`ModuleId` int NOT NULL,
	`ModuleName` varchar(150) NOT NULL,
	`AccessType` varchar(10) NOT NULL,
	) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `AccessList` SELECT `UserId`(from session), 
`ModuleId` , `ModuleName`, "AccessType(GRANTED/DENIED)" FROM ModuleList";

UPDATE `AccessList` SET 
	`AccessType` = ""  
 	 WHERE UserId = "" AND ModuleId = ""

DELETE FROM AccessList WHERE UserId = ""

--------------------------------------------------------------------------------------
CREATE TABLE `ModuleList`(
	`ModuleId` int NOT NULL auto_increment,
	`ModuleName` varchar(150) NOT NULL,
	`ModulePath` varchar(100) NOT NULL,
	UNIQUE(`ModuleId`),
	PRIMARY KEY(`ModuleId`)
	) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT 	INTO `ModuleList`(
	`ModuleName`, `ModulePath`)
	VALUES()
