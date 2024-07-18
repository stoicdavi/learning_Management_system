-- Create the database
CREATE DATABASE school;

-- Use the newly created database
USE school;

-- Create the students table with a foreign key to the course table
CREATE TABLE students (
    stud_id INT PRIMARY KEY AUTO_INCREMENT,
    stud_name VARCHAR(100),
    email VARCHAR(100),
    course_id VARCHAR(10),
    FOREIGN KEY (course_id) REFERENCES course(course_id)
);

-- Create the course table with a foreign key to the staff table
CREATE TABLE course (
    course_id VARCHAR(10) PRIMARY KEY,
    course_name VARCHAR(50),
    instructor_id INT,
    enrolled_students INT,
    FOREIGN KEY (instructor_id) REFERENCES staff(instructor_id)
);

-- Create the staff table
CREATE TABLE staff (
    instructor_id INT PRIMARY KEY AUTO_INCREMENT,
    instructor_name VARCHAR(100)
);
