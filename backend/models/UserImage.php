<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_image".
 *
 * @property integer $user_id
 * @property integer $image_id
 * @property string $last_view
 *
 * @property Images $image
 * @property User $user
 */
class UserImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'image_id'], 'required'],
            [['user_id', 'image_id'], 'integer'],
            [['last_view'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'image_id' => 'Image ID',
            'last_view' => 'Last View',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Images::className(), ['image_id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
