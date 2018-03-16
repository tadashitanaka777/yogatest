<?php include('../../function/function.php'); ?>
<?php include ( WORKSPACE . '/include/header.php' ); ?>

        <!-- page content -->
        <main class="right_col" role="main">
          <form class="forms" data-parsley-validate novalidate>

            <div class="page-title">
              <div class="title_left">
                <h1>資格 <small>License</small></h1>
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
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </ul>
                          <div class="clearfix"></div>
                        </div>
      
                        <div class="x_content">
                          <div class="row">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <h4>基本情報</h4>
                              <div class="form-horizontal form-label-left input_mask">
                                <div class="row">
                                  
                                  <div class="form-group">
                                    <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">資格・講座名</label>
                                    <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                      <input type="text" class="form-control" placeholder="ヨガジェネレーションヨガ指導者養成講座">
                                    </div>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">担当講師</label>
                                    <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                      <input type="text" class="form-control" placeholder="中島 正明">
                                    </div>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">詳細URL</label>
                                    <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                      <input type="text" class="form-control" placeholder="https://shop.yoga-gene.com/program/621/">
                                    </div>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">お問い合わせ</label>
                                    <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                      <input type="text" class="form-control" placeholder="メールアドレス">
                                    </div>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">組織・団体</label>
                                    <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                      <select class="form-control">
                                        <option>全米ヨガアライアンス</option>
                                        <option>インド政府公認</option>
                                        <option>その他</option>
                                      </select>
                                    </div>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">資格種類</label>
                                    <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                      <select class="form-control">
                                        <option>RYT200</option>
                                        <option>RYT500</option>
                                        <option>RPYT</option>
                                        <option>RCYT</option>
                                      </select>
                                    </div>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label class="control-label col-lg-3 col-md-2 col-sm-2 col-xs-12">備考</label>
                                    <div class="col-lg-9 col-md-10 col-sm-10 col-xs-12">
                                      <textarea id="message" required="required" class="form-control resize-vertical mb-pc-20" name="message" rows="10" placeholder="資格の紹介文をご記入ください。" data-parsley-trigger="keyup" data-parsley-maxlength="400" data-parsley-maxlength-message="プロフィールが長すぎます。（400文字）" data-parsley-validation-threshold="10"></textarea>
                                    </div>
                                  </div>

                                </div>
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
                    
                    <div class="col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>発行スタジオ<small>Studio</small></h2>
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
                              <div id="license-studio-list">
                                <div class="row">
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-add-row license-studio-add">
                                    <table class="table table-striped table-bordered">
                                      <tbody class="list">
                                        <tr>
                                          <td class="td-question">
                                            <span class="shop-name">オハナスマイル ヨガスタジオ</span>
                                            <span class="child-name">祐天寺</span>
                                            <span class="pref-name">東京都</span>
                                            <input type="hidden" class="data-id" value="01">
                                          </td>
                                          <td class="td-button">
                                            <button class="btn btn-default btn-circle btn-remove-row" data-id="01">－</button>
                                          </td>
                                        </tr>
                                        <tr class="tr-add-row">
                                          <td class="td-question">
                                            <span class="shop-name"></span>
                                            <span class="child-name"></span>
                                            <span class="pref-name"></span>
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
                                          var element = $('.license-studio-add');
                                          element.find('.btn-remove-row').on('click',function(){
                                            var id = $(this).attr('data-id');
                                            tr = $(this).closest('tr');
                                            tr.fadeOut(500,function(){
                                              tr.remove();
                                              _checkRowNumber(element,5);
                                            });
                                            $('#modal-license-studio-list .data-id-' + id).prop('disabled',false);
                                            $('#modal-license-studio-list .data-id-' + id).text('追加');
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
                                  <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bd-license-studio-modal-lg">スタジオ追加</button>
                                </div>
                                <?php include( WORKSPACE . '/include/modal-license-studio.php'); ?>
                              </div>

                            </div>
                          </div>
                        </div><!-- /x-content -->
                      </div>
                    </div>

                    <div class="col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>取得インストラクター<small>instructor</small></h2>
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
                              <h4>登録インストラクター</h4>
                              <div id="certified-list" class="list-js">
                                <div class="row">
                                  <div class="col-md-3 col-sm-3 col-xs-6">
                                    <input type="text" class="search form-control" placeholder="絞り込み" />
                                  </div>
                                  <div class="col-md-3 col-sm-3 col-xs-6">
                                    <select class="select-pref form-control">
                                      <option value="all">すべて</option>
                                      <?php foreach($cdClass->prefArray() as $key => $val) : ?>
                                      <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
                                      <?php endforeach; ?>
                                    </select>
                                  </div>
                                  <div class="col-md-3 col-sm-3 col-xs-6">
                                    <select class="select-studio form-control">
                                      <option value="all">すべて</option>
                                      <option value="not">未選択</option>
                                    </select>
                                  </div>
                                  <div class="col-md-3 col-sm-3 col-xs-6">
                                    <select class="select-case form-control">
                                      <option value="all">すべて</option>
                                      <?php foreach($dataClass->getValues() as $key => $val) : ?>
                                      <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                      <?php endforeach; ?>
                                    </select>
                                    
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-add-row certified-add">
                                    <ul class="list list-group">
                                      <?php for($i=0;$i < 500; $i++) : ?>
                                      <li>
                                        <img src="/images/instructor/no-instructor.jpg" class="list-thumb">
                                        <span class="list-title">西浦 莉紗</span><span class="pref-name">東京都</span>
                                        <select class="form-control select-studio">
                                          <option value="not">未選択</option>
                                          <option value="01">オハナスマイルヨガスタジオ 祐天寺</option>
                                          <option value="02">オハナスマイルヨガスタジオ 駒沢大学</option>
                                          <option value="03">ヨガアカデミー大阪</option>
                                        </select>
                                        <select class="form-control case">
                                          <option value="success">承認済</option>
                                          <option value="delete">解除</option>
                                        </select>
                                        <span class="studio-hidden">not</span>
                                        <span class="case-hidden">success</span>
                                        <span class="id-hidden"><?php echo $i; ?>01</span>
                                        <input type="hidden" class="data-id" value="<?php echo $i; ?>01">
                                      </li>
                                      <li>
                                        <img src="/images/instructor/no-instructor.jpg" class="list-thumb">
                                        <span class="list-title">西川 涼子</span><span class="pref-name">東京都</span>
                                        <select class="form-control select-studio">
                                          <option value="not">未選択</option>
                                          <option value="01">オハナスマイルヨガスタジオ 祐天寺</option>
                                          <option value="02">オハナスマイルヨガスタジオ 駒沢大学</option>
                                          <option value="03">ヨガアカデミー大阪</option>
                                        </select>
                                        <select class="form-control case">
                                          <option value="success">承認済</option>
                                          <option value="delete">解除</option>
                                        </select>
                                        <span class="studio-hidden">not</span>
                                        <span class="case-hidden">success</span>
                                        <span class="id-hidden"><?php echo $i; ?>02</span>
                                        <input type="hidden" class="data-id" value="<?php echo $i; ?>02">
                                      </li>
                                      <li>
                                        <img src="/images/instructor/no-instructor.jpg" class="list-thumb">
                                        <span class="list-title">佐久間 涼子</span><span class="pref-name">東京都</span>
                                        <select class="form-control select-studio">
                                          <option value="not">未選択</option>
                                          <option value="01">オハナスマイルヨガスタジオ 祐天寺</option>
                                          <option value="02">オハナスマイルヨガスタジオ 駒沢大学</option>
                                          <option value="03">ヨガアカデミー大阪</option>
                                        </select>
                                        <select class="form-control case">
                                          <option value="success">承認済</option>
                                          <option value="delete">解除</option>
                                        </select>
                                        <span class="studio-hidden">not</span>
                                        <span class="case-hidden">success</span>
                                        <span class="id-hidden"><?php echo $i; ?>03</span>
                                        <input type="hidden" class="data-id" value="<?php echo $i; ?>03">
                                      </li>
                                      <li>
                                        <img src="/images/instructor/no-instructor.jpg" class="list-thumb">
                                        <span class="list-title">吉川 祐生</span><span class="pref-name">大阪府</span>
                                        <select class="form-control select-studio">
                                          <option value="not">未選択</option>
                                          <option value="01">オハナスマイルヨガスタジオ 祐天寺</option>
                                          <option value="02">オハナスマイルヨガスタジオ 駒沢大学</option>
                                          <option value="03">ヨガアカデミー大阪</option>
                                        </select>
                                        <select class="form-control case">
                                          <option value="applying">申請中</option>
                                          <option value="delete">解除</option>
                                        </select>
                                        <span class="studio-hidden">not</span>
                                        <span class="case-hidden">applying</span>
                                        <span class="id-hidden"><?php echo $i; ?>04</span>
                                        <input type="hidden" class="data-id" value="<?php echo $i; ?>04">
                                      </li>
                                      <?php endfor; ?>
                                    </ul>
                                    <?php include (WORKSPACE . '/include/pagination.php'); ?>
                                    <script>
                                      <!--
                                        $(function(){
                                          var tr;
                                          var element = $('.certified-add');
                                          element.find('.btn-remove-row').on('click',function(){
                                            var id = $(this).attr('data-id');
                                            tr = $(this).closest('tr');
                                            tr.fadeOut(500,function(){
                                              tr.remove();
                                              _checkRowNumber(element,5);
                                            });
                                            $('#modal-instructor-list .data-id-' + id).prop('disabled',false);
                                            $('#modal-instructor-list .data-id-' + id).text('追加');
                                            return false;
                                          });
                                        });
                                      -->
                                    </script>
                                  </div>
                                </div>
                              </div>

                            </div>
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
                        <button type="button" class="btn btn-primary btn-block">非公開</button>
                      </div>
                      <div class="col-md-2 col-sm-3 col-xs-6">
                        <button type="submit" class="btn btn-success btn-block">保存</button>
                      </div>
                    </div>
                </div>
              </div>

            </div>
          </form>
        </main>
        <!-- /page content -->

<?php include( WORKSPACE . '/include/footer.php' ); ?>