<?php


namespace app\models;


/**
 * This is the model class for table "offers".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string|null $created_at
 */


class Offer extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'offers';
    }

    public function rules()
    {
        return [
            [['name', 'email'], 'required', 'message' => 'Это поле обязательно для заполнения.'],
            [['created_at'], 'safe'],
            ['phone', 'match', 'pattern' => '/^\+?[0-9]{1,3}?[0-9]{7,15}$/', 'message' => 'Некорректный номер телефона'],
            [['name', 'email'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 50],
            [['email'], 'unique'],
            ['email', 'email', 'message' => 'Введите корректный email.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название оффера',
            'email' => 'Email представителя',
            'phone' => 'Телефон представителя',
            'created_at' => 'Дата добавления',
        ];
    }
}
