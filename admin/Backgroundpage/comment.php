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
	<!--[if lte IE 8]><script src="js/excanvas.min.js"></script><![endif]-->
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
          <a class="brand" href="#">Neu视频后台管理系统</a>
          <div class="btn-group pull-right">
			<a class="btn" href="my-profile.php"><i class="icon-user"></i> Admin</a>
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
			  <li><a href="my-profile.php">Profile</a></li>
              <li class="divider"></li>
              <li><a href="#">登出</a></li>
            </ul>
          </div>
          <div class="nav-collapse">
            <ul class="nav">
			<li><a href="welcome.php">Home</a></li>
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="new-user.php">New User</a></li>
					<li class="divider"></li>
					<li><a href="users.php">Manage Users</a></li>
				</ul>
			  </li>
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Roles <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="new-role.php">New Role</a></li>
					<li class="divider"></li>
					<li><a href="roles.php">Manage Roles</a></li>
				</ul>
			  </li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">视频<b
                                class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="new-video.php">添加视频</a></li>
                        <li class="divider"></li>
                        <li><a href="video.php">视频管理</a></li>
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
              <li class="nav-header"><i class="icon-wrench"></i> Administration</li>
              <li><a href="users.php">Users</a></li>
              <li><a href="roles.php">Roles</a></li>
              <li class="nav-header"><i class="icon-signal"></i> Statistics</li>
              <li><a href="video.php">General</a></li>
              <li class="active"><a href="comment.php">User</a></li>
              <li><a href="visitor-stats.html">Visitor</a></li>
              <li class="nav-header"><i class="icon-user"></i> Profile</li>
              <li><a href="my-profile.php">My profile</a></li>
              <li><a href="#">Settings</a></li>
			  <li><a href="#">Logout</a></li> 
            </ul>
          </div>
        </div>
        <div class="span9">
		  <div class="row-fluid">
			<div class="page-header">
				<h1>Users Stats <small>User statistics...</small></h1>
			</div>
			<div id="placeholder" style="width:80%;height:300px;"></div>
		  </div>
        </div>
      </div>

      <hr>

      <footer class="well">
        &copy; Strass - More Templates <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a>
      </footer>

    </div>

    <script src="../assets/js/jquery.js"></script>
	<script src="../assets/js/jquery.flot.js"></script>
	<script src="../assets/js/jquery.flot.resize.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<script>
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
				borderWidth:1,
				hoverable: true
			},
			xaxis: {
				axisLabel: 'Month',
				ticks: [[0, 'Jan'], [1, 'Feb'], [2, 'Mar'], [3, 'Apr'], [4, 'May'], [5, 'Jun'], [6, 'Jul'], [7, 'Aug'], [8, 'Sep'], [9, 'Oct'], [10, 'Nov'], [11, 'Dec']],
				tickDecimals: 0
			},
			yaxis: {
				tickSize:3000,
				tickDecimals: 0
			}
		};
		function showTooltip(x, y, contents) {
			$('<div id="tooltip">' + contents + '</div>').css( {
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
		$.plot( $("#placeholder") , data, options );
	});
	</script>
  </body>
</html>
