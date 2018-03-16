<?php include( '../../function/function.php'); ?>
<?php include ( WORKSPACE . '/include/header.php' ); ?>
<?php include ( WORKSPACE . '/include/navigation.php' ); ?>
<section class="mypage-section">
    <form class="forms" data-parsley-validate novalidate>
        <div class="page-title">
            <div class="title_left">
                <h1>イベント <small>Event</small></h1>
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
                                                        <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="イベント・ワークショップ名">
                                                        <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                        <input type="text" class="form-control has-feedback-left" id="inputSuccess3" placeholder="詳細URL">
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
                                            <h4>イベントロゴ</h4>
                                            <div class="logo_img">
                                                <div id="crop-pose">
                                                    <div id="myLogo" class="dropzone dz-clickable"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                            <h4>イベントイメージ</h4>
                                            <div class="pose_img">
                                                <div id="crop-pose">
                                                    <div id="myPose" class="dropzone dz-clickable"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <h4>開催情報</h4>
                                            <div class="form-horizontal form-label-left input_mask">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">カテゴリ</label>
                                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                                            <select class="form-control">
                                                                <option>イベント</option>
                                                                <option>ワークショップ</option>
                                                                <option>指導者養成講座</option>
                                                                <option>その他</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">主催名・主催者</label>
                                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                                            <input type="text" class="form-control" placeholder="OHANAsmile Inc.">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">会場名</label>
                                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                                            <input type="text" class="form-control" placeholder="オハナスマイルヨガスタジオ 祐天寺店">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">詳細URL</label>
                                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                                            <input type="text" class="form-control" placeholder="詳細サイト・ページ">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">費用</label>
                                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                                            <input type="text" class="form-control" placeholder="1クラス / 2000円（税込）">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">定員</label>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                                                            <input type="text" class="form-control" placeholder="200人">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-horizontal form-label-left input_mask">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">参加対象</label>
                                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                                            <textarea id="message" required="required" class="form-control resize-vertical mb-pc-20" name="message" rows="10" placeholder="イベントの概要をご記入ください。" data-parsley-trigger="keyup" data-parsley-maxlength="400" data-parsley-maxlength-message="プロフィールが長すぎます。（400文字）" data-parsley-validation-threshold="10"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">持ち物</label>
                                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                                            <textarea id="message" required="required" class="form-control resize-vertical mb-pc-20" name="message" rows="10" placeholder="イベントの概要をご記入ください。" data-parsley-trigger="keyup" data-parsley-maxlength="400" data-parsley-maxlength-message="プロフィールが長すぎます。（400文字）" data-parsley-validation-threshold="10"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">紹介文</label>
                                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                                            <textarea id="message" required="required" class="form-control resize-vertical mb-pc-20" name="message" rows="10" placeholder="イベントの紹介文をご記入ください。" data-parsley-trigger="keyup" data-parsley-maxlength="400" data-parsley-maxlength-message="プロフィールが長すぎます。（400文字）" data-parsley-validation-threshold="10"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">内容</label>
                                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                                            <textarea id="message" required="required" class="form-control resize-vertical mb-pc-20" name="message" rows="10" placeholder="イベントの内容をご記入ください。" data-parsley-trigger="keyup" data-parsley-maxlength="400" data-parsley-maxlength-message="プロフィールが長すぎます。（400文字）" data-parsley-validation-threshold="10"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-horizontal form-label-left">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">開催日程</label>
                                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12 table-add-row clock-add">
                                                            <table class="table table-striped table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="td-clock-week">
                                                                            <div class="row">
                                                                                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
                                                                                    <input type="text" class="form-control datepicker" value="" placeholder="開催日">
                                                                                </div>
                                                                                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-6">
                                                                                    <input type="text" class="form-control timepicker" placeholder="開始時間">
                                                                                </div>
                                                                                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-6">
                                                                                    <input type="text" class="form-control timepicker" placeholder="終了時間">
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
                                                                                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
                                                                                    <input type="text" class="form-control date" value="" placeholder="開催日">
                                                                                </div>
                                                                                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-6">
                                                                                    <input type="text" class="form-control time" placeholder="開始時間">
                                                                                </div>
                                                                                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-6">
                                                                                    <input type="text" class="form-control time" placeholder="終了時間">
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
                                                  _checkRowNumber(element,5);
                                                  tr.find('input.time').addClass('timepicker');
                                                  $('.timepicker').clockpicker({donetext:'OK',autoclose:true});
                                                  tr.find('input.date').addClass('datepicker');
                                                  tr.find('input.datepicker').datetimepicker({format: 'YYYY-MM-DD'});
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
                                                            <button class="btn btn-default btn-add-row">開催日を追加</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>プログラム <small>Program</small></h2>
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
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-add-row program-add">
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td class="td-program">
                                                            <div class="mb-pc-10">
                                                                <input type="text" class="form-control" placeholder="10:00～12:00">
                                                            </div>
                                                            <textarea class="form-control resize-vertical" placeholder="・自己紹介
・実習（アサナ）"></textarea>
                                                        </td>
                                                        <td class="td-button">
                                                            <button class="btn btn-default btn-circle btn-remove-row">－</button>
                                                        </td>
                                                    </tr>
                                                    <tr class="tr-add-row">
                                                        <td class="td-program">
                                                            <div class="mb-pc-10">
                                                                <input type="text" class="form-control" placeholder="12:00～14:00">
                                                            </div>
                                                            <textarea class="form-control resize-vertical" placeholder="・座学（哲学）
・修了式"></textarea>
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
                                                              var max = 10;
                                                            var tr;
                                                            var element = $('.program-add');
                                                            element.find('.btn-add-row').on('click',function(){
                                                              tr = element.find('.tr-add-row').clone(true);
                                                              $(this).closest('.table-add-row').find('tbody .tr-add-row').before(tr);
                                                              tr.fadeIn(500).removeClass('tr-add-row');
                                                              _texrareaAutoHeight();
                                                              _checkRowNumber(element,max);
                                                              return false;
                                                            });
                                                            element.find('.btn-plug-row').on('click',function(){
                                                              tr = element.find('.tr-add-row').clone(true);
                                                              $(this).closest('tr').before(tr);
                                                              tr.fadeIn(500).removeClass('tr-add-row');
                                                              _texrareaAutoHeight();
                                                              _checkRowNumber(element,max);
                                                              return false;
                                                            });
                                                            element.find('.btn-remove-row').on('click',function(){
                                                              tr = $(this).closest('tr');
                                                              tr.fadeOut(500,function(){
                                                                tr.remove();
                                                                _checkRowNumber(element,max);
                                                              });
                                                              return false;
                                                            });
                                                          });
                                                        -->
                                                      </script>
                                            <button class="btn btn-default btn-add-row">プログラムを追加</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /x-content -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- col-left -->
            <div class="col-right">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>開催地 <small>Venue</small></h2>
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
                                        <div>
                                            <ul class="tab-ul">
                                                <li class="select">登録スタジオ</li>
                                                <li>新規開催地</li>
                                            </ul>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-li col-xs-12">
                                                <h4>開催スタジオ</h4>
                                                <div id="event-studio-list">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-add-row event-studio-add">
                                                            <table class="table table-striped table-bordered">
                                                                <tbody class="list">
                                                                    <tr>
                                                                        <td class="td-question">
                                                                            <div class="row">
                                                                                <div class="col-lg-9">
                                                                                    <span class="shop-name">オハナスマイル ヨガスタジオ</span>
                                                                                    <span class="child-name">祐天寺</span>
                                                                                    <span class="pref-name">東京都</span>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <select class="form-control status">
                                                                                        <option>申請準備</option>
                                                                                        <option>解除</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" class="data-id" value="01">
                                                                        </td>
                                                                        <td class="td-button">
                                                                            <button class="btn btn-default btn-circle btn-remove-row" data-id="01">－</button>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="tr-add-row">
                                                                        <td class="td-question">
                                                                            <div class="row">
                                                                                <div class="col-lg-9">
                                                                                    <span class="shop-name"></span>
                                                                                    <span class="child-name"></span>
                                                                                    <span class="pref-name"></span>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <select class="form-control status">
                                                                                        <option>申請準備</option>
                                                                                        <option>解除</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
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
                                              var element = $('#event-studio-list');
                                              element.find('.btn-remove-row').on('click',function(){
                                                var id = $(this).attr('data-id');
                                                tr = $(this).closest('tr');
                                                tr.fadeOut(500,function(){
                                                  tr.remove();
                                                  _checkRowNumber(element,1);
                                                });
                                                $('#modal-event-studio-list .data-id-' + id).prop('disabled',false);
                                                $('#modal-event-studio-list .data-id-' + id).text('追加');
                                                return false;
                                              });
                                            });
                                                            -->
                                                            </script>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                                                            <button type="button" class="btn btn-default btn-add-row" data-toggle="modal" data-target=".bd-event-studio-modal-lg">スタジオ追加</button>
                                                        </div>
                                                        <?php include( WORKSPACE . '/include/modal-event-studio.php'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-li col-md-12 col-sm-12 col-xs-12" style="display: none;">
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
                                                                    <option value="<?php echo $cityVal[3]; ?>">
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
                                                                <input type="text" class="form-control" name="address" placeholder="祐天寺2-9-4" onKeyUp="latlonSearch(this);">
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
                                        <!-- tab-content -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                                                <div class="col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>参加・出演インストラクター <small>instructor</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="close-link">
                                                <i class="fa fa-close"></i>
                                            </a>
                                        </li>
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
                                                        <h3 class="area-title">
                                                            <?php echo $dataValue['name']; ?>
                                                        </h3>
                                                        <p class="area-description">
                                                            <span>活動エリア：</span>
                                                            <?php echo $area; ?>
                                                        </p>
                                                    </div>
                                                    <div class="area-footer">
                                                        <select class="form-control case">
                                                            <?php foreach($dataClass->getValues(2) as $key => $value) : ?>
                                                            <option value="<?php echo $key; ?>">
                                                                <?php echo $value; ?>
                                                            </option>
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