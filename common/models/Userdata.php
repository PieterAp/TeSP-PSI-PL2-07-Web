<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "userdata".
 *
 * @property int $iduser
 * @property string $userNomeProprio
 * @property string $userApelido
 * @property int $userNIF
 * @property string $userDataNasc
 * @property string $userEstado
 * @property string $userMorada
 * @property int $user_id
 *
 * @property Compra[] $compras
 * @property Reparacao[] $reparacaos
 * @property User $user
 */
class Userdata extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userdata';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userNomeProprio', 'userApelido', 'user_id'], 'required'],
            [['userNIF', 'user_id'], 'integer'],
            [['userDataNasc'], 'safe'],
            [['userEstado'], 'string'],
            [['userNomeProprio', 'userApelido'], 'string', 'max' => 16],
            [['userMorada'], 'string', 'max' => 45],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iduser' => 'Iduser',
            'userNomeProprio' => 'User Nome Proprio',
            'userApelido' => 'User Apelido',
            'userNIF' => 'User Nif',
            'userDataNasc' => 'User Data Nasc',
            'userEstado' => 'User Estado',
            'userMorada' => 'User Morada',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompras()
    {
        return $this->hasMany(Compra::className(), ['user_iduser' => 'iduser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReparacaos()
    {
        return $this->hasMany(Reparacao::className(), ['user_iduser' => 'iduser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
