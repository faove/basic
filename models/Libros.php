<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "libros".
 *
 * @property int $id
 * @property string $titulo
 * @property string $archivo
 */
class Libros extends \yii\db\ActiveRecord
{
    public $archivo;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'libros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo'], 'required'],
            [['titulo'], 'string', 'max' => 255],
            [['archivo'], 'file', 'extensions' => 'jpg,png'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'archivo' => 'Imagen',
        ];
    }
    // public function upload()
    // {
    //     if ($this->validate()) {
            
    //         $this->archivo->saveAs('uploads/' . $this->archivo->baseName . '.' . $this->archivo->extension);
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}
