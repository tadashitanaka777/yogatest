<?php include( '../../function/function.php'); ?>
<?php include ( WORKSPACE . '/include/header.php' ); ?>
<?php include ( WORKSPACE . '/include/navigation.php' ); ?>
<section class="mypage-section">

          <form class="forms" data-parsley-validate novalidate>

            <div class="page-title">
              <div class="title_left">
                <h1>スタジオ <small>Studio</small></h1>
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
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
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
                                    <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="スタジオ名">
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
                              <h4>ロゴ</h4>
                              <div class="logo_img">
                                <div id="crop-pose">
                                  <div id="myLogo" class="dropzone dz-clickable"></div>
                                </div>
                              </div>
                            </div>
      
                            <div class="col-md-8 col-sm-12 col-xs-12">
                              <h4>スタジオイメージ</h4>
                              <div class="pose_img">
                                <div id="crop-pose">
                                  <div id="myPose" class="dropzone dz-clickable"></div>
                                </div>
                              </div>
                            </div>
      
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
                                    <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">入会金</label>
                                    <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                      <input type="text" class="form-control" placeholder="5000円">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">基本料金</label>
                                    <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                      <textarea id="message" required="required" class="form-control resize-vertical mb-pc-20" name="message" rows="10" placeholder="1Class / 3800円" data-parsley-trigger="keyup" data-parsley-maxlength="400" data-parsley-maxlength-message="プロフィールが長すぎます。（400文字）" data-parsley-validation-threshold="10"></textarea>
                                    </div>
                                  </div>
                                  <div class="form-group card-box">
                                    <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">クレジットカード</label>
                                    <div class="cc-content col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                      <div class="row">
                                        <div class="col col-md-6">
                                          <div class="md-checkbox">
                                            <input id="cc-visa" type="checkbox" value="cc-visa"><label for="cc-visa"></label>
                                            <span class="cc-name"><i class="fa fa-2x fa-cc-visa"></i> VISA</span>
                                          </div>
                                        </div>
                                        <div class="col col-md-6">
                                          <div class="md-checkbox">
                                            <input id="cc-mastercard" type="checkbox" value="cc-mastercard"><label for="cc-mastercard"></label>
                                            <span class="cc-name"><i class="fa fa-2x fa-cc-mastercard"></i> マスターカード</span>
                                          </div>
                                        </div>
                                        <div class="col col-md-6">
                                          <div class="md-checkbox">
                                            <input id="cc-jcb" type="checkbox" value="cc-jcb"><label for="cc-jcb"></label>
                                            <span class="cc-name"><i class="fa fa-2x fa-cc-jcb"></i> JCB</span>
                                          </div>
                                        </div>
                                        <div class="col col-md-6">
                                          <div class="md-checkbox">
                                            <input id="cc-diners-club" type="checkbox" value="cc-diners-club"><label for="cc-diners-club"></label>
                                            <span class="cc-name"><i class="fa fa-2x fa-cc-diners-club"></i> ダイナースクラブ</span>
                                          </div>
                                        </div>
                                        <div class="col col-md-6">
                                          <div class="md-checkbox">
                                            <input id="cc-amex" type="checkbox" value="cc-amex"><label for="cc-amex"></label>
                                            <span class="cc-name"><i class="fa fa-2x fa-cc-amex"></i> アメリカン・エキスプレス</span>
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
                                  
                                  <div class="form-group option-box">
                                    <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">条件検索</label>
                                    <div class="cc-content col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                      <div class="row">
                                        <div class="col col-md-6">
                                          <div class="md-checkbox">
                                            <input id="option-01" type="checkbox" value="option-01"><label for="option-01"></label>
                                            <span class="option-name">初心者割引</span>
                                          </div>
                                        </div>
                                        <div class="col col-md-6">
                                          <div class="md-checkbox">
                                            <input id="option-02" type="checkbox" value="option-02"><label for="option-02"></label>
                                            <span class="option-name">レンタルスタジオ</span>
                                          </div>
                                        </div>
                                        <div class="col col-md-6">
                                          <div class="md-checkbox">
                                            <input id="option-03" type="checkbox" value="option-03"><label for="option-03"></label>
                                            <span class="option-name">ヨガマットレンタル</span>
                                          </div>
                                        </div>
                                        <div class="col col-md-6">
                                          <div class="md-checkbox">
                                            <input id="option-04" type="checkbox" value="option-04"><label for="option-04"></label>
                                            <span class="option-name">女性限定クラス</span>
                                          </div>
                                        </div>
                                        <div class="col col-md-6">
                                          <div class="md-checkbox">
                                            <input id="option-05" type="checkbox" value="option-05"><label for="option-05"></label>
                                            <span class="option-name">シャワールーム</span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">レンタルスタジオ</label>
                                    <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                      <textarea id="message" required="required" class="form-control resize-vertical mb-pc-20" name="message" rows="10" placeholder="レンタルスタジオの詳細をご記入ください。" data-parsley-trigger="keyup" data-parsley-maxlength="400" data-parsley-maxlength-message="プロフィールが長すぎます。（400文字）" data-parsley-validation-threshold="10"></textarea>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">紹介文</label>
                                    <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                      <textarea id="message" required="required" class="form-control resize-vertical mb-pc-20" name="message" rows="10" placeholder="スタジオの紹介文をご記入ください。" data-parsley-trigger="keyup" data-parsley-maxlength="400" data-parsley-maxlength-message="プロフィールが長すぎます。（400文字）" data-parsley-validation-threshold="10"></textarea>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">ヒトコト</label>
                                    <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                      <textarea id="message" required="required" class="form-control resize-vertical mb-pc-20" name="message" rows="10" placeholder="スタジオからヒトコトをご記入ください。" data-parsley-trigger="keyup" data-parsley-maxlength="400" data-parsley-maxlength-message="プロフィールが長すぎます。（400文字）" data-parsley-validation-threshold="10"></textarea>
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
                              <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                                        <option value="<?php echo $cityVal[3]; ?>"><?php echo $cityVal[1]; ?></option>
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
                                    <?php
                                      $scClass->getGpsscript();
                                    ?>
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
      
                    <div class="col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>クラス <small>Class</small></h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li>
                              <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                          </ul>
                          <div class="clearfix"></div>
                        </div>
      
                        <div class="x_content">
                          <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <h4>ヨガのスタイル</h4>
                              <div id="style-list" class="list-js">
                                <div class="row">
                                  <div class="col-md-6 col-sm-6 col-xs-8">
                                    <input type="text" class="search form-control" placeholder="絞り込み" />
                                  </div>
                                  <div class="col-md-3 col-sm-3 col-xs-4">
                                    <button class="btn btn-default btn-block sort" data-sort="style-name">ソート</button>
                                  </div>
                                </div>
                                <ul class="list list-group">
                                  <?php
                                    $array = $cdClass->styleArray();
                                    $i = 0;
                                    foreach ($array as $key => $value) :
                                  ?>
                                  <li>
                                    <div class="md-checkbox">
                                      <input id="md-<?php echo $i; ?>" type="checkbox" value="<?php echo $key; ?>"><label for="md-<?php echo $i; ?>"></label>
                                    </div>
                                    <p class="style-name"><?php echo $value[0]; ?> <small><?php echo $value[1]; ?></small></p>
                                  </li>
                                  <?php
                                    $i++;
                                    endforeach;
                                  ?>
                                </ul>
                                <ul class="pagination"></ul>
                              </div>
                            </div>

                          </div>
                        </div><!-- x-content -->
                        
                      </div><!-- x-panel -->
                    </div>
                  </div>
                </div>
              </div><!-- col-left -->
              
              <div class="col-right">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                  <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>お知らせ<small>News</small></h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
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
                        </div><!-- /x-content -->
                      </div>
                    </div>
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>クーポン<small>Coupon</small></h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                          </ul>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-add-row coupon-add">
                              <table class="table table-striped table-bordered">
                                <tbody>
                                  <tr>
                                    <td class="td-news">
                                      <div class="mb-pc-10">
                                        <input type="text" class="form-control" placeholder="クーポン名">
                                      </div>
                                      <textarea class="form-control resize-vertical" placeholder="クーポンのの内容を記入"></textarea>
                                    </td>
                                    <td class="td-button">
                                      <button class="btn btn-default btn-circle btn-remove-row">－</button>
                                    </td>
                                  </tr>
                                  <tr class="tr-add-row">
                                    <td class="td-news">
                                      <div class="mb-pc-10">
                                        <input type="text" class="form-control" placeholder="クーポン名">
                                      </div>
                                      <textarea class="form-control resize-vertical" placeholder="クーポンの内容を記入"></textarea>
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
                                    var element = $('.coupon-add');
                                    element.find('.btn-add-row').on('click',function(){
                                      tr = element.find('.tr-add-row').clone(true);
                                      $(this).closest('.table-add-row').find('tbody .tr-add-row').before(tr);
                                      tr.fadeIn(500).removeClass('tr-add-row');
                                      _texrareaAutoHeight();
                                      _checkRowNumber(element,3);
                                      return false;
                                    });
                                    element.find('.btn-plug-row').on('click',function(){
                                      tr = element.find('.tr-add-row').clone(true);
                                      $(this).closest('tr').before(tr);
                                      tr.fadeIn(500).removeClass('tr-add-row');
                                      _texrareaAutoHeight();
                                      _checkRowNumber(element,3);
                                      return false;
                                    });
                                    element.find('.btn-remove-row').on('click',function(){
                                      tr = $(this).closest('tr');
                                      tr.fadeOut(500,function(){
                                        tr.remove();
                                        _checkRowNumber(element,3);
                                      });
                                      return false;
                                    });
                                  });
                                -->
                              </script>
                              <button class="btn btn-default btn-add-row">クーポンを追加</button>
                            </div>
                          </div>
                        </div><!-- /x-content -->
                      </div>
                    </div>

                    <div class="col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>所属インストラクター<small>instructor</small></h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                          </ul>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <div id="instructor-list">
                            <div class="row row-eq-height">
                              <?php
                                foreach ($dataClass->getinstructor() as $dataKey => $dataValue) :
                                  if($dataValue['status'] == 'success') :
                                    $area = NULL;
                                    for ($i=0;$i<count($dataValue['area']);$i++) :
                                      $area .= $cdClass->prefArray($dataValue['area'][$i]);
                                      if($i != count($dataValue['area']) - 1) $area .= '、';
                                    endfor;
                              ?>
                              <div class="col-lg-4 col-md-3 col-sm-3 col-xs-6">
                                <div class="area">
                                  <div class="area-thumbnail">
                                    <img src="/images/instructor/inst-thumb-<?php echo $dataValue['id'] ?>.jpg" class="suck">
                                  </div>
                                  <div class="area-content">
                                    <h3 class="area-title"><?php echo $dataValue['name']; ?></h3>
                                    <p class="area-description"><span>活動エリア：</span><?php echo $area; ?></p>
                                  </div>
                                  <div class="area-footer">
                                    <select class="form-control case">
                                    <?php foreach($dataClass->getValues(2) as $key => $value) : ?>
                                      <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" class="data-id" value="<?php echo $dataValue['id'] ?>">
                                  </div>
                                </div>
                              </div>
                              <?php
                                  endif;
                                endforeach;
                              ?>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                              <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bd-instructor-modal-lg">インストラクターを追加</button>
                            </div>
                            <?php include( WORKSPACE . '/include/modal-instructor.php'); ?>
                          </div>
                          
                          <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <h4>登録インストラクターがない場合</h4>
                              <textarea id="studio-free" class="form-control resize-vertical mb-pc-20" name="studio-free" rows="10" placeholder="インストラクターの登録がない場合などにご記入ください" data-parsley-trigger="keyup" data-parsley-maxlength="400" data-parsley-maxlength-message="プロフィールが長すぎます。（400文字）" data-parsley-validation-threshold="10"></textarea>
                            </div>
                          </div>
                          
                        </div><!-- /x-content -->
                      </div>
                    </div>
                    
                    <?php /*
                    <div class="col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>資格<small>License</small></h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li>
                              <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                          </ul>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <div class="row">
                            <div class="col-xs-12">
                              <h4>登録資格</h4>
                              <div id="license-list">
                                <div class="row">
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-add-row license-add">
                                    <table class="table table-striped table-bordered">
                                      <tbody class="list">
                                        <tr>
                                          <td class="td-question">
                                            <span class="license-parent-name">全米ヨガアライアンス</span><span class="license-child-name">RYT200</span><br>
                                            <span class="license-name">ヨガジェネレーション指導者養成講座</span><span class="license-teacher-name">中島正明</span>
                                            <input type="hidden" class="data-id" value="01">
                                          </td>
                                          <td class="td-button">
                                            <button class="btn btn-default btn-circle btn-remove-row" data-id="01">－</button>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="td-question">
                                            <span class="license-parent-name">インド政府公認</span><span class="license-child-name">インド政府公認校認定</span><br>
                                            <span class="license-name">ヨガ指導者養成講座（ヨガ哲学）1年</span><span class="license-teacher-name">クリシュナ・グルジ</span>
                                            <input type="hidden" class="data-id" value="03">
                                          </td>
                                          <td class="td-button">
                                            <button class="btn btn-default btn-circle btn-remove-row" data-id="03">－</button>
                                          </td>
                                        </tr>
                                        <tr class="tr-add-row">
                                          <td class="td-question">
                                            <span class="license-parent-name"></span><span class="license-child-name"></span><br>
                                            <span class="license-name"></span><span class="license-teacher-name"></span>
                                            <input type="hidden" class="data-id" value="">
                                          </td>
                                          <td class="td-button">
                                            <button class="btn btn-default btn-circle btn-remove-row" data-id="">－</button>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                    <script>
                                      <!--
                                        $(function(){
                                          var tr;
                                          var element = $('.license-add');
                                          element.find('.btn-remove-row').on('click',function(){
                                            var id = $(this).attr('data-id');
                                            tr = $(this).closest('tr');
                                            tr.fadeOut(500,function(){
                                              tr.remove();
                                              _checkRowNumber(element,5);
                                            });
                                            $('#modal-license-list .data-id-' + id).prop('disabled',false);
                                            $('#modal-license-list .data-id-' + id).text('追加');
                                            return false;
                                          });
                                        });
                                      -->
                                    </script>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                                  <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bd-license-modal-lg">資格追加</button>
                                </div>
                                <?php include( WORKSPACE . '/include/modal-license.php'); ?>
                              </div>
                              <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                  <h4>登録資格がない場合</h4>
                                  <textarea id="license-free" class="form-control resize-vertical mb-pc-20" name="license-free" rows="10" placeholder="資格の登録がない場合などにご記入ください" data-parsley-trigger="keyup" data-parsley-maxlength="400" data-parsley-maxlength-message="プロフィールが長すぎます。（400文字）" data-parsley-validation-threshold="10"></textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div><!-- /x-content -->
                      </div>
                    </div>
                    */ ?>

                    <div class="col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>開催イベント<small>Event</small></h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li>
                              <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                                    <span class="event-name">dusk</span><span class="event-pref-name">東���都</span>
                                    <select class="form-control case">
                                    <?php foreach($dataClass->getValues(3) as $key => $value) : ?>
                                      <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
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
                        </div><!-- /x-content -->
                      </div>
                    </div>
              
                    <div class="col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>カレンダー編集<small>Calendar</small></h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                          </ul>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <div class="row">
                            
                          </div>
                          <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                              <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bd-calendar-modal-lg">カレンダーを編集</button>
                            </div>
                            <?php include( WORKSPACE . '/include/modal-calendar.php'); ?>
                          </div>
                        </div><!-- /x-content -->
                      </div>
                    </div>
                  </div>
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