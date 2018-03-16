<?php include( '../../function/function.php'); ?>
<?php include ( WORKSPACE . '/include/header.php' ); ?>
<?php include ( WORKSPACE . '/include/navigation.php' ); ?>
<section class="mypage-section">
    
    <?php
        if($_POST) :
            var_dump($_FILES);
            /*
            if (!isset($_FILES['image']['error']) || !is_int($_FILES['image']['error'])){
                echo "ファイルアップロードエラー";
            } else {
                $file_name = $_FILES['image']['name'];
                $extension = pathinfo($file_name, PATHINFO_EXTENSION); //拡張子取得
                $tmp_path = $_FILES['image']['tmp_name'];
                $file_dir_path = "upload/";
                $uniq_name = date("YmdHis").md5(uniqid(microtime(),1)).session_id() . "." . $extension;

                if (is_uploaded_file($tmp_path)) {
                    if(move_uploaded_file( $tmp_path, $file_dir_path . $uniq_name)) {
                        chmod($file_dir_path . $uniq_name, 0644);
                    } else {
                    echo "Error:アップロードできませんでした。";
                    }
                }
            }
            */
        endif;
    ?>
    
    <form id="mypage-form" class="forms" method="post" enctype="multipart/form-data" data-parsley-validate novalidate>
        <div class="page-title">
          <div class="title_left">
            <h1>インストラクター <small>instructor</small></h1>
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="left-col">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

                    <div class="x_panel">
                        <div class="x_title">
                            <h2>プロフィール編集 <small>Profile Edit</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
      
                        <div class="x_content">
                            <div class="row">
                                
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-horizontal form-label-left input_mask">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="インストラクター名">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                            
                                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="インストラクター名（英字表記）">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>
          
                                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="inputSuccess3" placeholder="ホームページ・サイトURL">
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
                                                <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="メールアドレス">
                                                <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                            </div>
      
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <?php include ( WORKSPACE . '/include/include-file.php' ); ?>
                                </div>
                                <!--
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
                                                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="インストラクター名">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                            
                                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="インストラクター名（英字表記）">
                                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                            </div>
          
                                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="inputSuccess3" placeholder="ホームページ・サイトURL">
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
                                                <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="メールアドレス">
                                                <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                            </div>
      
                                        </div>
                                    </div>
                                </div>
                                -->
                                <!--
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h4>プロフィール画像</h4>
                                    
                                    <div id="drop_zone">ドロップ</div>
                                    <div id="preview">
                                        <input type="file" name="pose" accept=".jpg,.jpeg,.png" capture="camera" multiple>
                                    </div>
                                    
                                    <div class="pose_img">
                                        <div id="crop-pose">
                                            <div id="myPose" class="dropzone dz-clickable"></div>
                                        </div>
                                    </div>
                                </div>
                                -->
      
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h4>プロフィール</h4>
                                    <textarea id="message" required="required" class="form-control resize-vertical mb-pc-20" name="message" rows="10" placeholder="あなたの経歴や受賞歴などをご記入ください。" data-parsley-trigger="keyup" data-parsley-maxlength="400" data-parsley-maxlength-message="プロフィールが長すぎます。（400文字）" data-parsley-validation-threshold="10"></textarea>
                                </div>
    
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-pc-20">
                                    <h4>活動エリア</h4>
                                    <div class="">
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-12 mb-sm-10 mb-sp-10">
                                                <select class="form-control" name="area[]">
                                                    <option>選択してください</option>
                                                    <?php echo $cdClass->prefSelect(); ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4 col-xs-12 mb-sm-10 mb-sp-10">
                                                <select class="form-control" name="area[]">
                                                    <option>選択してください</option>
                                                    <?php echo $cdClass->prefSelect(); ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4 col-xs-12 mb-sm-10 mb-sp-10">
                                                <select class="form-control" name="area[]">
                                                    <option>選択してください</option>
                                                    <?php echo $cdClass->prefSelect(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <p class="notice"><small>※最大3つの活動エリアを登録できます。</small></p>
                                    </div>
                                </div>
      
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h4>ヨガのスタイル（複数選択可）</h4>
                                    <div id="style-list" class="list-js">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-8">
                                                <input type="text" class="search form-control" placeholder="絞り込み検索" />
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-4">
                                                <button class="btn btn-default btn-block sort" data-sort="style-name">五十音順</button>
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

                    <div class="x_panel">
                        <div class="x_title">
                            <h2>インタビュー<small>Interview</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-add-row interview-add">
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                            <tr>
                                                <td class="td-question">
                                                    <select class="form-control">
                                                        <?php echo $cdClass->interviewSelect(1);?>
                                                    </select>
                                                    <textarea class="form-control resize-vertical" placeholder="質問の答えを記入"></textarea>
                                                </td>
                                                <td class="td-button">
                                                    <button class="btn btn-default btn-circle btn-remove-row">－</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="td-question">
                                                    <select class="form-control">
                                                        <?php echo $cdClass->interviewSelect(2);?>
                                                    </select>
                                                    <textarea class="form-control resize-vertical" placeholder="質問の答えを記入"></textarea>
                                                </td>
                                                <td class="td-button">
                                                    <button class="btn btn-default btn-circle btn-remove-row">－</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="td-question">
                                                    <select class="form-control">
                                                        <?php echo $cdClass->interviewSelect(3);?>
                                                    </select>
                                                    <textarea class="form-control resize-vertical" placeholder="質問の答えを記入"></textarea>
                                                </td>
                                                <td class="td-button">
                                                    <button class="btn btn-default btn-circle btn-remove-row">－</button>
                                                </td>
                                            </tr>
                                            <tr class="tr-add-row">
                                                <td class="td-question">
                                                    <select class="form-control">
                                                        <?php echo $cdClass->interviewSelect();?>
                                                    </select>
                                                    <textarea class="form-control resize-vertical" placeholder="質問の答えを記入"></textarea>
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
                                            var element = $('.interview-add');
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
                                    <button class="btn btn-default btn-add-row">質問を追加</button>
                                </div>
                            </div>
                        </div><!-- /x-content -->
                    </div>

                </div>
            </div><!-- col-left -->

            <div class="col-right">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

                    <div class="x_panel">
                        <div class="x_title">
                            <h2>所属スタジオ<small>Studio</small></h2>
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
                                    <h4>登録スタジオ</h4>
                                    <div id="studio-list" class="list-js">
                                        <ul class="list list-group">
                                            <li>
                                                <span class="shop-name">オハナスマイル ヨガスタジオ 祐天寺</span><span class="pref-name">東京都</span>
                                                <select class="form-control case">
                                                <?php foreach($dataClass->getValues(3) as $key => $value) : ?>
                                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                <?php endforeach; ?>
                                                </select>
                                                <input type="hidden" class="data-id" value="01">
                                            </li>
                                            <li>
                                                <span class="shop-name">オハナスマイル ヨガスタジオ 駒沢大学</span><span class="pref-name">東京都</span>
                                                <select class="form-control case">
                                                <?php foreach($dataClass->getValues(1) as $key => $value) : ?>
                                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                <?php endforeach; ?>
                                                </select>
                                                <input type="hidden" class="data-id" value="02">
                                            </li>
                                            <li>
                                                <span class="shop-name">ヨガアカデミー大阪</span><span class="pref-name">神奈川県</span>
                                                <select class="form-control case">
                                                <?php foreach($dataClass->getValues(2) as $key => $value) : ?>
                                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                <?php endforeach; ?>
                                                </select>
                                                <input type="hidden" class="data-id" value="03">
                                            </li>
                                        </ul>
                                    </div>
      
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                                            <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bd-studio-modal-lg">スタジオ追加</button>
                                        </div>
                                        <?php include( WORKSPACE . '/include/modal-studio.php'); ?>
                                    </div>
      
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <h4>上記スタジオ追加画面にスタジオ登録がない場合、ご入力ください</h4>
                                            <textarea id="studio-free" class="form-control resize-vertical mb-pc-10" name="studio-free" rows="10" placeholder="スタジオの登録がない場合などにご記入ください" data-parsley-trigger="keyup" data-parsley-maxlength="400" data-parsley-maxlength-message="プロフィールが長すぎます。（400文字）" data-parsley-validation-threshold="10"></textarea>
                                            <p class="notice"><small>※スタジオを登録したい方：WEBサイトをお持ちの方であれば<a href="https://community-front-yogageneration.c9users.io/signup/business/" target="_blank">ビジネス登録</a>よりスタジオをご登録いただけます。</small></p>
                                        </div>
                                    </div>
      
                                </div>
                            </div>
                        </div><!-- /x-content -->
                    </div>
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

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <textarea id="license-free" class="form-control resize-vertical mb-pc-20" name="license-free" rows="10" placeholder="お持ちの資格ご記入ください" data-parsley-trigger="keyup" data-parsley-maxlength="400" data-parsley-maxlength-message="プロフィールが長すぎます。（400文字）" data-parsley-validation-threshold="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /x-content -->
                    </div>

                    <div class="x_panel">
                        <div class="x_title">
                            <h2>参加イベント<small>Event</small></h2>
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
                                                <span class="event-name">dusk</span><span class="event-pref-name">東京都</span>
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