<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Thống kê nhanh
        $users = User::where('role_id', 3)->get();
        $products = Product::get();
        $orders = Order::where('status', 'completed')->get();
        $allOrders = Order::all();
        // Lấy tất cả danh mục + số sản phẩm
        $categories = Category::withCount('products')
            ->orderByDesc('products_count')
            ->get();

        // ===== XỬ LÝ DATA CHO CHART =====
        $total = $categories->sum('products_count');

        $chartLabels = [];
        $chartCounts = [];
        $otherCount = 0;

        foreach ($categories as $category) {
            $percent = $total > 0
                ? ($category->products_count / $total) * 100
                : 0;

            if ($percent < 5) {
                $otherCount += $category->products_count;
            } else {
                $chartLabels[] = $category->name;
                $chartCounts[] = $category->products_count;
            }
        }

        if ($otherCount > 0) {
            $chartLabels[] = 'Khác';
            $chartCounts[] = $otherCount;
        }

        // Get top 10 products by sold quantity
        $topProducts = Product::withCount(['order_items as sold_quantity'
        => function ($query) {
            $query->select(\DB::raw('SUM(quantity)'));
        }])
            ->orderByDesc('sold_quantity')
            ->take(3)
            ->get();

        // Calculate monthly revenue data for the current year
        $monthlyRevenue = Order::select(
            \DB::raw('SUM(total_price) as revenue'),
            \DB::raw('DATE_FORMAT(created_at, "%m") as month')
        )
            ->where('status', 'completed')
            ->groupBy(\DB::raw('DATE_FORMAT(created_at, "%m")'))
            ->orderBy('month')
            ->get();

        // ===== DOANH THU THEO THÁNG (12 THÁNG) =====
        $monthlyRevenueRaw = Order::selectRaw('
        MONTH(created_at) as month,
        SUM(total_price) as revenue
    ')
            ->where('status', 'completed')
            ->groupByRaw('MONTH(created_at)')
            ->pluck('revenue', 'month')
            ->toArray();

        // Fill đủ 12 tháng
        $monthlyRevenue = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyRevenue[] = [
                'month' => 'Tháng ' . $m,
                'revenue' => $monthlyRevenueRaw[$m] ?? 0
            ];
        }
        return view('admin.pages.dashboard', compact(
            'users',
            'products',
            'orders',
            'allOrders',
            'categories',
            'chartLabels',
            'chartCounts',
            'topProducts',
            'monthlyRevenue'
        ));
    }
}
