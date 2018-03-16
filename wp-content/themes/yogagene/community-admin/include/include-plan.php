<div class="promos">  
    <div class="promo first">
        <h4>Free</h4>
        <ul class="features">
            <li class="brief">企業アカウント</li>
            <li class="price">無料</li>
            <li>Some great feature</li>
            <li>Another super feature</li>
            <li>And more...</li>
            <li class="buy"><label>選択<input type="radio" name="plan[]" class="radio-plan" value="free"></label></li>   
        </ul>
    </div>
    <div class="promo second">
        <h4>Plus</h4>
        <ul class="features">
            <li class="brief">企業アカウント</li>
            <li class="price">￥9800<small>&nbsp;/&nbsp;1ヶ月</small></li>
            <li>Some great feature</li>
            <li>Another super feature</li>
            <li>And more...</li> 
            <li class="buy"><label>選択<input type="radio" name="plan[]" class="radio-plan" value="plus"></label></li>  
        </ul>
    </div>
    <div class="promo third scale">
        <h4>Premium</h4>
        <ul class="features">
            <li class="brief">企業アカウント</li>
            <li class="price">￥2980<small>&nbsp;/&nbsp;1ヶ月</small></li>
            <li>Some great feature</li>
            <li>Another super feature</li>
            <li>And more...</li>  
            <li class="buy"><label>選択<input type="radio" name="plan[]" class="radio-plan" value="premium" checked="checked"></label></li>  
        </ul>
    </div>  
</div>
<script>
<!--
jQuery(function($){
    $('.radio-plan').on('change',function(){ 
        console.log($(this).val());
        $('.promo').removeClass('scale');
        var closest = $(this).closest('.promo').addClass('scale');
    });
});
-->
</script>