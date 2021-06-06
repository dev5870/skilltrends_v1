<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\Input;

/**
 * Команды для парсинга данных с сайтов.
 * Команды запускаются через cron один раз в сутки.
 */
class ParseController extends Controller
{
    /**
     * @return int Exit code
     */
    public function actionIndex()
    {
        $model = Input::find()->select(['query'])->distinct()->all();
        $date = date('Y-m-d');
        echo 'Количество записей для выборки: ' . count($model) . "\n";
        for ($i = 0; $i < count($model); $i++) {
            echo $model[$i]['query'] . "\n";
            $link = 'https://hh.ru/search/vacancy?clusters=true&area=1&specialization=1&enable_snippets=true&salary=&st=searchVacancy&text=' . $model[$i]['query'] . '&from=suggest_post';

            $file = file_get_contents($link);

            preg_match_all('/"totalResults": (.*), "enableNovaFilters"/', $file, $result);

            echo 'Количество упоминаний: ' . $result[1][0] . "\n";
            echo 'Дата парсинга: ' . $date . "\n";
            sleep(3);
        }

        return ExitCode::OK;
    }
}
