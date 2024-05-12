# Project Setup Guide

### Requirements

- XAMPP Server
- Composer

### Steps to Setup the Project

1. Navigate to the xampp/htdocs directory and open the command prompt.
2. Clone the project repository using the following command:
   
   `git clone https://github.com/saritasy/aertrip.git`

Inside the cloned project directory, locate the folder named database.
In the database folder, find the file named database_setup.sql.
Open the XAMPP Control Panel and start the Apache and MySQL servers.
Access phpMyAdmin by visiting the URL 
   
   `http://localhost/phpmyadmin/index.php`.

In phpMyAdmin, locate and click on the "Import" option.
Upload the database_setup.sql file using the import option in phpMyAdmin.
Once the database is imported successfully, navigate to the project's URL:

   `http://localhost/orgconnect/web/index.php?r=employee%2Findex`

### Project Description

This guide provides step-by-step instructions to set up and run the OrgConnect project on your local environment. OrgConnect is a web-based application developed for managing employee information within an organization. Follow the steps below to get the project up and running:

1. Clone the Project: Start by cloning the project repository from the provided GitHub URL. This will download all the necessary files to your local machine.

2. Database Setup: Inside the project directory, locate the database folder. In this folder, you'll find a SQL file named database_setup.sql. This file contains the database structure and initial data required for the project.

3. Start XAMPP Servers: Open the XAMPP Control Panel and start both the Apache and MySQL servers. XAMPP provides a local server environment necessary to run the project.

4. Import Database: Access phpMyAdmin through your web browser by visiting the provided URL. In phpMyAdmin, use the "Import" option to upload the database_setup.sql file. This will create the necessary database tables and populate them with initial data.

5. Access Project URL: Once the database is successfully imported, you can access the OrgConnect project through the provided URL. This will launch the web application, allowing you to manage employee information efficiently.

By following these steps, you'll have the OrgConnect project set up and ready to use on your local machine. Enjoy exploring the features and functionalities of the application for seamless employee management within your organization.


### Screen Shot

![image](https://github.com/saritasy/aertrip/assets/109311562/d76d3725-307b-44ed-9704-644d40f9cc06)

![image](https://github.com/saritasy/aertrip/assets/109311562/1bf7a8f5-76d2-4977-bdb8-aff64e73d367)

![image](https://github.com/saritasy/aertrip/assets/109311562/013a6742-723b-4761-befb-3497ad1fbbae)


