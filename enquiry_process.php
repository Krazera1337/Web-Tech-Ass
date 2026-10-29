<?php
function enquiry_field($name)
{
    if (isset($_POST[$name]) && is_string($_POST[$name])) {
        return trim($_POST[$name]);
    }
    return '';
}

$errors = [];
$resultRows = [];
$backHref = 'enquiry.php';
$resultHeading = 'Enquiry Confirmation';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    $errors[] = 'Open the enquiry form, enter your message, and select Submit Enquiry.';
} else {
    $firstName = enquiry_field('firstname');
    $lastName = enquiry_field('lastname');
    $email = enquiry_field('email');
    $phone = enquiry_field('phone');
    $type = enquiry_field('enquiry_type');
    $comments = enquiry_field('comments');
    $types = [
        'families' => 'Families',
        'genera' => 'Genera',
        'species' => 'Species'
    ];

    if (!preg_match('/^[A-Za-z ]{1,25}$/D', $firstName)) {
        $errors[] = 'First name must contain letters only, up to 25 characters.';
    }
    if (!preg_match('/^[A-Za-z ]{1,25}$/D', $lastName)) {
        $errors[] = 'Last name must contain letters only, up to 25 characters.';
    }
    if (strlen($email) > 254 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Enter a valid email address.';
    }
    if (!preg_match('/^[0-9]{1,10}$/D', $phone)) {
        $errors[] = 'Phone number must contain up to 10 digits.';
    }
    if (!array_key_exists($type, $types)) {
        $errors[] = 'Select a valid enquiry type.';
    }
    if ($comments === '' || strlen($comments) > 2000) {
        $errors[] = 'Write a message of no more than 2000 characters.';
    }

    if (!$errors) {
        include('includes/db.inc.php');

        $saveEnquiry = mysqli_prepare($conn, 'INSERT INTO `enquiry` (first_name, last_name, email, phone, enquiry_type, comments) VALUES (?, ?, ?, ?, ?, ?)');
        mysqli_stmt_bind_param($saveEnquiry, 'ssssss', $firstName, $lastName, $email, $phone, $type, $comments);
        mysqli_stmt_execute($saveEnquiry);
        mysqli_stmt_close($saveEnquiry);

        $resultRows = [
            ['label' => 'Name', 'value' => $firstName . ' ' . $lastName],
            ['label' => 'Email address', 'value' => $email],
            ['label' => 'Phone number', 'value' => $phone],
            ['label' => 'Enquiry type', 'value' => $types[$type]],
            ['label' => 'Message', 'value' => $comments, 'multiline' => true]
        ];
    }
}

$bodyClass = 'enquiry-page form-result-page';
$activePage = 'enquiry';
$heroTitle = 'Enquiry';
$heroLede = 'Form submission confirmation.';
$heroTag = 'header';
$heroVariant = 'form';
include('includes/header.inc.php');
include('includes/nav.inc.php');
include('includes/page-hero.inc.php');
include('includes/form-result.inc.php');
include('includes/footer.inc.php');
