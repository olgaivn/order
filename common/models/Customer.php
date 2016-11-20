<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id_customer
 * @property string $name_company
 * @property string $head
 * @property string $phone
 * @property string $address
 *
 * @property Order $order
 * @property Goods[] $idOrders
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_company', 'head', 'phone', 'address'], 'required'],
            [['name_company', 'head', 'address'], 'string', 'max' => 200],
            [['phone'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_customer' => 'Id Customer',
            'name_company' => 'Name Company',
            'head' => 'Head',
            'phone' => 'Phone',
            'address' => 'Address',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id_order' => 'id_customer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdOrders()
    {
        return $this->hasMany(Goods::className(), ['id_goods' => 'id_order'])->viaTable('order', ['id_order' => 'id_customer']);
    }
}
