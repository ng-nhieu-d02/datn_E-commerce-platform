@props(['comments', 'product'])
<div class="user_review">
    <h2>
        <i class="fa-solid fa-star"></i>
        <span>
            @if ($product->comment()->count() > 0)
            {{ number_format($product->comment()->sum('rate') / $product->comment()->count(), 2)}} 路 {{ $product->comment()->count() }} Reviews
            @endif
        </span>
    </h2>
    <div class="user_review-container">
        <div class="list-review-items gap-5 col-md-12 d-flex flex-wrap justify-content-between">
            @foreach ($comments as $comment)
                <div class="review-item col-md-5">
                    <div class="box-info-user d-flex align-items-center">
                        <div class="box-image-review">
                            <img src="{{ asset('assets/images/image_product/Image-8.5ae85a64aab1965e33a5.png') }}"
                                alt="">
                        </div>
                        <div class="box-text-meta d-flex justify-content-between align-items-center">
                            <div class="name_user d-flex flex-column">
                                <span class="full_name">{{ $comment->user->name }}</span>
                                <span>{{ $comment->date_time }}
                                </span>
                            </div>
                            <div class="review_star">
                                <?= str_repeat('<i class="fa-solid fa-star"></i>', $comment->rate) ?>
                               
                            </div>
                        </div>
                    </div>
                    <div class="text_review">
                        <p>{{ $comment->message }}</p>
                    </div>
                </div>
            @endforeach

        </div>
        <form action="" class="form-show-more" style='display:none'>
            <button class="form-button">Show me all {{ $product->total_rate }} reviews</button>
        </form>
    </div>
</div>
