<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Supplier extends ActiveRecord
{
    // public $name;
    public static function tableName()
    {
        return 'supplier';
    }

    public function rules()
    {
        return [
            [['id'], 'integer', 'max' => 30],
            [['name'], 'string', 'max' => 30],
            [['code'], 'string', 'max' => 30],
            [['t_status'], 'string', 'max' => 30],
        ];
    }

    public function search($params)
    {
        $pageSize = 2;
        $query = static::find();
        $this->load($params);
        if (isset($params['action']) && $params['action'] === 'export' && isset($params['scope']) && $params['scope'] === 'global' || !isset($params['action'])) {
            switch ($this->id) {
                case '>10':
                    $query->andFilterWhere(['>', 'id', 10]);
                    
                    break;
                case '<10':
                    $query->andFilterWhere(['<', 'id', 10]);
                    break;
                case '<=10':
                    $query->andFilterWhere(['<=', 'id', 10]);
                    break;
                case '>=10':
                    $query->andFilterWhere(['>=', 'id', 10]);
                    break;
            }
            
            
            $query->andFilterWhere(['=','t_status', $this->t_status]);
            $query->andFilterWhere(['like', 'name', $this->name]);
            $query->andFilterWhere(['like', 'code', $this->code]);
        }else if(isset($params['action']) && $params['action'] === 'export' && isset($params['scope']) && $params['scope'] === 'local' && isset($params['ids'])){
            $query->where(['in','id',explode(',',$params['ids'])]);
        }
        
        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pageSize,
            ],
        ]);
    }   
}
