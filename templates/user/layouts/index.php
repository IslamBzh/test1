<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <meta name="robots" content="noindex">

    <title><?php print($title); ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/resourses/media/favicon.ico">

    <!-- Fonts -->
    <link rel="stylesheet" href="/resourses/css/main.css?v=0.1">
    <link rel="stylesheet" href="/resourses/css/user.css?v=0.1">
    <link rel="stylesheet" href="/resourses/css/icons.css?v=0.1">

    <!-- Scripts -->
    <script type="text/javascript" src="/resourses/js/main.js"></script>
    <script defer type="text/javascript" src="/resourses/js/user.js"></script>
</head>

<body>
    <?php
        if(isset($content))
            print("<div id=\"content\">{$content}</div>");
        else
            print("<h1>Content not loaded.</h1>");
    ?>
</body>
</html>