<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Supplier;
use yii\data\ActiveDataProvider;
use common\helpers\FuncHelper;

class SiteController extends Controller
{
     /**
     * ---------------------------------------
     * 标记当前位置到cookie供后续跳转调用
     * ---------------------------------------
     */
    public function setForward()
    {
        \Yii::$app->getSession()->setFlash('__forward__', $_SERVER['REQUEST_URI']);
    }
    /**
     * Displays supplier.
     *
     * @return string
     */
    public function actionIndex()
    {
        $params = $params = Yii::$app->request->getQueryParams();
        
        $searchModel = new Supplier();
        $dataProvider = $searchModel->search($params);
        /* 导出excel */
        if (isset($params['action']) && $params['action'] == 'export') {
            $this->export($dataProvider->query->all());
            return false;
        }
        return $this->render('index',[
            'dataProvider'=> $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    private function export($values)
    {        
        $csv = tmpfile();
        $bFirstRowHeader = true;
        foreach ($values as $row) 
        {
            $arr = [
                'id' => $row->id,
                'name' => $row->name,
                'code' => $row->code,
                'status' => $row->t_status,
            ];
            if ($bFirstRowHeader)
            {
                fputcsv($csv, array_keys($arr));
                $bFirstRowHeader = false;
            }

            fputcsv($csv, array_values($arr));
        }
        rewind($csv);

        $filename = "export_".date("Y-m-d").".csv";

        $fstat = fstat($csv);
        $this->setHeader($filename, $fstat['size']);

        fpassthru($csv);
        fclose($csv);
    }

    function setHeader($filename, $filesize)
    {
        // disable caching
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 01 Jan 2001 00:00:01 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download  
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Type: text/x-csv');

        // disposition / encoding on response body
        if (isset($filename) && strlen($filename) > 0)
            header("Content-Disposition: attachment;filename={$filename}");
        if (isset($filesize))
            header("Content-Length: ".$filesize);
        header("Content-Transfer-Encoding: binary");
        header("Connection: close");
    }
}
