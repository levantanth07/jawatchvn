<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a target="_blank" href="https://jawatchvn.com/" class="site_title"><i class="fa fa-paw"></i> <span>Jawatchvn</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ asset('layout') }}/production/images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>@auth() {{ Auth::user()->name }} @endauth</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a target="_blank" href="https://jawatchvn.com/">Xem website</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-folder"></i> Danh mục <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('backend.category.index') }}">Danh sách</a></li>
                            <li><a href="{{ route('backend.category.create') }}">Thêm mới</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-rocket"></i> Chiến dịch <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('backend.campaign.index') }}">Danh sách</a></li>
                            <li><a href="{{ route('backend.campaign.create') }}">Thêm mới</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-product-hunt"></i> Sản phẩm <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('backend.product.index') }}">Danh sách</a></li>
                            <li><a href="{{ route('backend.product.create') }}">Thêm mới</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-pencil"></i> Bài viết <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('backend.post.index') }}">Danh sách</a></li>
                            <li><a href="{{ route('backend.post.create') }}">Thêm mới</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-pencil"></i>Phản hồi <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('backend.feedback.index') }}">Danh sách</a></li>
                            <li><a href="{{ route('backend.feedback.create') }}">Thêm mới</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-pencil"></i>Khuyến mãi <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('backend.promotion.index') }}">Danh sách</a></li>
                            <li><a href="{{ route('backend.promotion.create') }}">Thêm mới</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-pencil"></i>Cấu hình <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('backend.config.index') }}">Danh sách</a></li>
                            <li><a href="{{ route('backend.config.create') }}">Thêm mới</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-user"></i> Khách hàng <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('backend.customer.index') }}">Danh sách</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-first-order"></i> Danh sách đơn hàng <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('backend.order.index') }}">Danh sách đơn hàng</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
