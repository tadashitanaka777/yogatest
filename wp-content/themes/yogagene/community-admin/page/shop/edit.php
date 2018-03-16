<?php include( '../../function/function.php'); ?>
<?php include ( WORKSPACE . '/include/header.php' ); ?>
<?php include ( WORKSPACE . '/include/navigation.php' ); ?>
<section class="mypage-section">
    <form class="forms" data-parsley-validate novalidate>
        <div class="page-title">
            <div class="title_left">
                <h1>ショップ <small>Shop</small></h1>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="left-col">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>基本情報 <small>Basic Edit</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                        </li>
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
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                        <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="ショップ名">
                                                        <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                        <input type="text" class="form-control has-feedback-left" id="inputSuccess3" placeholder="WebSite or Blog">
                                                        <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                        <input type="text" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Facebook URL">
                                                        <span class="fa fa-facebook form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                        <input type="text" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Twitter URL">
                                                        <span class="fa fa-twitter form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                        <input type="text" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Instagram URL">
                                                        <span class="fa fa-instagram form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                        <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="お問い合わせ先">
                                                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <h4>ショップロゴ</h4>
                                            <div class="logo_img">
                                                <div id="crop-pose">
                                                    <div id="myLogo" class="dropzone dz-clickable"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                            <h4>ショップイメージ</h4>
                                            <div class="pose_img">
                                                <div id="crop-pose">
                                                    <div id="myPose" class="dropzone dz-clickable"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <h4>店舗情報</h4>
                                            <div class="form-horizontal form-label-left">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">電話番号</label>
                                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                                            <input type="text" class="form-control" placeholder="03-1234-5678">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">クレジットカード</label>
                                                        <div class="cc-content col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                                            <div class="row">
                                                                <div class="col col-md-6">
                                                                    <div class="md-checkbox">
                                                                        <input id="cc-visa" type="checkbox" value="cc-visa">
                                                                        <label for="cc-visa"></label>
                                                                        <span class="cc-name">
                                                                            <i class="fa fa-2x fa-cc-visa"></i>VISA
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col col-md-6">
                                                                    <div class="md-checkbox">
                                                                        <input id="cc-mastercard" type="checkbox" value="cc-mastercard">
                                                                        <label for="cc-mastercard"></label>
                                                                        <span class="cc-name">
                                                                            <i class="fa fa-2x fa-cc-mastercard"></i>マスターカード
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col col-md-6">
                                                                    <div class="md-checkbox">
                                                                        <input id="cc-jcb" type="checkbox" value="cc-jcb">
                                                                        <label for="cc-jcb"></label>
                                                                        <span class="cc-name">
                                                                            <i class="fa fa-2x fa-cc-jcb"></i>JCB
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col col-md-6">
                                                                    <div class="md-checkbox">
                                                                        <input id="cc-diners-club" type="checkbox" value="cc-diners-club">
                                                                        <label for="cc-diners-club"></label>
                                                                        <span class="cc-name">
                                                                            <i class="fa fa-2x fa-cc-diners-club"></i>ダイナースクラブ
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col col-md-6">
                                                                    <div class="md-checkbox">
                                                                        <input id="cc-amex" type="checkbox" value="cc-amex">
                                                                        <label for="cc-amex"></label>
                                                                        <span class="cc-name">
                                                                            <i class="fa fa-2x fa-cc-amex"></i>アメリカン・エキスプレス
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">営業時間</label>
                                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12 table-add-row clock-add">
                                                            <table class="table table-striped table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="td-clock-week">
                                                                            <div class="row">
                                                                                <div class="col-lg-4 col-md-2 col-sm-2 col-xs-12">
                                                                                    <select class="form-control">
                                                                                        <?php echo $cdClass->weekSelect(); ?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-6">
                                                                                    <input type="text" class="form-control timepicker" placeholder="OPEN">
                                                                                </div>
                                                                                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-6">
                                                                                    <input type="text" class="form-control timepicker" placeholder="CLOSE">
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="td-button">
                                                                            <button class="btn btn-default btn-circle btn-remove-row">－</button>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="tr-add-row">
                                                                        <td class="td-clock-week">
                                                                            <div class="row">
                                                                                <div class="col-lg-4 col-md-2 col-sm-2 col-xs-12">
                                                                                    <select class="form-control">
                                                                                        <?php echo $cdClass->weekSelect(); ?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-6">
                                                                                    <input type="text" class="form-control" placeholder="OPEN">
                                                                                </div>
                                                                                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-6">
                                                                                    <input type="text" class="form-control" placeholder="CLOSE">
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="td-button">
                                                                            <button class="btn btn-default btn-circle btn-remove-row">－</button>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <script>
                                            <!--
                                              $(function(){
                                                var tr;
                                                var element = $('.clock-add');
                                                element.find('.btn-add-row').on('click',function(){
                                                  tr = element.find('.tr-add-row').clone(true);
                                                  $(this).closest('.table-add-row').find('tbody .tr-add-row').before(tr);
                                                  tr.fadeIn(500).removeClass('tr-add-row');
                                                  _texrareaAutoHeight();
                                                  _checkRowNumber(element,7);
                                                  tr.find('input[type="text"]').addClass('timepicker');
                                                  $('.timepicker').clockpicker({donetext:'OK'});
                                                  return false;
                                                });
                                                element.find('.btn-plug-row').on('click',function(){
                                                  tr = element.find('.tr-add-row').clone(true);
                                                  $(this).closest('tr').before(tr);
                                                  tr.fadeIn(500).removeClass('tr-add-row');
                                                  _texrareaAutoHeight();
                                                  _checkRowNumber(element,7);
                                                  return false;
                                                });
                                                element.find('.btn-remove-row').on('click',function(){
                                                  tr = $(this).closest('tr');
                                                  tr.fadeOut(500,function(){
                                                    tr.remove();
                                                    _checkRowNumber(element,7);
                                                  });
                                                  return false;
                                                });
                                              });
                                            -->
                                          </script>
                                                            <button class="btn btn-default btn-add-row">営業時間を追加</button>
                                                        </div>
                                                    </div>
                                                    
                                                      <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">定休日</label>
                                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                                          <input type="text" class="form-control" placeholder="日曜日、祝日">
                                                        </div>
                                                      </div>
                                                    
                                                    
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">紹介文</label>
                                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                                            <textarea id="message" required="required" class="form-control resize-vertical mb-pc-20" name="message" rows="10" placeholder="ショップの紹介文をご記入ください。" data-parsley-trigger="keyup" data-parsley-maxlength="400" data-parsley-maxlength-message="プロフィールが長すぎます。（400文字）" data-parsley-validation-threshold="10"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">ヒトコト</label>
                                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                                            <textarea id="message" required="required" class="form-control resize-vertical mb-pc-20" name="message" rows="10" placeholder="ショップからヒトコトをご記入ください。" data-parsley-trigger="keyup" data-parsley-maxlength="400" data-parsley-maxlength-message="プロフィールが長すぎます。（400文字）" data-parsley-validation-threshold="10"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>所在地 <small>Address</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <h4>地図情報</h4>
                                            <div class="form-horizontal form-label-left">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">郵便番号</label>
                                                        <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">〒</span>
                                                                <input type="text" class="form-control zip" placeholder="100-0001">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">都道府県</label>
                                                        <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
                                                            <select class="form-control" name="pref">
                                                                <?php echo $cdClass->prefSelect(13); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">市区町村</label>
                                                        <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
                                                            <select class="form-control city-select" name="city">
                                                                <?php foreach($dataClass->getCity(13) as $cityKey => $cityVal) : ?>
                                                                <option value="<1f7141b016a3c547b01dd931698778e0 />">
                                                                    <?php echo $cityVal[1]; ?>
                                                                </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <input name="dummy-city" type="hidden" value="千代田区">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">住所</label>
                                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                                            <input type="text" class="form-control" name="address" placeholder="目黒区祐天寺2-9-4" onKeyUp="latlonSearch(this);">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">建物名</label>
                                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                                            <input type="text" class="form-control" placeholder="虎ノ門ビル 2F">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">緯度・経度</label>
                                                        <div class="col-lg-4 col-md-5 col-sm-5 col-xs-6">
                                                            <input type="text" id="gpsearch-lat-input" class="form-control" placeholder="緯度">
                                                        </div>
                                                        <div class="col-lg-4 col-md-5 col-sm-5 col-xs-6">
                                                            <input type="text" id="gpsearch-lon-input" class="form-control" placeholder="経度">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">地図</label>
                                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                                            <div class="gpsearch">
                                                                <div id="gpsearch-map"></div>
                                                                <div class="gpsearch-marker"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $scClass->getGpsscript(); ?>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">最寄り駅</label>
                                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12 table-add-row station-add">
                                                            <table class="table table-striped table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="td-clock-week">
                                                                            <div class="row">
                                                                                <div class="col-md-4 col-sm-4 col-xs-12 mb-sp-10">
                                                                                    <select name="line[]" class="form-control line-select">
                                                                                        <option>都道府県を選択してください</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-md-4 col-sm-4 col-xs-7">
                                                                                    <select name="station[]" class="form-control station-select">
                                                                                        <option>路線を選択してください</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-5">
                                                                                    <?php echo $dataClass->getFoot(); ?>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="td-button">
                                                                            <button class="btn btn-default btn-circle btn-remove-row">－</button>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="tr-add-row">
                                                                        <td class="td-clock-week">
                                                                            <div class="row">
                                                                                <div class="col-md-4 col-sm-4 col-xs-12 mb-sp-10">
                                                                                    <select name="line[]" class="form-control line-select">
                                                                                        <option>都道府県を選択してください</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-md-4 col-sm-4 col-xs-7">
                                                                                    <select name="station[]" class="form-control station-select">
                                                                                        <option>路線を選択してください</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-5">
                                                                                    <?php echo $dataClass->getFoot(); ?>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="td-button">
                                                                            <button class="btn btn-default btn-circle btn-remove-row">－</button>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <script>
                                            <!--
                                              var _pref = <?php print json_encode($dataClass->getPrefline()); ?>;
                                              var _city = <?php print json_encode($dataClass->getCity()); ?>;
                                              var _line = <?php print json_encode($dataClass->getLine()); ?>;
                                              var _station = <?php print json_encode($dataClass->getStation()); ?>;
                                              var c_select;
                                              var s_select;
                                              var l_select;
                                              $(function(){
                                                lineChange($('select[name="pref"]'),13);
                                                $('select[name="pref"]').change(function(){
                                                  var pref = $(this).val();
                                                  cityChange($(this),pref);
                                                  lineChange($(this),pref);
                                                });
                                                $('select[name="line[]"]').change(function(){
                                                  var pref = $('select[name="pref"]').val();
                                                  var line = $(this).val();
                                                  stationChange($(this),pref,line);
                                                });
                                              });
                                            -->
                                          </script>
                                                            <script>
                                            <!--
                                              $(function(){
                                                var tr;
                                                var element = $('.station-add');
                                                element.find('.btn-add-row').on('click',function(){
                                                  tr = element.find('.tr-add-row').clone(true);
                                                  $(this).closest('.table-add-row').find('tbody .tr-add-row').before(tr);
                                                  tr.fadeIn(500).removeClass('tr-add-row');
                                                  _texrareaAutoHeight();
                                                  _checkRowNumber(element,5);
                                                  tr.find('input[type="text"]').addClass('timepicker');
                                                  $('.timepicker').clockpicker({donetext:'OK'});
                                                  return false;
                                                });
                                                element.find('.btn-plug-row').on('click',function(){
                                                  tr = element.find('.tr-add-row').clone(true);
                                                  $(this).closest('tr').before(tr);
                                                  tr.fadeIn(500).removeClass('tr-add-row');
                                                  _texrareaAutoHeight();
                                                  _checkRowNumber(element,5);
                                                  return false;
                                                });
                                                element.find('.btn-remove-row').on('click',function(){
                                                  tr = $(this).closest('tr');
                                                  tr.fadeOut(500,function(){
                                                    tr.remove();
                                                    _checkRowNumber(element,5);
                                                  });
                                                  return false;
                                                });
                                              });
                                            -->
                                          </script>
                                                            <button class="btn btn-default btn-add-row">最寄り駅を追加</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- col-left -->
            <div class="col-right">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>お知らせ <small>News</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-add-row news-add">
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td class="td-news">
                                                            <div class="mb-pc-10">
                                                                <input type="text" class="form-control" placeholder="タイトル">
                                                            </div>
                                                            <textarea class="form-control resize-vertical" placeholder="お知らせの内容を記入"></textarea>
                                                        </td>
                                                        <td class="td-button">
                                                            <button class="btn btn-default btn-circle btn-remove-row">－</button>
                                                        </td>
                                                    </tr>
                                                    <tr class="tr-add-row">
                                                        <td class="td-news">
                                                            <div class="mb-pc-10">
                                                                <input type="text" class="form-control" placeholder="タイトル">
                                                            </div>
                                                            <textarea class="form-control resize-vertical" placeholder="お知らせの内容を記入"></textarea>
                                                        </td>
                                                        <td class="td-button">
                                                            <button class="btn btn-default btn-circle btn-plug-row">＋</button>
                                                            <button class="btn btn-default btn-circle btn-remove-row">－</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <script>
                                    <!--
                                      $(function(){
                                        var tr;
                                        var element = $('.news-add');
                                        element.find('.btn-add-row').on('click',function(){
                                          tr = element.find('.tr-add-row').clone(true);
                                          $(this).closest('.table-add-row').find('tbody .tr-add-row').before(tr);
                                          tr.fadeIn(500).removeClass('tr-add-row');
                                          _texrareaAutoHeight();
                                          _checkRowNumber(element,5);
                                          return false;
                                        });
                                        element.find('.btn-plug-row').on('click',function(){
                                          tr = element.find('.tr-add-row').clone(true);
                                          $(this).closest('tr').before(tr);
                                          tr.fadeIn(500).removeClass('tr-add-row');
                                          _texrareaAutoHeight();
                                          _checkRowNumber(element,5);
                                          return false;
                                        });
                                        element.find('.btn-remove-row').on('click',function(){
                                          tr = $(this).closest('tr');
                                          tr.fadeOut(500,function(){
                                            tr.remove();
                                            _checkRowNumber(element,5);
                                          });
                                          return false;
                                        });
                                      });
                                    -->
                                  </script>
                                            <button class="btn btn-default btn-add-row">お知らせを追加</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /x-content -->
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>新着アイテム <small>Item</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-add-row item-add">
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td class="td-item-image">
                                                            <div class="item_img">
                                                                <div id="crop-avatar" class="crop-avatar">
                                                                    <div id="myItem" class="myItem dropzone dz-clickable avatarzone"></div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="td-item">
                                                            <div class="mb-pc-10">
                                                                <input type="text" class="form-control" placeholder="商品名">
                                                            </div>
                                                            <textarea class="form-control resize-vertical" placeholder="商品内容を記入"></textarea>
                                                        </td>
                                                        <td class="td-button">
                                                            <button class="btn btn-default btn-circle btn-remove-row">－</button>
                                                        </td>
                                                    </tr>
                                                    <tr class="tr-add-row">
                                                        <td class="td-item-image">
                                                            <div class="item_img">
                                                                <div id="crop-avatar" class="crop-avatar">
                                                                    <div id="" class="myItem dropzone dz-clickable avatarzone"></div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="td-item">
                                                            <div class="mb-pc-10">
                                                                <input type="text" class="form-control" placeholder="商品名">
                                                            </div>
                                                            <textarea class="form-control resize-vertical" placeholder="商品内容を記入"></textarea>
                                                        </td>
                                                        <td class="td-button">
                                                            <button class="btn btn-default btn-circle btn-plug-row">＋</button>
                                                            <button class="btn btn-default btn-circle btn-remove-row">－</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <script>
                                    <!--
                                      $(function(){
                                        var tr;
                                        var element = $('.item-add');
                                        element.find('.btn-add-row').on('click',function(){
                                          var date = new Date();
                                          var id = date.getTime();
                                          tr = element.find('.tr-add-row').clone(true);
                                          $(this).closest('.table-add-row').find('tbody .tr-add-row').before(tr);
                                          tr.fadeIn(500).removeClass('tr-add-row');
                                          _texrareaAutoHeight();
                                          _checkRowNumber(element,5);
                                          tr.find('.myItem').attr('id','myItem-' + id);
                                          _addDropzone(id);
                                          return false;
                                        });
                                        element.find('.btn-plug-row').on('click',function(){
                                          var date = new Date();
                                          var id = date.getTime();
                                          tr = element.find('.tr-add-row').clone(true);
                                          $(this).closest('tr').before(tr);
                                          tr.fadeIn(500).removeClass('tr-add-row');
                                          _texrareaAutoHeight();
                                          _checkRowNumber(element,5);
                                          tr.find('.myItem').attr('id','myItem-' + id);
                                          _addDropzone(id);
                                          return false;
                                        });
                                        element.find('.btn-remove-row').on('click',function(){
                                          tr = $(this).closest('tr');
                                          tr.fadeOut(500,function(){
                                            tr.remove();
                                            _checkRowNumber(element,5);
                                          });
                                          return false;
                                        });
                                      });
                                    -->
                                  </script>
                                            <button class="btn btn-default btn-add-row">アイテムを追加</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /x-content -->
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>開催イベント <small>Event</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4>開催イベント</h4>
                                            <div id="event-list" class="list-js">
                                                <ul class="list list-group">
                                                    <li>
                                                        <time class="event-date">2017年10月09日（月）</time>
                                                        <span class="event-name">dusk</span>
                                                        <span class="event-pref-name">東京都</span>
                                                        <select class="form-control case">
                                                            <?php foreach($dataClass->getValues(3) as $key => $value) : ?>
                                                            <option value="<a22f369f8cfafc3da6305e2163240887 />">
                                                                <?php echo $value; ?>
                                                            </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <input type="hidden" class="data-id" value="01">
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bd-event-modal-lg">イベント追加</button>
                                                </div>
                                                <?php include( WORKSPACE . '/include/modal-event.php'); ?>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <h4>登録イベントがない場合</h4>
                                                    <textarea id="event-free" class="form-control resize-vertical mb-pc-20" name="event-free" rows="10" placeholder="イベントの登録がない場合などにご記入ください" data-parsley-trigger="keyup" data-parsley-maxlength="400" data-parsley-maxlength-message="プロフィールが長すぎます。（400文字）" data-parsley-validation-threshold="10"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /x-content -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- col-right -->
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
            </div>
            <!-- col-footer -->
        </div>
    </form>
</section>
<?php include ( WORKSPACE . '/include/footer.php' ); ?>