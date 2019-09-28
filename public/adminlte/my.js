$('.delete').click(function () {
    var res = confirm('Подтвердите действие');
    if (!res) return res;
});

// $('.del-item').on('click', function () {
//     var res = confirm('Подтвердите действие');
//     if (!res) return res;
//     var $this = $(this),
//         id = $this.data('id'),
//         src = $this.data('src');
//     $.ajax({
//        url: adminpath + '/product/delete-gallery',
//        data: {id: id, src: src},
//        type: 'POST',
//         beforeSend: function () {
//             $this.closest('.file-upload').find('.overlay').css({'display':'block'});
//         },
//         success: function (res) {
//             setTimeout(function(){
//                 $this.closest('.file-upload').find('.overlay').css({'display':'none'});
//                 if (res == 1){
//                     $this.fadeOut();
//                 }
//             }, 500);
//         },
//         error: function () {
//             setTimeout(function(){
//                 $this.closest('.file-upload').find('.overlay').css({'display':'none'});
//                 alert('Ошибка');
//                 }, 500);
//         }
//     });
// });

$('.del-item-img').on('click', function () {
    var res = confirm('Подтвердите действие');
    if (!res) return res;
    var $this = $(this),
        id = $this.data('id'),
        src = $this.data('src');
    $.ajax({
        url: adminpath + '/product/delete-img',
        data: {id: id, src: src},
        type: 'POST',
        beforeSend: function () {
            $this.closest('.file-upload').find('.overlay').css({'display':'block'});
        },
        success: function (res) {
            setTimeout(function(){
                $this.closest('.file-upload').find('.overlay').css({'display':'none'});
                if (res == 1){
                    $this.fadeOut();
                }
            }, 500);
        },
        error: function () {
            setTimeout(function(){
                $this.closest('.file-upload').find('.overlay').css({'display':'none'});
                alert('Ошибка');
            }, 500);
        }
    });
});

// $('.del-item-brand').on('click', function () {
//     var res = confirm('Подтвердите действие');
//     if (!res) return res;
//     var $this = $(this),
//         id = $this.data('id'),
//         src = $this.data('src');
//     $.ajax({
//         url: adminpath + '/brand/delete-gallery',
//         data: {id: id, src: src},
//         type: 'POST',
//         beforeSend: function () {
//             $this.closest('.file-upload').find('.overlay').css({'display':'block'});
//         },
//         success: function (res) {
//             setTimeout(function(){
//                 $this.closest('.file-upload').find('.overlay').css({'display':'none'});
//                 if (res == 1){
//                     $this.fadeOut();
//                 }
//             }, 500);
//         },
//         error: function () {
//             setTimeout(function(){
//                 $this.closest('.file-upload').find('.overlay').css({'display':'none'});
//                 alert('Ошибка');
//             }, 500);
//         }
//     });
// });

$('.del-item-img-brand').on('click', function () {
    var res = confirm('Подтвердите действие');
    if (!res) return res;
    var $this = $(this),
        id = $this.data('id'),
        src = $this.data('src');
    $.ajax({
        url: adminpath + '/brand/delete-img',
        data: {id: id, src: src},
        type: 'POST',
        beforeSend: function () {
            $this.closest('.file-upload').find('.overlay').css({'display':'block'});
        },
        success: function (res) {
            setTimeout(function(){
                $this.closest('.file-upload').find('.overlay').css({'display':'none'});
                if (res == 1){
                    $this.fadeOut();
                }
            }, 500);
        },
        error: function () {
            setTimeout(function(){
                $this.closest('.file-upload').find('.overlay').css({'display':'none'});
                alert('Ошибка');
            }, 500);
        }
    });
});

$('.sidebar-menu a').each(function () {
    var location = window.location.protocol + '//' + window.location.host + window.location.pathname;
    var link = this.href;
    if (link == location){
        $(this).parent().addClass('active');
        $(this).closest('.treeview').addClass('active');
    }
});

// CKEDITOR.replace('editor1');
$('#editor1').ckeditor();

$('#reset-filter').click(function () {
    $('#filter input[type=checkbox]').prop('checked', false);
    return false;
});

$(".select2").select2({
    placeholder: "Начните вводить наименование товара",
    minimumInputLength: 2,
    cache: true,
    ajax:{
        url: adminpath + "/product/related-product",
        delay: 250,
        dataType: 'json',
        data: function (params) {
            return {
                q: params.term,
                page: params.page
            };
        },
        processResults: function (data, params) {
            return{
                results: data.items,
            };
        },
    },
});

if ($('div').is('#single')){
    var buttonSingle = $("#single"),
        buttonMulti = $("#multi"),
        file;
}
if (buttonSingle){
    new AjaxUpload(buttonSingle, {
        action: adminpath + buttonSingle.data('url') + "?upload=1",
        data: {name: buttonSingle.data('name')},
        name: buttonSingle.data('name'),
        onSubmit: function(file, ext){
            if (! (ext && /^(jpg|png|jpeg|gif)$/i.test(ext))){
                alert('Ошибка! Разрешены только картинки');
                return false;
            }
            buttonSingle.closest('.file-upload').find('.overlay').css({'display':'block'});

        },
        onComplete: function(file, response){
            setTimeout(function(){
                buttonSingle.closest('.file-upload').find('.overlay').css({'display':'none'});

                response = JSON.parse(response);
                $('.' + buttonSingle.data('name')).html('<img src="/images/' + response.file + '" style="max-height: 150px;">');
            }, 500);
        }
    });
}

// if (buttonMulti){
//     new AjaxUpload(buttonMulti, {
//         action: adminpath + buttonMulti.data('url') + "?upload=1",
//         data: {name: buttonMulti.data('name')},
//         name: buttonMulti.data('name'),
//         onSubmit: function(file, ext){
//             if (! (ext && /^(jpg|png|jpeg|gif)$/i.test(ext))){
//                 alert('Ошибка! Разрешены только картинки');
//                 return false;
//             }
//             buttonMulti.closest('.file-upload').find('.overlay').css({'display':'block'});
//
//         },
//         onComplete: function(file, response){
//             setTimeout(function(){
//                 buttonMulti.closest('.file-upload').find('.overlay').css({'display':'none'});
//
//                 response = JSON.parse(response);
//                 $('.' + buttonMulti.data('name')).append('<img src="/images/' + response.file + '" style="max-height: 150px;">');
//             }, 500);
//         }
//     });
// }

//Модификации

$('#modif-groupe').on('change', '#mod_check', function () {
    if(this.checked){
        $('#modifmodif').append('<a href="#" id="modif_add" class="btn btn-success pull-right add-modif">Добавить поле</a>\n' +'<div class="row mod-del">\n' +
            '                                        <div class="col-xs-3" id="modif_title">\n' +
            '                                            <input type="text" name="modif[title][]" class="form-control" placeholder="Наименование">\n' +
            '                                        </div>\n' +
            '                                        <div class="col-xs-2" id="modif_price">\n' +
            '                                            <input type="text" name="modif[price][]" class="form-control" placeholder="цена(только цифры)">\n' +
            '                                        </div>\n' +
            '                                        <div class="col-xs-2" id="modif_old_price">\n' +
            '                                            <input type="text" name="modif[old_price][]" class="form-control" placeholder="Старая цена(только цифры)">\n' +
            '                                        </div>\n' +
            '                                        <i class="fa fa-fw fa-remove text-danger delete-modif"></i>\n' +
            '                                    </div>\n');
    }else {
        $('.mod-del, #modif_add').remove();
    }

});

$('#modif-groupe').on('click','#modif_add', function () {
    $('#modifmodif').append('<div class="row mod-del">\n' +
        '                                        <div class="col-xs-3" id="modif_title">\n' +
        '                                            <input type="text" name="modif[title][]" class="form-control" placeholder="Наименование">\n' +
        '                                        </div>\n' +
        '                                        <div class="col-xs-2" id="modif_price">\n' +
        '                                            <input type="text" name="modif[price][]" class="form-control" placeholder="цена(только цифры)">\n' +
        '                                        </div>\n' +
        '                                        <div class="col-xs-2" id="modif_old_price">\n' +
        '                                            <input type="text" name="modif[old_price][]" class="form-control" placeholder="Старая цена(только цифры)">\n' +
        '                                        </div>\n' +
        '                                        <i class="fa fa-fw fa-remove text-danger delete-modif"></i>\n' +
        '                                    </div>');
    return false;
});

$('#modif-groupe').on('click','.delete-modif', function () {
    event.stopPropagation();
    $(this).parent().fadeOut(function(){
        $(this).remove();
    });
});

// Конец модификаций

//контент продукта

$('#prod_content').on('change', '#content_check', function () {
    if(this.checked){
        $('#content_prod_all').append('<a href="#" id="content_add" class="btn btn-success pull-right add-content">Добавить поле</a>\n' +'<div class="row con-del">\n' +
            '                                        <div class="col-xs-3" id="content_title">\n' +
            '                                            <input type="text" name="prodCont[title][]" class="form-control" placeholder="Наименование">\n' +
            '                                        </div>\n' +
            '                                        <div class="col-xs-2" id="content_price">\n' +
            '                                            <input type="text" name="prodCont[value][]" class="form-control" placeholder="Кол-во">\n' +
            '                                        </div>\n' +
            '                                        <i class="fa fa-fw fa-remove text-danger delete-content"></i>\n' +
            '                                    </div>\n');
    }else {
        $('.con-del, #content_add').remove();
    }

});

$('#prod_content').on('click','#content_add', function () {
    $('#content_prod_all').append('<div class="row con-del">\n' +
        '                                        <div class="col-xs-3" id="content_title">\n' +
        '                                            <input type="text" name="prodCont[title][]" class="form-control" placeholder="Наименование">\n' +
        '                                        </div>\n' +
        '                                        <div class="col-xs-2" id="content_price">\n' +
        '                                            <input type="text" name="prodCont[value][]" class="form-control" placeholder="Кол-во">\n' +
        '                                        </div>\n' +
        '                                        <i class="fa fa-fw fa-remove text-danger delete-content"></i>\n' +
        '                                    </div>');
    return false;
});

$('#prod_content').on('click','.delete-content', function () {
    event.stopPropagation();
    $(this).parent().fadeOut(function(){
        $(this).remove();
    });
});

// Конец контента продукта

//Блокировка кнопки отправить если не выбран категория или бренд
$('#add').on('submit', function(){

    if(!isNumeric( $('#category_id').val() )){
        alert('Выберите категорию');
        return false;
    }
});

function isNumeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

// конец блокировки кнопки отправить

/*search*/
var products = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        wildcard: '%QUERY',
        url: adminpath + '/search/typeahead?query=%QUERY'
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
    window.location = adminpath + '/search/?s=' + encodeURIComponent(suggestion.title);
});

/*end search*/






