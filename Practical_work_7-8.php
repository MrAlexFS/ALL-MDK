<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Практическая работа 7-8: Циклы в PHP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
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
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
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
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
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
            border-left: 4px solid #3498db;
            font-family: 'Inter', sans-serif;
            line-height: 1.5;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
        }

        /* Код решения - ПОЛНЫЙ ИСПОЛНЯЕМЫЙ КОД с прокруткой */
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

        .keyword { color: #ff79c6; }
        .string { color: #f1fa8c; }
        .comment { color: #6272a4; }
        .function { color: #50fa7b; }
        .variable { color: #ffb86c; }
        
        .bold {
            font-weight: bold;
            color: #e53e3e;
        }
        
        .italic {
            font-style: italic;
            color: #3182ce;
        }
        
        .day-item {
            display: inline-block;
            margin-right: 5px;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Практическая работа 7-8</h1>
            <p>Циклы в PHP: foreach, while, for</p>
        </div>

        <div class="tasks-grid">
            <!-- FOREACH -->
            <div class="section-title">🔄 Работа с foreach</div>

            <!-- Задача 1 -->
            <?php
            $arr1 = ['html', 'css', 'php', 'js', 'jq'];
            $result1 = '';
            foreach ($arr1 as $elem) {
                $result1 .= $elem . "\n";
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">1</span>
                    <span class="task-title">Вывод массива</span>
                </div>
                <div class="task-description">
                    Дан массив ['html', 'css', 'php', 'js', 'jq']. С помощью foreach выведите эти слова в столбик.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'html'</span>, <span style="color: #f1fa8c;">'css'</span>, <span style="color: #f1fa8c;">'php'</span>, <span style="color: #f1fa8c;">'js'</span>, <span style="color: #f1fa8c;">'jq'</span>];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$elem</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$elem</span> . <span style="color: #f1fa8c;">"\n"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php echo $result1; ?></span>
                </div>
            </div>

            <!-- Задача 2 -->
            <?php
            $arr2 = [1, 2, 3, 4, 5];
            $result2 = 0;
            foreach ($arr2 as $elem) {
                $result2 += $elem;
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">Сумма элементов</span>
                </div>
                <div class="task-description">
                    Дан массив [1,2,3,4,5]. С помощью foreach найдите сумму элементов. Запишите в $result.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5];<br><span style="color: #ffb86c;">$result</span> = 0;<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$elem</span>) {<br>    <span style="color: #ffb86c;">$result</span> += <span style="color: #ffb86c;">$elem</span>;<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$result</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result2; ?></span>
                </div>
            </div>

            <!-- Задача 3 -->
            <?php
            $arr3 = [1, 2, 3, 4, 5];
            $result3 = 0;
            foreach ($arr3 as $elem) {
                $result3 += $elem * $elem;
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">3</span>
                    <span class="task-title">Сумма квадратов</span>
                </div>
                <div class="task-description">
                    Дан массив [1,2,3,4,5]. Найдите сумму квадратов элементов. Запишите в $result.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5];<br><span style="color: #ffb86c;">$result</span> = 0;<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$elem</span>) {<br>    <span style="color: #ffb86c;">$result</span> += <span style="color: #ffb86c;">$elem</span> * <span style="color: #ffb86c;">$elem</span>;<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$result</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result3; ?></span>
                </div>
            </div>

            <!-- РАБОТА С КЛЮЧАМИ -->
            <div class="section-title">🔑 Работа с ключами</div>

            <!-- Задача 4 -->
            <?php
            $arr4 = ['green' => 'зеленый', 'red' => 'красный', 'blue' => 'голубой'];
            $result4 = '';
            foreach ($arr4 as $key => $value) {
                $result4 .= "$key - $value\n";
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4</span>
                    <span class="task-title">Ключи и значения</span>
                </div>
                <div class="task-description">
                    Выведите на экран столбец ключей и элементов в формате 'green - зеленый'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'green'</span> => <span style="color: #f1fa8c;">'зеленый'</span>, <span style="color: #f1fa8c;">'red'</span> => <span style="color: #f1fa8c;">'красный'</span>, <span style="color: #f1fa8c;">'blue'</span> => <span style="color: #f1fa8c;">'голубой'</span>];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$key</span> => <span style="color: #ffb86c;">$value</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$key</span> . <span style="color: #f1fa8c;">' - '</span> . <span style="color: #ffb86c;">$value</span> . <span style="color: #f1fa8c;">"\n"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php echo $result4; ?></span>
                </div>
            </div>

            <!-- Задача 5 -->
            <?php
            $arr5 = ['Коля' => '200', 'Вася' => '300', 'Петя' => '400'];
            $result5 = '';
            foreach ($arr5 as $key => $value) {
                $result5 .= "$key - зарплата $value долларов.\n";
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">5</span>
                    <span class="task-title">Зарплаты</span>
                </div>
                <div class="task-description">
                    Выведите столбец строк 'Коля - зарплата 200 долларов.'
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'Коля'</span> => <span style="color: #f1fa8c;">'200'</span>, <span style="color: #f1fa8c;">'Вася'</span> => <span style="color: #f1fa8c;">'300'</span>, <span style="color: #f1fa8c;">'Петя'</span> => <span style="color: #f1fa8c;">'400'</span>];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$key</span> => <span style="color: #ffb86c;">$value</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$key</span> . <span style="color: #f1fa8c;">' - зарплата '</span> . <span style="color: #ffb86c;">$value</span> . <span style="color: #f1fa8c;">' долларов.'</span> . <span style="color: #f1fa8c;">"\n"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php echo $result5; ?></span>
                </div>
            </div>

            <!-- ЦИКЛЫ while и for -->
            <div class="section-title">🔄 Циклы while и for</div>

            <!-- Задача 6 -->
            <?php
            // while
            $result6_while = '';
            $i = 1;
            while ($i <= 100) {
                $result6_while .= $i . ' ';
                $i++;
            }
            
            // for
            $result6_for = '';
            for ($i = 1; $i <= 100; $i++) {
                $result6_for .= $i . ' ';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">6</span>
                    <span class="task-title">Числа от 1 до 100</span>
                </div>
                <div class="task-description">
                    Выведите столбец чисел от 1 до 100 (while и for).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #6272a4;">// while</span><br><span style="color: #ffb86c;">$i</span> = 1;<br><span style="color: #50fa7b;">while</span> (<span style="color: #ffb86c;">$i</span> <= 100) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$i</span> . <span style="color: #f1fa8c;">"\n"</span>;<br>    <span style="color: #ffb86c;">$i</span>++;<br>}<br><br><span style="color: #6272a4;">// for</span><br><span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = 1; <span style="color: #ffb86c;">$i</span> <= 100; <span style="color: #ffb86c;">$i</span>++) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$i</span> . <span style="color: #f1fa8c;">"\n"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат (for)</span>
                    <span class="result-value multiline" style="max-height: 200px;"><?php echo $result6_for; ?></span>
                </div>
            </div>

            <!-- Задача 7 -->
            <?php
            $result7_for = '';
            for ($i = 11; $i <= 33; $i++) {
                $result7_for .= $i . ' ';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">7</span>
                    <span class="task-title">Числа от 11 до 33</span>
                </div>
                <div class="task-description">
                    Выведите столбец чисел от 11 до 33.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = 11; <span style="color: #ffb86c;">$i</span> <= 33; <span style="color: #ffb86c;">$i</span>++) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$i</span> . <span style="color: #f1fa8c;">"\n"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result7_for; ?></span>
                </div>
            </div>

            <!-- Задача 8 -->
            <?php
            $result8 = '';
            for ($i = 0; $i <= 100; $i += 2) {
                $result8 .= $i . ' ';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">8</span>
                    <span class="task-title">Четные числа</span>
                </div>
                <div class="task-description">
                    Выведите столбец четных чисел от 0 до 100.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = 0; <span style="color: #ffb86c;">$i</span> <= 100; <span style="color: #ffb86c;">$i</span> += 2) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$i</span> . <span style="color: #f1fa8c;">"\n"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result8; ?></span>
                </div>
            </div>

            <!-- Задача 9 -->
            <?php
            $result9 = 0;
            for ($i = 1; $i <= 100; $i++) {
                $result9 += $i;
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">9</span>
                    <span class="task-title">Сумма от 1 до 100</span>
                </div>
                <div class="task-description">
                    Найдите сумму чисел от 1 до 100.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$sum</span> = 0;<br><span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = 1; <span style="color: #ffb86c;">$i</span> <= 100; <span style="color: #ffb86c;">$i</span>++) {<br>    <span style="color: #ffb86c;">$sum</span> += <span style="color: #ffb86c;">$i</span>;<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$sum</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result9; ?></span>
                </div>
            </div>

            <!-- ЗАДАЧИ -->
            <div class="section-title">📝 Задачи</div>

            <!-- Задача 10 -->
            <?php
            $arr10 = [2, 5, 9, 15, 0, 4];
            $result10 = '';
            foreach ($arr10 as $elem) {
                if ($elem > 3 && $elem < 10) {
                    $result10 .= $elem . "\n";
                }
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">10</span>
                    <span class="task-title">Фильтр элементов</span>
                </div>
                <div class="task-description">
                    Выведите столбец элементов массива [2,5,9,15,0,4], которые больше 3, но меньше 10.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [2, 5, 9, 15, 0, 4];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$elem</span>) {<br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$elem</span> > 3 && <span style="color: #ffb86c;">$elem</span> < 10) {<br>        <span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$elem</span> . <span style="color: #f1fa8c;">"\n"</span>;<br>    }<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php echo $result10; ?></span>
                </div>
            </div>

            <!-- Задача 11 -->
            <?php
            $arr11 = [-5, 3, -2, 7, -1, 8, -4];
            $sum11 = 0;
            foreach ($arr11 as $elem) {
                if ($elem > 0) {
                    $sum11 += $elem;
                }
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">11</span>
                    <span class="task-title">Сумма положительных</span>
                </div>
                <div class="task-description">
                    Дан массив с числами. Найдите сумму положительных элементов.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [-5, 3, -2, 7, -1, 8, -4];<br><span style="color: #ffb86c;">$sum</span> = 0;<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$elem</span>) {<br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$elem</span> > 0) {<br>        <span style="color: #ffb86c;">$sum</span> += <span style="color: #ffb86c;">$elem</span>;<br>    }<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$sum</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $sum11; ?></span>
                </div>
            </div>

            <!-- Задача 12 -->
            <?php
            $arr12 = [1, 2, 5, 9, 4, 13, 4, 10];
            $hasFour = false;
            foreach ($arr12 as $elem) {
                if ($elem == 4) {
                    $hasFour = true;
                    break;
                }
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">12</span>
                    <span class="task-title">Поиск элемента</span>
                </div>
                <div class="task-description">
                    Проверьте, есть ли в массиве элемент со значением 4. Если есть - выведите 'Есть!'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 5, 9, 4, 13, 4, 10];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$elem</span>) {<br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$elem</span> == 4) {<br>        <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'Есть!'</span>;<br>        <span style="color: #50fa7b;">break</span>;<br>    }<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $hasFour ? 'Есть!' : 'Нет'; ?></span>
                </div>
            </div>

            <!-- Задача 13 -->
            <?php
            $arr13 = ['10', '20', '30', '50', '235', '3000'];
            $result13 = '';
            foreach ($arr13 as $num) {
                $first = $num[0];
                if ($first == '1' || $first == '2' || $first == '5') {
                    $result13 .= $num . "\n";
                }
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">13</span>
                    <span class="task-title">Начинаются на 1,2,5</span>
                </div>
                <div class="task-description">
                    Выведите числа массива ['10','20','30','50','235','3000'], которые начинаются на 1, 2 или 5.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'10'</span>, <span style="color: #f1fa8c;">'20'</span>, <span style="color: #f1fa8c;">'30'</span>, <span style="color: #f1fa8c;">'50'</span>, <span style="color: #f1fa8c;">'235'</span>, <span style="color: #f1fa8c;">'3000'</span>];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$num</span>) {<br>    <span style="color: #ffb86c;">$first</span> = <span style="color: #ffb86c;">$num</span>[0];<br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$first</span> == <span style="color: #f1fa8c;">'1'</span> || <span style="color: #ffb86c;">$first</span> == <span style="color: #f1fa8c;">'2'</span> || <span style="color: #ffb86c;">$first</span> == <span style="color: #f1fa8c;">'5'</span>) {<br>        <span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$num</span> . <span style="color: #f1fa8c;">"\n"</span>;<br>    }<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php echo $result13; ?></span>
                </div>
            </div>

            <!-- Задача 14 -->
            <?php
            $arr14 = [1, 2, 3, 4, 5, 6, 7, 8, 9];
            $str14 = '-';
            foreach ($arr14 as $num) {
                $str14 .= $num . '-';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">14</span>
                    <span class="task-title">Строка с дефисами</span>
                </div>
                <div class="task-description">
                    Создайте строку '-1-2-3-4-5-6-7-8-9-' из массива [1,2,3,4,5,6,7,8,9].
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5, 6, 7, 8, 9];<br><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'-'</span>;<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$num</span>) {<br>    <span style="color: #ffb86c;">$str</span> .= <span style="color: #ffb86c;">$num</span> . <span style="color: #f1fa8c;">'-'</span>;<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$str</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $str14; ?></span>
                </div>
            </div>

            <!-- Задача 15 -->
            <?php
            $days15 = ['понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота', 'воскресенье'];
            $result15 = '';
            foreach ($days15 as $index => $day) {
                if ($index >= 5) {
                    $result15 .= '**' . $day . '** ';
                } else {
                    $result15 .= $day . ' ';
                }
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">15</span>
                    <span class="task-title">Дни недели (жирный)</span>
                </div>
                <div class="task-description">
                    Выведите все дни недели, а выходные выделите жирным.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$days</span> = [<span style="color: #f1fa8c;">'понедельник'</span>, <span style="color: #f1fa8c;">'вторник'</span>, <span style="color: #f1fa8c;">'среда'</span>, <span style="color: #f1fa8c;">'четверг'</span>, <span style="color: #f1fa8c;">'пятница'</span>, <span style="color: #f1fa8c;">'суббота'</span>, <span style="color: #f1fa8c;">'воскресенье'</span>];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$days</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$index</span> => <span style="color: #ffb86c;">$day</span>) {<br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$index</span> >= 5) {<br>        <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'&lt;b&gt;'</span> . <span style="color: #ffb86c;">$day</span> . <span style="color: #f1fa8c;">'&lt;/b&gt; '</span>;<br>    } <span style="color: #50fa7b;">else</span> {<br>        <span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$day</span> . <span style="color: #f1fa8c;">' '</span>;<br>    }<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result15; ?></span>
                </div>
            </div>

            <!-- Задача 16 -->
            <?php
            $days16 = ['понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота', 'воскресенье'];
            $currentDay16 = 3;
            $result16 = '';
            foreach ($days16 as $index => $day) {
                if ($index == $currentDay16 - 1) {
                    $result16 .= '*' . $day . '* ';
                } else {
                    $result16 .= $day . ' ';
                }
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">16</span>
                    <span class="task-title">Текущий день курсивом</span>
                </div>
                <div class="task-description">
                    Выведите все дни недели, текущий день выделите курсивом ($day = 3).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$days</span> = [<span style="color: #f1fa8c;">'понедельник'</span>, <span style="color: #f1fa8c;">'вторник'</span>, <span style="color: #f1fa8c;">'среда'</span>, <span style="color: #f1fa8c;">'четверг'</span>, <span style="color: #f1fa8c;">'пятница'</span>, <span style="color: #f1fa8c;">'суббота'</span>, <span style="color: #f1fa8c;">'воскресенье'</span>];<br><span style="color: #ffb86c;">$currentDay</span> = 3;<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$days</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$index</span> => <span style="color: #ffb86c;">$day</span>) {<br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$index</span> == <span style="color: #ffb86c;">$currentDay</span> - 1) {<br>        <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'&lt;i&gt;'</span> . <span style="color: #ffb86c;">$day</span> . <span style="color: #f1fa8c;">'&lt;/i&gt; '</span>;<br>    } <span style="color: #50fa7b;">else</span> {<br>        <span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$day</span> . <span style="color: #f1fa8c;">' '</span>;<br>    }<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result16; ?></span>
                </div>
            </div>

            <!-- ЗАДАЧИ ПОСЛОЖНЕЕ -->
            <div class="section-title">⭐ Задачи посложнее</div>

            <!-- Задача 17 -->
            <?php
            $arr17 = [];
            for ($i = 1; $i <= 100; $i++) {
                $arr17[] = $i;
            }
            $result17 = implode(' ', array_slice($arr17, 0, 20)) . '...';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">17</span>
                    <span class="task-title">Массив 1-100</span>
                </div>
                <div class="task-description">
                    С помощью цикла for заполните массив числами от 1 до 100.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [];<br><span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = 1; <span style="color: #ffb86c;">$i</span> <= 100; <span style="color: #ffb86c;">$i</span>++) {<br>    <span style="color: #ffb86c;">$arr</span>[] = <span style="color: #ffb86c;">$i</span>;<br>}<br><span style="color: #50fa7b;">print_r</span>(<span style="color: #ffb86c;">$arr</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result17; ?></span>
                </div>
            </div>

            <!-- Задача 18 -->
            <?php
            $arr18 = ['green' => 'зеленый', 'red' => 'красный', 'blue' => 'голубой'];
            $en = [];
            $ru = [];
            foreach ($arr18 as $key => $value) {
                $en[] = $key;
                $ru[] = $value;
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">18</span>
                    <span class="task-title">Разделение массивов</span>
                </div>
                <div class="task-description">
                    Запишите английские названия в массив $en, а русские - в $ru.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'green'</span> => <span style="color: #f1fa8c;">'зеленый'</span>, <span style="color: #f1fa8c;">'red'</span> => <span style="color: #f1fa8c;">'красный'</span>, <span style="color: #f1fa8c;">'blue'</span> => <span style="color: #f1fa8c;">'голубой'</span>];<br><span style="color: #ffb86c;">$en</span> = [];<br><span style="color: #ffb86c;">$ru</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$key</span> => <span style="color: #ffb86c;">$value</span>) {<br>    <span style="color: #ffb86c;">$en</span>[] = <span style="color: #ffb86c;">$key</span>;<br>    <span style="color: #ffb86c;">$ru</span>[] = <span style="color: #ffb86c;">$value</span>;<br>}<br><span style="color: #50fa7b;">print_r</span>(<span style="color: #ffb86c;">$en</span>);<br><span style="color: #50fa7b;">print_r</span>(<span style="color: #ffb86c;">$ru</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "en: " . implode(', ', $en) . "\nru: " . implode(', ', $ru); 
                    ?></span>
                </div>
            </div>

            <!-- Задача 19 -->
            <?php
            $num19_while = 1000;
            $count19_while = 0;
            while ($num19_while >= 50) {
                $num19_while /= 2;
                $count19_while++;
            }
            
            $num19_for = 1000;
            $count19_for = 0;
            for (; $num19_for >= 50; $count19_for++) {
                $num19_for /= 2;
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">19</span>
                    <span class="task-title">Деление на 2</span>
                </div>
                <div class="task-description">
                    Делите 1000 на 2 пока результат не станет меньше 50. Какое число получится? Сколько итераций?
                </div>
                <div class="task-solution">
                    <pre><span style="color: #6272a4;">// while</span><br><span style="color: #ffb86c;">$num</span> = 1000;<br><span style="color: #ffb86c;">$count</span> = 0;<br><span style="color: #50fa7b;">while</span> (<span style="color: #ffb86c;">$num</span> >= 50) {<br>    <span style="color: #ffb86c;">$num</span> /= 2;<br>    <span style="color: #ffb86c;">$count</span>++;<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"while: число = </span><span style="color: #ffb86c;">$num</span><span style="color: #f1fa8c;">, итераций = </span><span style="color: #ffb86c;">$count</span><span style="color: #f1fa8c;">\n"</span>;<br><br><span style="color: #6272a4;">// for</span><br><span style="color: #ffb86c;">$num</span> = 1000;<br><span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$count</span> = 0; <span style="color: #ffb86c;">$num</span> >= 50; <span style="color: #ffb86c;">$count</span>++) {<br>    <span style="color: #ffb86c;">$num</span> /= 2;<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"for: число = </span><span style="color: #ffb86c;">$num</span><span style="color: #f1fa8c;">, итераций = </span><span style="color: #ffb86c;">$count</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "while: число = $num19_while, итераций = $count19_while\n";
                        echo "for: число = $num19_for, итераций = $count19_for";
                    ?></span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>