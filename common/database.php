<?php
$host = "localhost";
$user_name = "root";
$password = "";

$mysqli = new mysqli($host, $user_name, $password);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

create_database($mysqli);
function create_database($mysqli)       
{
    $sql = "CREATE DATABASE IF NOT EXISTS `job_search`
            DEFAULT CHARACTER SET utf8mb4 
            COLLATE utf8mb4_general_ci";
    if ($mysqli->query($sql)) {
        return true;
    } else {
        return false;
    }
}
function select_db($mysqli)
{
    if ($mysqli->select_db("job_search")) {
        return true;
    }
    return false;
}
select_db($mysqli);
create_table($mysqli);
function create_table($mysqli)
{
    //Users Table
    $sql = "CREATE TABLE IF NOT EXISTS `users`(
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(30) NOT NULL,
            last_name VARCHAR(30) NOT NULL,
            name VARCHAR(30) NOT NULL,
            email VARCHAR(30) NOT NULL UNIQUE,
            password VARCHAR(50) NOT NULL,
            gender ENUM('male','female') NOT NULL,
            phone VARCHAR(20) NOT NULL,
            skill VARCHAR(30) NOT NULL,
            experience VARCHAR(30) NOT NULL,
            address VARCHAR(50) NOT NULL,
            education VARCHAR(30) NOT NULL,
            profile VARCHAR(50) NOT NULL,
            role ENUM('admin','user') NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
    if ($mysqli->query($sql) === false) return false;

    //Categories Table
    $sql = "CREATE TABLE IF NOT EXISTS `categories`(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL
            )";
    if ($mysqli->query($sql) === false) return false;

    //Companies Table
    $sql = "CREATE TABLE IF NOT EXISTS `companies`(
            id INT AUTO_INCREMENT PRIMARY KEY,
            company_name VARCHAR(50) NOT NULL,
            ceo_name VARCHAR(30) NOT NULL,
            name VARCHAR(30) NOT NULL,
            email VARCHAR(30) NOT NULL UNIQUE,
            role ENUM('admin','employer') NOT NULL,
            phone VARCHAR(20) NOT NULL,
            address VARCHAR(50) NOT NULL,
            password VARCHAR(50) NOT NULL,
            confirm_password VARCHAR(50) NOT NULL,
            category_id INT NOT NULL,
            profile VARCHAR(50) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
            )";
    if ($mysqli->query($sql) === false) return false;

    //Salary Table
    $sql = "CREATE TABLE IF NOT EXISTS `salary`(
            id INT AUTO_INCREMENT PRIMARY KEY,
            type VARCHAR(30) NOT NULL
            )";
    if ($mysqli->query($sql) === false) return false;

    //Job_title Table
    $sql = "CREATE TABLE IF NOT EXISTS `job_title`(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(50) NOT NULL
            )";
    if ($mysqli->query($sql) === false) return false;

    //Experience Table
    $sql = "CREATE TABLE IF NOT EXISTS `experience`(
            id INT AUTO_INCREMENT PRIMARY KEY,
            type VARCHAR(30) NOT NULL
            )";
    if ($mysqli->query($sql) === false) return false;

    //Job_post_categories Table
    $sql = "CREATE TABLE IF NOT EXISTS `job_post_categories`(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL
            )";
    if ($mysqli->query($sql) === false) return false;

    //Location_city Table
    $sql = "CREATE TABLE IF NOT EXISTS `location_city`(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL
            )";
    if ($mysqli->query($sql) === false) return false;

    //Location_township Table
    $sql = "CREATE TABLE IF NOT EXISTS `location_township`(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(20) NOT NULL
            )";
    if ($mysqli->query($sql) === false) return false;

    //Job_type Table
    $sql = "CREATE TABLE IF NOT EXISTS `job_type`(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL
            )";
    if ($mysqli->query($sql) === false) return false;

    //Job_post Table
    $sql = "CREATE TABLE IF NOT EXISTS `job_post`(
        id INT AUTO_INCREMENT PRIMARY KEY,
        company_id INT NOT NULL,
        job_title_id INT NOT NULL UNIQUE,
        requirements VARCHAR(20) NOT NULL,
        experience_id INT NOT NULL,
        salary_id INT NOT NULL,
        description VARCHAR(50) NOT NULL,
        job_type_id INT NOT NULL,
        location_city_id INT NOT NULL,
        location_township_id INT NOT NULL,
        job_post_category_id INT NOT NULL,
        posted_date VARCHAR(20) NOT NULL,
        deadline VARCHAR(20) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (company_id) REFERENCES companies(id) ON DELETE CASCADE,
        FOREIGN KEY (job_title_id) REFERENCES job_title(id) ON DELETE CASCADE,
        FOREIGN KEY (experience_id) REFERENCES experience(id) ON DELETE CASCADE,
        FOREIGN KEY (salary_id) REFERENCES salary(id) ON DELETE CASCADE,
        FOREIGN KEY (job_type_id) REFERENCES job_type(id) ON DELETE CASCADE,
        FOREIGN KEY (location_city_id) REFERENCES location_city(id) ON DELETE CASCADE,
        FOREIGN KEY (location_township_id) REFERENCES location_township(id) ON DELETE CASCADE,
        FOREIGN KEY (job_post_category_id) REFERENCES job_post_categories(id) ON DELETE CASCADE
        )";
    if ($mysqli->query($sql) === false) return false;

    //Applications Table
    $sql = "CREATE TABLE IF NOT EXISTS `applications`(
        id INT AUTO_INCREMENT PRIMARY KEY,
        job_post_id INT NOT NULL,
        user_id INT NOT NULL,
        status VARCHAR(20) NOT NULL,
        application_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (job_post_id) REFERENCES job_post(id) ON DELETE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        )";
}
?>