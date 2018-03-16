<?php include( '../../function/function.php'); ?>
<?php include ( WORKSPACE . '/include/header.php' ); ?>
<?php include ( WORKSPACE . '/include/navigation.php' ); ?>
<section class="mypage-section">
    <form class="forms" data-parsley-validate novalidate>
        <div class="page-title">
            <div class="title_left">
                <h1>企業 <small>Company</small></h1>
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
                                    <h2>企業編集 
                                        <small>Company Edit</small>
                                    </h2>
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
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                        <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="会社名">
                                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                        <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="英語表記">
                                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                        <input type="text" class="form-control has-feedback-left" id="inputSuccess3" placeholder="WEBサイト">
                                                        <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
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
                                            <h4>企業ロゴ</h4>
                                            <div class="logo_img">
                                                <div id="crop-pose">
                                                    <div id="myLogo" class="dropzone dz-clickable"></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                            <h4>社内イメージ</h4>
                                            <div class="pose_img">
                                                <div id="crop-pose">
                                                    <div id="myPose" class="dropzone dz-clickable"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <h4>企業紹介</h4>
                                            <div class="form-horizontal form-label-left">
                                                <div class="row">
                                                  <div class="form-group">
                                                    <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">紹介文</label>
                                                    <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                                        <textarea id="message" required="required" class="form-control resize-vertical mb-pc-20" name="message" rows="10" placeholder="企業の紹介文をご記入ください。" data-parsley-trigger="keyup" data-parsley-maxlength="400" data-parsley-maxlength-message="プロフィールが長すぎます。（400文字）" data-parsley-validation-threshold="10"></textarea>
                                                    </div>
                                                 </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <h4>会社概要</h4>
                                            <div class="form-horizontal form-label-left">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">設立</label>
                                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                                            <input type="text" class="form-control" placeholder="1998年8月">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">従業員数</label>
                                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                                            <input type="text" class="form-control" placeholder="1998年8月">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">役員</label>
                                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                                            <textarea id="message" required="required" class="form-control resize-vertical mb-pc-20" name="message" rows="10" placeholder="代表取締役：山田 太郎
取締役：山田 花子" data-parsley-trigger="keyup" data-parsley-maxlength="150" data-parsley-maxlength-message="長すぎます。（150文字）" data-parsley-validation-threshold="10"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">事業内容</label>
                                                        <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                                            <textarea id="message" required="required" class="form-control resize-vertical mb-pc-20" name="message" rows="10" placeholder="ヨガスタジオ運営事業
インターネット広告事業" data-parsley-trigger="keyup" data-parsley-maxlength="400" data-parsley-maxlength-message="プロフィールが長すぎます。（400文字）" data-parsley-validation-threshold="10"></textarea>
                                                        </div>
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
            <!-- col-left -->
            <div class="col-right">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
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
                                                                <option value="<e61d73bef2bae41a93765bd622cd2fe4 />">
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
                                                                $(function () {
                                                                	lineChange($('select[name="pref"]'), 13);
                                                                	$('select[name="pref"]').change(function () {
                                                                		var pref = $(this).val();
                                                                		cityChange($(this), pref);
                                                                		lineChange($(this), pref);
                                                                	});
                                                                	$('select[name="line[]"]').change(function () {
                                                                		var pref = $('select[name="pref"]').val();
                                                                		var line = $(this).val();
                                                                		stationChange($(this), pref, line);
                                                                	});
                                                                });
                                                            -->
                                                            </script>
                                                            <script>
                                                            <!--
                                                                $(function () {
                                                                	var tr;
                                                                	var element = $('.station-add');
                                                                	element.find('.btn-add-row').on('click', function () {
                                                                		tr = element.find('.tr-add-row').clone(true);
                                                                		$(this).closest('.table-add-row').find('tbody .tr-add-row').before(tr);
                                                                		tr.fadeIn(500).removeClass('tr-add-row');
                                                                		_texrareaAutoHeight();
                                                                		_checkRowNumber(element, 5);
                                                                		tr.find('input[type="text"]').addClass('timepicker');
                                                                		$('.timepicker').clockpicker({
                                                                			donetext: 'OK'
                                                                		});
                                                                		return false;
                                                                	});
                                                                	element.find('.btn-plug-row').on('click', function () {
                                                                		tr = element.find('.tr-add-row').clone(true);
                                                                		$(this).closest('tr').before(tr);
                                                                		tr.fadeIn(500).removeClass('tr-add-row');
                                                                		_texrareaAutoHeight();
                                                                		_checkRowNumber(element, 5);
                                                                		return false;
                                                                	});
                                                                	element.find('.btn-remove-row').on('click', function () {
                                                                		tr = $(this).closest('tr');
                                                                		tr.fadeOut(500, function () {
                                                                			tr.remove();
                                                                			_checkRowNumber(element, 5);
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