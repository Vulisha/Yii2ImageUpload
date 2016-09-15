<?php

namespace backend\models;

use Yii;
use backend\models\Album;

/**
 * This is the model class for table "images".
 *
 * @property integer $image_id
 * @property string $path
 * @property integer $counter
 * @property string $created
 * @property string $last
 * @property integer $deleted
 * @property integer $album_id
 *
 * @property Album $album
 * @property UserImage[] $userImages
 * @property User[] $user-s
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['album_id'], 'required'],
            [['path'], 'string'],
            [['file'],'file'],
            [['counter', 'deleted', 'album_id'], 'integer'],
            [['created', 'last'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'image_id' => 'Image ID',
            'path' => 'Path',
            'counter' => 'Counter',
            'created' => 'Created',
            'last' => 'Last',
            'deleted' => 'Deleted',
            'album_id' => 'Album ID',
            'file' => 'Slika',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbum()
    {
        return $this->hasOne(Album::className(), ['id' => 'album_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserImages()
    {
        return $this->hasMany(UserImage::className(), ['image-id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {

        return $this->hasOne(User::className(), ['id' => 'user_id'])->viaTable('Album', ['id' => 'album_id']);
    }
}
