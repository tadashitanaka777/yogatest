<?php include( '../../function/function.php'); ?>
<?php include ( WORKSPACE . '/include/header.php' ); ?>
<?php include ( WORKSPACE . '/include/navigation.php' ); ?>
<section class="mypage-section">
    <form class="forms" data-parsley-validate novalidate>
        <div class="page-title">
          <div class="title_left">
            <h1>新規登録 <small>Sign Up</small></h1>
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="left-col">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="x_panel">
                        <div class="x_title">
                            <h2>登録内容 <small>Register</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
      
                        <div class="x_content">
                            <div id="wizard" class="form_wizard wizard_horizontal">
                                <?php include ( WORKSPACE . '/include/wizard.php' ); ?>
                                <div class="step">
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">First Name 
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-6 col-xs-12">
                                                <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Last Name 
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Middle Name / Initial</label>
                                            <div class="col-md-8 col-sm-6 col-xs-12">
                                                <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="middle-name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-3 col-xs-12">Gender</label>
                                            <div class="col-md-8 col-sm-6 col-xs-12">
                                                <div id="gender" class="btn-group" data-toggle="buttons">
                                                    <label class="btn btn-default active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                        <input type="radio" name="gender" value="male">&nbsp; Male &nbsp; 
                                                    </label>
                                                    <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                        <input type="radio" name="gender" value="female">Female 
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-3 col-xs-12">Date Of Birth 
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-6 col-xs-12">
                                                <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="actionBar">
                                    <div class="msgBox">
                                        <div class="content"></div>
                                        <a href="#" class="close">X</a>
                                    </div>
                                    <div class="loader">Loading</div>
                                    <a href="#" class="buttonFinish btn btn-default">Finish</a>
                                    <a href="#" class="buttonNext btn btn-success">Next</a>
                                    <a href="#" class="buttonPrevious btn btn-primary buttonDisabled">Previous</a>
                                </div>
                            </div>
                        </div><!-- x-content -->

                    </div><!-- x-panel -->
                </div>

            </div><!-- col-right -->

            <div class="col-footer">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="ln_solid"></div>
                    <div class="form-group text-center">
                        <div class="col-md-2 col-md-offset-4 col-sm-3 col-sm-offset-3 col-xs-6">
                            <select class="form-control">
                                <option>公開</option>
                                <option>非公開</option>
                                <option>削除</option>
                            </select>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-6">
                            <button type="submit" class="btn btn-success btn-block">実行</button>
                        </div>
                    </div>
                </div>
            </div><!-- col-footer -->

        </div>
    </form>
</section>
<?php include ( WORKSPACE . '/include/footer.php' ); ?>