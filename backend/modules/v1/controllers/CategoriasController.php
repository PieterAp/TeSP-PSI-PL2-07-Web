<?php

namespace app\modules\v1\controllers;

use yii\db\Query;
use yii\rest\ActiveController;

/**
 * Categorias controller for the `v1` module
 */
class CategoriasController extends ActiveController
{
    public $modelClass = 'common\models\Categoria';

    /**
     * Behaviors defined for this controller
     *
     * In this particular case, without this function the JSON format
     * in Module.php would not work, which means that \yii\base\Behavior
     * is not actually needed, but also does no harm.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            'class' => \yii\base\Behavior::className(),
        ];
    }

    /**
     * Defines actions which are not allowed
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create'],//POST
              $actions['update'],//PUT & PATCH {id}
              $actions['delete']);//DELETE {id}

        return $actions;
    }

    /**
     * Shows the user which actions and routes are available to use
     * @return array
     */
    public function actionHelp()
    {
        $help[] = array( 'allowed actions' => 'get');

        $get = array( 'action' => 'get' , 'routes' => array() );
        $get['routes'][] = array('todas as categorias disponiveis' => 'categorias',
                                 'produtos dentro de categoria' => 'categorias/{id}/produtos');
        $help[] = $get;

        return array($help);
    }

    /**
     * @return mixed
     */
    public function actionAvailable()
    {
        $allCategorias = (new Query())
            ->select(['categoria.*','COUNT(produto.idprodutos) as "qntProdutos"'])
            ->from('categoria')
            ->innerJoin('categoria_child', '`categoria_child`.`categoria_idcategorias` = `categoria`.`idcategorias`')
            ->innerJoin('produto', '`categoria_child`.`idchild` = `produto`.`categoria_child_id`')
            ->where(['categoriaEstado'=>1])
            ->andWhere(['produto.produtoEstado'=>1])
            ->all();

        return $allCategorias;
    }

    /**
     * @param $id
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionProdutos($id)
    {
        $allProdutos = (new Query())
            ->select(['produto.*'])
            ->from('categoria')
            ->innerJoin('categoria_child', '`categoria_child`.`categoria_idcategorias` = `categoria`.`idcategorias`')
            ->innerJoin('produto', '`categoria_child`.`idchild` = `produto`.`categoria_child_id`')
            ->where(['categoria.idcategorias' => $id])
            ->andWhere(['produto.produtoEstado'=>1])
            ->all();

        return $allProdutos;
    }
}
