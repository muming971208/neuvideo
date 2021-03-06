<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <title>Neu用户登录</title>
    <link href="index.css" rel="stylesheet" type="text/css"/>
</head>

<script>
    function login() {
        let name = document.getElementById("username");
        let password = document.getElementById("password");
        if (name.value.length == 0 && password.value.length == 0) {
            confirm("用户名和密码不能为空");
            name.focus();
            return false;
        }
        return true;
    }

    //判断浏览器是否支持FileReader接口
    if (typeof FileReader == 'undefined') {
        document.getElementById("xmTanDiv").InnerHTML = "<h1>当前浏览器不支持FileReader接口</h1>";
        //使选择控件不可操作
        document.getElementById("xmTanImg").setAttribute("disabled", "disabled");
    }

    //选择图片，马上预览
    function xmTanUploadImg(obj) {
        let file = obj.files[0];
        console.log(obj);
        console.log(file);
        console.log("file.size = " + file.size);  //file.size 单位为byte
        let reader = new FileReader();
        //读取文件过程方法
        reader.onloadstart = function (e) {
            console.log("开始读取....");
        }
        reader.onprogress = function (e) {
            console.log("正在读取中....");
        }
        reader.onabort = function (e) {
            console.log("中断读取....");
        }
        reader.onerror = function (e) {
            console.log("读取异常....");
        }
        reader.onload = function (e) {
            console.log("成功读s取....");
            let img = document.getElementById("xmTanImg");
            img.src = e.target.result;
        }
        reader.readAsDataURL(file)
    }
</script>
<body>

<div class="login_box">
    <div class="login_l_img"><img src="index/login-img.png"/></div>
    <div class="login">
        <div class="login_logo"><a href="#"><img src="index/login_logo.png"/></a></div>
        <div class="login_name">
            <p>使用NeuVideo账号</p>
        </div>
        <form action="doUserlogin.php" method="post" onsubmit="return login()">
            <input name="username" type="text" id="username" placeholder="用户名">
            <input name="password" type="password" id="password" placeholder="密码">
            <input value="登录" name="submit" style="width:100%;" type="submit">
        </form>

        <a href="#" data-toggle="modal" data-target="#myModal">还没有NeuVideo账号？注册一个吧！</a>
        <!--            注册模态框-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Register</h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <label style="vertical-align: inherit;">用 户 名:</label>
                            <input type="text" name="uname" id="uname" placeholder="用户名">
                            <label style="vertical-align: inherit;">密 码:</label>
                            <input type="password" name="password1" id="password1" placeholder="密码">
                            <label style="vertical-align: inherit;">确认密码:</label>
                            <input type="password" name="repassword" id="repassword" placeholder="密码">
                            <label style="vertical-align: inherit;">性 别:</label>
                            <br>
                            <input type="radio" name="gender" value="0" checked>男
                            &nbsp;
                            <input type="radio" name="gender" value="1">女
                            <br>
                            <label style="vertical-align: inherit;">生 日:</label>
                            <br>
                            <input type="date" name="birthdate" id="birthdate">
                            <br>
                            <label>上传头像:</label>
                            <br>
                            <span class="btn btn-success fileinput-button">
                                <span>上传</span>
                                <input type="file" name="pic" id="ipc" onchange="xmTanUploadImg(this);"
                                       accept="image/gif,image/png,image/jpeg">
                            </span>
                            <br>
                            <label style="vertical-align: inherit;">电子邮箱:</label>
                            <input type="email" name="email" id="email" placeholder="电子邮箱">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary" onclick="registerin()">提交更改</button>
                    </div>

                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal -->
        </div>

    </div>
    <div class="copyright">HackRandom工作室 版权所有©2018-2020 技术支持电话：13099255092</div>
</div>

</body>
<style>
    #tooltip {
        float: right;
        width: auto;
        height: 10%;
        display: none;
    }

    .fileinput-button {
        position: relative;
        display: inline-block;
        overflow: hidden;
    }

    .fileinput-button input {
        position: absolute;
        right: 0px;
        top: 0px;
        opacity: 0;
        -ms-filter: 'alpha(opacity=0)';
        font-size: 200px;
    }

    a:link {
        color: #2a62bc;
    }

    a:visited {
        color: #6f42c1;
    }

    a:hover {
        color: #00ff00;
    }

    a:active {
        color: #bd2130;
    }
</style>
<script src="registerin.js"></script>
</html>
