// khu vực sử lý dành cho category cha
    $('.update_category_parent').on('click', function(e){

        let id = $(this).data('id');
        let name = $(this).data('name');

        $('#name_parent_popup').val(name);
        $('#input_id_category').val(id);

        $('#default-modal_parent').removeClass('hidden');
    });

    $('.cancel_popup_parent').on('click', function(e){

        $('#name_parent_popup').val('');
        $('#input_id_category').val('');

        $('#default-modal_parent').addClass('hidden');
    });

    $(".delete_category_parent").on("click", function (q) {

        let button = $(this);
        button.attr('disabled', true);

        let id = $(this).data('id');

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: deleteCategoryParent,
            data: { id: id },
            type: "POST",
            success: function(result) {
                button.parent().parent().remove();
                thongbao('Xoá thành công');
                button.attr('disabled', false);
            },
            error: function(error) {
                thongbao('Xoá không thành công');
                button.attr('disabled', false);
            },
        });
    });
// kết thúc khu vực sử lý dành cho category cha


// khu vực sử lý dành cho category
$('.update_category').on('click', function(e){

    let id = $(this).data('id');
    let name = $(this).data('name');
    let category_parent_id = $(this).data('category_parent_id');

    $('#name_popup').val(name);
    $('#category_parent_id_popup').val(category_parent_id);
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


var preview_image_sick_edit = document.getElementById('image_sick_edit');
if(preview_image_sick_edit) {
    document.getElementById('image_sick_edit').addEventListener('change', function(event) {
        let files = event.target.files;
        let preview = document.getElementById('preview_image_sick_edit');
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
    // Tạo chuỗi HTML chứa div mới
    var newDivHTML = `
        <div class="fixed z-50 w-full h-full">
            <div  class="relative mx-auto mt-16 border border-gray-300 rounded-lg mx-2 shadow bg-white" style="width:50%; aspect-ratio: 5/4">
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


$('.patient_details').change(function(e) {
    $('.patient_details').not(this).prop('checked', false); // Loại bỏ chọn tất cả các checkbox khác
    $('.patient_details').parent().parent().parent().find('tr').css('background-color', 'white');
    if ($(this).is(':checked')) {
        var dataId = $(this).data('id');
        $('#id_patient_sick').val(dataId);
        $(this).parent().parent().css('background-color', 'whitesmoke');
    }
});

$('#create_patient').on('click', function(e) {
        // e.preventDefault();
        if($('#id_patient_sick').val() != '') {
            let allFieldsFilled = true;
            $('#form_create_patient').find('[required]').each(function() {
                if ($(this).val() === '') {
                    allFieldsFilled = false;
                    return false; // Dừng vòng lặp khi gặp trường required chưa được điền
                }
            });

            if(allFieldsFilled) {
                $('#form_create_patient').submit();
            } else {
                thongbao('Vui lòng nhập ngày khám và giờ khám');
            }

    } else {
        thongbao('Vui lòng chọn 1 bênh nhân để đăng kí khám bệnh');
    }
});


$('.patient_sicks').change(function(e) {
    $('.patient_sicks').not(this).prop('checked', false); // Loại bỏ chọn tất cả các checkbox khác
    $('.patient_sicks').parent().parent().parent().find('tr').css('background-color', 'white');
    if ($(this).is(':checked')) {
        var dataId = $(this).data('id');
        $(this).parent().parent().css('background-color', 'whitesmoke');

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: getListPatientSicks,
            data: {id : dataId},
            type: "GET",
            success: function(result) {
                let append = ``;
                let array_temp = result.array_temp;
                for (var key in result.array_temp) {
                    if (array_temp.hasOwnProperty(key)) {
                        append += `<div>${key}</div>`;
                        array_temp[key].forEach(function(result_child) {
                            let result_detail = result_child.result ? result_child.result : 'đăng kí khám';
                            append += `
                                <div class="truncate w-full ml-4">
                                    <input type="checkbox" class="diagnostic" value="1" id="diagnostic${result_child.id}"
                                    data-t="${result_child.t}"
                                    data-id="${result_child.id}"
                                    data-ha="${result_child.HA}"
                                    data-bmi="${result_child.BMI}"
                                    data-date="${result_child.date}"
                                    data-tall="${result_child.tall}"
                                    data-hours="${result_child.hours}"
                                    data-weight="${result_child.weight}"
                                    data-result="${result_child.result}"
                                    data-circuit="${result_child.circuit}"
                                    data-symptom="${result_child.symptom}"
                                    data-result1="${result_child.result1}"
                                    data-result2="${result_child.result2}"
                                    data-result3="${result_child.result3}"
                                    data-breathing="${result_child.breathing}"
                                    data-bloodSugar="${result_child.bloodSugar}"
                                    >
                                    <label  for="diagnostic${result_child.id}">${result_detail}</label>
                                </div>
                            `;
                        });
                    }
                }

                $('#list_stick').empty().append(append);

                $('#sex_patient_tab2').val(result.patient.sex);
                $('#name_patient_tab2').val(result.patient.name);
                $('#date_patient_tab2').val(result.patient.date);
                $('#phone_patient_tab2').val(result.patient.phone);
                $('#ethnic_patient_tab2').val(result.patient.ethnic);
                $('#address_patient_tab2').val(result.patient.address);
                $('#workshop_patient_tab2').val(result.patient.workshop);
                emptySickTab2();
            },
            error: function(error) {
            },
        });
    } else {
        $('#list_stick').empty();
        $('#sex_patient_tab2').val('');
        $('#name_patient_tab2').val('');
        $('#date_patient_tab2').val('');
        $('#phone_patient_tab2').val('');
        $('#ethnic_patient_tab2').val('');
        $('#address_patient_tab2').val('');
        $('#workshop_patient_tab2').val('');

        emptySickTab2();
    }
});

$(document).on('click', '.diagnostic', function(e) {
    $('.diagnostic').not(this).prop('checked', false); // Loại bỏ chọn tất cả các checkbox khác

    if ($(this).is(':checked')) {
        let t = $(this).data('t');
        let id = $(this).data('id');
        let ha = $(this).data('ha');
        let bmi = $(this).data('bmi');
        let date = $(this).data('date');
        let tall = $(this).data('tall');
        let hours = $(this).data('hours');
        let weight = $(this).data('weight');
        let result = $(this).data('result');
        let circuit = $(this).data('circuit');
        let symptom = $(this).data('symptom');
        let result1 = $(this).data('result1');
        let result2 = $(this).data('result2');
        let result3 = $(this).data('result3');
        let breathing = $(this).data('breathing');
        let bloodSugar = $(this).data('bloodSugar');

        $('#t_sick_tab2').val(t);
        $('#id_sick_tab2').val(id);
        $('#ha_sick_tab2').val(ha);
        $('#bmi_sick_tab2').val(bmi);
        $('#result_sick').val(result);
        $('#m_sick_tab2').val(circuit);
        $('#date_sick_tab2').val(date);
        $('#tall_sick_tab2').val(tall);
        $('#result1_sick').val(result1);
        $('#result2_sick').val(result2);
        $('#result3_sick').val(result3);
        $('#time_sick_tab2').val(hours);
        $('#nt_sick_tab2').val(breathing);
        $('#dh_sick_tab2').val(bloodSugar);
        $('#weight_sick_tab2').val(weight);
        $('#symptom_sick_tab2').val(symptom);


        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: getImgSickURL,
            data: {id : id},
            type: "get",
            success: function(result) {
                $('#image_sick_edit').val('');
                if(result.length > 0) {
                    let append = ``;
                    result.forEach(element => {
                        append += `
                        <div class="w-20 h-20 border border-gray-300 rounded-lg mx-2 shadow">
                            <img class="w-full h-full rounded-lg show_enlarge" data-src="/storage/${element.path}/${element.file_name}" src="/storage/${element.path}/${element.file_name}" alt="Preview">
                        </div>`;
                    });

                    $('#preview_image_sick_edit').empty().append(append);
                } else {
                    $('#preview_image_sick_edit').empty();
                }
            },
        });

    } else {
        emptySickTab2();
    }
});

function emptySickTab2() {
    $('#result_sick').val('');
    $('#m_sick_tab2').val('');
    $('#t_sick_tab2').val('');
    $('#id_sick_tab2').val('');
    $('#ha_sick_tab2').val('');
    $('#dh_sick_tab2').val('');
    $('#nt_sick_tab2').val('');
    $('#result1_sick').val('');
    $('#result3_sick').val('');
    $('#result2_sick').val('');
    $('#bmi_sick_tab2').val('');
    $('#date_sick_tab2').val('');
    $('#tall_sick_tab2').val('');
    $('#time_sick_tab2').val('');
    $('#image_sick_edit').val('');
    $('#weight_sick_tab2').val('');
    $('#symptom_sick_tab2').val('');
    $('#preview_image_sick_edit').empty();
}

$('.update_generic').on('click', function(e){
    $('#id_generic_edit').val($(this).data('id'));
    $('#name_generic_edit').val($(this).data('name'))
    $('#default-modal_generic').removeClass('hidden');
});

$('.cancel_popup_generic').on('click', function(e){
    $('#default-modal_generic').addClass('hidden');
});

$('.update_drugUnit').on('click', function(e){
    $('#id_drugUnit_edit').val($(this).data('id'));
    $('#name_drugUnit_edit').val($(this).data('name'))
    $('#default-modal_drugUnit').removeClass('hidden');
});

$('.cancel_popup_drugUnit').on('click', function(e){
    $('#default-modal_drugUnit').addClass('hidden');
});



$('.update_usage').on('click', function(e){
    $('#id_usage_edit').val($(this).data('id'));
    $('#name_usage_edit').val($(this).data('name'))
    $('#default-modal_usage').removeClass('hidden');
});

$('.cancel_popup_usage').on('click', function(e){
    $('#default-modal_usage').addClass('hidden');
});

$('.update_drug').on('click', function(e){
    $('#id_drug_edit').val($(this).data('id'));
    $('#name_drug_edit').val($(this).data('name'))
    $('#price_drug_edit').val($(this).data('price'))
    $('#id_drug_unit_edit').val($(this).data('id_drug_unit'))
    $('#id_generic_edit_tab5').val($(this).data('id_generic'))
    $('#default-modal_drug').removeClass('hidden');
});

$('.cancel_popup_drug').on('click', function(e){
    $('#default-modal_drug').addClass('hidden');
});

$('#submit_update_sick').on('click', function(e){
    if($('#id_sick_tab2').val() != '') {
        $('#form_update_sick').submit();
    } else {
        thongbao('Vui lòng chọn 1 lần khám');
    }
});


$('.btn_medicine_supply').on('click', function(e){
    if($('#id_sick_tab2').val() != '') {
        $('.list_sick_popup').empty();
        $('.table_drug_list').empty();
        $('#sick_id_drug_add').val($('#id_sick_tab2').val());
        $('#id_sick_export').val($('#id_sick_tab2').val());
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: listPrescription,
            data: {id : $('#id_sick_tab2').val()},
            type: "get",
            success: function(result) {
                $('#name_bn').val(result.sick.patient.name);
                $('#chuan_doan').val(result.sick.result);
                $('#ket_luan').val(result.sick.result);
                $('#trieu_chung').val(result.sick.symptom);
                $('#loi_dan').val(result.sick.result4);
                $('#mach_popup').text(result.sick.circuit);
                $('#t_popup').text(result.sick.T);
                $('#ha_popup').text(result.sick.HA);
                $('#cao_popup').text(result.sick.tall);
                $('#nang_popup').text(result.sick.weight);
                $('#on_leave_popup').val(result.sick.on_leave);

                let index =  1;
                if(result.sick.prescription != null) {
                    result.sick.prescription.prescription_detail.forEach(element => {

                        let append = `
                            <tr>
                                <td class="border text-center">
                                    <input type="checkbox" class="row_detail_prescription"
                                    data-note="${element.note ? element.note : ''}"
                                    data-price="${element.price ? element.price : ''}"
                                    data-dosage="${element.dosage ? element.dosage : ''}"
                                    data-session="${element.session ? element.session : ''}"
                                    data-id_drug="${element.id_drug ? element.id_drug : ''}"
                                    data-quantity="${element.quantity ? element.quantity : ''}"
                                    data-id_usage="${element.id_usage ? element.id_usage : ''}"
                                    data-every_day="${element.every_day ? element.every_day : ''}"
                                    data-every_times="${element.every_times ? element.every_times : ''}"
                                    data-number_of_day="${element.number_of_day ? element.number_of_day : ''}"
                                    value="1">
                                    <input type="hidden" name="detail[${index}][note]" value="${element.note ? element.note : ''}">
                                    <input type="hidden" name="detail[${index}][price]" value="${element.price ? element.price : ''}">
                                    <input type="hidden" name="detail[${index}][dosage]" value="${element.dosage ? element.dosage : ''}">
                                    <input type="hidden" name="detail[${index}][session]" value="${element.session ? element.session : ''}">
                                    <input type="hidden" name="detail[${index}][id_drug]" value="${element.id_drug ? element.id_drug : ''}">
                                    <input type="hidden" name="detail[${index}][quantity]" value="${element.quantity ? element.quantity : ''}">
                                    <input type="hidden" name="detail[${index}][id_usage]" value="${element.id_usage ? element.id_usage : ''}">
                                    <input type="hidden" name="detail[${index}][every_day]" value="${element.every_day ? element.every_day : ''}">
                                    <input type="hidden" name="detail[${index}][every_times]" value="${element.every_times ? element.every_times : ''}">
                                    <input type="hidden" name="detail[${index}][number_of_day]" value="${element.number_of_day ? element.number_of_day : ''}">
                                </td>
                                <td class="border">${element.drug ? element.drug.name : ''}</td>
                                <td class="border">${element.drug.generic ? element.drug.generic.name : ''}</td>
                                <td class="border">${element.drug.drug_unit ? element.drug.drug_unit.name : ''}</td>
                                <td class="border">${element.every_day ? element.every_day : ''}</td>
                                <td class="border">${element.every_times ? element.every_times : ''}</td>
                                <td class="border">${element.number_of_day ? element.number_of_day : ''}</td>
                                <td class="border">${element.quantity ? element.quantity : ''}</td>
                                <td class="border">${element.price ? element.price : ''}</td>
                                <td class="border">${element.dosage ? element.dosage : ''}</td>
                                <td class="border">${element.usage ? element.usage.name : ''}</td>
                                <td class="border">${element.session ? element.session : ''}</td>
                                <td class="border">${element.note ? element.note : ''}</td>
                            </tr>
                        `;

                        $('.table_drug_list').append(append);

                        index = index + 1;

                        $('#index_table').val(index)
                    });
                }

                result.list_prescription.forEach((element, index1 )=> {
                    $('.list_sick_popup').append(`
                        <div class="flex">
                            <label for="list_sick_popup_${index1}">
                                <input type="checkbox" class="list_sick_popup_class" id="list_sick_popup_${index1}" data-sick="${element.id}"/>
                                ${element.date}_${element.result}
                            </label>
                        </div>
                    `);
                });
            },
        });


        $('#default-modal_medicine_supply').removeClass('hidden');
    } else {
        thongbao('Vui lòng chọn 1 lần khám');
    }
});

$('.cancel_popup_medicine_supply').on('click', function(e){
    $('#default-modal_medicine_supply').addClass('hidden');
});

$('.add_them_thuoc').on('click', function(e){
    let button = $(this);
    button.attr('disabled', true);

    let note_drug_add = $('#note_drug_add').val();
    let name_drug_add = $('#name_drug_add').val();
    let usage_drug_add = $('#usage_drug_add').val();
    let price_drug_add = $('#price_drug_add').val();
    let dosage_drug_add = $('#dosage_drug_add').val();
    let session_drug_add = $('#session_drug_add').val();
    let sick_id_drug_add = $('#sick_id_drug_add').val();
    let quantity_drug_add = $('#quantity_drug_add').val();
    let every_day_drug_add = $('#every_day_drug_add').val();
    let every_times_drug_add = $('#every_times_drug_add').val();
    let number_of_day_drug_add = $('#number_of_day_drug_add').val();

    let data = {
        id : name_drug_add,
        note_drug_add : note_drug_add,
        usage_drug_add : usage_drug_add,
        price_drug_add : price_drug_add,
        dosage_drug_add : dosage_drug_add,
        sick_id_drug_add : sick_id_drug_add,
        session_drug_add : session_drug_add,
        quantity_drug_add : quantity_drug_add,
        every_day_drug_add : every_day_drug_add,
        every_times_drug_add : every_times_drug_add,
        number_of_day_drug_add : number_of_day_drug_add,
    }

    handle_add_drug(data, button, 'Thêm');

});

function handle_add_drug(data, button, status) {
    if(data.id == '' || data.price_drug_add == '') {
        thongbao('Vui lòng điền tên thuốc và đơn giá');
        button.attr('disabled', false);
    } else {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: addPrescription,
            data: data,
            type: "POST",
            success: function(result) {
                let index = Number($('#index_table').val()) + 1;
                let append = `
                    <tr>
                        <td class="border text-center">
                            <input type="checkbox" class="row_detail_prescription"
                            data-note="${result.note ? result.note : ''}"
                            data-price="${result.price ? result.price : ''}"
                            data-dosage="${result.dosage ? result.dosage : ''}"
                            data-session="${result.session ? result.session : ''}"
                            data-id_drug="${result.id_drug ? result.id_drug : ''}"
                            data-quantity="${result.quantity ? result.quantity : ''}"
                            data-id_usage="${result.id_usage ? result.id_usage : ''}"
                            data-every_day="${result.every_day ? result.every_day : ''}"
                            data-every_times="${result.every_times ? result.every_times : ''}"
                            data-number_of_day="${result.number_of_day ? result.number_of_day : ''}"
                             value="1">
                            <input type="hidden" name="detail[${index}][note]" value="${result.note ? result.note : ''}">
                            <input type="hidden" name="detail[${index}][price]" value="${result.price ? result.price : ''}">
                            <input type="hidden" name="detail[${index}][dosage]" value="${result.dosage ? result.dosage : ''}">
                            <input type="hidden" name="detail[${index}][session]" value="${result.session ? result.session : ''}">
                            <input type="hidden" name="detail[${index}][id_drug]" value="${result.id_drug ? result.id_drug : ''}">
                            <input type="hidden" name="detail[${index}][quantity]" value="${result.quantity ? result.quantity : ''}">
                            <input type="hidden" name="detail[${index}][id_usage]" value="${result.id_usage ? result.id_usage : ''}">
                            <input type="hidden" name="detail[${index}][every_day]" value="${result.every_day ? result.every_day : ''}">
                            <input type="hidden" name="detail[${index}][every_times]" value="${result.every_times ? result.every_times : ''}">
                            <input type="hidden" name="detail[${index}][number_of_day]" value="${result.number_of_day ? result.number_of_day : ''}">
                        </td>
                        <td class="border">${result.name_drug ? result.name_drug : ''}</td>
                        <td class="border">${result.generic ? result.generic : ''}</td>
                        <td class="border">${result.drug_unit ? result.drug_unit : ''}</td>
                        <td class="border">${result.every_day ? result.every_day : ''}</td>
                        <td class="border">${result.every_times ? result.every_times : ''}</td>
                        <td class="border">${result.number_of_day ? result.number_of_day : ''}</td>
                        <td class="border">${result.quantity ? result.quantity : ''}</td>
                        <td class="border">${result.price ? result.price : ''}</td>
                        <td class="border">${result.dosage ? result.dosage : ''}</td>
                        <td class="border">${result.name_usage ? result.name_usage : ''}</td>
                        <td class="border">${result.session ? result.session : ''}</td>
                        <td class="border">${result.note ? result.note : ''}</td>
                    </tr>
                `;

                $('.table_drug_list').append(append);

                thongbao(status +' thành công');
                button.attr('disabled', false);
                $('#index_table').val(index);
            },
            error: function(error) {
                thongbao(status +' không thành công');
                button.attr('disabled', false);
            },
        });
    }
}

$(document).on('change','.row_detail_prescription', function(e) {
    $('.row_detail_prescription').not(this).prop('checked', false);
    if ($(this).is(':checked')) {
        $('#note_drug_add').val($(this).data('note'));
        $('#name_drug_add').val($(this).data('id_drug'));
        $('#usage_drug_add').val($(this).data('id_usage'));
        $('#price_drug_add').val($(this).data('price'));
        $('#dosage_drug_add').val($(this).data('dosage'));
        $('#session_drug_add').val($(this).data('session'));
        $('#quantity_drug_add').val($(this).data('quantity'));
        $('#every_day_drug_add').val($(this).data('every_day'));
        $('#every_times_drug_add').val($(this).data('every_times'));
        $('#number_of_day_drug_add').val($(this).data('number_of_day'));
    }
});

$(document).on('click', '.delete_row_prescription', function(e){
    let delete_status = false;
    let checkboxes = document.querySelectorAll('.row_detail_prescription');
    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            delete_status = true;
            $(checkbox).parent().parent().remove();
        }
    });

    if(delete_status == false) {
        thongbao('Vui lòng chọn 1 dòng để xoá');
    }
});


$(document).on('click', '.edit_row_prescription', function(e){
    e.preventDefault();
    let button = $(this);
    button.attr('disabled', true);
    let edit_status = false;

    let  checkboxes = document.querySelectorAll('.row_detail_prescription');
    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            edit_status = true;
            $(checkbox).parent().parent().remove();
            let note_drug_add = $('#note_drug_add').val();
            let name_drug_add = $('#name_drug_add').val();
            let usage_drug_add = $('#usage_drug_add').val();
            let price_drug_add = $('#price_drug_add').val();
            let dosage_drug_add = $('#dosage_drug_add').val();
            let session_drug_add = $('#session_drug_add').val();
            let sick_id_drug_add = $('#sick_id_drug_add').val();
            let quantity_drug_add = $('#quantity_drug_add').val();
            let every_day_drug_add = $('#every_day_drug_add').val();
            let every_times_drug_add = $('#every_times_drug_add').val();
            let number_of_day_drug_add = $('#number_of_day_drug_add').val();

            let data = {
                id : name_drug_add,
                note_drug_add : note_drug_add,
                usage_drug_add : usage_drug_add,
                price_drug_add : price_drug_add,
                dosage_drug_add : dosage_drug_add,
                sick_id_drug_add : sick_id_drug_add,
                session_drug_add : session_drug_add,
                quantity_drug_add : quantity_drug_add,
                every_day_drug_add : every_day_drug_add,
                every_times_drug_add : every_times_drug_add,
                number_of_day_drug_add : number_of_day_drug_add,
            }

            handle_add_drug(data, button, 'Sửa');
        }
    });

    if(edit_status == false) {
        thongbao('Vui lòng chọn 1 dòng để sửa');
    }
});

$('.save_prescription').on('click', function(e){
    e.preventDefault();
    let button = $(this);
    button.attr('disabled', true);
    let data_form = $("#submit_form_save_prescription").serialize();

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: savePrescription,
        data: data_form,
        type: "POST",
        success: function(result) {
            thongbao('Lưu thành công');
            // e.Graphics.DrawString((i + 1) + "." + DonThuoc.Rows[i]["Ten thuoc"] + "\t" + "\t" + DonThuoc.Rows[i]["so luong"] + " " + DonThuoc.Rows[i]["don vi thuoc"], new Font("Arial", 15, FontStyle.Italic), Brushes.Black, new Point(50, h));
            // e.Graphics.DrawString("\t" + DonThuoc.Rows[i]["lieu dung"] + "(" + DonThuoc.Rows[i]["so ngay"] + "  ngày) " +"\t\t\t\t\t\t\t", new Font("Arial", 15, FontStyle.Underline), Brushes.Black, new Point(50, k));
            button.attr('disabled', false);
        },
        error: function(error) {
            thongbao('Lưu không thành công');
            button.attr('disabled', false);
        },
    });

});

$('.give_back').on('click', function(e){

    $('.table_drug_list').empty();
    let id = $('.list_sick_popup_class:checked').data('sick');

    if(id != undefined && id != null && id != '') {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: listPrescription,
            data: {id : id},
            type: "get",
            success: function(result) {
                let index =  1;
                if(result.sick.prescription != null) {
                    result.sick.prescription.prescription_detail.forEach(element => {

                        let append = `
                            <tr>
                                <td class="border text-center">
                                    <input type="checkbox" class="row_detail_prescription"
                                    data-note="${element.note ? element.note : ''}"
                                    data-price="${element.price ? element.price : ''}"
                                    data-dosage="${element.dosage ? element.dosage : ''}"
                                    data-session="${element.session ? element.session : ''}"
                                    data-id_drug="${element.id_drug ? element.id_drug : ''}"
                                    data-quantity="${element.quantity ? element.quantity : ''}"
                                    data-id_usage="${element.id_usage ? element.id_usage : ''}"
                                    data-every_day="${element.every_day ? element.every_day : ''}"
                                    data-every_times="${element.every_times ? element.every_times : ''}"
                                    data-number_of_day="${element.number_of_day ? element.number_of_day : ''}"
                                    value="1">
                                    <input type="hidden" name="detail[${index}][note]" value="${element.note ? element.note : ''}">
                                    <input type="hidden" name="detail[${index}][price]" value="${element.price ? element.price : ''}">
                                    <input type="hidden" name="detail[${index}][dosage]" value="${element.dosage ? element.dosage : ''}">
                                    <input type="hidden" name="detail[${index}][session]" value="${element.session ? element.session : ''}">
                                    <input type="hidden" name="detail[${index}][id_drug]" value="${element.id_drug ? element.id_drug : ''}">
                                    <input type="hidden" name="detail[${index}][quantity]" value="${element.quantity ? element.quantity : ''}">
                                    <input type="hidden" name="detail[${index}][id_usage]" value="${element.id_usage ? element.id_usage : ''}">
                                    <input type="hidden" name="detail[${index}][every_day]" value="${element.every_day ? element.every_day : ''}">
                                    <input type="hidden" name="detail[${index}][every_times]" value="${element.every_times ? element.every_times : ''}">
                                    <input type="hidden" name="detail[${index}][number_of_day]" value="${element.number_of_day ? element.number_of_day : ''}">
                                </td>
                                <td class="border">${element.drug ? element.drug.name : ''}</td>
                                <td class="border">${element.drug.generic ? element.drug.generic.name : ''}</td>
                                <td class="border">${element.drug.drug_unit ? element.drug.drug_unit.name : ''}</td>
                                <td class="border">${element.every_day ? element.every_day : ''}</td>
                                <td class="border">${element.every_times ? element.every_times : ''}</td>
                                <td class="border">${element.number_of_day ? element.number_of_day : ''}</td>
                                <td class="border">${element.quantity ? element.quantity : ''}</td>
                                <td class="border">${element.price ? element.price : ''}</td>
                                <td class="border">${element.dosage ? element.dosage : ''}</td>
                                <td class="border">${element.usage ? element.usage.name : ''}</td>
                                <td class="border">${element.session ? element.session : ''}</td>
                                <td class="border">${element.note ? element.note : ''}</td>
                            </tr>
                        `;

                        $('.table_drug_list').append(append);

                        index = index + 1;

                        $('#index_table').val(index)
                    });
                }
            },
        });
    } else {
        thongbao('Vui lòng chọn 1 dòng để cho lại thuốc');
    }
});

$(document).on('click', '.list_sick_popup_class', function(e) {
    $('.list_sick_popup_class').not(this).prop('checked', false); // Loại bỏ chọn tất cả các checkbox khác
});


$(document).on('click','#printerFile', function(e) {
   $('#export_pdf').submit();
})

$(document).on('change', '.sl', function(e){
    let total = 1;
    $('.wraper-sl .sl').map(function(index,elm) {
        let number = 1;
        if($(elm).val() != '') number = $(elm).val();
        total = total * Number(number);
    });

    $('.total_sl').val(total);
});

$(document).on('change', '#name_drug_add', function(e) {
    let select = this;
    let selectedOption = select.options[select.selectedIndex];
    let price = selectedOption.getAttribute('data-price');
    if(price =='') price = 0;
    $('#price_drug_add').val(price);
});


