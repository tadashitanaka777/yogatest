<?php
namespace Manage\user;

use Manage\PayUser;

require_once('../../vendor/autoload.php');
require_once("../../payjp-php/vendor/autoload.php");

if (is_user_logged_in()) {
    $pu = new PayUser;
    $userinfo = wp_get_current_user();
    $ui = $pu->getUserPayinfo($userinfo);
    var_dump($ui);
}
    ?>

 <html>
 <head>
   <meta charset="utf-8">
   <meta content="width=device-width,initial-scale=1.0" name="viewport">
   <title></title>
   <script
              src="https://code.jquery.com/jquery-1.12.4.min.js"
              integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
              crossorigin="anonymous"></script>
   <script type="text/javascript" src="https://js.pay.jp/"></script>
   <link rel="stylesheet" href="//oss.maxcdn.com/semantic-ui/2.0.7/semantic.min.css" type="text/css" media="screen" charset="utf-8">
   <link rel="stylesheet" href="https://raw.githubusercontent.com/daneden/animate.css/master/animate.min.css" media="screen" title="no title" charset="utf-8">
   <style media="screen">
     section {
       margin: 15px;
       max-width: 960px;
     }
   </style>
 </head>
 <body>
     <div class="ui stackable left aligned page grid">
   <div class="fourteen wide column">
       <div class="ui four column grid">
               <div class="row">
                 <div class="column"><?php
                    if (is_user_logged_in()) {
                        echo 'ログイン中<br />';
                        // var_dump($umeta);
                    } else {
                        echo 'ログインしてください。<br />';
                          exit;
                    }
                ?></div>
                 <div class="column">
                        <?php
                        echo "wpuser:";
                        echo $ui->id;
                        ?>
                 </div>
                 <div class="column">
                        <?php
                        echo "email:";
                        echo $ui->email;

                        ?>
                 </div>
               </div>
        </div>
       <hr>
       <a href="javascript:history.back();">戻る</a>
  <section>
    <form class="ui form">
      <h4 class="ui dividing header">支払い</h4>

      <div class="field">
        <label>カード番号</label>
        <input type="text" name="number" maxlength="16" placeholder="Card #">
      </div>

      <div class="fields">
        <div class="six wide field">
          <label>CVC</label>
          <input type="text" name="cvc" maxlength="4" placeholder="CVC">
        </div>
        <div class="ten wide field">
          <label>有効期限</label>
          <div class="two fields">
            <div class="field">
              <select class="ui fluid search dropdown" name="exp_month">
                <option value="">月</option>
                <option value="1">01</option>
                <option value="2">02</option>
                <option value="3">03</option>
                <option value="4">04</option>
                <option value="5">05</option>
                <option value="6">06</option>
                <option value="7">07</option>
                <option value="8">08</option>
                <option value="9">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select>
            </div>
            <div class="field">
              <input type="text" name="exp_year" maxlength="4" placeholder="年">
            </div>
          </div>
        </div>
      </div>
      <button class="ui button fill" tabindex="0">
        サンプルのカード番号を使う
      </button>
      <button class="ui primary button submit">
        送信
      </button>
      <p id="result"></p>
    </form>
  </section>
  <script type="text/javascript">
    (function() {
      var number = document.querySelector('input[name="number"]'),
          cvc = document.querySelector('input[name="cvc"]'),
          exp_month = document.querySelector('select[name="exp_month"]'),
          exp_year = document.querySelector('input[name="exp_year"]')
      ;
      document.querySelector('.fill').addEventListener('click', function(e) {
        e.preventDefault();
        number.value = '4242424242424242';
        cvc.value = '123';
        exp_month.value = '12';
        exp_year.value = '2020';
      });
      document.querySelector('.submit').addEventListener('click', function(e) {
        e.preventDefault();

        Payjp.setPublicKey('pk_test_2f16e4640c027097d102b692');
        var card = {
          number: number.value,
          exp_month: exp_month.value,
          exp_year: exp_year.value
        }
        Payjp.createToken(card, function(s, response) {
          // document.getElementById('result').innerText = 'Token = ' + response.id;
          // alert(response.id);
          if(response.id){
              $('input[name="talkenId"]').val(response.id);
              $('#regist').submit();
          }else{
              document.getElementById('result').innerText = '利用できません。確認してください。';

          }
        });
      });
    })();
  </script>
  <section>
      <form id="regist" class="ui form" action="./customerRegist.php" method="post">
      <div class="field">
          <input type="text" name="email"  value="<?=$ui->email?>">
          <input type="text" name="description"  value="<?=$ui->id?>">
          <input type="text" name="talkenId"  placeholder="talkenId #">
          <!-- <button class="ui primary button submit ">
            送信
        </button> -->
      </div>
  </form>
  </section>
</div>
</div>
</body>
</html>
