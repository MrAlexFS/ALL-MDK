<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Практическая работа: Работа с флагами в PHP</title>
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

        .theory-section h3 {
            color: #2c3e50;
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
                max-height: 250px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Практическая работа</h1>
            <p>Работа с флагами в PHP</p>
        </div>

        <!-- ТЕОРЕТИЧЕСКИЕ СВЕДЕНИЯ -->
        <div class="theory-section">
            <h2>📚 Что такое флаг?</h2>
            <p>
                <strong>Флаг (flag)</strong> — это специальная переменная, которая может принимать только два значения: 
                <strong>true</strong> (истина) или <strong>false</strong> (ложь). С помощью флагов можно решать задачи, 
                проверяющие наличие или отсутствие чего-либо.
            </p>
            <p>
                <strong>Основной алгоритм работы с флагом:</strong>
                <ul>
                    <li>Устанавливаем флаг в начальное значение (обычно <code>false</code> для поиска наличия, 
                    или <code>true</code> для проверки выполнения условия для всех элементов)</li>
                    <li>Перебираем элементы массива (или выполняем другую проверку)</li>
                    <li>При нахождении нужного элемента меняем значение флага и прерываем цикл</li>
                    <li>После цикла проверяем значение флага и выводим результат</li>
                </ul>
            </p>

            <h3>📝 Пример: проверка наличия числа 3 в массиве</h3>
            <div class="code-example">
                <pre><span style="color: #6272a4;">// Неправильное решение (выведет 'есть' несколько раз)</span>
<span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 3, 5];
<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$elem</span>) {
    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$elem</span> == 3) {
        <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'есть'</span>; <span style="color: #6272a4;">// выведет 2 раза</span>
    }
}

<span style="color: #6272a4;">// Улучшенное решение с break</span>
<span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 3, 5];
<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$elem</span>) {
    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$elem</span> == 3) {
        <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'есть'</span>;
        <span style="color: #50fa7b;">break</span>;  <span style="color: #6272a4;">// завершаем цикл после первого найденного</span>
    }
}

<span style="color: #6272a4;">// Правильное решение с флагом (позволяет вывести 'нет', если элемент не найден)</span>
<span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5];
<span style="color: #ffb86c;">$flag</span> = false;  <span style="color: #6272a4;">// изначально считаем, что элемента нет</span>

<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$elem</span>) {
    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$elem</span> == 3) {
        <span style="color: #ffb86c;">$flag</span> = true;  <span style="color: #6272a4;">// элемент найден</span>
        <span style="color: #50fa7b;">break</span>;        <span style="color: #6272a4;">// выходим из цикла</span>
    }
}

<span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$flag</span>) {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'есть'</span>;
} <span style="color: #50fa7b;">else</span> {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'нет'</span>;
}</pre>
            </div>
        </div>

        <div class="tasks-grid">
            <!-- Задача 1: Проверка наличия числа 3 -->
            <?php
            $arrays1 = [
                [1, 2, 3, 4, 5],
                [1, 2, 4, 5, 6],
                [3, 3, 3, 3, 3],
                [10, 20, 30, 40, 50],
                [1, 2, 3, 4, 3, 5]
            ];
            
            $results1 = [];
            foreach ($arrays1 as $arr) {
                $flag = false;
                foreach ($arr as $elem) {
                    if ($elem == 3) {
                        $flag = true;
                        break;
                    }
                }
                $results1[] = $flag ? 'есть' : 'нет';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">1</span>
                    <span class="task-title">Проверка наличия числа 3</span>
                </div>
                <div class="task-description">
                    Дан массив с числами. Проверьте, есть ли в нем элемент со значением 3. Если есть - выведите 'есть', если нет - выведите 'нет'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5];
<span style="color: #ffb86c;">$flag</span> = false;

<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$elem</span>) {
    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$elem</span> == 3) {
        <span style="color: #ffb86c;">$flag</span> = true;
        <span style="color: #50fa7b;">break</span>;
    }
}

<span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$flag</span> ? <span style="color: #f1fa8c;">'есть'</span> : <span style="color: #f1fa8c;">'нет'</span>;</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($arrays1 as $index => $arr): ?>
                    <div class="result-item">
                        <span class="result-label">Массив <?php echo json_encode($arr); ?></span>
                        <span class="result-content"><?php echo $results1[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 2: Проверка наличия отрицательных чисел -->
            <?php
            $arrays2 = [
                [5, 8, 3, 7, 2],
                [5, -2, 8, 3, -1],
                [10, 20, -5, 30, 40],
                [0, 0, 0, 0, 0],
                [1, -1, 2, -2, 3]
            ];
            
            $results2 = [];
            foreach ($arrays2 as $arr) {
                $flag = false;
                foreach ($arr as $elem) {
                    if ($elem < 0) {
                        $flag = true;
                        break;
                    }
                }
                $results2[] = $flag ? 'есть' : 'нет';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">Наличие отрицательных чисел</span>
                </div>
                <div class="task-description">
                    Проверьте, есть ли в массиве отрицательные числа.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [5, -2, 8, 3, -1];
<span style="color: #ffb86c;">$flag</span> = false;

<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$elem</span>) {
    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$elem</span> < 0) {
        <span style="color: #ffb86c;">$flag</span> = true;
        <span style="color: #50fa7b;">break</span>;
    }
}

<span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$flag</span> ? <span style="color: #f1fa8c;">'есть'</span> : <span style="color: #f1fa8c;">'нет'</span>;</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($arrays2 as $index => $arr): ?>
                    <div class="result-item">
                        <span class="result-label">Массив <?php echo json_encode($arr); ?></span>
                        <span class="result-content"><?php echo $results2[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 3: Все ли числа четные -->
            <?php
            $arrays3 = [
                [2, 4, 6, 8, 10],
                [2, 4, 5, 8, 10],
                [1, 2, 3, 4, 5],
                [10, 20, 30, 40, 50],
                [2, 4, 6, 8, 9]
            ];
            
            $results3 = [];
            foreach ($arrays3 as $arr) {
                $flag = true;
                foreach ($arr as $elem) {
                    if ($elem % 2 != 0) {
                        $flag = false;
                        break;
                    }
                }
                $results3[] = $flag ? 'да' : 'нет';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">3</span>
                    <span class="task-title">Все ли числа четные</span>
                </div>
                <div class="task-description">
                    Проверьте, все ли числа в массиве четные.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [2, 4, 6, 8, 10];
<span style="color: #ffb86c;">$flag</span> = true;

<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$elem</span>) {
    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$elem</span> % 2 != 0) {
        <span style="color: #ffb86c;">$flag</span> = false;
        <span style="color: #50fa7b;">break</span>;
    }
}

<span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$flag</span> ? <span style="color: #f1fa8c;">'да'</span> : <span style="color: #f1fa8c;">'нет'</span>;</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($arrays3 as $index => $arr): ?>
                    <div class="result-item">
                        <span class="result-label">Массив <?php echo json_encode($arr); ?></span>
                        <span class="result-content"><?php echo $results3[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 4: Все ли числа положительные -->
            <?php
            $arrays4 = [
                [1, 2, 3, 4, 5],
                [-1, 2, 3, 4, 5],
                [10, 20, 30, 40, 50],
                [0, 1, 2, 3, 4],
                [5, 6, 7, -8, 9]
            ];
            
            $results4 = [];
            foreach ($arrays4 as $arr) {
                $flag = true;
                foreach ($arr as $elem) {
                    if ($elem <= 0) {
                        $flag = false;
                        break;
                    }
                }
                $results4[] = $flag ? 'да' : 'нет';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4</span>
                    <span class="task-title">Все ли числа положительные</span>
                </div>
                <div class="task-description">
                    Проверьте, все ли числа в массиве положительные (больше 0).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5];
<span style="color: #ffb86c;">$flag</span> = true;

<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$elem</span>) {
    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$elem</span> <= 0) {
        <span style="color: #ffb86c;">$flag</span> = false;
        <span style="color: #50fa7b;">break</span>;
    }
}

<span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$flag</span> ? <span style="color: #f1fa8c;">'да'</span> : <span style="color: #f1fa8c;">'нет'</span>;</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($arrays4 as $index => $arr): ?>
                    <div class="result-item">
                        <span class="result-label">Массив <?php echo json_encode($arr); ?></span>
                        <span class="result-content"><?php echo $results4[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 5: Поиск числа больше 10 -->
            <?php
            $arrays5 = [
                [1, 2, 3, 4, 5],
                [5, 8, 12, 3, 1],
                [10, 20, 30, 40, 50],
                [0, 0, 0, 11, 0],
                [1, 2, 3, 4, 10]
            ];
            
            $results5 = [];
            foreach ($arrays5 as $arr) {
                $flag = false;
                foreach ($arr as $elem) {
                    if ($elem > 10) {
                        $flag = true;
                        break;
                    }
                }
                $results5[] = $flag ? 'есть' : 'нет';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">5</span>
                    <span class="task-title">Элемент больше 10</span>
                </div>
                <div class="task-description">
                    Проверьте, есть ли в массиве число больше 10.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5];
<span style="color: #ffb86c;">$flag</span> = false;

<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$elem</span>) {
    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$elem</span> > 10) {
        <span style="color: #ffb86c;">$flag</span> = true;
        <span style="color: #50fa7b;">break</span>;
    }
}

<span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$flag</span> ? <span style="color: #f1fa8c;">'есть'</span> : <span style="color: #f1fa8c;">'нет'</span>;</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($arrays5 as $index => $arr): ?>
                    <div class="result-item">
                        <span class="result-label">Массив <?php echo json_encode($arr); ?></span>
                        <span class="result-content"><?php echo $results5[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 6: Проверка наличия числа, кратного 3 -->
            <?php
            $arrays6 = [
                [1, 2, 4, 5, 7],
                [1, 2, 3, 4, 5],
                [10, 20, 30, 40, 50],
                [2, 4, 6, 8, 10],
                [5, 10, 15, 20, 25]
            ];
            
            $results6 = [];
            foreach ($arrays6 as $arr) {
                $flag = false;
                foreach ($arr as $elem) {
                    if ($elem % 3 == 0) {
                        $flag = true;
                        break;
                    }
                }
                $results6[] = $flag ? 'есть' : 'нет';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">6</span>
                    <span class="task-title">Число, кратное 3</span>
                </div>
                <div class="task-description">
                    Проверьте, есть ли в массиве число, кратное 3.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 4, 5, 7];
<span style="color: #ffb86c;">$flag</span> = false;

<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$elem</span>) {
    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$elem</span> % 3 == 0) {
        <span style="color: #ffb86c;">$flag</span> = true;
        <span style="color: #50fa7b;">break</span>;
    }
}

<span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$flag</span> ? <span style="color: #f1fa8c;">'есть'</span> : <span style="color: #f1fa8c;">'нет'</span>;</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($arrays6 as $index => $arr): ?>
                    <div class="result-item">
                        <span class="result-label">Массив <?php echo json_encode($arr); ?></span>
                        <span class="result-content"><?php echo $results6[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 7: Проверка наличия дубликатов -->
            <?php
            $arrays7 = [
                [1, 2, 3, 4, 5],
                [1, 2, 2, 3, 4],
                [5, 5, 5, 5, 5],
                [1, 3, 5, 7, 9],
                [1, 2, 3, 4, 1]
            ];
            
            $results7 = [];
            foreach ($arrays7 as $arr) {
                $flag = false;
                for ($i = 0; $i < count($arr); $i++) {
                    for ($j = $i + 1; $j < count($arr); $j++) {
                        if ($arr[$i] == $arr[$j]) {
                            $flag = true;
                            break 2;
                        }
                    }
                }
                $results7[] = $flag ? 'есть' : 'нет';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">7</span>
                    <span class="task-title">Наличие дубликатов</span>
                </div>
                <div class="task-description">
                    Проверьте, есть ли в массиве дубликаты (повторяющиеся числа).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5];
<span style="color: #ffb86c;">$flag</span> = false;

<span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = 0; <span style="color: #ffb86c;">$i</span> < <span style="color: #50fa7b;">count</span>(<span style="color: #ffb86c;">$arr</span>); <span style="color: #ffb86c;">$i</span>++) {
    <span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$j</span> = <span style="color: #ffb86c;">$i</span> + 1; <span style="color: #ffb86c;">$j</span> < <span style="color: #50fa7b;">count</span>(<span style="color: #ffb86c;">$arr</span>); <span style="color: #ffb86c;">$j</span>++) {
        <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$arr</span>[<span style="color: #ffb86c;">$i</span>] == <span style="color: #ffb86c;">$arr</span>[<span style="color: #ffb86c;">$j</span>]) {
            <span style="color: #ffb86c;">$flag</span> = true;
            <span style="color: #50fa7b;">break</span> 2;
        }
    }
}

<span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$flag</span> ? <span style="color: #f1fa8c;">'есть'</span> : <span style="color: #f1fa8c;">'нет'</span>;</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($arrays7 as $index => $arr): ?>
                    <div class="result-item">
                        <span class="result-label">Массив <?php echo json_encode($arr); ?></span>
                        <span class="result-content"><?php echo $results7[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 8: Проверка, что все строки имеют длину более 3 символов -->
            <?php
            $arrays8 = [
                ['apple', 'banana', 'cherry', 'date'],
                ['cat', 'dog', 'bird', 'fish'],
                ['hello', 'world', 'php', 'code'],
                ['hi', 'ok', 'yes', 'no'],
                ['programming', 'php', 'javascript', 'python']
            ];
            
            $results8 = [];
            foreach ($arrays8 as $arr) {
                $flag = true;
                foreach ($arr as $str) {
                    if (strlen($str) <= 3) {
                        $flag = false;
                        break;
                    }
                }
                $results8[] = $flag ? 'да' : 'нет';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">8</span>
                    <span class="task-title">Длина строк более 3 символов</span>
                </div>
                <div class="task-description">
                    Проверьте, что все строки в массиве имеют длину более 3 символов.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = ['apple', 'banana', 'cherry', 'date'];
<span style="color: #ffb86c;">$flag</span> = true;

<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$str</span>) {
    <span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">strlen</span>(<span style="color: #ffb86c;">$str</span>) <= 3) {
        <span style="color: #ffb86c;">$flag</span> = false;
        <span style="color: #50fa7b;">break</span>;
    }
}

<span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$flag</span> ? <span style="color: #f1fa8c;">'да'</span> : <span style="color: #f1fa8c;">'нет'</span>;</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($arrays8 as $index => $arr): ?>
                    <div class="result-item">
                        <span class="result-label">Массив <?php echo json_encode($arr); ?></span>
                        <span class="result-content"><?php echo $results8[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 9: Проверка наличия буквы 'a' в строке -->
            <?php
            $strings9 = [
                'hello world',
                'banana',
                'xyz',
                'programming',
                'test',
                'JavaScript'
            ];
            
            $results9 = [];
            foreach ($strings9 as $str) {
                $flag = false;
                for ($i = 0; $i < strlen($str); $i++) {
                    if (strtolower($str[$i]) == 'a') {
                        $flag = true;
                        break;
                    }
                }
                $results9[] = $flag ? 'есть' : 'нет';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">9</span>
                    <span class="task-title">Наличие буквы 'a'</span>
                </div>
                <div class="task-description">
                    Проверьте, есть ли в строке буква 'a' (регистронезависимо).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'hello world'</span>;
<span style="color: #ffb86c;">$flag</span> = false;

<span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = 0; <span style="color: #ffb86c;">$i</span> < <span style="color: #50fa7b;">strlen</span>(<span style="color: #ffb86c;">$str</span>); <span style="color: #ffb86c;">$i</span>++) {
    <span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">strtolower</span>(<span style="color: #ffb86c;">$str</span>[<span style="color: #ffb86c;">$i</span>]) == <span style="color: #f1fa8c;">'a'</span>) {
        <span style="color: #ffb86c;">$flag</span> = true;
        <span style="color: #50fa7b;">break</span>;
    }
}

<span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$flag</span> ? <span style="color: #f1fa8c;">'есть'</span> : <span style="color: #f1fa8c;">'нет'</span>;</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($strings9 as $index => $str): ?>
                    <div class="result-item">
                        <span class="result-label">Строка "<?php echo $str; ?>"</span>
                        <span class="result-content"><?php echo $results9[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Задача 10: Проверка, что все элементы массива уникальны -->
            <?php
            $arrays10 = [
                [1, 2, 3, 4, 5],
                [1, 2, 2, 3, 4],
                [5, 5, 5, 5, 5],
                [1, 3, 5, 7, 9],
                [1, 2, 3, 4, 1],
                ['a', 'b', 'c', 'd', 'e'],
                ['a', 'b', 'c', 'a', 'd']
            ];
            
            $results10 = [];
            foreach ($arrays10 as $arr) {
                $flag = true;
                for ($i = 0; $i < count($arr); $i++) {
                    for ($j = $i + 1; $j < count($arr); $j++) {
                        if ($arr[$i] == $arr[$j]) {
                            $flag = false;
                            break 2;
                        }
                    }
                }
                $results10[] = $flag ? 'да' : 'нет';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">10</span>
                    <span class="task-title">Все ли элементы уникальны</span>
                </div>
                <div class="task-description">
                    Проверьте, что все элементы в массиве уникальны (не повторяются).
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
                    <?php foreach ($arrays10 as $index => $arr): ?>
                    <div class="result-item">
                        <span class="result-label">Массив <?php echo json_encode($arr); ?></span>
                        <span class="result-content"><?php echo $results10[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- ДОПОЛНИТЕЛЬНЫЙ МАТЕРИАЛ -->
        <div class="theory-section" style="margin-top: 40px;">
            <h2>💡 Полезные советы по работе с флагами</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                <div style="background: #f7fafc; border-radius: 12px; padding: 20px;">
                    <h3 style="color: #e67e22; margin-bottom: 10px;">🎯 Именование флагов</h3>
                    <p>Используйте осмысленные имена:<br>
                    <code>$found</code> - найден ли элемент<br>
                    <code>$isValid</code> - валидны ли данные<br>
                    <code>$hasError</code> - есть ли ошибка<br>
                    <code>$allPositive</code> - все ли числа положительные</p>
                </div>
                <div style="background: #f7fafc; border-radius: 12px; padding: 20px;">
                    <h3 style="color: #e67e22; margin-bottom: 10px;">⚡ Оптимизация</h3>
                    <p>Всегда используйте <code>break</code> после обнаружения нужного элемента, чтобы не выполнять лишние итерации. Для вложенных циклов используйте <code>break2</code</p>
                </div>
                <div style="background: #f7fafc; border-radius: 12px; padding: 20px;">
                    <h3 style="color: #e67e22; margin-bottom: 10px;">🔍 Два типа проверок</h3>
                    <p><strong>Поиск наличия:</strong> <code>$flag = false;</code> → меняем на <code>true</code> при нахождении<br>
                    <strong>Проверка всех:</strong> <code>$flag = true;</code> → меняем на <code>false</code> при нарушении</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>