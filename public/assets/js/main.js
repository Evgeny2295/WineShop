
checkStorage()
function checkStorage()
{

    if(localStorage.getItem('goodsColumn') && document.querySelector('.main__goods') != null){
        const element = document.querySelector('.main__goods');
        element.classList.add('main__goods-column');
    }
    if(window.location.href == 'http://127.0.0.1:8881/category/'+localStorage.getItem('slug')){
        $.ajax({
            url:'/category/'+localStorage.getItem('alias'),
            type: 'GET',
            data:{order:localStorage.getItem('order'),name:localStorage.getItem('name')},
            success: function (res){
                show(res)
            },
            error: function (){
                console.log(window.location.href)
            }
        })
    }

}


function search() {
    //Если элемент с id-шником element_id существует
    if (document.querySelector('.header__search-form') ) {
        //Записываем ссылку на элемент в переменную obj
        var obj = document.querySelector('.header__search-form');
        var icon = document.querySelector('.header__search-icon');

        if (obj.style.display != "block") {
            obj.style.display = "block"; //Показываем элемент
            icon.style.display = "none";
        } else {
            obj.style.display = "none";
            icon.style.display = "block";
        } //Скрываем элемент
    }
}
function showCatalogList() {
    //Если элемент с id-шником element_id существует
    if (document.querySelector('.header__menu-catalog-dropdown') ) {
        //Записываем ссылку на элемент в переменную obj
        var obj = document.querySelector('.header__menu-catalog-dropdown');

        if (obj.style.display != "block") {
            obj.style.display = "block"; //Показываем элемент
        } else {
            obj.style.display = "none";
        } //Скрываем элемент
    }
}

$('#languages button').on('click',function()
{
    const lang_code = $(this).data('langcode');
    window.location = PATH +'/language/change?lang=' + lang_code
})

function doRowGoods() {
    const element = document.querySelector('.main__goods');
    element.classList.remove('main__goods-column');
    delete localStorage.goodsColumn
}
function doColumnGoods() {
    const element = document.querySelector('.main__goods');
    element.classList.add('main__goods-column');
    localStorage.setItem('goodsColumn','main__goods-column');
}

$(document).on('click','.main__filters-location-butt',function(e){
    e.preventDefault()

    const order= $(this).data('order');
    const name = $(this).data('name');
    const alias = $(this).data('alias')
    localStorage.setItem('order',order)
    localStorage.setItem('name',name)
    localStorage.setItem('alias',alias)


    $.ajax({
        url:'/category/'+alias,
        type: 'GET',
        data:{order:order,name:name},
        success: function (res){
            show(res)
        },
        error: function (){
            console.log(window.location.href)
        }
    })
})




function show(res){
    $('#main-block').replaceWith(res)
}

function showCart(res){
    $('#cart-modal .modal-cart-content').html(res)
    // получим кнопку id="btn" с помощью которой будем открывать модальное окно
    // элемент, содержащий контент модального окна (например, имеющий id="modal")
    const elemModal = document.querySelector('#cart-modal');
// активируем элемент в качестве модального окна с параметрами по умолчанию
    const modal = new bootstrap.Modal( elemModal);
    modal.show();

    if($('.cart-qty').text()){
        $('.count-items').text($('.cart-qty').text())
    }else{
        $('.count-items').text('0')
    }
}

$(document).on('click','.main__product-wishlist-add-link',function (e){
    e.preventDefault();
    const id = $(this).data('id')
    const $this = $(this)

    $.ajax({
        url:'/wishlist/add',
        type:'GET',
        data:{id:id},
        success: function (res){
            res = JSON.parse(res)
            if(res.result == 'success'){
                $this.removeClass('main__product-wishlist-add-link').addClass('main__product-wishlist-delete-link');
                $this.find('i').removeClass('far fa-heart').addClass('fas fa-thumbs-up')
            }
        },
        error:function (){
            alert('error')
        }
    })
})

$(document).on('click','.main__product-wishlist-delete-link',function (e){
    e.preventDefault();
    const id = $(this).data('id')
    const $this = $(this)

    $.ajax({
        url:'/wishlist/delete',
        type:'GET',
        data:{id:id},
        success: function (res){
            const $url = window.location.toString()
            if($url.indexOf('wishlist') !== -1){
                window.location = $url
            }else{
                res = JSON.parse(res)
            }

            if(res.result == 'success'){
                $this.removeClass('main__product-wishlist-delete-link').addClass('main__product-wishlist-add-link');
                $this.find('i').removeClass('fas fa-thumbs-up').addClass('far fa-heart')
            }
        },
        error:function (){
            alert('error')
        }
    })
})


$('#get-cart').on('click',function(e){
    e.preventDefault()

    $.ajax({
        url:'/cart/show',
        type: 'GET',
        success: function (res){
           showCart(res)
        },
        error: function (){
            console.log('ERROR')
        }
    })
})

$(document).on('click','#clear-cart',function(e){
    e.preventDefault()

    $.ajax({
        'url':'cart/destroy',
        'type':'GET',
        success:function (res){
            showCart(res)
        },
        error:function(){
            console.log('ERROR')
        }


    })
})

$(document).on('click','.main__product-addtocart-link',function (e){
    e.preventDefault()

    const id = $(this).data('id');
    const qty = $('#main__product-input-qty').val() ? $('#main__product-input-qty').val() : 1;
    const $this = $(this);

    $.ajax({
        url:'/cart/add',
        type: 'POST',
        data:{id:id,qty:qty},
        success: function (res){
            showCart(res)
            // $this.find('i').removeClass('fas fa-cart-plus').addClass('fas fa-shopping-cart')

        },
        error: function (){
            console.log('ERROR')
        }
    })
})