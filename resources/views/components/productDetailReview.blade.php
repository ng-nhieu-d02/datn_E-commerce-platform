@props(['comment', 'product'])

<div class="user_review">
            <h2>
                <i class="fa-solid fa-star"></i>
                <span>{{$product->rate}} · {{$product->total_rate}} Reviews</span>
            </h2>
            <div class="user_review-container">
                <div class="list-review-items gap-5 col-md-12 d-flex flex-wrap justify-content-between">
                    
                    <div class="review-item col-md-5">
                        <div class="box-info-user d-flex align-items-center">
                            <div class="box-image-review">
                                <img src="{{ asset('assets/images/image_product/Image-8.5ae85a64aab1965e33a5.png') }}" alt="">
                            </div>
                            <div class="box-text-meta d-flex justify-content-between align-items-center">
                                <div class="name_user d-flex flex-column">
                                    <span class="full_name">Cody Fisher</span>
                                    <span>May 20, 2021
                                    </span>
                                </div>
                                <div class="review_star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="text_review">
                            <p>Very nice feeling sweater. I like it better than a regular hoody because it is
                                tailored to be a slimmer fit. Perfect for going out when you want to stay comfy. The
                                head opening is a little tight which makes it a little.</p>
                        </div>
                    </div>
                    <div class="review-item col-md-5">
                        <div class="box-info-user d-flex align-items-center">
                            <div class="box-image-review">
                                <img src="{{ asset('assets/images/image_product/Image-8.5ae85a64aab1965e33a5.png') }}" alt="">
                            </div>
                            <div class="box-text-meta d-flex justify-content-between align-items-center">
                                <div class="name_user d-flex flex-column">
                                    <span class="full_name">Cody Fisher</span>
                                    <span>May 20, 2021
                                    </span>
                                </div>
                                <div class="review_star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="text_review">
                            <p>Very nice feeling sweater. I like it better than a regular hoody because it is
                                tailored to be a slimmer fit. Perfect for going out when you want to stay comfy. The
                                head opening is a little tight which makes it a little.</p>
                        </div>
                    </div>
                    <div class="review-item col-md-5">
                        <div class="box-info-user d-flex align-items-center">
                            <div class="box-image-review">
                                <img src="{{ asset('assets/images/image_product/Image-8.5ae85a64aab1965e33a5.png') }}" alt="">
                            </div>
                            <div class="box-text-meta d-flex justify-content-between align-items-center">
                                <div class="name_user d-flex flex-column">
                                    <span class="full_name">Cody Fisher</span>
                                    <span>May 20, 2021
                                    </span>
                                </div>
                                <div class="review_star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="text_review">
                            <p>Very nice feeling sweater. I like it better than a regular hoody because it is
                                tailored to be a slimmer fit. Perfect for going out when you want to stay comfy. The
                                head opening is a little tight which makes it a little.</p>
                        </div>
                    </div>
                    <div class="review-item col-md-5">
                        <div class="box-info-user d-flex align-items-center">
                            <div class="box-image-review">
                                <img src="{{ asset('assets/images/image_product/Image-8.5ae85a64aab1965e33a5.png') }}" alt="">
                            </div>
                            <div class="box-text-meta d-flex justify-content-between align-items-center">
                                <div class="name_user d-flex flex-column">
                                    <span class="full_name">Cody Fisher</span>
                                    <span>May 20, 2021
                                    </span>
                                </div>
                                <div class="review_star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="text_review">
                            <p>Very nice feeling sweater. I like it better than a regular hoody because it is
                                tailored to be a slimmer fit. Perfect for going out when you want to stay comfy. The
                                head opening is a little tight which makes it a little.</p>
                        </div>
                    </div>
                </div>
                <form action="" class="form-show-more">
                    <button class="form-button">Show me all {{$product->total_rate}} reviews</button>
                </form>
            </div>
        </div>