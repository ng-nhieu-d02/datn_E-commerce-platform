<!-- jQuery -->
<script src="{{ url('assets/js/jquery-3.6.0.min.js')}}"></script>

<!-- Slick -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script>
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

    $(document).ready(function() {
        const city = $("#city");
        const district = $("#district");
        const ward = $("#ward");
        let list_city = "<option class='fs--12'>Choose...</option>";
        let list_district = "<option class='fs--12'>Choose...</option>";
        let list_ward = "<option class='fs--12'>Choose...</option>";

        $.ajax({
            url: "https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/province",
            type: "GET",
            beforeSend: function(request) {
                request.setRequestHeader("Token", "f2a7666f-4923-11ec-ac64-422c37c6de1b");
            },
            success: function(data) {
                let length = data.data.length;
                for (let i = length - 1; i > 0; i--) {
                    list_city += `<option class='fs--12' value=${data.data[i].ProvinceID}>${data.data[i].ProvinceName}</option>`
                }
                city.html(list_city);
            }
        })

        city.change(function() {
            $("#city_selected").val(city.find(':selected').text());
            list_district = "<option class='fs--12'>Choose...</option>";
            $.ajax({
                url: "https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/district",
                type: "GET",
                beforeSend: function(request) {
                    request.setRequestHeader("Token", "f2a7666f-4923-11ec-ac64-422c37c6de1b");
                },
                data: {
                    "province_id": $(this).val()
                },
                success: function(data) {
                    let length = data.data.length;
                    for (let i = length - 1; i > 0; i--) {
                        list_district += `<option class='fs--12' value=${data.data[i].DistrictID}>${data.data[i].DistrictName}</option>`
                    }
                    district.html(list_district);
                }
            })
        })

        district.change(function() {
            $("#district_selected").val(district.find(':selected').text());
            list_ward = "<option class='fs--12'>Choose...</option>";
            $.ajax({
                url: `https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/ward?district_id=${$(this).val()}`,
                type: "GET",
                beforeSend: function(request) {
                    request.setRequestHeader("Token", "f2a7666f-4923-11ec-ac64-422c37c6de1b");
                },
                success: function(data) {
                    let length = data.data.length;
                    for (let i = 0; i < length; i++) {
                        list_ward += `<option  class='fs--12' value=${data.data[i].WardCode}>${data.data[i].WardName}</option>`
                    }
                    ward.html(list_ward);
                }
            })
        })
    });

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

    function zoom(e) {
        var zoom = e.currentTarget;
        e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
        e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
        x = (offsetX / zoom.offsetWidth) * 100
        y = (offsetY / zoom.offsetHeight) * 100
        zoom.style.backgroundPosition = x + "% " + y + "%";
    }
</script>