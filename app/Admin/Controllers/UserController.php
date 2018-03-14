<?php
/**
 * File: UserController.php
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




/**
 * Class UserController .
 */
class UserController extends Controller
{
    use ModelForm;

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(\App\Models\User::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name();
            $grid->email();

            $grid->created_at();
            $grid->updated_at();
            $grid->model()->orderBy('id', 'desc');
        });
    }

    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('员工管理');
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
            $content->header('修改员工信息');
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
        return Admin::form(\App\Models\User::class, function (Form $form) {
            $form->display('id');
            $form->text('name')->rules('required|min:3|max:10');
            $form->text('email')->rules('required|email|max:30');
        });
    }


    public function create()
    {
        return Admin::content(function (Content $content) {
            $content->header('添加员工');
            $content->description('');
            $content->body($this->form());
        });
    }
}
