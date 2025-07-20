<?php
require "./common/url.php";
require "./common/database.php";
require "./common/common_funtion.php";

header('Content-Type: application/json');

// Get filters
$categories = isset($_POST['categories']) ? $_POST['categories'] : [];
$job_types = isset($_POST['job_types']) ? $_POST['job_types'] : [];
$salaries = isset($_POST['salaries']) ? $_POST['salaries'] : [];

$sql = "SELECT job_post.*, job_title.name AS title_name, companies.company_name AS company_name,
        categories.name AS category_name, salary.type AS salary_range,
        job_type.name AS job_type_name,
        location_city.name AS city_name, location_township.name AS township_name
        FROM job_post
        LEFT JOIN job_title ON job_post.job_title_id=job_title.id
        LEFT JOIN companies ON job_post.company_id=companies.id
        LEFT JOIN categories ON job_post.category_id=categories.id
        LEFT JOIN salary ON job_post.salary_id=salary.id
        LEFT JOIN job_type ON job_post.job_type_id=job_type.id
        LEFT JOIN location_city ON job_post.location_city_id=location_city.id
        LEFT JOIN location_township ON job_post.location_township_id=location_township.id";

$where = [];

if (!empty($categories)) {
    $escaped_categories = array_map(function($cat) use ($mysqli){
        return "'" . $mysqli->real_escape_string($cat) . "'";
    }, $categories);

    $where[] = "categories.name IN (" . implode(',', $escaped_categories) . ")";
}

if (!empty($job_types)) {
    $escaped_job_types = array_map(function($type) use ($mysqli){
        return "'" . $mysqli->real_escape_string($type) . "'";
    }, $job_types);

    $where[] = "job_type.name IN (" . implode(',', $escaped_job_types) . ")";
}

if (!empty($salaries)) {
    $escaped_salaries = array_map(function($sal) use ($mysqli){
        return "'" . $mysqli->real_escape_string($sal) . "'";
    }, $salaries);

    $where[] = "salary.type IN (" . implode(',', $escaped_salaries) . ")";
}

if (!empty($where)) {
    $sql .= " WHERE " . implode(' AND ', $where);
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
            'job_type' => $data['job_type_name'],
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
