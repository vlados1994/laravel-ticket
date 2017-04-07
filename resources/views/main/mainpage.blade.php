@extends('layouts.master')
@section('title')Продажа оригинальной продукции Apple
@endsection

@section('content')
<div class="row">
	<div class="col-md-12 categories">
		<div class="description"><span class="logo">AppleMarket</span><br/>Магазин официальной продукции Apple</div>
		<ul>
			<li>
				<a id="iphone-cat">
				<img src="http://images.apple.com/v/iphone/home/r/home/images/familybrowser/iphone6s_large.png"/>
				IPhone
				</a>
			</li>
			<li>
				<a id="ipad-cat">
				<img src="http://apple.org.ru/www.apple.com/v/ipad/home/w/images/home/familybrowser/ipadpro_light_large.svg"/>
				IPad
				</a>
			</li>
		</ul>
	</div>
</div>
<div class="row">
	<div id="iphone-subcat" class="col-md-12 subcategories">
		<ul>
			<li>
				<a href="#">
					<img src="http://images.apple.com/v/iphone/home/r/home/images/familybrowser/iphone6s_large.png"/>
					iPhone 7
				</a>
			</li>
			<li>
				<a href="#">
					<img src="http://images.apple.com/v/iphone/home/r/home/images/familybrowser/iphone6s_large.png"/>
					iPhone 6s
				</a>
			</li>
			<li>
				<a href="#">
					<img src="http://images.apple.com/v/iphone/home/r/home/images/familybrowser/iphone6s_large.png"/>
					iPhone 6
				</a>
			</li>
			<li>
				<a href="#">
					<img src="http://images.apple.com/v/iphone/home/r/home/images/familybrowser/iphone5s_large.png"/>
					iPhone SE
				</a>
			</li>
			<li>
				<a href="#">
					<img src="http://images.apple.com/v/iphone/home/r/home/images/familybrowser/iphone5s_large.png"/>
					iPhone 5s
				</a>
			</li>
		</ul>
	</div>
	<div id="ipad-subcat" class="col-md-12 subcategories">
		<ul>
			<li><a href="#">
					<img src="http://apple.org.ru/www.apple.com/v/ipad/home/w/images/home/familybrowser/ipadpro_light_large.svg"/>
					iPad Pro
				</a></li>
			<li><a href="#">
					<img src="http://www.apple.com/v/ipad/home/v/home/images/familybrowser/ipadair_large.svg"/>
					iPad Air 2
				</a></li>
			<li><a href="#">
					<img src="http://www.apple.com/v/ipad/home/v/home/images/familybrowser/ipadmini_large.svg"/>
					iPad Mini 4
				</a></li>
		</ul>
	</div>
	<ul class="bxslider">
		<li><img src="/images/slide1.jpg" /></li>
		<li><img src="/images/slide2.jpg" /></li>
	</ul>
</div>
@endsection
@section('scripts')
<script src="{{asset('/js/main.js')}}"></script>
@endsection
