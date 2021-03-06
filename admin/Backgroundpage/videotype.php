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
    <script src="js/excanvas.min.js"></script><![endif]-->
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
                    <li><a href="my-profile.php">我的信息</a></li>
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
                            <li class="divider"></li>
                            <li><a href="users.php">用户管理</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">管理员<b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="new-role.php">添加管理员</a></li>
                            <li class="divider"></li>
                            <li><a href="roles.php">管理员管理</a></li>
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
                    <h1>视频类型
                        <small>视频类型管理</small>

                    </h1>
                </div>
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
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
                    $ary = getVideotypeDate($_GET['num'], $_GET['size']);

                    while ($num = mysqli_fetch_assoc($ary[0])) {
                        echo '<tr class="list-roles">';
                        echo "<td >" . $num['tid'] . "</td >";
                        echo "<td id='" . "typename_" . $num['tid'] . "'>" . $num['typename'] . "</td >";
                        echo '<td>
                               <div class="btn-group">
                                                 <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#" onclick="trandata(\'' . $num["tid"] . '\',\'' . $num["typename"] . '\');">设置<span class="caret"></span></a>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#" data-toggle="modal" data-target="#myModal"><i class="icon-pencil"></i>编辑</a></li>
                                                            <li><a href="../update.php?tid=' . $num['tid'] . '" onclick="return del_videotype();"><i class="icon-trash"></i> 删除</a></li>
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
                            echo "<li><a href=\"videotype.php?num=1&size=" . $_GET['size'] . "\">Prev</a></li>";

                        } else {
                            echo "<li><a href=\"videotype.php?num=" . (intval($_GET['num']) - 1) . "&size=" . $_GET['size'] . "\">Prev</a></li>";
                        }
                        for ($i = 1; $i <= $ary[1]; $i++) {
                            echo "<li>" . "<a href=\"videotype.php?num=$i&size=" . $_GET['size'] . "\">" . $i . "</a></li>";
                        }
                        if (intval($_GET['num']) == $ary[2]) {
                            echo "<li><a href=\"videotype.php?num=$ary[2]&size=" . $_GET['size'] . "\">Next</a></li>";

                        } else {
                            echo "<li><a href=\"videotype.php?num=" . (intval($_GET['num']) + 1) . "&size=" . $_GET['size'] . "\">Next</a></li>";
                        }
                        ?>
                    </ul>

                </div>
                <input type="text" id="video_type">
                <a class="btn btn-success" onclick="add_videotype()">添加视频类型</a>
                <br>
                <br>
                <hr>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">视频类型信息</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <label style="vertical-align: inherit;">视频类型：</label>
                        <input type="hidden" name="tid" id="tid">
                        <input type="text" name="videotype" id="videotype">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" onclick="modify_submit()">提交更改</button>
                </div>

                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
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

    let del_videotype = function () {
        return confirm("是否删除该视频类型?") ? true : false;
    };

    function add_videotype() {

        let video_type = $("#video_type").val();
        if (video_type == "") {
            alert("您未输入视频类型");
            return;
        }
        $.ajax({
            url: "process.php",
            data: {"video_type": video_type},
            type: 'post',
            dataType: 'text',
            success: function (result) {
                if (result == "success") {
                    alert("添加视频类型成功");
                    self.location.reload(true);
                }
                else if (result == "repeat") {
                    alert("您添加的类型名称和之前的相同，请修改当前名称");
                    $("#video_type").focus();
                }
            },
            error: function (result) {
                alert("添加视频类型失败");
                self.history.go(-1);
            }
        })

    };

    let trandata = function (tid, typename) {
        $("#tid").val(tid);
        $("#videotype").val(typename);

    };
    var modify_submit = function () {

        let tid = $("#tid").val();
        let typename = $("#videotype").val();

        $.ajax({
            url: "process.php",
            type: "post",
            data: {"tid": tid, "typename": typename},
            dataType: 'text',
            success: function (result) {
                $("#myModal").modal('hide');
                if (result == "success") {
                    alert("您已经修改成功");
                    location.reload(true);
                }
            },
            error: function (data) {
                console.log(data);
            }
        })

    };


    $(function () {
        var data = [
            {
                label: 'Page Views',
                data: [[0, 19000], [1, 15500], [2, 11100], [3, 15500]]
            }];
        var dataVisits = [
            {
                label: 'Visits',
                data: [[0, 1980], [1, 1198], [2, 830], [3, 1550]]
            }];
        var options = {
            legend: {
                show: true,
                margin: 10,
                backgroundOpacity: 0.5
            },
            points: {
                show: true,
                radius: 3
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
                tickSize: 1000,
                tickDecimals: 0
            }
        };
        var optionsVisits = {
            legend: {
                show: true,
                margin: 10,
                backgroundOpacity: 0.5
            },
            bars: {
                show: true,
                barWidth: 0.5,
                align: 'center'
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
                tickSize: 1000,
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
        $("#placeholder, #visits").bind("plothover", function (event, pos, item) {
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
        $.plot($("#visits"), dataVisits, optionsVisits);
    });
</script>
</body>
</html>
