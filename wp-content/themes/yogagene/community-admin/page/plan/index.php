<?php include( '../../function/function.php'); ?>
<?php include ( WORKSPACE . '/include/header.php' ); ?>
<?php include ( WORKSPACE . '/include/navigation.php' ); ?>
<section class="mypage-section">
    <form class="forms" data-parsley-validate novalidate>
        <div class="page-title">
            <div class="title_left">
                <h1>プラン変更 <small>Plan</small></h1>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="full_col">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>プラン選択 <small>Plan</small></h2>
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
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table class="table-plan">
                                                <tr>
                                                    <td><label><input type="radio" name="plan[]" class="" checked></label></td><td>Free ビジネスアカウント 無料</td>
                                                </tr>
                                                <tr>
                                                    <td><label><input type="radio" name="plan[]" class=""></label></td><td>Premium ビジネスアカウント ￥2980 / 1ヶ月</td>
                                                </tr>
                                                <tr>
                                                    <td><label><input type="radio" name="plan[]" class=""></label></td><td>Plus ビジネスアカウント ￥9800 / 1ヶ月</td>
                                                </tr>
                                            </table>
                                            
                                            
                                            <?php //include( WORKSPACE . '/include/include-plan.php'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- x-content -->
                            </div>
                            <!-- x-panel -->
                        </div>
                        <div class="col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>料金 <small>Payment</small></h2>
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
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table class="price">
                                                <thead>
                                                    <tr>
                                                        <th class="c1">Free フリー<br></th>
                                                        <th class="c2">Premium プレミアム<br></th>
                                                        <th class="c3">Plus プラス<br></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="c1">
                                                            無料
                                                        </td>
                                                        <td class="c2">
                                                            ￥2980 <span>/ 1ヶ月</span>
                                                        </td>
                                                        <td class="c3">
                                                            ￥9800 <span>/ 1ヶ月</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="c1">
                                                            20GB
                                                        </td>
                                                        <td class="c2">
                                                            10GB
                                                        </td>
                                                        <td class="c3">
                                                            2GB
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="c1">
                                                            独自SSL（無制限）
                                                        </td>
                                                        <td class="c2">
                                                            独自SSL（3個）
                                                        </td>
                                                        <td class="c3">
                                                            なし
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
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