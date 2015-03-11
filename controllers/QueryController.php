<?php

namespace app\controllers;
use yii\web\Controller;
use app\models\contact;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use Yii;
use yii\data\ArrayDataProvider;

class QueryController extends Controller{
    public function actionQuery1(){
     $data = Contact::find()
             ->where('id>1')
             ->orderBy('firstname','lastname');
     $dataProvider = new ActiveDataProvider([
         'query'=>$data,
     ]);
     
     return $this->render('query1',
             ['dataProvider'=>$dataProvider]);
    }
    
    public function actionQuery2() {
        $query = new Query;
        $query->select ('*')
                ->from ('contact')
                ->all();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            
        ]);
        
         $query1 = new Query;
        $query1->select('firstname,lastname')
                ->from('contact')
                ->all();
        $dataProvider1 = new ActiveDataProvider([
            'query' => $query1,
            
        ]);
        
        return $this->render('query2',
                ['dataProvider'=>$dataProvider,
                 'contact'=>$dataProvider1
                ]);
        
    }
    
    //แบบที่ 3 ใช้ แบบ SQL
    
public function actionQuery3(){
    $connection = Yii::$app->db;
    $contact = $connection->createCommand('select * from contact')
            ->queryAll();
    
    $dataProvider = new ArrayDataProvider([
        'allModels'=>$contact,
        'pagination'=>[
            'pageSize'=>2
        ]
    ]);
    
    return $this->render('query3',['contact'=>$dataProvider]);   
    
}
    
    
    
    
}