<div class="container__modals" style="display: none;"></div>
<div id="notify--toast"></div>
<audio id="ring">
    <source src="{{asset('assets/mp3/chuong.mp3')}}" type="audio/mpeg">
</audio>

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


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{ url('assets/js/hc-canvas-luckwheel.js') }}"></script>

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
                        const index = id;
                        const val = detail.filter(({
                            id
                        }) => id == index);
                        val[0].quantity = quantity;
                        update_total();
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
                    Swal.fire(
                        'Thất bại',
                        'Số lượng sản phẩm không hợp lệ. <br> Vui lòng kiểm tra lại',
                        'error'
                    )
                } else {
                    quantity.val(Number(quantity.val()) - 1);
                }
            } else {
                if ((Number(quantity.val()) + 1) > Number(quantity_detail.val())) {
                    Swal.fire(
                        'Thất bại',
                        'Số lượng sản phẩm trong kho không đủ. <br> Rất tiếc vì sự bất tiện này',
                        'error'
                    )
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
                            Swal.fire(
                                'Thành công',
                                'Đã xoá sản phẩm này khỏi giỏ hàng',
                                'success'
                            );
                            parentElement.remove();
                            $('.tip__cartBar').text(Number($('.tip__cartBar').text()) - 1);
                        } else {
                            Swal.fire(
                                'Thất bại',
                                'Có lỗi gì đó. <br> Vui lòng thử lại.',
                                'error'
                            );
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
                Swal.fire(
                    'Lỗi',
                    'Địa chỉ không được để trống. <br> Vui lòng thử lại.',
                    'error'
                )
                return;
            }

            if (paymentMethod == null) {
                Swal.fire(
                    'Lỗi',
                    'Kiểu thanh toán không được để trống. <br> Vui lòng thử lại.',
                    'error'
                )
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
                Swal.fire(
                    'Lỗi',
                    'Chỉ chấp nhận file ảnh. <br> Vui lòng thử lại.',
                    'error'
                )
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
                        Swal.fire(
                            'Lỗi',
                            'Có file không hợp lệ. <br> Vui lòng kiểm tra lại.',
                            'error'
                        )
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
                Swal.fire(
                    'Lỗi',
                    'Giá trị bạn chọn đã tồn tại. <br> Vui lòng kiểm tra lại.',
                    'error'
                )
            } else {
                if (valueSize == '') {
                    Swal.fire(
                        'Lỗi',
                        'Chưa chọn size. <br> Vui lòng kiểm tra lại.',
                        'error'
                    )
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
                Swal.fire(
                    'Lỗi',
                    'Màu bạn chọn đã tồn tại. <br> Vui lòng thử lại.',
                    'error'
                )
            } else {
                if (valueColor == '') {
                    Swal.fire(
                        'Lỗi',
                        'Chưa chọn màu. <br> Vui lòng thử lại.',
                        'error'
                    )
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

                Swal.fire(
                    'Lỗi',
                    'Chưa chọn phân loại sản phẩm. <br> Vui lòng thử lại.',
                    'error'
                )
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
                                    <input type="file" required hidden id="image-attribute-${itemSize.size}-${itemColor}" class="url_image" name="url_image[]">
                                            <label for="image-attribute-${itemSize.size}-${itemColor}" class="upload-file-attribute"><img class="img-fluid" src="{{ asset("assets/images/1200px-Picture_icon_BLACK.png") }}" alt=""></label>
                                </td>
                                <td><input type="text" required name="price[]" placeholder="Nhập giá bán" class="form-control w-50 input-price"></td>
                                <td><input type="text" required name="sale[]" placeholder="Nhập giá sale" class="form-control w-50 input-sale"></td>
                                <td><input type="text" required name="weight[]" placeholder="Nhập trọng lượng" class="form-control w-50 input-weight"></td>
                                <td><input type="text" required name="quantity[]" placeholder="Nhập tồn kho" class="form-control w-50 input-quantity"></td>
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
                                <td><input type="text" required name="price[]" placeholder="Nhập giá bán" class="form-control w-50 input-price"></td>
                                <td><input type="text" required name="sale[]" placeholder="Nhập giá sale" class="form-control w-50 input-sale"></td>
                                <td><input type="text" required name="weight[]" placeholder="Nhập trọng lượng" class="form-control w-50 input-weight"></td>
                                <td><input type="text" required name="quantity[]" placeholder="Nhập tồn kho" class="form-control w-50 input-quantity"></td>
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
                                <td><input type="text" required name="price[]" placeholder="Nhập giá bán" class="form-control w-50 input-price"></td>
                                <td><input type="text" required name="sale[]" placeholder="Nhập giá sale" class="form-control w-50 input-sale"></td>
                                <td><input type="text" required name="weight[]" placeholder="Nhập trọng lượng" class="form-control w-50 input-weight"></td>
                                <td><input type="text" required name="quantity[]" placeholder="Nhập tồn kho" class="form-control w-50 input-quantity"></td>
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
                Swal.fire(
                    'Lỗi',
                    'Không có giá trị, không thể áp dụng. <br> Vui lòng thử lại.',
                    'error'
                )
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
                    type: 'GET',
                    dataType: 'json',
                    success: function(result) {
                        console.log(result);
                        if (result.success) {
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
                            $("#email-2").val(result.data.email);

                        }
                    }
                })
                $("#form-edit").submit(function(e) {
                    e.preventDefault();

                    if ($("#address-2").val() == "" || $("#city-2").val() == "" || $("#district-2").val() == "") {
                        return false;
                    }

                    let action = obj.getAttribute('data-id');
                    let route = '{{ route("user.update_address", ":action") }}';
                    route = route.replace(':action', action);
                    $.ajax({
                        url: route,
                        type: "PUT",
                        data: {
                            "_token": $('input[name=_token]').val(),
                            "id": action,
                            "name": $("#name").val(),
                            "city": $("#city-2").val(),
                            "district": $("#district-2").val(),
                            "address": $("#address-2").val(),
                            "phone": $("#phone-2").val(),
                            "email": $("#email-2").val(),
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            $(".alert-danger").hide();
                        },
                        success: function(data) {
                            if (data.success) {
                                Swal.fire(
                                    'Thành công',
                                    data.message + '. <br>',
                                    'sưccess'
                                )
                                window.location.reload();
                            } else {
                                Swal.fire(
                                    'Lỗi',
                                    data.message + '. <br> Vui lòng thử lại.',
                                    'error'
                                )
                            }
                        },
                        error: function(jqXHR) {
                            let msg = '';

                            for (var key in jqXHR.responseJSON.errors) {
                                if (jqXHR.responseJSON.errors.hasOwnProperty(key)) {
                                    msg += '<li>' + jqXHR.responseJSON.errors[key][0] + '</li>';
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

                Swal.fire(
                    'Lỗi',
                    'Chưa chọn thuộc tính. <br> Vui lòng thử lại.',
                    'error'
                )
                return;
            }
            if (checkAttribute(input_attribute)) {
                Swal.fire(
                    'Lỗi',
                    'Đã tồn tại thuộc tính. <br> Vui lòng thử lại.',
                    'error'
                )
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
            success: function(res) {
                const json = JSON.parse(res);
                if (json.method == "add") {
                    $(this).addClass('wishlist__add');
                } else {
                    $(this).removeClass('wishlist__add');
                }
                Swal.fire(
                    'Thành công',
                    'Sản phẩm đã được ' + json.message + ' wishlist',
                    'success'
                )
            }.bind(this)
        });
    })
</script>
<script>
    // api address
    let selecteCity = $("#city")
    let selecteDistrict = $("#district")

    let cityOld = ''
    let districtOld = ''

    <?php if (isset($store)) { ?>
        var cityByStore = "{!! $store->city !!}";
        cityOld = cityByStore

        var districtByStore = "{!! $store->district !!}";
        districtOld = districtByStore
    <?php } ?>

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
<script src="https://cdn.socket.io/4.0.1/socket.io.min.js" integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU" crossorigin="anonymous"></script>
<script>
    $(function() {
        var ting = document.getElementById('ring');
        const auth = "{{Auth::check()}}";
        let ip_address = 'server.nguyennhieu1507.cf';
        let id = 0;
        if (auth == true) {
            id = '{{ isset(Auth::user()->id) ? Auth::user()->id : "0" }}';
            let socket = io(ip_address, {
                auth: {
                    'session': id
                }
            });
            socket.on('new_chat', (message) => {
                if ($('.container--messages') != undefined) {
                    ting.play();
                    const element = ` 
                        <li class="left clearfix">
                                <span class="chat-img pull-left">
                                    <img style="object-fit: contain;" src="${message.subject.avatar}" alt="User Avatar">
                                </span>
                                <div class="chat-body clearfix" style="background-image: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
                                    <div class="header">
                                        <strong class="primary-font">${message.subject.name}</strong>
                                        <small class="pull-right text-muted"><i class="fa fa-clock-o"></i> just sent a few seconds ago</small>
                                    </div>
                                    <p style="    padding-top: 10px;">
                                        ${message.chat.message}
                                    </p>
                                </div>
                            </li> `;
                    const room = `
                        <li class="room__${message.chat.id_room}" style="background: aliceblue;padding-left: 10px;border-bottom-left-radius: 20px;border-top-left-radius: 20px;">
                            <a href="" class="clearfix">
                                <img style="object-fit: cover; border-radius: 50%" src="${message.subject.avatar}" alt="" class="img-circle">
                                <div class="friend-name">
                                    <strong>${message.subject.name}</strong>
                                </div>
                                <div class="last-message text-muted old">${message.chat.message}.</div>
                                <small class="time text-muted">just sent</small>
                            </a>
                        </li>`;
                    $('.room__' + message.chat.id_room).remove();
                    $('.friend-list').append(room);
                    $('.container__messages__room__' + message.chat.id_room).append(element);
                }
                ToastSuccess('success', 'Bạn có tin nhắn mới', 'success', 5000)
            });
            $('.btn-submit-message').click(function(e) {
                e.preventDefault();
                const message = $('.message_send').val();
                if (message == '') {
                    Swal.fire(
                        'Lỗi',
                        'Tin nhắn trống',
                        'error'
                    )
                    return;
                }
                const id_store = $(this).attr('data-id');
                const room = $(this).attr('data-room');
                const type = $(this).attr('data-type');
                send_message(id_store, message, room, type, socket);
                $('.message_send').val('');
            });
        }



        async function send_message(store, message, room, type, socket) {
            const url__submit = '{{route("user.send_chat")}}';
            const _csrf = '{{ csrf_token() }}';
            const data = {
                id_store: store,
                message: message,
                room: room,
                type: type,
                _token: _csrf
            };
            $.ajax({
                url: url__submit,
                type: 'POST',
                data: data,
                success: function(res) {
                    if (res == 'error') {
                        console.log('error');
                    } else {
                        const response = JSON.parse(res);
                        const element = ` 
                        <li class="right clearfix">
                            <span class="chat-img pull-right">
                                <img style="object-fit: contain;" src="${response.subject.avatar}" alt="User Avatar">
                            </span>
                            <div class="chat-body clearfix" style="background-image: linear-gradient(-135deg, #f5f7fa 0%, #c3cfe2 100%);">
                                <div class="header">
                                    <strong class="primary-font">${response.subject.name}</strong>
                                    <small class="pull-right text-muted"><i class="fa fa-clock-o"></i>  just sent a few seconds ago</small>
                                </div>
                                <p style="    padding-top: 10px;">
                                    ${response.chat.message}
                                </p>
                            </div>
                        </li>   `;
                        $('.container--messages').append(element);
                        $('.container__messages__room__0').addClass('container__messages__room__' + response.chat.id_room);
                        $('.btn-submit-message').attr('data-room', response.chat.id_room);
                        const room = `
                            <li class="room__${response.chat.id_room}" style="background: aliceblue;padding-left: 10px;border-bottom-left-radius: 20px;border-top-left-radius: 20px;">
                                <a href="" class="clearfix">
                                    <img style="object-fit: cover; border-radius: 50%" src="${response.subject_to.avatar}" alt="" class="img-circle">
                                    <div class="friend-name">
                                        <strong>${response.subject_to.name}</strong>
                                    </div>
                                    <div class="last-message text-muted old">${response.chat.message}.</div>
                                    <small class="time text-muted">just sent</small>
                                </a>
                            </li>`;
                        $('.room__' + response.chat.id_room).remove();
                        $('.friend-list').append(room);

                        return socket.emit('chat', response);
                    }
                }
            });
        }
    });
</script>

@include('home.layout.ingredient.errorFunction')

@yield('scripts')