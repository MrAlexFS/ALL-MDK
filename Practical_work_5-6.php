<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Практическая работа 5-6: Условные операторы в PHP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #8e44ad 0%, #6a1b9a 100%);
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
            background: linear-gradient(135deg, #ffffff 0%, #f3e5f5 100%);
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
            background: linear-gradient(135deg, #8e44ad 0%, #6a1b9a 100%);
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
            box-shadow: 0 4px 10px rgba(142, 68, 173, 0.3);
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
            border-left: 4px solid #8e44ad;
            font-family: 'Inter', sans-serif;
            line-height: 1.5;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
        }

        /* Код решения с прокруткой */
        .task-solution {
            background: #1a202c;
            border-radius: 14px;
            padding: 18px;
            margin: 15px 0;
            overflow-x: auto;
            overflow-y: auto;
            flex-grow: 1;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            max-height: 300px;
        }

        .task-solution pre {
            margin: 0;
            color: #e2e8f0;
            font-family: 'Fira Code', 'Cascadia Code', 'JetBrains Mono', 'Courier New', monospace;
            font-size: 0.85rem;
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
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
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
            <h1>Практическая работа 5-6</h1>
            <p>Условные операторы: if-else, switch-case, логические операции</p>
        </div>

        <div class="tasks-grid">
            <!-- IF-ELSE -->
            <div class="section-title">🔀 Работа с if-else</div>

            <!-- Задача 1 -->
            <?php
            $values1 = [1, 0, -3];
            $results1 = [];
            foreach ($values1 as $val) {
                $results1[] = ($val == 0) ? 'Верно' : 'Неверно';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">1</span>
                    <span class="task-title">Равенство нулю</span>
                </div>
                <div class="task-description">
                    Если переменная $a равна нулю, то выведите 'Верно', иначе выведите 'Неверно'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$values</span> = [1, 0, -3];<br><span style="color: #ffb86c;">$results</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$values</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$val</span>) {<br>    <span style="color: #ffb86c;">$results</span>[] = (<span style="color: #ffb86c;">$val</span> == 0) ? <span style="color: #f1fa8c;">'Верно'</span> : <span style="color: #f1fa8c;">'Неверно'</span>;<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a=1: </span><span style="color: #ffb86c;">{$results[0]}</span><span style="color: #f1fa8c;">\na=0: </span><span style="color: #ffb86c;">{$results[1]}</span><span style="color: #f1fa8c;">\na=-3: </span><span style="color: #ffb86c;">{$results[2]}</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "a=1: {$results1[0]}\na=0: {$results1[1]}\na=-3: {$results1[2]}"; 
                    ?></span>
                </div>
            </div>

            <!-- Задача 2 -->
            <?php
            $values2 = [1, 0, -3];
            $results2 = [];
            foreach ($values2 as $val) {
                $results2[] = ($val > 0) ? 'Верно' : 'Неверно';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">Больше нуля</span>
                </div>
                <div class="task-description">
                    Если переменная $a больше нуля, то выведите 'Верно', иначе выведите 'Неверно'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$values</span> = [1, 0, -3];<br><span style="color: #ffb86c;">$results</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$values</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$val</span>) {<br>    <span style="color: #ffb86c;">$results</span>[] = (<span style="color: #ffb86c;">$val</span> > 0) ? <span style="color: #f1fa8c;">'Верно'</span> : <span style="color: #f1fa8c;">'Неверно'</span>;<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a=1: </span><span style="color: #ffb86c;">{$results[0]}</span><span style="color: #f1fa8c;">\na=0: </span><span style="color: #ffb86c;">{$results[1]}</span><span style="color: #f1fa8c;">\na=-3: </span><span style="color: #ffb86c;">{$results[2]}</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "a=1: {$results2[0]}\na=0: {$results2[1]}\na=-3: {$results2[2]}"; 
                    ?></span>
                </div>
            </div>

            <!-- Задача 3 -->
            <?php
            $values3 = [1, 0, -3];
            $results3 = [];
            foreach ($values3 as $val) {
                $results3[] = ($val < 0) ? 'Верно' : 'Неверно';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">3</span>
                    <span class="task-title">Меньше нуля</span>
                </div>
                <div class="task-description">
                    Если переменная $a меньше нуля, то выведите 'Верно', иначе выведите 'Неверно'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$values</span> = [1, 0, -3];<br><span style="color: #ffb86c;">$results</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$values</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$val</span>) {<br>    <span style="color: #ffb86c;">$results</span>[] = (<span style="color: #ffb86c;">$val</span> < 0) ? <span style="color: #f1fa8c;">'Верно'</span> : <span style="color: #f1fa8c;">'Неверно'</span>;<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a=1: </span><span style="color: #ffb86c;">{$results[0]}</span><span style="color: #f1fa8c;">\na=0: </span><span style="color: #ffb86c;">{$results[1]}</span><span style="color: #f1fa8c;">\na=-3: </span><span style="color: #ffb86c;">{$results[2]}</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "a=1: {$results3[0]}\na=0: {$results3[1]}\na=-3: {$results3[2]}"; 
                    ?></span>
                </div>
            </div>

            <!-- Задача 4 -->
            <?php
            $values4 = [1, 0, -3];
            $results4 = [];
            foreach ($values4 as $val) {
                $results4[] = ($val >= 0) ? 'Верно' : 'Неверно';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4</span>
                    <span class="task-title">Больше или равно нулю</span>
                </div>
                <div class="task-description">
                    Если переменная $a больше или равна нулю, то выведите 'Верно', иначе выведите 'Неверно'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$values</span> = [1, 0, -3];<br><span style="color: #ffb86c;">$results</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$values</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$val</span>) {<br>    <span style="color: #ffb86c;">$results</span>[] = (<span style="color: #ffb86c;">$val</span> >= 0) ? <span style="color: #f1fa8c;">'Верно'</span> : <span style="color: #f1fa8c;">'Неверно'</span>;<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a=1: </span><span style="color: #ffb86c;">{$results[0]}</span><span style="color: #f1fa8c;">\na=0: </span><span style="color: #ffb86c;">{$results[1]}</span><span style="color: #f1fa8c;">\na=-3: </span><span style="color: #ffb86c;">{$results[2]}</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "a=1: {$results4[0]}\na=0: {$results4[1]}\na=-3: {$results4[2]}"; 
                    ?></span>
                </div>
            </div>

            <!-- Задача 5 -->
            <?php
            $values5 = [1, 0, -3];
            $results5 = [];
            foreach ($values5 as $val) {
                $results5[] = ($val <= 0) ? 'Верно' : 'Неверно';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">5</span>
                    <span class="task-title">Меньше или равно нулю</span>
                </div>
                <div class="task-description">
                    Если переменная $a меньше или равна нулю, то выведите 'Верно', иначе выведите 'Неверно'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$values</span> = [1, 0, -3];<br><span style="color: #ffb86c;">$results</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$values</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$val</span>) {<br>    <span style="color: #ffb86c;">$results</span>[] = (<span style="color: #ffb86c;">$val</span> <= 0) ? <span style="color: #f1fa8c;">'Верно'</span> : <span style="color: #f1fa8c;">'Неверно'</span>;<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a=1: </span><span style="color: #ffb86c;">{$results[0]}</span><span style="color: #f1fa8c;">\na=0: </span><span style="color: #ffb86c;">{$results[1]}</span><span style="color: #f1fa8c;">\na=-3: </span><span style="color: #ffb86c;">{$results[2]}</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "a=1: {$results5[0]}\na=0: {$results5[1]}\na=-3: {$results5[2]}"; 
                    ?></span>
                </div>
            </div>

            <!-- Задача 6 -->
            <?php
            $values6 = [1, 0, -3];
            $results6 = [];
            foreach ($values6 as $val) {
                $results6[] = ($val != 0) ? 'Верно' : 'Неверно';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">6</span>
                    <span class="task-title">Не равно нулю</span>
                </div>
                <div class="task-description">
                    Если переменная $a не равна нулю, то выведите 'Верно', иначе выведите 'Неверно'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$values</span> = [1, 0, -3];<br><span style="color: #ffb86c;">$results</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$values</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$val</span>) {<br>    <span style="color: #ffb86c;">$results</span>[] = (<span style="color: #ffb86c;">$val</span> != 0) ? <span style="color: #f1fa8c;">'Верно'</span> : <span style="color: #f1fa8c;">'Неверно'</span>;<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a=1: </span><span style="color: #ffb86c;">{$results[0]}</span><span style="color: #f1fa8c;">\na=0: </span><span style="color: #ffb86c;">{$results[1]}</span><span style="color: #f1fa8c;">\na=-3: </span><span style="color: #ffb86c;">{$results[2]}</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "a=1: {$results6[0]}\na=0: {$results6[1]}\na=-3: {$results6[2]}"; 
                    ?></span>
                </div>
            </div>

            <!-- Задача 7 -->
            <?php
            $values7 = ['test', 'тест', 3];
            $results7 = [];
            foreach ($values7 as $val) {
                $results7[] = ($val == 'test') ? 'Верно' : 'Неверно';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">7</span>
                    <span class="task-title">Строковое сравнение</span>
                </div>
                <div class="task-description">
                    Если переменная $a равна 'test', то выведите 'Верно', иначе выведите 'Неверно'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$values</span> = [<span style="color: #f1fa8c;">'test'</span>, <span style="color: #f1fa8c;">'тест'</span>, 3];<br><span style="color: #ffb86c;">$results</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$values</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$val</span>) {<br>    <span style="color: #ffb86c;">$results</span>[] = (<span style="color: #ffb86c;">$val</span> == <span style="color: #f1fa8c;">'test'</span>) ? <span style="color: #f1fa8c;">'Верно'</span> : <span style="color: #f1fa8c;">'Неверно'</span>;<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a='test': </span><span style="color: #ffb86c;">{$results[0]}</span><span style="color: #f1fa8c;">\na='тест': </span><span style="color: #ffb86c;">{$results[1]}</span><span style="color: #f1fa8c;">\na=3: </span><span style="color: #ffb86c;">{$results[2]}</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "a='test': {$results7[0]}\na='тест': {$results7[1]}\na=3: {$results7[2]}"; 
                    ?></span>
                </div>
            </div>

            <!-- Задача 8 -->
            <?php
            $values8 = ['1', 1, 3];
            $results8 = [];
            foreach ($values8 as $val) {
                $results8[] = ($val === '1') ? 'Верно' : 'Неверно';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">8</span>
                    <span class="task-title">Строгое равенство</span>
                </div>
                <div class="task-description">
                    Если переменная $a равна '1' и по значению и по типу, то выведите 'Верно', иначе выведите 'Неверно'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$values</span> = [<span style="color: #f1fa8c;">'1'</span>, 1, 3];<br><span style="color: #ffb86c;">$results</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$values</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$val</span>) {<br>    <span style="color: #ffb86c;">$results</span>[] = (<span style="color: #ffb86c;">$val</span> === <span style="color: #f1fa8c;">'1'</span>) ? <span style="color: #f1fa8c;">'Верно'</span> : <span style="color: #f1fa8c;">'Неверно'</span>;<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a='1': </span><span style="color: #ffb86c;">{$results[0]}</span><span style="color: #f1fa8c;">\na=1: </span><span style="color: #ffb86c;">{$results[1]}</span><span style="color: #f1fa8c;">\na=3: </span><span style="color: #ffb86c;">{$results[2]}</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "a='1': {$results8[0]}\na=1: {$results8[1]}\na=3: {$results8[2]}"; 
                    ?></span>
                </div>
            </div>

            <!-- EMPTY и ISSET -->
            <div class="section-title">🔍 Работа с empty и isset</div>

            <!-- Задача 9 -->
            <?php
            $values9 = [1, 3, -3, 0, null, true, '', '0'];
            $results9 = [];
            foreach ($values9 as $val) {
                $results9[] = empty($val) ? 'Верно' : 'Неверно';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">9</span>
                    <span class="task-title">Проверка на пустоту</span>
                </div>
                <div class="task-description">
                    Если переменная $a пустая, то выведите 'Верно', иначе выведите 'Неверно'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$values</span> = [1, 3, -3, 0, null, true, <span style="color: #f1fa8c;">''</span>, <span style="color: #f1fa8c;">'0'</span>];<br><span style="color: #ffb86c;">$results</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$values</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$val</span>) {<br>    <span style="color: #ffb86c;">$results</span>[] = <span style="color: #50fa7b;">empty</span>(<span style="color: #ffb86c;">$val</span>) ? <span style="color: #f1fa8c;">'Верно'</span> : <span style="color: #f1fa8c;">'Неверно'</span>;<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a=1: </span><span style="color: #ffb86c;">{$results[0]}</span><span style="color: #f1fa8c;">, a=3: </span><span style="color: #ffb86c;">{$results[1]}</span><span style="color: #f1fa8c;">, a=-3: </span><span style="color: #ffb86c;">{$results[2]}</span><span style="color: #f1fa8c;">, a=0: </span><span style="color: #ffb86c;">{$results[3]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a=null: </span><span style="color: #ffb86c;">{$results[4]}</span><span style="color: #f1fa8c;">, a=true: </span><span style="color: #ffb86c;">{$results[5]}</span><span style="color: #f1fa8c;">, a='': </span><span style="color: #ffb86c;">{$results[6]}</span><span style="color: #f1fa8c;">, a='0': </span><span style="color: #ffb86c;">{$results[7]}</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "a=1: {$results9[0]}, a=3: {$results9[1]}, a=-3: {$results9[2]}, a=0: {$results9[3]}\n";
                        echo "a=null: {$results9[4]}, a=true: {$results9[5]}, a='': {$results9[6]}, a='0': {$results9[7]}";
                    ?></span>
                </div>
            </div>

            <!-- Задача 10 -->
            <?php
            $values10 = [1, 3, -3, 0, null, true, '', '0'];
            $results10 = [];
            foreach ($values10 as $val) {
                $results10[] = !empty($val) ? 'Верно' : 'Неверно';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">10</span>
                    <span class="task-title">Не пустая</span>
                </div>
                <div class="task-description">
                    Если переменная $a НЕ пустая, то выведите 'Верно', иначе выведите 'Неверно'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$values</span> = [1, 3, -3, 0, null, true, <span style="color: #f1fa8c;">''</span>, <span style="color: #f1fa8c;">'0'</span>];<br><span style="color: #ffb86c;">$results</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$values</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$val</span>) {<br>    <span style="color: #ffb86c;">$results</span>[] = !<span style="color: #50fa7b;">empty</span>(<span style="color: #ffb86c;">$val</span>) ? <span style="color: #f1fa8c;">'Верно'</span> : <span style="color: #f1fa8c;">'Неверно'</span>;<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a=1: </span><span style="color: #ffb86c;">{$results[0]}</span><span style="color: #f1fa8c;">, a=3: </span><span style="color: #ffb86c;">{$results[1]}</span><span style="color: #f1fa8c;">, a=-3: </span><span style="color: #ffb86c;">{$results[2]}</span><span style="color: #f1fa8c;">, a=0: </span><span style="color: #ffb86c;">{$results[3]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a=null: </span><span style="color: #ffb86c;">{$results[4]}</span><span style="color: #f1fa8c;">, a=true: </span><span style="color: #ffb86c;">{$results[5]}</span><span style="color: #f1fa8c;">, a='': </span><span style="color: #ffb86c;">{$results[6]}</span><span style="color: #f1fa8c;">, a='0': </span><span style="color: #ffb86c;">{$results[7]}</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "a=1: {$results10[0]}, a=3: {$results10[1]}, a=-3: {$results10[2]}, a=0: {$results10[3]}\n";
                        echo "a=null: {$results10[4]}, a=true: {$results10[5]}, a='': {$results10[6]}, a='0': {$results10[7]}";
                    ?></span>
                </div>
            </div>

            <!-- Задача 11 -->
            <?php
            $a11_1 = 3;
            $a11_2 = null;
            $result11_1 = isset($a11_1) ? 'Верно' : 'Неверно';
            $result11_2 = isset($a11_2) ? 'Верно' : 'Неверно';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">11</span>
                    <span class="task-title">Проверка существования</span>
                </div>
                <div class="task-description">
                    Если переменная $a существует, то выведите 'Верно', иначе выведите 'Неверно'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$a1</span> = 3;<br><span style="color: #ffb86c;">$a2</span> = null;<br><span style="color: #ffb86c;">$result1</span> = <span style="color: #50fa7b;">isset</span>(<span style="color: #ffb86c;">$a1</span>) ? <span style="color: #f1fa8c;">'Верно'</span> : <span style="color: #f1fa8c;">'Неверно'</span>;<br><span style="color: #ffb86c;">$result2</span> = <span style="color: #50fa7b;">isset</span>(<span style="color: #ffb86c;">$a2</span>) ? <span style="color: #f1fa8c;">'Верно'</span> : <span style="color: #f1fa8c;">'Неверно'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a=3: </span><span style="color: #ffb86c;">$result1</span><span style="color: #f1fa8c;">\na=null: </span><span style="color: #ffb86c;">$result2</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "a=3: {$result11_1}\na=null: {$result11_2}"; 
                    ?></span>
                </div>
            </div>

            <!-- Задача 12 -->
            <?php
            $result12_1 = !isset($a12_1) ? 'Верно' : 'Неверно'; // $a12_1 не существует
            $a12_2 = 5;
            $result12_2 = !isset($a12_2) ? 'Верно' : 'Неверно';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">12</span>
                    <span class="task-title">Не существует</span>
                </div>
                <div class="task-description">
                    Если переменная $a НЕ существует, то выведите 'Верно', иначе выведите 'Неверно'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #6272a4;">// Переменная $a1 не существует</span><br><span style="color: #ffb86c;">$result1</span> = !<span style="color: #50fa7b;">isset</span>(<span style="color: #ffb86c;">$a1</span>) ? <span style="color: #f1fa8c;">'Верно'</span> : <span style="color: #f1fa8c;">'Неверно'</span>;<br><br><span style="color: #ffb86c;">$a2</span> = 5;<br><span style="color: #ffb86c;">$result2</span> = !<span style="color: #50fa7b;">isset</span>(<span style="color: #ffb86c;">$a2</span>) ? <span style="color: #f1fa8c;">'Верно'</span> : <span style="color: #f1fa8c;">'Неверно'</span>;<br><br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a не существует: </span><span style="color: #ffb86c;">$result1</span><span style="color: #f1fa8c;">\na=5: </span><span style="color: #ffb86c;">$result2</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "a не существует: {$result12_1}\na=5: {$result12_2}"; 
                    ?></span>
                </div>
            </div>

            <!-- ЛОГИЧЕСКИЕ ПЕРЕМЕННЫЕ -->
            <div class="section-title">🎯 Работа с логическими переменными</div>

            <!-- Задача 13 -->
            <?php
            $var13_true = true;
            $var13_false = false;
            
            // Длинная запись
            $long_true = $var13_true ? 'Верно' : 'Неверно';
            $long_false = $var13_false ? 'Верно' : 'Неверно';
            
            // Короткая запись
            $short_true = ($var13_true == true) ? 'Верно' : 'Неверно';
            $short_false = ($var13_false == true) ? 'Верно' : 'Неверно';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">13</span>
                    <span class="task-title">Проверка true</span>
                </div>
                <div class="task-description">
                    Если переменная $var равна true, то выведите 'Верно', иначе 'Неверно'. Длинная и короткая запись.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$var_true</span> = true;<br><span style="color: #ffb86c;">$var_false</span> = false;<br><br><span style="color: #6272a4;">// Длинная запись</span><br><span style="color: #ffb86c;">$long_true</span> = (<span style="color: #ffb86c;">$var_true</span> == true) ? <span style="color: #f1fa8c;">'Верно'</span> : <span style="color: #f1fa8c;">'Неверно'</span>;<br><span style="color: #ffb86c;">$long_false</span> = (<span style="color: #ffb86c;">$var_false</span> == true) ? <span style="color: #f1fa8c;">'Верно'</span> : <span style="color: #f1fa8c;">'Неверно'</span>;<br><br><span style="color: #6272a4;">// Короткая запись</span><br><span style="color: #ffb86c;">$short_true</span> = <span style="color: #ffb86c;">$var_true</span> ? <span style="color: #f1fa8c;">'Верно'</span> : <span style="color: #f1fa8c;">'Неверно'</span>;<br><span style="color: #ffb86c;">$short_false</span> = <span style="color: #ffb86c;">$var_false</span> ? <span style="color: #f1fa8c;">'Верно'</span> : <span style="color: #f1fa8c;">'Неверно'</span>;<br><br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Длинная запись:\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"var=true: </span><span style="color: #ffb86c;">$long_true</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"var=false: </span><span style="color: #ffb86c;">$long_false</span><span style="color: #f1fa8c;">\n\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Короткая запись:\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"var=true: </span><span style="color: #ffb86c;">$short_true</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"var=false: </span><span style="color: #ffb86c;">$short_false</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "Длинная запись:\n";
                        echo "var=true: {$long_true}\n";
                        echo "var=false: {$long_false}\n\n";
                        echo "Короткая запись:\n";
                        echo "var=true: {$short_true}\n";
                        echo "var=false: {$short_false}";
                    ?></span>
                </div>
            </div>

            <!-- Задача 14 -->
            <?php
            $var14_true = true;
            $var14_false = false;
            
            // Длинная запись
            $long_true14 = ($var14_true != true) ? 'Верно' : 'Неверно';
            $long_false14 = ($var14_false != true) ? 'Верно' : 'Неверно';
            
            // Короткая запись
            $short_true14 = (!$var14_true) ? 'Верно' : 'Неверно';
            $short_false14 = (!$var14_false) ? 'Верно' : 'Неверно';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">14</span>
                    <span class="task-title">Не равно true</span>
                </div>
                <div class="task-description">
                    Если переменная $var НЕ равна true, то выведите 'Верно', иначе 'Неверно'. Длинная и короткая запись.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$var_true</span> = true;<br><span style="color: #ffb86c;">$var_false</span> = false;<br><br><span style="color: #6272a4;">// Длинная запись</span><br><span style="color: #ffb86c;">$long_true</span> = (<span style="color: #ffb86c;">$var_true</span> != true) ? <span style="color: #f1fa8c;">'Верно'</span> : <span style="color: #f1fa8c;">'Неверно'</span>;<br><span style="color: #ffb86c;">$long_false</span> = (<span style="color: #ffb86c;">$var_false</span> != true) ? <span style="color: #f1fa8c;">'Верно'</span> : <span style="color: #f1fa8c;">'Неверно'</span>;<br><br><span style="color: #6272a4;">// Короткая запись</span><br><span style="color: #ffb86c;">$short_true</span> = !<span style="color: #ffb86c;">$var_true</span> ? <span style="color: #f1fa8c;">'Верно'</span> : <span style="color: #f1fa8c;">'Неверно'</span>;<br><span style="color: #ffb86c;">$short_false</span> = !<span style="color: #ffb86c;">$var_false</span> ? <span style="color: #f1fa8c;">'Верно'</span> : <span style="color: #f1fa8c;">'Неверно'</span>;<br><br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Длинная запись:\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"var=true: </span><span style="color: #ffb86c;">$long_true</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"var=false: </span><span style="color: #ffb86c;">$long_false</span><span style="color: #f1fa8c;">\n\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Короткая запись:\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"var=true: </span><span style="color: #ffb86c;">$short_true</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"var=false: </span><span style="color: #ffb86c;">$short_false</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "Длинная запись:\n";
                        echo "var=true: {$long_true14}\n";
                        echo "var=false: {$long_false14}\n\n";
                        echo "Короткая запись:\n";
                        echo "var=true: {$short_true14}\n";
                        echo "var=false: {$short_false14}";
                    ?></span>
                </div>
            </div>

            <!-- OR и AND -->
            <div class="section-title">🔗 Работа с OR и AND</div>

            <!-- Задача 15 -->
            <?php
            $values15 = [5, 0, -3, 2];
            $results15 = [];
            foreach ($values15 as $val) {
                $results15[] = ($val > 0 && $val < 5) ? 'Верно' : 'Неверно';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">15</span>
                    <span class="task-title">Диапазон (AND)</span>
                </div>
                <div class="task-description">
                    Если $a больше 0 и меньше 5, то 'Верно', иначе 'Неверно'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$values</span> = [5, 0, -3, 2];<br><span style="color: #ffb86c;">$results</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$values</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$val</span>) {<br>    <span style="color: #ffb86c;">$results</span>[] = (<span style="color: #ffb86c;">$val</span> > 0 && <span style="color: #ffb86c;">$val</span> < 5) ? <span style="color: #f1fa8c;">'Верно'</span> : <span style="color: #f1fa8c;">'Неверно'</span>;<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a=5: </span><span style="color: #ffb86c;">{$results[0]}</span><span style="color: #f1fa8c;">\na=0: </span><span style="color: #ffb86c;">{$results[1]}</span><span style="color: #f1fa8c;">\na=-3: </span><span style="color: #ffb86c;">{$results[2]}</span><span style="color: #f1fa8c;">\na=2: </span><span style="color: #ffb86c;">{$results[3]}</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "a=5: {$results15[0]}\na=0: {$results15[1]}\na=-3: {$results15[2]}\na=2: {$results15[3]}"; 
                    ?></span>
                </div>
            </div>

            <!-- Задача 16 -->
            <?php
            $values16 = [5, 0, -3, 2];
            $results16 = [];
            foreach ($values16 as $val) {
                if ($val == 0 || $val == 2) {
                    $results16[] = $val + 7;
                } else {
                    $results16[] = $val / 10;
                }
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">16</span>
                    <span class="task-title">OR оператор</span>
                </div>
                <div class="task-description">
                    Если $a равна 0 или 2, прибавьте 7, иначе поделите на 10.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$values</span> = [5, 0, -3, 2];<br><span style="color: #ffb86c;">$results</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$values</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$val</span>) {<br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$val</span> == 0 || <span style="color: #ffb86c;">$val</span> == 2) {<br>        <span style="color: #ffb86c;">$results</span>[] = <span style="color: #ffb86c;">$val</span> + 7;<br>    } <span style="color: #50fa7b;">else</span> {<br>        <span style="color: #ffb86c;">$results</span>[] = <span style="color: #ffb86c;">$val</span> / 10;<br>    }<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a=5 → </span><span style="color: #ffb86c;">{$results[0]}</span><span style="color: #f1fa8c;">\na=0 → </span><span style="color: #ffb86c;">{$results[1]}</span><span style="color: #f1fa8c;">\na=-3 → </span><span style="color: #ffb86c;">{$results[2]}</span><span style="color: #f1fa8c;">\na=2 → </span><span style="color: #ffb86c;">{$results[3]}</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "a=5 → {$results16[0]}\na=0 → {$results16[1]}\na=-3 → {$results16[2]}\na=2 → {$results16[3]}"; 
                    ?></span>
                </div>
            </div>

            <!-- Задача 17 -->
            <?php
            $pairs17 = [
                [1, 3],
                [0, 6],
                [3, 5]
            ];
            $results17 = [];
            foreach ($pairs17 as $pair) {
                $a = $pair[0];
                $b = $pair[1];
                if ($a <= 1 && $b >= 3) {
                    $results17[] = $a + $b;
                } else {
                    $results17[] = $a - $b;
                }
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">17</span>
                    <span class="task-title">Комбинированное условие</span>
                </div>
                <div class="task-description">
                    Если $a ≤ 1 и $b ≥ 3, то сумма, иначе разность.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$pairs</span> = [<br>    [1, 3],<br>    [0, 6],<br>    [3, 5]<br>];<br><span style="color: #ffb86c;">$results</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$pairs</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$pair</span>) {<br>    <span style="color: #ffb86c;">$a</span> = <span style="color: #ffb86c;">$pair</span>[0];<br>    <span style="color: #ffb86c;">$b</span> = <span style="color: #ffb86c;">$pair</span>[1];<br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$a</span> <= 1 && <span style="color: #ffb86c;">$b</span> >= 3) {<br>        <span style="color: #ffb86c;">$results</span>[] = <span style="color: #ffb86c;">$a</span> + <span style="color: #ffb86c;">$b</span>;<br>    } <span style="color: #50fa7b;">else</span> {<br>        <span style="color: #ffb86c;">$results</span>[] = <span style="color: #ffb86c;">$a</span> - <span style="color: #ffb86c;">$b</span>;<br>    }<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a=1,b=3 → </span><span style="color: #ffb86c;">{$results[0]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a=0,b=6 → </span><span style="color: #ffb86c;">{$results[1]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a=3,b=5 → </span><span style="color: #ffb86c;">{$results[2]}</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "a=1,b=3 → {$results17[0]}\n";
                        echo "a=0,b=6 → {$results17[1]}\n";
                        echo "a=3,b=5 → {$results17[2]}";
                    ?></span>
                </div>
            </div>

            <!-- Задача 18 -->
            <?php
            $testPairs = [
                [3, 5],
                [10, 7],
                [1, 15]
            ];
            $results18 = [];
            foreach ($testPairs as $pair) {
                $a = $pair[0];
                $b = $pair[1];
                if (($a > 2 && $a < 11) || ($b >= 6 && $b < 14)) {
                    $results18[] = 'Верно';
                } else {
                    $results18[] = 'Неверно';
                }
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">18</span>
                    <span class="task-title">Сложное условие</span>
                </div>
                <div class="task-description">
                    Если (a > 2 и a < 11) ИЛИ (b ≥ 6 и b < 14), то 'Верно', иначе 'Неверно'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$pairs</span> = [<br>    [3, 5],<br>    [10, 7],<br>    [1, 15]<br>];<br><span style="color: #ffb86c;">$results</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$pairs</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$pair</span>) {<br>    <span style="color: #ffb86c;">$a</span> = <span style="color: #ffb86c;">$pair</span>[0];<br>    <span style="color: #ffb86c;">$b</span> = <span style="color: #ffb86c;">$pair</span>[1];<br>    <span style="color: #50fa7b;">if</span> ((<span style="color: #ffb86c;">$a</span> > 2 && <span style="color: #ffb86c;">$a</span> < 11) || (<span style="color: #ffb86c;">$b</span> >= 6 && <span style="color: #ffb86c;">$b</span> < 14)) {<br>        <span style="color: #ffb86c;">$results</span>[] = <span style="color: #f1fa8c;">'Верно'</span>;<br>    } <span style="color: #50fa7b;">else</span> {<br>        <span style="color: #ffb86c;">$results</span>[] = <span style="color: #f1fa8c;">'Неверно'</span>;<br>    }<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a=3,b=5 → </span><span style="color: #ffb86c;">{$results[0]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a=10,b=7 → </span><span style="color: #ffb86c;">{$results[1]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"a=1,b=15 → </span><span style="color: #ffb86c;">{$results[2]}</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "a=3,b=5 → {$results18[0]}\n";
                        echo "a=10,b=7 → {$results18[1]}\n";
                        echo "a=1,b=15 → {$results18[2]}";
                    ?></span>
                </div>
            </div>

            <!-- SWITCH-CASE -->
            <div class="section-title">🔄 Switch-case</div>

            <!-- Задача 19 -->
            <?php
            $nums19 = [1, 2, 3, 4];
            $seasons19 = [];
            foreach ($nums19 as $num) {
                switch ($num) {
                    case 1:
                        $seasons19[] = 'зима';
                        break;
                    case 2:
                        $seasons19[] = 'лето';
                        break;
                    case 3:
                        $seasons19[] = 'весна';
                        break;
                    case 4:
                        $seasons19[] = 'осень';
                        break;
                }
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">19</span>
                    <span class="task-title">Switch-case</span>
                </div>
                <div class="task-description">
                    Переменная $num = 1,2,3,4. Записать в $result 'зима', 'лето', 'весна', 'осень' соответственно.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$nums</span> = [1, 2, 3, 4];<br><span style="color: #ffb86c;">$seasons</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$nums</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$num</span>) {<br>    <span style="color: #50fa7b;">switch</span> (<span style="color: #ffb86c;">$num</span>) {<br>        <span style="color: #50fa7b;">case</span> 1:<br>            <span style="color: #ffb86c;">$seasons</span>[] = <span style="color: #f1fa8c;">'зима'</span>;<br>            <span style="color: #50fa7b;">break</span>;<br>        <span style="color: #50fa7b;">case</span> 2:<br>            <span style="color: #ffb86c;">$seasons</span>[] = <span style="color: #f1fa8c;">'лето'</span>;<br>            <span style="color: #50fa7b;">break</span>;<br>        <span style="color: #50fa7b;">case</span> 3:<br>            <span style="color: #ffb86c;">$seasons</span>[] = <span style="color: #f1fa8c;">'весна'</span>;<br>            <span style="color: #50fa7b;">break</span>;<br>        <span style="color: #50fa7b;">case</span> 4:<br>            <span style="color: #ffb86c;">$seasons</span>[] = <span style="color: #f1fa8c;">'осень'</span>;<br>            <span style="color: #50fa7b;">break</span>;<br>    }<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"num=1 → </span><span style="color: #ffb86c;">{$seasons[0]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"num=2 → </span><span style="color: #ffb86c;">{$seasons[1]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"num=3 → </span><span style="color: #ffb86c;">{$seasons[2]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"num=4 → </span><span style="color: #ffb86c;">{$seasons[3]}</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "num=1 → {$seasons19[0]}\n";
                        echo "num=2 → {$seasons19[1]}\n";
                        echo "num=3 → {$seasons19[2]}\n";
                        echo "num=4 → {$seasons19[3]}";
                    ?></span>
                </div>
            </div>

            <!-- ЗАДАЧИ -->
            <div class="section-title">📝 Задачи</div>

            <!-- Задача 20 -->
            <?php
            $days20 = [5, 15, 25];
            $decades20 = [];
            foreach ($days20 as $day) {
                if ($day >= 1 && $day <= 10) {
                    $decades20[] = 'первая декада';
                } elseif ($day >= 11 && $day <= 20) {
                    $decades20[] = 'вторая декада';
                } elseif ($day >= 21 && $day <= 31) {
                    $decades20[] = 'третья декада';
                } else {
                    $decades20[] = 'некорректный день';
                }
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">20</span>
                    <span class="task-title">Декада месяца</span>
                </div>
                <div class="task-description">
                    В переменной $day число от 1 до 31. Определите в какую декаду попадает это число.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$days</span> = [5, 15, 25];<br><span style="color: #ffb86c;">$decades</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$days</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$day</span>) {<br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$day</span> >= 1 && <span style="color: #ffb86c;">$day</span> <= 10) {<br>        <span style="color: #ffb86c;">$decades</span>[] = <span style="color: #f1fa8c;">'первая декада'</span>;<br>    } <span style="color: #50fa7b;">elseif</span> (<span style="color: #ffb86c;">$day</span> >= 11 && <span style="color: #ffb86c;">$day</span> <= 20) {<br>        <span style="color: #ffb86c;">$decades</span>[] = <span style="color: #f1fa8c;">'вторая декада'</span>;<br>    } <span style="color: #50fa7b;">elseif</span> (<span style="color: #ffb86c;">$day</span> >= 21 && <span style="color: #ffb86c;">$day</span> <= 31) {<br>        <span style="color: #ffb86c;">$decades</span>[] = <span style="color: #f1fa8c;">'третья декада'</span>;<br>    } <span style="color: #50fa7b;">else</span> {<br>        <span style="color: #ffb86c;">$decades</span>[] = <span style="color: #f1fa8c;">'некорректный день'</span>;<br>    }<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"day=5 → </span><span style="color: #ffb86c;">{$decades[0]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"day=15 → </span><span style="color: #ffb86c;">{$decades[1]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"day=25 → </span><span style="color: #ffb86c;">{$decades[2]}</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "day=5 → {$decades20[0]}\n";
                        echo "day=15 → {$decades20[1]}\n";
                        echo "day=25 → {$decades20[2]}";
                    ?></span>
                </div>
            </div>

            <!-- Задача 21 -->
            <?php
            $months21 = [2, 6, 9, 12];
            $seasons21 = [];
            foreach ($months21 as $month) {
                if ($month >= 3 && $month <= 5) {
                    $seasons21[] = 'весна';
                } elseif ($month >= 6 && $month <= 8) {
                    $seasons21[] = 'лето';
                } elseif ($month >= 9 && $month <= 11) {
                    $seasons21[] = 'осень';
                } else {
                    $seasons21[] = 'зима';
                }
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">21</span>
                    <span class="task-title">Пора года</span>
                </div>
                <div class="task-description">
                    В переменной $month число от 1 до 12. Определите пору года.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$months</span> = [2, 6, 9, 12];<br><span style="color: #ffb86c;">$seasons</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$months</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$month</span>) {<br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$month</span> >= 3 && <span style="color: #ffb86c;">$month</span> <= 5) {<br>        <span style="color: #ffb86c;">$seasons</span>[] = <span style="color: #f1fa8c;">'весна'</span>;<br>    } <span style="color: #50fa7b;">elseif</span> (<span style="color: #ffb86c;">$month</span> >= 6 && <span style="color: #ffb86c;">$month</span> <= 8) {<br>        <span style="color: #ffb86c;">$seasons</span>[] = <span style="color: #f1fa8c;">'лето'</span>;<br>    } <span style="color: #50fa7b;">elseif</span> (<span style="color: #ffb86c;">$month</span> >= 9 && <span style="color: #ffb86c;">$month</span> <= 11) {<br>        <span style="color: #ffb86c;">$seasons</span>[] = <span style="color: #f1fa8c;">'осень'</span>;<br>    } <span style="color: #50fa7b;">else</span> {<br>        <span style="color: #ffb86c;">$seasons</span>[] = <span style="color: #f1fa8c;">'зима'</span>;<br>    }<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"month=2 → </span><span style="color: #ffb86c;">{$seasons[0]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"month=6 → </span><span style="color: #ffb86c;">{$seasons[1]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"month=9 → </span><span style="color: #ffb86c;">{$seasons[2]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"month=12 → </span><span style="color: #ffb86c;">{$seasons[3]}</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "month=2 → {$seasons21[0]}\n";
                        echo "month=6 → {$seasons21[1]}\n";
                        echo "month=9 → {$seasons21[2]}\n";
                        echo "month=12 → {$seasons21[3]}";
                    ?></span>
                </div>
            </div>

            <!-- Задача 22 -->
            <?php
            $years22 = [1700, 1800, 1900, 1600, 2000, 2024];
            $leapResults = [];
            foreach ($years22 as $year) {
                if (($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0) {
                    $leapResults[] = 'високосный';
                } else {
                    $leapResults[] = 'не високосный';
                }
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">22</span>
                    <span class="task-title">Високосный год</span>
                </div>
                <div class="task-description">
                    Определите, является ли год високосным (делится на 4, но не на 100, или делится на 400).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$years</span> = [1700, 1800, 1900, 1600, 2000, 2024];<br><span style="color: #ffb86c;">$leapResults</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$years</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$year</span>) {<br>    <span style="color: #50fa7b;">if</span> ((<span style="color: #ffb86c;">$year</span> % 4 == 0 && <span style="color: #ffb86c;">$year</span> % 100 != 0) || <span style="color: #ffb86c;">$year</span> % 400 == 0) {<br>        <span style="color: #ffb86c;">$leapResults</span>[] = <span style="color: #f1fa8c;">'високосный'</span>;<br>    } <span style="color: #50fa7b;">else</span> {<br>        <span style="color: #ffb86c;">$leapResults</span>[] = <span style="color: #f1fa8c;">'не високосный'</span>;<br>    }<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"1700: </span><span style="color: #ffb86c;">{$leapResults[0]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"1800: </span><span style="color: #ffb86c;">{$leapResults[1]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"1900: </span><span style="color: #ffb86c;">{$leapResults[2]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"1600: </span><span style="color: #ffb86c;">{$leapResults[3]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"2000: </span><span style="color: #ffb86c;">{$leapResults[4]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"2024: </span><span style="color: #ffb86c;">{$leapResults[5]}</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "1700: {$leapResults[0]}\n";
                        echo "1800: {$leapResults[1]}\n";
                        echo "1900: {$leapResults[2]}\n";
                        echo "1600: {$leapResults[3]}\n";
                        echo "2000: {$leapResults[4]}\n";
                        echo "2024: {$leapResults[5]}";
                    ?></span>
                </div>
            </div>

            <!-- Задача 23 -->
            <?php
            $strings23 = ['abcde', 'bcdea', 'test'];
            $results23 = [];
            foreach ($strings23 as $str) {
                $results23[] = ($str[0] == 'a') ? 'да' : 'нет';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">23</span>
                    <span class="task-title">Первый символ</span>
                </div>
                <div class="task-description">
                    Дана строка, например 'abcde'. Проверьте, что первым символом является буква 'a'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$strings</span> = [<span style="color: #f1fa8c;">'abcde'</span>, <span style="color: #f1fa8c;">'bcdea'</span>, <span style="color: #f1fa8c;">'test'</span>];<br><span style="color: #ffb86c;">$results</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$strings</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$str</span>) {<br>    <span style="color: #ffb86c;">$results</span>[] = (<span style="color: #ffb86c;">$str</span>[0] == <span style="color: #f1fa8c;">'a'</span>) ? <span style="color: #f1fa8c;">'да'</span> : <span style="color: #f1fa8c;">'нет'</span>;<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"'abcde' → </span><span style="color: #ffb86c;">{$results[0]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"'bcdea' → </span><span style="color: #ffb86c;">{$results[1]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"'test' → </span><span style="color: #ffb86c;">{$results[2]}</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "'abcde' → {$results23[0]}\n";
                        echo "'bcdea' → {$results23[1]}\n";
                        echo "'test' → {$results23[2]}";
                    ?></span>
                </div>
            </div>

            <!-- Задача 24 -->
            <?php
            $strings24 = ['12345', '23456', '34567', '45678'];
            $results24 = [];
            foreach ($strings24 as $str) {
                $first = $str[0];
                $results24[] = ($first == '1' || $first == '2' || $first == '3') ? 'да' : 'нет';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">24</span>
                    <span class="task-title">Цифра 1,2 или 3</span>
                </div>
                <div class="task-description">
                    Дана строка с цифрами. Проверьте, что первый символ - цифра 1, 2 или 3.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$strings</span> = [<span style="color: #f1fa8c;">'12345'</span>, <span style="color: #f1fa8c;">'23456'</span>, <span style="color: #f1fa8c;">'34567'</span>, <span style="color: #f1fa8c;">'45678'</span>];<br><span style="color: #ffb86c;">$results</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$strings</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$str</span>) {<br>    <span style="color: #ffb86c;">$first</span> = <span style="color: #ffb86c;">$str</span>[0];<br>    <span style="color: #ffb86c;">$results</span>[] = (<span style="color: #ffb86c;">$first</span> == <span style="color: #f1fa8c;">'1'</span> || <span style="color: #ffb86c;">$first</span> == <span style="color: #f1fa8c;">'2'</span> || <span style="color: #ffb86c;">$first</span> == <span style="color: #f1fa8c;">'3'</span>) ? <span style="color: #f1fa8c;">'да'</span> : <span style="color: #f1fa8c;">'нет'</span>;<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"'12345' → </span><span style="color: #ffb86c;">{$results[0]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"'23456' → </span><span style="color: #ffb86c;">{$results[1]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"'34567' → </span><span style="color: #ffb86c;">{$results[2]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"'45678' → </span><span style="color: #ffb86c;">{$results[3]}</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "'12345' → {$results24[0]}\n";
                        echo "'23456' → {$results24[1]}\n";
                        echo "'34567' → {$results24[2]}\n";
                        echo "'45678' → {$results24[3]}";
                    ?></span>
                </div>
            </div>

            <!-- Задача 25 -->
            <?php
            $num25 = '123';
            $sum25 = $num25[0] + $num25[1] + $num25[2];
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">25</span>
                    <span class="task-title">Сумма цифр</span>
                </div>
                <div class="task-description">
                    Дана строка из 3-х цифр. Найдите сумму этих цифр.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'123'</span>;<br><span style="color: #ffb86c;">$sum</span> = <span style="color: #ffb86c;">$str</span>[0] + <span style="color: #ffb86c;">$str</span>[1] + <span style="color: #ffb86c;">$str</span>[2];<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$sum</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $sum25; ?></span>
                </div>
            </div>

            <!-- Задача 26 -->
            <?php
            $strings26 = ['123321', '123456', '111111', '123123'];
            $results26 = [];
            foreach ($strings26 as $str) {
                $sum1 = $str[0] + $str[1] + $str[2];
                $sum2 = $str[3] + $str[4] + $str[5];
                $results26[] = ($sum1 == $sum2) ? 'да' : 'нет';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">26</span>
                    <span class="task-title">Счастливый билет</span>
                </div>
                <div class="task-description">
                    Дана строка из 6 цифр. Проверьте, что сумма первых трех равна сумме вторых трех.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$strings</span> = [<span style="color: #f1fa8c;">'123321'</span>, <span style="color: #f1fa8c;">'123456'</span>, <span style="color: #f1fa8c;">'111111'</span>, <span style="color: #f1fa8c;">'123123'</span>];<br><span style="color: #ffb86c;">$results</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$strings</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$str</span>) {<br>    <span style="color: #ffb86c;">$sum1</span> = <span style="color: #ffb86c;">$str</span>[0] + <span style="color: #ffb86c;">$str</span>[1] + <span style="color: #ffb86c;">$str</span>[2];<br>    <span style="color: #ffb86c;">$sum2</span> = <span style="color: #ffb86c;">$str</span>[3] + <span style="color: #ffb86c;">$str</span>[4] + <span style="color: #ffb86c;">$str</span>[5];<br>    <span style="color: #ffb86c;">$results</span>[] = (<span style="color: #ffb86c;">$sum1</span> == <span style="color: #ffb86c;">$sum2</span>) ? <span style="color: #f1fa8c;">'да'</span> : <span style="color: #f1fa8c;">'нет'</span>;<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"'123321' → </span><span style="color: #ffb86c;">{$results[0]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"'123456' → </span><span style="color: #ffb86c;">{$results[1]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"'111111' → </span><span style="color: #ffb86c;">{$results[2]}</span><span style="color: #f1fa8c;">\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"'123123' → </span><span style="color: #ffb86c;">{$results[3]}</span><span style="color: #f1fa8c;">"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "'123321' → {$results26[0]}\n";
                        echo "'123456' → {$results26[1]}\n";
                        echo "'111111' → {$results26[2]}\n";
                        echo "'123123' → {$results26[3]}";
                    ?></span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>