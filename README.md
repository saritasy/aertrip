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


# API

1. To set up the API service, navigate to the 'api' folder of the project and copy it into the 'htdocs' folder of your XAMPP server.
2. Inside the 'api' folder, you'll find a Postman API collection. Please import this collection into Postman for testing the API.

http://localhost/aertrip/web/admin/employee/list

# Response

```json
[
    {
        "employee_id": 1,
        "department_id": 1,
        "employee_name": "sita ram",
        "employee_email": "sita.ram@orgconnect.com",
        "department": {
            "department_id": 1,
            "department_name": "Marketing"
        },
        "address": [
            {
                "address_id": 1,
                "employee_id": 1,
                "address_line_1": "123 Main Rd",
                "address_line_2": null,
                "city": "Mumbai",
                "state": "NY",
                "country": "USA",
                "postal_code": "210099"
            }
        ],
        "contact_number": [
            {
                "contact_id": 1,
                "employee_id": 1,
                "contact_number": "1234567890"
            }
        ]
    },
    {
        "employee_id": 2,
        "department_id": 2,
        "employee_name": "ram singh",
        "employee_email": "ram.singh@orgconnect.com",
        "department": {
            "department_id": 2,
            "department_name": "Sales"
        },
        "address": [
            {
                "address_id": 2,
                "employee_id": 2,
                "address_line_1": "456 Elm Rd",
                "address_line_2": null,
                "city": "Pune",
                "state": "CA",
                "country": "USA",
                "postal_code": "900013"
            }
        ],
        "contact_number": [
            {
                "contact_id": 2,
                "employee_id": 2,
                "contact_number": "9876543210"
            }
        ]
    },
    {
        "employee_id": 3,
        "department_id": 3,
        "employee_name": "riya yadav",
        "employee_email": "riya.yadav@orgconnect.com",
        "department": {
            "department_id": 3,
            "department_name": "Human Resources"
        },
        "address": [
            {
                "address_id": 3,
                "employee_id": 3,
                "address_line_1": "789 Oak Rd",
                "address_line_2": null,
                "city": "Thane",
                "state": "IL",
                "country": "USA",
                "postal_code": "606013"
            }
        ],
        "contact_number": [
            {
                "contact_id": 3,
                "employee_id": 3,
                "contact_number": "5551234567"
            }
        ]
    },
    {
        "employee_id": 4,
        "department_id": 1,
        "employee_name": "rohit sharma",
        "employee_email": "rohit.sharma@orgconnect.com",
        "department": {
            "department_id": 1,
            "department_name": "Marketing"
        },
        "address": [
            {
                "address_id": 4,
                "employee_id": 4,
                "address_line_1": "101 Pine Rd",
                "address_line_2": null,
                "city": "Varanasi",
                "state": "CA",
                "country": "USA",
                "postal_code": "941014"
            }
        ],
        "contact_number": [
            {
                "contact_id": 4,
                "employee_id": 4,
                "contact_number": "4445556666"
            }
        ]
    },
    {
        "employee_id": 5,
        "department_id": 4,
        "employee_name": "sarita yadav",
        "employee_email": "sarita.yadav@orgconnect.com",
        "department": {
            "department_id": 4,
            "department_name": "Finance"
        },
        "address": [
            {
                "address_id": 5,
                "employee_id": 5,
                "address_line_1": "202 Maple Rd",
                "address_line_2": null,
                "city": "Kolkata",
                "state": "TX",
                "country": "USA",
                "postal_code": "770011"
            }
        ],
        "contact_number": [
            {
                "contact_id": 5,
                "employee_id": 5,
                "contact_number": "7778889999"
            }
        ]
    },
    {
        "employee_id": 6,
        "department_id": 2,
        "employee_name": "rita yadav",
        "employee_email": "rita@gmail.com",
        "department": {
            "department_id": 2,
            "department_name": "Sales"
        },
        "address": [],
        "contact_number": []
    },
    {
        "employee_id": 7,
        "department_id": 2,
        "employee_name": "Santosh Mallah",
        "employee_email": "ram.singh@orgconnect.com",
        "department": {
            "department_id": 2,
            "department_name": "Sales"
        },
        "address": [],
        "contact_number": []
    }
]
```


http://localhost/aertrip/web/admin/employee/update-employee

# Request

```json
{
    "employee_id": 10,
    "employee_name": "Santosh Doe",
    "employee_email": "john.doe@example.com",
    "department": {
        "department_id": 2,
        "department_name": "IT Department"
    },
    "address": [
        {
            "address_id": 1,
            "address_line_1": "123 Main St",
            "city": "New York",
            "state": "MAH",
            "country": "USA",
            "postal_code": "10001"
        }
    ],
    "contact_number": [
        {
            "contact_id": 1,
            "contact_number": "77777"
        }
    ]
}
```

# Response

```json
{
    "success": true,
    "message": "Employee data updated successfully.",
    "employee": {
        "employee_id": 1,
        "department_id": 2,
        "employee_name": "Santosh Doe",
        "employee_email": "john.doe@example.com"
    }
}
```


http://localhost/aertrip/web/admin/employee/create-employee

# Request

```json
{
    "employee_id": 10,
    "employee_name": "Santosh Doe",
    "employee_email": "john.doe@example.com",
    "department": {
        "department_id": 2,
        "department_name": "IT Department"
    },
    "address": [
        {
            "address_id": 1,
            "address_line_1": "123 Main St",
            "city": "New York",
            "state": "MAH",
            "country": "USA",
            "postal_code": "10001"
        }
    ],
    "contact_number": [
        {
            "contact_id": 1,
            "contact_number": "77777"
        }
    ]
}

```
# Response
```json
{
    "success": true,
    "message": "Employee and related records created successfully.",
    "employee": {
        "employee_id": 10,
        "department_id": 2,
        "employee_name": "Santosh Doe",
        "employee_email": "john.doe@example.com"
    }
}
```


http://localhost/aertrip/web/admin/employee/delete-employee?employee_id=10

# Response

```json
{
    "success": true,
    "message": "Employee and associated records deleted successfully."
}
```



![image](https://github.com/saritasy/aertrip/assets/109311562/59d00a89-0849-4f8b-86ab-0b3df4945df4)

![image](https://github.com/saritasy/aertrip/assets/109311562/bd216acb-cf4a-43aa-b42a-9ec6719cadb1)

![image](https://github.com/saritasy/aertrip/assets/109311562/c8d341b1-1e93-4c6b-95f9-84453948bf81)

![image](https://github.com/saritasy/aertrip/assets/109311562/dbadcdd5-a277-4847-8f90-082353e80774)


### Screen Shot

![image](https://github.com/saritasy/aertrip/assets/109311562/d76d3725-307b-44ed-9704-644d40f9cc06)

![image](https://github.com/saritasy/aertrip/assets/109311562/1bf7a8f5-76d2-4977-bdb8-aff64e73d367)

![image](https://github.com/saritasy/aertrip/assets/109311562/013a6742-723b-4761-befb-3497ad1fbbae)




