/* input[type="number"]*/
$(document).ready(function() {
    $('body').on('click','.minus',function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $('body').on('click','.plus',function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });
});

/*filters*/
$('body').on('change', '.w_sidebar input', function () {
        var checked = $('.w_sidebar input:checked'),
            data = '';
        checked.each(function () {
            data += this.value + ',';
        });
        if (data){
            $.ajax({
                url: location.href,
                data:{filter: data},
                type: 'GET',
                beforeSend: function () {
                    $('.preloader').fadeIn(300, function () {
                        $('.product-one-cat').hide();
                    });
                },
                success: function (res) {
                        $('.preloader').delay(150).fadeOut('slow', function () {
                            $('.product-one-cat').html(res).fadeIn();
                            var url = location.search.replace(/filter(.+?)(&|$)/g, ''); //$2
                            var newURL = location.pathname + url + (location.search ? "&" : "?") + "filter=" + data;
                            newURL = newURL.replace('&&', '&');
                            newURL = newURL.replace('?&', '?');
                            history.pushState({}, '', newURL);
                        });
                },
                error: function () {
                    alert('Ошибка!');
                }
            });
        }else {
            window.location = location.pathname;
        }
});
/*end filters*/

/*search*/
var products = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        wildcard: '%QUERY',
        url: path + '/search/typeahead?query=%QUERY'
    }
});

products.initialize();

$("#typeahead").typeahead({
    // hint: false,
    highlight: true
},{
    name: 'products',
    display: 'title',
    limit: 10,
    source: products
});

$('#typeahead').bind('typeahead:select', function(ev, suggestion) {
    // console.log(suggestion);
    window.location = path + '/search/?s=' + encodeURIComponent(suggestion.title);
});

/*end search*/

/*cart*/
$('body').on('click', '.add-to-cart-link', function (e) {
    e.preventDefault();
    var id = $(this).data('id'),
        qty = $('.quantity input[data-id='+ id +']').val() ? $('.quantity input[data-id='+ id +']').val() : 1,
        thisElem = $('.option select[data-id='+ id +']'),
        mod = $(thisElem).val();
    $.ajax({
        url: '/cart/add',
        data: {id: id, qty: qty, mod: mod},
        type: 'GET',
        success: function (res) {
                showCart(res);
            var allPrice = $('.cart-sum').data('price'),
                shopAll = $('.shop_sum');
            $(shopAll).text(symbolLeft + ' ' + allPrice + ' ' + symbolRight);

        },
        error:function () {
            alert('Ошибка! Попробуйте позже');
        }
    });
});

$('body').on('click', '.add-to-cart-link_dop', function (e) {
    e.preventDefault();
    var id = $(this).data('id'),
        qty = $('.quantity input').val() ? $('.quantity input').val() : 1,
        thisElem = $('.option_dop select[data-id='+ id +']'),
        mod = $(thisElem).val();
    $.ajax({
        url: '/cart/add',
        data: {id: id, qty: qty, mod: mod},
        type: 'GET',
        success: function (res) {
            showCart(res);
        },
        error:function () {
            alert('Ошибка! Попробуйте позже');
        }
    });
});

$('#cart .modal-cart').on('click', '.del-item', function () {
   var id = $(this).data('id');
    $.ajax({
        url: '/cart/delete',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            showCart(res);
        },
        error:function () {
            alert('Ошибка!');
        }
    });
});

$('.cart_upr').on('change', 'input[type="text"]', function () {
    var id = $(this).data('id'),
        qty = $(this).val();
    $.ajax({
        url: '/cart/changeQty',
        data: {id: id, qty: qty},
        type: 'GET',
        success: function (res) {
            showCart(res);
           var newPriceElem = $('.new_price_cart[data-id='+ id +']'),
               priceElemCart = $('.pr_total div[data-id='+ id +']'),
               allPrice = $('.cart-sum').data('price'),
               shopAll = $('.shop_sum'),
               newPrice = newPriceElem.data('price');
            if (newPrice){
                $(priceElemCart).text(symbolLeft + ' ' + newPrice + ' ' + symbolRight);
                $(shopAll).text(symbolLeft + ' ' + allPrice + ' ' + symbolRight);
            }
        },
        error:function () {
            alert('Ошибка!');
        }
    });
});

$('.modal-cart').on('change', '.qty_modal input[type="text"]', function () {
    var id = $(this).data('id'),
        qty = $(this).val();
    console.log(id);
    $.ajax({
        url: '/cart/changeQty',
        data: {id: id, qty: qty},
        type: 'GET',
        success: function (res) {
            showCart(res);
            var newPriceElem = $('.new_price_cart[data-id='+ id +']'),
                priceElemCart = $('.pr_total div[data-id='+ id +']'),
                allPrice = $('.cart-sum').data('price'),
                shopAll = $('.shop_sum'),
                newPrice = newPriceElem.data('price');
            if (newPrice){
                $(priceElemCart).text(symbolLeft + ' ' + newPrice + ' ' + symbolRight);
                $(shopAll).text(symbolLeft + ' ' + allPrice + ' ' + symbolRight);
            }
        },
        error:function () {
            alert('Ошибка!');
        }
    });
});

function showCart(cart){
        $('#cart .modal-cart').html(cart);
        if ($('.cart-sum').text()){
            $('.simpleCart_total').html($('#cart .cart-sum').text());
            $('span.simpleCart_total').css('fontSize','22px');
        }else {
            $('.simpleCart_total').text('В корзине пусто :(');
            $('span.simpleCart_total').css('fontSize','14px');
        }
}

function getCart(){
    $.ajax({
        url: '/cart/show',
        type: 'GET',
        success: function (res) {
            showCart(res);
        },
        error:function () {
            alert('Ошибка! Попробуйте позже');
        }
    });
}

function clearCart(e){
    $.ajax({
        url: '/cart/clear',
        type: 'GET',
        success: function (res) {
            showCart(res);
        },
        error:function () {
            alert('Ошибка! Попробуйте позже');
        }
    });
}

/*end cart*/
$('#currency').change(function () {
    window.location = 'currency/change?curr=' + $(this).val();
});

$('body').on('change','.option select', function () {
    var modId = $(this).val(),
        id = $(this).data('id'),
        thisElem = $('.option select[data-id='+ id +']'),
        color = $(thisElem).find('option').filter(':selected').data('title'),
        price = $(thisElem).find('option').filter(':selected').data('price'),
        priceold = $(thisElem).find('option').filter(':selected').data('priceold'),
        elembase = $('.base_price[data-id='+ id +']'),
        elembaseold = $('.base_price_old[data-id='+ id +']'),
        elembasedel = $('.base-price-del[data-id='+ id +']'),
        basePrice = $(elembase).data('base'),
        basePriceOld = $(elembaseold).data('baseold');

    if (price || price == 0){
        $(elembase).text(symbolLeft + ' ' + price + ' ' + symbolRight);
    }else {
        $(elembase).text(symbolLeft + ' ' + basePrice + ' ' + symbolRight);
    }

    if (priceold){
        $(elembaseold).text(symbolLeft + ' ' + priceold + ' ' + symbolRight);
    }else if(price || price == 0){
        $(elembaseold).text(' ');
    }else {
        $(elembaseold).text(symbolLeft + ' ' + basePriceOld + ' ' + symbolRight);
    }

    if (priceold){
        $(elembasedel).text(symbolLeft + ' ' + priceold + ' ' + symbolRight);
    }else {
        $(elembasedel).text(' ');
    }

});

$('body').on('change','.dop_block .option_dop select', function () {
    var modId = $(this).val(),
        id = $(this).data('id'),
        thisElem = $('.option_dop select[data-id='+ id +']'),
        color = $(thisElem).find('option').filter(':selected').data('title'),
        price = $(thisElem).find('option').filter(':selected').data('price'),
        priceold = $(thisElem).find('option').filter(':selected').data('priceold'),
        elembase = $('.dop_block .base_price_dop[data-id='+ id +']'),
        elembaseold = $('.dop_block .base_price_old_dop[data-id='+ id +']'),
        elembasedel = $('.dop_block .base-price-del_dop[data-id='+ id +']'),
        basePrice = $(elembase).data('base'),
        basePriceOld = $(elembaseold).data('baseold');

    if (price || price == 0){
        $(elembase).text(symbolLeft + ' ' + price + ' ' + symbolRight);
    }else {
        $(elembase).text(symbolLeft + ' ' + basePrice + ' ' + symbolRight);
    }

    if (priceold){
        $(elembaseold).text(symbolLeft + ' ' + priceold + ' ' + symbolRight);
    }else if(price || price == 0){
        $(elembaseold).text(' ');
    }else {
        $(elembaseold).text(symbolLeft + ' ' + basePriceOld + ' ' + symbolRight);
    }

    if (priceold){
        $(elembasedel).text(symbolLeft + ' ' + priceold + ' ' + symbolRight);
    }else {
        $(elembasedel).text(' ');
    }

});

// Can also be used with $(document).ready()
$(window).load(function() {
    $('.flexslider').flexslider({
        animation: "fade",
        controlNav: true,
        directionNav: true,
        prevText: "Назад",
        nextText: "Вперед",
        touch: true,
        slideshowSpeed: 3000,
    });
});

$(function() {

    var menu_ul = $('.menu_drop > li > ul'),
        menu_a  = $('.menu_drop > li > a');

    menu_ul.hide();

    menu_a.click(function(e) {
        e.preventDefault();
        if(!$(this).hasClass('active')) {
            menu_a.removeClass('active');
            menu_ul.filter(':visible').slideUp('normal');
            $(this).addClass('active').next().stop(true,true).slideDown('normal');
        } else {
            $(this).removeClass('active');
            $(this).next().stop(true,true).slideUp('normal');
        }
    });

});

// slick this start
$(document).ready(function(){
    $('.slick-product').slick({
        dots: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
        // setting-name: setting-value
    });
});

$(document).ready(function(){
    $('.slick-brands').slick({
        dots: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3500,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
        // setting-name: setting-value
    });
});

$(document).ready(function(){
    $('.slick-menu').slick({
        dots: false,
        infinite: true,
        adaptiveHeight: true,
        variableWidth: true,
        speed: 3000,
        slidesToShow: 6,
        slidesToScroll: 2,
        autoplay: true,
        autoplaySpeed: 3500,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 6,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 2
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
});

// slick this end

// You can also use "$(window).load(function() {"
$(function () {
    // Slideshow 4
    $("#slider4").responsiveSlides({
        auto: true,
        pager: true,
        nav: true,
        speed: 500,
        namespace: "callbacks",
        before: function () {
            $('.events').append("<li>before event fired.</li>");
        },
        after: function () {
            $('.events').append("<li>after event fired.</li>");
        }
    });

});

// open alltext on main product

$("body").on('click','.opendes',function() {
    var id = $(this).data('id'),
        elemopen = $('.opendes[data-id='+ id +']'),
        elemclose = $('.closedes[data-id='+ id +']'),
        elemdesc = $('.desc[data-id='+ id +']');
    $(elemopen).hide();
    $(elemclose).show();
    $(elemdesc).addClass("activedesc");
    return false;
});
$("body").on('click','.closedes',function() {
    var id = $(this).data('id'),
        elemopen = $('.opendes[data-id='+ id +']'),
        elemclose = $('.closedes[data-id='+ id +']'),
        elemdesc = $('.desc[data-id='+ id +']');
    $(elemclose).hide();
    $(elemopen).show();
    $(elemdesc).removeClass("activedesc");
    return false;
});

// open alltext on main product

// open allprod on main cat

jQuery(document).ready(function($) {

    $(".open").click(function() {
        var id = $(this).data('id'),
            elemcat = $('.cat[data-id='+ id +']'),
            elemopen = $('.open[data-id='+ id +']'),
            elemclosed = $('.closed[data-id='+ id +']'),
            elemnoac = $('.cat[data-id='+ id +'] .noactive');

        $(elemnoac).removeClass("noactive").addClass("active");
        $(elemopen).addClass("noactive");
        $(elemclosed).removeClass("noactive");

        return false;
    });
    $(".closed").click(function() {

        var id = $(this).data('id'),
            elemcat = $('.cat[data-id='+ id +']'),
            elemopen = $('.open[data-id='+ id +']'),
            elemclosed = $('.closed[data-id='+ id +']'),
            elemnoac = $('.cat[data-id='+ id +'] .active');

        $(elemnoac).removeClass("active").addClass("noactive");
        $(elemopen).removeClass("noactive");
        $(elemclosed).removeClass("active").addClass("noactive");
        return false;
    });
});

// open allprod on main cat end

//dop_block this
$("body").on('click','.dop_inf',function() {
    var id = $(this).data('id'),
        elemactive = $('.active_close[data-id='+ id +']'),
        elemdopblock = $('.dop_block[data-id='+ id +']');

    $(elemactive).removeClass("active_close").addClass("noactivedop");
    $(elemdopblock).removeClass("noactivedop").addClass("active_close");

    return false;
});
$("body").on('click','.imgdp',function() {

    var id = $(this).data('id'),
        elemactive = $('.active_close[data-id='+ id +']'),
        elemdopblock = $('.dop_block[data-id='+ id +']');

    $(elemactive).removeClass("active_close").addClass("noactivedop");
    $(elemdopblock).removeClass("noactivedop").addClass("active_close");

    return false;
});

$("body").on('click','.close',function() {

    var id = $(this).data('id'),
        elemactive = $('.active_close[data-id='+ id +']');

    $(elemactive).removeClass("active_close").addClass("noactivedop");
    return false;
});

$("body").on('click','.close_img',function() {

    var id = $(this).data('id'),
        elemactive = $('.active_close[data-id='+ id +']');

    $(elemactive).removeClass("active_close").addClass("noactivedop");
    return false;
});


//dop_block this end

// scroll start
$(document).ready(function(){
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('.top_block').addClass('topnol');
            $('.top_menu').hide();
            $('.noslidre').addClass('nspk');
            $('.menu-container').addClass('topnol');
        } else if($(this).scrollTop() == 0) {
            $('.top_block').removeClass('topnol');
            $('.menu-container').removeClass('topnol');
            $('.top_menu').show();
            $('.noslidre').removeClass('nspk');
        }
    });
});

// scroll end

//filter checked
$('body').on('click','.filter_group input[type="radio"]', function () {
    $('.filter_group label input[type="radio"]').parent().removeClass('filtercheck');
    $('.filter_group label input[type="radio"]:checked').parent().addClass('filtercheck');
});

// filter checked end

//order start
$('body').on('change','.order_block .time_order input[type="radio"]', function () {
    if ($('#time').hasClass('noactive')){
        $('#time').removeClass('noactive');
        $('#time').addClass('active');
        $('#time').prop('disabled',false);
    }else {
        $('#time').removeClass('active');
        $('#time').addClass('noactive');
        $('#time').prop('disabled',true);
    }
});

$('body').on('change','.order_block .buy_order .cart_cash_order input[type="radio"]', function () {
    if ($('#delivery_courier').hasClass('noactive')){
        $('#delivery_courier').removeClass('noactive');
        $('#delivery_courier').addClass('active');
        $('#delivery_courier input[type="radio"]').prop('disabled',false);
    }else {
        $('#delivery_courier').removeClass('active');
        $('#delivery_courier').addClass('noactive');
        $('#delivery_courier input[type="radio"]').prop('disabled',true);
    }
});

$('body').on('change','#delivery_courier input[type="radio"]', function () {
    if ($('.change_money').hasClass('noactive')){
        $('.change_money').removeClass('noactive');
        $('.change_money').addClass('active');
        $('.change_money input[type="text"]').prop('disabled',false);
    }else {
        $('.change_money').removeClass('active');
        $('.change_money').addClass('noactive');
        $('.change_money input[type="text"]').prop('disabled',true);
    }
});

$('body').on('change','.how_delivery input[type="radio"]', function () {
    if ($('.pickup').hasClass('noactive')){
        $('.pickup').removeClass('noactive');
        $('.pickup').addClass('active');
        $('.pickup select').prop('disabled',false);
        $('.pickup input').prop('disabled',false);
        $('.delivery').addClass('noactive');
        $('.bottom_order').css('display','none');
        $('.delivery input').prop('disabled',true);
        $('.delivery .address_required').prop('required',false);

    }else {
        $('.pickup').removeClass('active');
        $('.pickup').addClass('noactive');
        $('.pickup select').prop('disabled',true);
        $('.pickup input').prop('disabled',true);
        $('.delivery').removeClass('noactive');
        $('.delivery').addClass('active');
        $('.bottom_order').css('display','flex');
        $('.delivery input').prop('disabled',false);
        $('.delivery .address_required').prop('required',true);
    }
});

$('body').on('click','.how_delivery input[type="radio"]', function () {
    $('.how_delivery label input[type="radio"]').parent().removeClass('delivery_check');
    $('.how_delivery label input[type="radio"]:checked').parent().addClass('delivery_check');
});

//order end

//modal order start
function getModal(){
   $('#form_order_q').css('display','block');
    $('#form_order_q input').prop('disabled',false);
    $('#form_order_q input').prop('required',true);
}

function closeModal(){
    $('#form_order_q').css('display','none');
    $('#form_order_q input').prop('disabled',true);
    $('#form_order_q input').prop('required',false);
}
//modal order end

// buy modal

$(document).ready(function() {
    if ($.cookie('modal_shown') == null) {
        $.cookie('modal_shown', 'yes', { expires: 1, path: '/' });
        setTimeout(getModalBuy,3000);
        setTimeout(getBuyButton,3000);
    }else {
        setTimeout(getBuyButton,0);
    }
});

function closeModalBuy(){
    $('#form_buy').css('display','none');
    $('#form_buy input').prop('disabled',true);
    $('#form_buy input').prop('required',false);
}

function getModalBuy(){
    $('#form_buy').css('display','block');
    $('#form_buy input').prop('disabled',false);
    $('#form_buy input').prop('required',true);
}

function getBuyButton(){
    $('.buy_btn').css('display','block');
}
// buy modal end