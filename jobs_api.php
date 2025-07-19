<?php
require "./common/url.php";
require "./common/database.php";
require "./common/common_funtion.php";

header('Content-Type: application/json');

$select_city = selectData('Location_city',$mysqli);
    $select_category = selectData('categories',$mysqli);
    $select_job_type = selectData('job_type',$mysqli);
    $select_salary = selectData('salary',$mysqli);


$category = isset($_POST['categories']) ? $mysqli->real_escape_string($_POST['categories']) : '';

$sql = "SELECT job_post.*, job_title.name AS title_name, companies.company_name AS company_name,
        categories.name AS category_name, salary.type AS salary_range,
        location_city.name AS city_name, location_township.name AS township_name
        FROM job_post
        LEFT JOIN job_title ON job_post.job_title_id=job_title.id
        LEFT JOIN companies ON job_post.company_id=companies.id
        LEFT JOIN categories ON job_post.category_id=categories.id
        LEFT JOIN salary ON job_post.salary_id=salary.id
        LEFT JOIN location_city ON job_post.location_city_id=location_city.id
        LEFT JOIN location_township ON job_post.location_township_id=location_township.id";

if (!empty($category)) {
    $sql .= " WHERE categories.name = '$category'";
}
$sql .= " ORDER BY job_post.id DESC"; 

$result = $mysqli->query($sql);

$jobs = [];
if ($result->num_rows > 0) {
    while ($data = $result->fetch_assoc()) {
        $jobs[] = [
            'id'   => $data['id'],
            'title' => $data['title_name'],
            'company' => $data['company_name'],
            'category' => $data['category_name'],
            'city' => $data['city_name'],
            'township' => $data['township_name'],
            'salary' => $data['salary_range'],
            'deadline' => $data['deadline'],
            'description' => $data['description']
        ];
    }
}
if (!empty($jobs)) {
    echo json_encode(['jobs' => $jobs]);
} else {
    echo json_encode(['message' => 'No jobs found']);
}
?>
