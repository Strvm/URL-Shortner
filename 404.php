<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/fonts.css">
    <link rel="stylesheet" href="styles/404.css">
</head>
<body>
<div class="container">
    <h1 class="trigger" data-aos="fade-down">404</h1>
    <div data-aos="fade-up" data-aos-delay="800">
        <h2>Oops, Page Not Found </h2>
        <h3>The link might be corrupted</h3>
        <h4>Or the page may have been removed</h4>
        <a href="/links_page.php" data-aos="flip-left">
            <div>Return to Home</div>
        </a>
    </div>
</div>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    AOS.init({
        once: true,
        duration: 800,
    });
</script>
</body>
</html>