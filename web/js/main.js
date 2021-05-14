$('.add-to-cart').on('click', function () {
    let id = $(this).data('id');
    $.ajax({
        url: '/cart/add',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res) alert('Ошибка!!!');
            showCart(res);
        },
        error: function () {
            alert('ERROR')
        }
    });
    return false;
});

function showCart(cart) {
    $('#modal-cart .modal-body').html(cart);
    $('#modal-cart').modal();
    let cartSum = $('#cart-sum').text() ? $('#cart-sum').text() : '$ 0';
    let cartQty = $('#cart-qty').text() ? $('#cart-qty').text() : 'Товаров: 0';
    if (cartSum) {
        $('.cart-sum').text('На сумму: $' + cartSum);
    }
    if (cartQty) {
        $('.cart-qty').text('Товаров: ' + cartQty);
    }
}

function getCart() {
    $.ajax({
        url: '/cart/show',
        type: 'GET',
        success: function (res) {
            if (!res) alert('Ошибка!!!');
            showCart(res);
        },
        error: function () {
            alert('ERROR')
        }
    });
}
function clearCart(){
    $.ajax({
        url: '/cart/clear-cart',
        type: 'GET',
        success: function (res) {
            if (!res) alert('Ошибка!!!');
            showCart(res);
        },
        error: function () {
            alert('ERROR')
        }
    });
}


$('#modal-cart .modal-body').on('click', '.del-item', function (){
    let id=$(this).data('id');
    $.ajax({
        url: '/cart/del-item',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res) alert('Ошибка!!!');
            showCart(res);
        },
        error: function () {
            alert('ERROR')
        }
    });
})

