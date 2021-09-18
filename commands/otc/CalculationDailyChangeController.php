<?php

namespace app\commands\otc;

use yii\console\Controller;
use app\models\Results;
use app\models\Input;

class CalculationDailyChangeController extends Controller
{
    public function actionRun()
    {
        $results = Results::find()
            ->asArray()
            ->select(['id'])
            ->all();

        for ($i = 0; $i < count($results); $i++) {

            $firstDay = Results::find()
                ->asArray()
                ->select(['date'])
                ->where(['id' => $results[$i]['id']])
                ->one();

            $secondDay = date('Y-m-d', strtotime('+1 day', strtotime($firstDay['date'])));

            $inputId = Results::find()
                ->asArray()
                ->select(['input_id'])
                ->where(['id' => $results[$i]['id']])
                ->one();

            $firstQuantity = Results::find()
                ->asArray()
                ->select(['quantity'])
                ->where(['date' => $firstDay, 'input_id' => $inputId['input_id']])
                ->one();

            if (empty($firstQuantity) || $firstQuantity['quantity'] == '0') {
                $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=ошибка консольной команды. пустое значение $firstQuantity', "r");
                fclose($sendToTelegram);
                continue;
            }

            $secondQuantity = Results::find()
                ->asArray()
                ->select(['quantity'])
                ->where(['date' => $secondDay, 'input_id' => $inputId['input_id']])
                ->one();

            if (empty($secondQuantity) || $secondQuantity['quantity'] == '0') {
                $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=ошибка консольной команды. пустое значение $secondQuantity', "r");
                fclose($sendToTelegram);
                continue;
            }

            $secondInputId = Results::find()
                ->asArray()
                ->select(['id'])
                ->where([
                    'date' => $secondDay,
                    'input_id' => $inputId['input_id'],
                    'quantity' => $secondQuantity['quantity'
                    ]])
                ->one();

            $data = $this->determiningOrderValues($secondQuantity['quantity'], $firstQuantity['quantity']);

            $calculation = $this->calculationDifference($data, $firstQuantity['quantity'], $secondQuantity['quantity']);

            if (empty($calculation)) {
                $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=ошибка консольной команды. пустое значение $calculation', "r");
                fclose($sendToTelegram);
                continue;
            }

            try {
                $model = Results::findOne($secondInputId['id']);
                $model->change_per_day = json_encode($calculation);
                $model->save();
            } catch (\Exception $e) {
                $sendToTelegram = fopen('https://api.telegram.org/bot1908284524:AAGMSVUc06Z2Iqsay5p-4m8lhfF8tacmH7U/sendMessage?chat_id=347810962&parse_mode=html&text=ошибка консольной команды. данные не сохранены ($model->change_per_day)', "r");
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
        $result['count'] = $second - $first;
        $result['percent'] = round(($data[1] / $data[0] - 1) * 100, 1);
        if ($result['count'] < 0) {
            $result['color'] = 'red';
        } elseif ($result['count'] > 0) {
            $result['color'] = 'green';
        }
        return $result;
    }
}
