@extends('layouts.client')

@section('title', 'Sản phẩm')
@section('breadcrumb', 'Sản phẩm')

@section('content')
<div class="ltn__product-area ltn__product-gutter">
    <div class="container">
        <div class="row">
            <!-- PRODUCT LIST -->
            <div class="col-lg-8 order-lg-2 mb-120">

                <!-- SORT -->
                <div class="ltn__shop-options">
                    <ul>
                        <li>
                            <div class="ltn__grid-list-tab-menu">
                                <div class="nav">
                                    <a class="active show"><i class="fas fa-th-large"></i></a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="short-by text-center">
                                <select id="sort-by" class="nice-select">
                                    <option value="">Sắp xếp mặc định</option>
                                    <option value="latest">Mới nhất</option>
                                    <option value="price_asc">Giá thấp → cao</option>
                                    <option value="price_desc">Giá cao → thấp</option>
                                </select>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- LOADING -->
                <div id="loading-spinner" style="display:none">
                    <div class="loader"></div>
                </div>

                <!-- 🔥 AJAX PRODUCT -->
                <div id="ajax-product-container">
                    @include('clients.components.products_grid', ['products' => $products])
                </div>

                <!-- 🔥 AJAX PAGINATION -->
                <div id="ajax-pagination" class="ltn__pagination-area text-center">
                    {!! $products->links('clients.components.pagination.pagination_custom') !!}
                </div>
            </div>

            <!-- SIDEBAR -->
            <div class="col-lg-4 mb-120">
                <aside class="sidebar ltn__shop-sidebar">

                    <!-- CATEGORY -->
                    <div class="widget ltn__menu-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Danh mục</h4>
                        <ul>
                            <li>
                                <a href="javascript:void(0)" class="category-filter active" data-id="">
                                    Tất cả
                                </a>
                            </li>
                            @foreach ($categories as $category)
                                <li>
                                    <a href="javascript:void(0)" class="category-filter"
                                       data-id="{{ $category->id }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- PRICE -->
                    <div class="widget ltn__price-filter-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Lọc theo giá</h4>
                        <div class="price_filter">
                            <div class="price_slider_amount">
                                <input type="text" class="amount" readonly>
                            </div>
                            <div class="slider-range"></div>
                        </div>
                    </div>

                </aside>
            </div>
        </div>
    </div>
</div>
@endsection
