<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Практическая работа: Пользовательские функции в PHP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #1a2980 0%, #26a0da 100%);
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
            background: linear-gradient(135deg, #ffffff 0%, #e0f2fe 100%);
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

        .example-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .example-section h2 {
            color: #1a2980;
            margin-bottom: 20px;
            font-size: 1.8rem;
            border-bottom: 2px solid #26a0da;
            padding-bottom: 10px;
        }

        .example-section h3 {
            color: #1a2980;
            margin: 20px 0 10px;
            font-size: 1.3rem;
        }

        .example-section p {
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
            background: linear-gradient(135deg, #1a2980 0%, #26a0da 100%);
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
            box-shadow: 0 4px 10px rgba(38, 160, 218, 0.3);
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
            border-left: 4px solid #26a0da;
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
            max-height: 300px;
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
            max-height: 200px;
            overflow-y: auto;
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
            <p>Пользовательские функции в PHP</p>
        </div>

        <!-- ПРИМЕР РЕШЕНИЯ ЗАДАЧИ -->
        <div class="example-section">
            <h2>📚 Пример решения задачи</h2>
            
            <h3>Задача: Функция, возвращающая куб числа</h3>
            <p>Сделайте функцию, которая возвращает куб числа. Число передается параметром.</p>
            
            <div class="code-example">
                <pre><span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">cube</span>(<span style="color: #ffb86c;">$num</span>) {
    <span style="color: #50fa7b;">return</span> <span style="color: #ffb86c;">$num</span> * <span style="color: #ffb86c;">$num</span> * <span style="color: #ffb86c;">$num</span>;
}

<span style="color: #6272a4;">// Пример использования</span>
<span style="color: #50fa7b;">echo</span> cube(3); <span style="color: #6272a4;">// Выведет 27</span></pre>
            </div>
            
            <?php
            function cube($num) {
                return $num * $num * $num;
            }
            ?>
            <div class="result-item" style="background: #c6f6d5; border-radius: 12px; padding: 15px; margin-top: 15px;">
                <span class="result-label">Результат</span>
                <span class="result-content">cube(3) = <?php echo cube(3); ?>; cube(5) = <?php echo cube(5); ?>; cube(10) = <?php echo cube(10); ?></span>
            </div>
        </div>

        <div class="tasks-grid">
            <!-- Задача 1 -->
            <?php
            function square($num) {
                return $num * $num;
            }
            
            $test_values1 = [2, 5, 10, 7, 3];
            $results1 = [];
            foreach ($test_values1 as $val) {
                $results1[] = square($val);
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">1</span>
                    <span class="task-title">Квадрат числа</span>
                </div>
                <div class="task-description">
                    Сделайте функцию, которая возвращает квадрат числа. Число передается параметром.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">square</span>(<span style="color: #ffb86c;">$num</span>) {
    <span style="color: #50fa7b;">return</span> <span style="color: #ffb86c;">$num</span> * <span style="color: #ffb86c;">$num</span>;
}

<span style="color: #6272a4;">// Тестирование функции</span>
<span style="color: #ffb86c;">$test_values</span> = [2, 5, 10, 7, 3];
<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$test_values</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$val</span>) {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"square($val) = "</span> . square(<span style="color: #ffb86c;">$val</span>) . <span style="color: #f1fa8c;">"\n"</span>;
}</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($test_values1 as $index => $val): ?>
                    <div class="result-item">
                        <span class="result-label">square(<?php echo $val; ?>)</span>
                        <span class="result-content"><?php echo $results1[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 2 -->
            <?php
            function sum($a, $b) {
                return $a + $b;
            }
            
            $test_pairs2 = [[3, 5], [10, 20], [7, 8], [15, 25], [100, 200]];
            $results2 = [];
            foreach ($test_pairs2 as $pair) {
                $results2[] = sum($pair[0], $pair[1]);
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">Сумма двух чисел</span>
                </div>
                <div class="task-description">
                    Сделайте функцию, которая возвращает сумму двух чисел. Числа передаются параметрами функции.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">sum</span>(<span style="color: #ffb86c;">$a</span>, <span style="color: #ffb86c;">$b</span>) {
    <span style="color: #50fa7b;">return</span> <span style="color: #ffb86c;">$a</span> + <span style="color: #ffb86c;">$b</span>;
}

<span style="color: #6272a4;">// Тестирование функции</span>
<span style="color: #ffb86c;">$test_pairs</span> = [[3, 5], [10, 20], [7, 8], [15, 25], [100, 200]];
<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$test_pairs</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$pair</span>) {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"sum({$pair[0]}, {$pair[1]}) = "</span> . sum(<span style="color: #ffb86c;">$pair</span>[0], <span style="color: #ffb86c;">$pair</span>[1]) . <span style="color: #f1fa8c;">"\n"</span>;
}</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($test_pairs2 as $index => $pair): ?>
                    <div class="result-item">
                        <span class="result-label">sum(<?php echo $pair[0]; ?>, <?php echo $pair[1]; ?>)</span>
                        <span class="result-content"><?php echo $results2[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 3 -->
            <?php
            function calculate($a, $b, $c) {
                return ($a - $b) / $c;
            }
            
            $test_triplets3 = [
                [10, 5, 2],
                [20, 8, 3],
                [15, 3, 4],
                [100, 20, 5],
                [50, 10, 2]
            ];
            $results3 = [];
            foreach ($test_triplets3 as $triplet) {
                $results3[] = calculate($triplet[0], $triplet[1], $triplet[2]);
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">3</span>
                    <span class="task-title">Сложная операция</span>
                </div>
                <div class="task-description">
                    Сделайте функцию, которая отнимает от первого числа второе и делит на третье.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">calculate</span>(<span style="color: #ffb86c;">$a</span>, <span style="color: #ffb86c;">$b</span>, <span style="color: #ffb86c;">$c</span>) {
    <span style="color: #50fa7b;">return</span> (<span style="color: #ffb86c;">$a</span> - <span style="color: #ffb86c;">$b</span>) / <span style="color: #ffb86c;">$c</span>;
}

<span style="color: #6272a4;">// Тестирование функции</span>
<span style="color: #ffb86c;">$test_triplets</span> = [[10, 5, 2], [20, 8, 3], [15, 3, 4], [100, 20, 5], [50, 10, 2]];
<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$test_triplets</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$t</span>) {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"calculate({$t[0]}, {$t[1]}, {$t[2]}) = "</span> . calculate(<span style="color: #ffb86c;">$t</span>[0], <span style="color: #ffb86c;">$t</span>[1], <span style="color: #ffb86c;">$t</span>[2]) . <span style="color: #f1fa8c;">"\n"</span>;
}</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($test_triplets3 as $index => $triplet): ?>
                    <div class="result-item">
                        <span class="result-label">calculate(<?php echo $triplet[0]; ?>, <?php echo $triplet[1]; ?>, <?php echo $triplet[2]; ?>)</span>
                        <span class="result-content"><?php echo $results3[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 4 -->
            <?php
            function getDayOfWeek($num) {
                $days = [
                    1 => 'понедельник',
                    2 => 'вторник',
                    3 => 'среда',
                    4 => 'четверг',
                    5 => 'пятница',
                    6 => 'суббота',
                    7 => 'воскресенье'
                ];
                
                if ($num >= 1 && $num <= 7) {
                    return $days[$num];
                } else {
                    return 'Ошибка: число должно быть от 1 до 7';
                }
            }
            
            $test_days4 = [1, 2, 3, 4, 5, 6, 7, 8];
            $results4 = [];
            foreach ($test_days4 as $day) {
                $results4[] = getDayOfWeek($day);
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4</span>
                    <span class="task-title">День недели</span>
                </div>
                <div class="task-description">
                    Сделайте функцию, которая принимает параметром число от 1 до 7, а возвращает день недели на русском языке.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">getDayOfWeek</span>(<span style="color: #ffb86c;">$num</span>) {
    <span style="color: #ffb86c;">$days</span> = [
        1 => <span style="color: #f1fa8c;">'понедельник'</span>,
        2 => <span style="color: #f1fa8c;">'вторник'</span>,
        3 => <span style="color: #f1fa8c;">'среда'</span>,
        4 => <span style="color: #f1fa8c;">'четверг'</span>,
        5 => <span style="color: #f1fa8c;">'пятница'</span>,
        6 => <span style="color: #f1fa8c;">'суббота'</span>,
        7 => <span style="color: #f1fa8c;">'воскресенье'</span>
    ];
    
    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$num</span> >= 1 && <span style="color: #ffb86c;">$num</span> <= 7) {
        <span style="color: #50fa7b;">return</span> <span style="color: #ffb86c;">$days</span>[<span style="color: #ffb86c;">$num</span>];
    } <span style="color: #50fa7b;">else</span> {
        <span style="color: #50fa7b;">return</span> <span style="color: #f1fa8c;">'Ошибка: число должно быть от 1 до 7'</span>;
    }
}

<span style="color: #6272a4;">// Тестирование функции</span>
<span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = 1; <span style="color: #ffb86c;">$i</span> <= 7; <span style="color: #ffb86c;">$i</span>++) {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"$i → "</span> . getDayOfWeek(<span style="color: #ffb86c;">$i</span>) . <span style="color: #f1fa8c;">"\n"</span>;
}</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($test_days4 as $index => $day): ?>
                    <div class="result-item">
                        <span class="result-label"><?php echo $day; ?> →</span>
                        <span class="result-content"><?php echo $results4[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- ДОПОЛНИТЕЛЬНЫЕ ЗАДАЧИ ДЛЯ ПРАКТИКИ -->
            <div class="section-title">📚 Дополнительные задачи</div>

            <!-- Задача 5: Проверка четности -->
            <?php
            function isEven($num) {
                return $num % 2 == 0;
            }
            
            $test_numbers5 = [2, 3, 4, 7, 10, 15, 20];
            $results5 = [];
            foreach ($test_numbers5 as $num) {
                $results5[] = isEven($num) ? 'четное' : 'нечетное';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">5</span>
                    <span class="task-title">Проверка четности</span>
                </div>
                <div class="task-description">
                    Создайте функцию, которая проверяет, является ли число четным. Возвращает true или false.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">isEven</span>(<span style="color: #ffb86c;">$num</span>) {
    <span style="color: #50fa7b;">return</span> <span style="color: #ffb86c;">$num</span> % 2 == 0;
}

<span style="color: #6272a4;">// Тестирование функции</span>
<span style="color: #ffb86c;">$numbers</span> = [2, 3, 4, 7, 10, 15, 20];
<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$numbers</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$num</span>) {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"$num → "</span> . (isEven(<span style="color: #ffb86c;">$num</span>) ? <span style="color: #f1fa8c;">'четное'</span> : <span style="color: #f1fa8c;">'нечетное'</span>) . <span style="color: #f1fa8c;">"\n"</span>;
}</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($test_numbers5 as $index => $num): ?>
                    <div class="result-item">
                        <span class="result-label"><?php echo $num; ?> →</span>
                        <span class="result-content"><?php echo $results5[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 6: Максимум из двух чисел -->
            <?php
            function maxOfTwo($a, $b) {
                return ($a > $b) ? $a : $b;
            }
            
            $test_pairs6 = [[5, 10], [20, 15], [7, 7], [100, 50], [3, 8]];
            $results6 = [];
            foreach ($test_pairs6 as $pair) {
                $results6[] = maxOfTwo($pair[0], $pair[1]);
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">6</span>
                    <span class="task-title">Максимум из двух</span>
                </div>
                <div class="task-description">
                    Создайте функцию, которая возвращает большее из двух чисел.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">maxOfTwo</span>(<span style="color: #ffb86c;">$a</span>, <span style="color: #ffb86c;">$b</span>) {
    <span style="color: #50fa7b;">return</span> (<span style="color: #ffb86c;">$a</span> > <span style="color: #ffb86c;">$b</span>) ? <span style="color: #ffb86c;">$a</span> : <span style="color: #ffb86c;">$b</span>;
}

<span style="color: #6272a4;">// Тестирование функции</span>
<span style="color: #ffb86c;">$pairs</span> = [[5, 10], [20, 15], [7, 7], [100, 50], [3, 8]];
<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$pairs</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$pair</span>) {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"max({$pair[0]}, {$pair[1]}) = "</span> . maxOfTwo(<span style="color: #ffb86c;">$pair</span>[0], <span style="color: #ffb86c;">$pair</span>[1]) . <span style="color: #f1fa8c;">"\n"</span>;
}</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($test_pairs6 as $index => $pair): ?>
                    <div class="result-item">
                        <span class="result-label">max(<?php echo $pair[0]; ?>, <?php echo $pair[1]; ?>)</span>
                        <span class="result-content"><?php echo $results6[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 7: Факториал числа -->
            <?php
            function factorial($n) {
                if ($n <= 1) return 1;
                $result = 1;
                for ($i = 2; $i <= $n; $i++) {
                    $result *= $i;
                }
                return $result;
            }
            
            $test_factorials7 = [1, 2, 3, 4, 5, 6];
            $results7 = [];
            foreach ($test_factorials7 as $n) {
                $results7[] = factorial($n);
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">7</span>
                    <span class="task-title">Факториал числа</span>
                </div>
                <div class="task-description">
                    Создайте функцию, которая вычисляет факториал числа (n! = 1*2*3*...*n).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">factorial</span>(<span style="color: #ffb86c;">$n</span>) {
    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$n</span> <= 1) <span style="color: #50fa7b;">return</span> 1;
    <span style="color: #ffb86c;">$result</span> = 1;
    <span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = 2; <span style="color: #ffb86c;">$i</span> <= <span style="color: #ffb86c;">$n</span>; <span style="color: #ffb86c;">$i</span>++) {
        <span style="color: #ffb86c;">$result</span> *= <span style="color: #ffb86c;">$i</span>;
    }
    <span style="color: #50fa7b;">return</span> <span style="color: #ffb86c;">$result</span>;
}

<span style="color: #6272a4;">// Тестирование функции</span>
<span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = 1; <span style="color: #ffb86c;">$i</span> <= 6; <span style="color: #ffb86c;">$i</span>++) {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"$i! = "</span> . factorial(<span style="color: #ffb86c;">$i</span>) . <span style="color: #f1fa8c;">"\n"</span>;
}</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($test_factorials7 as $index => $n): ?>
                    <div class="result-item">
                        <span class="result-label"><?php echo $n; ?>! =</span>
                        <span class="result-content"><?php echo $results7[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 8: Проверка простого числа -->
            <?php
            function isPrime($n) {
                if ($n <= 1) return false;
                for ($i = 2; $i <= sqrt($n); $i++) {
                    if ($n % $i == 0) return false;
                }
                return true;
            }
            
            $test_primes8 = [2, 3, 4, 5, 6, 7, 11, 13, 15, 17, 20];
            $results8 = [];
            foreach ($test_primes8 as $n) {
                $results8[] = isPrime($n) ? 'простое' : 'составное';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">8</span>
                    <span class="task-title">Проверка простого числа</span>
                </div>
                <div class="task-description">
                    Создайте функцию, которая проверяет, является ли число простым.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">isPrime</span>(<span style="color: #ffb86c;">$n</span>) {
    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$n</span> <= 1) <span style="color: #50fa7b;">return</span> false;
    <span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = 2; <span style="color: #ffb86c;">$i</span> <= <span style="color: #50fa7b;">sqrt</span>(<span style="color: #ffb86c;">$n</span>); <span style="color: #ffb86c;">$i</span>++) {
        <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$n</span> % <span style="color: #ffb86c;">$i</span> == 0) <span style="color: #50fa7b;">return</span> false;
    }
    <span style="color: #50fa7b;">return</span> true;
}

<span style="color: #6272a4;">// Тестирование функции</span>
<span style="color: #ffb86c;">$numbers</span> = [2, 3, 4, 5, 6, 7, 11, 13, 15, 17, 20];
<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$numbers</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$n</span>) {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"$n → "</span> . (isPrime(<span style="color: #ffb86c;">$n</span>) ? <span style="color: #f1fa8c;">'простое'</span> : <span style="color: #f1fa8c;">'составное'</span>) . <span style="color: #f1fa8c;">"\n"</span>;
}</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($test_primes8 as $index => $n): ?>
                    <div class="result-item">
                        <span class="result-label"><?php echo $n; ?> →</span>
                        <span class="result-content"><?php echo $results8[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 9: Переворот строки -->
            <?php
            function reverseString($str) {
                $result = '';
                for ($i = strlen($str) - 1; $i >= 0; $i--) {
                    $result .= $str[$i];
                }
                return $result;
            }
            
            $test_strings9 = ['hello', 'world', 'PHP', '12345', 'abcde', 'Привет'];
            $results9 = [];
            foreach ($test_strings9 as $str) {
                $results9[] = reverseString($str);
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">9</span>
                    <span class="task-title">Переворот строки</span>
                </div>
                <div class="task-description">
                    Создайте функцию, которая переворачивает строку (например, 'hello' → 'olleh').
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">reverseString</span>(<span style="color: #ffb86c;">$str</span>) {
    <span style="color: #ffb86c;">$result</span> = <span style="color: #f1fa8c;">''</span>;
    <span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = <span style="color: #50fa7b;">strlen</span>(<span style="color: #ffb86c;">$str</span>) - 1; <span style="color: #ffb86c;">$i</span> >= 0; <span style="color: #ffb86c;">$i</span>--) {
        <span style="color: #ffb86c;">$result</span> .= <span style="color: #ffb86c;">$str</span>[<span style="color: #ffb86c;">$i</span>];
    }
    <span style="color: #50fa7b;">return</span> <span style="color: #ffb86c;">$result</span>;
}

<span style="color: #6272a4;">// Тестирование функции</span>
<span style="color: #ffb86c;">$strings</span> = [<span style="color: #f1fa8c;">'hello'</span>, <span style="color: #f1fa8c;">'world'</span>, <span style="color: #f1fa8c;">'PHP'</span>, <span style="color: #f1fa8c;">'12345'</span>, <span style="color: #f1fa8c;">'abcde'</span>];
<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$strings</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$str</span>) {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"'$str' → '"</span> . reverseString(<span style="color: #ffb86c;">$str</span>) . <span style="color: #f1fa8c;">"'\n"</span>;
}</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($test_strings9 as $index => $str): ?>
                    <div class="result-item">
                        <span class="result-label">'<?php echo $str; ?>' →</span>
                        <span class="result-content">'<?php echo $results9[$index]; ?>'</span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 10: Палиндром -->
            <?php
            function isPalindrome($str) {
                $str = strtolower(preg_replace('/[^a-zа-я0-9]/u', '', $str));
                return $str == strrev($str);
            }
            
            $test_strings10 = ['madam', 'racecar', 'hello', '12321', 'level', 'php', 'world'];
            $results10 = [];
            foreach ($test_strings10 as $str) {
                $results10[] = isPalindrome($str) ? 'да, палиндром' : 'нет';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">10</span>
                    <span class="task-title">Проверка палиндрома</span>
                </div>
                <div class="task-description">
                    Создайте функцию, которая проверяет, является ли строка палиндромом (читается одинаково слева направо и справа налево).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">isPalindrome</span>(<span style="color: #ffb86c;">$str</span>) {
    <span style="color: #ffb86c;">$str</span> = <span style="color: #50fa7b;">strtolower</span>(<span style="color: #50fa7b;">preg_replace</span>(<span style="color: #f1fa8c;">'/[^a-zа-я0-9]/u'</span>, <span style="color: #f1fa8c;">''</span>, <span style="color: #ffb86c;">$str</span>));
    <span style="color: #50fa7b;">return</span> <span style="color: #ffb86c;">$str</span> == <span style="color: #50fa7b;">strrev</span>(<span style="color: #ffb86c;">$str</span>);
}

<span style="color: #6272a4;">// Тестирование функции</span>
<span style="color: #ffb86c;">$words</span> = [<span style="color: #f1fa8c;">'madam'</span>, <span style="color: #f1fa8c;">'racecar'</span>, <span style="color: #f1fa8c;">'hello'</span>, <span style="color: #f1fa8c;">'12321'</span>, <span style="color: #f1fa8c;">'level'</span>];
<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$words</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$word</span>) {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"'$word' → "</span> . (isPalindrome(<span style="color: #ffb86c;">$word</span>) ? <span style="color: #f1fa8c;">'палиндром'</span> : <span style="color: #f1fa8c;">'не палиндром'</span>) . <span style="color: #f1fa8c;">"\n"</span>;
}</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($test_strings10 as $index => $str): ?>
                    <div class="result-item">
                        <span class="result-label">'<?php echo $str; ?>' →</span>
                        <span class="result-content"><?php echo $results10[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>