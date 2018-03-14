<?php
/**
 * File: OrderController.php
 *
 * @author h2ero <122750707@qq.com> 
 * @date 2018-03-14 13:51:26
 */

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Widgets\Table;




/**
 * Class OrderController .
 */
class OrderController extends Controller
{
    use ModelForm;

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(\App\Models\Order::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->column('user_name')->display(function() {
                return $this->user->name;
            });

            $grid->column('product_name')->display(function() {
                return $this->product->name;
            });
            $grid->month()->sortable();

            $grid->created_at();
            $grid->updated_at();
            $grid->model()->orderBy('id', 'desc');
            $grid->disableCreateButton();
            $grid->disableActions();
        });
    }

    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('订单管理');
            $content->description('');
            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header('修改订单信息');
            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(\App\Models\Order::class, function (Form $form) {
            $form->display('id');
            $form->text('name');
        });
    }

    public function stats()
    {
        return Admin::content(function (Content $content) {
            $content->header('订单统计');
            $content->description('');
            $content->row(function ($row) use ($content) {
                $tab = new Tab();
                $result = \App\Models\Order::select('month', 'user_id', \DB::raw('count(1) times'))->where('month', \Request::get('month', date('Ym')))->groupBy('month', 'user_id')->paginate();
                $tableData = array();
                foreach ($result as $item) {
                    $tableData[] = array(
                        'month' => $item['month'],
                        'user_name' => $item->user->name,
                        'times' => $item->times,
                    );
                }
                
                $table = new Table(array(
                    'month',
                    'user_name',
                    'times'
                ), $tableData);

                $monthes = \App\Models\Order::select(\DB::raw('distinct month'))->orderBy('month', 'desc')->pluck('month');
                $tab->add('按月统计', view('admin.order_stats',array('table' => $table, 'monthes' => $monthes)));
                $row->column(12, $tab->render());
            });
        });
    }
}
