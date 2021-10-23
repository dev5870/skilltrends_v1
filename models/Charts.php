<?php

namespace app\models;

use yii\db\ActiveRecord;
use miloschuman\highcharts\Highcharts;

class Charts extends ActiveRecord
{
    /**
     * Возвращает график для заданного массива.
     * Принимает на вход массив с одним значением query или professional_area.
     * @param $array
     * @return string
     * @throws \Exception
     */
    public static function getCharts($array)
    {
        // определяем способ получения input_id
        // может быть получен через query или professional_area
        if (!empty(Input::getDataByProfessionalArea($array))) {
            $input = Input::getDataByProfessionalArea($array);
        } elseif (!empty(Input::getDataByQuery($array))) {
            $input = Input::getDataByQuery($array);
        }

        // получаем результаты парсинга для input_id
        $date = Results::find()
            ->asArray()
            ->select(['date'])
            ->where(['input_id' => $input[0]['id']])
            ->distinct()
            ->all();

        // формируем данные для графика
        $countInput = count($input);
        $countDate = count($date);
        $categories = array();
        $series = array();
        $nameForCharts = array();
        for ($i = 0; $i < $countDate; $i++) {
            array_push($categories, $date[$i]['date']);
        }
        for ($i = 0; $i < $countInput; $i++) {
            array_push($series, [
                'name' => $input[$i]['description'],
                'data' => Results::getQuantityByInputId($input[$i]['id'])
            ]);
            array_push($nameForCharts, $series[$i]['name']);
        }

        // определяем input_id - это skill или vacancies
        $skillOrVacancies = Input::find()
            ->asArray()
            ->select(['type'])
            ->where(['id' => $input[0]['id']])
            ->one();
        if ($skillOrVacancies['type'] == 'vacancies') {
            $title = 'Количество вакансий: ' . json_encode($nameForCharts, JSON_UNESCAPED_UNICODE);
        } elseif ($skillOrVacancies['type'] == 'skill') {
            $title = 'Skill: ' . json_encode($nameForCharts, JSON_UNESCAPED_UNICODE);
        }

        // возвращаем сообщение на страницу и отправляем сообщение в телеграм в случае отсутствия данных
        if (empty($categories) || empty($series)) {
            $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=ошибка вывода информации на страницу. запрос: ' . $array, "r");
            fclose($sendToTelegram);
            return 'Данные отсутствуют!';
        }

        // возвращаем график
        return Highcharts::widget([
            'options' => [
//                'chart' => [
//                    'type' => 'area'
//                ],
                'title' => ['text' => $title],
                'xAxis' => [
                    'categories' => $categories
                ],
                'yAxis' => [
                    'title' => ['text' => 'данные по г.Москва']
                ],
                'series' => $series
            ]
        ]);
    }

    /**
     * Возвращает график с данными для страницы analytics.
     * @return string
     * @throws \Exception
     */
    public static function getPieCharts()
    {
        // получаем результаты парсинга для input_id
        $result = DistributionByDay::find()
            ->asArray()
            ->where(['tm_create' => date('Y-m-d')])
            ->all();

        $last = end($result);
        $json = json_decode($last['data']);

        // возвращаем график
        return Highcharts::widget([
            'options' => [
                'title' => ['text' => 'Распределение (в процентном соотношении) количества вакансий по дням недели'],
                'plotOptions' => [
                    'pie' => [
                        'cursor' => 'pointer',
                    ],
                ],
                'series' => [
                    [ // new opening bracket
                        'type' => 'pie',
                        'name' => 'Day',
                        'data' => [
                            ['Понедельник', $json->Monday],
                            ['Вторник', $json->Tuesday],
                            ['Среда', $json->Wednesday],
                            ['Четверг', $json->Thursday],
                            ['Пятница', $json->Friday],
                            ['Суббота', $json->Saturday],
                            ['Воскресенье', $json->Sunday],
                        ],
                    ] // new closing bracket
                ],
            ],
        ]);
    }
}
