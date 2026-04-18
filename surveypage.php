<?php
declare(strict_types=1);

require __DIR__ . '/form_helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sm_render_response('Invalid Request', 'Please submit the survey form from the website.', 'booksurvey.html');
}

$name = sm_clean_line($_POST['sname'] ?? '');
$phone = sm_normalize_phone($_POST['smob'] ?? '');
$email = filter_var(sm_clean_line($_POST['semail'] ?? ''), FILTER_VALIDATE_EMAIL) ?: '';
$state = sm_clean_line($_POST['sstate'] ?? '');
$city = sm_clean_line($_POST['scity'] ?? '');
$pin = sm_clean_line($_POST['spin'] ?? '');
$electricityBill = sm_clean_line($_POST['selectric'] ?? '');

if ($name === '' || $phone === '' || $email === '' || $state === '' || $city === '' || $pin === '' || $electricityBill === '') {
    sm_render_response('Survey Request Error', 'Please complete the site survey form with valid details.', 'booksurvey.html');
}

if (strlen($phone) < 10 || strlen($phone) > 15) {
    sm_render_response('Survey Request Error', 'Please enter a valid mobile number.', 'booksurvey.html');
}

$body = implode("\n", [
    'New solar site survey request received from suryamitra.co.in',
    '',
    'Name: ' . $name,
    'Phone: ' . $phone,
    'Email: ' . $email,
    'State: ' . $state,
    'City: ' . $city,
    'Pin Code: ' . $pin,
    'Highest Electricity Bill: ' . $electricityBill,
]);

$sent = sm_send_mail('sales@suryamitra.co.in', 'New Customer Site Survey Request', $body, $email);

if (!$sent) {
    sm_render_response('Survey Request Error', 'We could not submit your site survey request right now. Please try again later.', 'booksurvey.html');
}

sm_render_response('Request Submitted', 'Thank you for requesting a free site survey. We will contact you very soon.', 'booksurvey.html');
