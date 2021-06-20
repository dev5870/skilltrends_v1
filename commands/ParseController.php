<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\Input;
use app\models\Results;

/**
 * Команды для парсинга данных с сайтов.
 * Команды запускаются через cron один раз в сутки.
 */
class ParseController extends Controller
{
    /**
     * @return int Exit code
     * Парсит скиллы
     */
    public function actionSkill()
    {
        $skill = Input::find()->select(['id', 'query'])->where(['type' => 'skill', 'status' => 1])->distinct()->all();
        $date = date('Y-m-d');
        echo 'Количество записей для выборки: ' . count($skill) . "\n";
        for ($i = 0; $i < count($skill); $i++) {
            echo $skill[$i]['query'] . "\n";
            $link = 'https://hh.ru/search/vacancy?clusters=true&area=1&specialization=1&enable_snippets=true&salary=&st=searchVacancy&text=' . $skill[$i]['query'] . '&from=suggest_post';
            $file = file_get_contents($link);
            preg_match_all('/"totalResults": (.*), "enableNovaFilters"/', $file, $result);
            echo 'Количество упоминаний: ' . $result[1][0] . "\n";
            echo 'Дата парсинга: ' . $date . "\n";
            $model = new Results();
            $model->input_id = $skill[$i]['id'];
            $model->date = $date;
            $model->quantity = $result[1][0];
            $model->save();
            sleep(10);
        }

        return ExitCode::OK;
    }

    /**
     * @return int Exit code
     * Парсит вакансии
     */
    public function actionVacancies()
    {
        $vacancies = Input::find()->select(['id', 'query'])->where(['type' => 'vacancies', 'status' => 1])->distinct()->all();
        $date = date('Y-m-d');
        echo 'Количество записей для выборки: ' . count($vacancies) . "\n";
        for ($i = 0; $i < count($vacancies); $i++) {
            echo 'https://hh.ru/catalog/' . $vacancies[$i]['query'] . "\n";
            $link = $vacancies[$i]['query'];
            $file = file_get_contents($link);
            preg_match_all('/"totalResults": (.*), "enableNovaFilters"/', $file, $result);
            echo 'Количество вакансий: ' . $result[1][0] . "\n";
            echo 'Дата парсинга: ' . $date . "\n";
            $model = new Results();
            $model->input_id = $vacancies[$i]['id'];
            $model->date = $date;
            $model->quantity = $result[1][0];
            $model->save();
            sleep(10);
        }

        return ExitCode::OK;
    }
}
