<div class="odin_categories">
    <div class="top-buttons">
        @if($account->phone)
          <a href="tel:{{$account->phone}}" class="btn call-button">Ara</a>
        @endif
        @if($account->whatsapp)
        <a href="https://wa.me/{{$account->whatsapp}}" class="btn whatsapp-button">Whatsapp</a>
        @endif
    </div>
    @if($account->map_url)
     <a href="{{$account->map_url}}" class="btn route-button">Yol Tarifi Al</a>
    @endif
</div>
<div class="v2_menu_footer">
    <div>
        Bu menü <a target="_blank" href="https://diyezmenu.com">diyezmenu</a> altyapısı ile hazırlanmıştır.
    </div>
    <ul>
        <li>
            <a href="{{$account->instagram}}"><i class="fa fa-instagram"></i></a>
        </li>
        <li>
            <a href="{{$account->twitter}}"><i class="icon-x"></i></a>
        </li>
    </ul>
</div>

<script  src="{{asset('front/js/jquery-2.2.4.min.js')}}"></script>
<script  src="{{asset('front/js/bootstrap.min.js')}}"></script>	
<script  src="{{asset('front/js/swiper.js')}}"></script>	
<script  src="{{asset('front/js/fancybox.js')}}"></script>	
<script  src="{{asset('front/js/sticky.js')}}"></script>	
<script  src="{{asset('front/js/swiper.js')}}"></script>	
<script  src="{{asset('front/js/script.js')}}"></script>	

</body>
</html>