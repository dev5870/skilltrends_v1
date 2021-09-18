<?php

namespace app\commands;

use yii\console\Controller;
use app\models\Results;
use app\models\Input;

class StatisticsController extends Controller
{
    /**
     * Производит расчет и запись дневного изменений результатов парсинга.
     */
    public function actionToday()
    {
        $yesterdayDate = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
        $input = Input::find()
            ->asArray()
            ->select(['id'])
            ->all();

        for ($i = 0; $i < count($input); $i++) {
            $todayQuantity = Results::find()
                ->asArray()
                ->select(['id', 'quantity'])
                ->where(['date' => date('Y-m-d'), 'input_id' => $input[$i]['id']])
                ->one();

            if (empty($todayQuantity) || $todayQuantity['quantity'] == '0') {
                $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=ошибка консольной команды actionToday. пустое значение $todayQuantity, ' . $input[$i]['id'], "r");
                fclose($sendToTelegram);
                continue;
            }

            $yesterdayQuantity = Results::find()
                ->asArray()
                ->select(['id', 'quantity'])
                ->where(['date' => $yesterdayDate, 'input_id' => $input[$i]['id']])
                ->one();

            if (empty($yesterdayQuantity) || $yesterdayQuantity['quantity'] == '0') {
                $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=ошибка консольной команды actionToday. пустое значение $yesterdayQuantity, ' . $input[$i]['id'], "r");
                fclose($sendToTelegram);
                continue;
            }

            $data = $this->determiningOrderValues($yesterdayQuantity['quantity'], $todayQuantity['quantity']);

            $calculation = $this->calculationDifference($data, $todayQuantity['quantity'], $yesterdayQuantity['quantity']);

            if (empty($calculation)) {
                $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=ошибка консольной команды actionToday. пустое значение $calculation', "r");
                fclose($sendToTelegram);
                continue;
            }

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