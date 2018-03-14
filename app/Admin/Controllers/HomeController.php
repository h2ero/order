<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\InfoBox;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {


            $content->row(function ($row) use ($content) {
                $content->row(function ($row) {
                    $row->column(3, new InfoBox('员工管理', 'users', 'aqua', '/admin/user', \App\Models\User::count()));
                    $row->column(3, new InfoBox('套餐管理', 'book', 'yellow', '/admin/product', \App\Models\Product::count()));
                    $row->column(3, new InfoBox('订餐记录', 'book', 'yellow', '/admin/order', \App\Models\Order::count()));
                    $row->column(3, new InfoBox('月度报表', 'file', 'red', '/admin/order/stats', \App\Models\Order::select(\DB::raw('count(distinct month) c'))->value('c')));
                });
            });

        });
    }
}
