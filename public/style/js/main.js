
(function ($) {
    "use strict";

    /*[ Load page ]
    ===========================================================*/
    $(".animsition").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        inDuration: 1500,
        outDuration: 800,
        linkElement: '.animsition-link',
        loading: true,
        loadingParentElement: 'html',
        loadingClass: 'animsition-loading-1',
        loadingInner: '<div class="loader05"></div>',
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: [ 'animation-duration', '-webkit-animation-duration'],
        overlay : false,
        overlayClass : 'animsition-overlay-slide',
        overlayParentElement : 'html',
        transition: function(url){ window.location.href = url; }
    });
    
    /*[ Back to top ]
    ===========================================================*/
    var windowH = $(window).height()/2;

    $(window).on('scroll',function(){
        if ($(this).scrollTop() > windowH) {
            $("#myBtn").css('display','flex');
        } else {
            $("#myBtn").css('display','none');
        }
    });

    $('#myBtn').on("click", function(){
        $('html, body').animate({scrollTop: 0}, 300);
    });


    /*==================================================================
    [ Fixed Header ]*/
    var headerDesktop = $('.container-menu-desktop');
    var wrapMenu = $('.wrap-menu-desktop');

    if($('.top-bar').length > 0) {
        var posWrapHeader = $('.top-bar').height();
    }
    else {
        var posWrapHeader = 0;
    }
    

    if($(window).scrollTop() > posWrapHeader) {
        $(headerDesktop).addClass('fix-menu-desktop');
        $(wrapMenu).css('top',0); 
    }  
    else {
        $(headerDesktop).removeClass('fix-menu-desktop');
        $(wrapMenu).css('top',posWrapHeader - $(this).scrollTop()); 
    }

    $(window).on('scroll',function(){
        if($(this).scrollTop() > posWrapHeader) {
            $(headerDesktop).addClass('fix-menu-desktop');
            $(wrapMenu).css('top',0); 
        }  
        else {
            $(headerDesktop).removeClass('fix-menu-desktop');
            $(wrapMenu).css('top',posWrapHeader - $(this).scrollTop()); 
        } 
    });


    /*==================================================================
    [ Menu mobile ]*/
    $('.btn-show-menu-mobile').on('click', function(){
        $(this).toggleClass('is-active');
        $('.menu-mobile').slideToggle();
    });

    var arrowMainMenu = $('.arrow-main-menu-m');

    for(var i=0; i<arrowMainMenu.length; i++){
        $(arrowMainMenu[i]).on('click', function(){
            $(this).parent().find('.sub-menu-m').slideToggle();
            $(this).toggleClass('turn-arrow-main-menu-m');
        })
    }

    $(window).resize(function(){
        if($(window).width() >= 992){
            if($('.menu-mobile').css('display') == 'block') {
                $('.menu-mobile').css('display','none');
                $('.btn-show-menu-mobile').toggleClass('is-active');
            }

            $('.sub-menu-m').each(function(){
                if($(this).css('display') == 'block') { console.log('hello');
                    $(this).css('display','none');
                    $(arrowMainMenu).removeClass('turn-arrow-main-menu-m');
                }
            });
                
        }
    });


    /*==================================================================
    [ Show / hide modal search ]*/
    $('.js-show-modal-search').on('click', function(){
        $('.modal-search-header').addClass('show-modal-search');
        $(this).css('opacity','0');
    });

    $('.js-hide-modal-search').on('click', function(){
        $('.modal-search-header').removeClass('show-modal-search');
        $('.js-show-modal-search').css('opacity','1');
    });

    $('.container-search-header').on('click', function(e){
        e.stopPropagation();
    });

    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.querySelector('input[name="search-product"]');
    
        searchInput.addEventListener('keyup', function () {
            const query = searchInput.value;
    
            fetch(`/search?query=${query}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                const productContainer = document.querySelector('.isotope-grid');
                productContainer.innerHTML = ''; // Kosongkan kontainer produk
    
                if (data.length > 0) {
                    data.forEach(product => {
                        // Parsing JSON gambar
                        let imagePath = 'images/default.jpg'; // Default image
                        if (product.image) {
                            const imagePaths = JSON.parse(product.image);
                            if (Array.isArray(imagePaths) && imagePaths.length > 0) {
                                imagePath = `storage/${imagePaths[0]}`; // Mengambil gambar pertama
                            }
                        }
    
                        const productElement = `
                            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
                                <div class="block2">
                                    <div class="block2-pic hov-img0">
                                        <img src="/${imagePath}" alt="Product Image" class="img-thumbnail">
                                        <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1"
                                        data-id="${product.id}"
                                        data-name="${product.name}"
                                        data-description="${product.deskripsi}"
                                        data-price="${product.price}">
                                            Quick View
                                        </a>
                                    </div>
                                    <div class="block2-txt flex-w flex-t p-t-14">
                                        <div class="block2-txt-child1 flex-col-l ">
                                            <a href="#" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                ${product.name}
                                            </a>
                                            <span class="stext-105 cl3">
                                                Rp ${Number(product.price).toLocaleString('id-ID', { minimumFractionDigits: 2 })}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        productContainer.insertAdjacentHTML('beforeend', productElement);
                    });
                } else {
                    productContainer.innerHTML = '<p>No products found</p>';
                }
            });
        });
    });
    


    /*==================================================================
    [ Isotope ]*/
    var $topeContainer = $('.isotope-grid');
    var $filter = $('.filter-tope-group');

    // filter items on button click
    $filter.each(function () {
        $filter.on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            $topeContainer.isotope({filter: filterValue});
        });
        
    });

    // init Isotope
    $(window).on('load', function () {
        var $grid = $topeContainer.each(function () {
            $(this).isotope({
                itemSelector: '.isotope-item',
                layoutMode: 'fitRows',
                percentPosition: true,
                animationEngine : 'best-available',
                masonry: {
                    columnWidth: '.isotope-item'
                }
            });
        });
    });

    var isotopeButton = $('.filter-tope-group button');

    $(isotopeButton).each(function(){
        $(this).on('click', function(){
            for(var i=0; i<isotopeButton.length; i++) {
                $(isotopeButton[i]).removeClass('how-active1');
            }

            $(this).addClass('how-active1');
        });
    });

    /*==================================================================
    [ Filter / Search product ]*/
    $('.js-show-filter').on('click',function(){
        $(this).toggleClass('show-filter');
        $('.panel-filter').slideToggle(400);

        if($('.js-show-search').hasClass('show-search')) {
            $('.js-show-search').removeClass('show-search');
            $('.panel-search').slideUp(400);
        }    
    });

    $('.js-show-search').on('click',function(){
        $(this).toggleClass('show-search');
        $('.panel-search').slideToggle(400);

        if($('.js-show-filter').hasClass('show-filter')) {
            $('.js-show-filter').removeClass('show-filter');
            $('.panel-filter').slideUp(400);
        }    
    });




    /*==================================================================
    [ Cart ]*/
    $('.js-show-cart').on('click',function(){
        $('.js-panel-cart').addClass('show-header-cart');
    });

    $('.js-hide-cart').on('click',function(){
        $('.js-panel-cart').removeClass('show-header-cart');
    });

    /*==================================================================
    [ Cart ]*/
    $('.js-show-sidebar').on('click',function(){
        $('.js-sidebar').addClass('show-sidebar');
    });

    $('.js-hide-sidebar').on('click',function(){
        $('.js-sidebar').removeClass('show-sidebar');
    });

    /*==================================================================
    [ +/- num product ]*/
    $('.btn-num-product-down').on('click', function(){
        var numProduct = Number($(this).next().val());
        if(numProduct > 0) $(this).next().val(numProduct - 1);
    });

    $('.btn-num-product-up').on('click', function(){
        var numProduct = Number($(this).prev().val());
        $(this).prev().val(numProduct + 1);
    });

    /*==================================================================
    [ Rating ]*/
    $('.wrap-rating').each(function(){
        var item = $(this).find('.item-rating');
        var rated = -1;
        var input = $(this).find('input');
        $(input).val(0);

        $(item).on('mouseenter', function(){
            var index = item.index(this);
            var i = 0;
            for(i=0; i<=index; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for(var j=i; j<item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });

        $(item).on('click', function(){
            var index = item.index(this);
            rated = index;
            $(input).val(index+1);
        });

        $(this).on('mouseleave', function(){
            var i = 0;
            for(i=0; i<=rated; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for(var j=i; j<item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });
    });
    
    /*==================================================================
    [ Show modal1 ]*/
    function formatRupiah(angka, prefix = 'Rp ') {
        if (typeof angka !== 'string') {
            angka = angka.toString();
        }
    
        let number_string = angka.replace(/[^,\d]/g, '').toString();
        let split = number_string.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    
        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
    
        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix === undefined ? rupiah : (rupiah ? prefix + rupiah : '');
    }

    $('.js-show-modal1').on('click', function(e) {
        e.preventDefault();
        
        // Ambil data dari tombol
        var id = $(this).data('id');
        var idToko = $(this).data('idtoko');
        var namaToko = $(this).data('namatoko');
        var lat = $(this).data('lat');
        var long = $(this).data('long');
        var name = $(this).data('name');
        var description = $(this).data('description');
        var price = $(this).data('price');
        var imageData = $(this).data('image'); // Ambil data gambar sebagai array
    
        if (!Array.isArray(imageData)) {
            console.error('Image data is not an array:', imageData);
            return; // Keluar dari fungsi jika bukan array
        }
    
        var formattedPrice = formatRupiah(price);
    
        // Update modal dengan data produk
        $('#productName').text(name);
        $('#productPrice').text(formattedPrice);
        $('#productDescription').text(description);
        $('#namaToko').text("by. " + namaToko);
    
        // Clear existing images in modal
        var imagePreviewContainer = $('#productImagePreview');
        imagePreviewContainer.empty();
    
        // Tampilkan gambar di modal
        imageData.forEach(function(image) {
            var imageHtml = `
                <div class="item-slick3" data-thumb="/storage/${image}">
                    <div class="wrap-pic-w pos-relative">
                        <img src="/storage/${image}" alt="IMG-PRODUCT">
                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="/storage/${image}">
                            <i class="fa fa-expand"></i>
                        </a>
                    </div>
                </div>
            `;
            imagePreviewContainer.append(imageHtml);
        });
    
        // Simpan data tambahan di elemen modal
        $('#productModal').data('idtoko', idToko);
        $('#productModal').data('namatoko', namaToko);
        $('#productModal').data('lat', lat);
        $('#productModal').data('long', long);
        $('#productModal').data('serviceid', id);
    
        // Inisialisasi ulang slick3 di dalam modal
        $('.wrap-slick3 .slick3').slick('unslick'); // Hapus inisialisasi slick sebelumnya
        $('.wrap-slick3 .slick3').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            infinite: true,
            autoplay: false,
            autoplaySpeed: 6000,
    
            arrows: true,
            appendArrows: $('.wrap-slick3-arrows'),
            prevArrow: '<button class="arrow-slick3 prev-slick3"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
            nextArrow: '<button class="arrow-slick3 next-slick3"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
    
            dots: true,
            appendDots: $('.wrap-slick3-dots'),
            dotsClass: 'slick3-dots',
            customPaging: function(slick, index) {
                var portrait = $(slick.$slides[index]).data('thumb');
                return '<img src="' + portrait + '"/><div class="slick3-dot-overlay"></div>';
            },
        });

        $('#colorSelect').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var newPrice = selectedOption.data('price');
            
            if (newPrice) {
                var totalPrice = parseInt(newPrice) + parseInt(price); // Tambahkan newPrice dengan defaultPrice
                var formattedPrice = formatRupiah(totalPrice.toString());
                $('#productPrice').text(formattedPrice);
            } else {
                // Tampilkan harga default jika tidak ada warna yang dipilih
                $('#productPrice').text(formatRupiah(defaultPrice.toString()));
            }
            });
    
        // Tampilkan modal
        $('.js-modal1').addClass('show-modal1');
    });
    
    
    $('.js-hide-modal1').on('click', function() {
        $('.js-modal1').removeClass('show-modal1');
    });

    $(document).ready(function() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
    
        // Atur token CSRF untuk setiap permintaan AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        
        // Fungsi untuk memperbarui ikon cart
        function updateCartIcon() {
            $.get('/cart', function(carts) {
                $('.icon-header-noti').attr('data-notify', carts.length);
            });
        }
    
        // Fungsi untuk memperbarui tampilan keranjang
        function updateCartView() {
            $.get('/cart/items', function(carts) {
                let cartItemsContainer = $('.header-cart-wrapitem');
                cartItemsContainer.empty();
                let total = 0;
                carts.forEach((item) => {
                    let price = parseFloat(item.price);
                    total += price * item.quantity;
                    cartItemsContainer.append(`
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img" data-id="${item.id}">
                                <img src="${item.image}" alt="IMG">
                            </div>
                            <div class="header-cart-item-txt p-t-8">
                                <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                    ${item.service.name}
                                </a>
                                <span class="header-cart-item-info">
                                    ${item.quantity} x Rp ${item.price}
                                </span>
                            </div>
                        </li>
                    `);
                });
                $('.header-cart-total').text('Total: Rp ' + total.toLocaleString('id-ID', {minimumFractionDigits: 2}));
            });
        }
    
        // Fungsi untuk menambah item ke dalam keranjang
        function addToCart(product) {
            $.ajax({
                url: '/cart/add',
                method: 'POST',
                data: product,
                success: function(response) {
                    updateCartIcon(); // Perbarui ikon cart setelah menambah item
                    updateCartView(); // Perbarui tampilan keranjang setelah menambah item
                    swal(product.name, "is added to cart!", "success");
                },
                error: function(xhr) {
                    console.log(product); // Untuk debugging error
                }
            });
        }
    
        // Fungsi untuk menghapus item dari keranjang
        function removeFromCart(id) {
            $.ajax({
                url: '/cart/remove/' + id,
                type: 'DELETE',
                success: function() {
                    updateCartIcon(); // Perbarui ikon cart setelah menghapus item
                    updateCartView(); // Perbarui tampilan keranjang setelah menghapus item
                }
            });
        }
    
        // Panggil fungsi untuk memperbarui ikon cart dan tampilan keranjang saat halaman dimuat
        updateCartIcon();
        updateCartView();
    
        // Event listener untuk menambah item ke dalam keranjang
        $('.js-addcart-detail').on('click', function() {
            var nameProduct = $('#productName').text().trim();
            var priceProduct = $('#productPrice').text().trim().replace('Rp ', '').replace('.', '').replace(',', '.');
            var productImage = $('#productImagePreview img').first().attr('src');
            var productQuantity = parseInt($('input[name="num-product"]').val().trim());
            var idToko = $('.js-modal1').data('idtoko');
            var service_id = $('.js-modal1').data('serviceid');
            var color = $('.js-modal1').data('colorSelect');
        
            let product = {
                name: nameProduct,
                price: parseFloat(priceProduct),
                image: productImage,
                quantity: productQuantity,
                toko_id: idToko,
                service_id: service_id,
                color: color
            };
            addToCart(product);
        });
    
        // Event listener untuk ikon hapus item
        $('.header-cart-wrapitem').on('click', '.header-cart-item-img', function() {
            let id = $(this).data('id');
            removeFromCart(id);
        });
    
        // Event listener untuk tombol plus dan minus
        $(document).on('click', '.btn-num-product-up', function() {
            let input = $(this).siblings('input.num-product');
            let newVal = parseInt(input.val()) + 1;
            input.val(newVal).trigger('change');
        });
    
        $(document).on('click', '.btn-num-product-down', function() {
            let input = $(this).siblings('input.num-product');
            let newVal = parseInt(input.val()) - 1;
            if (newVal > 0) {
                input.val(newVal).trigger('change');
            }
        });
    
        // Event listener untuk perubahan nilai input quantity
        $(document).on('change', 'input.num-product', function() {
            let newQuantity = parseInt($(this).val());
            let itemId = $(this).closest('tr').find('.header-cart-item-img').data('id');
    
            $.ajax({
                url: '/cart/update/' + itemId,
                type: 'PUT',
                data: { quantity: newQuantity },
                success: function() {
                    updateCartIcon(); // Perbarui ikon cart setelah memperbarui kuantitas
                    updateCartView(); // Perbarui tampilan keranjang setelah memperbarui kuantitas
                }
            });
        });
    
        // SetInterval untuk memperbarui ikon cart setiap 30 detik (opsional)
        setInterval(function() {
            updateCartIcon();
        }, 30000);
    });
    
 
    // $(document).ready(function() {
    //     var csrfToken = $('meta[name="csrf-token"]').attr('content');

    //     // Atur token CSRF untuk setiap permintaan AJAX
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': csrfToken
    //         }
    //     });
        
    //     // Fungsi untuk memperbarui ikon cart
    //     function updateCartIcon() {
    //         $.get('/cart', function(carts) {
    //             $('.icon-header-noti').attr('data-notify', carts.length);
    //             console.log(carts)
    //         });
    //     }
    
    //     // Fungsi untuk memperbarui tampilan keranjang
    //     function updateCartView() {
    //         $.get('/cart/items', function(carts) {
    //             let cartItemsContainer = $('.header-cart-wrapitem');
    //             cartItemsContainer.empty();
    //             let total = 0;
    //             carts.forEach((item, index) => {
    //                 console.log(item)
    //                 let price = parseFloat(item.price);
    //                 total += price * item.quantity;
    //                 cartItemsContainer.append(`
    //                     <li class="header-cart-item flex-w flex-t m-b-12">
    //                         <div class="header-cart-item-img" data-id="${item.id}">
    //                             <img src="${item.image}" alt="IMG">
    //                         </div>
    //                         <div class="header-cart-item-txt p-t-8">
    //                             <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
    //                                 ${item.service.name}
    //                             </a>
    //                             <span class="header-cart-item-info">
    //                                 ${item.quantity} x Rp ${item.price}
    //                             </span>
    //                         </div>
    //                     </li>
    //                 `);
    //             });
    //             $('.header-cart-total').text('Total: Rp ' + total.toLocaleString('id-ID', {minimumFractionDigits: 2}));
    //         });
    //     }
    
    //     // Fungsi untuk menambah item ke dalam keranjang
    //     function addToCart(product) {
    //         $.ajax({
    //             url: '/cart/add',
    //             method: 'POST',
    //             data: product,
    //             success: function(response) {
    //                 updateCartView(); // Perbarui tampilan keranjang setelah menambah item
    //                 swal(product.name, "is added to cart !", "success");
    //             },
    //             error: function(xhr) {
    //                 console.log(product); // Untuk debugging error
    //             }
    //         });
    //     }
    
    //     // Fungsi untuk menghapus item dari keranjang
    //     function removeFromCart(id) {
    //         $.ajax({
    //             url: '/cart/remove/' + id,
    //             type: 'DELETE',
    //             success: function() {
    //                 updateCartIcon();
    //                 updateCartView();
    //             }
    //         });
    //     }
    
    //     // Panggil fungsi untuk memperbarui ikon cart dan tampilan keranjang saat halaman dimuat
    //     updateCartIcon();
    //     updateCartView();
    
    //     $('.js-addcart-detail').on('click', function() {
    //         var nameProduct = $('#productName').text().trim();
    //         var priceProduct = $('#productPrice').text().trim().replace('Rp ', '').replace('.', '').replace(',', '.');
    //         var productImage = $('#productImagePreview img').first().attr('src');
    //         var productQuantity = parseInt($('input[name="num-product"]').val().trim());
    //         var idToko = $('.js-modal1').data('idtoko');
    //         var service_id = $('.js-modal1').data('serviceid');
        
    //         let product = {
    //             name: nameProduct,
    //             price: parseFloat(priceProduct),
    //             image: productImage,
    //             quantity: productQuantity,
    //             toko_id: idToko,
    //             service_id: service_id
    //         };
    //         addToCart(product);
    //     });
    
    //     // Event listener untuk ikon hapus item
    //     $('.header-cart-wrapitem').on('click', '.header-cart-item-img', function() {
    //         let id = $(this).data('id');
    //         removeFromCart(id);
    //     });
    
    //     // Event listener untuk tombol plus dan minus
    //     $(document).on('click', '.btn-num-product-up', function() {
    //         let input = $(this).siblings('input.num-product');
    //         let newVal = parseInt(input.val()) + 1;
    //         input.val(newVal).trigger('change');
    //     });
    
    //     $(document).on('click', '.btn-num-product-down', function() {
    //         let input = $(this).siblings('input.num-product');
    //         let newVal = parseInt(input.val()) - 1;
    //         if (newVal > 0) {
    //             input.val(newVal).trigger('change');
    //         }
    //     });
    
    //     // Event listener untuk perubahan nilai input quantity
    //     $(document).on('change', 'input.num-product', function() {
    //         let newQuantity = parseInt($(this).val());
    //         let itemId = $(this).closest('tr').find('.header-cart-item-img').data('id');
    
    //         $.ajax({
    //             url: '/cart/update/' + itemId,
    //             type: 'PUT',
    //             data: { quantity: newQuantity },
    //             success: function() {
    //                 updateCartView();
    //                 updateCartIcon();
    //             }
    //         });
    //     });
    
    // });

    $(document).ready(function() {
        // Fungsi untuk memperbarui tampilan keranjang
        function updateCartView(cart) {
            let cartItemsTable = $('#cart-items-table');
            let cartSubtotal = 0;
    
            // Kosongkan tabel sebelum mengisi ulang
            cartItemsTable.find('tr:gt(0)').remove();
    
            cart.forEach(item => {
                let itemPrice = item.price;
                let itemTotal = itemPrice * item.quantity;
                cartSubtotal += itemTotal;
    
                cartItemsTable.append(`
                    <tr class="table_row">
                        <td class="column-1">
                            <div class="how-itemcart1">
                                <img src="${item.image}" alt="IMG">
                            </div>
                        </td>
                        <td class="column-2">${item.service.name}</td>
                        <td class="column-3">Rp ${itemPrice.toLocaleString('id-ID')}</td>
                        <td class="column-4">
                        <input type="text" id="toko_id" value="${item.toko_id}" hidden>
                        <input type="text" id="service_id" value="${item.service_id}" hidden>
                        <input type="text" id="total_pembayaran" value="${itemTotal}" hidden>
                            <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                </div>
    
                                <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="${item.quantity}" id="jumlah_pesanan" data-id="${item.id}">
    
                                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                </div>
                            </div>
                        </td>
                        <td class="column-5">Rp ${itemTotal.toLocaleString('id-ID')}</td>
                        
                    </tr>
                `);
            });
    
            $('#cart-subtotal').text('Rp ' + cartSubtotal.toLocaleString('id-ID'));
            $('#cart-total').text('Rp ' + cartSubtotal.toLocaleString('id-ID'));
        }
    
        $.ajax({
            url: '/cart/items',
            method: 'GET',
            success: function(response) {
                updateCartView(response);
                updateCartIcon(response);
            }
        });
    
        // Tambahkan event listener untuk tombol plus dan minus
        $(document).on('click', '.btn-num-product-up', function() {
            let input = $(this).siblings('input.num-product');
            let newVal = parseInt(input.val()) + 1;
            input.val(newVal).trigger('change');
        });
    
        $(document).on('click', '.btn-num-product-down', function() {
            let input = $(this).siblings('input.num-product');
            let newVal = parseInt(input.val()) - 1;
            if (newVal > 0) {
                input.val(newVal).trigger('change');
            }
        });
    
        // Event listener untuk perubahan nilai input quantity
        $(document).on('change', 'input.num-product', function() {
            let itemId = $(this).data('id');
            let newQuantity = parseInt($(this).val());
    
            $.ajax({
                url: '/cart/update',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: itemId,
                    quantity: newQuantity
                },
                success: function(response) {
                    updateCartView(response.cart);
                    updateCartIcon(response.cart);
                }
            });
        });
    });
    
})(jQuery);