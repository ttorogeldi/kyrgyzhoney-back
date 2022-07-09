<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Models\ArticleType;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Show;

class ArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Article';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */

    protected function grid()
    {
        $grid = new Grid(new Article());
        $grid->column('article.title','Category');
        $grid->column('title',__('Title'));
        $grid->column('id',__('ID'));
        $grid->column('released',__('Released'));


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Article::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Article());
        $form ->select('type_id')->options((new ArticleType())::selectOptions());
        $form ->text('title',__('Title'))->required();
        $form ->text('subtitle',__('Sub Title'));
        $form ->image('thumbnail');
        $form ->text('description')->required();
        $states = [
            'on'=>['value'=>1,'text'=>'publish'],
            'off'=>['value'=>0,'text'=>'draft']
        ];
        $form ->switch('released',__('Publish'))->states();

        return $form;
    }
}
