<?php
class scriptClass {
    public function getGpsscript(){
        echo '
        <script>
        var myMap;
        var directionsDisplay;
        var geocoder;
        function gpSearch_display(lat,lon){
            //console.log(lat,lon)
            myMap = new google.maps.Map(document.getElementById("gpsearch-map"), {
                // ズームレベル
                zoom: 17,
                // 中心点緯度経度
                center: new google.maps.LatLng(lat, lon),
                // 距離目盛りの表示
                //scaleControl: true,
                // 地図の種類
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var gMarker = new google.maps.Marker({
                // マーカーを置く緯度経度
                position: myMap.getCenter(),
                map: myMap,
                //position: {lat: lat, lng: lon},
                //icon: "/images/icon-pin.png",
                //draggable: true
            });
            // center_changed
            google.maps.event.addListener(myMap, "center_changed", function(){
                var pos = myMap.getCenter();
                gMarker.setPosition(pos);
                $("#gpsearch-lat-input").val(pos.lat);
                $("#gpsearch-lon-input").val(pos.lng);
            });
        }
        
        function getRoute(obj){
          var latlng = obj;
          var directionsService = new google.maps.DirectionsService();
          var request = {
            origin: latlng, //入力地点の緯度、経度
            destination: myMap.getCenter(),
            travelMode: google.maps.DirectionsTravelMode.WALKING //ルートの種類
          }
          directionsService.route(request,function(result, status){
            toRender(result);
          });
        }
        function toRender(result){
          directionsDisplay = new google.maps.DirectionsRenderer();
          directionsDisplay.setDirections(result); //取得した情報をset
          directionsDisplay.setMap(myMap); //マップに描画
        }
        function getLatLng(){
            var pos = myMap.getCenter();
            //console.log(pos);
            $("#gpsearch-lat-input").val(pos.lat);
            $("#gpsearch-lon-input").val(pos.lng);
            //return false;
        }
        
        </script>
        ';
    }
}
?>
