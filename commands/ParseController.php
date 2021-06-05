<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ParseController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex()
    {
        $file = file_get_contents('https://hh.ru/search/vacancy?clusters=true&area=1&specialization=1&enable_snippets=true&salary=&st=searchVacancy&text=Codeception&from=suggest_post');
        $date = date('Y-m-d');

        preg_match_all('/<h1 data-qa="bloko-header-1" class="bloko-header-1">(.*) <!-- -->вакансий/', $file, $result);
        preg_match_all('/<!-- -->вакансий<!-- --> «(.*)»<\/h1>/', $file, $skill);

        echo 'Количество упоминаний: ' . $result[1][0] . "\n";
        echo 'Запрос: ' . $skill[1][0] . "\n";
        echo 'Дата парсинга: ' . $date . "\n";

        return ExitCode::OK;
    }
}
