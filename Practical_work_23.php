<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Практическая работа: Приемы работы с логическими значениями в PHP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
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
            background: linear-gradient(135deg, #ffffff 0%, #c0e0ff 100%);
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

        .theory-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .theory-section h2 {
            color: #1e3c72;
            margin-bottom: 20px;
            font-size: 1.8rem;
            border-bottom: 2px solid #2a5298;
            padding-bottom: 10px;
        }

        .theory-section p {
            color: #4a5568;
            margin-bottom: 15px;
            line-height: 1.7;
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

        .tasks-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(500px, 1fr));
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
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
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
            box-shadow: 0 4px 10px rgba(42, 82, 152, 0.3);
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
            border-left: 4px solid #2a5298;
            font-family: 'Inter', sans-serif;
            line-height: 1.5;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
        }

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
            max-height: 400px;
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

        .result-content.boolean-true {
            background: #c6f6d5;
            color: #22543d;
            border-left: 3px solid #38a169;
        }

        .result-content.boolean-false {
            background: #fed7d7;
            color: #742a2a;
            border-left: 3px solid #fc8181;
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
                max-height: 250px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Практическая работа</h1>
            <p>Приемы работы с логическими значениями в PHP</p>
        </div>

        <!-- ТЕОРЕТИЧЕСКИЕ СВЕДЕНИЯ -->
        <div class="theory-section">
            <h2>📚 Логические значения (boolean)</h2>
            <p>
                <strong>Логический тип данных (bool)</strong> — это тип, который может принимать только два значения: 
                <strong>true</strong> (истина) или <strong>false</strong> (ложь). Логические значения часто используются:
            </p>
            <ul style="margin-left: 20px; margin-top: 10px; margin-bottom: 15px;">
                <li>Для хранения результата проверки условий</li>
                <li>В условных операторах (if, while, for)</li>
                <li>Как результат работы функций, выполняющих проверки</li>
                <li>Для управления потоком выполнения программы</li>
            </ul>
            <div class="code-example">
                <pre><span style="color: #6272a4;">// Пример работы с логическими значениями</span>
<span style="color: #ffb86c;">$isEqual</span> = (5 == 5);        <span style="color: #6272a4;">// true</span>
<span style="color: #ffb86c;">$isGreater</span> = (10 > 5);      <span style="color: #6272a4;">// true</span>
<span style="color: #ffb86c;">$isLess</span> = (3 < 1);          <span style="color: #6272a4;">// false</span>

<span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">isPositive</span>(<span style="color: #ffb86c;">$num</span>) {
    <span style="color: #50fa7b;">return</span> <span style="color: #ffb86c;">$num</span> > 0;
}

<span style="color: #50fa7b;">var_dump</span>(isPositive(5));    <span style="color: #6272a4;">// bool(true)</span>
<span style="color: #50fa7b;">var_dump</span>(isPositive(-3));   <span style="color: #6272a4;">// bool(false)</span></pre>
            </div>
        </div>

        <div class="tasks-grid">
            <!-- Задача 1 -->
            <?php
            function areEqual($a, $b) {
                return $a == $b;
            }
            
            $test_pairs1 = [
                [5, 5],
                [10, 20],
                [0, 0],
                [-5, -5],
                [100, 99],
                [7, 7],
                [3, 5]
            ];
            
            $results1 = [];
            foreach ($test_pairs1 as $pair) {
                $results1[] = areEqual($pair[0], $pair[1]);
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">1</span>
                    <span class="task-title">Сравнение чисел</span>
                </div>
                <div class="task-description">
                    Сделайте функцию, которая параметрами принимает 2 числа. Если эти числа равны - пусть функция вернет true, а если не равны - false.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">areEqual</span>(<span style="color: #ffb86c;">$a</span>, <span style="color: #ffb86c;">$b</span>) {
    <span style="color: #50fa7b;">return</span> <span style="color: #ffb86c;">$a</span> == <span style="color: #ffb86c;">$b</span>;
}

<span style="color: #6272a4;">// Примеры использования</span>
<span style="color: #50fa7b;">var_dump</span>(areEqual(5, 5));    <span style="color: #6272a4;">// true</span>
<span style="color: #50fa7b;">var_dump</span>(areEqual(10, 20));  <span style="color: #6272a4;">// false</span>
<span style="color: #50fa7b;">var_dump</span>(areEqual(0, 0));    <span style="color: #6272a4;">// true</span>
<span style="color: #50fa7b;">var_dump</span>(areEqual(-5, -5));  <span style="color: #6272a4;">// true</span>
<span style="color: #50fa7b;">var_dump</span>(areEqual(100, 99)); <span style="color: #6272a4;">// false</span></pre>
                </div>
                <div class="task-result">
                    <?php foreach ($test_pairs1 as $index => $pair): ?>
                    <div class="result-item">
                        <span class="result-label">areEqual(<?php echo $pair[0]; ?>, <?php echo $pair[1]; ?>)</span>
                        <span class="result-content <?php echo $results1[$index] ? 'boolean-true' : 'boolean-false'; ?>">
                            <?php echo $results1[$index] ? 'true' : 'false'; ?>
                        </span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 2 -->
            <?php
            function isSumGreaterThanTen($a, $b) {
                return ($a + $b) > 10;
            }
            
            $test_pairs2 = [
                [5, 6],
                [3, 4],
                [10, 1],
                [2, 8],
                [7, 3],
                [0, 11],
                [4, 5],
                [8, 3]
            ];
            
            $results2 = [];
            foreach ($test_pairs2 as $pair) {
                $results2[] = isSumGreaterThanTen($pair[0], $pair[1]);
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">Сумма больше 10</span>
                </div>
                <div class="task-description">
                    Сделайте функцию, которая параметрами принимает 2 числа. Если их сумма больше 10 - пусть функция вернет true, а если нет - false.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">isSumGreaterThanTen</span>(<span style="color: #ffb86c;">$a</span>, <span style="color: #ffb86c;">$b</span>) {
    <span style="color: #50fa7b;">return</span> (<span style="color: #ffb86c;">$a</span> + <span style="color: #ffb86c;">$b</span>) > 10;
}

<span style="color: #6272a4;">// Примеры использования</span>
<span style="color: #50fa7b;">var_dump</span>(isSumGreaterThanTen(5, 6));   <span style="color: #6272a4;">// true (11 > 10)</span>
<span style="color: #50fa7b;">var_dump</span>(isSumGreaterThanTen(3, 4));   <span style="color: #6272a4;">// false (7 > 10)</span>
<span style="color: #50fa7b;">var_dump</span>(isSumGreaterThanTen(10, 1));  <span style="color: #6272a4;">// true (11 > 10)</span>
<span style="color: #50fa7b;">var_dump</span>(isSumGreaterThanTen(2, 8));   <span style="color: #6272a4;">// true (10 > 10) - false, так как 10 не больше 10</span>
<span style="color: #50fa7b;">var_dump</span>(isSumGreaterThanTen(7, 3));   <span style="color: #6272a4;">// true (10 > 10) - false</span></pre>
                </div>
                <div class="task-result">
                    <?php foreach ($test_pairs2 as $index => $pair): 
                        $sum = $pair[0] + $pair[1];
                    ?>
                    <div class="result-item">
                        <span class="result-label"><?php echo $pair[0]; ?> + <?php echo $pair[1]; ?> = <?php echo $sum; ?></span>
                        <span class="result-content <?php echo $results2[$index] ? 'boolean-true' : 'boolean-false'; ?>">
                            <?php echo $results2[$index] ? 'true' : 'false'; ?>
                            (<?php echo $sum; ?> > 10)
                        </span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 3 -->
            <?php
            function isNegative($num) {
                return $num < 0;
            }
            
            $test_numbers3 = [-5, 0, 3, -10, 7, -1, 0, 100, -100, 1];
            $results3 = [];
            foreach ($test_numbers3 as $num) {
                $results3[] = isNegative($num);
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">3</span>
                    <span class="task-title">Проверка отрицательного числа</span>
                </div>
                <div class="task-description">
                    Сделайте функцию, которая параметром принимает число и проверяет - отрицательное оно или нет. Если отрицательное - пусть функция вернет true, а если нет - false.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">isNegative</span>(<span style="color: #ffb86c;">$num</span>) {
    <span style="color: #50fa7b;">return</span> <span style="color: #ffb86c;">$num</span> < 0;
}

<span style="color: #6272a4;">// Примеры использования</span>
<span style="color: #50fa7b;">var_dump</span>(isNegative(-5));   <span style="color: #6272a4;">// true</span>
<span style="color: #50fa7b;">var_dump</span>(isNegative(0));    <span style="color: #6272a4;">// false</span>
<span style="color: #50fa7b;">var_dump</span>(isNegative(3));    <span style="color: #6272a4;">// false</span>
<span style="color: #50fa7b;">var_dump</span>(isNegative(-10));  <span style="color: #6272a4;">// true</span>
<span style="color: #50fa7b;">var_dump</span>(isNegative(7));    <span style="color: #6272a4;">// false</span>
<span style="color: #50fa7b;">var_dump</span>(isNegative(-1));   <span style="color: #6272a4;">// true</span></pre>
                </div>
                <div class="task-result">
                    <?php foreach ($test_numbers3 as $index => $num): ?>
                    <div class="result-item">
                        <span class="result-label">isNegative(<?php echo $num; ?>)</span>
                        <span class="result-content <?php echo $results3[$index] ? 'boolean-true' : 'boolean-false'; ?>">
                            <?php echo $results3[$index] ? 'true' : 'false'; ?>
                            (<?php echo $num; ?> <?php echo $results3[$index] ? '< 0' : '≥ 0'; ?>)
                        </span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- ДОПОЛНИТЕЛЬНЫЕ ЗАДАЧИ ДЛЯ ПРАКТИКИ -->
            <div class="section-title">📚 Дополнительные задачи</div>

            <!-- Задача 4: Проверка четности -->
            <?php
            function isEven($num) {
                return $num % 2 == 0;
            }
            
            $test_numbers4 = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
            $results4 = [];
            foreach ($test_numbers4 as $num) {
                $results4[] = isEven($num);
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4</span>
                    <span class="task-title">Проверка четности</span>
                </div>
                <div class="task-description">
                    Сделайте функцию, которая проверяет, является ли число четным. Если четное - верните true, иначе false.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">isEven</span>(<span style="color: #ffb86c;">$num</span>) {
    <span style="color: #50fa7b;">return</span> <span style="color: #ffb86c;">$num</span> % 2 == 0;
}

<span style="color: #6272a4;">// Примеры использования</span>
<span style="color: #50fa7b;">var_dump</span>(isEven(2));   <span style="color: #6272a4;">// true</span>
<span style="color: #50fa7b;">var_dump</span>(isEven(3));   <span style="color: #6272a4;">// false</span>
<span style="color: #50fa7b;">var_dump</span>(isEven(4));   <span style="color: #6272a4;">// true</span></pre>
                </div>
                <div class="task-result">
                    <?php foreach ($test_numbers4 as $index => $num): ?>
                    <div class="result-item">
                        <span class="result-label">isEven(<?php echo $num; ?>)</span>
                        <span class="result-content <?php echo $results4[$index] ? 'boolean-true' : 'boolean-false'; ?>">
                            <?php echo $results4[$index] ? 'true' : 'false'; ?>
                        </span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 5: Проверка вхождения в диапазон -->
            <?php
            function isBetween($num, $min, $max) {
                return $num >= $min && $num <= $max;
            }
            
            $test_values5 = [
                [5, 1, 10],
                [15, 1, 10],
                [1, 1, 10],
                [10, 1, 10],
                [0, 1, 10],
                [7, 5, 8],
                [3, 5, 8]
            ];
            
            $results5 = [];
            foreach ($test_values5 as $val) {
                $results5[] = isBetween($val[0], $val[1], $val[2]);
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">5</span>
                    <span class="task-title">Вхождение в диапазон</span>
                </div>
                <div class="task-description">
                    Сделайте функцию, которая проверяет, попадает ли число в заданный диапазон (включая границы).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">isBetween</span>(<span style="color: #ffb86c;">$num</span>, <span style="color: #ffb86c;">$min</span>, <span style="color: #ffb86c;">$max</span>) {
    <span style="color: #50fa7b;">return</span> <span style="color: #ffb86c;">$num</span> >= <span style="color: #ffb86c;">$min</span> && <span style="color: #ffb86c;">$num</span> <= <span style="color: #ffb86c;">$max</span>;
}

<span style="color: #6272a4;">// Примеры использования</span>
<span style="color: #50fa7b;">var_dump</span>(isBetween(5, 1, 10));   <span style="color: #6272a4;">// true</span>
<span style="color: #50fa7b;">var_dump</span>(isBetween(15, 1, 10));  <span style="color: #6272a4;">// false</span>
<span style="color: #50fa7b;">var_dump</span>(isBetween(1, 1, 10));   <span style="color: #6272a4;">// true</span>
<span style="color: #50fa7b;">var_dump</span>(isBetween(10, 1, 10));  <span style="color: #6272a4;">// true</span></pre>
                </div>
                <div class="task-result">
                    <?php foreach ($test_values5 as $index => $val): ?>
                    <div class="result-item">
                        <span class="result-label">isBetween(<?php echo $val[0]; ?>, <?php echo $val[1]; ?>, <?php echo $val[2]; ?>)</span>
                        <span class="result-content <?php echo $results5[$index] ? 'boolean-true' : 'boolean-false'; ?>">
                            <?php echo $results5[$index] ? 'true' : 'false'; ?>
                        </span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 6: Проверка делимости -->
            <?php
            function isDivisible($num, $divisor) {
                return $num % $divisor == 0;
            }
            
            $test_values6 = [
                [10, 2],
                [10, 3],
                [15, 3],
                [15, 5],
                [7, 2],
                [8, 4],
                [9, 3],
                [10, 4]
            ];
            
            $results6 = [];
            foreach ($test_values6 as $val) {
                $results6[] = isDivisible($val[0], $val[1]);
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">6</span>
                    <span class="task-title">Проверка делимости</span>
                </div>
                <div class="task-description">
                    Сделайте функцию, которая проверяет, делится ли одно число на другое.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">isDivisible</span>(<span style="color: #ffb86c;">$num</span>, <span style="color: #ffb86c;">$divisor</span>) {
    <span style="color: #50fa7b;">return</span> <span style="color: #ffb86c;">$num</span> % <span style="color: #ffb86c;">$divisor</span> == 0;
}

<span style="color: #6272a4;">// Примеры использования</span>
<span style="color: #50fa7b;">var_dump</span>(isDivisible(10, 2));   <span style="color: #6272a4;">// true</span>
<span style="color: #50fa7b;">var_dump</span>(isDivisible(10, 3));   <span style="color: #6272a4;">// false</span>
<span style="color: #50fa7b;">var_dump</span>(isDivisible(15, 3));   <span style="color: #6272a4;">// true</span>
<span style="color: #50fa7b;">var_dump</span>(isDivisible(15, 5));   <span style="color: #6272a4;">// true</span></pre>
                </div>
                <div class="task-result">
                    <?php foreach ($test_values6 as $index => $val): ?>
                    <div class="result-item">
                        <span class="result-label">isDivisible(<?php echo $val[0]; ?>, <?php echo $val[1]; ?>)</span>
                        <span class="result-content <?php echo $results6[$index] ? 'boolean-true' : 'boolean-false'; ?>">
                            <?php echo $results6[$index] ? 'true' : 'false'; ?>
                            (<?php echo $val[0]; ?> <?php echo $results6[$index] ? 'делится' : 'не делится'; ?> на <?php echo $val[1]; ?>)
                        </span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 7: Проверка совершеннолетия -->
            <?php
            function isAdult($age) {
                return $age >= 18;
            }
            
            $test_ages7 = [15, 18, 20, 17, 21, 12, 18, 25];
            $results7 = [];
            foreach ($test_ages7 as $age) {
                $results7[] = isAdult($age);
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">7</span>
                    <span class="task-title">Проверка совершеннолетия</span>
                </div>
                <div class="task-description">
                    Сделайте функцию, которая проверяет, является ли возраст совершеннолетним (18 лет и более).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">isAdult</span>(<span style="color: #ffb86c;">$age</span>) {
    <span style="color: #50fa7b;">return</span> <span style="color: #ffb86c;">$age</span> >= 18;
}

<span style="color: #6272a4;">// Примеры использования</span>
<span style="color: #50fa7b;">var_dump</span>(isAdult(15));   <span style="color: #6272a4;">// false</span>
<span style="color: #50fa7b;">var_dump</span>(isAdult(18));   <span style="color: #6272a4;">// true</span>
<span style="color: #50fa7b;">var_dump</span>(isAdult(20));   <span style="color: #6272a4;">// true</span>
<span style="color: #50fa7b;">var_dump</span>(isAdult(17));   <span style="color: #6272a4;">// false</span></pre>
                </div>
                <div class="task-result">
                    <?php foreach ($test_ages7 as $index => $age): ?>
                    <div class="result-item">
                        <span class="result-label">isAdult(<?php echo $age; ?>)</span>
                        <span class="result-content <?php echo $results7[$index] ? 'boolean-true' : 'boolean-false'; ?>">
                            <?php echo $results7[$index] ? 'true' : 'false'; ?>
                            (<?php echo $age; ?> лет <?php echo $results7[$index] ? '≥ 18' : '< 18'; ?>)
                        </span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 8: Проверка, что число является степенью двойки -->
            <?php
            function isPowerOfTwo($num) {
                if ($num <= 0) return false;
                return ($num & ($num - 1)) == 0;
            }
            
            $test_numbers8 = [1, 2, 3, 4, 5, 8, 16, 32, 64, 10, 128];
            $results8 = [];
            foreach ($test_numbers8 as $num) {
                $results8[] = isPowerOfTwo($num);
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">8</span>
                    <span class="task-title">Степень двойки</span>
                </div>
                <div class="task-description">
                    Сделайте функцию, которая проверяет, является ли число степенью двойки.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">isPowerOfTwo</span>(<span style="color: #ffb86c;">$num</span>) {
    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$num</span> <= 0) <span style="color: #50fa7b;">return</span> false;
    <span style="color: #50fa7b;">return</span> (<span style="color: #ffb86c;">$num</span> & (<span style="color: #ffb86c;">$num</span> - 1)) == 0;
}

<span style="color: #6272a4;">// Примеры использования</span>
<span style="color: #50fa7b;">var_dump</span>(isPowerOfTwo(1));   <span style="color: #6272a4;">// true (2^0)</span>
<span style="color: #50fa7b;">var_dump</span>(isPowerOfTwo(2));   <span style="color: #6272a4;">// true (2^1)</span>
<span style="color: #50fa7b;">var_dump</span>(isPowerOfTwo(4));   <span style="color: #6272a4;">// true (2^2)</span>
<span style="color: #50fa7b;">var_dump</span>(isPowerOfTwo(8));   <span style="color: #6272a4;">// true (2^3)</span>
<span style="color: #50fa7b;">var_dump</span>(isPowerOfTwo(3));   <span style="color: #6272a4;">// false</span></pre>
                </div>
                <div class="task-result">
                    <?php foreach ($test_numbers8 as $index => $num): ?>
                    <div class="result-item">
                        <span class="result-label">isPowerOfTwo(<?php echo $num; ?>)</span>
                        <span class="result-content <?php echo $results8[$index] ? 'boolean-true' : 'boolean-false'; ?>">
                            <?php echo $results8[$index] ? 'true' : 'false'; ?>
                        </span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 9: Проверка, что строка начинается с определенной буквы -->
            <?php
            function startsWith($str, $letter) {
                return strtolower($str[0]) == strtolower($letter);
            }
            
            $test_strings9 = [
                ['Hello', 'h'],
                ['World', 'w'],
                ['PHP', 'p'],
                ['Apple', 'a'],
                ['Banana', 'b'],
                ['Test', 't'],
                ['Hello', 'H'],
                ['World', 'W']
            ];
            
            $results9 = [];
            foreach ($test_strings9 as $val) {
                $results9[] = startsWith($val[0], $val[1]);
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">9</span>
                    <span class="task-title">Начинается с буквы</span>
                </div>
                <div class="task-description">
                    Сделайте функцию, которая проверяет, начинается ли строка с определенной буквы (регистронезависимо).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">startsWith</span>(<span style="color: #ffb86c;">$str</span>, <span style="color: #ffb86c;">$letter</span>) {
    <span style="color: #50fa7b;">return</span> <span style="color: #50fa7b;">strtolower</span>(<span style="color: #ffb86c;">$str</span>[0]) == <span style="color: #50fa7b;">strtolower</span>(<span style="color: #ffb86c;">$letter</span>);
}

<span style="color: #6272a4;">// Примеры использования</span>
<span style="color: #50fa7b;">var_dump</span>(startsWith(<span style="color: #f1fa8c;">"Hello"</span>, <span style="color: #f1fa8c;">"h"</span>));   <span style="color: #6272a4;">// true</span>
<span style="color: #50fa7b;">var_dump</span>(startsWith(<span style="color: #f1fa8c;">"World"</span>, <span style="color: #f1fa8c;">"w"</span>));   <span style="color: #6272a4;">// true</span>
<span style="color: #50fa7b;">var_dump</span>(startsWith(<span style="color: #f1fa8c;">"PHP"</span>, <span style="color: #f1fa8c;">"p"</span>));     <span style="color: #6272a4;">// true</span>
<span style="color: #50fa7b;">var_dump</span>(startsWith(<span style="color: #f1fa8c;">"Apple"</span>, <span style="color: #f1fa8c;">"a"</span>));   <span style="color: #6272a4;">// true</span></pre>
                </div>
                <div class="task-result">
                    <?php foreach ($test_strings9 as $index => $val): ?>
                    <div class="result-item">
                        <span class="result-label">startsWith("<?php echo $val[0]; ?>", "<?php echo $val[1]; ?>")</span>
                        <span class="result-content <?php echo $results9[$index] ? 'boolean-true' : 'boolean-false'; ?>">
                            <?php echo $results9[$index] ? 'true' : 'false'; ?>
                        </span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>