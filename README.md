## Task Management

## Ask
Backend (Laravel):
- Set up a RESTful API using Laravel to manage tasks.
- Each task should have: id, title, description, due_date, and status (e.g., pending, completed).
- Implement routes for creating, retrieving, updating, and deleting tasks.
- Store tasks in a relational database (e.g., MySQL). Use migrations for setting up the database schema.
- Implement authentication. Users should be able to register and log in. Protect the task routes to ensure only authenticated users can access them.
- Use middleware to handle API versioning.
- Write tests for your API endpoints using PHPUnit.

### step 1
create model for tasks to create 

### step 2
use laravel breeze for user Auth. and modify according to requirements as there is no response returned.

### step 3
create resource controller for task. user repositories for strict contract. 

### step 4
Add middleware for versioning

### step 5
Add test cases


### how to run 
```
cd task-manage-api
composer install
./vendor/bin/sail up -d

on browser 
http://localhost:80/

telescope for request profile
http://localhost/telescope
```

### use of API

Import the postman environment & collection for testing.
