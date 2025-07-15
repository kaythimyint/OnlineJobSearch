<?php
require "database.php";
require "common_funtion.php";

//job_title
$job_title = [
    ['name' => 'Junior Java Developer'],
    ['name' => 'Senior Java Developer'],
    ['name' => 'Junior PHP Developer'],
    ['name' => 'Senior PHP Developer'],
];
foreach($job_title as $title){
    insertData('job_title',$mysqli,$title);
}

//job_type
$job_type = [
    ['name' => 'Full Time'],
    ['name' => 'Part Time'],
    ['name' => 'Remote'],
];
foreach($job_type as $type){
    insertData('job_type',$mysqli,$type);
}

//categories
$categories = [
    ['name' => 'Developer & IT'],
    ['name' => 'Prodction & Operation'],
    ['name' => 'Eduation & Training'],
    ['name' => 'Data Entry'],
    ['name' => 'Customer Service & Support'],
];
foreach($categories as $category){
    insertData('categories',$mysqli,$category);
}

//industry_type
$industry_type = [
    ['name' => 'Manufacturing'],
    ['name' => 'Constution'],
    ['name' => 'Eduation'],
    ['name' => 'Tehnology'],
    ['name' => 'Advertising'],
    ['name' => 'Transportation'],
    ['name' => 'Telecommunication'],
];
foreach($industry_type as $ind_type){
    insertData('industry_type',$mysqli,$ind_type);
}

//experience
$experience = [
    ['type' => '1~2 Years'],
    ['type' => '2~3 Years'],
    ['type' => '3~4 Years'],
    ['type' => '5 Years Above'],
    ['type' => 'No Experience'],
];
foreach($experience as $exp){
    insertData('experience',$mysqli,$exp);
}

//salary
$salarys = [
    ['type' => 'MMK: 100,000 ~ 200,000'],
    ['type' => 'MMK: 200,000 ~ 300,000'],
    ['type' => 'MMK: 300,000 ~ 400,000'],
    ['type' => 'MMK: 400,000 ~ 500,000'],
    ['type' => 'MMK: 500,000 ~ 600,000'],
];
foreach($salarys as $salary){
    insertData('salary',$mysqli,$salary);
}

//city
$cities = [
    ['name' => 'Yangon'],
    ['name' => 'Mandalay'],
    ['name' => 'Naypyitaw'],
    ['name' => 'Bago'],
];
foreach($cities as $city){
    insertData('location_city',$mysqli,$city);
}

//Township
$townships = [
    ['name' => 'Botahtaung'],
    ['name' => 'South Dagon'],
    ['name' => 'Sanchaung'],
    ['name' => 'Yankin'],
];
foreach($townships as $township){
    insertData('location_township',$mysqli,$township);
}

//users
$users = [
    [
        'first_name' => 'Aye Aye',
        'last_name' => 'Aung',
        'name' => 'AyeAyeAung',
        'email' => 'ayeayeaung@gmail.com',
        'password' => md5('password'),
        'gender' => 'female',
        'phone' => '0912345679',
        'address' => 'Yangon',
        'role' => 'user',
    ],
    [
        'first_name' => 'Mya Mya',
        'last_name' => 'Aung',
        'name' => 'MyaMyaAung',
        'email' => 'myamyaaung@gmail.com',
        'password' => md5('password'),
        'gender' => 'female',
        'phone' => '0912345679',
        'address' => 'Yangon',
        'role' => 'admin',
    ],
];
foreach($users as $user){
    insertData('users',$mysqli,$user);
}

// //company
// $companies = [
//     [
//         'company_name' => 'Company1',
//         'ceo_name' => 'CEO1',
//         'name' => 'Companyuser1',
//         'email' => 'companyuser1@gmail.com',
//         'password' => md5('password'),
//         'phone' => '0912345679',
//         'address' => 'Yangon',
//         'role' => 'employer',
//     ],
// ];
// foreach($companies as $company){
//     insertData('companies',$mysqli,$company);
// }
?>