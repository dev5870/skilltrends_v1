<?php

namespace app\commands;

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
            if ($dataInput[0]['status'] == Input::STATUS_INACTIVE){
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
                if ($dataInput[0]['number_empty_values'] >= self::NUMBER_EMPTY_VALUES){
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
            if ($todayQuantity['quantity'] > '0' && $dataInput[0]['number_empty_values'] >= 1){
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
}