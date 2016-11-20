<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id_goods
 * @property string $name_goods
 * @property string $date_manufacture
 * @property integer $shelf_life
 *
 * @property Order $order
 * @property Customer[] $idOrders
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_goods', 'date_manufacture', 'shelf_life'], 'required'],
            [['date_manufacture'], 'safe'],
            [['shelf_life'], 'integer'],
            [['name_goods'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_goods' => 'Id Goods',
            'name_goods' => 'Name Goods',
            'date_manufacture' => 'Date Manufacture',
            'shelf_life' => 'Shelf Life',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id_order' => 'id_goods']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdOrders()
    {
        return $this->hasMany(Customer::className(), ['id_customer' => 'id_order'])->viaTable('order', ['id_order' => 'id_goods']);
    }
}
