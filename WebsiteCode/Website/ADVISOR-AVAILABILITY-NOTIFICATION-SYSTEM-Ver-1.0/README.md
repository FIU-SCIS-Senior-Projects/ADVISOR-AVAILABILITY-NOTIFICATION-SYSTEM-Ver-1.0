# ADVISOR-AVAILABILITY-NOTIFICATION-SYSTEM-Ver-1.0
ADVISOR AVAILABILITY NOTIFICATION SYSTEM Ver 1.0
Installation:


Note: The advisor page is only correctly working on Chrome Browsers


A person with IT knowledge is required to setup this program, a person with knowledge of Databases and web server setups.


I will provide two options for setting up the website:


Option 1:
Install XAMPP v3.2.2 ( look into how to install XAMPP). 
Start the apache and the SQL Server that comes with XAMPP.
In the XAMPP installation directory insert the file provided from github(https://github.com/FIU-SCIS-Senior-Projects/ADVISOR-AVAILABILITY-NOTIFICATION-SYSTEM-Ver-1.0) in the directory WebsiteCode/website named ADVISOR-AVAILABILITY-NOTIFICATION-SYSTEM-Ver-1.0 ( this folder is inside the ADVISOR-AVAILABILITY-NOTIFICATION-SYSTEM-Ver-1.0-master folder)  into htdocs.
In the MySQL row in XAMPP click admin and phpMyAdmin should come up in a browser. This is to set up the Database.
On the top right side there should be an import button, click it and import the .sql script that is provided in the file named databaseSCRIPT
Now find a file named sqliConnect.php in ADVISOR-AVAILABILITY-NOTIFICATION-SYSTEM-Ver-1.0 and edit it to add the required database information.  Originally the XAMPP database comes without a password, if you want your database to be secure you should add a password to it.


After importing the database, since the passwords were encrypted in a different machine they need to be re encrypted for the machine you wish to install it on. You can do this by running a small piece of code that re encrypts all passwords in the database, after running it every user and admin will have the password 1234.  ( this can later be changed by admin or users themselves. 


Now you should visit http://localhost/ADVISOR-AVAILABILITY-NOTIFICATION-SYSTEM-Ver-1.0/ on your browser and a login page should appear, enter fd1 as username and 1234 as password and you should  be logged in to the front desk.  
To make the website live, configure the XAMPP server for internet access, you can also configure it for Local Network Access only. 
Option 2:
Take the source code provided  and configure it into a php server ( such as apache). The code was created using  php 5.6.24 but it should work in php 5.3.7 and up ( but it has not been tested on php 5.3.7) 
Create a MySQL  database and import the SQL script provided.
Enter the database credentials into the sqliConnect.php file.
Do step 7 from above.
The website should run.


