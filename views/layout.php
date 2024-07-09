<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/build/css/app.css">
    <title>New Project</title>
</head>

<body>
    <?= $content; ?>

    <footer></footer>

    <script src="/build/js/app.js"></script>
    <?= isset($script) && !empty($script) ? "<script src=\"/build/js/{$script}.js\"></script>" : '' ?>
</body>

</html>