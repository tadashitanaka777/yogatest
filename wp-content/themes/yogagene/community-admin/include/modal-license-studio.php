<div class="modal fade bd-license-studio-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">スタジオ検索</h5>
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
                    <?php echo $cdClass->prefSelect(13); ?>
                  </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 mb-xs-10">
                  <select class="form-control" name="pref">
                  <?php
                    foreach ($dataClass->getStatus() as $key => $value) {
                      echo '<option value="'.$key.'">'.$value.'</option>';
                    }
                  ?>
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
            <div id="modal-license-studio-list">
              <ul class="list-unstyled table-ul list">
                <?php
                  foreach ($dataClass->getStudio() as $key => $val) :
                    if($val['status'] == 'success') :
                      $area = NULL;
                      for ($i=0;$i<count($val['area']);$i++) :
                        $area .= $cdClass->prefArray($val['area'][$i]);
                        if($i != count($val['area']) - 1) $area .= '、';
                      endfor;
                ?>
                <li class="table-li">
                  <div class="table-cell table-thumbnail">
                    <img src="/images/studio/studio-thumb-<?php echo $val['id']; ?>.jpg" class="suck">
                  </div>
                  <div class="table-cell">
                    <h3 class="table-title" data-value="<?php echo $val['name']; ?>"><?php echo $val['name']; ?></h3>
                    <p class="table-description"><small class="shop-name" data-value="<?php echo $val['shopname']; ?>"><?php echo $val['shopname']; ?>&nbsp;/&nbsp;<span class="table-pref" data-value="<?php echo $area; ?>"><?php echo $area; ?></span></small><br><span data-value="<?php echo $val['subname']; ?>"><?php echo $val['subname']; ?></span></p>
                  </div>
                  <div class="table-cell table-button">
                    <div class="form-group">
                      <button class="btn btn-default btn-sm no-submit add data-id-<?php echo $val['id']; ?>" data-value="<?php echo $val['id']; ?>">申請</button>
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