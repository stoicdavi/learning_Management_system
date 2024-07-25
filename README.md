# Learning Management System
## features
- It has a student dashboard
- instructor dashboard
  
- allow instructors to
        - signup and sign in
        - add students
        - add courses
        - View available courses
        - signout
  
- allow a student to
        - signup and sign in
        - View available courses
        - enroll in the available courses

## to test the project
- make sure you xampp server installed on your computer
- open the htdocs folder in xampp and clone
- git clone https://github.com/stoicdavi/learning_Management_system.git
- start your xampp server
- make sure that the Apache is running
  ## edit the connect.php file as follows
<?php
$host = 'localhost';
$dbname = 'school';
$username ='root';
$password = 'use your db password';

$conn =  new mysqli($host, $username, $password, $dbname);

if($conn->connect_error){
    die('Database connection error: ' . $conn->connect_error);
}

## Create your database using the following SQL commands 
### Note: I am using MYSQL Workbench, but the database doesn't matter use any of your choices
-- Create the database
CREATE DATABASE school;

-- Use the newly created database
USE school;

-- Create the staff table first
CREATE TABLE staff (
    instructor_id INT PRIMARY KEY AUTO_INCREMENT,
    instructor_name VARCHAR(100)
);

-- Create the course table with a foreign key to the staff table
CREATE TABLE course (
    course_id VARCHAR(10) PRIMARY KEY,
    course_name VARCHAR(50),
    instructor_id INT,
    enrolled_students INT,
    description varchar(),
    FOREIGN KEY (instructor_id) REFERENCES staff(instructor_id)
);

-- Create the student's table with a foreign key to the course table
CREATE TABLE students (
    stud_id INT PRIMARY KEY AUTO_INCREMENT,
    stud_name VARCH
)

-- Use the existing database
USE school;

-- Modify the staff table to add a password field
ALTER TABLE staff
ADD COLUMN password_hash VARCHAR(255) NOT NULL;


ALTER TABLE students
ADD COLUMN password_hash VARCHAR(255) NOT NULL;

-- Create a table for course enrollments
CREATE TABLE enrollments (
    enrollment_id INT PRIMARY KEY AUTO_INCREMENT,
    stud_id INT,
    course_id VARCHAR(10),
    FOREIGN KEY (stud_id) REFERENCES students(stud_id),
    FOREIGN KEY (course_id) REFERENCES course(course_id)
);

-- Create a table for course enrollments
CREATE TABLE enrollments (
    enrollment_id INT PRIMARY KEY AUTO_INCREMENT,
    stud_id INT,
    course_id VARCHAR(10),
    FOREIGN KEY (stud_id) REFERENCES students(stud_id),
    FOREIGN KEY (course_id) REFERENCES course(course_id)
);

## TECHNOLOGIES USED
- PHP
- Bootraps CSS
- html
- MySQL Workbench for data storage
# when the app is running, this is the output
- homepage
![image](https://github.com/user-attachments/assets/4ee9723d-9c05-442e-a4b9-4365e97479d2)
- signup page
![image](https://github.com/user-attachments/assets/d4687499-a2eb-4f91-b573-3243516aba12)
- login page
![image](https://github.com/user-attachments/assets/15ed144b-064e-4ea5-b6d4-78f40ebdfdd8)
- instructor dashboard
![image](https://github.com/user-attachments/assets/f3f5b4b0-c076-4c1e-94e2-f68b1cd21268)
- student dashboard
![image](https://github.com/user-attachments/assets/c20e30b5-a091-48df-b245-ed326e44cc83)



