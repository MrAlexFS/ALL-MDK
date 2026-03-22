<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Самостоятельная работа 3-4: Функции для работы с массивами</title>
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
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 1.8rem;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }

        .example-section h3 {
            color: #2c3e50;
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
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
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
            border-left: 4px solid #3498db;
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
            max-height: 200px;
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
            font-size: 0.9rem;
            line-height: 1.4;
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
                max-height: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Самостоятельная работа 3-4</h1>
            <p>Функции для работы с массивами в PHP</p>
        </div>

        <!-- ПРИМЕРЫ РЕШЕНИЯ ЗАДАЧ -->
        <div class="example-section">
            <h2>📚 Примеры решения задач</h2>
            
            <h3>Задача 1. Массив от 1 до 100 и сумма элементов</h3>
            <p>Создайте массив, заполненный числами от 1 до 100. Найдите сумму элементов данного массива.</p>
            <div class="code-example">
                <pre><span style="color: #ffb86c;">$arr</span> = <span style="color: #50fa7b;">range</span>(1, 100);<br><span style="color: #ffb86c;">$sum</span> = <span style="color: #50fa7b;">array_sum</span>(<span style="color: #ffb86c;">$arr</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$sum</span>;</pre>
            </div>
            <?php
            $arr_example = range(1, 100);
            $sum_example = array_sum($arr_example);
            ?>
            <div class="result-item" style="background: #c6f6d5; border-radius: 12px; padding: 15px; margin-top: 15px;">
                <span class="result-label">Результат</span>
                <span class="result-content">Сумма чисел от 1 до 100 = <?php echo $sum_example; ?></span>
            </div>

            <h3 style="margin-top: 30px;">Задача 2. Функция array_map</h3>
            <p>Дан массив с элементами 'a', 'b', 'c', 'd', 'e'. С помощью функции array_map сделайте из него массив 'A', 'B', 'C', 'D', 'E'.</p>
            <div class="code-example">
                <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'a'</span>, <span style="color: #f1fa8c;">'b'</span>, <span style="color: #f1fa8c;">'c'</span>, <span style="color: #f1fa8c;">'d'</span>, <span style="color: #f1fa8c;">'e'</span>];<br><span style="color: #ffb86c;">$arr</span> = <span style="color: #50fa7b;">array_map</span>(<span style="color: #f1fa8c;">'strtoupper'</span>, <span style="color: #ffb86c;">$arr</span>);</pre>
            </div>
            <?php
            $arr_example2 = ['a', 'b', 'c', 'd', 'e'];
            $arr_example2 = array_map('strtoupper', $arr_example2);
            ?>
            <div class="result-item" style="background: #c6f6d5; border-radius: 12px; padding: 15px; margin-top: 15px;">
                <span class="result-label">Результат</span>
                <span class="result-content">[<?php echo implode(', ', $arr_example2); ?>]</span>
            </div>
        </div>

        <div class="tasks-grid">
            <!-- COUNT -->
            <div class="section-title">📊 Работа с count</div>

            <!-- Задача 1 -->
            <?php
            $arr1 = [10, 20, 30, 40, 50];
            $count1 = count($arr1);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">1</span>
                    <span class="task-title">Количество элементов</span>
                </div>
                <div class="task-description">
                    Дан массив $arr. Подсчитайте количество элементов этого массива.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [10, 20, 30, 40, 50];<br><span style="color: #ffb86c;">$count</span> = <span style="color: #50fa7b;">count</span>(<span style="color: #ffb86c;">$arr</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$count</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content"><?php echo $count1; ?></span>
                    </div>
                </div>
            </div>

            <!-- Задача 2 -->
            <?php
            $arr2 = [1, 2, 3, 4, 5];
            $last2 = $arr2[count($arr2) - 1];
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">Последний элемент</span>
                </div>
                <div class="task-description">
                    Дан массив $arr. С помощью функции count выведите последний элемент данного массива.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5];<br><span style="color: #ffb86c;">$last</span> = <span style="color: #ffb86c;">$arr</span>[<span style="color: #50fa7b;">count</span>(<span style="color: #ffb86c;">$arr</span>) - 1];<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$last</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content"><?php echo $last2; ?></span>
                    </div>
                </div>
            </div>

            <!-- IN_ARRAY -->
            <div class="section-title">🔍 Работа с in_array</div>

            <!-- Задача 3 -->
            <?php
            $arr3 = [1, 2, 4, 5, 6];
            $has3 = in_array(3, $arr3) ? 'есть' : 'нет';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">3</span>
                    <span class="task-title">Поиск элемента</span>
                </div>
                <div class="task-description">
                    Дан массив с числами. Проверьте, что в нем есть элемент со значением 3.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 4, 5, 6];<br><span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">in_array</span>(3, <span style="color: #ffb86c;">$arr</span>)) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'есть'</span>;<br>} <span style="color: #50fa7b;">else</span> {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'нет'</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content"><?php echo $has3; ?></span>
                    </div>
                </div>
            </div>

            <!-- ARRAY_SUM, ARRAY_PRODUCT -->
            <div class="section-title">➕ Работа с array_sum и array_product</div>

            <!-- Задача 4 -->
            <?php
            $arr4 = [1, 2, 3, 4, 5];
            $sum4 = array_sum($arr4);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4</span>
                    <span class="task-title">Сумма элементов</span>
                </div>
                <div class="task-description">
                    Дан массив [1, 2, 3, 4, 5]. Найдите сумму элементов данного массива.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5];<br><span style="color: #ffb86c;">$sum</span> = <span style="color: #50fa7b;">array_sum</span>(<span style="color: #ffb86c;">$arr</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$sum</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content"><?php echo $sum4; ?></span>
                    </div>
                </div>
            </div>

            <!-- Задача 5 -->
            <?php
            $arr5 = [1, 2, 3, 4, 5];
            $product5 = array_product($arr5);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">5</span>
                    <span class="task-title">Произведение элементов</span>
                </div>
                <div class="task-description">
                    Дан массив [1, 2, 3, 4, 5]. Найдите произведение (умножение) элементов данного массива.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5];<br><span style="color: #ffb86c;">$product</span> = <span style="color: #50fa7b;">array_product</span>(<span style="color: #ffb86c;">$arr</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$product</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content"><?php echo $product5; ?></span>
                    </div>
                </div>
            </div>

            <!-- Задача 6 -->
            <?php
            $arr6 = [10, 20, 30, 40, 50];
            $avg6 = array_sum($arr6) / count($arr6);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">6</span>
                    <span class="task-title">Среднее арифметическое</span>
                </div>
                <div class="task-description">
                    Дан массив $arr. С помощью функций array_sum и count найдите среднее арифметическое элементов.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [10, 20, 30, 40, 50];<br><span style="color: #ffb86c;">$avg</span> = <span style="color: #50fa7b;">array_sum</span>(<span style="color: #ffb86c;">$arr</span>) / <span style="color: #50fa7b;">count</span>(<span style="color: #ffb86c;">$arr</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$avg</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content"><?php echo $avg6; ?></span>
                    </div>
                </div>
            </div>

            <!-- RANGE -->
            <div class="section-title">📏 Работа с range</div>

            <!-- Задача 7 -->
            <?php
            $arr7 = range(1, 100);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">7</span>
                    <span class="task-title">Массив от 1 до 100</span>
                </div>
                <div class="task-description">
                    Создайте массив, заполненный числами от 1 до 100.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = <span style="color: #50fa7b;">range</span>(1, 100);<br><span style="color: #50fa7b;">print_r</span>(<span style="color: #ffb86c;">$arr</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content multiline">[<?php echo implode(', ', array_slice($arr7, 0, 10)) . '...'; ?>]</span>
                    </div>
                </div>
            </div>

            <!-- Задача 8 -->
            <?php
            $arr8 = range('a', 'z');
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">8</span>
                    <span class="task-title">Массив букв a-z</span>
                </div>
                <div class="task-description">
                    Создайте массив, заполненный буквами от 'a' до 'z'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = <span style="color: #50fa7b;">range</span>(<span style="color: #f1fa8c;">'a'</span>, <span style="color: #f1fa8c;">'z'</span>);<br><span style="color: #50fa7b;">print_r</span>(<span style="color: #ffb86c;">$arr</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content multiline">[<?php echo implode(', ', $arr8); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- Задача 9 -->
            <?php
            $str9 = implode('-', range(1, 9));
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">9</span>
                    <span class="task-title">Строка с дефисами</span>
                </div>
                <div class="task-description">
                    Создайте строку '1-2-3-4-5-6-7-8-9' не используя цикл.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #50fa7b;">implode</span>(<span style="color: #f1fa8c;">'-'</span>, <span style="color: #50fa7b;">range</span>(1, 9));<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$str</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content"><?php echo $str9; ?></span>
                    </div>
                </div>
            </div>

            <!-- Задача 10 -->
            <?php
            $sum10 = array_sum(range(1, 100));
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">10</span>
                    <span class="task-title">Сумма от 1 до 100</span>
                </div>
                <div class="task-description">
                    Найдите сумму чисел от 1 до 100 не используя цикл.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$sum</span> = <span style="color: #50fa7b;">array_sum</span>(<span style="color: #50fa7b;">range</span>(1, 100));<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$sum</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content"><?php echo $sum10; ?></span>
                    </div>
                </div>
            </div>

            <!-- Задача 11 -->
            <?php
            $product11 = array_product(range(1, 10));
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">11</span>
                    <span class="task-title">Произведение от 1 до 10</span>
                </div>
                <div class="task-description">
                    Найдите произведение чисел от 1 до 10 не используя цикл.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$product</span> = <span style="color: #50fa7b;">array_product</span>(<span style="color: #50fa7b;">range</span>(1, 10));<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$product</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content"><?php echo $product11; ?></span>
                    </div>
                </div>
            </div>

            <!-- ARRAY_MERGE -->
            <div class="section-title">🔀 Работа с array_merge</div>

            <!-- Задача 12 -->
            <?php
            $arr12_1 = [1, 2, 3];
            $arr12_2 = ['a', 'b', 'c'];
            $merged12 = array_merge($arr12_1, $arr12_2);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">12</span>
                    <span class="task-title">Объединение массивов</span>
                </div>
                <div class="task-description">
                    Даны два массива: первый с элементами 1, 2, 3, второй с элементами 'a', 'b', 'c'. Сделайте из них массив с элементами 1, 2, 3, 'a', 'b', 'c'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr1</span> = [1, 2, 3];<br><span style="color: #ffb86c;">$arr2</span> = [<span style="color: #f1fa8c;">'a'</span>, <span style="color: #f1fa8c;">'b'</span>, <span style="color: #f1fa8c;">'c'</span>];<br><span style="color: #ffb86c;">$result</span> = <span style="color: #50fa7b;">array_merge</span>(<span style="color: #ffb86c;">$arr1</span>, <span style="color: #ffb86c;">$arr2</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content">[<?php echo implode(', ', $merged12); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- ARRAY_SLICE -->
            <div class="section-title">✂️ Работа с array_slice</div>

            <!-- Задача 13 -->
            <?php
            $arr13 = [1, 2, 3, 4, 5];
            $slice13 = array_slice($arr13, 1, 3);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">13</span>
                    <span class="task-title">Вырезание части массива</span>
                </div>
                <div class="task-description">
                    Дан массив с элементами 1, 2, 3, 4, 5. С помощью функции array_slice создайте из него массив $result с элементами 2, 3, 4.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5];<br><span style="color: #ffb86c;">$result</span> = <span style="color: #50fa7b;">array_slice</span>(<span style="color: #ffb86c;">$arr</span>, 1, 3);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content">[<?php echo implode(', ', $slice13); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- ARRAY_SPLICE -->
            <div class="section-title">🔧 Работа с array_splice</div>

            <!-- Задача 14 -->
            <?php
            $arr14 = [1, 2, 3, 4, 5];
            array_splice($arr14, 1, 2);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">14</span>
                    <span class="task-title">Удаление элементов</span>
                </div>
                <div class="task-description">
                    Дан массив [1, 2, 3, 4, 5]. С помощью функции array_splice преобразуйте массив в [1, 4, 5].
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5];<br><span style="color: #50fa7b;">array_splice</span>(<span style="color: #ffb86c;">$arr</span>, 1, 2);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content">[<?php echo implode(', ', $arr14); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- Задача 15 -->
            <?php
            $arr15 = [1, 2, 3, 4, 5];
            $spliced15 = array_splice($arr15, 1, 3);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">15</span>
                    <span class="task-title">Извлечение в новый массив</span>
                </div>
                <div class="task-description">
                    Дан массив [1, 2, 3, 4, 5]. С помощью функции array_splice запишите в новый массив элементы [2, 3, 4].
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5];<br><span style="color: #ffb86c;">$newArr</span> = <span style="color: #50fa7b;">array_splice</span>(<span style="color: #ffb86c;">$arr</span>, 1, 3);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Извлеченные элементы</span>
                        <span class="result-content">[<?php echo implode(', ', $spliced15); ?>]</span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Оставшийся массив</span>
                        <span class="result-content">[<?php echo implode(', ', $arr15); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- Задача 16 -->
            <?php
            $arr16 = [1, 2, 3, 4, 5];
            array_splice($arr16, 3, 0, ['a', 'b', 'c']);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">16</span>
                    <span class="task-title">Вставка элементов</span>
                </div>
                <div class="task-description">
                    Дан массив [1, 2, 3, 4, 5]. С помощью функции array_splice сделайте из него массив [1, 2, 3, 'a', 'b', 'c', 4, 5].
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5];<br><span style="color: #50fa7b;">array_splice</span>(<span style="color: #ffb86c;">$arr</span>, 3, 0, [<span style="color: #f1fa8c;">'a'</span>, <span style="color: #f1fa8c;">'b'</span>, <span style="color: #f1fa8c;">'c'</span>]);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content">[<?php echo implode(', ', $arr16); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- Задача 17 -->
            <?php
            $arr17 = [1, 2, 3, 4, 5];
            array_splice($arr17, 1, 0, ['a', 'b']);
            array_splice($arr17, 5, 0, ['c']);
            array_splice($arr17, 7, 0, ['e']);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">17</span>
                    <span class="task-title">Сложная вставка</span>
                </div>
                <div class="task-description">
                    Дан массив [1, 2, 3, 4, 5]. С помощью функции array_splice сделайте из него массив [1, 'a', 'b', 2, 3, 4, 'c', 5, 'e'].
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5];<br><span style="color: #50fa7b;">array_splice</span>(<span style="color: #ffb86c;">$arr</span>, 1, 0, [<span style="color: #f1fa8c;">'a'</span>, <span style="color: #f1fa8c;">'b'</span>]);<br><span style="color: #50fa7b;">array_splice</span>(<span style="color: #ffb86c;">$arr</span>, 5, 0, [<span style="color: #f1fa8c;">'c'</span>]);<br><span style="color: #50fa7b;">array_splice</span>(<span style="color: #ffb86c;">$arr</span>, 7, 0, [<span style="color: #f1fa8c;">'e'</span>]);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content">[<?php echo implode(', ', $arr17); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- ARRAY_KEYS, ARRAY_VALUES, ARRAY_COMBINE -->
            <div class="section-title">🔑 Работа с array_keys, array_values, array_combine</div>

            <!-- Задача 18 -->
            <?php
            $arr18 = ['a' => 1, 'b' => 2, 'c' => 3];
            $keys18 = array_keys($arr18);
            $values18 = array_values($arr18);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">18</span>
                    <span class="task-title">Ключи и значения</span>
                </div>
                <div class="task-description">
                    Дан массив 'a'=>1, 'b'=>2, 'c'=>3. Запишите в массив $keys ключи из этого массива, а в $values – значения.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'a'</span> => 1, <span style="color: #f1fa8c;">'b'</span> => 2, <span style="color: #f1fa8c;">'c'</span> => 3];<br><span style="color: #ffb86c;">$keys</span> = <span style="color: #50fa7b;">array_keys</span>(<span style="color: #ffb86c;">$arr</span>);<br><span style="color: #ffb86c;">$values</span> = <span style="color: #50fa7b;">array_values</span>(<span style="color: #ffb86c;">$arr</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Ключи</span>
                        <span class="result-content">[<?php echo implode(', ', $keys18); ?>]</span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Значения</span>
                        <span class="result-content">[<?php echo implode(', ', $values18); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- Задача 19 -->
            <?php
            $keys19 = ['a', 'b', 'c'];
            $values19 = [1, 2, 3];
            $combined19 = array_combine($keys19, $values19);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">19</span>
                    <span class="task-title">Объединение в ассоциативный массив</span>
                </div>
                <div class="task-description">
                    Даны два массива: ['a', 'b', 'c'] и [1, 2, 3]. Создайте с их помощью массив 'a'=>1, 'b'=>2, 'c'=>3.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$keys</span> = [<span style="color: #f1fa8c;">'a'</span>, <span style="color: #f1fa8c;">'b'</span>, <span style="color: #f1fa8c;">'c'</span>];<br><span style="color: #ffb86c;">$values</span> = [1, 2, 3];<br><span style="color: #ffb86c;">$result</span> = <span style="color: #50fa7b;">array_combine</span>(<span style="color: #ffb86c;">$keys</span>, <span style="color: #ffb86c;">$values</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content"><?php 
                            $str = '';
                            foreach ($combined19 as $k => $v) {
                                $str .= "'$k' => $v, ";
                            }
                            echo rtrim($str, ', ');
                        ?></span>
                    </div>
                </div>
            </div>

            <!-- ARRAY_FLIP, ARRAY_REVERSE -->
            <div class="section-title">🔄 Работа с array_flip, array_reverse</div>

            <!-- Задача 20 -->
            <?php
            $arr20 = ['a' => 1, 'b' => 2, 'c' => 3];
            $flipped20 = array_flip($arr20);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">20</span>
                    <span class="task-title">Обмен ключей и значений</span>
                </div>
                <div class="task-description">
                    Дан массив 'a'=>1, 'b'=>2, 'c'=>3. Поменяйте в нем местами ключи и значения.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'a'</span> => 1, <span style="color: #f1fa8c;">'b'</span> => 2, <span style="color: #f1fa8c;">'c'</span> => 3];<br><span style="color: #ffb86c;">$result</span> = <span style="color: #50fa7b;">array_flip</span>(<span style="color: #ffb86c;">$arr</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content"><?php 
                            $str = '';
                            foreach ($flipped20 as $k => $v) {
                                $str .= "$k => '$v', ";
                            }
                            echo rtrim($str, ', ');
                        ?></span>
                    </div>
                </div>
            </div>

            <!-- Задача 21 -->
            <?php
            $arr21 = [1, 2, 3, 4, 5];
            $reversed21 = array_reverse($arr21);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">21</span>
                    <span class="task-title">Обратный порядок</span>
                </div>
                <div class="task-description">
                    Дан массив с элементами 1, 2, 3, 4, 5. Сделайте из него массив с элементами 5, 4, 3, 2, 1.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5];<br><span style="color: #ffb86c;">$result</span> = <span style="color: #50fa7b;">array_reverse</span>(<span style="color: #ffb86c;">$arr</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content">[<?php echo implode(', ', $reversed21); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- ARRAY_SEARCH -->
            <div class="section-title">🔎 Работа с array_search</div>

            <!-- Задача 22 -->
            <?php
            $arr22 = ['a', '-', 'b', '-', 'c', '-', 'd'];
            $pos22 = array_search('-', $arr22);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">22</span>
                    <span class="task-title">Поиск позиции</span>
                </div>
                <div class="task-description">
                    Дан массив ['a', '-', 'b', '-', 'c', '-', 'd']. Найдите позицию первого элемента '-'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'a'</span>, <span style="color: #f1fa8c;">'-'</span>, <span style="color: #f1fa8c;">'b'</span>, <span style="color: #f1fa8c;">'-'</span>, <span style="color: #f1fa8c;">'c'</span>, <span style="color: #f1fa8c;">'-'</span>, <span style="color: #f1fa8c;">'d'</span>];<br><span style="color: #ffb86c;">$pos</span> = <span style="color: #50fa7b;">array_search</span>(<span style="color: #f1fa8c;">'-'</span>, <span style="color: #ffb86c;">$arr</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$pos</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Позиция</span>
                        <span class="result-content"><?php echo $pos22; ?></span>
                    </div>
                </div>
            </div>

            <!-- Задача 23 -->
            <?php
            $arr23 = ['a', '-', 'b', '-', 'c', '-', 'd'];
            $pos23 = array_search('-', $arr23);
            array_splice($arr23, $pos23, 1);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">23</span>
                    <span class="task-title">Поиск и удаление</span>
                </div>
                <div class="task-description">
                    Дан массив ['a', '-', 'b', '-', 'c', '-', 'd']. Найдите позицию первого элемента '-' и удалите его с помощью функции array_splice.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'a'</span>, <span style="color: #f1fa8c;">'-'</span>, <span style="color: #f1fa8c;">'b'</span>, <span style="color: #f1fa8c;">'-'</span>, <span style="color: #f1fa8c;">'c'</span>, <span style="color: #f1fa8c;">'-'</span>, <span style="color: #f1fa8c;">'d'</span>];<br><span style="color: #ffb86c;">$pos</span> = <span style="color: #50fa7b;">array_search</span>(<span style="color: #f1fa8c;">'-'</span>, <span style="color: #ffb86c;">$arr</span>);<br><span style="color: #50fa7b;">array_splice</span>(<span style="color: #ffb86c;">$arr</span>, <span style="color: #ffb86c;">$pos</span>, 1);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content">[<?php echo implode(', ', $arr23); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- ARRAY_REPLACE -->
            <div class="section-title">🔄 Работа с array_replace</div>

            <!-- Задача 24 -->
            <?php
            $arr24 = ['a', 'b', 'c', 'd', 'e'];
            $replaced24 = array_replace($arr24, [0 => '!', 3 => '!!']);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">24</span>
                    <span class="task-title">Замена элементов по ключам</span>
                </div>
                <div class="task-description">
                    Дан массив ['a', 'b', 'c', 'd', 'e']. Поменяйте элемент с ключом 0 на '!', а элемент с ключом 3 - на '!!'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'a'</span>, <span style="color: #f1fa8c;">'b'</span>, <span style="color: #f1fa8c;">'c'</span>, <span style="color: #f1fa8c;">'d'</span>, <span style="color: #f1fa8c;">'e'</span>];<br><span style="color: #ffb86c;">$result</span> = <span style="color: #50fa7b;">array_replace</span>(<span style="color: #ffb86c;">$arr</span>, [0 => <span style="color: #f1fa8c;">'!'</span>, 3 => <span style="color: #f1fa8c;">'!!'</span>]);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content">[<?php echo implode(', ', $replaced24); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- СОРТИРОВКА -->
            <div class="section-title">📊 Работа с сортировкой</div>

            <!-- Задача 25 -->
            <?php
            $arr25 = ['3' => 'a', '1' => 'c', '2' => 'e', '4' => 'b'];
            $sorted_asc = $arr25;
            asort($sorted_asc);
            $sorted_desc = $arr25;
            arsort($sorted_desc);
            $sorted_key_asc = $arr25;
            ksort($sorted_key_asc);
            $sorted_key_desc = $arr25;
            krsort($sorted_key_desc);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">25</span>
                    <span class="task-title">Различные сортировки</span>
                </div>
                <div class="task-description">
                    Дан массив '3'=>'a', '1'=>'c', '2'=>'e', '4'=>'b'. Попробуйте на нем различные типы сортировок.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'3'</span> => <span style="color: #f1fa8c;">'a'</span>, <span style="color: #f1fa8c;">'1'</span> => <span style="color: #f1fa8c;">'c'</span>, <span style="color: #f1fa8c;">'2'</span> => <span style="color: #f1fa8c;">'e'</span>, <span style="color: #f1fa8c;">'4'</span> => <span style="color: #f1fa8c;">'b'</span>];<br><span style="color: #50fa7b;">asort</span>(<span style="color: #ffb86c;">$arr</span>);   <span style="color: #6272a4;">// по значениям (возрастание)</span><br><span style="color: #50fa7b;">arsort</span>(<span style="color: #ffb86c;">$arr</span>);  <span style="color: #6272a4;">// по значениям (убывание)</span><br><span style="color: #50fa7b;">ksort</span>(<span style="color: #ffb86c;">$arr</span>);   <span style="color: #6272a4;">// по ключам (возрастание)</span><br><span style="color: #50fa7b;">krsort</span>(<span style="color: #ffb86c;">$arr</span>);  <span style="color: #6272a4;">// по ключам (убывание)</span></pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Исходный</span>
                        <span class="result-content">[3 => 'a', 1 => 'c', 2 => 'e', 4 => 'b']</span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">asort (по значению ↑)</span>
                        <span class="result-content"><?php foreach ($sorted_asc as $k => $v) echo "$k => '$v', "; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">arsort (по значению ↓)</span>
                        <span class="result-content"><?php foreach ($sorted_desc as $k => $v) echo "$k => '$v', "; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">ksort (по ключу ↑)</span>
                        <span class="result-content"><?php foreach ($sorted_key_asc as $k => $v) echo "$k => '$v', "; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">krsort (по ключу ↓)</span>
                        <span class="result-content"><?php foreach ($sorted_key_desc as $k => $v) echo "$k => '$v', "; ?></span>
                    </div>
                </div>
            </div>

            <!-- ARRAY_RAND -->
            <div class="section-title">🎲 Работа с array_rand</div>

            <!-- Задача 26 -->
            <?php
            $arr26 = ['a' => 1, 'b' => 2, 'c' => 3];
            $random_key26 = array_rand($arr26);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">26</span>
                    <span class="task-title">Случайный ключ</span>
                </div>
                <div class="task-description">
                    Дан массив с элементами 'a'=>1, 'b'=>2, 'c'=>3. Выведите на экран случайный ключ из данного массива.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'a'</span> => 1, <span style="color: #f1fa8c;">'b'</span> => 2, <span style="color: #f1fa8c;">'c'</span> => 3];<br><span style="color: #ffb86c;">$key</span> = <span style="color: #50fa7b;">array_rand</span>(<span style="color: #ffb86c;">$arr</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$key</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Случайный ключ</span>
                        <span class="result-content"><?php echo $random_key26; ?></span>
                    </div>
                </div>
            </div>

            <!-- Задача 27 -->
            <?php
            $arr27 = ['a' => 1, 'b' => 2, 'c' => 3];
            $random_key27 = array_rand($arr27);
            $random_value27 = $arr27[$random_key27];
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">27</span>
                    <span class="task-title">Случайный элемент</span>
                </div>
                <div class="task-description">
                    Дан массив с элементами 'a'=>1, 'b'=>2, 'c'=>3. Выведите на экран случайный элемент данного массива.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'a'</span> => 1, <span style="color: #f1fa8c;">'b'</span> => 2, <span style="color: #f1fa8c;">'c'</span> => 3];<br><span style="color: #ffb86c;">$key</span> = <span style="color: #50fa7b;">array_rand</span>(<span style="color: #ffb86c;">$arr</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$arr</span>[<span style="color: #ffb86c;">$key</span>];</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Случайный элемент</span>
                        <span class="result-content"><?php echo $random_value27; ?></span>
                    </div>
                </div>
            </div>

            <!-- SHUFFLE -->
            <div class="section-title">🎴 Работа с shuffle</div>

            <!-- Задача 28 -->
            <?php
            $arr28 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
            $shuffled28 = $arr28;
            shuffle($shuffled28);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">28</span>
                    <span class="task-title">Перемешивание массива</span>
                </div>
                <div class="task-description">
                    Дан массив $arr. Перемешайте его элементы в случайном порядке.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];<br><span style="color: #50fa7b;">shuffle</span>(<span style="color: #ffb86c;">$arr</span>);<br><span style="color: #50fa7b;">print_r</span>(<span style="color: #ffb86c;">$arr</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Перемешанный массив</span>
                        <span class="result-content">[<?php echo implode(', ', $shuffled28); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- Задача 29 -->
            <?php
            $arr29 = range(1, 25);
            shuffle($arr29);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">29</span>
                    <span class="task-title">Числа от 1 до 25 в случайном порядке</span>
                </div>
                <div class="task-description">
                    Заполните массив числами от 1 до 25 с помощью range, а затем перемешайте его элементы в случайном порядке.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = <span style="color: #50fa7b;">range</span>(1, 25);<br><span style="color: #50fa7b;">shuffle</span>(<span style="color: #ffb86c;">$arr</span>);<br><span style="color: #50fa7b;">print_r</span>(<span style="color: #ffb86c;">$arr</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Перемешанный массив</span>
                        <span class="result-content multiline">[<?php echo implode(', ', array_slice($arr29, 0, 15)); ?>...]</span>
                    </div>
                </div>
            </div>

            <!-- Задача 30 -->
            <?php
            $arr30 = range('a', 'z');
            shuffle($arr30);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">30</span>
                    <span class="task-title">Буквы a-z в случайном порядке</span>
                </div>
                <div class="task-description">
                    Создайте массив, заполненный буквами от 'a' до 'z' так, чтобы буквы шли в случайном порядке и не повторялись.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = <span style="color: #50fa7b;">range</span>(<span style="color: #f1fa8c;">'a'</span>, <span style="color: #f1fa8c;">'z'</span>);<br><span style="color: #50fa7b;">shuffle</span>(<span style="color: #ffb86c;">$arr</span>);<br><span style="color: #50fa7b;">print_r</span>(<span style="color: #ffb86c;">$arr</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Случайный порядок</span>
                        <span class="result-content multiline">[<?php echo implode(', ', array_slice($arr30, 0, 15)); ?>...]</span>
                    </div>
                </div>
            </div>

            <!-- Задача 31 -->
            <?php
            $arr31 = range('a', 'z');
            shuffle($arr31);
            $str31 = implode('', array_slice($arr31, 0, 6));
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">31</span>
                    <span class="task-title">Случайная строка без повторов</span>
                </div>
                <div class="task-description">
                    Сделайте строку длиной 6 символов, состоящую из маленьких английских букв, расположенных в случайном порядке. Буквы не должны повторяться.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$letters</span> = <span style="color: #50fa7b;">range</span>(<span style="color: #f1fa8c;">'a'</span>, <span style="color: #f1fa8c;">'z'</span>);<br><span style="color: #50fa7b;">shuffle</span>(<span style="color: #ffb86c;">$letters</span>);<br><span style="color: #ffb86c;">$str</span> = <span style="color: #50fa7b;">implode</span>(<span style="color: #f1fa8c;">''</span>, <span style="color: #50fa7b;">array_slice</span>(<span style="color: #ffb86c;">$letters</span>, 0, 6));<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$str</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Случайная строка</span>
                        <span class="result-content"><?php echo $str31; ?></span>
                    </div>
                </div>
            </div>

            <!-- ARRAY_UNIQUE -->
            <div class="section-title">🔍 Работа с array_unique</div>

            <!-- Задача 32 -->
            <?php
            $arr32 = ['a', 'b', 'c', 'b', 'a'];
            $unique32 = array_unique($arr32);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">32</span>
                    <span class="task-title">Удаление дубликатов</span>
                </div>
                <div class="task-description">
                    Дан массив с элементами 'a', 'b', 'c', 'b', 'a'. Удалите из него повторяющиеся элементы.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'a'</span>, <span style="color: #f1fa8c;">'b'</span>, <span style="color: #f1fa8c;">'c'</span>, <span style="color: #f1fa8c;">'b'</span>, <span style="color: #f1fa8c;">'a'</span>];<br><span style="color: #ffb86c;">$result</span> = <span style="color: #50fa7b;">array_unique</span>(<span style="color: #ffb86c;">$arr</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content">[<?php echo implode(', ', $unique32); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- ARRAY_SHIFT, ARRAY_POP, ARRAY_UNSHIFT, ARRAY_PUSH -->
            <div class="section-title">📥 Работа с array_shift, array_pop, array_unshift, array_push</div>

            <!-- Задача 33 -->
            <?php
            $arr33 = [1, 2, 3, 4, 5];
            $first33 = array_shift($arr33);
            $last33 = array_pop($arr33);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">33</span>
                    <span class="task-title">Первый и последний элемент</span>
                </div>
                <div class="task-description">
                    Дан массив с элементами 1, 2, 3, 4, 5. Выведите на экран его первый и последний элемент, причем так, чтобы в исходном массиве они исчезли.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5];<br><span style="color: #ffb86c;">$first</span> = <span style="color: #50fa7b;">array_shift</span>(<span style="color: #ffb86c;">$arr</span>);<br><span style="color: #ffb86c;">$last</span> = <span style="color: #50fa7b;">array_pop</span>(<span style="color: #ffb86c;">$arr</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Первый элемент</span>
                        <span class="result-content"><?php echo $first33; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Последний элемент</span>
                        <span class="result-content"><?php echo $last33; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Оставшийся массив</span>
                        <span class="result-content">[<?php echo implode(', ', $arr33); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- Задача 34 -->
            <?php
            $arr34 = [1, 2, 3, 4, 5];
            array_unshift($arr34, 0);
            array_push($arr34, 6);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">34</span>
                    <span class="task-title">Добавление в начало и конец</span>
                </div>
                <div class="task-description">
                    Дан массив с элементами 1, 2, 3, 4, 5. Добавьте ему в начало элемент 0, а в конец - элемент 6.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5];<br><span style="color: #50fa7b;">array_unshift</span>(<span style="color: #ffb86c;">$arr</span>, 0);<br><span style="color: #50fa7b;">array_push</span>(<span style="color: #ffb86c;">$arr</span>, 6);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content">[<?php echo implode(', ', $arr34); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- Задача 35 -->
            <?php
            $arr35 = [1, 2, 3, 4, 5, 6, 7, 8];
            $result35 = [];
            while (count($arr35) > 0) {
                $result35[] = array_shift($arr35);
                if (count($arr35) > 0) {
                    $result35[] = array_pop($arr35);
                }
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">35</span>
                    <span class="task-title">Чередование</span>
                </div>
                <div class="task-description">
                    Дан массив с элементами 1, 2, 3, 4, 5, 6, 7, 8. С помощью цикла и функций array_shift и array_pop выведите на экран его элементы в следующем порядке: 1 8 2 7 3 6 4 5.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5, 6, 7, 8];<br><span style="color: #ffb86c;">$result</span> = [];<br><span style="color: #50fa7b;">while</span> (<span style="color: #50fa7b;">count</span>(<span style="color: #ffb86c;">$arr</span>) > 0) {<br>    <span style="color: #ffb86c;">$result</span>[] = <span style="color: #50fa7b;">array_shift</span>(<span style="color: #ffb86c;">$arr</span>);<br>    <span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">count</span>(<span style="color: #ffb86c;">$arr</span>) > 0) {<br>        <span style="color: #ffb86c;">$result</span>[] = <span style="color: #50fa7b;">array_pop</span>(<span style="color: #ffb86c;">$arr</span>);<br>    }<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content">[<?php echo implode(', ', $result35); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- ARRAY_PAD, ARRAY_FILL, ARRAY_FILL_KEYS, ARRAY_CHUNK -->
            <div class="section-title">📦 Работа с array_pad, array_fill, array_fill_keys, array_chunk</div>

            <!-- Задача 36 -->
            <?php
            $arr36 = ['a', 'b', 'c'];
            $padded36 = array_pad($arr36, 6, '-');
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">36</span>
                    <span class="task-title">Дополнение массива</span>
                </div>
                <div class="task-description">
                    Дан массив с элементами 'a', 'b', 'c'. Сделайте из него массив с элементами 'a', 'b', 'c', '-', '-', '-'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'a'</span>, <span style="color: #f1fa8c;">'b'</span>, <span style="color: #f1fa8c;">'c'</span>];<br><span style="color: #ffb86c;">$result</span> = <span style="color: #50fa7b;">array_pad</span>(<span style="color: #ffb86c;">$arr</span>, 6, <span style="color: #f1fa8c;">'-'</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content">[<?php echo implode(', ', $padded36); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- Задача 37 -->
            <?php
            $arr37 = array_fill(0, 10, 'x');
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">37</span>
                    <span class="task-title">Заполнение массива</span>
                </div>
                <div class="task-description">
                    Заполните массив 10-ю буквами 'x'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = <span style="color: #50fa7b;">array_fill</span>(0, 10, <span style="color: #f1fa8c;">'x'</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content">[<?php echo implode(', ', $arr37); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- Задача 38 -->
            <?php
            $arr38 = range(1, 20);
            $chunked38 = array_chunk($arr38, 4);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">38</span>
                    <span class="task-title">Разбиение на подмассивы</span>
                </div>
                <div class="task-description">
                    Создайте массив, заполненный целыми числами от 1 до 20. С помощью функции array_chunk разбейте этот массив на 5 подмассивов ([1, 2, 3, 4]; [5, 6, 7, 8] и т.д.).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = <span style="color: #50fa7b;">range</span>(1, 20);<br><span style="color: #ffb86c;">$result</span> = <span style="color: #50fa7b;">array_chunk</span>(<span style="color: #ffb86c;">$arr</span>, 4);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content multiline"><?php 
                            foreach ($chunked38 as $chunk) {
                                echo '[' . implode(', ', $chunk) . '] ';
                            }
                        ?></span>
                    </div>
                </div>
            </div>

            <!-- ARRAY_COUNT_VALUES -->
            <div class="section-title">📊 Работа с array_count_values</div>

            <!-- Задача 39 -->
            <?php
            $arr39 = ['a', 'b', 'c', 'b', 'a'];
            $counts39 = array_count_values($arr39);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">39</span>
                    <span class="task-title">Подсчет вхождений</span>
                </div>
                <div class="task-description">
                    Дан массив с элементами 'a', 'b', 'c', 'b', 'a'. Подсчитайте сколько раз встречается каждая из букв.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'a'</span>, <span style="color: #f1fa8c;">'b'</span>, <span style="color: #f1fa8c;">'c'</span>, <span style="color: #f1fa8c;">'b'</span>, <span style="color: #f1fa8c;">'a'</span>];<br><span style="color: #ffb86c;">$counts</span> = <span style="color: #50fa7b;">array_count_values</span>(<span style="color: #ffb86c;">$arr</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content"><?php 
                            foreach ($counts39 as $char => $count) {
                                echo "'$char' => $count, ";
                            }
                        ?></span>
                    </div>
                </div>
            </div>

            <!-- ARRAY_MAP -->
            <div class="section-title">🗺️ Работа с array_map</div>

            <!-- Задача 40 -->
            <?php
            $arr40 = [1, 2, 3, 4, 5];
            $sqrt40 = array_map('sqrt', $arr40);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">40</span>
                    <span class="task-title">Квадратные корни</span>
                </div>
                <div class="task-description">
                    Дан массив с элементами 1, 2, 3, 4, 5. Создайте новый массив, в котором будут лежать квадратные корни данных элементов.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5];<br><span style="color: #ffb86c;">$result</span> = <span style="color: #50fa7b;">array_map</span>(<span style="color: #f1fa8c;">'sqrt'</span>, <span style="color: #ffb86c;">$arr</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content">[<?php echo implode(', ', array_map(function($n) { return round($n, 2); }, $sqrt40)); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- Задача 41 -->
            <?php
            $arr41 = ['<b>php</b>', '<i>html</i>'];
            $striped41 = array_map('strip_tags', $arr41);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">41</span>
                    <span class="task-title">Удаление тегов</span>
                </div>
                <div class="task-description">
                    Дан массив с элементами '<b>php</b>', '<i>html</i>'. Создайте новый массив, в котором из элементов будут удалены теги.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'&lt;b&gt;php&lt;/b&gt;'</span>, <span style="color: #f1fa8c;">'&lt;i&gt;html&lt;/i&gt;'</span>];<br><span style="color: #ffb86c;">$result</span> = <span style="color: #50fa7b;">array_map</span>(<span style="color: #f1fa8c;">'strip_tags'</span>, <span style="color: #ffb86c;">$arr</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content">[<?php echo implode(', ', $striped41); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- Задача 42 -->
            <?php
            $arr42 = [' a ', ' b ', ' c '];
            $trimmed42 = array_map('trim', $arr42);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">42</span>
                    <span class="task-title">Удаление пробелов</span>
                </div>
                <div class="task-description">
                    Дан массив с элементами ' a ', ' b ', ' с '. Создайте новый массив, в котором будут данные элементы без концевых пробелов.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">' a '</span>, <span style="color: #f1fa8c;">' b '</span>, <span style="color: #f1fa8c;">' c '</span>];<br><span style="color: #ffb86c;">$result</span> = <span style="color: #50fa7b;">array_map</span>(<span style="color: #f1fa8c;">'trim'</span>, <span style="color: #ffb86c;">$arr</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content">[<?php echo implode(', ', $trimmed42); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- ARRAY_INTERSECT, ARRAY_DIFF -->
            <div class="section-title">🔗 Работа с array_intersect, array_diff</div>

            <!-- Задача 43 -->
            <?php
            $arr43_1 = [1, 2, 3, 4, 5];
            $arr43_2 = [3, 4, 5, 6, 7];
            $intersect43 = array_intersect($arr43_1, $arr43_2);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">43</span>
                    <span class="task-title">Общие элементы</span>
                </div>
                <div class="task-description">
                    Дан массив с элементами 1, 2, 3, 4, 5 и массив с элементами 3, 4, 5, 6, 7. Запишите в новый массив элементы, которые есть и в том, и в другом массиве.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr1</span> = [1, 2, 3, 4, 5];<br><span style="color: #ffb86c;">$arr2</span> = [3, 4, 5, 6, 7];<br><span style="color: #ffb86c;">$result</span> = <span style="color: #50fa7b;">array_intersect</span>(<span style="color: #ffb86c;">$arr1</span>, <span style="color: #ffb86c;">$arr2</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Общие элементы</span>
                        <span class="result-content">[<?php echo implode(', ', $intersect43); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- Задача 44 -->
            <?php
            $arr44_1 = [1, 2, 3, 4, 5];
            $arr44_2 = [3, 4, 5, 6, 7];
            $diff44 = array_merge(array_diff($arr44_1, $arr44_2), array_diff($arr44_2, $arr44_1));
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">44</span>
                    <span class="task-title">Уникальные элементы</span>
                </div>
                <div class="task-description">
                    Дан массив с элементами 1, 2, 3, 4, 5 и массив с элементами 3, 4, 5, 6, 7. Запишите в новый массив элементы, которые не присутствуют в обоих массивах одновременно.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr1</span> = [1, 2, 3, 4, 5];<br><span style="color: #ffb86c;">$arr2</span> = [3, 4, 5, 6, 7];<br><span style="color: #ffb86c;">$result</span> = <span style="color: #50fa7b;">array_merge</span>(<br>    <span style="color: #50fa7b;">array_diff</span>(<span style="color: #ffb86c;">$arr1</span>, <span style="color: #ffb86c;">$arr2</span>),<br>    <span style="color: #50fa7b;">array_diff</span>(<span style="color: #ffb86c;">$arr2</span>, <span style="color: #ffb86c;">$arr1</span>)<br>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Уникальные элементы</span>
                        <span class="result-content">[<?php echo implode(', ', $diff44); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- ЗАДАЧИ -->
            <div class="section-title">⭐ Задачи</div>

            <!-- Задача 45 -->
            <?php
            $str45 = '1234567890';
            $sum45 = array_sum(str_split($str45));
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">45</span>
                    <span class="task-title">Сумма цифр строки</span>
                </div>
                <div class="task-description">
                    Дана строка '1234567890'. Найдите сумму цифр из этой строки не используя цикл.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'1234567890'</span>;<br><span style="color: #ffb86c;">$sum</span> = <span style="color: #50fa7b;">array_sum</span>(<span style="color: #50fa7b;">str_split</span>(<span style="color: #ffb86c;">$str</span>));</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content"><?php echo $sum45; ?></span>
                    </div>
                </div>
            </div>

            <!-- Задача 46 -->
            <?php
            $letters46 = range('a', 'z');
            $numbers46 = range(1, 26);
            $arr46 = array_combine($letters46, $numbers46);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">46</span>
                    <span class="task-title">Массив буква-число</span>
                </div>
                <div class="task-description">
                    Создайте массив ['a'=>1, 'b'=>2 ... 'z'=>26] не используя цикл.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$letters</span> = <span style="color: #50fa7b;">range</span>(<span style="color: #f1fa8c;">'a'</span>, <span style="color: #f1fa8c;">'z'</span>);<br><span style="color: #ffb86c;">$numbers</span> = <span style="color: #50fa7b;">range</span>(1, 26);<br><span style="color: #ffb86c;">$result</span> = <span style="color: #50fa7b;">array_combine</span>(<span style="color: #ffb86c;">$letters</span>, <span style="color: #ffb86c;">$numbers</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content multiline"><?php 
                            $counter = 0;
                            foreach ($arr46 as $k => $v) {
                                echo "$k => $v, ";
                                $counter++;
                                if ($counter >= 10) {
                                    echo '...';
                                    break;
                                }
                            }
                        ?></span>
                    </div>
                </div>
            </div>

            <!-- Задача 47 -->
            <?php
            $arr47 = array_chunk(range(1, 9), 3);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">47</span>
                    <span class="task-title">Массив 3x3</span>
                </div>
                <div class="task-description">
                    Создайте массив вида [[1, 2, 3], [4, 5, 6], [7, 8, 9]] не используя цикл.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = <span style="color: #50fa7b;">array_chunk</span>(<span style="color: #50fa7b;">range</span>(1, 9), 3);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content multiline">[
    [<?php echo implode(', ', $arr47[0]); ?>],
    [<?php echo implode(', ', $arr47[1]); ?>],
    [<?php echo implode(', ', $arr47[2]); ?>]
]</span>
                    </div>
                </div>
            </div>

            <!-- Задача 48 -->
            <?php
            $arr48 = [1, 2, 4, 5, 5];
            $unique48 = array_unique($arr48);
            rsort($unique48);
            $second_largest48 = $unique48[1];
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">48</span>
                    <span class="task-title">Второй по величине элемент</span>
                </div>
                <div class="task-description">
                    Дан массив с элементами 1, 2, 4, 5, 5. Найдите второй по величине элемент. В нашем случае это будет 4.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 4, 5, 5];<br><span style="color: #ffb86c;">$unique</span> = <span style="color: #50fa7b;">array_unique</span>(<span style="color: #ffb86c;">$arr</span>);<br><span style="color: #50fa7b;">rsort</span>(<span style="color: #ffb86c;">$unique</span>);<br><span style="color: #ffb86c;">$second</span> = <span style="color: #ffb86c;">$unique</span>[1];</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Второй по величине</span>
                        <span class="result-content"><?php echo $second_largest48; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>