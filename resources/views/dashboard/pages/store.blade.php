@extends('dashboard.layout.main')

@section('content')

@include('dashboard.layout.ingredient.alert')

@if($tickets->count() > 0)
<div class="container__section__content">
    <div class="content content__voucher">
        <div class="content__voucher__header">
            <div class="content__voucher__header__title flex gap-5 items-center">
                <p class="font-semibold">Manager Ticket Store</p>
                <div class="inline-flex justify-center items-center w-8 h-8 text-[1.2rem] font-medium text-white bg-red-500 rounded-full border-2 border-white dark:border-gray-900">{{$tickets->count()}}</div>
            </div>
            <div class="content__voucher__header__button">
                <button class="hidden text-white py-2 px-4 rounded button__toggle__modals">
                    Thêm store
                </button>
            </div>
        </div>
        <div class="content__voucher__table">
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left">
                    <thead class="text-xl border-b uppercase text-white rounded-lg">
                        <tr>
                            <th scope="col" class="py-5">
                                User Create
                            </th>
                            <th scope="col" class="py-5">
                                Store Name
                            </th>

                            <th scope="col" class="py-5">
                                Message
                            </th>
                            <th scope="col" class="py-5">
                                Status
                            </th>
                            <th scope="col" class="py-5">
                                Created_at
                            </th>
                            <th scope="col" class="py-5">
                                <span class="sr-only">Action</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-[1.4rem]">
                        @foreach($tickets as $ticket)

                        <tr class="border-b">
                            <th scope="row" class="py-4 font-medium whitespace-nowrap">
                                {{$ticket->user->name}}
                            </th>
                            <td class="py-4">
                                {{$ticket->store->name}}
                            </td>

                            <td class="py-4">
                                {{$ticket->message}}
                            </td>
                            <td class="py-4">
                                @if($ticket->status == 0)
                                <span class="bg-yellow-100 text-yellow-800 text-[1.3rem] font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-200 dark:text-yellow-900">Đang xử lý</span>
                                @elseif($ticket->status == 1)
                                <span class="bg-green-100 text-green-800 text-[1.3rem] font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">Đã duyệt</span>
                                @elseif($ticket->status == 2)
                                <span class="bg-pink-100 text-pink-800 text-[1.3rem] font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-pink-200 dark:text-pink-900">Từ chối</span>
                                @endif
                            </td>
                            <td class="py-4">
                                {{$ticket->created_at}}
                            </td>
                            <td class="py-4 text-right">
                                <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer btn-view-store" data-store="{{$ticket->store->slug}}_{{$ticket->id}}">View</a>
                            </td>
                        </tr>
                        <!-- Main modal -->
                        <div id="defaultModal" aria-hidden="true" class="{{$ticket->store->slug}}_{{$ticket->id}} py-40 hidden overflow-x-hidden fixed top-0 right-0 left-0 z-50 p-4 w-full md:inset-0 h-modal md:h-full">
                            <div class="relative w-full m-auto max-w-6xl h-full md:h-auto bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal content -->

                                <!-- Modal header -->
                                <div class="flex justify-between items-baseline p-4 rounded-t border-b dark:border-gray-600">
                                    <h3 class="text-[1.55rem] font-semibold text-gray-900 dark:text-white">
                                        Details ticket {{$ticket->id}}
                                    </h3>
                                    <button type="button" class="button__close__modals text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-[1.5rem] p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                                        <svg aria-hidden="true" class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="bg-gray-200 dark:bg-gray-900 flex flex-wrap items-center justify-center">
                                    <div class="container bg-white rounded dark:bg-gray-800 shadow-lg transform duration-200 easy-in-out m-12">
                                        <div class="h-2/4 sm:h-64 overflow-hidden">
                                            <img class="w-full rounded-t" src="{{ asset('upload/store/backgrounds/' . $ticket->store->background) }}" alt="Photo by aldi sigun on Unsplash" />
                                        </div>
                                        <div class="flex justify-start px-5 -mt-12 mb-5">
                                            <span clspanss="block relative h-32 w-32">
                                                <img alt="Photo by aldi sigun on Unsplash" src="{{ asset('upload/store/avatars/' . $ticket->store->avatar) }}" class="mx-auto object-cover rounded-full h-24 w-24 bg-white p-1" />
                                            </span>
                                        </div>
                                        <div class="">
                                            <div class="px-7 mb-8">
                                                <h2 class="text-3xl font-bold text-green-800 dark:text-gray-300">{{$ticket->store->name}} ({{$ticket->store->slogan}})</h2>
                                                <p class="text-gray-800 font-medium mt-4 dark:text-gray-300">Boss: {{$ticket->store->boss()->where('permission','0')->first()->user->name}}</p>
                                                <p class="text-gray-800 font-medium mt-4 dark:text-gray-300 text-[1.4rem]">Loại shop:

                                                    @foreach($ticket->store->store_cate as $cate)
                                                    <span>
                                                        {{$cate->name}},
                                                    </span>
                                                    @endforeach
                                                </p>

                                                <div class="flex items-center my-3">
                                                    <svg aria-hidden="true" class="w-7 h-7 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <title>First star</title>
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                    <svg aria-hidden="true" class="w-7 h-7 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <title>Second star</title>
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                    <svg aria-hidden="true" class="w-7 h-7 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <title>Third star</title>
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                    <svg aria-hidden="true" class="w-7 h-7 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <title>Fourth star</title>
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                    <svg aria-hidden="true" class="w-7 h-7 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <title>Fifth star</title>
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                    <p class="ml-2 text-[1.35rem] font-medium text-gray-500 dark:text-gray-400">{{$ticket->store->comment()->count() > 0 ? number_format($ticket->store->comment()->sum('rate') / $ticket->store->comment()->count(), 1, '.', ',') : '0'}} out of 5 ({{$ticket->store->comment()->count()}} review)</p>
                                                </div>
                                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 my-7 gap-2">
                                                    <div class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
                                                        <div class="cursor-pointer flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                                                            <i style="font-size: 1.8rem;" class="fa fa-area-chart stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out" aria-hidden="true"></i>
                                                        </div>
                                                        <div class="text-right">
                                                            <p class="text-[1.4rem]">{{number_format($ticket->store->product()->count())}}</p>
                                                            <p class="text-[1.3rem]">Product</p>
                                                        </div>
                                                    </div>
                                                    <div class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
                                                        <div class="cursor-pointer flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                                                            <svg width="25" height="25" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                                            </svg>
                                                        </div>
                                                        <div class="text-right">
                                                            <p class="text-[1.4rem]">{{number_format($ticket->store->order()->count())}}</p>
                                                            <p class="text-[1.3rem]">Orders</p>
                                                        </div>
                                                    </div>
                                                    <div class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
                                                        <div class="cursor-pointer flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                                                            <svg width="25" height="25" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                                            </svg>
                                                        </div>
                                                        <div class="text-right">
                                                            <p class="text-[1.4rem]">{{number_format($ticket->store->order()->where('status_order','3')->count())}}</p>
                                                            <p class="text-[1.3rem]">Success</p>
                                                        </div>
                                                    </div>
                                                    <div class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
                                                        <div class="cursor-pointer flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                                                            <svg width="25" height="25" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                            </svg>
                                                        </div>
                                                        <div class="text-right">
                                                            <p class="text-[1.4rem]">{{number_format($ticket->store->money)}}</p>
                                                            <p class="text-[1.3rem]">Money</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="mt-2 font-normal text-gray-600 dark:text-gray-300 text-[1.4rem]">Địa chỉ: {{$ticket->store->address}} - {{$ticket->store->district}} - {{$ticket->store->city}}</p>
                                                <p class="mt-2 font-normal text-gray-600 dark:text-gray-300 text-[1.4rem]">Ngày tạo: {{$ticket->store->created_at}}</p>

                                                <div class="flex flex-wrap justify-center gap-2 sm:gap-4 mt-8">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal footer -->
                                <div class="flex items-center justify-end p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                                    <button data-modal-toggle="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-[1.4rem] font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                        <a href="{{route('admin.update_ticket_store', [$ticket->id, 1])}}"> Duyệt </a>
                                    </button>
                                    <button data-modal-toggle="defaultModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-[1.4rem] px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

                                        <a href="{{route('admin.update_ticket_store', [$ticket->id, 2])}}"> Từ chối </a>
                                    </button>
                                    <button data-modal-toggle="defaultModal" type="button" class="button__close__modals text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-[1.4rem] font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                        Đóng
                                    </button>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$tickets->links('dashboard.layout.ingredient.pagination')}}


        </div>
    </div>
</div>
@endif


<div class="container__section__content">
    <div class="content content__voucher">
        <div class="content__voucher__header">
            <div class="content__voucher__header__title">
                <p class="font-semibold">Manager Store</p>
            </div>
            <div class="content__voucher__header__button">
                <button class="hidden text-white py-2 px-4 rounded button__toggle__modals">
                    Thêm store
                </button>
            </div>
        </div>
        <div class="content__voucher__table">
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left">
                    <caption class="text-2xl font-semibold text-left text-white pb-10">
                        Our Store
                        <p class="mt-1 text-[1.3rem] font-normal text-white pt-3">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
                    </caption>
                    <thead class="text-xl border-b uppercase text-white rounded-lg">
                        <tr>
                            <th scope="col" class="py-5">
                                Name
                            </th>
                            <th scope="col" class="py-5">
                                Slogan
                            </th>

                            <th scope="col" class="py-5">
                                Address
                            </th>
                            <th scope="col" class="py-5">
                                Status
                            </th>
                            <th scope="col" class="py-5">
                                Created_at
                            </th>
                            <th scope="col" class="py-5">
                                <span class="sr-only">Action</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-[1.4rem]">
                        @foreach($stores as $store)

                        <tr class="border-b">
                            <th scope="row" class="py-4 font-medium whitespace-nowrap">
                                {{$store->name}}
                            </th>
                            <td class="py-4">
                                {{$store->slogan}}
                            </td>

                            <td class="py-4">
                                {{$store->address}} - {{$store->district}} - {{$store->city}}
                            </td>
                            <td class="py-4">
                                @if($store->status == 0)
                                <span class="bg-yellow-100 text-yellow-800 text-[1.3rem] font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-200 dark:text-yellow-900">Đang kiểm duyệt</span>
                                @elseif($store->status == 1)
                                <span class="bg-green-100 text-green-800 text-[1.3rem] font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">Hoạt động</span>
                                @elseif($store->status == 2)
                                <span class="bg-pink-100 text-pink-800 text-[1.3rem] font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-pink-200 dark:text-pink-900">Bị khoá</span>
                                @endif
                            </td>
                            <td class="py-4">
                                {{$store->created_at}}
                            </td>
                            <td class="py-4 text-right">
                                <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline btn-view-store cursor-pointer" data-store="{{$store->slug}}">View</a>
                            </td>
                        </tr>
                        <!-- Main modal -->
                        <div id="defaultModal" aria-hidden="true" class="{{$store->slug}} py-40 hidden overflow-x-hidden fixed top-0 right-0 left-0 z-50 p-4 w-full md:inset-0 h-modal md:h-full">
                            <div class="relative w-full m-auto max-w-6xl h-full md:h-auto bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal content -->

                                <!-- Modal header -->
                                <div class="flex justify-between items-baseline p-4 rounded-t border-b dark:border-gray-600">
                                    <h3 class="text-[1.55rem] font-semibold text-gray-900 dark:text-white">
                                        Details store {{$store->name}}
                                    </h3>
                                    <button type="button" class="button__close__modals text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-[1.5rem] p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                                        <svg aria-hidden="true" class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="bg-gray-200 dark:bg-gray-900 flex flex-wrap items-center justify-center">
                                    <div class="container bg-white rounded dark:bg-gray-800 shadow-lg transform duration-200 easy-in-out m-12">
                                        <div class="h-2/4 sm:h-64 overflow-hidden">
                                            <img class="w-full rounded-t" src="{{ asset('upload/store/backgrounds/' . $store->background) }}" alt="Photo by aldi sigun on Unsplash" />
                                        </div>
                                        <div class="flex justify-start px-5 -mt-12 mb-5">
                                            <span clspanss="block relative h-32 w-32">
                                                <img alt="Photo by aldi sigun on Unsplash" src="{{ asset('upload/store/avatars/' . $store->avatar) }}" class="mx-auto object-cover rounded-full h-24 w-24 bg-white p-1" />
                                            </span>
                                        </div>
                                        <div class="">
                                            <div class="px-7 mb-8">
                                                <h2 class="text-3xl font-bold text-green-800 dark:text-gray-300">{{$store->name}} ({{$store->slogan}})</h2>
                                                <p class="text-gray-800 font-medium mt-4 dark:text-gray-300">Boss: {{$store->boss()->where('permission','0')->first()->user->name}}</p>
                                                <p class="text-gray-800 font-medium mt-4 dark:text-gray-300 text-[1.4rem]">Loại shop:

                                                    @foreach($store->store_cate as $cate)
                                                    <span>
                                                        {{$cate->name}},
                                                    </span>
                                                    @endforeach
                                                </p>

                                                <div class="flex items-center my-3">
                                                    <svg aria-hidden="true" class="w-7 h-7 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <title>First star</title>
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                    <svg aria-hidden="true" class="w-7 h-7 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <title>Second star</title>
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                    <svg aria-hidden="true" class="w-7 h-7 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <title>Third star</title>
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                    <svg aria-hidden="true" class="w-7 h-7 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <title>Fourth star</title>
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                    <svg aria-hidden="true" class="w-7 h-7 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <title>Fifth star</title>
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                    <p class="ml-2 text-[1.35rem] font-medium text-gray-500 dark:text-gray-400">{{$store->comment()->count() > 0 ? number_format($store->comment()->sum('rate') / $store->comment()->count(), 1, '.', ',') : '0'}} out of 5 ({{$store->comment()->count()}} review)</p>
                                                </div>
                                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 my-7 gap-2">
                                                    <div class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
                                                        <div class="cursor-pointer flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                                                            <i style="font-size: 1.8rem;" class="fa fa-area-chart stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out" aria-hidden="true"></i>
                                                        </div>
                                                        <div class="text-right">
                                                            <p class="text-[1.4rem]">{{number_format($store->product()->count())}}</p>
                                                            <p class="text-[1.3rem]">Product</p>
                                                        </div>
                                                    </div>
                                                    <div class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
                                                        <div class="cursor-pointer flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                                                            <svg width="25" height="25" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                                            </svg>
                                                        </div>
                                                        <div class="text-right">
                                                            <p class="text-[1.4rem]">{{number_format($store->order()->count())}}</p>
                                                            <p class="text-[1.3rem]">Orders</p>
                                                        </div>
                                                    </div>
                                                    <div class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
                                                        <div class="cursor-pointer flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                                                            <svg width="25" height="25" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                                            </svg>
                                                        </div>
                                                        <div class="text-right">
                                                            <p class="text-[1.4rem]">{{number_format($store->order()->where('status_order','3')->count())}}</p>
                                                            <p class="text-[1.3rem]">Success</p>
                                                        </div>
                                                    </div>
                                                    <div class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
                                                        <div class="cursor-pointer flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                                                            <svg width="25" height="25" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                            </svg>
                                                        </div>
                                                        <div class="text-right">
                                                            <p class="text-[1.4rem]">{{number_format($store->money)}}</p>
                                                            <p class="text-[1.3rem]">Money</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="mt-2 font-normal text-gray-600 dark:text-gray-300 text-[1.4rem]">Địa chỉ: {{$store->address}} - {{$store->district}} - {{$store->city}}</p>
                                                <p class="mt-2 font-normal text-gray-600 dark:text-gray-300 text-[1.4rem]">Ngày tạo: {{$store->created_at}}</p>

                                                <div class="flex flex-wrap justify-center gap-2 sm:gap-4 mt-8">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal footer -->
                                <div class="flex items-center justify-end p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                                    @if($store->status == 2)
                                    <button data-modal-toggle="defaultModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-[1.4rem] px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <a href="{{route('admin.update_store', [$store->id, 1])}}"> Unlock </a>
                                    </button>
                                    @else
                                    <button data-modal-toggle="defaultModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-[1.4rem] px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

                                        <a href="{{route('admin.update_store', [$store->id, 2])}}"> Block </a>
                                    </button>
                                    @endif
                                    <button data-modal-toggle="defaultModal" type="button" class="button__close__modals text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-[1.4rem] font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                        Đóng
                                    </button>
                                </div>

                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{$tickets->links('dashboard.layout.ingredient.pagination')}}



        </div>
    </div>
</div>
@endsection