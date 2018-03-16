<?php
class createData {
    public function yearmonthArray(){
        $start = strtotime('1940/01/01');
        $end = strtotime(date('Y/m/d'));
        $ret=array();
        $temp = $end;
        while($temp >= $start){
            $ret[(date('Y', $temp))][date('m',$temp)] = date('Y-m', $temp);
            $temp = strtotime('-1 month', $temp);
        }// end while
        return $ret;
    }
    public function yearmonthSelect(){
        $ym = $this->yearmonthArray();
        echo '<select class="select2_group form-control">';
        foreach ($ym as $year => $month) {
            echo '<optgroup label="'.$year.'年">';
            foreach ($month as $key => $value) {
                echo '<option value="'.$value.'">'.$year.'年'.$key.'月</option>';
            }
            echo '</optgroup>';
        }
        
        
        echo '</select>';
    }
    public function interviewSelect( $que = NULL ){
        $array = array(
            '質問を選択してください',
            'ヨガを始めたきっかけは？',
            'ヨガを始めて何が変わりましたか？',
            'あなたにとってヨガとは？',
            '日々のレッスンで心がけていることは？',
            'これからヨガを始める方へ一言。',
            'あなたのヨガの師は？',
            '好きな言葉は？',
            '好きなカラーは？',
            '好きなポーズは？',
            '苦手なポーズは？',
            '海外でオススメの先生もしくはスタジオは？',
            '休日の過ごし方や、あなたにとってのリラックス方法は？',
            'おすすめアイテムは？',
            'おすすめショップは？',
            'おすすめスポット、または思い出の場所は？',
            'あなたが認めるお勧めインストラクターは？',
            'あなたのお勧めのスタジオまたはクラスは？',
            'ヨガの他に興味のあるものは？'
        );
        $option = NULL;
        foreach($array as $key => $value){
            if(!is_null($que) && $que == $key){
                $option .= '<option value="'.$key.'" selected>'.$value.'</option>';
            }else{
                $option .= '<option value="'.$key.'">'.$value.'</option>';
            }
        }
        return $option;
    }
    
    public function weekSelect(){
        $array = array(
            '平日',
            '祝日',
            '月',
            '火',
            '水',
            '木',
            '金',
            '土',
            '日'
        );
        $option = NULL;
        foreach($array as $key => $value){
            $option .= '<option value="'.$key.'">'.$value.'</option>';
        }
        return $option;
    }
    
    public function prefSelect($num = NULL){
        $array = $this->prefArray();
        $option = NULL;
        foreach($array as $key => $value){
            if($num == $key) {
                $option .= '<option value="'.$key.'" selected="true">'.$value.'</option>';
            } else {
                $option .= '<option value="'.$key.'">'.$value.'</option>';
            }
        }
        return $option;
    }
    
    public function prefArray($id = NULL){
        $array = array(
            '1'=>'北海道', '2'=>'青森県', '3'=>'岩手県', '4'=>'宮城県', '5'=>'秋田県', 
            '6'=>'山形県', '7'=>'福島県', '8'=>'茨城県', '9'=>'栃木県', '10'=>'群馬県', 
            '11'=>'埼玉県', '12'=>'千葉県', '13'=>'東京都', '14'=>'神奈川県', '15'=>'新潟県', 
            '16'=>'富山県', '17'=>'石川県', '18'=>'福井県', '19'=>'山梨県', '20'=>'長野県', 
            '21'=>'岐阜県', '22'=>'静岡県', '23'=>'愛知県', '24'=>'三重県', '25'=>'滋賀県', 
            '26'=>'京都府', '27'=>'大阪府', '28'=>'兵庫県', '29'=>'奈良県', '30'=>'和歌山県', 
            '31'=>'鳥取県', '32'=>'島根県', '33'=>'岡山県', '34'=>'広島県', '35'=>'山口県', 
            '36'=>'徳島県', '37'=>'香川県', '38'=>'愛媛県', '39'=>'高知県', '40'=>'福岡県', 
            '41'=>'佐賀県', '42'=>'長崎県', '43'=>'熊本県', '44'=>'大分県', '45'=>'宮崎県', 
            '46'=>'鹿児島県', '47'=>'沖縄県'
        );
        if($id != NULL) {
            return $array[$id];
        }
        return $array;
    }
    
    public function lineSelect(){
        $array = array(
            
        );
    }
    
    public function styleArray(){
        $array = array(
            'hotyoga' => array('ホットヨガ'),
            'iyengaryoga' => array('アイアンガーヨガ'),
            'ashtangayoga' => array('アシュタンガヨガ'),
            'anusarayoga' => array('アヌサラヨガ'),
            'aromayoga' => array('アロマヨガ'),
            'ishtayoga' => array('イシュタヨガ'),
            'sivanandayoga' => array('シヴァナンダヨガ'),
            'hathayoga' => array('ハタヨガ'),
            'poweryoga' => array('パワーヨガ'),
            'maternityyoga' => array('マタニティヨガ'),
            'kotsubankyouseiyoga' => array('骨盤矯正ヨガ')
        );
        return $array;
    }
}

?>