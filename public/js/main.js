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
            thongbao('Xoá thành công');
            button.attr('disabled', false);
        },
        error: function(error) {
            console.log(error);
            thongbao('Xoá không thành công');
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
            thongbao('Xoá thành công');
            button.attr('disabled', false);
        },
        error: function(error) {
            console.log(error);
            thongbao('Xoá không thành công');
            button.attr('disabled', false);
        },
    });
});

$('.update_product').on('click', function(e){

    let id = $(this).data('id');

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: getProduct,
        data: { id: id },
        type: "GET",
        success: function(result) {
            console.log(result);
            $('#id_edit').val(result.id);
            $('#name_edit').val(result.name);
            $('#brand_edit').val(result.brand);
            $('#price_edit').val(result.price);
            $('#category_id_edit').val(result.category_id);
            $('#quantity_edit').val(result.quantity);
            $('#title_edit').val(result.title);
            $('#title_detail_edit').val(result.title_detail);


            if(result.image != null) {
                $('#preview_image_edit').empty().append(`
                    <div class="w-20 h-20 border border-gray-300 rounded-lg mx-2 shadow">
                        <img class="w-full h-full rounded-lg show_enlarge" data-src="/storage/${result.image}" src="/storage/${result.image}" alt="Preview">
                    </div>
                `);
            }

            if(result.product_img.length > 0) {
                console.log('123');
                let append = ``;
                result.product_img.forEach(element => {
                    append += `
                    <div class="w-20 h-20 border border-gray-300 rounded-lg mx-2 shadow">
                        <img class="w-full h-full rounded-lg show_enlarge" data-src="/storage/${element.path}/${element.file_name}" src="/storage/${element.path}/${element.file_name}" alt="Preview">
                    </div>`;
                });

                $('#preview_image_extra_edit').empty().append(append);
            }
        },
        error: function(error) {
            console.log(error);
        },
    });

    $('#default-modal_product').removeClass('hidden');
});

$('.cancel_popup_product').on('click', function(e){
    $('#default-modal_product').addClass('hidden');
});

// kết thúc 1 khu vực

$('.delete_users').on('click', function(e) {
    let button = $(this);
    button.attr('disabled', true);

    let id = $(this).data('id');

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: deleteUser,
        data: { id: id },
        type: "POST",
        success: function(result) {
            button.parent().parent().remove();
            thongbao('Xoá thành công');
            button.attr('disabled', false);
        },
        error: function(error) {
            console.log(error);
            thongbao('Xoá không thành công');
            button.attr('disabled', false);
        },
    });
});

// khu vực sử lý dành cho news

$('.open_sesion_add_news').on('click', function(e){
    $('.sesion-news').removeClass('hidden');
    $('.close_sesion_add_news').removeClass('hidden');
    $('.open_sesion_add_news').addClass('hidden');
});

$('.close_sesion_add_news').on('click', function(e){
    $('.sesion-news').addClass('hidden');
    $('.close_sesion_add_news').addClass('hidden');
    $('.open_sesion_add_news').removeClass('hidden');
});

$(".delete_news").on("click", function (q) {
    let button = $(this);
    button.attr('disabled', true);

    let id = $(this).data('id');

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: deleteNews,
        data: { id: id },
        type: "POST",
        success: function(result) {
            button.parent().parent().remove();
            thongbao('Xoá thành công');
            button.attr('disabled', false);
        },
        error: function(error) {
            console.log(error);
            thongbao('Xoá không thành công');
            button.attr('disabled', false);
        },
    });
});



$('.update_news').on('click', function(e){

    let id = $(this).data('id');

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: getNews,
        data: { id: id },
        type: "GET",
        success: function(result) {
            console.log(result);
            $('#id_edit').val(result.id);
            $('#title_edit').val(result.title);
            $('#link_youtube_edit').val(result.image);
            $('#short_description_edit').val(result.short_description);
            $('#detailed_description_edit').val(result.detailed_description);

            if(result.image != null) {
                $('#preview_image_edit').append(`
                    <div class="w-20 h-20 border border-gray-300 rounded-lg mx-2 shadow">
                        <img class="w-full h-full rounded-lg show_enlarge" data-src="/storage/${result.image}" src="/storage/${result.image}" alt="Preview">
                    </div>
                `);
            }
        },
        error: function(error) {
            console.log(error);
        },
    });

    $('#default-modal_news').removeClass('hidden');
});

$('.cancel_popup_news').on('click', function(e){
    $('#default-modal_news').addClass('hidden');
});


$('.detail_news').on('click', function(e){
    console.log('clicked detail news');
    let id = $(this).data('id');
    window.location.href = `/tin-tức-chi-tiết?id=${id}`;
});

// kết thúc 1 khu vực

// khu vực hoá đơn
$('.detail_invoice').on('click', function(e){

    let id = $(this).data('id');

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: getDetailInvoice,
        data: { id: id },
        type: "GET",
        success: function(result) {
            console.log(result);
            let append = ``;
            result.invoice_detail.forEach(element => {
                append += `
                    <div class="flex items-center my-2">
                        <div class="w-2/12"> <img src="/storage/${element.product.image}" class="w-16 h-16"/></div>
                        <div class="w-6/12 px-2 truncate"> ${element.product.name}</div>
                        <div class="w-2/12"> ${convertToHalfFormat(element.product.price.toString())}</div>
                        <div class="w-2/12"> SL x ${element.quanty}</div>
                    </div>
                `;
            });

            append += `
            <div> Tên khách hàng : ${result.name_to} </div>
            <div> Số điện thoại : ${result.phone_to} </div>
            <div> Địa chỉ : ${result.name_city}${result.name_district}${result.name_ward}${result.address_to}</div>
            <div> Chi chú : ${result.note_to} </div>
            <div> Tổng tiền : ${convertToHalfFormat(result.amount.toString())} VND</div>
            `

            $('.append_invoice_detail').empty().append(append);
        },
        error: function(error) {
            console.log(error);
        },
    });

    $('#default-modal_invoice').removeClass('hidden');
});

$('.cancel_popup_invoice').on('click', function(e){
    $('#default-modal_invoice').addClass('hidden');
});

$('.update_invoice').on('click', function(e) {
    let button = $(this);
    button.attr('disabled', true);

    let id = $(this).data('id');

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: updateInvoice,
        data: { id: id },
        type: "POST",
        success: function(result) {
            button.attr('disabled', false);
            thongbao('Cập nhập thành công');
            window.location.reload();
        },
        error: function(error) {
            console.log(error);
            thongbao('Cập nhập không thành công');
            button.attr('disabled', false);
        },
    });
});
// kết thúc 1 hoá đơn

// show preview image

var check_image = document.getElementById('image');
if(check_image) {
    document.getElementById('image').addEventListener('change', function(event) {
        let files = event.target.files;
        let preview = document.getElementById('preview_image');
        preview.innerHTML = ''; // Xóa bất kỳ hình ảnh trước đó nào trong phần xem trước

        for (let i = 0; i < files.length; i++) {
            let file = files[i];
            if (file) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    preview.innerHTML += `
                        <div class="w-20 h-20 border border-gray-300 rounded-lg mx-2 shadow">
                            <img class="w-full h-full rounded-lg show_enlarge" data-src="${e.target.result}" src="${e.target.result}" alt="Preview">
                        </div>
                    `;
                }

                reader.readAsDataURL(file);
            }
        }
    });
}

var check_image_edit = document.getElementById('image_edit');
if(check_image_edit) {
    document.getElementById('image_edit').addEventListener('change', function(event) {
        let files = event.target.files;
        let preview = document.getElementById('preview_image_edit');
        preview.innerHTML = ''; // Xóa bất kỳ hình ảnh trước đó nào trong phần xem trước

        for (let i = 0; i < files.length; i++) {
            let file = files[i];
            if (file) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    preview.innerHTML += `
                        <div class="w-20 h-20 border border-gray-300 rounded-lg mx-2 shadow">
                            <img class="w-full h-full rounded-lg show_enlarge" data-src="${e.target.result}" src="${e.target.result}" alt="Preview">
                        </div>
                    `;
                }

                reader.readAsDataURL(file);
            }
        }
    });
}

var check_image_extra = document.getElementById('image_extra');
if(check_image_extra) {
    document.getElementById('image_extra').addEventListener('change', function(event) {
        let files = event.target.files;
        let preview = document.getElementById('preview_image_extra');
        preview.innerHTML = ''; // Xóa bất kỳ hình ảnh trước đó nào trong phần xem trước

        for (let i = 0; i < files.length; i++) {
            let file = files[i];
            if (file) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    preview.innerHTML += `
                        <div class="w-20 h-20 border border-gray-300 rounded-lg mx-2 shadow">
                            <img class="w-full h-full rounded-lg show_enlarge" data-src="${e.target.result}" src="${e.target.result}" alt="Preview">
                        </div>
                    `;
                }

                reader.readAsDataURL(file);
            }
        }
    });
}

var check_preview_image_extra = document.getElementById('image_extra_edit');
if(check_preview_image_extra) {
    document.getElementById('image_extra_edit').addEventListener('change', function(event) {
        let files = event.target.files;
        let preview = document.getElementById('preview_image_extra_edit');
        preview.innerHTML = ''; // Xóa bất kỳ hình ảnh trước đó nào trong phần xem trước

        for (let i = 0; i < files.length; i++) {
            let file = files[i];
            if (file) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    preview.innerHTML += `
                        <div class="w-20 h-20 border border-gray-300 rounded-lg mx-2 shadow">
                            <img class="w-full h-full rounded-lg show_enlarge" data-src="${e.target.result}" src="${e.target.result}" alt="Preview">
                        </div>
                    `;
                }

                reader.readAsDataURL(file);
            }
        }
    });
}



$(document).on('click', '.close_images', function(e) {
    $(this).parent().parent().remove();
});

$(document).on('click', '.show_enlarge', function(e) {
    console.log('show_enlarge');

            // Tạo chuỗi HTML chứa div mới
    var newDivHTML = `
        <div class="fixed z-50 w-full h-full">
            <div  class="relative mx-auto mt-16 border border-gray-300 rounded-lg mx-2 shadow" style="width:50%; aspect-ratio: 5/4">
                <button type="button" class="close_images absolute top-0 right-0 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
                <img src="${$(this).data('src')}" alt="Preview" class="rounded-lg w-full h-full">
            </div>
        </div>`;

    // Thêm chuỗi HTML vào sau phần tử cuối cùng của body
    document.body.insertAdjacentHTML('beforeend', newDivHTML);

});


// kết thúc show preview image

//clients

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
                let index = 0
                result.forEach(element => {

                    total += (element.product.price * element.quantity);
                    append += `
                        <div class="flex items-center my-2">
                            <input type="hidden" name="data[${index}][price]" value="${element.product.price}"/>
                            <input type="hidden" name="data[${index}][id_product]" value="${element.product.id}"/>
                            <div class="w-2/12"> <img src="/storage/${element.product.image}" class="w-16 h-16"/></div>
                            <div class="w-3/12">${element.product.name}</div>
                            <div class="w-3/12">${convertToHalfFormat(element.product.price.toString())}</div>
                            <div class="w-3/12"> SL <input type="number" data-price="${element.product.price}" name="data[${index}][quantity_product]" class="quantity_product w-14 rounded-lg p-2" value="${element.quantity}" min="1" max="999"></div>
                            <div class="w-1/12"><i class="fa-solid fa-trash text-blue-600 delete_product_card" data-id="${element.product.id}"></i></div>
                        </div>
                    `;

                    index += 1;
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
