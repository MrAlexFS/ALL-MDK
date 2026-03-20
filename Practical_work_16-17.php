<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Практическая работа №16-17: Условный оператор и оператор варианта в PHP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #2C3E50 0%, #3498DB 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            line-height: 1.6;
            padding: 40px 20px;
            min-height: 100vh;
            color: #2d3748;
        }

        .container {
            max-width: 1600px;
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

        .header-sub {
            color: rgba(255,255,255,0.8);
            font-size: 1.1rem;
            margin-top: 10px;
        }

        .theory-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .theory-section h2 {
            color: #2C3E50;
            margin-bottom: 20px;
            font-size: 1.8rem;
            border-bottom: 2px solid #3498DB;
            padding-bottom: 10px;
        }

        .theory-section h3 {
            color: #2C3E50;
            margin: 20px 0 10px;
            font-size: 1.3rem;
        }

        .theory-section p {
            color: #4a5568;
            margin-bottom: 15px;
            line-height: 1.7;
        }

        .theory-section ul {
            margin-left: 20px;
            margin-bottom: 15px;
            color: #4a5568;
        }

        .theory-section li {
            margin-bottom: 5px;
        }

        .code-example {
            background: #1a202c;
            border-radius: 14px;
            padding: 20px;
            margin: 20px 0;
            overflow-x: auto;
        }

        .code-example pre {
            margin: 0;
            color: #e2e8f0;
            font-family: 'Fira Code', 'Cascadia Code', 'JetBrains Mono', 'Courier New', monospace;
            font-size: 0.9rem;
            line-height: 1.5;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .keyword { color: #ff79c6; }
        .string { color: #f1fa8c; }
        .comment { color: #6272a4; }
        .function { color: #50fa7b; }
        .variable { color: #ffb86c; }

        .tasks-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(500px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
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
            background: linear-gradient(135deg, #2C3E50 0%, #3498DB 100%);
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.3rem;
            margin-right: 15px;
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
            flex-shrink: 0;
        }

        .task-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2d3748;
            letter-spacing: -0.01em;
            line-height: 1.3;
        }

        .task-description {
            background: #f7fafc;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 0.95rem;
            color: #4a5568;
            border-left: 4px solid #3498DB;
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
            padding: 18px;
            margin-top: 15px;
            font-size: 1rem;
            color: #22543d;
            font-weight: 500;
            display: flex;
            flex-direction: column;
            gap: 12px;
            box-shadow: 0 4px 8px rgba(72, 187, 120, 0.1);
            max-height: 350px;
            overflow-y: auto;
        }

        .result-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            width: 100%;
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

        .result-content {
            font-family: 'Fira Code', monospace;
            background: white;
            padding: 8px 16px;
            border-radius: 12px;
            color: #1e293b;
            font-weight: 500;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            word-break: break-word;
            flex: 1;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .result-content.multiline {
            white-space: pre-line;
            font-family: 'Inter', monospace;
            line-height: 1.5;
            max-height: 250px;
            overflow-y: auto;
        }

        .questions-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            margin-top: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .questions-section h2 {
            color: #2C3E50;
            margin-bottom: 20px;
            font-size: 1.8rem;
            border-bottom: 2px solid #3498DB;
            padding-bottom: 10px;
        }

        .question-item {
            background: #f7fafc;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            border-left: 4px solid #3498DB;
        }

        .question-item h3 {
            color: #2C3E50;
            margin-bottom: 10px;
            font-size: 1.2rem;
        }

        .question-item p {
            color: #4a5568;
            line-height: 1.7;
        }

        .fruit-selector {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin: 10px 0;
        }

        .fruit-btn {
            background: linear-gradient(135deg, #2C3E50 0%, #3498DB 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1rem;
            transition: transform 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .fruit-btn:hover {
            transform: scale(1.05);
        }

        .fruit-btn:active {
            transform: scale(0.95);
        }

        .login-form {
            background: white;
            border-radius: 12px;
            padding: 15px;
            margin: 10px 0;
        }

        .login-form input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
        }

        .login-form button {
            background: #38a169;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            width: 100%;
        }

        .login-form button:hover {
            background: #2f855a;
        }

        .example-output {
            background: #e2e8f0;
            border-radius: 8px;
            padding: 10px;
            margin-top: 10px;
            font-family: monospace;
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
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
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
            <h1>Практическая работа №16-17</h1>
            <p>Условный оператор и оператор варианта в языке PHP</p>
            <div class="header-sub">Цель: научиться создавать программы на PHP, используя условный оператор и оператор варианта</div>
        </div>

        <!-- ТЕОРЕТИЧЕСКИЕ СВЕДЕНИЯ -->
        <div class="theory-section">
            <h2>📚 Краткие теоретические сведения</h2>
            
            <h3>Операторы сравнения в PHP</h3>
            <p>PHP поддерживает следующие операторы сравнения:</p>
            <ul>
                <li><strong>&gt;</strong> - больше</li>
                <li><strong>&gt;=</strong> - больше или равно</li>
                <li><strong>==</strong> - равно</li>
                <li><strong>!=</strong> - не равно</li>
                <li><strong>&lt;&gt;</strong> - не равно (альтернативный)</li>
                <li><strong>&lt;</strong> - меньше</li>
                <li><strong>&lt;=</strong> - меньше или равно</li>
            </ul>

            <h3>Условный оператор if</h3>
            <p>Конструкция if позволяет выполнять определенные действия в зависимости от истинности условия:</p>
            <div class="code-example">
                <pre><span style="color: #ffb86c;">$x</span> = 21;<br><span style="color: #ffb86c;">$y</span> = 12;<br><span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$x</span> == <span style="color: #ffb86c;">$y</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Значения переменных равны"</span>;<br>} <span style="color: #50fa7b;">else</span> {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Значения переменных различны"</span>;<br>}</pre>
            </div>

            <h3>Оператор варианта switch</h3>
            <p>Оператор switch позволяет выбрать один из множества вариантов:</p>
            <div class="code-example">
                <pre><span style="color: #ffb86c;">$t</span> = <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">"H"</span>);<br><span style="color: #50fa7b;">switch</span> (<span style="color: #ffb86c;">$t</span>) {<br>    <span style="color: #50fa7b;">case</span> (<span style="color: #ffb86c;">$t</span> < 6):<br>        <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Время сна"</span>;<br>        <span style="color: #50fa7b;">break</span>;<br>    <span style="color: #50fa7b;">case</span> (<span style="color: #ffb86c;">$t</span> < 10):<br>        <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Доброе утро"</span>;<br>        <span style="color: #50fa7b;">break</span>;<br>    <span style="color: #50fa7b;">default</span>:<br>        <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Эта строчка выводится, если ни в одном из случаев условие не удовлетворено"</span>;<br>}</pre>
            </div>
        </div>

        <!-- ХОД РАБОТЫ - ЗАДАНИЯ -->
        <div class="section-title" style="grid-column: 1/-1; margin: 20px 0; color: white; font-size: 2rem; border-left: 6px solid #ffd700; padding-left: 20px;">
            🔧 Ход работы
        </div>

        <div class="tasks-grid">
            <!-- ЗАДАНИЕ 1: Выбор фруктов -->
            <?php
            $selected_fruit = isset($_GET['fruit']) ? $_GET['fruit'] : 'не выбран';
            
            $fruit_info = [
                'яблоко' => 'Яблоко - богато железом и витаминами',
                'груша' => 'Груша - содержит много клетчатки',
                'банан' => 'Банан - источник калия и энергии',
                'апельсин' => 'Апельсин - богат витамином C',
                'киви' => 'Киви - содержит витамины C и K',
                'виноград' => 'Виноград - богат антиоксидантами'
            ];
            
            $fruit_message = '';
            if ($selected_fruit != 'не выбран' && isset($fruit_info[$selected_fruit])) {
                $fruit_message = $fruit_info[$selected_fruit];
            }
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">1</span>
                    <span class="task-title">Выбор фруктов</span>
                </div>
                <div class="task-description">
                    Разработайте программу на PHP, позволяющую произвести выбор из разнообразных фруктов.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$fruits</span> = [<span style="color: #f1fa8c;">'яблоко'</span>, <span style="color: #f1fa8c;">'груша'</span>, <span style="color: #f1fa8c;">'банан'</span>, <span style="color: #f1fa8c;">'апельсин'</span>, <span style="color: #f1fa8c;">'киви'</span>, <span style="color: #f1fa8c;">'виноград'</span>];<br><span style="color: #ffb86c;">$fruit_info</span> = [<br>    <span style="color: #f1fa8c;">'яблоко'</span> => <span style="color: #f1fa8c;">'Яблоко - богато железом и витаминами'</span>,<br>    <span style="color: #f1fa8c;">'груша'</span> => <span style="color: #f1fa8c;">'Груша - содержит много клетчатки'</span>,<br>    <span style="color: #f1fa8c;">'банан'</span> => <span style="color: #f1fa8c;">'Банан - источник калия и энергии'</span>,<br>    <span style="color: #f1fa8c;">'апельсин'</span> => <span style="color: #f1fa8c;">'Апельсин - богат витамином C'</span>,<br>    <span style="color: #f1fa8c;">'киви'</span> => <span style="color: #f1fa8c;">'Киви - содержит витамины C и K'</span>,<br>    <span style="color: #f1fa8c;">'виноград'</span> => <span style="color: #f1fa8c;">'Виноград - богат антиоксидантами'</span><br>];<br><br><span style="color: #ffb86c;">$selected</span> = <span style="color: #ffb86c;">$_GET</span>[<span style="color: #f1fa8c;">'fruit'</span>] ?? <span style="color: #f1fa8c;">'не выбран'</span>;<br><br><span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$selected</span> != <span style="color: #f1fa8c;">'не выбран'</span> && <span style="color: #50fa7b;">isset</span>(<span style="color: #ffb86c;">$fruit_info</span>[<span style="color: #ffb86c;">$selected</span>])) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Вы выбрали: $selected\n"</span>;<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$fruit_info</span>[<span style="color: #ffb86c;">$selected</span>];<br>} <span style="color: #50fa7b;">else</span> {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Выберите фрукт из списка"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="fruit-selector">
                        <a href="?fruit=яблоко" class="fruit-btn">🍎 Яблоко</a>
                        <a href="?fruit=груша" class="fruit-btn">🍐 Груша</a>
                        <a href="?fruit=банан" class="fruit-btn">🍌 Банан</a>
                        <a href="?fruit=апельсин" class="fruit-btn">🍊 Апельсин</a>
                        <a href="?fruit=киви" class="fruit-btn">🥝 Киви</a>
                        <a href="?fruit=виноград" class="fruit-btn">🍇 Виноград</a>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Выбран</span>
                        <span class="result-content"><?php echo $selected_fruit; ?></span>
                    </div>
                    <?php if ($fruit_message): ?>
                    <div class="result-item">
                        <span class="result-label">Информация</span>
                        <span class="result-content"><?php echo $fruit_message; ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- ЗАДАНИЕ 2: Наибольшее из 2-х чисел -->
            <?php
            $num1 = 15;
            $num2 = 8;
            
            if ($num1 > $num2) {
                $max_num = $num1;
            } elseif ($num2 > $num1) {
                $max_num = $num2;
            } else {
                $max_num = "числа равны";
            }
            
            // Тестовые наборы
            $test_pairs = [
                [15, 8],
                [3, 12],
                [7, 7],
                [25, 13]
            ];
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">Наибольшее из 2-х чисел</span>
                </div>
                <div class="task-description">
                    Создайте web-страницу, которая выводит наибольшее из 2-х чисел.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$a</span> = 15;<br><span style="color: #ffb86c;">$b</span> = 8;<br><br><span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$a</span> > <span style="color: #ffb86c;">$b</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Большее: $a"</span>;<br>} <span style="color: #50fa7b;">elseif</span> (<span style="color: #ffb86c;">$b</span> > <span style="color: #ffb86c;">$a</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Большее: $b"</span>;<br>} <span style="color: #50fa7b;">else</span> {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Числа равны"</span>;<br>}<br><br><span style="color: #6272a4;">// Тестовые наборы</span><br><span style="color: #ffb86c;">$tests</span> = [[15,8], [3,12], [7,7], [25,13]];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$tests</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$test</span>) {<br>    <span style="color: #ffb86c;">$a</span> = <span style="color: #ffb86c;">$test</span>[0];<br>    <span style="color: #ffb86c;">$b</span> = <span style="color: #ffb86c;">$test</span>[1];<br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$a</span> > <span style="color: #ffb86c;">$b</span>) {<br>        <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"$a и $b → Большее: $a\n"</span>;<br>    } <span style="color: #50fa7b;">elseif</span> (<span style="color: #ffb86c;">$b</span> > <span style="color: #ffb86c;">$a</span>) {<br>        <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"$a и $b → Большее: $b\n"</span>;<br>    } <span style="color: #50fa7b;">else</span> {<br>        <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"$a и $b → Числа равны\n"</span>;<br>    }<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Тест 1</span>
                        <span class="result-content">Числа: <?php echo $test_pairs[0][0] . " и " . $test_pairs[0][1]; ?> → Большее: <?php echo max($test_pairs[0][0], $test_pairs[0][1]); ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Тест 2</span>
                        <span class="result-content">Числа: <?php echo $test_pairs[1][0] . " и " . $test_pairs[1][1]; ?> → Большее: <?php echo max($test_pairs[1][0], $test_pairs[1][1]); ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Тест 3</span>
                        <span class="result-content">Числа: <?php echo $test_pairs[2][0] . " и " . $test_pairs[2][1]; ?> → <?php echo ($test_pairs[2][0] == $test_pairs[2][1]) ? "Числа равны" : "Большее: " . max($test_pairs[2][0], $test_pairs[2][1]); ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Тест 4</span>
                        <span class="result-content">Числа: <?php echo $test_pairs[3][0] . " и " . $test_pairs[3][1]; ?> → Большее: <?php echo max($test_pairs[3][0], $test_pairs[3][1]); ?></span>
                    </div>
                </div>
            </div>

            <!-- ЗАДАНИЕ 3: Информация о числе -->
            <?php
            $test_numbers = [-5, 0, 12, -3, 7, 0, -10];
            
            function getNumberInfo($num) {
                if ($num > 0) {
                    return "положительное";
                } elseif ($num < 0) {
                    return "отрицательное";
                } else {
                    return "равно нулю";
                }
            }
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">3</span>
                    <span class="task-title">Информация о числе</span>
                </div>
                <div class="task-description">
                    Создайте web-страницу, которая выводит информацию о числе (положительное, отрицательное, равное 0).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$numbers</span> = [-5, 0, 12, -3, 7, 0, -10];<br><br><span style="color: #50fa7b;">function</span> getNumberInfo(<span style="color: #ffb86c;">$num</span>) {<br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$num</span> > 0) {<br>        <span style="color: #50fa7b;">return</span> <span style="color: #f1fa8c;">"положительное"</span>;<br>    } <span style="color: #50fa7b;">elseif</span> (<span style="color: #ffb86c;">$num</span> < 0) {<br>        <span style="color: #50fa7b;">return</span> <span style="color: #f1fa8c;">"отрицательное"</span>;<br>    } <span style="color: #50fa7b;">else</span> {<br>        <span style="color: #50fa7b;">return</span> <span style="color: #f1fa8c;">"равно нулю"</span>;<br>    }<br>}<br><br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$numbers</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$num</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Число $num - "</span> . getNumberInfo(<span style="color: #ffb86c;">$num</span>) . <span style="color: #f1fa8c;">"\n"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($test_numbers as $num): ?>
                    <div class="result-item">
                        <span class="result-label">Число <?php echo $num; ?></span>
                        <span class="result-content"><?php echo getNumberInfo($num); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- ЗАДАНИЕ 4: Проверка логина и пароля -->
            <?php
            $correct_login = "admin";
            $correct_password = "12345";
            
            $login_attempts = [
                ["admin", "12345"],
                ["admin", "wrong"],
                ["user", "12345"],
                ["user", "wrong"],
                ["", ""]
            ];
            
            function checkCredentials($login, $password) {
                if ($login == "admin" && $password == "12345") {
                    return "✅ Доступ разрешен";
                } else {
                    return "❌ Ошибка в логине или пароле";
                }
            }
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4</span>
                    <span class="task-title">Проверка логина и пароля</span>
                </div>
                <div class="task-description">
                    Разработайте программу на PHP, позволяющую проверить верно ли введен логин и пароль.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$correct_login</span> = <span style="color: #f1fa8c;">"admin"</span>;<br><span style="color: #ffb86c;">$correct_password</span> = <span style="color: #f1fa8c;">"12345"</span>;<br><br><span style="color: #50fa7b;">function</span> checkCredentials(<span style="color: #ffb86c;">$login</span>, <span style="color: #ffb86c;">$password</span>) {<br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$login</span> == <span style="color: #f1fa8c;">"admin"</span> && <span style="color: #ffb86c;">$password</span> == <span style="color: #f1fa8c;">"12345"</span>) {<br>        <span style="color: #50fa7b;">return</span> <span style="color: #f1fa8c;">"✅ Доступ разрешен"</span>;<br>    } <span style="color: #50fa7b;">else</span> {<br>        <span style="color: #50fa7b;">return</span> <span style="color: #f1fa8c;">"❌ Ошибка в логине или пароле"</span>;<br>    }<br>}<br><br><span style="color: #ffb86c;">$attempts</span> = [<br>    [<span style="color: #f1fa8c;">"admin"</span>, <span style="color: #f1fa8c;">"12345"</span>],<br>    [<span style="color: #f1fa8c;">"admin"</span>, <span style="color: #f1fa8c;">"wrong"</span>],<br>    [<span style="color: #f1fa8c;">"user"</span>, <span style="color: #f1fa8c;">"12345"</span>],<br>    [<span style="color: #f1fa8c;">"user"</span>, <span style="color: #f1fa8c;">"wrong"</span>],<br>    [<span style="color: #f1fa8c;">""</span>, <span style="color: #f1fa8c;">""</span>]<br>];<br><br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$attempts</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$attempt</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Логин: '{$attempt[0]}', Пароль: '{$attempt[1]}' → "</span> . checkCredentials(<span style="color: #ffb86c;">$attempt</span>[0], <span style="color: #ffb86c;">$attempt</span>[1]) . <span style="color: #f1fa8c;">"\n"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="login-form">
                        <form method="POST">
                            <input type="text" name="login" placeholder="Логин (admin)" value="admin">
                            <input type="password" name="password" placeholder="Пароль (12345)" value="12345">
                            <button type="submit">Проверить</button>
                        </form>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $input_login = $_POST['login'] ?? '';
                            $input_password = $_POST['password'] ?? '';
                            echo "<div class='example-output'>" . checkCredentials($input_login, $input_password) . "</div>";
                        }
                        ?>
                    </div>
                    
                    <div style="margin-top: 10px; font-size: 0.9rem; color: #4a5568;">
                        <strong>Тестовые наборы:</strong>
                    </div>
                    <?php foreach ($login_attempts as $attempt): ?>
                    <div class="result-item">
                        <span class="result-label">Логин: "<?php echo $attempt[0]; ?>"<br>Пароль: "<?php echo $attempt[1]; ?>"</span>
                        <span class="result-content"><?php echo checkCredentials($attempt[0], $attempt[1]); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- КОНТРОЛЬНЫЕ ВОПРОСЫ -->
        <div class="questions-section">
            <h2>📝 Контрольные вопросы</h2>
            
            <div class="question-item">
                <h3>1. Что такое оператор в языках программирования?</h3>
                <p><strong>Ответ:</strong> Оператор в языках программирования - это специальный символ или конструкция языка, которая позволяет выполнять определенные действия над данными (операндами). Операторы могут быть арифметическими (+, -, *, /), логическими (&&, ||, !), сравнения (==, !=, <, >) и другими. Они являются базовыми элементами для построения выражений и управления потоком выполнения программы.</p>
            </div>
            
            <div class="question-item">
                <h3>2. Какие операторы вам известны в PHP?</h3>
                <p><strong>Ответ:</strong> В PHP существуют следующие группы операторов:</p>
                <ul>
                    <li><strong>Арифметические:</strong> +, -, *, /, % (остаток от деления)</li>
                    <li><strong>Сравнения:</strong> ==, === (строгое равенство), !=, !==, <, >, <=, >=, <=> (космический корабль)</li>
                    <li><strong>Логические:</strong> && (AND), || (OR), ! (NOT), and, or, xor</li>
                    <li><strong>Присваивания:</strong> =, +=, -=, *=, /=, .= (для строк)</li>
                    <li><strong>Инкремента/декремента:</strong> ++, --</li>
                    <li><strong>Строковые:</strong> . (конкатенация)</li>
                    <li><strong>Массивов:</strong> + (объединение), ==, ===, !=, !==</li>
                </ul>
            </div>
            
            <div class="question-item">
                <h3>3. Что собой представляет условный оператор?</h3>
                <p><strong>Ответ:</strong> Условный оператор (if) - это конструкция языка программирования, которая позволяет выполнять определенный блок кода только при выполнении заданного условия. Он реализует алгоритмическую конструкцию "ветвление". В PHP условный оператор может иметь следующие формы:</p>
                <ul>
                    <li><strong>if (условие) { ... }</strong> - выполняется, если условие истинно</li>
                    <li><strong>if (условие) { ... } else { ... }</strong> - выполняется один блок, если условие истинно, другой - если ложно</li>
                    <li><strong>if (условие) { ... } elseif (условие) { ... } else { ... }</strong> - множественное ветвление</li>
                </ul>
            </div>
            
            <div class="question-item">
                <h3>4. Что собой представляет оператор варианта?</h3>
                <p><strong>Ответ:</strong> Оператор варианта (switch) - это конструкция языка программирования, которая позволяет выбрать один из нескольких вариантов выполнения на основе значения выражения. Он удобен когда нужно сравнить одну переменную с множеством различных значений. Оператор switch состоит из:</p>
                <ul>
                    <li>Выражения в скобках после switch</li>
                    <li>Блоков case с конкретными значениями</li>
                    <li>Оператора break для выхода из конструкции</li>
                    <li>Необязательного блока default для случая, когда ни одно значение не подошло</li>
                </ul>
            </div>
            
            <div class="question-item">
                <h3>5. Конструкции в PHP для описания оператора варианта и условного оператора?</h3>
                <p><strong>Ответ:</strong> В PHP используются следующие конструкции:</p>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 15px;">
                    <div style="background: #1a202c; border-radius: 10px; padding: 15px;">
                        <h4 style="color: #50fa7b; margin-bottom: 10px;">Условный оператор if</h4>
                        <pre style="color: #e2e8f0; font-size: 0.85rem; white-space: pre-wrap;">
<span style="color: #ff79c6;">if</span> (<span style="color: #ffb86c;">$a</span> > <span style="color: #ffb86c;">$b</span>) {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a больше b"</span>;
} <span style="color: #ff79c6;">elseif</span> (<span style="color: #ffb86c;">$a</span> == <span style="color: #ffb86c;">$b</span>) {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a равно b"</span>;
} <span style="color: #ff79c6;">else</span> {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a меньше b"</span>;
}</pre>
                    </div>
                    <div style="background: #1a202c; border-radius: 10px; padding: 15px;">
                        <h4 style="color: #50fa7b; margin-bottom: 10px;">Оператор варианта switch</h4>
                        <pre style="color: #e2e8f0; font-size: 0.85rem; white-space: pre-wrap;">
<span style="color: #ff79c6;">switch</span> (<span style="color: #ffb86c;">$day</span>) {
    <span style="color: #ff79c6;">case</span> 1:
        <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Понедельник"</span>;
        <span style="color: #ff79c6;">break</span>;
    <span style="color: #ff79c6;">case</span> 2:
        <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Вторник"</span>;
        <span style="color: #ff79c6;">break</span>;
    <span style="color: #ff79c6;">default</span>:
        <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Другой день"</span>;
}</pre>
                    </div>
                </div>
            </div>
        </div>

        <!-- ДОПОЛНИТЕЛЬНЫЕ ПРИМЕРЫ -->
        <div class="section-title" style="grid-column: 1/-1; margin: 40px 0 20px; color: white; font-size: 2rem; border-left: 6px solid #ffd700; padding-left: 20px;">
            🔍 Дополнительные примеры
        </div>

        <div class="tasks-grid">
            <!-- Пример с оператором сравнения -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">📊</span>
                    <span class="task-title">Таблица операторов сравнения</span>
                </div>
                <div class="task-description">
                    Демонстрация работы различных операторов сравнения в PHP.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$a</span> = 5;<br><span style="color: #ffb86c;">$b</span> = <span style="color: #f1fa8c;">"5"</span>;<br><br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"5 == \"5\": "</span>;<br><span style="color: #50fa7b;">var_dump</span>(5 == <span style="color: #f1fa8c;">"5"</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"\n5 === \"5\": "</span>;<br><span style="color: #50fa7b;">var_dump</span>(5 === <span style="color: #f1fa8c;">"5"</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"\n5 != \"5\": "</span>;<br><span style="color: #50fa7b;">var_dump</span>(5 != <span style="color: #f1fa8c;">"5"</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"\n5 !== \"5\": "</span>;<br><span style="color: #50fa7b;">var_dump</span>(5 !== <span style="color: #f1fa8c;">"5"</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">5 == "5"</span>
                        <span class="result-content"><?php var_dump(5 == "5"); ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">5 === "5"</span>
                        <span class="result-content"><?php var_dump(5 === "5"); ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">5 != "5"</span>
                        <span class="result-content"><?php var_dump(5 != "5"); ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">5 !== "5"</span>
                        <span class="result-content"><?php var_dump(5 !== "5"); ?></span>
                    </div>
                </div>
            </div>

            <!-- Пример с тернарным оператором -->
            <?php
            $ages = [15, 18, 25, 17, 21];
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">❓</span>
                    <span class="task-title">Тернарный оператор</span>
                </div>
                <div class="task-description">
                    Краткая форма условного оператора: условие ? значение1 : значение2
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$ages</span> = [15, 18, 25, 17, 21];<br><br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$ages</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$age</span>) {<br>    <span style="color: #ffb86c;">$status</span> = (<span style="color: #ffb86c;">$age</span> >= 18) ? <span style="color: #f1fa8c;">"совершеннолетний"</span> : <span style="color: #f1fa8c;">"несовершеннолетний"</span>;<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Возраст $age - $status\n"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($ages as $age):
                        $status = ($age >= 18) ? "совершеннолетний" : "несовершеннолетний";
                    ?>
                    <div class="result-item">
                        <span class="result-label">Возраст <?php echo $age; ?></span>
                        <span class="result-content"><?php echo $status; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Пример с switch -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">🔄</span>
                    <span class="task-title">Оператор switch для дней недели</span>
                </div>
                <div class="task-description">
                    Определение дня недели по номеру с помощью switch.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$d</span> = 1; <span style="color: #ffb86c;">$d</span> <= 7; <span style="color: #ffb86c;">$d</span>++) {<br>    <span style="color: #50fa7b;">switch</span> (<span style="color: #ffb86c;">$d</span>) {<br>        <span style="color: #50fa7b;">case</span> 1: <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"День 1 - Понедельник\n"</span>; <span style="color: #50fa7b;">break</span>;<br>        <span style="color: #50fa7b;">case</span> 2: <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"День 2 - Вторник\n"</span>; <span style="color: #50fa7b;">break</span>;<br>        <span style="color: #50fa7b;">case</span> 3: <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"День 3 - Среда\n"</span>; <span style="color: #50fa7b;">break</span>;<br>        <span style="color: #50fa7b;">case</span> 4: <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"День 4 - Четверг\n"</span>; <span style="color: #50fa7b;">break</span>;<br>        <span style="color: #50fa7b;">case</span> 5: <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"День 5 - Пятница\n"</span>; <span style="color: #50fa7b;">break</span>;<br>        <span style="color: #50fa7b;">case</span> 6: <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"День 6 - Суббота\n"</span>; <span style="color: #50fa7b;">break</span>;<br>        <span style="color: #50fa7b;">case</span> 7: <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"День 7 - Воскресенье\n"</span>; <span style="color: #50fa7b;">break</span>;<br>    }<br>}</pre>
                </div>
                <div class="task-result">
                    <?php
                    for ($d = 1; $d <= 7; $d++):
                        switch ($d) {
                            case 1: $day_name = "Понедельник"; break;
                            case 2: $day_name = "Вторник"; break;
                            case 3: $day_name = "Среда"; break;
                            case 4: $day_name = "Четверг"; break;
                            case 5: $day_name = "Пятница"; break;
                            case 6: $day_name = "Суббота"; break;
                            case 7: $day_name = "Воскресенье"; break;
                            default: $day_name = "Неизвестный день";
                        }
                    ?>
                    <div class="result-item">
                        <span class="result-label">День <?php echo $d; ?></span>
                        <span class="result-content"><?php echo $day_name; ?></span>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>