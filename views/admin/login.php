<?php
if (Admin::is_admin_logged()) {
    Router::header_location('/admin');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Admin - login</title>

    <!-- Bootstrap core CSS -->
    <link href="/views/admin/assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="/views/admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>

    <!-- Custom styles for this template -->
    <link href="/views/admin/assets/css/style.css" rel="stylesheet">
    <link href="/views/admin/assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- **********************************************************************************************************************************************************
MAIN CONTENT
*********************************************************************************************************************************************************** -->

<div id="login-page">
    <div class="container">
        <form method="post" class="form-login">
            <h2 class="form-login-heading">Вход</h2>
            <div class="login-wrap">
                <input type="text" name="admin_mail" class="form-control"
                       value="<?= isset($data['mail']) ? $data['mail'] : "" ?>" placeholder="Почта" autofocus>
                <br>
                <input type="password" name="admin_password" class="form-control" placeholder="Пароль">
                <br/>
                <input class="btn btn-theme btn-block" value="Войти" name="login_admin_submit" type="submit"/>
            </div>

            <div class="registration" style="text-align: center; margin-top: -10px; padding-bottom: 10px;">
                <a href="/">
                    Вернуться на главную
                </a>
            </div>

            <?php if (isset($data['error']) && $data['error']): ?>
                <div class="login-social-link centered">
                    <p>Неверная почта или пароль</p>
                </div>
            <?php endif; ?>
        </form>

    </div>
</div>

<!-- js placed at the end of the document so the pages load faster -->
<script src="/views/admin/assets/js/jquery.js"></script>
<script src="/views/admin/assets/js/bootstrap.min.js"></script>

<!--BACKSTRETCH-->
<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
<script type="text/javascript" src="/views/admin/assets/js/jquery.backstretch.min.js"></script>
<script>
    $.backstretch("/views/admin/assets/img/login-bg.jpg", {speed: 1000});
</script>

</body>
</html>
