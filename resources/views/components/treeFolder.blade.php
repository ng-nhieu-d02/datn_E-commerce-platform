@props(['categories'])

<style>
    .treeMenu {
        display: flex;
        flex-direction: column;
    }

    .treeMenu ul {
        padding-top: 10px;
    }

    .treeMenu ul ol {
        padding: 10px 10px;
        border: solid 1px #ffff;
        border-radius: 5px;
        margin-left: calc(var(--parent) * 50px);
        position: relative;
    }

    .treeMenu ul ol::before {
        content: '';
        position: absolute;
        border-left: calc(var(--border) * 1px) solid #999;
        height: calc(100%);
        top: -10px;
        left: -25px;
        width: 1px;
    }

    .treeMenu ul ol::after {
        content: '';
        position: absolute;
        border-top: calc(var(--border) * 1px) solid #999;
        width: 25px;
        left: -25px;
    }

    .treeMenu ul ol li {
        list-style: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
    }

    .treeMenu ul ol li div {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .treeMenu ul ol li div i,
    .treeMenu ul ol li div img,
    .treeMenu ul ol li div span {
        font-size: 1.43rem;
        user-select: none !important;
    }

    .treeMenu ul.active ol li div i.fa-chevron-circle-up {
        display: none;
    }

    .treeMenu ul.active ol li div i.fa-chevron-circle-down {
        display: block;
    }

    .treeMenu ul ol li div i.fa-chevron-circle-up {
        display: block;
    }

    .treeMenu ul ol li div i.fa-chevron-circle-down {
        display: none;
    }
</style>
<div class="treeMenu">
    @foreach ($categories as $key => $cate)
    <ul style="--parent: {{$cate->level - 1}};--border: {{$cate->level == 1 ? '0' : '1'}}" class="parent-{{$cate->parent_id}} ul_parent {{$cate->level == 1 ? ' ' : 'hidden'}} {{$cate->recursive_parent($cate->id) > 0 ? 'active' : ''}}">
        <ol>
            <li>
                <div class="{{$cate->recursive_parent($cate->id) > 0 ? 'parent_element' : ''}}" data-parent="parent-{{$cate->id}}">
                    <img class="w-10 h-10 rounded" src="{{asset('upload/category/'. $cate->avatar)}}" alt="Default avatar">
                    <span>{{$cate->name}}</span>
                </div>
                <div>
                    <i class="fa fa-wrench update_menu" data-id="{{$cate->id}}"></i>
                    <a href="{{route('admin.delete_category', $cate->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a> 
                    @if($cate->recursive_parent($cate->id) > 0)
                    <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                    <i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
                    @endif
                </div>
            </li>
        </ol>
    </ul>
    <div id="defaultModal" aria-hidden="true" class="defaultModals_{{$cate->id}} py-40 hidden overflow-x-hidden absolute top-0 right-0 left-0 z-50 p-4 w-full md:inset-0 h-modal md:h-full">
        <div class="relative w-full m-auto max-w-6xl h-full md:h-auto bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal content -->
            <form method="POST" enctype="multipart/form-data" action="{{route('admin.update_category', $cate->id)}}">
                @csrf
                <!-- Modal header -->
                <div class="flex justify-between items-baseline p-4 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-[1.55rem] font-semibold text-gray-900 dark:text-white">
                        Update category
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
                        <input type="text" value="{{$cate->name}}" name="name" id="name" class="block py-2.5 px-0 w-full text-[1.4rem] text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                        <label for="name" class="peer-focus:font-medium absolute text-[1.4rem] text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-2 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Name category</label>
                    </div>

                    <label class="block mb-7">
                        <span class="sr-only">Choose File</span>
                        <input type="file" value="{{$cate->avatar}}" name="avatar" class="block pt-3 border-b-[1px] file:p-4 w-full text-[1.4rem] text-gray-500 file:mr-4 file:rounded-full file:border-0 file:text-1.4rem file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    </label>

                    <div class="relative z-0 mb-7 w-full group">
                        <input type="text" value="{{$cate->title}}" name="title" id="title" class="block py-2.5 px-0 w-full text-[1.4rem] text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                        <label for="title" class="peer-focus:font-medium absolute text-[1.4rem] text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-2 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Title</label>
                    </div>

                    <div class="relative z-0 mb-7 w-full group">
                        <input type="text" value="{{$cate->keyword}}" name="keyword" id="keyword" class="block py-2.5 px-0 w-full text-[1.4rem] text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                        <label for="keyword" class="peer-focus:font-medium absolute text-[1.4rem] text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-2 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Keyword</label>
                    </div>

                    <label for="underline_select" class="sr-only">Underline select</label>
                    <select id="underline_select" name="parent_id" class="block py-2.5 px-0 w-full text-[1.4rem] text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option value="0" {{$cate->parent_id == 0 ? 'selected' : ''}}>Danh mục cha</option>
                        @foreach ($categories as $key => $cateB)
                        <option value="{{$cateB->id}}" {{$cate->parent_id == $cateB->id ? 'selected' : ''}} style="padding-left: 10px">{{ str_repeat('--', $cateB->level).' '. $cateB->name}}</option>
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
    @endforeach
</div>