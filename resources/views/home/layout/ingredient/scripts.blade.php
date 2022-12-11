<!-- jQuery -->
<script src="{{ url('assets/js/jquery-3.6.0.min.js') }}"></script>

<!-- Slick -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
</script>

{{-- Input Bootstrap --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" integrity="sha512-9UR1ynHntZdqHnwXKTaOm1s6V9fExqejKvg5XMawEMToW4sSw+3jtLrYfZPijvnwnnE8Uol1O9BcAskoxgec+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{-- CKeditor --}}
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.1/classic/ckeditor.js"></script>
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
            let _storeCartUrl = "{{ route('user.store_cart') }}";
            let _csrf = '{{ csrf_token() }}';
            let quantity = $('.input-quantity-function').val();
            let isLogin = '{{ Auth::check() }}';
            let urlLogin = "{{ route('login') }}";
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
                            ToastSuccess('Lỗi:', response.message, 'warning', 3000);
                        }
                    }
                });
            } else {
                ToastSuccess('Lỗi:', 'Vui lòng chọn loại sản phẩm', 'warning', 3000)
            }
        });
    })

    // click cart
    $(document).ready(function() {
        var wait = false;

        async function update_item_cart(id) {
            let url__submit = "{{ route('user.update_item_cart') }}";
            let _csrf = '{{ csrf_token() }}';
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
                    ToastSuccess('Lỗi:', 'Ko nhập thấp hơn 0', 'warning', 3000);
                } else {
                    quantity.val(Number(quantity.val()) - 1);
                }
            } else {
                if ((Number(quantity.val()) + 1) > Number(quantity_detail.val())) {
                    ToastSuccess('Lỗi:', 'Hàng không đủ', 'warning', 3000);
                    return;
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
                let url__submit = "{{ route('user.delete_item_cart') }}";
                let _csrf = '{{ csrf_token() }}';
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
            const url__submit = "{{ route('user.chooseCart') }}";
            const _csrf = '{{ csrf_token() }}';
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
            const address = $('input[name=option]:checked', '#form_radio').val();
            if (address != 'required') {
                const url = '{{ route("user.checkout") }}' + '?address=' + address;
                window.location = url;
            }
        });
        $('.button_confirm_order').click(function(e) {
            e.preventDefault();

            const url__submit = '{{route("user.checkout-store")}}';
            const _csrf = '{{csrf_token()}}';
            const paymentMethod = $('input[name=paymentMethod]:checked', '#form_radio').val();
            const big_coupon = $('.big-event').val();
            const address = $('input[name=option]:checked', '#form_radio').val();

            if (address == 'required') {
                ToastSuccess('Lỗi:', 'address cannot be null', 'warning', 3000);
                return;
            }

            if (paymentMethod == null) {
                ToastSuccess('Lỗi:', 'paymentMethod cannot be null', 'warning', 3000);
                return;
            }

            let data = {};
            document.querySelectorAll('.massage__input__checkout').forEach(element => {
                const name = element.getAttribute('name');
                data['message_' + name] = element.value;
            });
            document.querySelectorAll('.voucher__input__checkout').forEach(element => {
                const name = element.getAttribute('name');
                data['voucher_' + name] = element.value;
            });
            data.bigCoupon = big_coupon;
            data.paymentMethod = paymentMethod;
            data.address = address;
            data._token = _csrf;

            $.ajax({
                url: url__submit,
                type: 'POST',
                data: data,
                success: function(res) {
                    let json = JSON.parse(res);
                    return window.location = json.url;
                }
            });

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

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.image-upload-wrap').hide();

                $('.file-upload-image').attr('src', e.target.result);
                $('.file-upload-content').show();

                $('.image-title').html(input.files[0].name);
            };

            reader.readAsDataURL(input.files[0]);

        } else {
            removeUpload();
        }
    }

    function removeUpload() {
        $('.file-upload-input').replaceWith($('.file-upload-input').clone());
        $('.file-upload-content').hide();
        $('.image-upload-wrap').show();
    }

    $('.image-upload-wrap').bind('dragover', function() {
        $('.image-upload-wrap').addClass('image-dropping');
    });

    $('.image-upload-wrap').bind('dragleave', function() {
        $('.image-upload-wrap').removeClass('image-dropping');
    });

    function ToastSuccess(title, message, type, duration = 10000) {
        NotifyToast({
            title: title,
            message: message,
            type: type,
            duration: duration
        });
    }

    if (document.querySelector('#long_description')) {
        ClassicEditor
            .create(document.querySelector('#long_description'))
        //     .catch( error => {
        //         console.error( "Editor Error" );
        // } );
    }



    $(document).ready(function() {
        // Thumb image
        let button = document.querySelector("#upload-file-product");
        let input = document.querySelector("#input-hidden");

        // image detail
        let buttonAlbum = document.querySelector("#button-album");
        let inputAlbum = document.querySelector("#album");

<<<<<<< HEAD

=======
>>>>>>> fdca0204e789172b5dcf9f662990e355b44886f3
        if (button) {
            button.onclick = function() {
                input.click();
            }
        }

        if (input) {
            input.addEventListener("change", function() {

                file = this.files[0];
                $(".drag-area").show();
                $(".drag-area").addClass("active")
                showFile();
            });
        }

        function showFile() {
            let fileType = file.type;
            let validExtensions = ["image/jpeg", "image/jpg", "image/png", "video/mp4", "video/ogg"];
            if (validExtensions.includes(fileType)) {
                let fileReader = new FileReader();
                fileReader.onload = () => {
                    let fileURL = fileReader.result;
                    let imgTag = `<img src="${fileURL}" alt="image">`;
                    $(".drag-area").html(imgTag);
                    $(".removeFile").show();
                }
                fileReader.readAsDataURL(file);
            } else {
                ToastSuccess('Lỗi:', 'This is not an Image File!', 'warning', 3000);
            }
        }

        $(".removeFile").click(function() {

            $(".drag-area").html("");
            $(".drag-area").removeClass("active");
            $(".drag-area").hide();
            $(".removeFile").hide();

        })

        if (buttonAlbum) {
            buttonAlbum.onclick = () => {
                inputAlbum.click();
            }
        }

        let listAlbumImages = [];

        if (inputAlbum) {
            inputAlbum.addEventListener("change", function() {

                file = this.files.length;
                let validExtensions = ["image/jpeg", "image/jpg", "image/png", "video/mp4", "video/ogg"];
                for (var i = 0; i < file; i++) {
                    if (validExtensions.includes(this.files[i].type)) {
                        listAlbumImages.push({
                            "name": this.files[i].name,
                            "url": URL.createObjectURL(this.files[i]),
                            "file": this.files[i],

                        })
                    } else {
                        ToastSuccess('Lỗi:', 'Có file không hợp lệ, vui lòng kiểm tra lại', 'warning', 3000);
                    }
                }

                showImageAlbum()

                function showImageAlbum() {

                    let image = "";
                    listAlbumImages.forEach((item) => {

                        image += `<div class="col-lg-2 position-relative my-4">
                        <img class="img-fluid" src="${item.url}" alt="">
                        <div class="removeFileAlbum position-absolute top-0 right-0 d-block">
                            <i class="fa-regular fa-circle-xmark text-dark" onclick="removeFileOnlyAlbum(${listAlbumImages.indexOf(item)})"></i>
                        </div>
                        </div>`;

                    })
                    $("#show-album").html(image)
                }
                window.removeFileOnlyAlbum = (e) => {
                    if (listAlbumImages.length == 1) {
                        document.querySelector("#album").value = '';
                    }
                    listAlbumImages.splice(e, 1);
                    showImageAlbum()
                }

            })
        }

        $(".button-selected-size").click(function() {
            $("#selected-size").attr("style", "display: flex!important");
            $("#selected-color").attr("style", "display: none!important");
            $("input[name='color[]']").prop('disabled', true).prop('checked', false);
            $("input[name='size[]']").prop('disabled', false).prop('checked', false)


        })

        $(".button-selected-color").click(function() {
            $("#selected-size").attr("style", "display: none!important");
            $("#selected-color").attr("style", "display: flex!important");
            $("input[name='size[]']").prop('disabled', true).prop('checked', false);
            $("input[name='color[]']").prop('disabled', false).prop('checked', false)


        })

        $(".button-selected-all").click(function() {
            $("#selected-size").attr("style", "display: flex!important");
            $("#selected-color").attr("style", "display: flex!important");
            $("input[name='color[]']").prop('disabled', false).prop('checked', false)
            $("input[name='size[]']").prop('disabled', false).prop('checked', false)


        })

        function checkSize(e) {
            let listSize = $(".btn-size");

            let check = Array.from(listSize).some((item, index) => {
                return item.value.toUpperCase() == e.toUpperCase();
            })
            return check;
        }

        const rgba = (rgba) => `#${rgba.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+\.{0,1}\d*))?\)$/).slice(1).map((n, i) => (i === 3 ? Math.round(parseFloat(n) * 255) : parseFloat(n)).toString(16).padStart(2, '0').replace('NaN', '')).join('')}`

        function checkColor(e) {
            let s = new Option().style;
            let listColor = $(".btn-color-input")
            s.color = e;
            let check = Array.from(listColor).some((item, index) => {
                return item.value == rgba(s.color);
            })


            return check;
        }

        $("#input-add-size").click(function(e) {
            let html = '';
            let valueSize = $("#text-size").val().trim();
            if (checkSize(valueSize)) {
                ToastSuccess('Lỗi:', 'Giá trị bạn chọn đã tồn tại', 'warning', 3000);
            } else {
                if (valueSize == '') {
                    ToastSuccess('Lỗi:', 'Chưa chọn size', 'warning', 3000);
                } else {
                    html += `
                    <div class="checkbox me-2">
                        <input type="checkbox" name="size[]" value="${valueSize}" class="btn-check btn-size" id="size-${valueSize}" autocomplete="off">
                        <label class="btn btn-primary fs-4" for="size-${valueSize}">${valueSize.toUpperCase()}</label>
                    </div>
                    `;
                }
                $("#template-size").append(html);
                $("#text-size").val("");
            }

        });

        $("#input-add-color").click(function(e) {
            let html = '';
            let valueColor = $("#text-color").val().trim();

            if (checkColor(valueColor)) {
                ToastSuccess('Lỗi:', 'Màu bạn chọn đã tồn tại', 'warning', 3000);
            } else {
                if (valueColor == '') {
                    ToastSuccess('Lỗi:', 'Chưa chọn màu', 'warning', 3000);
                } else {
                    html += `
                    <div class="checkbox-color me-3">
                    <input type="checkbox" class="btn-check btn-color-input" id="color-${valueColor}" name="color[]"  value="${valueColor}"  autocomplete="off">
                    <label style="background: ${valueColor};" class="rounded-circle btn-color" for="color-${valueColor}"></label>
                    </div>
                    `;
                }
                $("#template-color").append(html);
                $("#text-color").val("");
            }

        });

        // Image Product Attribute
        let imageAttribute = $("input[name='url_image[]']");

        $("#confirm-attribute").click(function() {
            let listAttributes = [];
            let listAttributeSize = [];
            let listAttributeColor = [];

            let checkedSize = $("input[name='size[]']:checked");
            let checkedColor = $("input[name='color[]']:checked");

            let trElement = '';

            if (checkedSize.length == 0 && checkedColor.length == 0) {
                ToastSuccess('Lỗi:', 'Chưa chọn phân loại sản phẩm', 'warning', 3000);
                return;
            }

            Array.from(checkedSize).forEach((item, index) => {
                listAttributeSize.push(item.value)

            })

            Array.from(checkedColor).forEach((item) => {
                listAttributeColor.push(item.value)
            })

            $(".table-attribute").show();

            let sizeLength = listAttributeSize.length
            let colorLength = listAttributeColor.length

            for (let i = 0; i < sizeLength; i++) {
                if (!checkAttributes(listAttributes, listAttributeSize[i])) {
                    listAttributes.push({
                        "size": listAttributeSize[i],
                        "color": [],
                    })
                    for (let j = 0; j < colorLength; j++) {
                        listAttributes[i].color.push(listAttributeColor[j]);
                    }
                }
            }



            if (listAttributes.length > 0) {

                let index = 0;
                listAttributes.forEach((itemSize, index) => {

                    if (itemSize.color.length > 0) {

                        itemSize.color.forEach((itemColor, index) => {

                            trElement += `
                            <tr style="vertical-align: middle;">
                                <th scope="row">${itemSize.size} <input type="hidden" value="${itemSize.size}" name="sizeText[]" ></th>
                                <th scope="row"> <label style="background: ${itemColor};" class="rounded-circle btn-color"></label> <input type="hidden" value="${itemColor}" name="colorText[]" ></th>
                                <td style="width: 200px">
                                    <input type="file" hidden id="image-attribute-${itemSize.size}-${itemColor}" class="url_image" name="url_image[]">
                                            <label for="image-attribute-${itemSize.size}-${itemColor}" class="upload-file-attribute"><img class="img-fluid" src="{{ asset("assets/images/1200px-Picture_icon_BLACK.png") }}" alt=""></label>
                                </td>
                                <td><input type="text" name="price[]" placeholder="Nhập giá bán" class="form-control w-50 input-price"></td>
                                <td><input type="text" name="sale[]" placeholder="Nhập giá sale" class="form-control w-50 input-sale"></td>
                                <td><input type="text" name="weight[]" placeholder="Nhập trọng lượng" class="form-control w-50 input-weight"></td>
                                <td><input type="text" name="quantity[]" placeholder="Nhập tồn kho" class="form-control w-50 input-quantity"></td>
                            </tr>`;
                        })

                    } else {
                        trElement += `
                            <tr style="vertical-align: middle;">
                                <th scope="row">${itemSize.size} <input type="hidden" value="${itemSize.size}" name="sizeText[]" ></th>
                                <th scope="row"> <input type="hidden" value="" name="colorText[]" > <label style="display: flex;justify-content: center;align-items: center; color: red" class="rounded-circle btn-color"><i class="fa-solid fa-circle-xmark text-red"></i></label></th>
                                <td style="width: 200px">
                                    <input type="file" hidden id="image-attribute-${itemSize.size}" class="url_image" name="url_image[]">
                                            <label for="image-attribute-${itemSize.size}" class="upload-file-attribute"><img class="img-fluid" src="{{ asset("assets/images/1200px-Picture_icon_BLACK.png") }}" alt=""></label>
                                </td>
                                <td><input type="text" name="price[]" placeholder="Nhập giá bán" class="form-control w-50 input-price"></td>
                                <td><input type="text" name="sale[]" placeholder="Nhập giá sale" class="form-control w-50 input-sale"></td>
                                <td><input type="text" name="weight[]" placeholder="Nhập trọng lượng" class="form-control w-50 input-weight"></td>
                                <td><input type="text" name="quantity[]" placeholder="Nhập tồn kho" class="form-control w-50 input-quantity"></td>
                            </tr>`;
                    }

                })
            } else {

                Array.from(checkedColor).forEach((itemColor, index) => {
                    trElement += `
                            <tr style="vertical-align: middle;">
                                <th scope="row"><input type="hidden" value="" name="sizeText[]" ><i class="fa-solid fa-circle-xmark" style="color: red"></i></th>
                                <th scope="row"> <input type="hidden" value="${itemColor.value}" name="colorText[]" > <label style="background: ${itemColor.value};" class="rounded-circle btn-color"></label></th>
                                <td style="width: 200px">
                                    <input type="file" multiple hidden class="url_image" id="image-attribute-${itemColor.value}" name="url_image[]">
                                            <label for="image-attribute-${itemColor.value}" class="upload-file-attribute"><img class="img-fluid" src="{{ asset("assets/images/1200px-Picture_icon_BLACK.png") }}" alt=""></label>
                                </td>
                                <td><input type="text" name="price[]" placeholder="Nhập giá bán" class="form-control w-50 input-price"></td>
                                <td><input type="text" name="sale[]" placeholder="Nhập giá sale" class="form-control w-50 input-sale"></td>
                                <td><input type="text" name="weight[]" placeholder="Nhập trọng lượng" class="form-control w-50 input-weight"></td>
                                <td><input type="text" name="quantity[]" placeholder="Nhập tồn kho" class="form-control w-50 input-quantity"></td>
                            </tr>`;
                })

            }

            $("#tbody").html(trElement);

            let inputFileArray = $("input.url_image");

            inputFileArray.each(function(i, obj) {
                obj.onchange = function(e) {
                    let file = e.target.files[0]
                    e.target.nextElementSibling.children[0].src = URL.createObjectURL(file)
                }
            });

            function checkAttributes(array, element) {
                return array.some((el) => el.size == element);
            }
        })

        $(document).on("keyup", "#priceSpeed, #saleSpeed, #weightSpeed, #quantitySpeed", function() {
            this.value = this.value.replace(/\D/g, '');
        })

        $("#setupValue").click(function() {
            let priceSpeed = $("#priceSpeed").val().trim();
            let saleSpeed = $("#saleSpeed").val().trim();
            let weightSpeed = $("#weightSpeed").val().trim();
            let quantitySpeed = $("#quantitySpeed").val().trim();

            if (priceSpeed == '' && saleSpeed == '' && weightSpeed == '' && quantitySpeed == '') {
                ToastSuccess('Lỗi:', 'Không có giá trị, không thể áp dụng', 'warning', 3000);
                return;
            }

            $("input.input-price").each((i, obj) => {
                obj.value = priceSpeed
                $("input.input-sale")[i].value = saleSpeed
                $("input.input-weight")[i].value = weightSpeed
                $("input.input-quantity")[i].value = quantitySpeed
            })

            $("#priceSpeed").val("")
            $("#saleSpeed").val("")
            $("#weightSpeed").val("")
            $("#quantitySpeed").val("")
        })

        $(document).on("keyup", "input.input-price, input.input-sale, input.input-weight, input.input-quantity", function() {
            this.value = this.value.replace(/\D/g, '');
        })

    });

    $(document).ready(function() {
        $(".btn-update-address").each((i, obj) => {
            obj.addEventListener("click", function() {
                $("#city-2").on("change", async function() {
                    let valueCity = await $(this).find(':selected').attr("data-codeCity");

                    await districtAddress(valueCity)
                })
                cityAddress();

                function cityAddress() {
                    $("#city-2").empty();
                    let city = '<option value="" readonly>Chọn thành phố</option>';
                    $.ajax({
                        url: "https://provinces.open-api.vn/api/p/",
                        type: "GET",
                        dataType: "json",
                        success: function(data) {

                            data.forEach((item, index) => {
                                city += `
                                    <option value="${item.name}" data-codeCity="${item.code}">${item.name}</option>
                            `;
                            })
                            $("#city-2").html(city)
                        }
                    })
                }

                function districtAddress(codeCity) {
                    $("#district-2").empty();
                    let district = '<option value="" readonly>Chọn huyện</option>';
                    $.ajax({
                        url: "https://provinces.open-api.vn/api/p/" + codeCity + "?depth=2",
                        dataType: "json",
                        type: "GET",
                        success: function(data) {
                            data.districts.forEach((item, index) => {
                                district += `
                                    <option value="${item.name}" data-idDistrict="${item.code}">${item.name}</option>
                                `;
                            })
                            $("#district-2").html(district)
                        }
                    });
                }
                let findUserByUrl = $(this).attr("data-href");
                $.ajax({
                    url: findUserByUrl,
<<<<<<< HEAD
                    type : 'GET',
                    dataType : 'json',
                    success : function(result){
                        console.log(result);
                        if(result.success){
=======
                    type: 'GET',
                    dataType: 'json',
                    success: function(result) {
                        if (result.success) {

>>>>>>> fdca0204e789172b5dcf9f662990e355b44886f3
                            $("select[name=city] option").each(async (i, obj) => {
                                if (obj.value == result.data.city) {
                                    obj.setAttribute('selected', 'selected');
                                    $("select[name=city]").trigger('change');
                                }
                            })
                            setTimeout(function() {
                                $("select[name=district] option").each((i, obj) => {
                                    if (obj.value == result.data.district) {
                                        obj.setAttribute('selected', 'selected');
                                        $("select[name=district]").trigger('change');

                                    }
                                })
                            }, 500)

                            $("#name").val(result.data.name)
                            $("#address-2").val(result.data.address);
                            $("#phone-2").val(result.data.phone);
                        }
                    }
                })
<<<<<<< HEAD
                $(".alert-danger").hide();
                $("#form-edit").submit(function(e){
                    e.preventDefault();


                    if($("#address-2").val() == "" || $("#city-2").val() == "" || $("#district-2").val() == "" || $("#phone-2").val() == ""){
=======

                $("#form-edit").submit(function(e) {
                    e.preventDefault();

                    if ($("#address-2").val() == "" || $("#city-2").val() == "" || $("#district-2").val() == "") {
>>>>>>> fdca0204e789172b5dcf9f662990e355b44886f3
                        return false;
                    }

                    let action = obj.getAttribute('data-id');
                    let route = '{{ route("user.update_address", ":action") }}';
                    route = route.replace(':action', action);
                    $.ajax({
                        url: route,
                        type: "PUT",
                        data: {
<<<<<<< HEAD
                            "_token" : $('input[name=_token]').val(),
                            "id" : action,
                            "name" : $("#name").val(),
                            "city" : $("#city-2").val(),
                            "district" : $("#district-2").val(),
                            "address" : $("#address-2").val(),
                            "phone" : $("#phone-2").val(),
                        },
                        dataType: 'json',
                        success: function(data) {
       
                            if(data.success) {
=======
                            "_token": $('input[name=_token]').val(),
                            "id": action,
                            "city": $("#city-2").val(),
                            "district": $("#district-2").val(),
                            "address": $("#address-2").val(),
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.success) {
>>>>>>> fdca0204e789172b5dcf9f662990e355b44886f3
                                alert(data.message);
                                window.location.reload();
                            } else {
                                alert(data.message);
                            }
                        }, 
                        error: function(jqXHR) {
                            let msg = '';
                            
                            for (var key in jqXHR.responseJSON.errors) {
                                    if (jqXHR.responseJSON.errors.hasOwnProperty(key)) {
                                       msg += '<li>'+jqXHR.responseJSON.errors[key][0]+'</li>';
                                    }
                            }
                            $(".alert-danger").show();
                            $("#ulEl").html(msg)
                        }
                    })
                })
            })
        })

        $("#add_new_address").click(function() {
            $("#city").val("")
            $("#district").val("")
            $("#address").val("")
        })

        $("#btn-attribute").click(function() {
            let input_attribute = $("#add-attribute").val().trim();
            if ($("#add-attribute").val() == '') {
                ToastSuccess('Lỗi:', 'Chưa chọn thuộc tính', 'warning', 3000);
                return;
            }
            if (checkAttribute(input_attribute)) {
                ToastSuccess('Lỗi:', 'Đã tồn tại thuộc tính', 'warning', 3000);
                return;
            }
            let attributeElement = `
            <div class="checkbox-attribute me-2">
                <input type="radio" value="${input_attribute}" name="attribute" class="btn-check btn-attribute" id="attribute-${input_attribute}" autocomplete="off">
                <label class="btn btn-primary fs-4" for="attribute-${input_attribute}">${input_attribute}</label>
            </div>
            `;

            $("#show-attribute").append(attributeElement)
            $("#add-attribute").val("");
        })

        function checkAttribute(value) {
            return Array.from($(".btn-attribute")).some((item, index) => {
                return item.value == value;
            })
        }
    })
</script>


<script>
    $(document).ready(function() {
        $('.container__modals').click(function(e) {
            $(this).hide();
            $('.container__modal').hide();
        });
        $('.container__modal--header__icon_close').click(function(e) {
            $('.container__modals').hide();
            $('.container__modal').hide();
        });
        $('.add_new_voucher').click(function(e) {
            $('.container__modals').show();
            $('.modals--add--voucher').show();
        });
    });

    $('.btn_use_voucher').click(function(e) {
        e.preventDefault();
        const id = $(this).attr('data-id');
        $('.modal__user__voucher_' + id).show();
        $('.container__modals').show();
    })

    $('.button_make_code_random').click(async (e) => {
        e.preventDefault();
        let status = false;
        while (status == false) {
            const code = make_code();
            const url__submit = '{{route("user.check_code")}}';
            const _csrf = '{{ csrf_token() }}';
            const data = {
                code: code,
                _token: _csrf
            };
            const check = await check_code(code, url__submit, data);
            if (check == 0) {
                status = true;
                $('.input_code_voucher').val(code);
            };
        };
    })

    function check_code(code, url__submit, data) {
        return $.ajax({
            url: url__submit,
            type: 'POST',
            data: data
        });
    };

    function make_code() {
        let code = '';
        const possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for (var i = 0; i < 8; i++) {
            code += possible.charAt(Math.floor(Math.random() * possible.length));
        }
        return code;
    };

    $('.btn-submit-form-add-voucher').click(function() {
        $('.modals--add--voucher--main').submit();
    });

    $('.btn-view-code-voucher').click(function() {
        const action = $(this).attr('data-action');
        if (action == 'hide') {
            $(this).html('Xem code');
            $(this).attr('data-action', 'show');
        } else {
            const code = $(this).attr('data-code');
            $(this).html(code);
            $(this).attr('data-action', 'hide');
        }
    });

    $('.btn-add-wishlist').click(function(e) {
        e.preventDefault();
        const id = $(this).attr('data-id');
        const url__submit = '{{route("user.add_wishlist")}}';
        const _csrf = '{{ csrf_token() }}';
        const data = {
            id: id,
            _token: _csrf
        };
        $.ajax({
            url: url__submit,
            type: 'POST',
            data: data,
            success:function(res) {
                const json = JSON.parse(res);
                if(json.method == "add") {
                    $(this).addClass('wishlist__add');
                }else {
                    $(this).removeClass('wishlist__add');
                }
                ToastSuccess('Thành công:', 'Sản phẩm đã được '+json.message+' wishlist', json.status, 3000);
            }.bind(this)
        });
    })
</script>

@yield('scripts')

<script>
     // api address
     let selecteCity = $("#city")
    let selecteDistrict = $("#district")

    let cityOld = ''
    let districtOld = ''
    @isset($store)
        var cityByStore = "{!! $store->city !!}"; 
        cityOld = cityByStore

        var districtByStore = "{!! $store->district !!}"; 
        districtOld = districtByStore
    @endisset
  
   console.log(cityOld);

    loadCity()
    selecteCity.on("change", async function() {

        let selectedCity = await $(this).find(':selected').attr("data-codeCity");
        await loadDistricts(selectedCity)
    })

    function loadCity() {
        selecteCity.empty();
        let city = '<option value="" readonly>Chọn thành phố</option>';
        $.ajax({
            url: "https://provinces.open-api.vn/api/p/",
            type: "GET",
            dataType: "json",
            success: function(data) {

                data.forEach((item, index) => {
                    city += `
                            <option value="${item.name}" ${item.name == cityOld ? 'selected' : ''} data-codeCity="${item.code}">${item.name}</option>
                    `;
                })
                $("#city").html(city)
                selecteCity.trigger("change")
            }
        })
    }

    function loadDistricts(codeCity) {
        selecteDistrict.empty();
        let district = '<option value="" readonly>Chọn huyện</option>';
        $.ajax({
            url: "https://provinces.open-api.vn/api/p/" + codeCity + "?depth=2",
            dataType: "json",
            type: "GET",
            success: function(data) {
                data.districts.forEach((item, index) => {
                    district += `
                            <option value="${item.name}" ${item.name == districtOld ? 'selected' : ''} data-idDistrict="${item.code}">${item.name}</option>
                        `;
                })
                $("#district").html(district)
                selecteDistrict.trigger('change')
            }
        });

    }
</script>