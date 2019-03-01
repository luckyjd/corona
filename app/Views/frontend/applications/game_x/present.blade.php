<div class="product-box present-popup">
    <div class="present-wrapper">
        <div class="present-quantity">
            <div class="presentQty-container">
                <img class="present_qty_bg" src="{{public_url('css/frontend/images/present_qty_bg.png')}}" alt="{{$entity->name}}">
                <p class="present-qty-numb"><span>{{$entity->quantity}}</span><br><span class="present_qty_text">名様</span></p>
            </div>
        </div>
        <div class="present-flex-small">
            <div class="present-thumb">
                <img class="presentThumbImg" src="{{$entity->image}}" alt="{{$entity->name}}">
            </div>
        </div>
        <div class="present-body-info">
            <div class="present-name-wrapper">
                <div class="present-name">
                    {{$entity->name}}
                </div>
            </div>
        </div>
    </div>
</div>