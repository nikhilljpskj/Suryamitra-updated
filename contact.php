<?php
declare(strict_types=1);

require __DIR__ . '/form_helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sm_render_response('Invalid Request', 'Please submit the contact form from the website.', 'contact-page.php');
}

$firstName = sm_clean_line($_POST['quicname'] ?? '');
$lastName = sm_clean_line($_POST['quiclname'] ?? '');
$email = filter_var(sm_clean_line($_POST['quicemail'] ?? ''), FILTER_VALIDATE_EMAIL) ?: '';
$phone = sm_normalize_phone($_POST['quicphone'] ?? '');
$company = sm_clean_line($_POST['quiccompany'] ?? '');
$subject = sm_clean_line($_POST['quicsubject'] ?? '');
$message = sm_clean_text($_POST['quicmessage'] ?? '');
$securityCode = $_POST['security_code'] ?? '';

if ($firstName === '' || $lastName === '' || $email === '' || $phone === '' || $subject === '' || mb_strlen($message) < 2) {
    sm_render_response('Contact Form Error', 'Please complete all required fields with valid details.', 'contact-page.php');
}

if (strlen($phone) < 7 || strlen($phone) > 15) {
    sm_render_response('Contact Form Error', 'Please enter a valid phone number.', 'contact-page.php');
}

if (!sm_validate_captcha($securityCode)) {
    sm_render_response('Contact Form Error', 'The security code did not match. Please try again.', 'contact-page.php');
}

$body = implode("\n", [
    'Customer enquiry received from suryamitra.co.in',
    '',
    'First Name: ' . $firstName,
    'Last Name: ' . $lastName,
    'Phone: ' . $phone,
    'Email: ' . $email,
    'Company: ' . $company,
    'Subject: ' . $subject,
    'Message: ' . $message,
]);

$sent = sm_send_mail('sales@suryamitra.co.in', 'New Customer Enquiry', $body, $email);

if (!$sent) {
    sm_render_response('Contact Form Error', 'We could not send your enquiry right now. Please call us on 1800 889 6542.', 'contact-page.php');
}

sm_render_response('Thank You', 'Thank you for contacting us. We will be in touch with you very soon.', 'contact-page.php');
