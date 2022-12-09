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
                        Our category
                        <p class="mt-1 text-[1.3rem] font-normal text-white pt-3">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
                    </caption>
                    @include('dashboard.layout.ingredient.alert')
                </table>
            </div>
            <!-- Main modal -->
            <div id="defaultModal" aria-hidden="true" class="py-40 hidden overflow-x-hidden absolute top-0 right-0 left-0 z-50 p-4 w-full md:inset-0 h-modal md:h-full">
                <div class="relative w-full m-auto max-w-6xl h-full md:h-auto bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal content -->
                    <form method="POST" enctype="multipart/form-data" action="{{route('admin.store_category')}}">
                        @csrf
                        <!-- Modal header -->
                        <div class="flex justify-between items-baseline p-4 rounded-t border-b dark:border-gray-600">
                            <h3 class="text-[1.55rem] font-semibold text-gray-900 dark:text-white">
                                Add new category
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
                                <label for="name" class="peer-focus:font-medium absolute text-[1.4rem] text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-2 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Name category</label>
                            </div>

                            <label class="block mb-7">
                                <span class="sr-only">Choose File</span>
                                <input type="file" name="avatar" class="block pt-3 border-b-[1px] file:p-4 w-full text-[1.4rem] text-gray-500 file:mr-4 file:rounded-full file:border-0 file:text-1.4rem file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required />
                            </label>

                            <div class="relative z-0 mb-7 w-full group">
                                <input type="text" name="title" id="title" class="block py-2.5 px-0 w-full text-[1.4rem] text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="title" class="peer-focus:font-medium absolute text-[1.4rem] text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-2 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Title</label>
                            </div>

                            <div class="relative z-0 mb-7 w-full group">
                                <input type="text" name="keyword" id="keyword" class="block py-2.5 px-0 w-full text-[1.4rem] text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="keyword" class="peer-focus:font-medium absolute text-[1.4rem] text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-2 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Keyword</label>
                            </div>

                            <label for="underline_select" class="sr-only">Underline select</label>
                            <select id="underline_select" name="parent_id" class="block py-2.5 px-0 w-full text-[1.4rem] text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                <option selected value="0">Danh mục cha</option>
                                @foreach ($categories as $key => $cate)
                                <option value="{{$cate->id}}" style="padding-left: 10px">{{ str_repeat('--', $cate->level).' '. $cate->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Modal footer -->
                        <div class="flex items-center justify-end p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                            <button data-modal-toggle="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-[1.4rem] font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                            <button data-modal-toggle="defaultModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-[1.4rem] px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                        </div>
                    </form>
                </div>
            </div>

            <x-treeFolder :categories="$categories"></x-treeFolder>


        </div>
    </div>
</div>

@endsection