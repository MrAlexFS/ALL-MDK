<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Практическая работа 1-2: Решения задач PHP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            background: linear-gradient(135deg, #ffffff 0%, #e0e7ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
            letter-spacing: -0.02em;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            box-shadow: 0 4px 10px rgba(102, 126, 234, 0.3);
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
            border-left: 4px solid #667eea;
            font-family: 'Inter', sans-serif;
            line-height: 1.5;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.02);
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
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            max-height: 300px;
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
            max-height: 200px;
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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            word-break: break-word;
            flex: 1;
        }

        .result-value.multiline {
            white-space: pre-line;
            font-family: 'Inter', monospace;
            line-height: 1.4;
        }

        .section-title {
            grid-column: 1 / -1;
            margin: 30px 0 20px;
            color: white;
            font-size: 2rem;
            font-weight: 600;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
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
                max-height: 250px;
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
            <h1>Практическая работа 1-2</h1>
            <p>Основы PHP: переменные, операции со строками и числами</p>
        </div>

        <div class="tasks-grid">
            <!-- РАБОТА С ПЕРЕМЕННЫМИ -->
            <div class="section-title">📊 Работа с переменными</div>

            <!-- Задача 1 -->
            <?php
                $a1 = 3;
                $result1 = $a1;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">1</span>
                    <span class="task-title">Создание переменной</span>
                </div>
                <div class="task-description">
                    Создайте переменную $a и присвойте ей значение 3. Выведите значение этой переменной на экран.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$a</span> = 3;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$a</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result1; ?></span>
                </div>
            </div>

            <!-- Задача 2 -->
            <?php
                $a2 = 10;
                $b2 = 2;
                $sum2 = $a2 + $b2;
                $diff2 = $a2 - $b2;
                $prod2 = $a2 * $b2;
                $quot2 = $a2 / $b2;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">Арифметические операции</span>
                </div>
                <div class="task-description">
                    Создайте переменные $a=10 и $b=2. Выведите на экран их сумму, разность, произведение и частное.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$a</span> = 10;<br><span style="color: #ffb86c;">$b</span> = 2;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$a</span> + <span style="color: #ffb86c;">$b</span> . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$a</span> - <span style="color: #ffb86c;">$b</span> . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$a</span> * <span style="color: #ffb86c;">$b</span> . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$a</span> / <span style="color: #ffb86c;">$b</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php echo "$sum2\n$diff2\n$prod2\n$quot2"; ?></span>
                </div>
            </div>

            <!-- Задача 3 -->
            <?php
                $c3 = 15;
                $d3 = 2;
                $result3 = $c3 + $d3;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">3</span>
                    <span class="task-title">Присваивание результата</span>
                </div>
                <div class="task-description">
                    Создайте переменные $c=15 и $d=2. Просуммируйте их, а результат присвойте переменной $result.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$c</span> = 15;<br><span style="color: #ffb86c;">$d</span> = 2;<br><span style="color: #ffb86c;">$result</span> = <span style="color: #ffb86c;">$c</span> + <span style="color: #ffb86c;">$d</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$result</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result3; ?></span>
                </div>
            </div>

            <!-- Задача 4 -->
            <?php
                $a4 = 10;
                $b4 = 2;
                $c4 = 5;
                $sum4 = $a4 + $b4 + $c4;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4</span>
                    <span class="task-title">Сумма трех чисел</span>
                </div>
                <div class="task-description">
                    Создайте переменные $a=10, $b=2 и $c=5. Выведите на экран их сумму.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$a</span> = 10;<br><span style="color: #ffb86c;">$b</span> = 2;<br><span style="color: #ffb86c;">$c</span> = 5;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$a</span> + <span style="color: #ffb86c;">$b</span> + <span style="color: #ffb86c;">$c</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $sum4; ?></span>
                </div>
            </div>

            <!-- Задача 5 -->
            <?php
                $a5 = 17;
                $b5 = 10;
                $c5 = $a5 - $b5;
                $d5 = 7;
                $result5 = $c5 + $d5;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">5</span>
                    <span class="task-title">Многоступенчатые вычисления</span>
                </div>
                <div class="task-description">
                    Создайте переменные $a=17 и $b=10. Отнимите от $a переменную $b и результат присвойте $c. Затем создайте $d=7. Сложите $c и $d в $result.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$a</span> = 17;<br><span style="color: #ffb86c;">$b</span> = 10;<br><span style="color: #ffb86c;">$c</span> = <span style="color: #ffb86c;">$a</span> - <span style="color: #ffb86c;">$b</span>;<br><span style="color: #ffb86c;">$d</span> = 7;<br><span style="color: #ffb86c;">$result</span> = <span style="color: #ffb86c;">$c</span> + <span style="color: #ffb86c;">$d</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$result</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result5; ?></span>
                </div>
            </div>

            <!-- РАБОТА СО СТРОКАМИ -->
            <div class="section-title">📝 Работа со строками</div>

            <!-- Задача 6 -->
            <?php
                $text6 = 'Привет, Мир!';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">6</span>
                    <span class="task-title">Привет, Мир!</span>
                </div>
                <div class="task-description">
                    Создайте переменную $text и присвойте ей значение 'Привет, Мир!'. Выведите значение на экран.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$text</span> = <span style="color: #f1fa8c;">'Привет, Мир!'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$text</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $text6; ?></span>
                </div>
            </div>

            <!-- Задача 7 -->
            <?php
                $text1_7 = 'Привет, ';
                $text2_7 = 'Мир!';
                $result7 = $text1_7 . $text2_7;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">7</span>
                    <span class="task-title">Конкатенация строк</span>
                </div>
                <div class="task-description">
                    Создайте переменные $text1='Привет, ' и $text2='Мир!'. С помощью операции сложения строк выведите 'Привет, Мир!'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$text1</span> = <span style="color: #f1fa8c;">'Привет, '</span>;<br><span style="color: #ffb86c;">$text2</span> = <span style="color: #f1fa8c;">'Мир!'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$text1</span> . <span style="color: #ffb86c;">$text2</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result7; ?></span>
                </div>
            </div>

            <!-- Задача 8 -->
            <?php
                $name8 = 'Анна';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">8</span>
                    <span class="task-title">Приветствие с именем</span>
                </div>
                <div class="task-description">
                    Создайте переменную $name с вашим именем. Выведите 'Привет, %Имя%!'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$name</span> = <span style="color: #f1fa8c;">'Анна'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Привет, <span style="color: #ffb86c;">$name</span>!"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo "Привет, $name8!"; ?></span>
                </div>
            </div>

            <!-- Задача 9 -->
            <?php
                $age9 = 18;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">9</span>
                    <span class="task-title">Возраст</span>
                </div>
                <div class="task-description">
                    Создайте переменную $age с вашим возрастом. Выведите 'Мне %Возраст% лет!'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$age</span> = 18;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Мне <span style="color: #ffb86c;">$age</span> лет!"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo "Мне $age9 лет!"; ?></span>
                </div>
            </div>

            <!-- ОБРАЩЕНИЕ К СИМВОЛАМ СТРОКИ -->
            <div class="section-title">🔤 Обращение к символам строки</div>

            <!-- Задача 10 -->
            <?php
                $text10 = 'abcde';
                $char_a = $text10[0];
                $char_c = $text10[2];
                $char_e = $text10[4];
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">10</span>
                    <span class="task-title">Индексация строк</span>
                </div>
                <div class="task-description">
                    Создайте переменную $text = 'abcde'. Выведите символы 'a', 'c', 'e' по отдельности.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$text</span> = <span style="color: #f1fa8c;">'abcde'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$text</span>[0] . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$text</span>[2] . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$text</span>[4];</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php echo "$char_a\n$char_c\n$char_e"; ?></span>
                </div>
            </div>

            <!-- Задача 11 -->
            <?php
                $text11 = 'abcde';
                $text11[0] = '!';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">11</span>
                    <span class="task-title">Замена символа</span>
                </div>
                <div class="task-description">
                    Дана строка 'abcde'. Поменяйте первую букву 'a' на '!'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$text</span> = <span style="color: #f1fa8c;">'abcde'</span>;<br><span style="color: #ffb86c;">$text</span>[0] = <span style="color: #f1fa8c;">'!'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$text</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $text11; ?></span>
                </div>
            </div>

            <!-- Задача 12 -->
            <?php
                $num12 = '12345';
                $sum12 = $num12[0] + $num12[1] + $num12[2] + $num12[3] + $num12[4];
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">12</span>
                    <span class="task-title">Сумма цифр числа</span>
                </div>
                <div class="task-description">
                    Создайте переменную $num = '12345'. Найдите сумму цифр этого числа.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$num</span> = <span style="color: #f1fa8c;">'12345'</span>;<br><span style="color: #ffb86c;">$sum</span> = <span style="color: #ffb86c;">$num</span>[0] + <span style="color: #ffb86c;">$num</span>[1] + <span style="color: #ffb86c;">$num</span>[2] + <span style="color: #ffb86c;">$num</span>[3] + <span style="color: #ffb86c;">$num</span>[4];<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$sum</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $sum12; ?></span>
                </div>
            </div>

            <!-- ПРАКТИКА -->
            <div class="section-title">⏱️ Практика</div>

            <!-- Задача 13 -->
            <?php
                $secondsInHour = 60 * 60;
                $secondsInDay = $secondsInHour * 24;
                $secondsInMonth = $secondsInDay * 30;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">13</span>
                    <span class="task-title">Секунды</span>
                </div>
                <div class="task-description">
                    Подсчитайте количество секунд в часе, в сутках, в месяце (30 дней).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$secondsInHour</span> = 60 * 60;<br><span style="color: #ffb86c;">$secondsInDay</span> = <span style="color: #ffb86c;">$secondsInHour</span> * 24;<br><span style="color: #ffb86c;">$secondsInMonth</span> = <span style="color: #ffb86c;">$secondsInDay</span> * 30;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"В часе: </span><span style="color: #ffb86c;">$secondsInHour</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"В сутках: </span><span style="color: #ffb86c;">$secondsInDay</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"В месяце: </span><span style="color: #ffb86c;">$secondsInMonth</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php echo "В часе: $secondsInHour\nВ сутках: $secondsInDay\nВ месяце: $secondsInMonth"; ?></span>
                </div>
            </div>

            <!-- Задача 14 -->
            <?php
                $hour14 = 15;
                $minute14 = 30;
                $second14 = 45;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">14</span>
                    <span class="task-title">Формат времени</span>
                </div>
                <div class="task-description">
                    Создайте переменные час, минута, секунда. Выведите время в формате 'час:минута:секунда'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$hour</span> = 15;<br><span style="color: #ffb86c;">$minute</span> = 30;<br><span style="color: #ffb86c;">$second</span> = 45;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"<span style="color: #ffb86c;">$hour</span>:<span style="color: #ffb86c;">$minute</span>:<span style="color: #ffb86c;">$second</span>"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo "$hour14:$minute14:$second14"; ?></span>
                </div>
            </div>

            <!-- Задача 15 -->
            <?php
                $number15 = 7;
                $square15 = $number15 * $number15;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">15</span>
                    <span class="task-title">Возведение в квадрат</span>
                </div>
                <div class="task-description">
                    Создайте переменную с числом. Возведите его в квадрат и выведите.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$number</span> = 7;<br><span style="color: #ffb86c;">$square</span> = <span style="color: #ffb86c;">$number</span> * <span style="color: #ffb86c;">$number</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Квадрат числа </span><span style="color: #ffb86c;">$number</span><span style="color: #f1fa8c;"> = </span><span style="color: #ffb86c;">$square</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo "Квадрат числа $number15 = $square15"; ?></span>
                </div>
            </div>

            <!-- РАБОТА С ПРИСВАИВАНИЕМ -->
            <div class="section-title">🔄 Работа с присваиванием и декрементами</div>

            <!-- Задача 16 -->
            <?php
                $var16 = 47;
                $var16 += 7;
                $var16 -= 18;
                $var16 *= 10;
                $var16 /= 20;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">16</span>
                    <span class="task-title">Операции +=, -=, *=, /=</span>
                </div>
                <div class="task-description">
                    Переделайте код с использованием сокращенных операций.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$var</span> = 47;<br><span style="color: #ffb86c;">$var</span> += 7;<br><span style="color: #ffb86c;">$var</span> -= 18;<br><span style="color: #ffb86c;">$var</span> *= 10;<br><span style="color: #ffb86c;">$var</span> /= 20;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$var</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $var16; ?></span>
                </div>
            </div>

            <!-- Задача 17 -->
            <?php
                $text17 = 'Я';
                $text17 .= ' хочу';
                $text17 .= ' знать';
                $text17 .= ' PHP!';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">17</span>
                    <span class="task-title">Операция .=</span>
                </div>
                <div class="task-description">
                    Переделайте код с использованием оператора .=
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$text</span> = <span style="color: #f1fa8c;">'Я'</span>;<br><span style="color: #ffb86c;">$text</span> .= <span style="color: #f1fa8c;">' хочу'</span>;<br><span style="color: #ffb86c;">$text</span> .= <span style="color: #f1fa8c;">' знать'</span>;<br><span style="color: #ffb86c;">$text</span> .= <span style="color: #f1fa8c;">' PHP!'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$text</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $text17; ?></span>
                </div>
            </div>

            <!-- Задача 18 -->
            <?php
                $var18 = 10;
                $var18++;
                $var18++;
                $var18--;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">18</span>
                    <span class="task-title">Операции ++ и --</span>
                </div>
                <div class="task-description">
                    Переделайте код с использованием инкремента и декремента.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$var</span> = 10;<br><span style="color: #ffb86c;">$var</span>++;<br><span style="color: #ffb86c;">$var</span>++;<br><span style="color: #ffb86c;">$var</span>--;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$var</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $var18; ?></span>
                </div>
            </div>

            <!-- Задача 19 -->
            <?php
                $var19 = 10;
                $var19 += 7;
                $var19++;
                $var19--;
                $var19 += 12;
                $var19 *= 7;
                $var19 -= 15;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">19</span>
                    <span class="task-title">Комбинированные операции</span>
                </div>
                <div class="task-description">
                    Переделайте код с использованием ++, --, +=, -=, *=, /=
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$var</span> = 10;<br><span style="color: #ffb86c;">$var</span> += 7;<br><span style="color: #ffb86c;">$var</span>++;<br><span style="color: #ffb86c;">$var</span>--;<br><span style="color: #ffb86c;">$var</span> += 12;<br><span style="color: #ffb86c;">$var</span> *= 7;<br><span style="color: #ffb86c;">$var</span> -= 15;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$var</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $var19; ?></span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>