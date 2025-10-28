 <!-- MODAL AREA START (Add To Cart Modal) -->
 <div class="ltn__modal-area ltn__add-to-cart-modal-area">
     <div class="modal fade" id="add_to_cart_modal-{{ $product->id }}" tabindex="-1">
         <div class="modal-dialog modal-md" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="ltn__quick-view-modal-inner">
                         <div class="modal-product-item">
                             <div class="row">
                                 <div class="col-12">
                                     <div class="modal-product-img">
                                         <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                                     </div>
                                     <div class="modal-product-info">
                                         <h5><a
                                                 href="{{ route('product.detail', $product->slug) }}">{{ $product->name }}</a>
                                         </h5>
                                         <p class="added-cart"><i class="fa fa-check-circle"></i>Đã thêm thành công vào
                                             Giỏ hàng của bạn</p>
                                         <div class="btn-wrapper">
                                             <a href="{{ route('cart.index') }}" class="theme-btn-1 btn btn-effect-1">Xem giỏ hàng</a>
                                         </div>
                                     </div>
                                     {{-- <!-- additional-info -->
                                     <div class="additional-info d-none">
                                         <p>We want to give you <b>10% discount</b> for your first order, <br>
                                             Use discount code at checkout</p>
                                         <div class="payment-method">
                                             <img src="img/icons/payment.png" alt="#">
                                         </div>
                                     </div> --}}
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- MODAL AREA END -->
