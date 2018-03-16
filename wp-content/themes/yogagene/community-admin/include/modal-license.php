<div class="modal fade bd-license-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">資格検索</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="modal-box">
              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                  <select class="form-control" name="pref">
                    <option>全米ヨガアライアンス</option>
                    <option>インド政府公認</option>
                    <option>その他</option>
                  </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 mb-xs-10">
                  <select class="form-control" name="pref">
                   <option>RYT200</option>
                   <option>RYT500</option>
                   <option>RPYT</option>
                   <option>RCYT</option>
                  </select>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 mb-xs-10 form-group">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="modal-license-list">
              <ul class="list-unstyled table-ul list">
                <?php
                  foreach ($dataClass->getLicense() as $key => $val) :
                    if($val['status'] == 'success') :
                ?>
                <li class="table-li">
                  <div class="table-cell">
                    <h3 class="table-title" data-name="<?php echo $val['name']; ?>"><?php echo $val['name']; ?></h3>
                    <p class="table-description">
                      <span class="parent-name" data-parent-name="<?php echo $val['parent-name']; ?>"><?php echo $val['parent-name']; ?></span>&nbsp;<span class="child-name" data-child-name="<?php echo $val['child-name']; ?>"><?php echo $val['child-name']; ?></span><br>
                      <span class="teacher-name" data-teacher-name="<?php echo $val['teacher-name']; ?>"><?php echo $val['teacher-name']; ?></span>
                    </p>
                  </div>
                  <div class="table-cell table-button">
                    <div class="form-group">
                      <button type="submit" class="btn btn-default btn-sm add data-id-<?php echo $val['id']; ?>" data-id="<?php echo $val['id']; ?>">追加</button>
                    </div>
                  </div>
                </li>
                <?php
                    endif;
                  endforeach;
                ?>
              </ul>
              <?php include (WORKSPACE . '/include/pagination.php'); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
      </div>
    </div>
  </div>
</div>
<!-- mixitup -->
<script src="/vendors/mixitup/mixitup.min.js"></script>
<script src="/js/script-mixitup.js"></script>