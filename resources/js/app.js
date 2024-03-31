import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


// khu vực sử lý dành cho category
    $('.update_category').on('click', function(e){

        let id = $(this).data('id');
        let name = $(this).data('name');

        $('#name_popup').val(name);
        $('#input_id_category').val(id);

        $('#default-modal').removeClass('hidden');
    });

    $('.cancel_popup').on('click', function(e){

        $('#name_popup').val('');
        $('#input_id_category').val('');

        $('#default-modal').addClass('hidden');
    });

    $(".delete_category").on("click", function (q) {

        let button = $(this);
        button.attr('disabled', true);

        let id = $(this).data('id');

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: deleteCategory,
            data: { id: id },
            type: "POST",
            success: function(result) {
                button.parent().parent().remove();
                alert("Xoá thành công");
                button.attr('disabled', false);
            },
            error: function(error) {
                console.log(error);
                alert("Xoá không thành công");
                button.attr('disabled', false);
            },
        });
    });
// kết thúc khu vực


// khu vực sử lý dành cho product

    $('.open_sesion_add_product').on('click', function(e){
        $('.sesion-propduct').removeClass('hidden');
        $('.close_sesion_add_product').removeClass('hidden');
        $('.open_sesion_add_product').addClass('hidden');
    });

    $('.close_sesion_add_product').on('click', function(e){
        $('.sesion-propduct').addClass('hidden');
        $('.close_sesion_add_product').addClass('hidden');
        $('.open_sesion_add_product').removeClass('hidden');
    });

    $(".delete_product").on("click", function (q) {

        let button = $(this);
        button.attr('disabled', true);

        let id = $(this).data('id');

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: deleteProduct,
            data: { id: id },
            type: "POST",
            success: function(result) {
                button.parent().parent().remove();
                alert("Xoá thành công");
                button.attr('disabled', false);
            },
            error: function(error) {
                console.log(error);
                alert("Xoá không thành công");
                button.attr('disabled', false);
            },
        });
    });

// kết thúc 1 khu vực


// clients

// Tạo một div chứa thông báo

    let shopping_cards = localStorage.getItem("shopping_cards");

    if(shopping_cards == undefined) {
        localStorage.setItem("shopping_cards", JSON.stringify([]));
    }

    let length_card = JSON.parse(localStorage.getItem("shopping_cards"));
    if(length_card.length > 0) {
        $('.count_cards').text(length_card.length);
    }

    $('.add_cards').on('click', function(e){
        console.log('add card');
        let id = $(this).data('id');
        let quantity = 1;
        let quatity_product = $('#quatity_product_detail').val();
        if(quatity_product != null && quatity_product != '' && quatity_product != undefined) {
            quantity = Number(quatity_product);
        }

        let new_product = {id: id, quantity: quantity};
        let data = localStorage.getItem("shopping_cards");
        let cards = JSON.parse(data);
        if (Array.isArray(cards)) {
            let index = cards.findIndex(item => item.id === new_product.id);
            if (index !== -1) {
                cards[index].quantity += new_product.quantity;
            } else {
                cards.push(new_product);
            }
        } else {
            cards = [new_product];
        }

        if(cards.length > 0) {
            $('.count_cards').text(cards.length);
        }

        localStorage.setItem("shopping_cards", JSON.stringify(cards));

        thongbao('Sản phẩm đã được thêm vào giỏ hàng')
    });

    let check_page_card = $('#page_shopping_card').val();
    if(check_page_card == 1) {
        let data = JSON.parse(localStorage.getItem("shopping_cards"));
        if(data.length > 0) {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: getShoppingCard,
                data: {data : data},
                type: "GET",
                success: function(result) {
                    console.log('result');
                    console.log(result);
                    let append = ``;
                    let total = 0
                    result.forEach(element => {
                        console.log(element);

                        total += (element.product.price * element.quantity);
                        append += `
                            <div class="flex items-center my-2">
                                <input type="hidden" name="id_product[]" value="${element.product.id}"/>
                                <div class="w-2/12"> <img src="/storage/${element.product.image}" class="w-16 h-16"/></div>
                                <div class="w-4/12"> ${element.product.name}</div>
                                <div class="w-3/12"> ${convertToHalfFormat(element.product.price.toString())}</div>
                                <div class="w-3/12"> SL <input type="number" data-price="${element.product.price}" name="quantity_product[]" class="quantity_product sm:w-18 w-10 rounded-lg p-2" value="${element.quantity}" min="1" max="999"></div>
                                <div><i class="fa-solid fa-trash text-blue-600 delete_product_card" data-id="${element.product.id}"></i></div>
                            </div>
                        `;
                    });

                    $('.total_amount').text(convertToHalfFormat(total.toString()));
                    $('.append_product_card').append(append);

                },
                error: function(error) {
                    console.log(error);
                },
            });
        }
    }

    $(document).on('change', '.quantity_product', function(e){
        console.log('123');
        if($(this).val() == '' || $(this).val() == 0) $(this).val(1);

        let total = 0;
        $(".quantity_product").map((index, item) => {
            let quantity = $(item).val();
            let amount = $(item).data('price');

            total += (Number(quantity) * Number(amount));
        });

        $('.total_amount').text(convertToHalfFormat(total.toString()));
    });

    $(document).on('click','.delete_product_card', function(e) {
        let id = $(this).data('id');
        let cards = JSON.parse(localStorage.getItem("shopping_cards"));
        if (Array.isArray(cards)) {
            let index = cards.findIndex(item => item.id === id);
            if (index !== -1) {
                cards.splice(index, 1)
            }
        }

        if(cards.length > 0) {
            $('.count_cards').text(cards.length);
        }

        localStorage.setItem("shopping_cards", JSON.stringify(cards));

        $(this).parent().parent().remove();

        let total = 0;
        $(".quantity_product").map((index, item) => {
            let quantity = $(item).val();
            let amount = $(item).data('price');

            total += (Number(quantity) * Number(amount));
        });

        $('.total_amount').text(convertToHalfFormat(total.toString()));
        thongbao('Sản phẩm đã được xoá khỏi giỏ hàng')
    });


    $('.detail_products').on('click', function(e){
        console.log('123');
        let id = $(this).data('id');
        window.location.href = `/detail?id=${id}`;
    });

    $(document).on('click','.submit_shopping_card', function(e) {
        e.preventDefault();
        if($('.append_product_card').find('div').length > 0) {
            var form = document.getElementById('form_submit_shopping_card');
            if (form.checkValidity()) {
                localStorage.setItem("shopping_cards", JSON.stringify([]));
                form.submit();
            } else {
                thongbao('Vui lòng điền đầy đủ thông tin.');
            }
        } else {
            thongbao('Không có sản phẩm nào trong giỏ hàng');
        }
    });

    function convertToHalfFormat(value) {
        let number = value.replace(/[！-～]/g, halfwidthChar => String.fromCharCode(halfwidthChar.charCodeAt(0) - 0xfee0));

        if(number.substring(0,3) == 'NaN') number = '0';

        let arrayNumber = number.split(',');
        let number_tem = '';

        for(let j = 0 ; j < arrayNumber.length ; j++) {
            number_tem = number_tem + arrayNumber[j];
        }

        if(Number(number_tem)) return Number(number_tem).toFixed().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        else return 0;
    }

    function thongbao(text) {
        let divThongBao = document.createElement('div');
        divThongBao.textContent = text;
        divThongBao.style.padding = '50px';
        divThongBao.style.position = 'fixed';
        divThongBao.style.backgroundColor = 'royalblue';
        divThongBao.style.top = '30vh';
        divThongBao.style.left = 'calc(50% - 200px)';
        divThongBao.style.zIndex = '9999';
        divThongBao.style.width = '400px';
        divThongBao.style.textAlign = 'center';
        divThongBao.style.borderRadius = '1rem';
        divThongBao.style.color = 'white';

        document.body.appendChild(divThongBao);

        setTimeout(function() {
            // Ẩn hoặc xóa thông báo sau 3 giây
            document.body.removeChild(divThongBao)
        }, 1000);
    }
