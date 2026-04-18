<?php
declare(strict_types=1);

if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    http_response_code(404);
    exit('Not Found');
}

function sm_render_response(string $title, string $message, string $backUrl): never
{
    http_response_code(200);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
</head>
<body>
    <div class="page-wrapper">
        <section class="page-banner style-two" style="background-image:url(images/top-banner/contact-us.jpg)">
            <div class="auto-container">
                <div class="inner-container clearfix">
                    <h1><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h1>
                </div>
            </div>
        </section>
        <section class="design-section">
            <div class="auto-container" style="padding: 60px 15px;">
                <div class="sec-title">
                    <h2><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></h2>
                </div>
                <p><a class="contact-btn btn-style-one" href="<?php echo htmlspecialchars($backUrl, ENT_QUOTES, 'UTF-8'); ?>">Go Back</a></p>
            </div>
        </section>
    </div>
</body>
</html>
    <?php
    exit;
}

function sm_clean_line(string $value): string
{
    $value = trim($value);
    $value = str_replace(["\r", "\n"], ' ', $value);
    return preg_replace('/\s+/', ' ', $value) ?? $value;
}

function sm_clean_text(string $value): string
{
    $value = trim($value);
    return preg_replace('/[^\P{C}\t\n]+/u', '', $value) ?? $value;
}

function sm_normalize_phone(string $value): string
{
    return preg_replace('/[^0-9+]/', '', $value) ?? '';
}

function sm_validate_captcha(?string $submitted): bool
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $expected = strtolower((string) ($_SESSION['security_code'] ?? ''));
    $submitted = strtolower(sm_clean_line((string) $submitted));

    if ($expected === '' || $submitted === '') {
        return false;
    }

    $valid = hash_equals($expected, $submitted);
    unset($_SESSION['security_code']);

    return $valid;
}

function sm_build_headers(?string $replyTo = null): string
{
    $headers = [
        'MIME-Version: 1.0',
        'Content-Type: text/plain; charset=UTF-8',
        'From: SuryaMitra Website <no-reply@suryamitra.co.in>',
    ];

    if ($replyTo !== null && $replyTo !== '') {
        $headers[] = 'Reply-To: ' . $replyTo;
    }

    return implode("\r\n", $headers);
}

function sm_send_mail(string $to, string $subject, string $body, ?string $replyTo = null): bool
{
    return @mail($to, $subject, $body, sm_build_headers($replyTo));
}

function sm_send_mail_with_attachment(
    string $to,
    string $subject,
    string $body,
    string $replyTo,
    array $file
): bool {
    $boundary = '==Multipart_Boundary_x' . md5((string) microtime(true)) . 'x';

    $headers = [
        'MIME-Version: 1.0',
        'From: SuryaMitra Website <no-reply@suryamitra.co.in>',
        'Reply-To: ' . $replyTo,
        'Content-Type: multipart/mixed; boundary="' . $boundary . '"',
    ];

    $message = [];
    $message[] = '--' . $boundary;
    $message[] = 'Content-Type: text/plain; charset=UTF-8';
    $message[] = 'Content-Transfer-Encoding: 8bit';
    $message[] = '';
    $message[] = $body;
    $message[] = '';
    $message[] = '--' . $boundary;
    $message[] = 'Content-Type: ' . ($file['mime'] ?? 'application/octet-stream') . '; name="' . $file['name'] . '"';
    $message[] = 'Content-Disposition: attachment; filename="' . $file['name'] . '"';
    $message[] = 'Content-Transfer-Encoding: base64';
    $message[] = '';
    $message[] = chunk_split(base64_encode((string) $file['content']));
    $message[] = '--' . $boundary . '--';

    return @mail($to, $subject, implode("\r\n", $message), implode("\r\n", $headers));
}
