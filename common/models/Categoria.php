<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property int $idcategorias
 * @property string $categoriaNome
 * @property string $categoriaDescricao
 * @property int $categoriaEstado
 *
 * @property CategoriaChild[] $categoriaChildren
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['categoriaNome', 'required'],
            ['categoriaNome', 'trim'],
            ['categoriaNome', 'string', 'max' => 25],

            ['categoriaEstado', 'integer'],
            ['categoriaEstado', 'default', 'value' => 0],

            ['categoriaDescricao', 'trim'],
            ['categoriaDescricao', 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcategorias' => 'ID',
            'categoriaNome' => 'Name',
            'categoriaDescricao' => 'Description',
            'categoriaEstado' => 'Status',
        ];
    }

/*
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $id = $this->idcategorias;
        $nome = $this->categoriaNome;
        $descricao = $this->categoriaDescricao;
        $estado = $this->categoriaEstado;

        $myObj = new \stdClass();
        $myObj->id = $id;
        $myObj->nome = $nome;
        $myObj->descricao = $descricao;
        $myObj->estado = $estado;

        $myJSON = json_encode($myObj);

        if($insert)
        {
            $this->FazPublish('INSERT',$myJSON);
        }
        else
        {
            $this->FazPublish('UPDATE',$myJSON);
        }
    }

    public function afterDelete()
    {
        parent::afterDelete();

        $cat_id = $this->id;
        $myObj = new \stdClass();
        $myObj->id = $cat_id;
        $myJSON = json_encode($myObj);

        $this->FazPublish('DELETE', $myJSON);
    }

    public function FazPublish($canal, $msg)
    {
        require("../../mosquitto/phpMQTT.php");

        $server = "127.0.0.1";
        $port = 1883;
        $username = "";
        $password = "";
        $client_id = "phpMQTT-publisher";
        $mqtt = new \app\mosquitto\phpMQTT($server, $port, $client_id);


        //$mqtt = new \app\mosquitto\phpMQTT($server, $port, $client_id);

        if ($mqtt->connect(true, NULL, $username, $password))
        {
            $mqtt->publish($canal, $msg, 0);
            $mqtt->close();
        }
        else
        {
            file_put_contents("debug.output","Time out!");
        }
    }
*/


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaChildren()
    {
        return $this->hasMany(CategoriaChild::className(), ['categoria_idcategorias' => 'idcategorias']);
    }

    /**
     * @return string
     */
    public function getCategoriaNome()
    {
        return $this->categoriaNome;
    }

    /**
     * @param string $categoriaNome
     */
    public function setCategoriaNome($categoriaNome)
    {
        $this->categoriaNome = $categoriaNome;
    }

    /**
     * @return string
     */
    public function getCategoriaDescricao()
    {
        return $this->categoriaDescricao;
    }

    /**
     * @param string $categoriaDescricao
     */
    public function setCategoriaDescricao($categoriaDescricao)
    {
        $this->categoriaDescricao = $categoriaDescricao;
    }

    /**
     * @return int
     */
    public function getCategoriaEstado()
    {
        return $this->categoriaEstado;
    }

    /**
     * @param int $categoriaEstado
     */
    public function setCategoriaEstado($categoriaEstado)
    {
        $this->categoriaEstado = $categoriaEstado;
    }




}
