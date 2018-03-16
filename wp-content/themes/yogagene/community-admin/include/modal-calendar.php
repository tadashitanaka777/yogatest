<div class="modal fade bd-calendar-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">カレンダー編集</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="modal-box">
              <div class="monthly" id="mycalendar"></div>
              <nav class="calendar-nav">
								<button class="calendar-create">クラス作成</button>
								<select>
								  <option>翌月へコピー</option>
								  <option>一括公開</option>
								  <option>一括非公開</option>
								  <option>一括削除</option>
								</select>
								<button>実行</button>
							</nav>
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
<div id="child" tabindex="-1" role="dialog" class="modal fade">
  <div role="document" class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">スケジュール編集</h4>
      </div>
      <div class="modal-body">
        <div id="monthly-form">

          <div class="row">
            <div class="col-sm-4 col-xs-12 mb-pc-10">
              <label>開催日</label>
              <input type="text" class="class-startdate form-control datepicker" placeholder="開催日" value="">
            </div>
            <div style="display:none;">
              <input type="text" class="class-enddate form-control datepicker" placeholder="開催日" value="">
            </div>
            <div class="col-sm-4 col-xs-6 mb-pc-10">
              <label>開始時間</label>
              <input type="text" class="class-starttime form-control timepicker" placeholder="開始時間">
            </div>
            <div class="col-sm-4 col-xs-6 mb-pc-10">
              <label>終了時間</label>
              <input type="text" class="class-endtime form-control timepicker" placeholder="終了時間">
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 mb-pc-10">
              <label>タイトル</label>
              <input type="text" class="class-name form-control" placeholder="タイトル">
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 mb-pc-10">
              <label>インストラクター</label>
              <div id="class-instructor-list">
                <ul class="calendar-instructor-ul list"></ul>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
              <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bd-calendar-instructor-modal-lg">インストラクターを追加</button>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 mb-pc-10">
              <label>クラス内容</label>
              <textarea class="class-content form-control" placeholder="クラス内容"></textarea>
            </div>
            <div class="col-xs-12 mb-pc-10">
              <label>メモ<small>※非公開</small></label>
              <textarea class="class-note form-control" placeholder="メモ欄※一般非公開"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" class="class-id" value="">
        <select class="save-select form-control">
          <option value="public">公開</option>
          <option value="private">非公開</option>
        </select>
        <button type="button" class="class-save btn btn-primary">保存</button>
        <button type="button" class="class-remove btn btn-secondary">削除</button>

        <button type="button" data-dismiss="modal" class="btn btn-default">閉じる</button>
      </div>
    </div>
  </div>
</div>
<?php include( WORKSPACE . '/include/modal-calendar-instructor.php'); ?>
<script>
var eventjson =
{
  "monthly": [
    <?php foreach($apiClass->getCalendar() as $key => $value) : ?>
    {
      <?php
      echo '"id":'.$value['calendar_id'].',
      "name":"'.$value['name'].'",
      "startdate":"'.$value['startdate'].'",
      "enddate":"'.$value['enddate'].'",
      "starttime":"'.$value['starttime'].'",
      "endtime":"'.$value['endtime'].'",
      "content":"'.$value['content'].'",
      "teacher":[';
      foreach($value['teacher'] as $val){
        echo '"'.$val.'",';
      }
      echo '],
      "note":"'.$value['note'].'",
      "color": "#FFB128",
      "url": "#"';
      ?>
    },
    <?php endforeach; ?>
  ]
};

var instructorjson =
[
<?php foreach($dataClass->getinstructor() as $key => $value) : ?>
  {
  <?php
    echo '"id":"'.$value['id'].'",
    "name":"'.$value['name'].'"';
  ?>
  },
<?php endforeach; ?>
];

</script>