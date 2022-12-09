@extends('dashboard.layout.main')

@section('content')

<div class="container__section__content">
    <div class="content content__voucher">
        <div class="content__voucher__header">
            <div class="content__voucher__header__title">
                <p class="font-semibold">Member</p>
            </div>
            <div class="content__voucher__header__button">
                <button class="hidden text-white py-2 px-4 rounded button__toggle__modals">
                    Thêm member
                </button>
            </div>
        </div>
        <div class="content__voucher__table">
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left">
                    <caption class="text-2xl font-semibold text-left text-white pb-10">
                        Our member
                        <p class="mt-1 text-[1.3rem] font-normal text-white pt-3">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
                    </caption>
                    @include('dashboard.layout.ingredient.alert')
                    <thead class="text-xl border-b uppercase text-white rounded-lg">
                        <tr>
                            <th scope="col" class="py-5">
                                Create At
                            </th>
                            <th scope="col" class="py-5">
                                Create By
                            </th>
                            <th scope="col" class="py-5">
                                Amount
                            </th>
                            <th scope="col" class="py-5">
                                Type
                            </th>
                            <th scope="col" class="py-5">
                                Description
                            </th>
                            <th scope="col" class="py-5">
                                Status
                            </th>
                            <th scope="col" class="py-5">
                                <span class="sr-only">Action</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-[1.4rem]">
                        @foreach($payments as $payment)
                        <tr class="border-b">
                            <th class="py-4 ">
                                {{$payment->created_at}}
                            </th>
                            <td scope="row" class="py-4 font-medium whitespace-nowrap flex items-center gap-3">
                                <div class="relative">
                                    <img class="w-10 h-10 rounded" src="{{ asset('upload/store/avatars/' . $payment->store->avatar) }}" alt="">
                                    <span class="absolute bottom-0 left-8 transform translate-y-1/4 w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
                                </div>

                                {{$payment->store->name}}
                            </td>
                            <td class="py-4">
                                {{number_format($payment->amount)}}
                            </td>
                            <td class="py-4 ">
                                {{$payment->type == 0 ? 'Nạp tiền' : 'Rút tiền'}}
                            </td>
                            <td class="py-4">
                                {{$payment->description}}
                            </td>
                            <td class="py-4">
                                @if($payment->status == 0)
                                <span class="bg-yellow-100 text-yellow-800 text-[1.3rem] font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-200 dark:text-yellow-900">processing</span>
                                @elseif($payment->status == 1)
                                <span class="bg-green-100 text-green-800 text-[1.3rem] font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">success</span>
                                @else
                                <span class="bg-pink-100 text-pink-800 text-[1.3rem] font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-pink-200 dark:text-pink-900">cancel</span>
                                @endif
                            </td>
                            <td class="py-4 text-right">
                                @if($payment->type == 1 && $payment->status == 0)
                                <span data-id="{{$payment->id}}" class="update_menu cursor-pointer bg-blue-100 text-blue-800 text-[1.3rem] font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">censor</span>
                                @endif
                            </td>
                        </tr>
                        @if($payment->type == 1 && $payment->status == 0)
                        <!-- Main modal -->
                        <div id="defaultModal" aria-hidden="true" class="defaultModals_{{$payment->id}} py-40 hidden overflow-x-hidden fixed top-0 right-0 left-0 z-50 p-4 w-full md:inset-0 h-modal md:h-full">
                            <div class="relative w-full m-auto max-w-6xl h-full md:h-auto bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal content -->

                                <!-- Modal header -->
                                <div class="flex justify-between items-baseline p-4 rounded-t border-b dark:border-gray-600">
                                    <h3 class="text-[1.55rem] font-semibold text-gray-900 dark:text-white">
                                        Info payment
                                    </h3>
                                    <button type="button" class="button__close__modals text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-[1.5rem] p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                                        <svg aria-hidden="true" class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-6 space-y-6">
                                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                                        <div>
                                            <label for="first_name" class="block mb-2 text-[1.4rem] font-medium text-gray-900 dark:text-white">Số tiền rút</label>
                                            <input type="text" value="{{number_format($payment->amount)}}" readonly id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-[1.4rem] rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                        </div>
                                        <div>
                                            <label for="last_name" class="block mb-2 text-[1.4rem] font-medium text-gray-900 dark:text-white">Số tiền nhận được</label>
                                            <input type="text" value="{{number_format($payment->amount / 100 * 95)}}" readonly id="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-[1.4rem] rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <label for="name_bank" class="block mb-2 text-[1.4rem] font-medium text-gray-900 dark:text-white">Ngân hàng rút</label>
                                        <input type="text" readonly value="{{$payment->bank->name_bank}}" id="name_bank" class="bg-gray-50 border border-gray-300 text-gray-900 text-[1.4rem] rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    </div>
                                    <div class="mb-6">
                                        <label for="password" class="block mb-2 text-[1.4rem] font-medium text-gray-900 dark:text-white">Số tài khoản</label>
                                        <input type="text" readonly value="{{$payment->bank->stk}}" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-[1.4rem] rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    </div>
                                    <div class="mb-6">
                                        <label for="confirm_password" class="block mb-2 text-[1.4rem] font-medium text-gray-900 dark:text-white">Chủ tài khoản</label>
                                        <input type="text" readonly value="{{$payment->bank->chu_tk}}" id="confirm_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-[1.4rem] rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="flex items-center justify-end p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                                    <button data-modal-toggle="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-[1.4rem] font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"><a href="{{route('admin.update_payment', [$payment->id, 2])}}">Decline</a> </button>
                                    <button data-modal-toggle="defaultModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-[1.4rem] px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><a href="{{route('admin.update_payment', [$payment->id, 1])}}"> I accept </a></button>
                                </div>

                            </div>
                        </div>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{$payments->links('dashboard.layout.ingredient.pagination')}}


        </div>
    </div>
</div>

@endsection