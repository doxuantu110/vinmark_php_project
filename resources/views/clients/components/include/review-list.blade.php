<ul>
    @foreach ($product->reviews as $review)
        <li>
            <div class="ltn__comment-item clearfix">
                {{-- Ảnh người dùng --}}
                <div class="ltn__commenter-img">
                    <img src="{{ $review->user->avatar_url }}" alt="{{ $review->user->name }}">
                </div>

                {{-- Nội dung bình luận --}}
                <div class="ltn__commenter-comment">
                    <h6>{{ $review->user->name }}</h6>

                    {{-- Hiển thị số sao --}}
                    <div class="product-rating">
                        <ul style="list-style: none; padding: 0; margin: 0; display: flex; gap: 4px;">
                            @for ($i = 1; $i <= 5; $i++)
                                <li>
                                    <a href="javascript:void(0)" style="color: #f7c40f; text-decoration: none;">
                                        <i class="{{ $i <= $review->rating ? 'fas fa-star' : 'far fa-star' }}"></i>
                                    </a>
                                </li>
                            @endfor
                        </ul>
                    </div>
                    {{-- Nội dung đánh giá --}}
                    <p>{{ $review->comment }}</p>

                    {{-- Ngày đăng --}}
                    <span class="ltn__comment-reply-btn">
                        {{ $review->created_at->format('d/m/Y') }}
                    </span>
                </div>
            </div>
        </li>
    @endforeach
</ul>
