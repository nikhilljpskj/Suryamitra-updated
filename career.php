<?php
declare(strict_types=1);

require __DIR__ . '/form_helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sm_render_response('Invalid Request', 'Please submit the career form from the website.', 'career-page.php');
}

$firstName = sm_clean_line($_POST['quicname'] ?? '');
$lastName = sm_clean_line($_POST['quiclname'] ?? '');
$email = filter_var(sm_clean_line($_POST['quicemail'] ?? ''), FILTER_VALIDATE_EMAIL) ?: '';
$phone = sm_normalize_phone($_POST['quicphone'] ?? '');
$designation = sm_clean_line($_POST['quicdesig'] ?? '');
$message = sm_clean_text($_POST['quicmessage'] ?? '');
$securityCode = $_POST['security_code'] ?? '';
$resume = $_FILES['uploaded_file'] ?? null;

if ($firstName === '' || $lastName === '' || $email === '' || $phone === '' || $designation === '' || $designation === 'Select' || mb_strlen($message) < 2) {
    sm_render_response('Career Form Error', 'Please complete all required fields before submitting your application.', 'career-page.php');
}

if (strlen($phone) < 7 || strlen($phone) > 15) {
    sm_render_response('Career Form Error', 'Please enter a valid phone number.', 'career-page.php');
}

if (!sm_validate_captcha($securityCode)) {
    sm_render_response('Career Form Error', 'The security code did not match. Please try again.', 'career-page.php');
}

if (!is_array($resume) || ($resume['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
    sm_render_response('Career Form Error', 'Please attach your resume in PDF, DOC, or DOCX format.', 'career-page.php');
}

$resumeName = basename((string) ($resume['name'] ?? 'resume'));
$resumeExtension = strtolower(pathinfo($resumeName, PATHINFO_EXTENSION));
$allowedExtensions = ['pdf', 'doc', 'docx'];

if (!in_array($resumeExtension, $allowedExtensions, true)) {
    sm_render_response('Career Form Error', 'Only PDF, DOC, and DOCX resumes are allowed.', 'career-page.php');
}

$resumeSize = (int) ($resume['size'] ?? 0);
if ($resumeSize <= 0 || $resumeSize > 2 * 1024 * 1024) {
    sm_render_response('Career Form Error', 'The uploaded resume must be smaller than 2 MB.', 'career-page.php');
}

$resumeContent = file_get_contents((string) $resume['tmp_name']);
if ($resumeContent === false) {
    sm_render_response('Career Form Error', 'We could not read the uploaded resume. Please try again.', 'career-page.php');
}

$mime = 'application/octet-stream';
if (function_exists('finfo_open')) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    if ($finfo !== false) {
        $detected = finfo_file($finfo, (string) $resume['tmp_name']);
        if (is_string($detected) && $detected !== '') {
            $mime = $detected;
        }
        finfo_close($finfo);
    }
}

$body = implode("\n", [
    'Career application received from suryamitra.co.in',
    '',
    'First Name: ' . $firstName,
    'Last Name: ' . $lastName,
    'Phone: ' . $phone,
    'Email: ' . $email,
    'Applied For: ' . $designation,
    'Message: ' . $message,
]);

$sent = sm_send_mail_with_attachment(
    'sales@suryamitra.co.in',
    'Career Application - ' . $designation,
    $body,
    $email,
    [
        'name' => $resumeName,
        'mime' => $mime,
        'content' => $resumeContent,
    ]
);

if (!$sent) {
    sm_render_response('Career Form Error', 'We could not submit your application right now. Please try again later.', 'career-page.php');
}

sm_render_response('Application Submitted', 'Thank you for applying. Our team will review your profile and contact you if your application is shortlisted.', 'career-page.php');
