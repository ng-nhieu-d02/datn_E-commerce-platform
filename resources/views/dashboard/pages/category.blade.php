@extends('dashboard.layout.main')

@section('content')

<div class="container__section__content">
    <div class="content content__voucher">
        <div class="content__voucher__header">
            <div class="content__voucher__header__title">
                <p class="font-semibold">Category Manager</p>
            </div>
            <div class="content__voucher__header__button">
                <button class="text-white py-2 px-4 rounded button__toggle__modals">
                    Thêm Category
                </button>
            </div>
        </div>
        <div class="content__voucher__table">
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left">
                    <caption class="text-2xl font-semibold text-left text-white pb-10">
                        Our vouchers
                        <p class="mt-1 text-[1.3rem] font-normal text-white pt-3">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
                    </caption>
                    @include('dashboard.layout.ingredient.alert')
                    <thead class="text-xl border-b uppercase text-white rounded-lg">
                        <tr>
                            <th scope="col" class="py-5">
                                Voucher Name
                            </th>
                            <th scope="col" class="py-5">
                                Loại
                            </th>
                            <th scope="col" class="py-5">
                                Trị giá
                            </th>
                            <th scope="col" class="py-5">
                                Còn lại
                            </th>
                            <th scope="col" class="py-5">
                                Kiểu
                            </th>
                            <th scope="col" class="py-5">
                                Trạng thái
                            </th>
                            <th scope="col" class="py-5">
                                <span class="sr-only">Action</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-[1.4rem]">
                        @foreach($coupons as $coupon)
                        <tr class="border-b">
                            <th scope="row" class="py-4 font-medium whitespace-nowrap">
                                {{$coupon->name}}
                            </th>
                            <td class="py-4">
                                {{$coupon->type == 0 ? 'Giảm tiền' : ($coupon->type == 1 ? 'Giảm %' : 'FreeShip')}}
                            </td>
                            <td class="py-4 ">
                                {{number_format($coupon->value)}}
                            </td>
                            <td class="py-4">
                                {{number_format($coupon->quantity - $coupon->remaining_quantity)}}
                            </td>
                            <td class="py-4">
                                @if($coupon->coupon_type == 0)
                                <span class="bg-blue-100 text-blue-800 text-[1.3rem] font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">Public</span>
                                @else
                                <span class="bg-yellow-100 text-yellow-800 text-[1.3rem] font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-200 dark:text-yellow-900">Private</span>
                                @endif
                            </td>
                            <td class="py-4">
                                @if($coupon->status == 0)
                                <span class="bg-green-100 text-green-800 text-[1.3rem] font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">Normal</span>
                                <a href="{{route('admin.update_voucher', [$coupon->id, 1])}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Block</a> 
                                @else
                                <span class="bg-pink-100 text-pink-800 text-[1.3rem] font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-pink-200 dark:text-pink-900">Expired</span>
                                <a href="{{route('admin.update_voucher', [$coupon->id, 0])}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Unlock</a> 
                                @endif
                            </td>
                            <td class="py-4 text-right">
                                <span class="bg-purple-100 text-purple-800 text-[1.3rem] font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-purple-200 dark:text-purple-90 cursor-pointer btn-view-code" data-code="{{$coupon->code}}">View code</span>
                                |
                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Remove</a> 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{$coupons->links('dashboard.layout.ingredient.pagination')}}

            <!-- Main modal -->
            <div id="defaultModal" aria-hidden="true" class="py-40 hidden overflow-x-hidden absolute top-0 right-0 left-0 z-50 p-4 w-full md:inset-0 h-modal md:h-full">
                <div class="relative w-full m-auto max-w-6xl h-full md:h-auto bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal content -->
                    <form method="POST" enctype="multipart/form-data" action="{{route('admin.add_voucher')}}">
                        @csrf
                        <!-- Modal header -->
                        <div class="flex justify-between items-baseline p-4 rounded-t border-b dark:border-gray-600">
                            <h3 class="text-[1.55rem] font-semibold text-gray-900 dark:text-white">
                                Add new Voucher
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

                            <div class="relative z-0 mb-7 w-full group">
                                <input type="text" name="name" id="name" class="block py-2.5 px-0 w-full text-[1.4rem] text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="name" class="peer-focus:font-medium absolute text-[1.4rem] text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-2 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Name voucher</label>
                            </div>
                            <div class="relative z-0 mb-7 mt-3 w-full group">
                                <input type="text" name="code" id="code" class="block py-2.5 px-0 w-full text-[1.4rem] text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="code" class="peer-focus:font-medium absolute text-[1.4rem] text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-2 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Code voucher</label>
                            </div>

                            <label class="block mb-7">
                                <span class="sr-only">Choose File</span>
                                <input type="file" name="avatar" class="block pt-3 border-b-[1px] file:p-4 w-full text-[1.4rem] text-gray-500 file:mr-4 file:rounded-full file:border-0 file:text-1.4rem file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required />
                            </label>

                            <ul class="grid gap-3 w-full md:grid-cols-3 mb-7 ">
                                <li>
                                    <input type="radio" id="reduce_money" name="type" value="0" class="hidden peer" required>
                                    <label for="reduce_money" class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">Giảm tiền</div>
                                            <div class="w-full text-[1.4rem]">Giảm tiền theo hoá đơn</div>
                                        </div>
                                        <svg aria-hidden="true" class="ml-3 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" id="reduce_percent" name="type" value="1" class="hidden peer" required>
                                    <label for="reduce_percent" class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">Giảm %</div>
                                            <div class="w-full text-[1.4rem]">Giảm % theo hoá đơn</div>
                                        </div>
                                        <svg aria-hidden="true" class="ml-3 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" id="reduce_ship" name="type" value="2" class="hidden peer" required>
                                    <label for="reduce_ship" class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">FreeShip</div>
                                            <div class="w-full text-[1.4rem]">Giảm phí ship</div>
                                        </div>
                                        <svg aria-hidden="true" class="ml-3 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </label>
                                </li>
                            </ul>

                            <div class="relative z-0 mb-7 w-full group mt-3">
                                <input type="text" name="description" id="description" class="block py-2.5 px-0 w-full text-[1.4rem] text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="description" class="peer-focus:font-medium absolute text-[1.4rem] text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-2 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Description</label>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 mb-7 mt-3 w-full group">
                                    <input type="number" name="order_lowest" id="order_lowest" class="block py-2.5 px-0 w-full text-[1.4rem] text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="order_lowest" class="peer-focus:font-medium absolute text-[1.4rem] text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-2 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Áp dụng cho hoá đơn thấp nhất</label>
                                </div>
                                <div class="relative z-0 mb-7 mt-3 w-full group">
                                    <input type="number" name="order_biggest" id="order_biggest" class="block py-2.5 px-0 w-full text-[1.4rem] text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="order_biggest" class="peer-focus:font-medium absolute text-[1.4rem] text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-2 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Áp dụng cho hoá đơn lớn nhất</label>
                                </div>
                            </div>
                            <div date-rangepicker class="w-full grid md:grid-cols-2 md:gap-6 m-0">
                                <div class="relative w-full">
                                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-7 h-7 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-[1.4rem] rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 p-5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start" required>
                                </div>

                                <div class="relative w-full">
                                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-7 h-7 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-[1.4rem] rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 p-5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end" required>
                                </div>
                            </div>

                            <div class="grid md:grid-cols-3 md:gap-3 mb-7">
                                <div class="relative z-0 mb-7 mt-3 w-full group">
                                    <input type="number" name="value" id="value" class="block py-2.5 px-0 w-full text-[1.4rem] text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="value" class="peer-focus:font-medium absolute text-[1.4rem] text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-2 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Value</label>
                                </div>
                                <div class="relative z-0 mb-7 mt-3 w-full group">
                                    <input type="number" name="max_value" id="max_value" class="block py-2.5 px-0 w-full text-[1.4rem] text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="max_value" class="peer-focus:font-medium absolute text-[1.4rem] text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-2 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Max value</label>
                                </div>
                                <div class="relative z-0 mb-7 mt-3 w-full group">
                                    <input type="number" name="quantity" id="quantity" class="block py-2.5 px-0 w-full text-[1.4rem] text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="quantity" class="peer-focus:font-medium absolute text-[1.4rem] text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-2 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Số lượng</label>
                                </div>
                            </div>

                            <ul class="grid gap-3 w-full md:grid-cols-2 mb-7">
                                <li>
                                    <input type="radio" id="type_public" name="type_event" value="0" class="hidden peer" required>
                                    <label for="type_public" class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">Sự kiện</div>
                                            <div class="w-full text-[1.4rem]">Mọi người có thể chọn code nhanh</div>
                                        </div>
                                        <svg aria-hidden="true" class="ml-3 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" id="type_private" name="type_event" value="1" class="hidden peer" required>
                                    <label for="type_private" class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">Riêng tư</div>
                                            <div class="w-full text-[1.4rem]">Mọi người phải tự nhập code để áp dụng</div>
                                        </div>
                                        <svg aria-hidden="true" class="ml-3 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </label>
                                </li>
                            </ul>

                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center justify-end p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                            <button data-modal-toggle="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-[1.4rem] font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                            <button data-modal-toggle="defaultModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-[1.4rem] px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection