<!-- jQuery -->
<script src="{{ url('assets/js/jquery-3.6.0.min.js') }}"></script>

<!-- Slick -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
</script>

<script>
    // toggle menu-modals
    $(document).ready(function() {
        var statusModals = false;
        $('#toggle-modals').click(function(e) {
            e.preventDefault();
            const modals = $(this).attr('data-modals');
            if (statusModals == false) {
                $('.div--' + modals).addClass('active modals-true');
            } else {
                $('.div--' + modals).removeClass('active');
            }
            statusModals = !statusModals;
        });

        window.addEventListener('click', (e) => {
            const $target = $(e.target);
            if ($target.closest('#toggle-modals').length == 0) {
                if ($target.closest('.modals-true').length == 0) {
                    $('.modals-true').removeClass('active');
                    statusModals = !statusModals;
                }
            }
        });
        window.addEventListener('scroll', (e) => {
            $('.modals-true').removeClass('active');
            statusModals = false;
        });
    });

    // api address
    // $(document).ready(function() {

    //     $('input:radio[name="option"]').change(function() {
    //         alert($(this).val());
    //     });

    //     const city = $("#city");
    //     const district = $("#district");
    //     const ward = $("#ward");
    //     let list_city = "<option class='fs--12'>Choose...</option>";
    //     let list_district = "<option class='fs--12'>Choose...</option>";
    //     let list_ward = "<option class='fs--12'>Choose...</option>";

    //     $.ajax({
    //         url: "https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/province",
    //         type: "GET",
    //         beforeSend: function(request) {
    //             request.setRequestHeader("Token", "f2a7666f-4923-11ec-ac64-422c37c6de1b");
    //         },
    //         success: function(data) {
    //             let length = data.data.length;
    //             for (let i = length - 1; i > 0; i--) {
    //                 list_city +=
    //                     `<option class='fs--12' value=${data.data[i].ProvinceID}>${data.data[i].ProvinceName}</option>`
    //             }
    //             city.html(list_city);
    //         }
    //     })

    //     city.change(function() {
    //         $("#city_selected").val(city.find(':selected').text());
    //         list_district = "<option class='fs--12'>Choose...</option>";
    //         $.ajax({
    //             url: "https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/district",
    //             type: "GET",
    //             beforeSend: function(request) {
    //                 request.setRequestHeader("Token",
    //                     "f2a7666f-4923-11ec-ac64-422c37c6de1b");
    //             },
    //             data: {
    //                 "province_id": $(this).val()
    //             },
    //             success: function(data) {
    //                 let length = data.data.length;
    //                 for (let i = length - 1; i > 0; i--) {
    //                     list_district +=
    //                         `<option class='fs--12' value=${data.data[i].DistrictID}>${data.data[i].DistrictName}</option>`
    //                 }
    //                 district.html(list_district);
    //             }
    //         })
    //     })

    //     district.change(function() {
    //         $("#district_selected").val(district.find(':selected').text());
    //         list_ward = "<option class='fs--12'>Choose...</option>";
    //         $.ajax({
    //             url: `https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/ward?district_id=${$(this).val()}`,
    //             type: "GET",
    //             beforeSend: function(request) {
    //                 request.setRequestHeader("Token",
    //                     "f2a7666f-4923-11ec-ac64-422c37c6de1b");
    //             },
    //             success: function(data) {
    //                 let length = data.data.length;
    //                 for (let i = 0; i < length; i++) {
    //                     list_ward +=
    //                         `<option  class='fs--12' value=${data.data[i].WardCode}>${data.data[i].WardName}</option>`
    //                 }
    //                 ward.html(list_ward);
    //             }
    //         })
    //     })
    // });

    // slide product
    $(document).ready(function() {
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            accessibility: true,
            arrows: false,
            asNavFor: '.slider-nav',
            autoplay: true,
            autoplaySpeed: 15000,
        });
        $('.slider-nav').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            arrows: false,
            focusOnSelect: true
        });
    });

    // input auth
    $(document).ready(function() {
        $('.input_auth').focus(function(e) {
            e.preventDefault();
            let parent = $(this).parents('.input__content');
            parent.addClass('active');
        })
        $('.input_auth').focusout(function(e) {
            e.preventDefault();
            let parent = $(this).parents('.input__content');
            parent.removeClass('active');
        })
        faqs()

        function faqs() {
            let faq_title = $(".faq-title");
            for (let i = 0; i < faq_title.length; i++) {
                faq_title[i].addEventListener('click', function() {
                    $(this).toggleClass('active');
                    let icon = $('.faq-title  fa-solid');
                    let faq_body = this.nextElementSibling;

                    if (faq_body.style.display === "block") {
                        faq_body.style.display = "none";
                    } else {
                        faq_body.style.display = "block";
                    }
                })
            }
        }
    });

    // zoom product
    function zoom(e) {
        var zoom = e.currentTarget;
        e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
        e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
        x = (offsetX / zoom.offsetWidth) * 100
        y = (offsetY / zoom.offsetHeight) * 100
        zoom.style.backgroundPosition = x + "% " + y + "%";
    }

    // click attribute
    $(document).ready(function() {

        let first = false;
        let data_detail = [];

        function changeDetail(data_detail) {
            if (first == true) {
                $('.slider-for').slick('slickRemove', 0);
            }
            $('.price_detail').html(new Intl.NumberFormat(['ban', 'id']).format(data_detail[0].price) + 'đ');
            $('.sale_price_detail').html(new Intl.NumberFormat(['ban', 'id']).format(data_detail[0].price +
                data_detail[0].sale) + 'đ');
            $('.percent_detail').html('-' + new Intl.NumberFormat(['ban', 'id']).format((data_detail[0].sale / (
                data_detail[0].price / 100)).toFixed(0)) + '%');
            $('.quantity_detail').html(new Intl.NumberFormat(['ban', 'id']).format(data_detail[0].quantity -
                data_detail[0].sold));
            const element =
                `<div>
                        <div class="box-image" style="background: linear-gradient(180deg, rgba(231, 231, 236, 0.3), rgba(109, 225, 230, 0.2)), url('<?= asset('upload/product') ?>/` +
                data_detail[0].url_image + `') no-repeat" onmousemove="zoom(event)">
                            <img src="<?= asset('upload/product') ?>/` + data_detail[0].url_image + `" alt="">
                            <div class="icon-heart">
                                <form class="form--heart" action="">
                                    <button><i class="fa-regular fa-heart"></i></button>
                                </form>
                            </div>
                            <div class="icon-spakles">
                                <i class="fa-duotone fa-sparkles"></i>
                                <span>New in </span>
                            </div>
                        </div>
                    </div>`;
            $('.slider-for').slick('slickAdd', element, 0, true).slick('slickGoTo', 0, true);
            if (first == false) {
                first = true;
            }
        }

        $('.attribute').click(function(e) {
            $('#attribute_value').html($(this).val());
            if (type == 0) {
                const radio = document.querySelector('input[name="colors"]:checked');
                if (radio) {
                    const color = radio.value;
                    data_detail = detail.filter(({
                        attribute_value,
                        color_value
                    }) => attribute_value == $(this).val() && color_value == color);
                    changeDetail(data_detail);
                }
            } else {
                data_detail = detail.filter(({
                    attribute_value
                }) => attribute_value == $(this).val());
                changeDetail(data_detail);
            }
        });
        $('.colors').click(function(e) {
            $('#color_value').html($(this).val());
            if (type == 0) {
                const radio = document.querySelector('input[name="attributes"]:checked');
                if (radio) {
                    const attribute = radio.value;
                    data_detail = detail.filter(({
                        attribute_value,
                        color_value
                    }) => attribute_value == attribute && color_value == $(this).val());
                    changeDetail(data_detail);
                }
            } else {
                data_detail = detail.filter(({
                    color_value
                }) => color_value == $(this).val());
                changeDetail(data_detail);
            }
        });
        $('.quantity-function').click(function(e) {
            const action = $(this).attr('data-action');
            let input = $('.input-quantity-function').val();
            if (action == 'plus') {
                $('.input-quantity-function').val(Number(input) + 1);
            } else {
                if (input == 1) {
                    return;
                }
                $('.input-quantity-function').val(Number(input) - 1);
            }
        });
        $('.btn-submit-add-cart').click(function(e) {
            let _storeCartUrl = '{{ route("user.store_cart") }}';
            let _csrf = '{{ csrf_token() }}';
            let quantity = $('.input-quantity-function').val();
            let isLogin = '{{Auth::check()}}';
            let urlLogin = '{{route("login")}}';
            e.preventDefault();

            if (!isLogin) {
                return window.location = urlLogin;
            }

            if (data_detail.length == 1) {
                $.ajax({
                    url: _storeCartUrl,
                    type: 'POST',
                    data: {
                        'detail': data_detail[0].id,
                        'quantity': quantity,
                        _token: _csrf
                    },
                    success: function(res) {
                        const response = JSON.parse(res);
                        if (response.status == 200) {
                            alert('update');
                            $(`.quantity__change__for_update_${response.data.id}`).html(
                                response.data.quantity);
                        } else if (response.status == 201) {
                            alert('success');
                            $('.tip__cartBar').text(Number($('.tip__cartBar').text()) + 1);
                            $('.list__product__cart__bar').prepend(`
                                <div class="component--cardProductCart">
                                    <div class="component--cardProductCart--content">
                                        <a href="/product/${response.data.product.slug}" class="images-content">
                                            <img class="image-product" src="<?= asset('upload/product') ?>/${response.data.detail.url_image}" alt="">
                                        </a>
                                    </div>
                                    <div class="component--cardProductCart--content">
                                        <a href="/product/${response.data.product.slug}" class="link-content">
                                            <p>${response.data.product.name}</p>
                                            <div>
                                                <p>Color: <ion-icon name="color-palette-outline"></ion-icon> <span class="color" style="color: ${response.data.detail.color_value}"></span></p>
                                                <p>${response.data.detail.attribute}: <span>${response.data.detail.attribute_value}</span></p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="component--cardProductCart--content price">
                                        <p>${new Intl.NumberFormat(['ban', 'id']).format(response.data.detail.price)}đ</p>
                                        <p>Qty: <span class="quantity__change__for_update_${response.data.id}">${response.data.quantity}</span></p>
                                    </div>
                                </div>`);
                        } else {
                            alert(response.message);
                        }
                    }
                });
            } else {
                alert('Chọn loại sản phẩm muốn thêm');
            }
        });
    })

    // click cart
    $(document).ready(function() {
        var wait = false;

        async function update_item_cart(id) {
            let url__submit = '{{route("user.update_item_cart")}}';
            let _csrf = '{{csrf_token()}}';
            let quantity = $(`.input-quantity-function_${id}`).val();
            $.ajax({
                url: url__submit,
                type: 'POST',
                data: {
                    'id': id,
                    'quantity': quantity,
                    _token: _csrf
                },
                success: function(res) {
                    const response = JSON.parse(res);
                    if (response.status == 200) {
                        console.log(response.message);
                        const index = id;
                        const val = detail.filter(({
                            id
                        }) => id == index);
                        val[0].quantity = quantity;
                        update_total();
                    } else {
                        console.log(response.message);
                    }
                }
            });
        };
        $('.quantity-function-update').click(function(e) {
            const id = $(this).attr('data-id');
            let quantity = $(`.input-quantity-function_${id}`);
            let quantity_detail = $(`.quantity_detail_${id}`);
            const action = $(this).attr('data-action');
            if (action == 'minus') {
                if ((Number(quantity.val()) - 1) < 1) {
                    return alert('Ko nhập thấp hơn 0');
                } else {
                    quantity.val(Number(quantity.val()) - 1);
                }
            } else {
                if ((Number(quantity.val()) + 1) > Number(quantity_detail.val())) {
                    return alert('Hàng không đủ');
                } else {
                    quantity.val(Number(quantity.val()) + 1);
                }
            }
            if (wait) {
                clearTimeout(wait);
                wait = setTimeout(() => {
                    update_item_cart(id);
                    wait = false;
                }, 1000);
            } else {
                wait = setTimeout(() => {
                    update_item_cart(id);
                    wait = false;
                }, 1000);
            }
        });
        $('.remove__item__cart').click(function(e) {
            e.preventDefault();
            const id = $(this).attr('data-id');
            const parentElement = $(this).parents('.cardProductCartDetail');
            const assert = confirm(`you are delete item ${id} in your cart. are you sure ?`);
            if (assert == true) {
                let url__submit = '{{route("user.delete_item_cart")}}';
                let _csrf = '{{csrf_token()}}';
                $.ajax({
                    url: url__submit,
                    type: 'POST',
                    data: {
                        'id': id,
                        _token: _csrf
                    },
                    success: function(res) {
                        const response = JSON.parse(res);
                        if (response.status == 200) {
                            alert('success');
                            parentElement.remove();
                            $('.tip__cartBar').text(Number($('.tip__cartBar').text()) - 1);
                        } else {
                            alert(`${response.data}`);
                        }
                    }
                });
            }
        });
        $('.required_checkbox[required]').change(function() {
            if ($('.required_checkbox[required]').is(':checked')) {
                $('.required_checkbox[required]').removeAttr('required');
            } else {
                $('.required_checkbox[required]').attr('required', 'required');
            }
        });
        $('.required_checkbox').change(function() {
            const id = $(this).attr('data-id');
            const url__submit = '{{route("user.chooseCart")}}';
            const _csrf = '{{csrf_token()}}';
            let status = 0;
            if ($('.required_checkbox').is(':checked')) {
                status = 1
            }
            $.ajax({
                url: url__submit,
                type: 'POST',
                data: {
                    'id': id,
                    'status': status,
                    _token: _csrf
                },
                success: function(res) {
                    
                }
            });
        })

        function update_total() {
            const checkbox = $('.required_checkbox:checked');
            let sum = 0;
            let total = 0;
            checkbox.each((index, value) => {
                const val = detail.filter(({
                    id
                }) => id == value.value);
                total = checkbox.length;
                sum += val[0].price * val[0].quantity;
            });
            $('.total_cart').text(total);
            $('.price_cart').text(new Intl.NumberFormat(['ban', 'id']).format(sum));
        }
        $('.required_checkbox').change(function() {
            update_total();
        })
    })

    // checkout
    $(document).ready(function() {
        $('.address_option').change(function() {
            const address = $('input[name=option]:checked','#form_radio').val();
            if(address != 'required') {
                const url = '{{route("user.checkout")}}'+'?address='+address;
                window.location= url;
            }
        })
    })

    $(document).ready(function() {

        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.file_image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".file-upload").on('change', function() {
            readURL(this);
        });

    });
</script>