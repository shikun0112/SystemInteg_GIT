# Simple CRUD API
    Github Activity: GitHub Setup, Push, Pull and Clone


## API Description
    The Simple CRUD API is a straightforward API designed for basic CRUD (Create, Read, Update, Delete) operations on a database of names. It provides endpoints to add, retrieve, update, and delete names in a MySQL database.


## API Endpoints
POST /postName
- **Function:** Create a new name entry in the database.
- **Required Parameter:** None

GET /printName
- **Function:** Retrieve and print names from the database.
- **Required Parameter:** None

PUT /updateName/{id}
- **Function:** Update a name entry in the database.
- **Required Parameter:** id (integer) - The unique identifier of the name entry.

DELETE /deleteName/{id}
- **Function:** Delete a name entry from the database.
- **Required Parameter:** id (integer) - The unique identifier of the name entry.


## Request Payload
1. For using the endpoint "/postName" or inserting names 
to the database, an example of request payload must be typed 
in before requesting.
- **JSON structure example**
    {
    "fname": "John",
    "lname": "Doe"
    }

2. For using the endpoint "/updateName" or "/deleteName" from
the database, an id number must be typed in the link
Example:http://localhost/api/public/updateName/1
        http://localhost/api/public/deleteName/1

## Response Payload
1. /postName
{
  "status": "success",
  "data": null
}

2. /printName
{
  "status": "success",
  "data": [
    {"fname": "Gene Larenz", "lname": "Garcia"},
  ]
}

3. /updateName/{id}
{
  "status": "success",
  "data": null
}


4. /deleteName/{id}
{
  "status": "success",
  "data": null
}

## Usage
You can interact with the API by making HTTP requests using any 
HTTP client or programming language capable of sending HTTP requests. 
Below are examples of cURL commands for each endpoint:

1. Create a New Name Entry
    *To create a new name entry in the database, you can use the following cURL command:
    
    curl -X POST -H "Content-Type: application/json" -d '{
    "fname": "John",
    "lname": "Doe"
    }' http://your-api-url/postName

    *Replace http://your-api-url with the actual URL where your API is hosted.

2. Retrieve and Print Names
    *To retrieve and print names from the database, you can use the following cURL command:

    curl -X GET http://your-api-url/printName

    *Replace http://your-api-url with the actual URL where your API is hosted.

3. Update a Name Entry
    *To update a name entry in the database, you can use the following cURL command. Replace {id} with the actual ID of the name entry you want to update:

    curl -X PUT -H "Content-Type: application/json" -d '{
    "fname": "Updated First Name",
    "lname": "Updated Last Name"
    }' http://your-api-url/updateName/{id}

    *Replace http://your-api-url with the actual URL where your API is hosted and {id} with the ID of the name entry.

4. Delete a Name Entry
    *To delete a name entry from the database, you can use the following cURL command. Replace {id} with the actual ID of the name entry you want to delete:

    curl -X DELETE http://your-api-url/deleteName/{id}

    *Replace http://your-api-url with the actual URL where your API is hosted and {id} with the ID of the name entry you want to delete.

    *Feel free to use any HTTP client or programming language of your choice to interact with the API as per your requirements.

    *It is required also to customize the placeholders like 
    `http://your-api-url` and `{id}` with the actual values as needed.

## Contributors
    GENE LARENZ V. GARCIA (sutorejii123789@gmail.com)
    ARON JAY C. TADINA (aronjay.tadina@student.dmmmsu.edu.ph)
    JAYNARD A. RAQUEñO  ( COLLABORATOR)

## Contact Information
    Mobile number: +63 915 422 8794 
    Email: genelarenz.garcia@student.dmmmsu.edu.ph
    Alt Email: sutorejii123789@gmail.com
