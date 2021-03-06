<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    if ($_SERVER['HTTP_REFERER'] == "") {
        echo "<script>confirm('本系统不允许从地址栏访问');</script>";
        echo "<script>location.href= \"../index.php\";</script>";
        exit();
    }
    ?>
    <meta charset="utf-8">
    <title>Neu后台管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin panel developed with the Bootstrap from Twitter.">
    <meta name="author" content="travis">
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/site.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#">Neu视频后台管理系统</a>
            <div class="btn-group pull-right">
                <a class="btn" href="my-profile.php"><i class="icon-user"></i><?php
                    require("../../system/dbConn.php");
                    if (!isset($_SESSION)) {
                        session_start();
                    }
                    $adminname = $_SESSION["adminname"];
                    echo $_SESSION["adminname"]; ?></a>
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="my-profile.php">我的信息</a></li>
                    <li class="divider"></li>
                    <li><a href="../Adminlogout.php">登出</a></li>
                </ul>
            </div>
            <div class="nav-collapse">
                <ul class="nav">
                    <li><a href="welcome.php">主页</a></li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">用户 <b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="divider"></li>
                            <li><a href="users.php">管理用户</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">管理员 <b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="new-role.php">添加管理员</a></li>
                            <li class="divider"></li>
                            <li><a href="roles.php">管理管理员</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">视频<b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="new-video.php">添加视频</a></li>
                            <li class="divider"></li>
                            <li><a href="video.php">视频管理</a></li>
                            <li class="divider"></li>
                            <li><a href="videotype.php">视频类型管理</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">评论<b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="divider"></li>
                            <li><a href="comment.php">评论管理</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span3">
            <div class="well sidebar-nav">
                <ul class="nav nav-list">
                    <li class="nav-header"><i class="icon-wrench"></i>用户和管理员</li>
                    <li><a href="users.php">用户</a></li>
                    <li><a href="roles.php">管理员</a></li>
                    <li class="nav-header"><i class="icon-signal"></i>视频和评论</li>
                    <li><a href="video.php">视频管理</a></li>
                    <li><a href="videotype.php">视频类型管理</a></li>
                    <li><a href="comment.php">评论管理</a></li>
                    <li class="nav-header"><i class="icon-user"></i>信息</li>
                    <li><a href="my-profile.php">我的信息</a></li>
                    <li><a href="../doAdminLogin.php">登出</a></li>
                </ul>
            </div>
        </div>
        <div class="span9">
            <div class="well hero-unit">
                <h1>Welcome，<?php echo $_SESSION["adminname"]; ?></h1>
                <p>欢迎您的登录，感谢您选择我们</p>
                <p><a class="btn btn-success btn-large" href="users.php">用户管理&raquo;</a></p>
            </div>
            <div class="row-fluid">
                <div class="span3">
                    <h3>用户数量</h3>
                    <p><a href="users.php" class="badge badge-inverse"><?php

                            $link = connect();
                            $sql = "select count(*) as number from users";
                            $rs = mysqli_query($link, $sql);
                            echo mysqli_fetch_assoc($rs)['number'];
                            ?></a></p>
                </div>
                <div class="span3">
                    <h3>视频数量</h3>
                    <p><a href="video.php" class="badge badge-inverse"><?php
                            $sql = "select count(*) as videonumber from videos";
                            $rs = mysqli_query($link, $sql);
                            echo mysqli_fetch_assoc($rs)['videonumber'];

                            ?></a></p>
                </div>
                <div class="span3">
                    <h3>评论数量</h3>
                    <p><a href="comment.php" class="badge badge-inverse"><?php
                            $sql = "select count(*) as commentnumber from comments";
                            $rs = mysqli_query($link, $sql);
                            echo mysqli_fetch_assoc($rs)['commentnumber'];
                            ?>
                        </a></p>
                </div>
            </div>
            <br/>
        </div>
    </div>
    <hr>
    <footer class="well">
        <a>HackRandom工作室 版权所有©2018-2020 技术支持电话：13099255092</a>
    </footer>
    <?php
    $sql = "select * from admins where adminname ='$adminname'";
    $rs = mysqli_query($link, $sql);
    $now = mysqli_fetch_assoc($rs);
    $_SESSION["adminid"] = $now['adminid'];

    ?>
</div>

<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
