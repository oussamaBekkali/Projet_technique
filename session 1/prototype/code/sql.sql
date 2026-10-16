CREATE DATABASE softproject;
USE softproject;

CREATE TABLE DEVELOPER (
    id_developer INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    specialization VARCHAR(100),
    date_joined DATE NOT NULL DEFAULT (CURRENT_DATE)
);

CREATE TABLE TASKSTATUS (
    id_status INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(255)
);

CREATE TABLE TASK (
    id_task INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    priority ENUM('Low', 'Medium', 'High') NOT NULL,
    date_created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    deadline DATE,
    id_developer INT NOT NULL,
    id_status INT NOT NULL,

    FOREIGN KEY (id_developer)
        REFERENCES DEVELOPER(id_developer),

    FOREIGN KEY (id_status)
        REFERENCES TASKSTATUS(id_status)
);
INSERT INTO DEVELOPER (first_name, last_name, email, specialization)
VALUES
('Oussama', 'Bakkali', 'oussama@example.com', 'Backend Development'),
('Youssef', 'Amrani', 'youssef@example.com', 'Frontend Development'),
('Sara', 'Alaoui', 'sara@example.com', 'Full Stack Development');
INSERT INTO TASKSTATUS (name, description)
VALUES
('Pending', 'Task has not been started yet'),
('In Progress', 'Task is currently being worked on'),
('Completed', 'Task has been completed');