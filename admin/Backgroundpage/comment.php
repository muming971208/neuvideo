<!DOCTYPE html>
<html lang="en">
<head>
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
    <!--[if lte IE 8]>
    <script src="../assets/js/excanvas.min.js"></script><![endif]-->
    <style type="text/css">
        html, body {
            height: 100%;
        }
    </style>
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
            <a class="brand" href="welcome.php">Neu视频后台管理系统</a>
            <div class="btn-group pull-right">
                <a class="btn" href="my-profile.php"><i class="icon-user"></i> <?php if (!isset($_SESSION)) {
                        session_start();
                    }
                    echo $_SESSION["adminname"]; ?></a>
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="my-profile.php">Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="../doAdminLogin.php">登出</a></li>
                </ul>
            </div>
            <div class="nav-collapse">
                <ul class="nav">
                    <li><a href="welcome.php">主页</a></li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">用户 <b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="new-user.php">添加新用户</a></li>
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
                    <li class="nav-header"><i class="icon-wrench"></i> 用户和管理员</li>
                    <li><a href="users.php">用户</a></li>
                    <li><a href="roles.php">管理员</a></li>
                    <li class="nav-header"><i class="icon-signal"></i>视频和评论</li>
                    <li><a href="video.php">视频管理</a></li>
                    <li><a href="videotype.php">视频类型管理</a></li>
                    <li><a href="comment.php">评论管理</a></li>
                    <li class="nav-header"><i class="icon-user"></i> 信息</li>
                    <li><a href="my-profile.php">我的信息</a></li>
                    <li><a href="../Adminlogout.php">登出</a></li>
                </ul>
            </div>
        </div>
        <div class="span9">
            <div class="row-fluid">
                <div class="page-header">
                    <h1>评论
                        <small>评论管理</small>
                    </h1>
                </div>
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Content</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    require("./getpages.php");
                    if (!isset($_GET["num"])) {
                        $_GET['num'] = 1;
                    }
                    if (!isset($_GET["size"])) {
                        $_GET['size'] = 5;
                    }
                    $ary = getCommentDate($_GET['num'], $_GET['size']);

                    while ($num = mysqli_fetch_assoc($ary[0])) {
                        echo '<tr class="list-roles">';
                        echo "<td >" . $num['cid'] . "</td >";
                        echo "<td id='" . "commentname_" . $num['cid'] . "'>" . $num['content'] . "</td >";
                        echo '<td>
                               <div class="btn-group">
                                                 <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#" onclick="transdata(\'' . $num["adminname"] . '\',\'' . $num["password"] . '\',\'' . $num["adminid"] . '\')">设置<span class="caret"></span></a>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="../update.php?cid=' . $num['cid'] . '" onclick="return del_comm();"><i class="icon-trash"></i> 删除</a></li>
                                                        </ul>
                                                    </div>
                                                </td>';
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <ul>
                        <?php
                        if (intval($_GET['num']) == 1) {
                            echo "<li><a href=\"comment.php?num=1&size=" . $_GET['size'] . "\">Prev</a></li>";

                        } else {
                            echo "<li><a href=\"comment.php?num=" . (intval($_GET['num']) - 1) . "&size=" . $_GET['size'] . "\">Prev</a></li>";
                        }
                        for ($i = 1; $i <= $ary[1]; $i++) {
                            echo "<li>" . "<a href=\"comment.php?num=$i&size=" . $_GET['size'] . "\">" . $i . "</a></li>";
                        }
                        if (intval($_GET['num']) == $ary[2]) {
                            echo "<li><a href=\"comment.php?num=$ary[2]&size=" . $_GET['size'] . "\">Next</a></li>";

                        } else {
                            echo "<li><a href=\"comment.php?num=" . (intval($_GET['num']) + 1) . "&size=" . $_GET['size'] . "\">Next</a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <footer class="well">
        <a>HackRandom工作室 版权所有©2018-2020 技术支持电话：13099255092</a>
    </footer>

</div>
<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/jquery.flot.js"></script>
<script src="../assets/js/jquery.flot.resize.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script>

    let del_comm = function () {
        return confirm("是否删除该条评论?") ? true : false;
    };
    $(function () {
        var data = [
            {
                label: 'Example',
                data: [[0, 2656], [1, 3565], [2, 1574], [3, 5787], [4, 5451], [5, 8798]]
            }];
        var options = {
            legend: {
                show: true,
                margin: 10,
                backgroundOpacity: 0.5
            },
            lines: {
                show: true
            },
            grid: {
                borderWidth: 1,
                hoverable: true
            },
            xaxis: {
                axisLabel: 'Month',
                ticks: [[0, 'Jan'], [1, 'Feb'], [2, 'Mar'], [3, 'Apr'], [4, 'May'], [5, 'Jun'], [6, 'Jul'], [7, 'Aug'], [8, 'Sep'], [9, 'Oct'], [10, 'Nov'], [11, 'Dec']],
                tickDecimals: 0
            },
            yaxis: {
                tickSize: 3000,
                tickDecimals: 0
            }
        };

        function showTooltip(x, y, contents) {
            $('<div id="tooltip">' + contents + '</div>').css({
                position: 'absolute',
                display: 'none',
                top: y + 5,
                left: x + 5,
                border: '1px solid #D6E9C6',
                padding: '2px',
                'background-color': '#DFF0D8',
                opacity: 0.80
            }).appendTo("body").fadeIn(200);
        }

        var previousPoint = null;
        $("#placeholder").bind("plothover", function (event, pos, item) {
            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;

                    $("#tooltip").remove();
                    showTooltip(item.pageX, item.pageY, item.series.label + ": " + item.datapoint[1]);
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });
        $.plot($("#placeholder"), data, options);
    });
</script>
</body>
</html>
