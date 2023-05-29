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
    <script defer type="text/javascript" src="/resourses/js/admin.js"></script>
    <script defer type="text/javascript" src="/resourses/js/branch.js"></script>
</head>

<body>
    <? if(Session::is_auth()): ?>
    <header>
        <div id="message">
            <span></span>
            <div class="action">
                <a href="//" act="close"></a>
            </div>
        </div>
        <form action="/admin/auth" method="post">
            <span><?=$_SESSION['username']?></span>
            <input type="hidden" name="hash" value="<?=$hash?>">
            <input type="submit" name="logout" value="Выйти">
        </form>
    </header>
    <? endif; ?>
    <? if(isset($content)): ?>

        <div id="content">
            <? print($content); ?>
        </div>

    <? else: ?>

        <h1>Content not loaded.</h1>

    <? endif; ?>
</body>
</html>