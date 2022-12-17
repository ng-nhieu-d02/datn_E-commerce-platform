@extends('home.layout.main')

@section('content')
<div class="h-28 top-0 w--full bg-sky-50"></div>
<div class="page--search">
    <div class="container p-0">
        <main>
            <div class="box--search -mt-225">
                <form method="GET">
                    <div class="inner-form bg-white">
                        <div class="input-field first-wrap">
                            <div class="svg-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z">
                                    </path>
                                </svg>
                            </div>
                            <input id="search" name="search" type="text" placeholder="Type your keeywords?" />
                        </div>
                        <div class="input-field second-wrap">
                            <button type="submit" style="border:none; background-color:none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-right-circle-fill btn-search" viewBox="0 0 16 16">
                                    <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
                                </svg>
                            </button>

                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
    <div class="container p-0">
        <main>
            <div class="flex flex-col relative">
                <div class="flex flex-col flex-row items-center justify-between box--nav--fillter">
                    <div class="flex nth-child">
                        <div class="btn-group text-base nth-child" role="group" aria-label="Basic radio toggle button group">
                            <div class="div">
                                <input type="radio" class="btn-check" name="btnradio" value="0" id="btnradio0" autocomplete="off" checked>
                                <label class="btn text-base lb--check rounded-full" for="btnradio0">Tất cả</label>
                            </div>
                            @foreach ($getAllCategoryProducts as $cateProduct)
                            <div class="div">
                                <input type="radio" class="btn-check" name="btnradio" value="{{ $cateProduct->id }}" id="btnradio{{ $cateProduct->id }}" autocomplete="off">
                                <label class="btn text-base lb--check rounded-full" for="btnradio{{ $cateProduct->id }}">{{ $cateProduct->name }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex flex-shrink-0 text-right">
                        <button onclick=" btnFilter()" class="btn btn-secondary btn--filter rounded-full text-base lb--check btn--bg--dark flex items-center justify-center">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M14.3201 19.07C14.3201 19.68 13.92 20.48 13.41 20.79L12.0001 21.7C10.6901 22.51 8.87006 21.6 8.87006 19.98V14.63C8.87006 13.92 8.47006 13.01 8.06006 12.51L4.22003 8.47C3.71003 7.96 3.31006 7.06001 3.31006 6.45001V4.13C3.31006 2.92 4.22008 2.01001 5.33008 2.01001H18.67C19.78 2.01001 20.6901 2.92 20.6901 4.03V6.25C20.6901 7.06 20.1801 8.07001 19.6801 8.57001" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M16.07 16.52C17.8373 16.52 19.27 15.0873 19.27 13.32C19.27 11.5527 17.8373 10.12 16.07 10.12C14.3027 10.12 12.87 11.5527 12.87 13.32C12.87 15.0873 14.3027 16.52 16.07 16.52Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M19.87 17.12L18.87 16.12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <span class="ms-3">Filter</span>
                            <span class="absolute top-1/2 -translate-y-1/2 right-5 ms-5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-4 h-4 rotate-180">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
                <div id="filter--show" class="flex flex-col flex-row items-center justify-between">
                    <div class="flex nth-child--2">
                        <div class="btn-group">
                            <button type="button" class="btn text-base btn--sub--filter dropdown-toggle rounded-full flex items-center justify-center lb--check" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>Price</span>
                            </button>
                            <div class="dropdown-menu text-base btn--size--show rounded--1em w--screen w--20">
                                <div class="relative flex flex-col px-4 py-4 space-y-5">
                                    <div class="page--search--title">
                                        <label for="page--search--title" class="text-base">Price range</label>
                                    </div>
                                    <div class="price--slider">
                                        <div class="progress"></div>
                                    </div>
                                    <div class="range--input">
                                        <input type="range" class="range-min" min="0" max="1000000" value="250000" step="100">
                                        <input type="range" class="range-max" min="0" max="1000000" value="750000" step="100">
                                    </div>
                                    <div class="price--input">
                                        <div class="field">
                                            <span>Min</span>
                                            <input type="number" class="input-min" value="250000">
                                        </div>
                                        <div class="separator">-</div>
                                        <div class="field">
                                            <span>Max</span>
                                            <input type="number" class="input-max" value="750000">
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 flex items-center justify-between">
                                    <button class="btn rounded-full text-base lb--check btn--bg--light btn--sort--clear relative inline-flex items-center justify-center rounded-full ">Clear</button>
                                    <button class="btn btn-dark rounded-full text-base lb--check btn--bg--dark btn--sort--apply relative inline-flex items-center justify-center rounded-full transition-colors">Apply</button>
                                </div>
                            </div>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn text-base btn--sub--filter dropdown-toggle rounded-full flex items-center justify-center lb--check" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 2V5" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M16 2V5" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M7 13H15" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M7 17H12" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M16 3.5C19.33 3.68 21 4.95 21 9.65V15.83C21 19.95 20 22.01 15 22.01H9C4 22.01 3 19.95 3 15.83V9.65C3 4.95 4.67 3.69 8 3.5H16Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <span class="ms-3">Categories</span>
                            </button>

                            <div class="dropdown-menu text-base btn--size--show rounded--1em w--screen w--20">
                                <div class="relative flex flex-col px-4 py-4 space-y-5" id="show-category-children">
                                    <div class="form-check flex items-center">
                                        <input class="form-check-input mt-0" id="check-all" type="checkbox" value="" aria-label="Checkbox for following text input">
                                        <label class="form-check-label px-3" for="flexRadioDefault1">All Categories</label>
                                    </div>
                                    @foreach ($getCategoryProductChildren as $cateProductChild)
                                    <div class="form-check flex items-center">
                                        <input class="form-check-input mt-0 children" id="flexRadioDefault{{ $cateProductChild->id }}" type="checkbox" name="cate_product[]" value="{{ $cateProductChild->id }}" aria-label="Checkbox for following text input">
                                        <label class="form-check-label px-3" for="flexRadioDefault{{ $cateProductChild->id }}">{{ $cateProductChild->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="p-4 flex items-center justify-between">
                                    <button class="btn rounded-full text-base lb--check btn--bg--light btn--sort--clear relative inline-flex items-center justify-center rounded-full ">Clear</button>
                                    <button class="btn btn-dark rounded-full text-base lb--check btn--bg--dark btn--sort--apply relative inline-flex items-center justify-center rounded-full transition-colors">Apply</button>
                                </div>
                            </div>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn text-base btn--sub--filter dropdown-toggle rounded-full flex items-center justify-center lb--check" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-paint-bucket" viewBox="0 0 16 16">
                                    <path d="M6.192 2.78c-.458-.677-.927-1.248-1.35-1.643a2.972 2.972 0 0 0-.71-.515c-.217-.104-.56-.205-.882-.02-.367.213-.427.63-.43.896-.003.304.064.664.173 1.044.196.687.556 1.528 1.035 2.402L.752 8.22c-.277.277-.269.656-.218.918.055.283.187.593.36.903.348.627.92 1.361 1.626 2.068.707.707 1.441 1.278 2.068 1.626.31.173.62.305.903.36.262.05.64.059.918-.218l5.615-5.615c.118.257.092.512.05.939-.03.292-.068.665-.073 1.176v.123h.003a1 1 0 0 0 1.993 0H14v-.057a1.01 1.01 0 0 0-.004-.117c-.055-1.25-.7-2.738-1.86-3.494a4.322 4.322 0 0 0-.211-.434c-.349-.626-.92-1.36-1.627-2.067-.707-.707-1.441-1.279-2.068-1.627-.31-.172-.62-.304-.903-.36-.262-.05-.64-.058-.918.219l-.217.216zM4.16 1.867c.381.356.844.922 1.311 1.632l-.704.705c-.382-.727-.66-1.402-.813-1.938a3.283 3.283 0 0 1-.131-.673c.091.061.204.15.337.274zm.394 3.965c.54.852 1.107 1.567 1.607 2.033a.5.5 0 1 0 .682-.732c-.453-.422-1.017-1.136-1.564-2.027l1.088-1.088c.054.12.115.243.183.365.349.627.92 1.361 1.627 2.068.706.707 1.44 1.278 2.068 1.626.122.068.244.13.365.183l-4.861 4.862a.571.571 0 0 1-.068-.01c-.137-.027-.342-.104-.608-.252-.524-.292-1.186-.8-1.846-1.46-.66-.66-1.168-1.32-1.46-1.846-.147-.265-.225-.47-.251-.607a.573.573 0 0 1-.01-.068l3.048-3.047zm2.87-1.935a2.44 2.44 0 0 1-.241-.561c.135.033.324.11.562.241.524.292 1.186.8 1.846 1.46.45.45.83.901 1.118 1.31a3.497 3.497 0 0 0-1.066.091 11.27 11.27 0 0 1-.76-.694c-.66-.66-1.167-1.322-1.458-1.847z" />
                                </svg>
                                <span class="ms-3">Color</span>
                            </button>
                            <div class="dropdown-menu text-base btn--size--show rounded--1em w--screen w--20">
                                <div class="relative flex flex-col px-4 py-4 space-y-5">
                                    <div class="form-check flex items-center">
                                        <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                                        <label class="form-check-label px-3" for="flexRadioDefault1">White</label>
                                    </div>
                                    <div class="form-check flex items-center">
                                        <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                                        <label class="form-check-label px-3" for="flexRadioDefault1">Beige</label>
                                    </div>
                                    <div class="form-check flex items-center">
                                        <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                                        <label class="form-check-label px-3" for="flexRadioDefault1">Blue</label>
                                    </div>
                                    <div class="form-check flex items-center">
                                        <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                                        <label class="form-check-label px-3" for="flexRadioDefault1">Black</label>
                                    </div>
                                    <div class="form-check flex items-center">
                                        <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                                        <label class="form-check-label px-3" for="flexRadioDefault1">Brown</label>
                                    </div>
                                    <div class="form-check flex items-center">
                                        <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                                        <label class="form-check-label px-3" for="flexRadioDefault1">Green</label>
                                    </div>
                                    <div class="form-check flex items-center">
                                        <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                                        <label class="form-check-label px-3" for="flexRadioDefault1">Navy</label>
                                    </div>
                                </div>
                                <div class="p-4 flex items-center justify-between">
                                    <button class="btn rounded-full text-base lb--check btn--bg--light btn--sort--clear relative inline-flex items-center justify-center rounded-full ">Clear</button>
                                    <button class="btn btn-dark rounded-full text-base lb--check btn--bg--dark btn--sort--apply relative inline-flex items-center justify-center rounded-full transition-colors">Apply</button>
                                </div>
                            </div>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn text-base btn--sub--filter dropdown-toggle rounded-full flex items-center justify-center lb--check" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrows-angle-expand" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707z" />
                                </svg>
                                <span class="ms-3">Sizes</span>
                            </button>
                            <div class="dropdown-menu text-base btn--size--show rounded--1em w--screen w--20">
                                <div class="relative flex flex-col px-4 py-4 space-y-5">
                                    @foreach($getAllAttribute as $attribute)
                                    <div class="form-check flex items-center">
                                        <input class="form-check-input mt-0" name="attribute[]" type="checkbox" value="{{ $attribute->attribute_value }}" aria-label="Checkbox for following text input">
                                        <label class="form-check-label px-3" for="flexRadioDefault1">{{ $attribute->attribute_value }}</label>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="p-4 flex items-center justify-between">
                                    <button class="btn rounded-full text-base lb--check btn--bg--light btn--sort--clear relative inline-flex items-center justify-center rounded-full ">Clear</button>
                                    <button class="btn btn-dark rounded-full text-base lb--check btn--bg--dark btn--sort--apply relative inline-flex items-center justify-center rounded-full transition-colors">Apply</button>
                                </div>
                            </div>
                        </div>
                        <div class="btn-group">
                            <button type="button" id="onSale" class="btn text-base btn--sub--filter rounded-full lb--check flex items-center justify-center" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.9889 14.6604L2.46891 13.1404C1.84891 12.5204 1.84891 11.5004 2.46891 10.8804L3.9889 9.36039C4.2489 9.10039 4.4589 8.59038 4.4589 8.23038V6.08036C4.4589 5.20036 5.1789 4.48038 6.0589 4.48038H8.2089C8.5689 4.48038 9.0789 4.27041 9.3389 4.01041L10.8589 2.49039C11.4789 1.87039 12.4989 1.87039 13.1189 2.49039L14.6389 4.01041C14.8989 4.27041 15.4089 4.48038 15.7689 4.48038H17.9189C18.7989 4.48038 19.5189 5.20036 19.5189 6.08036V8.23038C19.5189 8.59038 19.7289 9.10039 19.9889 9.36039L21.5089 10.8804C22.1289 11.5004 22.1289 12.5204 21.5089 13.1404L19.9889 14.6604C19.7289 14.9204 19.5189 15.4304 19.5189 15.7904V17.9403C19.5189 18.8203 18.7989 19.5404 17.9189 19.5404H15.7689C15.4089 19.5404 14.8989 19.7504 14.6389 20.0104L13.1189 21.5304C12.4989 22.1504 11.4789 22.1504 10.8589 21.5304L9.3389 20.0104C9.0789 19.7504 8.5689 19.5404 8.2089 19.5404H6.0589C5.1789 19.5404 4.4589 18.8203 4.4589 17.9403V15.7904C4.4589 15.4204 4.2489 14.9104 3.9889 14.6604Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M9 15L15 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M14.4945 14.5H14.5035" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M9.49451 9.5H9.50349" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <span class="ms-3">On Sale</span>
                            </button>
                        </div>
                        <div class="btn-group">
                            <button id="filter" class="btn btn-dark rounded-full text-base lb--check btn--bg--dark btn--sort--apply relative inline-flex items-center justify-center rounded-full transition-colors">Apply</button>
                        </div>
                    </div>
                    <div class="block flex-shrink-0 text-right">
                        <div class="btn-group">
                            <button type="button" class="btn text-base btn--sub--filter dropdown-toggle rounded-full lb--check flex items-center justify-center" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z" />
                                </svg>
                                <span class="ms-3">Sort order</span>
                            </button>
                            <div class="dropdown-menu text-base sort--order--show rounded--1em">
                                <div class="relative flex flex-col px-4 py-4 space-y-5">
                                    <div class="form-check flex items-center">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                        <label class="form-check-label px-3" for="flexRadioDefault1">
                                            Most Popular
                                        </label>
                                    </div>
                                    <div class="form-check flex items-center">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                        <label class="form-check-label px-3" for="flexRadioDefault1">
                                            Best Rating
                                        </label>
                                    </div>
                                    <div class="form-check flex items-center">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                        <label class="form-check-label px-3" for="flexRadioDefault1">
                                            Newst
                                        </label>
                                    </div>
                                    <div class="form-check flex items-center">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                        <label class="form-check-label px-3" for="flexRadioDefault1">
                                            Price Low - Hight
                                        </label>
                                    </div>
                                    <div class="form-check flex items-center">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                        <label class="form-check-label px-3" for="flexRadioDefault1">
                                            Price Hight - Low
                                        </label>
                                    </div>
                                </div>
                                <div class="p-4 flex items-center justify-between">
                                    <button class="btn rounded-full text-base lb--check btn--bg--light btn--sort--clear relative inline-flex items-center justify-center rounded-full ">Clear</button>
                                    <button class="btn btn-dark rounded-full text-base lb--check btn--bg--dark text--white btn--sort--apply relative inline-flex items-center justify-center rounded-full transition-colors">Apply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div class="container px-0 py-5">
        <main>
            <!-- list products -->
            <div class="page--home--product">
                @if(isset($product_top) && $product->currentPage() == 1)
                <script>
                    let top_product = [];
                </script>
                @foreach($product_top as $prd_top)
                <x-cardProduct :data="$prd_top" :top="true"></x-cardProduct>
                <style>
                    .top_<?= $prd_top->id ?>.none{
                        display: none;
                    }
                </style>
                <script>
                    top_product.push('{{$prd_top->id}}')
                </script>
                @endforeach
                @endif
                @foreach($product as $prd)
                <x-cardProduct :data="$prd"></x-cardProduct>
                @endforeach
            </div>
        </main>
        {{$product->links('components.pagination')}}
    </div>
    <div class="container p-0">
        <main>
            <div class="flex flex-col relative">
                <div class="flex flex-col flex-row items-center justify-between box--nav--fillter">
                    <div class="flex">
                        <div class="ext-base">
                            <h2 class="fw-bold h1">Chosen by our experts</h2>
                        </div>
                    </div>
                    <div class="flex flex-shrink-0 text-right nth-child">
                        <button type="button" class="btn text-base btn--sub--filter radius100" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                            </svg>
                        </button>
                        <button type="button" class="btn text-base btn--sub--filter radius100" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="container text-center mt-5 px-0">
                <div class="row align-items-start">
                    <div class="col">
                        <div class="card card--chosen--expert bg-light bg-opacity-10" style="width: 100%;">
                            <img src="https://chisnghiax.com/ciseco/static/media/full1.79b3230204e678b5e61c.png" class="card-img-top" alt="...">
                            <div class="row mt-4">
                                <div class="col">
                                    <img src="https://chisnghiax.com/ciseco/static/media/full1.79b3230204e678b5e61c.png" class="card-img-top" alt="...">
                                </div>
                                <div class="col">
                                    <img src="https://chisnghiax.com/ciseco/static/media/full1.79b3230204e678b5e61c.png" class="card-img-top" alt="...">
                                </div>
                                <div class="col">
                                    <img src="https://chisnghiax.com/ciseco/static/media/full1.79b3230204e678b5e61c.png" class="card-img-top" alt="...">
                                </div>
                            </div>
                            <div class="card-body row mt-4">
                                <div class="col-8 row">

                                    <p class="card-title text-base justify-content-start text-start">Black Hoodies Dior</p>
                                    <div class="card-description flex flex-col flex-row">
                                        <p class="fw-bold text-start">
                                            Black
                                        </p>
                                        <div class="ps-5">
                                            <svg style="width: 16px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="text-warning">
                                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class=""><span class="line-clamp-1">4.9 (269 reviews)</span></span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col">
                                    <span class="text-base fw-bolder float-end">$99.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card card--chosen--expert bg-light bg-opacity-10" style="width: 100%;">
                            <img src="https://chisnghiax.com/ciseco/static/media/full1.79b3230204e678b5e61c.png" class="card-img-top" alt="...">
                            <div class="row mt-4">
                                <div class="col">
                                    <img src="https://chisnghiax.com/ciseco/static/media/full1.79b3230204e678b5e61c.png" class="card-img-top" alt="...">
                                </div>
                                <div class="col">
                                    <img src="https://chisnghiax.com/ciseco/static/media/full1.79b3230204e678b5e61c.png" class="card-img-top" alt="...">
                                </div>
                                <div class="col">
                                    <img src="https://chisnghiax.com/ciseco/static/media/full1.79b3230204e678b5e61c.png" class="card-img-top" alt="...">
                                </div>
                            </div>
                            <div class="card-body row mt-4">
                                <div class="col-8 row">
                                    <p class="card-title text-base justify-content-start text-start">Black Hoodies Dior</p>
                                    <div class="card-description flex flex-col flex-row">
                                        <p class="fw-bold text-start">
                                            Black
                                        </p>
                                        <div class="ps-5">
                                            <svg style="width: 16px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="text-warning">
                                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class=""><span class="line-clamp-1">4.9 (269 reviews)</span></span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col">
                                    <span class="text-base fw-bolder float-end">$99.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card card--chosen--expert bg-light bg-opacity-10" style="width: 100%;">
                            <img src="https://chisnghiax.com/ciseco/static/media/full1.79b3230204e678b5e61c.png" class="card-img-top" alt="...">
                            <div class="row mt-4">
                                <div class="col">
                                    <img src="https://chisnghiax.com/ciseco/static/media/full1.79b3230204e678b5e61c.png" class="card-img-top" alt="...">
                                </div>
                                <div class="col">
                                    <img src="https://chisnghiax.com/ciseco/static/media/full1.79b3230204e678b5e61c.png" class="card-img-top" alt="...">
                                </div>
                                <div class="col">
                                    <img src="https://chisnghiax.com/ciseco/static/media/full1.79b3230204e678b5e61c.png" class="card-img-top" alt="...">
                                </div>
                            </div>
                            <div class="card-body row mt-4">
                                <div class="col-8 row">

                                    <p class="card-title text-base justify-content-start text-start">Black Hoodies Dior</p>
                                    <div class="card-description flex flex-col flex-row">
                                        <p class="fw-bold text-start">
                                            Black
                                        </p>
                                        <div class="ps-5">
                                            <svg style="width: 16px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="text-warning">
                                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class=""><span class="line-clamp-1">4.9 (269 reviews)</span></span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col">
                                    <span class="text-base fw-bolder float-end">$99.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div class="container">
        <main>
            <div class="earn--free--money flex flex-row items-center py-5">
                <div class="efm--box--left">
                    <div class="relative flex-shrink-0 ">
                        <div class="logo flex">
                            <div class="img--logo">
                                <a href=""><img src="/assets/images/logo.png" alt=""></a>
                            </div>
                            <div class="word--logo">
                                <h2>
                                    <a href="">
                                        <span>F</span>
                                        <span>F</span>
                                        <span>BEES</span>
                                    </a>
                                </h2>
                            </div>
                        </div>
                        <h2 class="fw-bold fs-375">Earn free money <br> with US</h2>
                        <span class="block mt-6 text-black-50">With FFBEES you will get freeship &amp; savings combo...</span>
                        <div class="flex nth-child mt-5">
                            <a class="relative inline-flex items-center justify-center rounded-full py-3 px-4 btn--bg--dark text--color--light" rel="noopener noreferrer" href="">Savings combo</a>
                            <a class="relative inline-flex items-center justify-center rounded-full py-3 px-4 btn--bg--light text--color--dark" rel="noopener noreferrer" href="">Discover more</a>
                        </div>
                    </div>
                </div>
                <div class="efm--box--right">
                    <img src="https://chisnghiax.com/ciseco/static/media/rightLargeImg.dd2356513f3941fd1981.png" alt="">
                </div>
            </div>
        </main>
    </div>
</div>
</div>
<!-- css page--search width = var(--max-width) margin auto -->

@endsection
@section("scripts")
<script>
    $(document).ready(async function() {
        const url__submit = '{{route("user.update_view_top")}}';
        const _csrf = '{{ csrf_token() }}';

        const myTimeout = setTimeout(() => {
            update_view(url__submit)
        }, 5000);


        function update_view(url__submit) {
            $.ajax({
                url: url__submit,
                type: 'POST',
                data: {
                    id: top_product,
                    _token: _csrf
                }
            });
        }
        $(".btn-check").click(function() {
            console.log(1);
            let CategoryProductParentId = $(this).val();

            $.ajax({
                url: "{{ route('filter_product_children') }}",
                data: {
                    id: CategoryProductParentId,
                },
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        if (response.data.length > 0) {
                            let checkboxEl = `
                            <div class="form-check flex items-center">
                                        <input class="form-check-input mt-0" id="check-all" type="checkbox" value="" aria-label="Checkbox for following text input">
                                        <label class="form-check-label px-3" for="flexRadioDefault1">All Categories</label>
                                    </div>
                                    
                            `;
                            response.data.forEach(function(value, key) {
                                checkboxEl += `
                            <div class="form-check flex items-center">
                                <input class="form-check-input mt-0 children" name="cate_product[]" type="checkbox" value="${value.id}" aria-label="Checkbox for following text input">
                                <label class="form-check-label px-3" for="">${value.name}</label>
                            </div>`;
                            })
                            $("#show-category-children").html(checkboxEl);
                        } else {
                            $("#show-category-children").html("Chưa cập nhật dữ liệu cho danh mục này");
                        }
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });


        });
        $(document).on("change", "#check-all", function() {
            console.log(3)
            if (this.checked) {
                $(".children").each(function() {
                    this.checked = true;
                });
            } else {
                $(".children").each(function() {
                    this.checked = false;
                });
            }

            $(".children").click(function() {
                if ($(this).is(":checked")) {
                    var isAllChecked = 0;

                    $(".children").each(function() {
                        if (!this.checked)
                            isAllChecked = 1;
                    });

                    if (isAllChecked == 0) {
                        $("#check-all").prop("checked", true);
                    }
                } else {
                    $("#check-all").prop("checked", false);
                }
            });
        })

        const rangeInput = document.querySelectorAll(".range--input input"),
            priceInput = document.querySelectorAll(".price--input input"),
            range = document.querySelector(".price--slider .progress");
        let priceGap = 1000;
        priceInput.forEach(input => {
            input.addEventListener("input", e => {
                let minPrice = parseInt(priceInput[0].value),
                    maxPrice = parseInt(priceInput[1].value);

                if ((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max) {
                    if (e.target.className === "input-min") {
                        rangeInput[0].value = minPrice;
                        range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
                    } else {
                        rangeInput[1].value = maxPrice;
                        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                    }
                }
            });
        });
        rangeInput.forEach(input => {
            input.addEventListener("input", e => {
                let minVal = parseInt(rangeInput[0].value),
                    maxVal = parseInt(rangeInput[1].value);
                if ((maxVal - minVal) < priceGap) {
                    if (e.target.className === "range-min") {
                        rangeInput[0].value = maxVal - priceGap
                    } else {
                        rangeInput[1].value = minVal + priceGap;
                    }
                } else {
                    priceInput[0].value = minVal;
                    priceInput[1].value = maxVal;
                    range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
                    range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                }
            });
        });

        function formatCurrency(money) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(money * 1)
        }

        $("#filter").click(function() {
            let arrayCategories = [];
            let arrayAttributes = [];

            let inputMin = $("input.input-min").val();
            let inputMax = $("input.input-max").val();

            let checkOnSale = false;
            $("#onSale").click(function() {
                checkOnSale = true;
            })
            let arrayColors = [];

            // category = $("input[type=radio].btn-check:checked").val();

            $('input[name="cate_product[]"]:checked').each(function(i, obj) {
                arrayCategories.push(obj.value)
            })

            $('input[name="attribute[]"]:checked').each(function(i, obj) {
                arrayAttributes.push(obj.value)
            })

            console.log(arrayCategories, arrayAttributes);
            $.ajax({
                url: "{{ route('filter_product') }}",
                data: {
                    "arrayCategories": arrayCategories,
                    "arrayAttributes": arrayAttributes,
                    "inputMin": inputMin,
                    "inputMax": inputMax,
                },
                type: "get",
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if (response.status) {
                        let cardProductEl = ``;
                        if (response.data.length > 0) {
                            response.data.forEach(function(item, key) {
                                let sum = 0;
                                let sumCommentProduct = item.comment.filter(comment => {
                                    sum += comment.rate;
                                })

                                let resultSum = 0;
                                if (sum > 0) {
                                    resultSum = sum / item.comment.length
                                }
                                console.log(item);
                                cardProductEl += `
                                <div class="component--cardProduct">
                                    <div class="component--cardProduct--img">
                                        <a href="http://127.0.0.1:8000/product/rey-nylon-backpack-1668402744">
                                            <img class="image-product" src="{{ asset("upload/product/` + item.thumb + `") }}" alt="">
                                        </a>
                                        <i class="fa-regular fa-heart btn-add-wishlist true" data-id="1"></i>
                                    </div>
                                    <div class="component--cardProduct--content">
                                        <a href="http://127.0.0.1:8000/product/rey-nylon-backpack-1668402744">
                                            <p class="title"> ${item.name} </p>
                                            <p class="der"> ${item.description} </p>
                                            <div class="d-flex justify-content-between div--content">
                                                <div class="left">
                                                    <i class="fa-solid fa-star"></i>
                                                    <span>
                                                        ${resultSum != 0 ? resultSum +" ("+ item.comment.length + ")"   : 'Chưa có đánh giá' } 
                                                        
                                                    </span>
                                                </div>
                                                <p class="m-0">${item.sold > 0 ? 'Đã bán '+item.sold : ''}</p>
                                            </div>
                                            <p class="price"><span>${formatCurrency(item.price)}</span> <span>-10%</span></p>
                                        </a>
                                    </div>
                                </div>
                                `;
                            })
                            $(".page--home--product").html(cardProductEl);
                        } else {
                            $(".page--home--product").html("Không có sản phẩm phù hợp");
                        }
                    }
                },
                error: function(error) {

                }

            })

        })



    })
</script>
@endsection