<?php
class apiClass {
    public function getCalendar($id = NULL){
        $array = array(
            array(
                'calendar_id' => '156',
                'startdate' => '2019-01-28',
                'enddate' => '2017-01-28',
                'starttime' => '17:00',
                'endtime' => '18:30',
                'name' => 'アーユルヴェーダ基礎講座【レギュラークラス】',
                'content' => 'アーユルヴェーダを基本とした初心者からでも楽しめるヨガクラス',
                'teacher' => array('01'),
                'note' => ''
            ),
            array(
                'calendar_id' => '213',
                'startdate' => '2018-01-24',
                'enddate' => '2018-01-24',
                'starttime' => '17:00',
                'endtime' => '18:30',
                'name' => '聖なる夜の瞑想ヨガ【特別クラス】',
                'content' => 'クリスマスイブの夜に瞑想でサンタとの出会い',
                'teacher' => array('02'),
                'note' => ''
            ),
            array(
                'calendar_id' => '13',
                'startdate' => '2018-01-24',
                'enddate' => '2018-01-24',
                'starttime' => '8:00',
                'endtime' => '10:30',
                'name' => '寒中朝ヨガクラス【レギュラークラス】',
                'content' => '真冬の早朝にカラダをほぐす',
                'teacher' => array('04'),
                'note' => 'この日は先生が嫌だと言っています'
            ),
            array(
                'calendar_id' => '4',
                'startdate' => '2018-01-26',
                'enddate' => '2018-01-28',
                'starttime' => '10:00',
                'endtime' => '19:30',
                'name' => '耐久ヨガクラス【特別クラス】',
                'content' => '3日間の耐久ヨガクラスでは、寝ず食べずの限界に挑みます',
                'teacher' => array('01'),
                'note' => ''
            ),
        );
        return $array;
    }
}
?>