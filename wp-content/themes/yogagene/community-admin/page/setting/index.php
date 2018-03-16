<?php include( '../../function/function.php'); ?>
<?php include ( WORKSPACE . '/include/header.php' ); ?>
<?php include ( WORKSPACE . '/include/navigation.php' ); ?>
<section class="mypage-section">
    <form class="forms" data-parsley-validate novalidate>
        <div class="page-title">
            <div class="title_left">
                <h1>登録情報 <small>Setting</small></h1>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="center_col">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>基本情報 <small>User Edit</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 profile_left">
                                            <div class="profile_img">
                                                <div id="crop-avatar">
                                                    <div id="myAvatar" class="dropzone dz-clickable avatarzone"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                            <div class="form-horizontal form-label-left input_mask">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12 col-xs-12 form-group has-feedback">
                                                        <input type="text" class="form-control has-feedback-left" id="" placeholder="姓">
                                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                        <input type="text" class="form-control" id="" placeholder="名">
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                        <input type="text" class="form-control has-feedback-left" id="" placeholder="メールアドレス">
                                                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <div class="col-md-5 col-sm-5 col-xs-12 form-group">
                                                        <select class="form-control">
                                                            <option>都道府県</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                        <input type="password" class="form-control has-feedback-left" id="" placeholder="変更前のパスワード">
                                                        <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                        <input type="password" class="form-control has-feedback-left" id="" placeholder="新しいパスワード">
                                                        <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- x-content -->
                            </div>
                            <!-- x-panel -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- col-center -->
            <div class="col-footer">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="ln_solid"></div>
                    <div class="form-group text-center">
                        <div class="col-md-2 col-sm-3 col-xs-6 col-md-offset-5">
                            <button type="submit" class="btn btn-success btn-block">更新</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- col-footer -->
        </div>
    </form>
</section>
<?php include ( WORKSPACE . '/include/footer.php' ); ?>