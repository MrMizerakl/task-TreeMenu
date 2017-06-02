<?php

namespace app\modules\menu\controllers;

use app\models\Menu;
use yii\web\Controller;

/**
 * Default controller for the `menu` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $treemenu = $this->getTreeMenu();
        return $this->render('index', [
            'treemenu' => $treemenu,
        ]);
    }

    protected function getTreeMenu()
    {
        $rootlevel = Menu::find()->select('id, name, url, parent, isgroup')->where(['parent' => Null])->orderBy('name')->asArray()->all();
        $result =''; $tmp = '';
        if(count($rootlevel)){
            $result .= '<ul class="tm-header">';
            foreach ($rootlevel as $item){
                $tmp = '';
                $tmp = $this->getTreeMenuChild($item['id']);;
                $result .= '<li class="tm-name '. ( $item['isgroup'] ? ' tm-group' : '' ) .( $tmp ? ' tm-header' : '' ) . '">'. '<a href="'. ($item['url'] ? $item['url']: '#' ).' ">'. $item['name']. '</a>' ;
                //$result .= $this->getTreeMenuChild($item['id']);
                $result .= $tmp;
                $result .= '</li>';
            }
            $result .= '</ul>';
        }
        return $result;
    }

    protected function getTreeMenuChild($id)
    {
        $child = Menu::find()->select('id, name, url, parent, isgroup')->where(['parent' => $id])->orderBy('isgroup desc, name')->asArray()->all();
        $result = '';
        if(count($child)){
            $result .= '<ul class="tm-hidden tm-parent">';
            foreach ($child as $item){
                $tmp = '';
                $tmp = $this->getTreeMenuChild($item['id']);;

                $result .= '<li class="tm-name'. ( $item['isgroup'] ? ' tm-group' : '' ) .( $tmp ? ' tm-header' : '' ) .  '">'. '<a href="'. ($item['url'] ? $item['url']: '#' ).' ">'. $item['name']. '</a>';
//                $result .= $this->getTreeMenuChild($item['id']);
                $result .= $tmp;
                $result .=  '</li>';
            }
            $result .= '</ul>';
        }
        return $result;
    }
}
