<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Практическая работа: Приемы работы с флагами в PHP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #2c3e50 0%, #e67e22 100%);
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
            background: linear-gradient(135deg, #ffffff 0%, #ffecd2 100%);
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
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 1.8rem;
            border-bottom: 2px solid #e67e22;
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
            background: linear-gradient(135deg, #2c3e50 0%, #e67e22 100%);
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
            box-shadow: 0 4px 10px rgba(230, 126, 34, 0.3);
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
            border-left: 4px solid #e67e22;
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
                max-height: 300px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Практическая работа</h1>
            <p>Приемы работы с флагами в PHP</p>
        </div>

        <!-- ТЕОРЕТИЧЕСКИЕ СВЕДЕНИЯ -->
        <div class="theory-section">
            <h2>📚 Приемы работы с флагами</h2>
            <p>
                <strong>Флаг (flag)</strong> — это переменная, которая принимает одно из двух значений 
                (обычно true/false или 1/0) и используется для отслеживания выполнения какого-либо условия.
            </p>
            <p>
                Основной прием работы с флагами:
                <ul style="margin-left: 20px; margin-top: 10px;">
                    <li>Устанавливаем флаг в <strong>false</strong> (предполагаем, что условие не выполнено)</li>
                    <li>Проходим по данным (массиву, диапазону чисел и т.д.)</li>
                    <li>Если условие выполняется, меняем флаг на <strong>true</strong></li>
                    <li>После цикла проверяем значение флага и выводим соответствующий результат</li>
                </ul>
            </p>
            <div class="code-example">
                <pre><span style="color: #6272a4;">// Пример использования флага</span>
<span style="color: #ffb86c;">$flag</span> = false; <span style="color: #6272a4;">// Изначально считаем, что условие не выполнено</span>

<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$array</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$item</span>) {
    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$item</span> == 5) {
        <span style="color: #ffb86c;">$flag</span> = true; <span style="color: #6272a4;">// Условие выполнено</span>
        <span style="color: #50fa7b;">break</span>;      <span style="color: #6272a4;">// Можно прервать цикл</span>
    }
}

<span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$flag</span>) {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'да'</span>;
} <span style="color: #50fa7b;">else</span> {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'нет'</span>;
}</pre>
            </div>
        </div>

        <div class="tasks-grid">
            <!-- Задача 1 -->
            <?php
            // Тестовые массивы для задачи 1
            $arrays1 = [
                [1, 2, 3, 4, 6, 7, 8],
                [1, 2, 3, 4, 5, 6, 7],
                [10, 20, 30, 40, 50],
                [5, 10, 15, 20],
                [1, 3, 5, 7, 9]
            ];
            
            $results1 = [];
            foreach ($arrays1 as $arr) {
                $flag = false;
                foreach ($arr as $num) {
                    if ($num == 5) {
                        $flag = true;
                        break;
                    }
                }
                $results1[] = $flag ? 'да' : 'нет';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">1</span>
                    <span class="task-title">Поиск числа 5 в массиве</span>
                </div>
                <div class="task-description">
                    Дан массив с числами. Проверьте, что в этом массиве есть число 5. Если есть - выведите 'да', а если нет - выведите 'нет'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5, 6, 7]; <span style="color: #6272a4;">// Пример массива</span>
<span style="color: #ffb86c;">$flag</span> = false;

<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$num</span>) {
    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$num</span> == 5) {
        <span style="color: #ffb86c;">$flag</span> = true;
        <span style="color: #50fa7b;">break</span>;
    }
}

<span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$flag</span>) {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'да'</span>;
} <span style="color: #50fa7b;">else</span> {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'нет'</span>;
}</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Массив [1,2,3,4,6,7,8]</span>
                        <span class="result-content"><?php echo $results1[0]; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Массив [1,2,3,4,5,6,7]</span>
                        <span class="result-content"><?php echo $results1[1]; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Массив [10,20,30,40,50]</span>
                        <span class="result-content"><?php echo $results1[2]; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Массив [5,10,15,20]</span>
                        <span class="result-content"><?php echo $results1[3]; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Массив [1,3,5,7,9]</span>
                        <span class="result-content"><?php echo $results1[4]; ?></span>
                    </div>
                </div>
            </div>

            <!-- Задача 2 -->
            <?php
            // Функция проверки простого числа
            function isPrimeNumber($num) {
                if ($num <= 1) return false;
                for ($i = 2; $i < $num; $i++) {
                    if ($num % $i == 0) {
                        return false;
                    }
                }
                return true;
            }
            
            $test_numbers2 = [31, 17, 25, 13, 21, 29, 49, 37];
            $results2 = [];
            foreach ($test_numbers2 as $num) {
                $results2[] = isPrimeNumber($num) ? 'нет (не делится)' : 'да (делится)';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">Проверка простого числа</span>
                </div>
                <div class="task-description">
                    Дано число. Проверьте, что это число не делится ни на одно другое число кроме себя самого и единицы. Если число не делится - выведите 'нет', а если делится - выведите 'да'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$num</span> = 31;
<span style="color: #ffb86c;">$flag</span> = false; <span style="color: #6272a4;">// Предполагаем, что число простое</span>

<span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = 2; <span style="color: #ffb86c;">$i</span> < <span style="color: #ffb86c;">$num</span>; <span style="color: #ffb86c;">$i</span>++) {
    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$num</span> % <span style="color: #ffb86c;">$i</span> == 0) {
        <span style="color: #ffb86c;">$flag</span> = true; <span style="color: #6272a4;">// Нашли делитель - число составное</span>
        <span style="color: #50fa7b;">break</span>;
    }
}

<span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$flag</span>) {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'да (делится)'</span>;
} <span style="color: #50fa7b;">else</span> {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'нет (не делится)'</span>;
}</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($test_numbers2 as $index => $num): ?>
                    <div class="result-item">
                        <span class="result-label">Число <?php echo $num; ?></span>
                        <span class="result-content"><?php echo $results2[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 3 -->
            <?php
            // Тестовые массивы для задачи 3
            $arrays3 = [
                [1, 2, 3, 4, 5, 6, 7],
                [1, 2, 2, 3, 4, 5],
                [1, 1, 2, 3, 4, 5],
                [5, 5, 6, 7, 8, 9],
                [1, 2, 3, 4, 4, 5, 6],
                [1, 2, 3, 4, 5, 6, 7, 8],
                [10, 10, 20, 30, 40],
                [1, 2, 3, 4, 5, 6, 7, 7]
            ];
            
            $results3 = [];
            foreach ($arrays3 as $arr) {
                $flag = false;
                for ($i = 0; $i < count($arr) - 1; $i++) {
                    if ($arr[$i] == $arr[$i + 1]) {
                        $flag = true;
                        break;
                    }
                }
                $results3[] = $flag ? 'да' : 'нет';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">3</span>
                    <span class="task-title">Поиск одинаковых чисел подряд</span>
                </div>
                <div class="task-description">
                    Дан массив с числами. Проверьте, есть ли в нем два одинаковых числа подряд. Если есть - выведите 'да', а если нет - выведите 'нет'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 2, 3, 4, 5]; <span style="color: #6272a4;">// Пример массива</span>
<span style="color: #ffb86c;">$flag</span> = false;

<span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = 0; <span style="color: #ffb86c;">$i</span> < <span style="color: #50fa7b;">count</span>(<span style="color: #ffb86c;">$arr</span>) - 1; <span style="color: #ffb86c;">$i</span>++) {
    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$arr</span>[<span style="color: #ffb86c;">$i</span>] == <span style="color: #ffb86c;">$arr</span>[<span style="color: #ffb86c;">$i</span> + 1]) {
        <span style="color: #ffb86c;">$flag</span> = true;
        <span style="color: #50fa7b;">break</span>;
    }
}

<span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$flag</span>) {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'да'</span>;
} <span style="color: #50fa7b;">else</span> {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'нет'</span>;
}</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">[1,2,3,4,5,6,7]</span>
                        <span class="result-content"><?php echo $results3[0]; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">[1,2,2,3,4,5]</span>
                        <span class="result-content"><?php echo $results3[1]; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">[1,1,2,3,4,5]</span>
                        <span class="result-content"><?php echo $results3[2]; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">[5,5,6,7,8,9]</span>
                        <span class="result-content"><?php echo $results3[3]; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">[1,2,3,4,4,5,6]</span>
                        <span class="result-content"><?php echo $results3[4]; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">[1,2,3,4,5,6,7,8]</span>
                        <span class="result-content"><?php echo $results3[5]; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">[10,10,20,30,40]</span>
                        <span class="result-content"><?php echo $results3[6]; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">[1,2,3,4,5,6,7,7]</span>
                        <span class="result-content"><?php echo $results3[7]; ?></span>
                    </div>
                </div>
            </div>

            <!-- ДОПОЛНИТЕЛЬНЫЕ ЗАДАЧИ ДЛЯ ПРАКТИКИ -->
            <div class="section-title">📚 Дополнительные задачи</div>

            <!-- Задача 4: Проверка наличия отрицательных чисел -->
            <?php
            $arrays4 = [
                [1, 2, 3, 4, 5],
                [-1, 2, 3, 4, 5],
                [10, 20, -5, 30, 40],
                [0, 0, 0, 0, 0],
                [1, -1, 2, -2, 3]
            ];
            
            $results4 = [];
            foreach ($arrays4 as $arr) {
                $flag = false;
                foreach ($arr as $num) {
                    if ($num < 0) {
                        $flag = true;
                        break;
                    }
                }
                $results4[] = $flag ? 'да' : 'нет';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4</span>
                    <span class="task-title">Наличие отрицательных чисел</span>
                </div>
                <div class="task-description">
                    Проверьте, есть ли в массиве отрицательные числа.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, -1, 2, -2, 3];
<span style="color: #ffb86c;">$flag</span> = false;

<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$num</span>) {
    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$num</span> < 0) {
        <span style="color: #ffb86c;">$flag</span> = true;
        <span style="color: #50fa7b;">break</span>;
    }
}

<span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$flag</span> ? <span style="color: #f1fa8c;">'да'</span> : <span style="color: #f1fa8c;">'нет'</span>;</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($arrays4 as $index => $arr): ?>
                    <div class="result-item">
                        <span class="result-label"><?php echo json_encode($arr); ?></span>
                        <span class="result-content"><?php echo $results4[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 5: Все ли числа четные -->
            <?php
            $arrays5 = [
                [2, 4, 6, 8, 10],
                [2, 4, 5, 8, 10],
                [1, 2, 3, 4, 5],
                [10, 20, 30, 40, 50],
                [2, 4, 6, 8, 9]
            ];
            
            $results5 = [];
            foreach ($arrays5 as $arr) {
                $flag = true; // Предполагаем, что все четные
                foreach ($arr as $num) {
                    if ($num % 2 != 0) {
                        $flag = false;
                        break;
                    }
                }
                $results5[] = $flag ? 'да' : 'нет';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">5</span>
                    <span class="task-title">Все ли числа четные</span>
                </div>
                <div class="task-description">
                    Проверьте, все ли числа в массиве четные.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [2, 4, 6, 8, 10];
<span style="color: #ffb86c;">$flag</span> = true; <span style="color: #6272a4;">// Предполагаем, что все четные</span>

<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$num</span>) {
    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$num</span> % 2 != 0) {
        <span style="color: #ffb86c;">$flag</span> = false;
        <span style="color: #50fa7b;">break</span>;
    }
}

<span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$flag</span> ? <span style="color: #f1fa8c;">'да'</span> : <span style="color: #f1fa8c;">'нет'</span>;</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($arrays5 as $index => $arr): ?>
                    <div class="result-item">
                        <span class="result-label"><?php echo json_encode($arr); ?></span>
                        <span class="result-content"><?php echo $results5[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 6: Поиск элемента больше 10 -->
            <?php
            $arrays6 = [
                [1, 2, 3, 4, 5],
                [5, 8, 12, 3, 1],
                [10, 20, 30, 40, 50],
                [0, 0, 0, 11, 0],
                [1, 2, 3, 4, 10]
            ];
            
            $results6 = [];
            foreach ($arrays6 as $arr) {
                $flag = false;
                foreach ($arr as $num) {
                    if ($num > 10) {
                        $flag = true;
                        break;
                    }
                }
                $results6[] = $flag ? 'да' : 'нет';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">6</span>
                    <span class="task-title">Элемент больше 10</span>
                </div>
                <div class="task-description">
                    Проверьте, есть ли в массиве число больше 10.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5];
<span style="color: #ffb86c;">$flag</span> = false;

<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$num</span>) {
    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$num</span> > 10) {
        <span style="color: #ffb86c;">$flag</span> = true;
        <span style="color: #50fa7b;">break</span>;
    }
}

<span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$flag</span> ? <span style="color: #f1fa8c;">'да'</span> : <span style="color: #f1fa8c;">'нет'</span>;</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($arrays6 as $index => $arr): ?>
                    <div class="result-item">
                        <span class="result-label"><?php echo json_encode($arr); ?></span>
                        <span class="result-content"><?php echo $results6[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 7: Все ли числа положительные -->
            <?php
            $arrays7 = [
                [1, 2, 3, 4, 5],
                [-1, 2, 3, 4, 5],
                [10, 20, 30, 40, 50],
                [0, 1, 2, 3, 4],
                [5, 6, 7, -8, 9]
            ];
            
            $results7 = [];
            foreach ($arrays7 as $arr) {
                $flag = true; // Предполагаем, что все положительные
                foreach ($arr as $num) {
                    if ($num <= 0) {
                        $flag = false;
                        break;
                    }
                }
                $results7[] = $flag ? 'да' : 'нет';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">7</span>
                    <span class="task-title">Все ли числа положительные</span>
                </div>
                <div class="task-description">
                    Проверьте, все ли числа в массиве положительные (больше 0).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5];
<span style="color: #ffb86c;">$flag</span> = true;

<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$num</span>) {
    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$num</span> <= 0) {
        <span style="color: #ffb86c;">$flag</span> = false;
        <span style="color: #50fa7b;">break</span>;
    }
}

<span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$flag</span> ? <span style="color: #f1fa8c;">'да'</span> : <span style="color: #f1fa8c;">'нет'</span>;</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($arrays7 as $index => $arr): ?>
                    <div class="result-item">
                        <span class="result-label"><?php echo json_encode($arr); ?></span>
                        <span class="result-content"><?php echo $results7[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 8: Найти число, кратное 3 -->
            <?php
            $arrays8 = [
                [1, 2, 4, 5, 7],
                [1, 2, 3, 4, 5],
                [10, 20, 30, 40, 50],
                [2, 4, 6, 8, 10],
                [5, 10, 15, 20, 25]
            ];
            
            $results8 = [];
            foreach ($arrays8 as $arr) {
                $flag = false;
                foreach ($arr as $num) {
                    if ($num % 3 == 0) {
                        $flag = true;
                        break;
                    }
                }
                $results8[] = $flag ? 'да' : 'нет';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">8</span>
                    <span class="task-title">Число, кратное 3</span>
                </div>
                <div class="task-description">
                    Проверьте, есть ли в массиве число, кратное 3.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 4, 5, 7];
<span style="color: #ffb86c;">$flag</span> = false;

<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$num</span>) {
    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$num</span> % 3 == 0) {
        <span style="color: #ffb86c;">$flag</span> = true;
        <span style="color: #50fa7b;">break</span>;
    }
}

<span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$flag</span> ? <span style="color: #f1fa8c;">'да'</span> : <span style="color: #f1fa8c;">'нет'</span>;</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($arrays8 as $index => $arr): ?>
                    <div class="result-item">
                        <span class="result-label"><?php echo json_encode($arr); ?></span>
                        <span class="result-content"><?php echo $results8[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 9: Все ли числа в массиве уникальны -->
            <?php
            $arrays9 = [
                [1, 2, 3, 4, 5],
                [1, 2, 2, 3, 4],
                [5, 5, 5, 5, 5],
                [1, 3, 5, 7, 9],
                [1, 2, 3, 4, 1]
            ];
            
            $results9 = [];
            foreach ($arrays9 as $arr) {
                $flag = true; // Предполагаем, что все уникальны
                for ($i = 0; $i < count($arr); $i++) {
                    for ($j = $i + 1; $j < count($arr); $j++) {
                        if ($arr[$i] == $arr[$j]) {
                            $flag = false;
                            break 2;
                        }
                    }
                }
                $results9[] = $flag ? 'да' : 'нет';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">9</span>
                    <span class="task-title">Все ли числа уникальны</span>
                </div>
                <div class="task-description">
                    Проверьте, все ли числа в массиве уникальны (не повторяются).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5];
<span style="color: #ffb86c;">$flag</span> = true;

<span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = 0; <span style="color: #ffb86c;">$i</span> < <span style="color: #50fa7b;">count</span>(<span style="color: #ffb86c;">$arr</span>); <span style="color: #ffb86c;">$i</span>++) {
    <span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$j</span> = <span style="color: #ffb86c;">$i</span> + 1; <span style="color: #ffb86c;">$j</span> < <span style="color: #50fa7b;">count</span>(<span style="color: #ffb86c;">$arr</span>); <span style="color: #ffb86c;">$j</span>++) {
        <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$arr</span>[<span style="color: #ffb86c;">$i</span>] == <span style="color: #ffb86c;">$arr</span>[<span style="color: #ffb86c;">$j</span>]) {
            <span style="color: #ffb86c;">$flag</span> = false;
            <span style="color: #50fa7b;">break</span> 2;
        }
    }
}

<span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$flag</span> ? <span style="color: #f1fa8c;">'да'</span> : <span style="color: #f1fa8c;">'нет'</span>;</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($arrays9 as $index => $arr): ?>
                    <div class="result-item">
                        <span class="result-label"><?php echo json_encode($arr); ?></span>
                        <span class="result-content"><?php echo $results9[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>