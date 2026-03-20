<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Практическая работа 3-4: Массивы в PHP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #2b6c8f 0%, #4b7aa1 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            line-height: 1.6;
            padding: 40px 20px;
            min-height: 100vh;
            color: #2d3748;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 50px;
        }

        .header h1 {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(135deg, #ffffff 0%, #e0f2ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
            letter-spacing: -0.02em;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .header p {
            font-size: 1.2rem;
            color: rgba(255,255,255,0.9);
            font-weight: 300;
        }

        .tasks-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 25px;
        }

        .task-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15), 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.3);
            display: flex;
            flex-direction: column;
            height: fit-content;
        }

        .task-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 50px rgba(0, 0, 0, 0.2);
        }

        .task-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 15px;
        }

        .task-number {
            background: linear-gradient(135deg, #2b6c8f 0%, #4b7aa1 100%);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            margin-right: 15px;
            box-shadow: 0 4px 10px rgba(43, 108, 143, 0.3);
        }

        .task-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2d3748;
            letter-spacing: -0.01em;
        }

        .task-description {
            background: #f7fafc;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 0.95rem;
            color: #4a5568;
            border-left: 4px solid #2b6c8f;
            font-family: 'Inter', sans-serif;
            line-height: 1.5;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
        }

        /* Код решения - ПОЛНЫЙ ИСПОЛНЯЕМЫЙ КОД */
        .task-solution {
            background: #1a202c;
            border-radius: 14px;
            padding: 18px;
            margin: 15px 0;
            overflow-x: auto;
            overflow-y: auto;
            flex-grow: 1;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            max-height: 350px;
        }

        .task-solution pre {
            margin: 0;
            color: #e2e8f0;
            font-family: 'Fira Code', 'Cascadia Code', 'JetBrains Mono', 'Courier New', monospace;
            font-size: 0.9rem;
            line-height: 1.5;
            white-space: pre-wrap;
            word-wrap: break-word;
            tab-size: 2;
        }

        .task-result {
            background: #c6f6d5;
            border: 1px solid #9ae6b4;
            border-radius: 12px;
            padding: 15px 18px;
            margin-top: 15px;
            font-size: 1rem;
            color: #22543d;
            font-weight: 500;
            display: flex;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 10px;
            box-shadow: 0 4px 8px rgba(72, 187, 120, 0.1);
            max-height: 250px;
            overflow-y: auto;
        }

        .result-label {
            font-weight: 600;
            background: #38a169;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            letter-spacing: 0.3px;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .result-value {
            font-family: 'Fira Code', monospace;
            background: white;
            padding: 6px 14px;
            border-radius: 30px;
            color: #1e293b;
            font-weight: 500;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            word-break: break-word;
            flex: 1;
        }

        .result-value.multiline {
            white-space: pre-line;
            font-family: 'Inter', monospace;
            line-height: 1.4;
        }

        .result-value.array {
            background: #e2e8f0;
            color: #2d3748;
            font-family: 'Fira Code', monospace;
            font-size: 0.9rem;
        }

        .section-title {
            grid-column: 1 / -1;
            margin: 30px 0 20px;
            color: white;
            font-size: 2rem;
            font-weight: 600;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
            border-left: 6px solid #ffd700;
            padding-left: 20px;
        }

        @media (max-width: 768px) {
            body {
                padding: 20px 10px;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .tasks-grid {
                grid-template-columns: 1fr;
            }
            
            .task-card {
                padding: 20px;
            }
            
            .task-number {
                width: 35px;
                height: 35px;
                font-size: 1rem;
            }
            
            .task-solution {
                max-height: 300px;
            }
        }

        .keyword { color: #ff79c6; }
        .string { color: #f1fa8c; }
        .comment { color: #6272a4; }
        .function { color: #50fa7b; }
        .variable { color: #ffb86c; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Практическая работа 3-4</h1>
            <p>Массивы в PHP: индексированные, ассоциативные и многомерные массивы</p>
        </div>

        <div class="tasks-grid">
            <!-- ОБЫЧНЫЕ МАССИВЫ -->
            <div class="section-title">📦 Работа с массивами</div>

            <!-- Задача 1 -->
            <?php
            $arr1 = ['a', 'b', 'c'];
            ob_start();
            var_dump($arr1);
            $arr1_dump = ob_get_clean();
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">1</span>
                    <span class="task-title">Создание массива</span>
                </div>
                <div class="task-description">
                    Создайте массив $arr=['a', 'b', 'c']. Выведите значение массива на экран с помощью функции var_dump().
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'a'</span>, <span style="color: #f1fa8c;">'b'</span>, <span style="color: #f1fa8c;">'c'</span>];<br><span style="color: #50fa7b;">var_dump</span>(<span style="color: #ffb86c;">$arr</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline array"><?php echo $arr1_dump; ?></span>
                </div>
            </div>

            <!-- Задача 2 -->
            <?php
            $arr2 = ['a', 'b', 'c'];
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">Вывод элементов</span>
                </div>
                <div class="task-description">
                    С помощью массива $arr из предыдущего номера выведите на экран содержимое первого, второго и третьего элементов.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'a'</span>, <span style="color: #f1fa8c;">'b'</span>, <span style="color: #f1fa8c;">'c'</span>];<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$arr</span>[0] . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$arr</span>[1] . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$arr</span>[2];</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php echo "$arr2[0]\n$arr2[1]\n$arr2[2]"; ?></span>
                </div>
            </div>

            <!-- Задача 3 -->
            <?php
            $arr3 = ['a', 'b', 'c', 'd'];
            $str3 = $arr3[0] . '+' . $arr3[1] . ', ' . $arr3[2] . '+' . $arr3[3];
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">3</span>
                    <span class="task-title">Формирование строки</span>
                </div>
                <div class="task-description">
                    Создайте массив $arr=['a', 'b', 'c', 'd'] и с его помощью выведите на экран строку 'a+b, c+d'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'a'</span>, <span style="color: #f1fa8c;">'b'</span>, <span style="color: #f1fa8c;">'c'</span>, <span style="color: #f1fa8c;">'d'</span>];<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$arr</span>[0] . <span style="color: #f1fa8c;">'+'</span> . <span style="color: #ffb86c;">$arr</span>[1] . <span style="color: #f1fa8c;">', '</span> . <span style="color: #ffb86c;">$arr</span>[2] . <span style="color: #f1fa8c;">'+'</span> . <span style="color: #ffb86c;">$arr</span>[3];</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $str3; ?></span>
                </div>
            </div>

            <!-- Задача 4 -->
            <?php
            $arr4 = [2, 5, 3, 9];
            $result4 = ($arr4[0] * $arr4[1]) + ($arr4[2] * $arr4[3]);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4</span>
                    <span class="task-title">Вычисления с массивом</span>
                </div>
                <div class="task-description">
                    Создайте массив $arr с элементами 2, 5, 3, 9. Умножьте первый элемент на второй, а третий на четвертый. Результаты сложите в $result.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [2, 5, 3, 9];<br><span style="color: #ffb86c;">$result</span> = (<span style="color: #ffb86c;">$arr</span>[0] * <span style="color: #ffb86c;">$arr</span>[1]) + (<span style="color: #ffb86c;">$arr</span>[2] * <span style="color: #ffb86c;">$arr</span>[3]);<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$result</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result4; ?></span>
                </div>
            </div>

            <!-- Задача 5 -->
            <?php
            $arr5 = [];
            $arr5[] = 1;
            $arr5[] = 2;
            $arr5[] = 3;
            $arr5[] = 4;
            $arr5[] = 5;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">5</span>
                    <span class="task-title">Заполнение массива</span>
                </div>
                <div class="task-description">
                    Заполните массив $arr числами от 1 до 5. Не объявляйте массив, а просто заполните его присваиванием $arr[] = новое значение.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [];<br><span style="color: #ffb86c;">$arr</span>[] = 1;<br><span style="color: #ffb86c;">$arr</span>[] = 2;<br><span style="color: #ffb86c;">$arr</span>[] = 3;<br><span style="color: #ffb86c;">$arr</span>[] = 4;<br><span style="color: #ffb86c;">$arr</span>[] = 5;<br><span style="color: #50fa7b;">print_r</span>(<span style="color: #ffb86c;">$arr</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php print_r($arr5); ?></span>
                </div>
            </div>

            <!-- АССОЦИАТИВНЫЕ МАССИВЫ -->
            <div class="section-title">🔑 Ассоциативные массивы</div>

            <!-- Задача 6 -->
            <?php
            $arr6 = ['a'=>1, 'b'=>2, 'c'=>3];
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">6</span>
                    <span class="task-title">Вывод по ключу</span>
                </div>
                <div class="task-description">
                    Создайте массив $arr. Выведите на экран элемент с ключом 'c'.<br>
                    $arr = ['a'=>1, 'b'=>2, 'c'=>3];
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'a'</span> => 1, <span style="color: #f1fa8c;">'b'</span> => 2, <span style="color: #f1fa8c;">'c'</span> => 3];<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$arr</span>[<span style="color: #f1fa8c;">'c'</span>];</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $arr6['c']; ?></span>
                </div>
            </div>

            <!-- Задача 7 -->
            <?php
            $arr7 = ['a'=>1, 'b'=>2, 'c'=>3];
            $sum7 = array_sum($arr7);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">7</span>
                    <span class="task-title">Сумма элементов</span>
                </div>
                <div class="task-description">
                    Создайте массив $arr. Найдите сумму элементов этого массива.<br>
                    $arr = ['a'=>1, 'b'=>2, 'c'=>3];
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'a'</span> => 1, <span style="color: #f1fa8c;">'b'</span> => 2, <span style="color: #f1fa8c;">'c'</span> => 3];<br><span style="color: #ffb86c;">$sum</span> = <span style="color: #ffb86c;">$arr</span>[<span style="color: #f1fa8c;">'a'</span>] + <span style="color: #ffb86c;">$arr</span>[<span style="color: #f1fa8c;">'b'</span>] + <span style="color: #ffb86c;">$arr</span>[<span style="color: #f1fa8c;">'c'</span>];<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$sum</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $sum7; ?></span>
                </div>
            </div>

            <!-- Задача 8 -->
            <?php
            $arr8 = ['Коля'=>'1000$', 'Вася'=>'500$', 'Петя'=>'200$'];
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">8</span>
                    <span class="task-title">Зарплаты</span>
                </div>
                <div class="task-description">
                    Создайте массив заработных плат $arr. Выведите на экран зарплату Пети и Коли.<br>
                    $arr = ['Коля'=>'1000$', 'Вася'=>'500$', 'Петя'=>'200$'];
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'Коля'</span> => <span style="color: #f1fa8c;">'1000$'</span>, <span style="color: #f1fa8c;">'Вася'</span> => <span style="color: #f1fa8c;">'500$'</span>, <span style="color: #f1fa8c;">'Петя'</span> => <span style="color: #f1fa8c;">'200$'</span>];<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Петя: "</span> . <span style="color: #ffb86c;">$arr</span>[<span style="color: #f1fa8c;">'Петя'</span>] . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Коля: "</span> . <span style="color: #ffb86c;">$arr</span>[<span style="color: #f1fa8c;">'Коля'</span>];</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php echo "Петя: " . $arr8['Петя'] . "\nКоля: " . $arr8['Коля']; ?></span>
                </div>
            </div>

            <!-- Задача 9 -->
            <?php
            $week9 = [
                1 => 'понедельник',
                2 => 'вторник',
                3 => 'среда',
                4 => 'четверг',
                5 => 'пятница',
                6 => 'суббота',
                7 => 'воскресенье'
            ];
            $currentDay9 = 3;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">9</span>
                    <span class="task-title">Дни недели</span>
                </div>
                <div class="task-description">
                    Создайте ассоциативный массив дней недели. Ключи - номера дней (1 - понедельник и т.д.). Выведите текущий день.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$week</span> = [<br>    1 => <span style="color: #f1fa8c;">'понедельник'</span>,<br>    2 => <span style="color: #f1fa8c;">'вторник'</span>,<br>    3 => <span style="color: #f1fa8c;">'среда'</span>,<br>    4 => <span style="color: #f1fa8c;">'четверг'</span>,<br>    5 => <span style="color: #f1fa8c;">'пятница'</span>,<br>    6 => <span style="color: #f1fa8c;">'суббота'</span>,<br>    7 => <span style="color: #f1fa8c;">'воскресенье'</span><br>];<br><span style="color: #ffb86c;">$currentDay</span> = 3;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$week</span>[<span style="color: #ffb86c;">$currentDay</span>];</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $week9[$currentDay9]; ?></span>
                </div>
            </div>

            <!-- Задача 10 -->
            <?php
            $week10 = [
                1 => 'понедельник',
                2 => 'вторник',
                3 => 'среда',
                4 => 'четверг',
                5 => 'пятница',
                6 => 'суббота',
                7 => 'воскресенье'
            ];
            $day10 = 5;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">10</span>
                    <span class="task-title">День по номеру</span>
                </div>
                <div class="task-description">
                    Пусть номер дня недели хранится в переменной $day. Выведите день недели, соответствующий значению переменной $day.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$week</span> = [<br>    1 => <span style="color: #f1fa8c;">'понедельник'</span>,<br>    2 => <span style="color: #f1fa8c;">'вторник'</span>,<br>    3 => <span style="color: #f1fa8c;">'среда'</span>,<br>    4 => <span style="color: #f1fa8c;">'четверг'</span>,<br>    5 => <span style="color: #f1fa8c;">'пятница'</span>,<br>    6 => <span style="color: #f1fa8c;">'суббота'</span>,<br>    7 => <span style="color: #f1fa8c;">'воскресенье'</span><br>];<br><span style="color: #ffb86c;">$day</span> = 5;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$week</span>[<span style="color: #ffb86c;">$day</span>];</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $week10[$day10]; ?></span>
                </div>
            </div>

            <!-- МНОГОМЕРНЫЕ МАССИВЫ -->
            <div class="section-title">🗂️ Многомерные массивы</div>

            <!-- Задача 11 -->
            <?php
            $arr11 = [
                'cms' => ['joomla', 'wordpress', 'drupal'],
                'colors' => ['blue' => 'голубой', 'red' => 'красный', 'green' => 'зеленый']
            ];
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">11</span>
                    <span class="task-title">Многомерный массив</span>
                </div>
                <div class="task-description">
                    Создайте многомерный массив. Выведите слова 'joomla', 'drupal', 'зеленый', 'красный'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<br>    <span style="color: #f1fa8c;">'cms'</span> => [<span style="color: #f1fa8c;">'joomla'</span>, <span style="color: #f1fa8c;">'wordpress'</span>, <span style="color: #f1fa8c;">'drupal'</span>],<br>    <span style="color: #f1fa8c;">'colors'</span> => [<span style="color: #f1fa8c;">'blue'</span> => <span style="color: #f1fa8c;">'голубой'</span>, <span style="color: #f1fa8c;">'red'</span> => <span style="color: #f1fa8c;">'красный'</span>, <span style="color: #f1fa8c;">'green'</span> => <span style="color: #f1fa8c;">'зеленый'</span>]<br>];<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$arr</span>[<span style="color: #f1fa8c;">'cms'</span>][0] . <span style="color: #f1fa8c;">', '</span> . <span style="color: #ffb86c;">$arr</span>[<span style="color: #f1fa8c;">'cms'</span>][2] . <span style="color: #f1fa8c;">', '</span> . <span style="color: #ffb86c;">$arr</span>[<span style="color: #f1fa8c;">'colors'</span>][<span style="color: #f1fa8c;">'green'</span>] . <span style="color: #f1fa8c;">', '</span> . <span style="color: #ffb86c;">$arr</span>[<span style="color: #f1fa8c;">'colors'</span>][<span style="color: #f1fa8c;">'red'</span>];</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $arr11['cms'][0] . ', ' . $arr11['cms'][2] . ', ' . $arr11['colors']['green'] . ', ' . $arr11['colors']['red']; ?></span>
                </div>
            </div>

            <!-- Задача 12 -->
            <?php
            $week12 = [
                'ru' => ['понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота', 'воскресенье'],
                'en' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']
            ];
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">12</span>
                    <span class="task-title">Двухмерный массив</span>
                </div>
                <div class="task-description">
                    Создайте двухмерный массив с ключами 'ru' и 'en'. Выведите понедельник по-русски и среду по-английски.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$week</span> = [<br>    <span style="color: #f1fa8c;">'ru'</span> => [<span style="color: #f1fa8c;">'понедельник'</span>, <span style="color: #f1fa8c;">'вторник'</span>, <span style="color: #f1fa8c;">'среда'</span>, <span style="color: #f1fa8c;">'четверг'</span>, <span style="color: #f1fa8c;">'пятница'</span>, <span style="color: #f1fa8c;">'суббота'</span>, <span style="color: #f1fa8c;">'воскресенье'</span>],<br>    <span style="color: #f1fa8c;">'en'</span> => [<span style="color: #f1fa8c;">'monday'</span>, <span style="color: #f1fa8c;">'tuesday'</span>, <span style="color: #f1fa8c;">'wednesday'</span>, <span style="color: #f1fa8c;">'thursday'</span>, <span style="color: #f1fa8c;">'friday'</span>, <span style="color: #f1fa8c;">'saturday'</span>, <span style="color: #f1fa8c;">'sunday'</span>]<br>];<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$week</span>[<span style="color: #f1fa8c;">'ru'</span>][0] . <span style="color: #f1fa8c;">', '</span> . <span style="color: #ffb86c;">$week</span>[<span style="color: #f1fa8c;">'en'</span>][2];</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $week12['ru'][0] . ', ' . $week12['en'][2]; ?></span>
                </div>
            </div>

            <!-- Задача 13 -->
            <?php
            $week13 = [
                'ru' => ['понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота', 'воскресенье'],
                'en' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']
            ];
            $lang13 = 'ru';
            $day13 = 3;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">13</span>
                    <span class="task-title">Динамический выбор</span>
                </div>
                <div class="task-description">
                    Пусть в переменной $lang хранится язык ('ru' или 'en'), а в $day - номер дня. Выведите день недели соответствующий переменным.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$week</span> = [<br>    <span style="color: #f1fa8c;">'ru'</span> => [<span style="color: #f1fa8c;">'понедельник'</span>, <span style="color: #f1fa8c;">'вторник'</span>, <span style="color: #f1fa8c;">'среда'</span>, <span style="color: #f1fa8c;">'четверг'</span>, <span style="color: #f1fa8c;">'пятница'</span>, <span style="color: #f1fa8c;">'суббота'</span>, <span style="color: #f1fa8c;">'воскресенье'</span>],<br>    <span style="color: #f1fa8c;">'en'</span> => [<span style="color: #f1fa8c;">'monday'</span>, <span style="color: #f1fa8c;">'tuesday'</span>, <span style="color: #f1fa8c;">'wednesday'</span>, <span style="color: #f1fa8c;">'thursday'</span>, <span style="color: #f1fa8c;">'friday'</span>, <span style="color: #f1fa8c;">'saturday'</span>, <span style="color: #f1fa8c;">'sunday'</span>]<br>];<br><span style="color: #ffb86c;">$lang</span> = <span style="color: #f1fa8c;">'ru'</span>;<br><span style="color: #ffb86c;">$day</span> = 3;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$week</span>[<span style="color: #ffb86c;">$lang</span>][<span style="color: #ffb86c;">$day</span> - 1];</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $week13[$lang13][$day13-1]; ?></span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>