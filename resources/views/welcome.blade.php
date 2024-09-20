@extends('layouts.app')

@section('content')
	<!-- Slider -->
	<section class="section-slide">
		<div class="wrap-slick1">
			<div class="slick1">
				<div class="item-slick1" style="background-image: url({{asset('./style/images/slide-01.png')}});">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									Henna Latte Akad
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
									Alviona Henna
								</h2>
							</div>
						
							<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
							</div>
						</div>
					</div>
				</div>

				<div class="item-slick1" style="background-image: url({{asset('./style/images/slide-02.png')}});">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="rollIn" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									Henna Maroon
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="lightSpeedIn" data-delay="800">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
									Bismillah Henna
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="slideInUp" data-delay="1600">
							</div>
						</div>
					</div>
				</div>

				<div class="item-slick1" style="background-image: url({{asset('./style/images/slide-03.png')}});">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									Wedding Henna
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight" data-delay="800">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
									Maroon x Glitter
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- Banner -->
	<div class="sec-banner bg0 p-t-80 p-b-50">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="{{asset('./style/images/banner-04.png')}}" alt="IMG-BANNER">

						<a href="#" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									Latte
								</span>

								<span class="block1-info stext-102 trans-04">
									Henna Akad
								</span>
							</div>


						</a>
					</div>
				</div>

				<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="{{asset('./style/images/banner-05.png')}}" alt="IMG-BANNER">

						<a href="#" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									Party
								</span>

								<span class="block1-info stext-102 trans-04">
									Henna Party
								</span>
							</div>


						</a>
					</div>
				</div>

				<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="{{asset('./style/images/banner-06.png')}}" alt="IMG-BANNER">

						<a href="#" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									Maroon
								</span>

								<span class="block1-info stext-102 trans-04">
									Henna Resepsi
								</span>
							</div>


						</a>
					</div>
				</div>

				<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="{{asset('./style/images/slide-02.png')}}" alt="IMG-BANNER">

						<a href="#" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
								Latte
								</span>

								<span class="block1-info stext-102 trans-04">
									Henna Latte Full motif 
								</span>
							</div>


						</a>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					Product Overview
				</h3>
			</div>

			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-c-m m-tb-10">

					<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
						<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Search
					</div>
				</div>
				
				<!-- Search product -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>

						<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
					</div>	
				</div>

			</div>

			<div class="row isotope-grid">
				@foreach ($product as $item) 
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">

							@if ($item->image)
							@php
								$imagePaths = json_decode($item->image, true);
								$firstImagePath = $imagePaths[0] ?? null;
							@endphp
								@if ($firstImagePath)
									<img src="{{ asset('storage/' . $firstImagePath) }}" alt="Preview" class="img-thumbnail">
								@else
									<p>Tidak ada gambar yang diunggah.</p>
								@endif
							@else
								<p>Tidak ada gambar yang diunggah.</p>
							@endif

							<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1"
							data-id="{{ $item->id }}"
							data-idtoko="{{ $item->toko->id}}"
							data-namatoko="{{ $item->toko->name}}"
							data-lat="{{ $item->toko->lat}}"
							data-long="{{ $item->toko->long}}"
							data-name="{{ $item->name }}"
							data-description="{{ $item->deskripsi }}"
							data-price="{{ $item->price }}"
							data-image="{{ $item->image}}"
							>
								Quick View
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									{{$item->name}}
								</a>

								<span class="stext-105 cl3">
									Rp {{ number_format($item->price, 2) }}
								</span>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>



@endsection