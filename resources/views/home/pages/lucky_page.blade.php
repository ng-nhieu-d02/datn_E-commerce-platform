@extends('home.layout.main')

@section('content')

<div class="page--home">

    <section id="luckywheel" class="hc-luckywheel" style="margin-top:100px; margin-bottom: 100px">
        <div class="hc-luckywheel-container">
            <canvas class="hc-luckywheel-canvas" width="500px" height="500px">Vòng Xoay May Mắn</canvas>
        </div>
        <a class="hc-luckywheel-xoay" href="javascript:;">Xoay</a>
        <button class="hc-luckywheel-btn" style="display: none;"></button>
    </section>

</div>

@endsection

@section('scripts')
<script>
    var isPercentage = true;
    var prizes = [{
            text: "FreeShip 10k",
            img: "{{asset('assets/images/logo.png')}}",
            number: 1, // 1%,
            percentpage: 0 // 1%
        },
        {
            text: "FreeShip 20k",
            img: "{{asset('assets/images/logo.png')}}",
            number: 1,
            percentpage: 0 // 5%
        },
        {
            text: "Thẻ giảm giá 10k",
            img: "{{asset('assets/images/logo.png')}}",
            number: 1,
            percentpage: 0 // 10%
        },
        {
            text: "Thẻ giảm giá 20K",
            img: "{{asset('assets/images/logo.png')}}",
            number: 1,
            percentpage: 0 // 24%
        },
        {
            text: "10.000 vào tài khoản",
            img: "{{asset('assets/images/logo.png')}}",
            number: 1,
            percentpage: 0 // 24%
        },
        {
            text: "20.000 vào tài khoản",
            img: "{{asset('assets/images/logo.png')}}",
            number: 1,
            percentpage: 0 // 24%
        },
        {
            text: "Chúc bạn may mắn lần sau",
            img: "{{asset('assets/images/logo.png')}}",
            number: 5,
            percentpage: 0 // 60%
        },
    ];
    $('.hc-luckywheel-xoay').click(function(e) {
        e.preventDefault();
        const user = '{{Auth::check()}}';
        if (!user) {
            return Swal.fire(
                'Lỗi',
                'Vui lòng đăng nhập để tiếp tục',
                'error'
            )
        } else {
            const url__submit = '{{route("user.lucky_random")}}';
            $.ajax({
                url: url__submit,
                type: 'GET',
                success: function(res) {
                    if (res == 'error') {
                        return Swal.fire(
                            'Lỗi',
                            'Không có lượt quay để thực hiện',
                            'error'
                        )
                    } else {
                        for (let i = 0; i < prizes.length; i++) {
                            if (prizes[i].percentpage == 1) {
                                prizes[i].percentpage = 0;
                            }
                        }
                        prizes[res].percentpage = 1;
                        $('.hc-luckywheel-btn').click();
                    }
                }.bind(this)
            });
        }
    })
    document.addEventListener(
        "DOMContentLoaded",
        function() {
            hcLuckywheel.init({
                id: "luckywheel",
                config: function(callback) {
                    callback &&
                        callback(prizes);
                },
                mode: "both",
                getPrize: function(callback) {
                    var rand = randomIndex(prizes);
                    var chances = rand;
                    callback && callback([rand, chances]);
                },
                gotBack: function(data) {
                    if (data == null) {
                        Swal.fire(
                            'Chương trình kết thúc',
                            'Đã hết phần thưởng',
                            'error'
                        )
                    } else if (data == 'Chúc bạn may mắn lần sau') {
                        Swal.fire(
                            'Bạn không trúng thưởng',
                            data,
                            'error'
                        )
                    } else {
                        Swal.fire(
                            'Đã trúng giải',
                            data,
                            'success'
                        )
                    }
                }
            });
        },
        false
    );

    function randomIndex(prizes) {
        if (isPercentage) {
            var counter = 1;
            for (let i = 0; i < prizes.length; i++) {
                if (prizes[i].number == 0) {
                    counter++
                }
            }
            if (counter == prizes.length) {
                return null
            }
            let prizeIndex = 0;
            for (let i = 0; i < prizes.length; i++) {
                if (prizes[i].percentpage == 1) {
                    prizeIndex = i;
                }
            }

            return prizeIndex;
        }
    }
</script>
@endsection