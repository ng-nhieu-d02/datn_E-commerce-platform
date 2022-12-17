@extends('home.layout.main')

@section('content')
<div class="PageAbout">
    <div>
        <div class="SectionHero relative">
            <div class=" flex lg:flex-row items-center lg:text-left">
                <div class="col-sm-5">
                    <h2 class="text font-semibold"  style="font-size: 2.3rem; margin-bottom: 20px">👋 About Us.</h2>
                    <span class="block" style="font-size: 1.6rem; padding-right:30px"> We’re impartial and independent, and every day we create distinctive, world-class programmes and content which inform, educate and entertain millions of people in the around the world.</span>
                </div>
                <div class="col-sm-7">
                    <img style="width: 100%;" src="{{asset('assets/images/about.png')}}" alt>
                </div>
            </div>
        </div>
        <div class="SectionFouder relative">
            <div class="Section-Heading relative">
                <div class>
                    <h2 class="font-semibold" style="font-size: 2.3rem; margin-bottom:20px">⛱ Founder</h2>
                    <span class="block" style="font-size: 1.6rem; padding-right:30px">We’re impartial and independent, and every day we create distinctive, world-class programmes and content</span>
                </div>
            </div>
            <div style="margin-top: 20px;">
                <div style="width: 100%;display:grid; grid-template-columns: repeat(5, 1fr); gap:10px">
                    <div class="col">
                        <div class="Image relative rounded-xl">
                            <img src="{{asset('assets/images/mem.jpg')}}" style="width: 100%;" class=" inset-0 object-cover">
                            <h3 class="text-lg font-semibold text-neutral-900 mt-4 md:text-xl dark:text-neutral-200">Nguyễn Nhiễu</h3>
                            <span class="block" style="font-size: 15px;">Leader </span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="Image relative rounded-xl">
                            <img src="{{asset('assets/images/mem.jpg')}}" style="width: 100%;" class=" inset-0 object-cover">
                            <h3 class="text-lg font-semibold text-neutral-900 mt-4 md:text-xl dark:text-neutral-200">Văn Thảo</h3>
                            <span class="block" style="font-size: 15px;">Member</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="Image relative rounded-xl">
                            <img src="{{asset('assets/images/mem.jpg')}}" style="width: 100%;" class=" inset-0 object-cover">
                            <h3 class="text-lg font-semibold text-neutral-900 mt-4 md:text-xl dark:text-neutral-200">Thanh Phong</h3>
                            <span class="block" style="font-size: 15px;">Member</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="Image relative rounded-xl">
                            <img src="{{asset('assets/images/mem.jpg')}}" style="width: 100%;" class=" inset-0 object-cover">
                            <h3 class="text-lg font-semibold text-neutral-900 mt-4 md:text-xl dark:text-neutral-200">Xuân Phát</h3>
                            <span class="block" style="font-size: 15px;">Member</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="Image relative rounded-xl">
                            <img src="{{asset('assets/images/tung.jpg ')}}" style="width: 100%;" class=" inset-0 object-cover">
                            <h3 class="text-lg font-semibold text-neutral-900 mt-4 md:text-xl dark:text-neutral-200">Phạm Tùng</h3>
                            <span class="block" style="font-size: 15px;">Member</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection