<div class="col-lg-3 col-md-6 col-12">
    <!-- Start Single Product -->
    <div class="single-product">
        <div class="product-image">
            <img src="{{ $product->image_url }}" alt="#">
            @if ($product->sale_percent)
            <span class="sale-tag">-{{ $product->sale_percent }}%</span>
            @endif
            <div class="button">
                <!-- Add to Cart Form -->
                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1"> <!-- Default quantity -->
                    <button type="submit" class="btn add-to-cart"><i class="lni lni-cart"></i> Add to Cart</button>
                </form>
            </div>
        </div>
        <div class="product-info">
            <span class="category">{{ $product->category->name }}</span>
            <h4 class="title">
                <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
            </h4>
            <ul class="review">
                <li><i class="lni lni-star-filled"></i></li>
                <li><i class="lni lni-star-filled"></i></li>
                <li><i class="lni lni-star-filled"></i></li>
                <li><i class="lni lni-star-filled"></i></li>
                <li><i class="lni lni-star"></i></li>
                <li><span>4.0 Review(s)</span></li>
            </ul>
            <div class="price">
                <span>${{ $product->price }}</span>
                @if ($product->compart_price)
                    <span class="discount-price">${{ $product->compart_price }}</span>
                @endif
            </div>
        </div>
    </div>
    <!-- End Single Product -->
</div>
