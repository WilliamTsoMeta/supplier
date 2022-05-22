<?php
use yii\grid\GridView;
use yii\grid\CheckboxColumn;
use yii\helpers\Html;
/** @var yii\web\View $this */

$this->title = 'Supplier List';
$this->params['title_sub'] = '副标题';
$this->params['id'] = '副标题';

?>
<div class="site-index">
<div class="actions">
    <button id="export" class="export-disabled"><i class="fa fa-pencil"></i> 导出CSV </button>
</div>

<?= GridView::widget([
    'filterModel' => $searchModel,
    'dataProvider' => $dataProvider,
    'options' => ['class' => 'grid-view table-scrollable'],
    /* 表格配置 */
    'tableOptions' => ['class' => 'table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer'],
    /* 重新排版 摘要、表格、分页 */
    'layout' => '{items}<div class=""><div class="col-md-5 col-sm-5">{summary}</div><div class="col-md-7 col-sm-7"><div class="dataTables_paginate paging_bootstrap_full_number" style="text-align:right;">{pager}</div></div></div>',
    /* 配置分页样式 */
    'pager' => [
        'options' => ['class'=>'pagination','style'=>'visibility: visible;'],
        'nextPageLabel' => 'Next page',
        'prevPageLabel' => 'Last page'
    ],
    'columns' => [
        [
            'class' => CheckboxColumn::className(),
            'name'  => 'checkbox',
            'options' => ['width' => '20px;'],
            'checkboxOptions' => function ($model, $key, $index, $column) {
                return ['value' => $key,'label'=>'<span></span>','labelOptions'=>['class' =>'mt-checkbox mt-checkbox-outline','style'=>'padding-left:19px;']];
            }
        ],
        [
            'header' => 'ID',
            'attribute' => 'id',
            'filter' => Html::activeDropDownList($searchModel, 'id', [
                '>10' => '大于10',
                '<10' => '小于10',
                '<=10' => '小于等于10',
                '>=10' => '大于等于10',         
            ], ['prompt'=>'全部','class'=>'form-control']),
        ],
        [
            'header' => 'name',
            'attribute' => 'name',
            'filter' => Html::input('text', 'Supplier[name]', $searchModel->name,['class'=>'form-control'])
        ],
        [
            'header' => 'code',
            'attribute' => 'code',
            'filter' => Html::input('text', 'Supplier[code]', $searchModel->code,['class'=>'form-control'])
        ],
        [
            'label' => 'status',
            'attribute' => 't_status',
            'filter' => Html::activeDropDownList($searchModel, 't_status', ['hold' => 'hold','ok' => 'ok'], ['prompt'=>'全部','class'=>'form-control']),
        ],
    ]
]) ?>

<p class="select-all-rem">
    All <i>0</i> conversations on this page have been selected.
    <b>
        Select all conversations that match this search
    </b>
</p>
<p class="clear-selection">
    <span class="selection-rem">All conversations in this search have been selected.</span> <b>clear selection</b>
</p>
</div>
<?php $this->beginBlock('test'); ?>
   $(function(){
    var scope = 'local';
    $('.select-on-check-all').change(function (val) {
        $('#export').removeClass('export-disabled')
        scope = 'local';
        $('.clear-selection').hide()
        var rows = $(".grid-view").yiiGridView("getSelectedRows")
        if (rows.length > 0) {
            $("#export").show()
            $('.clear-selection').show();
        }
        $('.select-all-rem i').html(rows.length)
        $('.select-all-rem').show();
        if (rows.length === 0) {
            $('.select-all-rem').hide();
            $('.clear-selection').hide();
            $('#export').addClass('export-disabled')
        }  
    })

    $('.select-all-rem b').click(function(){
        $('.selection-rem').css('display', 'inline-block');
        scope = 'global';
    })
    $('.clear-selection b').click(function(){
        $('#export').addClass('export-disabled')
        $('.select-all-rem').hide();
        $('.selection-rem').hide();
        $('.clear-selection').hide()
        $('input:checkbox').prop('checked',false)
    });


    $('#export').click(function(){                
        var rows = $(".grid-view").yiiGridView("getSelectedRows")
        if(rows.length===0){
            alert("please select some data!");
            return
        }
        var query = location.search  === '' ? location.search + '?action=export' : location.search + '&action=export'
        window.open( "/"+query+'&scope='+scope+'&ids='+rows)
    })
   })

   
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
<style>
    .selection-rem{
        display:none;
    }
    .export-disabled{
        background:#bbb;
        color:#000;
    }
    .select-all-rem,.clear-selection{
        display:none;
        background:#eeeeee;
        padding: 10px;
    }
    .select-all-rem i{
        font-style:normal;
    }
    .select-all-rem b,.clear-selection b{
        color:#009;
        cursor: pointer;
    }
    button{
        margin:5px;
        color: #fff;
        background-color: #409eff;
        border-color: #409eff;
        display: inline-block;
        line-height: 1;
        white-space: nowrap;
        cursor: pointer;
        border: 1px solid #dcdfe6;
        -webkit-appearance: none;
        text-align: center;
        box-sizing: border-box;
        outline: none;
        transition: .1s;
        font-weight: 500;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        padding: 12px 20px;
        font-size: 14px;
        border-radius: 4px;
    }
</style>
