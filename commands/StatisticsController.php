<?php

namespace app\commands;

use app\models\DistributionByDay;
use app\models\MonthlyStatistics;
use yii\console\Controller;
use app\models\Results;
use app\models\Input;

class StatisticsController extends Controller
{
    /**
     * const NUMBER_EMPTY_VALUES - количество дней через которое деактивируем input_id
     * Бывают дни когда результат парсинга = 0, то есть отсутствуют вакансии по запросу или упоминания скилла.
     * В этом случае считаем такие дни в столбце number_empty_values, таблица input.
     * Если в счетчике собирает количество >= указанное в константе NUMBER_EMPTY_VALUES, то input_id деактивируется.
     * Учитываются только дни подряд. При положительном парсинге, счетчик сбрасывается к 0.
     */
    const NUMBER_EMPTY_VALUES = 7;

    /**
     * Производит расчет и запись дневного изменений результатов парсинга.
     */
    public function actionToday()
    {
        // получаем вчерашнюю дату
        $yesterdayDate = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
        // получаем список всех input_id
        $input = Input::find()
            ->asArray()
            ->select(['id'])
            ->all();

        // перебираем все input_id
        for ($i = 0; $i < count($input); $i++) {
            // получаем данные для перебираемого input_id
            $dataInput = Input::getDataByInputId($input[$i]['id']);

            // пропускаем деактивированные input_id
            if ($dataInput[0]['status'] == Input::STATUS_INACTIVE) {
                continue;
            }

            // получаем сегодняшний результат парсинга для перебираемого input_id
            $todayQuantity = Results::find()
                ->asArray()
                ->select(['id', 'quantity'])
                ->where(['date' => date('Y-m-d'), 'input_id' => $input[$i]['id']])
                ->one();

            if (empty($todayQuantity) || $todayQuantity['quantity'] == '0') {
                $mes = 'Пустое значение quantity: input_id ' . $dataInput[0]['id'];

                // если результат парсинга за сегодня - пуст, то добавляем в счетчик 1 и отправляем уведомление в тг
                try {
                    $model = Input::findOne($input[$i]['id']);
                    $model->number_empty_values = $dataInput[0]['number_empty_values'] + 1;
                    $model->save();
                    $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=' . $mes, "r");
                    fclose($sendToTelegram);
                } catch (\Exception $e) {
                    $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=ошибка сохранения счетчика пустых значений для input_id ' . $input[$i]['id'], "r");
                    fclose($sendToTelegram);
                }

                // если счетчик перешел границу, то деактивируем input_id и отправляем уведомление в тг
                if ($dataInput[0]['number_empty_values'] >= self::NUMBER_EMPTY_VALUES) {
                    try {
                        $model = Input::findOne($input[$i]['id']);
                        $model->status = Input::STATUS_INACTIVE;
                        $model->save();
                        $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=деактивирован input_id ' . $input[$i]['id'], "r");
                        fclose($sendToTelegram);
                    } catch (\Exception $e) {
                        $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=не удалось деактивировать input_id ' . $input[$i]['id'], "r");
                        fclose($sendToTelegram);
                    }
                }
                sleep(1);
                continue;
            }

            // если результат парсинга за сегодня не пуст и у input_id счетчик > 1, то делаем обнуление счетчика
            if ($todayQuantity['quantity'] > '0' && $dataInput[0]['number_empty_values'] >= 1) {
                try {
                    $model = Input::findOne($input[$i]['id']);
                    $model->number_empty_values = 0;
                    $model->save();
                    $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=Обнуление счетчика для input_id ' . $input[$i]['id'], "r");
                    fclose($sendToTelegram);
                } catch (\Exception $e) {
                    $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=Ошибка обнуления счетчика для input_id ' . $input[$i]['id'], "r");
                    fclose($sendToTelegram);
                }
            }

            // получаем вчерашний результат парсинга для перебираемого input_id
            $yesterdayQuantity = Results::find()
                ->asArray()
                ->select(['id', 'quantity'])
                ->where(['date' => $yesterdayDate, 'input_id' => $input[$i]['id']])
                ->one();

            // отправляем уведомление если вчерашний результат пуст и переходим к следующему input_id
            if (empty($yesterdayQuantity) || $yesterdayQuantity['quantity'] == '0') {
                $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=ошибка консольной команды actionToday. пустое значение $yesterdayQuantity, ' . $input[$i]['id'], "r");
                fclose($sendToTelegram);
                continue;
            }

            // сортируем результат парсинга за сегодня и вчера (для дальнейшего расчета)
            $data = $this->determiningOrderValues($yesterdayQuantity['quantity'], $todayQuantity['quantity']);

            // расчитываем числовую и процентную разницу между сегодняшним и вчерашним результатом
            $calculation = $this->calculationDifference($data, $todayQuantity['quantity'], $yesterdayQuantity['quantity']);

            // отправляем уведомление если расчет не удался и переходим к следующему input_id
            if (empty($calculation)) {
                $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=ошибка консольной команды actionToday. пустое значение $calculation', "r");
                fclose($sendToTelegram);
                continue;
            }

            // сохраняем результат дневного изменения в столбец change_per_day, таблица results
            try {
                $model = Results::findOne($todayQuantity['id']);
                $model->change_per_day = json_encode($calculation);
                $model->save();
            } catch (\Exception $e) {
                $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=ошибка консольной команды actionToday. данные не сохранены ($model->change_per_day)', "r");
                fclose($sendToTelegram);
            }
        }
    }

    /**
     * Производит расчет и запись месячного изменения результатов парсинга.
     * Выполняется по крону 1 числа каждого месяца.
     * Расчитывает изменение количества вакансий прошлого месяца по отношению к позапрошлому.
     * Пример:
     * Текущий месяц: сентябрь.
     * Тогда для расчета берутся:
     * Прошлый месяц: август.
     * Позапрошлый месяц: июль.
     * Результат расчета: разница прошлого месяца по отношению к позапрошлому.
     */
    public function actionMonthly()
    {
        // определяем прошлый месяц
        $lastMonth = date('m', strtotime('-1 month', time()));
        // определяем количество дней в прошлом месяце
        $lastMonthDays = cal_days_in_month(
            CAL_GREGORIAN,
            $lastMonth,
            date('Y', strtotime('-1 month', time()))
        );

        // определяем позапрошлый месяц
        $monthBeforeLast = date('m', strtotime('-2 month', time()));
        // определяем количество дней в позапрошлом месяц
        $monthBeforeLastDays = cal_days_in_month(
            CAL_GREGORIAN,
            $monthBeforeLast,
            date('Y', strtotime('-2 month', time()))
        );

        // считаем количество дней за два месяца
        $totalDays = $lastMonthDays + $monthBeforeLastDays;

        // получаем список всех активных input_id
        $allActiveInputId = Input::getAllActiveInput();

        // отбираем только те input_id, для которых есть данные за требуемый период
        try {
            for ($i = 0; $i < count($allActiveInputId); $i++) {
                if ($this->completenessData($allActiveInputId[$i]['id'], $totalDays) == true) {
                    $data[$i]['input_id'] = $allActiveInputId[$i]['id'];
                }
            }
            $workersInputId = array_values($data);
        } catch (\Exception $e) {
            $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=ошибка консольной команды статистика за месяц: отсутствуют данные за требуемый период', "r");
            fclose($sendToTelegram);
            die;
        }

        // производим перебор input_id и запись статистики
        foreach ($workersInputId as $input) {

            // получаем результаты парсинга за прошлый месяц
            $resultsLastMonth = Results::getQuantityByInputIdAndDateInterval(
                $input['input_id'],
                date("Y-m-01", strtotime("-1 month")),
                date("Y-m-t", strtotime("-1 month"))
            );

            // получаем результаты парсинга за позапрошлый месяц
            $resultsMonthBeforeLast = Results::getQuantityByInputIdAndDateInterval(
                $input['input_id'],
                date("Y-m-01", strtotime("-2 month")),
                date("Y-m-t", strtotime("-2 month"))
            );

            // расчитываем медиану за прошлый месяц
            $medianLastMonth = $this->calculateMedian($resultsLastMonth);

            // расчитываем медиану за позапрошлый месяц
            $medianMonthBeforeLast = $this->calculateMedian($resultsMonthBeforeLast);

            // сортируем результат парсинга за прошлый и позапрошлый месяцы (для дальнейшего расчета)
            $data = $this->determiningOrderValues($medianMonthBeforeLast, $medianLastMonth);

            // расчитываем числовую и процентную разницу между прошлым и позапрошлым месяцами
            $calculation = $this->calculationDifference($data, $medianLastMonth, $medianMonthBeforeLast);

            // сохраняем результат расчета
            try {
                $model = new MonthlyStatistics();
                $model->input_id = $input['input_id'];
                $model->date = date('Y-m-d');
                $model->daily_median_for_last_month = $medianLastMonth;
                $model->change_per_month = json_encode($calculation);
                if (!$model->save()) {
                    $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=данные не сохранены (статистика за месяц). Input_id:: ' . $input['input_id'], "r");
                    fclose($sendToTelegram);
                }
            } catch (\Exception $e) {
                $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=ошибка консольной команды статистика за месяц', "r");
                fclose($sendToTelegram);
            }
        }
    }

    /**
     * Производит рассчет распределения вакансий и упоминаний по дням недели (за весь период).
     * Цель: определять в какие дни наибольшее/наименьшее количество вакансий/упоминаний.
     * Запуск через cron каждый день.
     */
    public function actionDistributionByDay()
    {
        $date['start'] = date('Y-m-d',strtotime("Monday", strtotime('this week -1 week')));
        $date['end'] = date('Y-m-d',strtotime("Sunday", strtotime('this week -1 week')));

        // выбираем все вакансии
        $vacancies = Input::find()
            ->asArray()
            ->where(['type' => 'vacancies'])
            ->all();

        foreach ($vacancies as $vacancy){
            // выбираем всю информацию
            $results = Results::find()
                ->asArray()
                ->where(['input_id' => $vacancy['id']])
                ->andWhere([
                    'between',
                    'date',
                    date("Y-m-01", strtotime("-2 month")),
                    date("Y-m-t", strtotime("-1 month"))
                ])
                ->all();
        }

        $data = [];

        for ($i = 0; $i < count($results); $i++) {
            $day = $this->getDay($results[$i]['date']);
            if (empty($data[$day])) {
                $data[$day] = 0;
            }
            $data[$day] = $data[$day] + $results[$i]['quantity'];
        }

        $data['sum'] = array_sum($data);

        $item['Sunday'] = $this->percentageAmount($data['Sunday'], $data['sum']);
        $item['Monday'] = $this->percentageAmount($data['Monday'], $data['sum']);
        $item['Tuesday'] = $this->percentageAmount($data['Tuesday'], $data['sum']);
        $item['Wednesday'] = $this->percentageAmount($data['Wednesday'], $data['sum']);
        $item['Thursday'] = $this->percentageAmount($data['Thursday'], $data['sum']);
        $item['Friday'] = $this->percentageAmount($data['Friday'], $data['sum']);
        $item['Saturday'] = $this->percentageAmount($data['Saturday'], $data['sum']);
        $item['sum'] = $this->percentageAmount($data['sum'], $data['sum']);

        // сохраняем результат дневного изменения в столбец change_per_day, таблица results
        try {
            $model = new DistributionByDay();
            $model->tm_create = date('Y-m-d');
            $model->data = json_encode($item);
            if (!$model->save()) {
                $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=данные не сохранены (дни недели).', "r");
                fclose($sendToTelegram);
            }
        } catch (\Exception $e) {
            $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=ошибка консольной команды actionDistributionByDay.', "r");
            fclose($sendToTelegram);
        }
    }

    /**
     * Возвращает день недели для заданной даты.
     * @param $date
     * @return false|string
     */
    public function getDay($date)
    {
        return strftime("%A", strtotime($date));
    }

    /**
     * Возвращает процент для числа от суммы.
     * @param $number
     * @param $amount
     * @return float
     */
    public function percentageAmount($number, $amount): float
    {
        $coefficient = $amount / $number;
        $percent = 100 / $coefficient;
        return $percent;
    }

    /**
     * Кладет полученные значения в массив и сортирует по возрастанию.
     * @param $first
     * @param $second
     * @return array
     */
    public function determiningOrderValues($first, $second): array
    {
        $data[0] = $first;
        $data[1] = $second;
        sort($data);
        return $data;
    }

    /**
     * Возвращает массив с разницей между прошлым и текущим днем в числовом выражении и процентах/
     * @param $data
     * @param $first
     * @param $second
     * @return array
     */
    public function calculationDifference($data, $first, $second): array
    {
        $result['count'] = $first - $second;
        $result['percent'] = round(($data[1] / $data[0] - 1) * 100, 1);
        if ($result['count'] < 0) {
            $result['color'] = 'red';
        } elseif ($result['count'] > 0) {
            $result['color'] = 'green';
        }
        return $result;
    }

    /**
     * Принимает на вход input_id и месяц.
     * Возвращает true если данные парсинга есть за весь указанный месяц, иначе false.
     * @param $inputId
     * @param $totalDays
     * @return bool
     */
    public function completenessData($inputId, $totalDays): bool
    {
        // делаем выборку результатов парсинга для указанного input_id за два месяца
        $results = Results::find()
            ->asArray()
            ->select('date')
            ->where(['input_id' => $inputId])
            ->andWhere([
                'between',
                'date',
                date("Y-m-01", strtotime("-2 month")),
                date("Y-m-t", strtotime("-1 month"))
            ])
            ->all();

        // сравниваем количество результатов выборки с количеством дней
        if ($totalDays == count($results)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Расчитывает медиану для заданного массива.
     * @param $arr
     * @return float
     */
    public function calculateMedian($arr): float
    {
        $count = count($arr);
        $middleval = floor(($count - 1) / 2); // find the middle value, or the lowest middle value
        if ($count % 2) { // odd number, middle is the median
            $median = $arr[$middleval];
        } else { // even number, calculate avg of 2 medians
            $low = $arr[$middleval];
            $high = $arr[$middleval + 1];
            $median = (($low + $high) / 2);
        }
        return $median;
    }
}