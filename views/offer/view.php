<?php


use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;


/** @var yii\web\View $this */
/** @var app\models\Offer $model */


$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Offers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="offer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
        <?= Html::a(
            'Удалить',
            '#',
            [
                'class' => 'btn btn-danger delete-offer',
                'data-id' => $model->id,
                'data-url' => Url::to(['delete', 'id' => $model->id]),
                'title' => 'Удалить',
            ]
        ) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'email:email',
            'phone',
            'created_at',
        ],
    ]) ?>

</div>


<?php
$this->registerJs(<<<JS
$('.delete-offer').on('click', function(e) {
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
                        Swal.fire('Удалено!', 'Оффер был успешно удален.', 'success');
                        setTimeout(function() {
                            // Выполняем редирект
                            window.location.href = response.redirectUrl || window.location.href;
                        }, 2000);
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