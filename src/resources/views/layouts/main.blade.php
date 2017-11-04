<!DOCTYPE html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1"/>
    <meta name="renderer" content="webkit">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <title>{{ config('qla.adminpanel.title') }}</title>

    <link rel="stylesheet" href="{{ asset('vendor/qla/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/qla/css/font-awesome.min.css')}}"/>

    <link rel="stylesheet" href="{{ asset('vendor/qla/css/ace.min.css') }}" class="ace-main-stylesheet"
          id="main-ace-style"/>
    <link rel="stylesheet" href="{{ asset('vendor/qla/css/icomoon.css')}}"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{{ asset('vendor/qla/css/ace-part2.min.css') }}" class=" ace-main-stylesheet"/>
    <![endif]-->
    <link rel="stylesheet" href="{{ asset('vendor/qla/css/ace-skins.min.css') }}"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{{ asset('vendor/qla/css/ace-ie.min.css') }}"/>
    <![endif]-->

    <script src="{{ asset('vendor/qla/js/ace/ace-extra.min.js') }}"></script>

    <!--[if lt IE 8]>
    <script src="{{ asset('vendor/qla/js/respond-1.4.2.min.js') }}"></script>
    <script src="{{ asset('vendor/qla/js/html5shiv-3.7.3.min.js') }}"></script>
    <script src="{{ asset('vendor/qla/js/placeholders-4.0.1.min.js') }}"></script>
    <![endif]-->
    @stack('css')
    <style type="text/css">
        .nav-list > li .submenu > li a > .menu-icon {
            font-size: 18px !important;
        }

        .nav-list > li .submenu > li a > .menu-icon2 {
            display: inline-block !important;
            font-size: 14px;
        }

    </style>

</head>
<body class="no-skin">
<!--[if lte IE 7]>
<div class="browserupgrade">
    <div>
        您还在使用老掉牙的IE，正常使用系统前请升级您的浏览器到 IE8以上版本
        <a target="_blank" href="http://windows.microsoft.com/zh-cn/internet-explorer/ie-8-worldwide-languages">点击升级</a>
        &nbsp;&nbsp;强烈建议您更改换浏览器：
        <a href="http://down.tech.sina.com.cn/content/40975.html" target="_blank">谷歌 Chrome</a></div>
</div>
<![endif]-->
<!-- BEGIN HEADER -->
<div id="navbar" class="navbar navbar-default          ace-save-state">
    @include('adminpanel::partials.top_bar')
</div>
<!-- END HEADER -->
<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.loadState('main-container');
        } catch (e) {
        }
    </script>
    <!-- BEGIN SIDEBAR -->
    <div id="sidebar" class="sidebar responsive ace-save-state">
        <script type="text/javascript">
            try {
                ace.settings.loadState('sidebar');
                ace.settings.check('sidebar', 'fixed');
            } catch (e) {
            }
        </script>

        @include(config('qla.adminpanel.left_side_bar_include_file'))

        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state"
               data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>
    </div>
    <!-- END SIDEBAR -->
    <div class="main-content">
        {{--@include('admin.partials.ace_settings')--}}
        <div class="main-content-inner" id="pageContent">
            <iframe id="iframe" name="mainIframe" style="width:100%;overflow:hidden;" height="100%"
                    scrolling="no"
                    frameborder="0"></iframe>


        </div>
    </div><!-- /.main-content -->

    <div class="footer">
        <div class="footer-inner">
            <div class="footer-content">
						<span class="small">
							<span class="blue bolder">{{ config('adminpanel.footer_copyright') }}</span>
							&copy; 2017
						</span>

                &nbsp; &nbsp;

            </div>
        </div>
    </div>

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>

</div><!-- /.main-container -->

<!-- jquery scripts -->
<!--[if IE]>
<script>
    window.jQuery || document.write('<script src="{{ asset('
    vendor / qla / js / jquery / jquery - 1.12
    .4.min.js
    ') }}"><\/script>'
    )
</script>
<![endif]-->

<script>
    window.jQuery || document.write('<script src="{{ asset('vendor/qla/js/jquery/jquery-2.1.4.min.js') }}"><\/script>')
    if ('ontouchstart' in document.documentElement)
        document.write('<script src="{{ asset('vendor/qla/js/jquery/jquery.mobile.custom.min.js') }}" ><\/script>');
</script>

<!-- lhgdialog scripts -->
<script>$.dialog || document.write('<script src="{{ asset('vendor/qla/js/lhgdialog/lhgdialog.js?skin=discuz') }}"><\/script>')</script>

<!-- cookie scripts -->
<script src="{{ asset('vendor/qla/js/js.cookie-2.1.4.min.js') }}"></script>

<!-- bootstrap scripts -->
<script src="{{ asset('vendor/qla/js/bootstrap/bootstrap.min.js') }}"></script>

<!-- ace scripts -->
<script src="{{ asset('vendor/qla/js/ace/ace-elements.min.js') }}"></script>
<script src="{{ asset('vendor/qla/js/ace/ace.min.js') }}"></script>

@stack('pre_js')
<script type="text/javascript">

    $(document).ready(function () {
        var target;
        if (Cookies.get("nodeId") !== "" && Cookies.get("nodeId") !== null && Cookies.get("nodeId") !== 0) {  //判断是否有节点cookie，如果有，直接显示上次页面
            id = Cookies.get("nodeId");
            target = $("#" + id);
        } else {
            var objArr = $(".nav-list").find("[name='default']");
            if (objArr.length > 0) {
                target = objArr.eq(0);
            } else {
                $(".nav-list a").each(function () {
                    if ($(this).data('url') !== undefined && $(this).data("url") !== "") {
                        target = $(this);
                        return false;
                    }
                });
            }
        }
        setTitleAndPath(target);

        $(document).on(ace.click_event, '.nav-list a', function (event) {
            var e = window.event || event;
            var target = e.srcElement || e.target;
            target = target.tagName === "I" || target.tagName === "SPAN" ? target.parentNode : target;
            setTitleAndPath(target);
        });

        $(window).resize(function () {
            resizeIframe();
        });

    });

    function setTitleAndPath(target) {
        var path = $(target).data("url");
        if (path !== "" && path !== null && path !== undefined) {
            $('#sidebar ul.nav-show').css('display', 'none');
            $('#sidebar ul').children('li').removeClass("active").removeClass("open");
            $(target).parents("li").siblings().removeClass("active");
            $(target).parents("li").siblings().removeClass("open");
            $(target).parents("li").siblings().find(".submenu").hide();
            $(target).parents("li").siblings().find("li").removeClass("active");

            $(target).parent().siblings().removeClass("active");
            $(target).parents("li").addClass("active");

            $(target).parents("li").addClass("open");
            $(target).closest("li").removeClass("open");
            $(target).parents("ul").show();

            $(target).parent().addClass("active");

            Cookies.set("nodeId", $(target).attr("id"));
            setMainContent(path, "");
        }
    }

    function resizeIframe() {
        $("#iframe", document).load(function () {
            var bodyH = $(this).contents().find("body").get(0).scrollHeight,
                htmlH = $(this).contents().find("html").get(0).scrollHeight,
                maxH = Math.max(bodyH, htmlH), minH = Math.min(bodyH, htmlH),
                h = $(this).height() >= maxH ? maxH : minH;
            if (h < 550) h = 550;
            $(this).height(h);
        });
    }

    function setMainContent(path, obj) {
        var document = obj === "" ? document : window.parent.document;

        var $frame = $('#iframe', document);
        if ($frame[0]) {    //如果当前存在iframe,将iframe清除掉，重新添加
            $frame.attr('src', 'about:blank');
            $frame[0].contentWindow.document.write('');
            $frame[0].contentWindow.document.close();
            $frame.remove();
        }
        var iframe = $('<iframe id="iframe" name="mainIframe" style="width:100%;overflow:hidden;" height="100%" scrolling="no" frameborder="0"></iframe>');
        iframe.appendTo($('#pageContent', document));

        resizeIframe();

        iframe.attr("src", path);

    }


</script>
</body>
</html>