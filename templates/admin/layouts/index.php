<?php
    $hash = isset($_SESSION['hash']) ? $_SESSION['hash'] : '';
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <meta name="robots" content="noindex">

    <title><?=$title?></title>

    <script type="text/javascript">
        var hash = "<?=$hash?>";
    </script>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/resourses/media/favicon.ico">

    <!-- Fonts -->
    <link rel="stylesheet" href="/resourses/css/main.css?v=0.1">
    <link rel="stylesheet" href="/resourses/css/admin.css?v=0.1">
    <link rel="stylesheet" href="/resourses/css/icons.css?v=0.1">

    <!-- Scripts -->
    <script type="text/javascript" src="/resourses/js/main.js"></script>
    <script type="text/javascript" src="/resourses/js/branch.js"></script>
    <script defer type="text/javascript" src="/resourses/js/admin.js"></script>
</head>

<body>
    <?php if(Session::is_auth()): ?>
    <header>
        <div id="message">
            <span></span>
        </div>
        <form action="/admin/auth" method="post">
            <span><?=$_SESSION['username']?></span>
            <input type="hidden" name="hash" value="<?=$hash?>">
            <input type="submit" name="logout" value="Выйти">
        </form>
    </header>
    <?php endif; ?>
    <?php if(isset($content)): ?>

        <div id="content">
            <?php print($content); ?>
        </div>

    <?php else: ?>

        <h1>Content not loaded.</h1>

    <?php endif; ?>

    <div id="popup"></div>
</body>
</html>