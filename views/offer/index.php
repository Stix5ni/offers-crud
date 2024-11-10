<?php


use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;


$this->title = 'Офферы';
?>


<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Создать новый оффер', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<?php Pjax::begin(['id' => 'p0']); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        [
            'attribute' => 'name',
            'filterInputOptions' => [
                'class' => 'form-control',
                'id' => 'filter-name',
                'placeholder' => 'Введите название оффера',
                'value' => $searchModel->name,
            ],
        ],
        [
            'attribute' => 'email',
            'filterInputOptions' => [
                'class' => 'form-control',
                'id' => 'filter-email',
                'placeholder' => 'Введите email',
                'value' => $searchModel->email
            ],
        ],
        'phone',
        'created_at:datetime',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => [
                'delete' => function ($url, $model) {
                    return Html::a(
                        '<i class="fa fa-trash"></i>',
                        '#',
                        [
                            'class' => 'delete-offer',
                            'data-id' => $model->id,
                            'data-url' => Url::to(['offer/delete', 'id' => $model->id]),
                            'data-pjax' => '0',
                        ]
                    );
                },
            ],
        ],
    ],
    'options' => [
        'responsiveWrap' => false,
    ],
    'pager' => [
        'class' => \yii\widgets\LinkPager::class,
        'options' => ['class' => 'pagination pagination-sm justify-content-center'],
        'linkOptions' => ['class' => 'page-link'],
        'disabledPageCssClass' => 'page-link', 
        'maxButtonCount' => 5,
    ],
]); ?>
<?php Pjax::end(); ?>


<?php
$this->registerJs(<<<JS
// Автообновление при изменении значения в фильтре
$('#filter-name, #filter-email').on('keyup change', function() {
    var name = $('#filter-name').val();
    var email = $('#filter-email').val();

    $.pjax.reload({
        container: '#p0',
        data: {
            'OfferSearch[name]': name, 
            'OfferSearch[email]': email
        },
        push: false,
        replace: false 
    });
});

// Привязываем обработчик к удалению оффера
$('#p0').on('click', '.delete-offer', function(e) {
    e.preventDefault();
    let url = $(this).data('url');

    Swal.fire({
        title: 'Вы уверены?',
        text: "Это действие нельзя будет отменить!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Да, удалить!',
        cancelButtonText: 'Отмена'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'POST',
                success: function(response) {
                    if (response.success) {
                        $.pjax.reload({container: '#p0'});
                        Swal.fire('Удалено!', 'Оффер был успешно удален.', 'success');
                    } else {
                        Swal.fire('Ошибка!', 'Не удалось удалить оффер.', 'error');
                    }
                },
                error: function() {
                    Swal.fire('Ошибка!', 'Не удалось удалить оффер.', 'error');
                }
            });
        }
    });
});
JS);
?>
