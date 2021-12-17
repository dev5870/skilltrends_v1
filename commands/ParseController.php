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
     * Парсит скиллы.
     * В бд скиллы состоящие из нескольких слов необходимо указывать через '+', например: data+science.
     * @return int Exit code
     * Парсит скиллы
     */
    public function actionSkill()
    {
        $skill = Input::find()
            ->select(['id', 'query'])
            ->where(['type' => 'skill', 'status' => 1])
            ->distinct()
            ->all();
        $date = date('Y-m-d');
        $this->stdout("*************** start actionSkill (" . $date . ") *************** \n");
        $this->stdout('Всего записей для выборки: ' . count($skill) . "\n");
        for ($i = 0; $i < count($skill); $i++) {
            $this->stdout("*************** #" . $i . " *************** \n");
            $this->stdout("Скилл: " . $skill[$i]['query'] . "\n");
            try {
                $link = 'https://hh.ru/search/vacancy?clusters=true&area=1&specialization=1&enable_snippets=true&salary=&st=searchVacancy&text=' . $skill[$i]['query'] . '&from=suggest_post';
                $file = file_get_contents($link);
            } catch (\Exception $e) {
                $this->stdout("Данные не получены (ошибка парсинга): " . $skill[$i]['query'] . "\n");
                $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=ошибка парсинга: ' . $skill[$i]['query'], "r");
                fclose($sendToTelegram);
                continue;
            }
            preg_match_all('/], "totalResults": (.*), "enableNovaFilters"/', $file, $result);
            $this->stdout("Количество упоминаний: " . $result[1][0] . "\n");
            $this->stdout("Дата парсинга: " . $date . "\n");
            $model = new Results();
            $model->input_id = $skill[$i]['id'];
            $model->date = $date;
            $model->quantity = $result[1][0];
            if (!$model->save()) {
                $this->stdout("Данные не сохранены: " . $skill[$i]['query'] . "\n");
                $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=ошибка парсинга: ' . $skill[$i]['query'], "r");
                fclose($sendToTelegram);
            }
            $this->stdout("*************** *************** \n");
            $sec = rand(25, 45);
            sleep($sec);
        }
        $this->stdout("*************** end actionSkill (" . $date . ") *************** \n");
        return ExitCode::OK;
    }

    /**
     * Парсит количество вакансий.
     * @return int Exit code
     */
    public function actionVacancies()
    {
        $vacancies = Input::find()
            ->select(['id', 'query', 'description'])
            ->where(['type' => 'vacancies', 'status' => 1])
            ->distinct()
            ->all();
        $date = date('Y-m-d');
        $this->stdout("*************** start actionVacancies (" . $date . ") *************** \n");
        $this->stdout("Всего записей для выборки: " . count($vacancies) . "\n");
        for ($i = 0; $i < count($vacancies); $i++) {
            $this->stdout("*************** #" . $i . " *************** \n");
            $this->stdout("Специализация: " . $vacancies[$i]['description'] . "\n");
            $link = $vacancies[$i]['query'];
            try {
                $file = file_get_contents($link);
            } catch (\Exception $e) {
                $this->stdout("Данные не получены (ошибка парсинга): " . $vacancies[$i]['query'] . "\n");
                $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=ошибка парсинга: ' . $vacancies[$i]['query'], "r");
                fclose($sendToTelegram);
                continue;
            }
            preg_match_all('/], "totalResults": (.*), "enableNovaFilters"/', $file, $result);
            $this->stdout("Количество вакансий: " . $result[1][0] . "\n");
            $this->stdout("Дата парсинга: " . $date . "\n");
            $model = new Results();
            $model->input_id = $vacancies[$i]['id'];
            $model->date = $date;
            $model->quantity = $result[1][0];
            if (!$model->save()) {
                $this->stdout("Данные не сохранены: " . $vacancies[$i]['query'] . "\n");
                $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=ошибка парсинга: ' . $vacancies[$i]['query'], "r");
                fclose($sendToTelegram);
            }
            $this->stdout("*************** *************** \n");
            $sec = rand(25, 45);
            sleep($sec);
        }
        $this->stdout("*************** end actionVacancies (" . $date . ") *************** \n");
        return ExitCode::OK;
    }
}
