<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Самостоятельная работа 1-2: Математические функции PHP</title>
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
            color: #1e3c72;
            margin-bottom: 20px;
            font-size: 1.8rem;
            border-bottom: 2px solid #2a5298;
            padding-bottom: 10px;
        }

        .example-section h3 {
            color: #1e3c72;
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
            max-height: 250px;
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
                max-height: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Самостоятельная работа 1-2</h1>
            <p>Математические функции PHP</p>
        </div>

        <!-- ПРИМЕРЫ РЕШЕНИЯ ЗАДАЧ -->
        <div class="example-section">
            <h2>📚 Примеры решения задач</h2>
            
            <h3>Задача 1. Округление и ассоциативный массив</h3>
            <p>Найдите корень из числа 1000. Округлите его в большую и меньшую стороны. В массив $arr запишите первым элементом корень из числа, вторым элементом - округление в меньшую сторону, третьим элементом - в большую.</p>
            <div class="code-example">
                <pre><span style="color: #ffb86c;">$sqrt</span> = <span style="color: #50fa7b;">sqrt</span>(1000);
<span style="color: #ffb86c;">$arr</span> = [<span style="color: #ffb86c;">$sqrt</span>, <span style="color: #50fa7b;">floor</span>(<span style="color: #ffb86c;">$sqrt</span>), <span style="color: #50fa7b;">ceil</span>(<span style="color: #ffb86c;">$sqrt</span>)];

<span style="color: #6272a4;">// Результат:</span>
<span style="color: #50fa7b;">print_r</span>(<span style="color: #ffb86c;">$arr</span>);</pre>
            </div>
            <?php
            $sqrt_example = sqrt(1000);
            $arr_example = [$sqrt_example, floor($sqrt_example), ceil($sqrt_example)];
            ?>
            <div class="result-item" style="background: #c6f6d5; border-radius: 12px; padding: 15px; margin-top: 15px;">
                <span class="result-label">Результат</span>
                <span class="result-content">[<?php echo round($arr_example[0], 3); ?>, <?php echo $arr_example[1]; ?>, <?php echo $arr_example[2]; ?>]</span>
            </div>

            <h3 style="margin-top: 30px;">Задача 2. Массив случайных чисел</h3>
            <p>Заполните массив 30-ю случайными числами от 1 до 10.</p>
            <div class="code-example">
                <pre><span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = 1; <span style="color: #ffb86c;">$i</span> <= 30; <span style="color: #ffb86c;">$i</span>++) {
    <span style="color: #ffb86c;">$arr</span>[] = <span style="color: #50fa7b;">mt_rand</span>(1, 10);
}
<span style="color: #50fa7b;">print_r</span>(<span style="color: #ffb86c;">$arr</span>);</pre>
            </div>
            <?php
            $arr_random = [];
            for ($i = 1; $i <= 30; $i++) {
                $arr_random[] = mt_rand(1, 10);
            }
            ?>
            <div class="result-item" style="background: #c6f6d5; border-radius: 12px; padding: 15px; margin-top: 15px;">
                <span class="result-label">Результат</span>
                <span class="result-content multiline"><?php echo implode(', ', $arr_random); ?></span>
            </div>
        </div>

        <div class="tasks-grid">
            <!-- РАБОТА С % -->
            <div class="section-title">🔢 Работа с %</div>

            <!-- Задача 1 -->
            <?php
            $a1 = 10;
            $b1 = 3;
            $remainder1 = $a1 % $b1;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">1</span>
                    <span class="task-title">Остаток от деления</span>
                </div>
                <div class="task-description">
                    Даны переменные $a=10 и $b=3. Найдите остаток от деления $a на $b.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$a</span> = 10;<br><span style="color: #ffb86c;">$b</span> = 3;<br><span style="color: #ffb86c;">$remainder</span> = <span style="color: #ffb86c;">$a</span> % <span style="color: #ffb86c;">$b</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$remainder</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content"><?php echo $remainder1; ?></span>
                    </div>
                </div>
            </div>

            <!-- Задача 2 -->
            <?php
            $a2 = 15;
            $b2 = 4;
            $result2 = ($a2 % $b2 == 0) ? "Делится, результат: " . ($a2 / $b2) : "Делится с остатком, остаток: " . ($a2 % $b2);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">Проверка деления</span>
                </div>
                <div class="task-description">
                    Даны переменные $a и $b. Проверьте, что $a делится без остатка на $b. Если это так - выведите 'Делится' и результат деления, иначе выведите 'Делится с остатком' и остаток от деления.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$a</span> = 15;<br><span style="color: #ffb86c;">$b</span> = 4;<br><span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$a</span> % <span style="color: #ffb86c;">$b</span> == 0) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Делится, результат: "</span> . (<span style="color: #ffb86c;">$a</span> / <span style="color: #ffb86c;">$b</span>);<br>} <span style="color: #50fa7b;">else</span> {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Делится с остатком, остаток: "</span> . (<span style="color: #ffb86c;">$a</span> % <span style="color: #ffb86c;">$b</span>);<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content"><?php echo $result2; ?></span>
                    </div>
                </div>
            </div>

            <!-- СТЕПЕНЬ И КОРЕНЬ -->
            <div class="section-title">⚡ Работа со степенью и корнем</div>

            <!-- Задача 3 -->
            <?php
            $st3 = pow(2, 10);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">3</span>
                    <span class="task-title">Возведение в степень</span>
                </div>
                <div class="task-description">
                    Возведите 2 в 10 степень. Результат запишите в переменную $st.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$st</span> = <span style="color: #50fa7b;">pow</span>(2, 10);<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$st</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content"><?php echo $st3; ?></span>
                    </div>
                </div>
            </div>

            <!-- Задача 4 -->
            <?php
            $sqrt4 = sqrt(245);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4</span>
                    <span class="task-title">Квадратный корень</span>
                </div>
                <div class="task-description">
                    Найдите квадратный корень из 245.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$sqrt</span> = <span style="color: #50fa7b;">sqrt</span>(245);<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$sqrt</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content"><?php echo round($sqrt4, 3); ?></span>
                    </div>
                </div>
            </div>

            <!-- Задача 5 -->
            <?php
            $arr5 = [4, 2, 5, 19, 13, 0, 10];
            $sum_squares5 = 0;
            foreach ($arr5 as $num) {
                $sum_squares5 += $num * $num;
            }
            $sqrt5 = sqrt($sum_squares5);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">5</span>
                    <span class="task-title">Корень из суммы квадратов</span>
                </div>
                <div class="task-description">
                    Дан массив с элементами 4, 2, 5, 19, 13, 0, 10. Найдите корень из суммы квадратов его элементов.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [4, 2, 5, 19, 13, 0, 10];<br><span style="color: #ffb86c;">$sum</span> = 0;<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$num</span>) {<br>    <span style="color: #ffb86c;">$sum</span> += <span style="color: #ffb86c;">$num</span> * <span style="color: #ffb86c;">$num</span>;<br>}<br><span style="color: #ffb86c;">$result</span> = <span style="color: #50fa7b;">sqrt</span>(<span style="color: #ffb86c;">$sum</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$result</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content"><?php echo round($sqrt5, 3); ?></span>
                    </div>
                </div>
            </div>

            <!-- ОКРУГЛЕНИЕ -->
            <div class="section-title">🔄 Работа с функциями округления</div>

            <!-- Задача 6 -->
            <?php
            $sqrt6 = sqrt(379);
            $round_int = round($sqrt6);
            $round_tenth = round($sqrt6, 1);
            $round_hundredth = round($sqrt6, 2);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">6</span>
                    <span class="task-title">Округление корня</span>
                </div>
                <div class="task-description">
                    Найдите квадратный корень из 379. Результат округлите до целых, до десятых, до сотых.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$sqrt</span> = <span style="color: #50fa7b;">sqrt</span>(379);<br><span style="color: #ffb86c;">$to_int</span> = <span style="color: #50fa7b;">round</span>(<span style="color: #ffb86c;">$sqrt</span>);<br><span style="color: #ffb86c;">$to_tenth</span> = <span style="color: #50fa7b;">round</span>(<span style="color: #ffb86c;">$sqrt</span>, 1);<br><span style="color: #ffb86c;">$to_hundredth</span> = <span style="color: #50fa7b;">round</span>(<span style="color: #ffb86c;">$sqrt</span>, 2);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Корень</span>
                        <span class="result-content"><?php echo round($sqrt6, 5); ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">До целых</span>
                        <span class="result-content"><?php echo $round_int; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">До десятых</span>
                        <span class="result-content"><?php echo $round_tenth; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">До сотых</span>
                        <span class="result-content"><?php echo $round_hundredth; ?></span>
                    </div>
                </div>
            </div>

            <!-- Задача 7 -->
            <?php
            $sqrt7 = sqrt(587);
            $floor7 = floor($sqrt7);
            $ceil7 = ceil($sqrt7);
            $arr7 = ['floor' => $floor7, 'ceil' => $ceil7];
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">7</span>
                    <span class="task-title">Округление в ассоциативный массив</span>
                </div>
                <div class="task-description">
                    Найдите квадратный корень из 587. Округлите результат в большую и меньшую сторону, запишите результаты округления в ассоциативный массив с ключами 'floor' и 'ceil'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$sqrt</span> = <span style="color: #50fa7b;">sqrt</span>(587);<br><span style="color: #ffb86c;">$arr</span> = [<br>    <span style="color: #f1fa8c;">'floor'</span> => <span style="color: #50fa7b;">floor</span>(<span style="color: #ffb86c;">$sqrt</span>),<br>    <span style="color: #f1fa8c;">'ceil'</span> => <span style="color: #50fa7b;">ceil</span>(<span style="color: #ffb86c;">$sqrt</span>)<br>];</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Корень</span>
                        <span class="result-content"><?php echo round($sqrt7, 3); ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">floor (меньшая сторона)</span>
                        <span class="result-content"><?php echo $arr7['floor']; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">ceil (большая сторона)</span>
                        <span class="result-content"><?php echo $arr7['ceil']; ?></span>
                    </div>
                </div>
            </div>

            <!-- MIN и MAX -->
            <div class="section-title">📊 Работа с min и max</div>

            <!-- Задача 8 -->
            <?php
            $numbers8 = [4, -2, 5, 19, -130, 0, 10];
            $min8 = min($numbers8);
            $max8 = max($numbers8);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">8</span>
                    <span class="task-title">Минимум и максимум</span>
                </div>
                <div class="task-description">
                    Даны числа 4, -2, 5, 19, -130, 0, 10. Найдите минимальное и максимальное число.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$numbers</span> = [4, -2, 5, 19, -130, 0, 10];<br><span style="color: #ffb86c;">$min</span> = <span style="color: #50fa7b;">min</span>(<span style="color: #ffb86c;">$numbers</span>);<br><span style="color: #ffb86c;">$max</span> = <span style="color: #50fa7b;">max</span>(<span style="color: #ffb86c;">$numbers</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Минимальное</span>
                        <span class="result-content"><?php echo $min8; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Максимальное</span>
                        <span class="result-content"><?php echo $max8; ?></span>
                    </div>
                </div>
            </div>

            <!-- РАНДОМ -->
            <div class="section-title">🎲 Работа с рандомом</div>

            <!-- Задача 9 -->
            <?php
            $random9 = mt_rand(1, 100);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">9</span>
                    <span class="task-title">Случайное число</span>
                </div>
                <div class="task-description">
                    Выведите на экран случайное число от 1 до 100.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">mt_rand</span>(1, 100);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content"><?php echo $random9; ?></span>
                    </div>
                </div>
            </div>

            <!-- Задача 10 -->
            <?php
            $arr10 = [];
            for ($i = 0; $i < 10; $i++) {
                $arr10[] = mt_rand(1, 100);
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">10</span>
                    <span class="task-title">Массив случайных чисел</span>
                </div>
                <div class="task-description">
                    Заполните массив 10-ю случайными числами.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [];<br><span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = 0; <span style="color: #ffb86c;">$i</span> < 10; <span style="color: #ffb86c;">$i</span>++) {<br>    <span style="color: #ffb86c;">$arr</span>[] = <span style="color: #50fa7b;">mt_rand</span>(1, 100);<br>}<br><span style="color: #50fa7b;">print_r</span>(<span style="color: #ffb86c;">$arr</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content multiline"><?php echo implode(', ', $arr10); ?></span>
                    </div>
                </div>
            </div>

            <!-- МОДУЛЬ -->
            <div class="section-title">📐 Работа с модулем</div>

            <!-- Задача 11 -->
            <?php
            $a11 = 15;
            $b11 = 25;
            $diff11 = abs($a11 - $b11);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">11</span>
                    <span class="task-title">Модуль разности</span>
                </div>
                <div class="task-description">
                    Даны переменные $a и $b. Найдите модуль разности $a и $b.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$a</span> = 15;<br><span style="color: #ffb86c;">$b</span> = 25;<br><span style="color: #ffb86c;">$diff</span> = <span style="color: #50fa7b;">abs</span>(<span style="color: #ffb86c;">$a</span> - <span style="color: #ffb86c;">$b</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$diff</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">a=15, b=25</span>
                        <span class="result-content">|15 - 25| = <?php echo $diff11; ?></span>
                    </div>
                </div>
            </div>

            <!-- Задача 12 -->
            <?php
            $arr12 = [1, 2, -1, -2, 3, -3];
            $new_arr12 = [];
            foreach ($arr12 as $num) {
                $new_arr12[] = abs($num);
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">12</span>
                    <span class="task-title">Преобразование отрицательных чисел</span>
                </div>
                <div class="task-description">
                    Дан массив [1, 2, -1, -2, 3, -3]. Создайте из него новый массив так, чтобы отрицательные числа стали положительными.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, -1, -2, 3, -3];<br><span style="color: #ffb86c;">$new_arr</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$num</span>) {<br>    <span style="color: #ffb86c;">$new_arr</span>[] = <span style="color: #50fa7b;">abs</span>(<span style="color: #ffb86c;">$num</span>);<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Исходный массив</span>
                        <span class="result-content">[1, 2, -1, -2, 3, -3]</span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Преобразованный</span>
                        <span class="result-content">[<?php echo implode(', ', $new_arr12); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- ЗАДАЧИ -->
            <div class="section-title">⭐ Задачи</div>

            <!-- Задача 13 -->
            <?php
            $num13 = 30;
            $divisors13 = [];
            for ($i = 1; $i <= $num13; $i++) {
                if ($num13 % $i == 0) {
                    $divisors13[] = $i;
                }
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">13</span>
                    <span class="task-title">Делители числа</span>
                </div>
                <div class="task-description">
                    Дано число, например 30. Найдите все делители этого числа и запишите их в массив.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$num</span> = 30;<br><span style="color: #ffb86c;">$divisors</span> = [];<br><span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = 1; <span style="color: #ffb86c;">$i</span> <= <span style="color: #ffb86c;">$num</span>; <span style="color: #ffb86c;">$i</span>++) {<br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$num</span> % <span style="color: #ffb86c;">$i</span> == 0) {<br>        <span style="color: #ffb86c;">$divisors</span>[] = <span style="color: #ffb86c;">$i</span>;<br>    }<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Число <?php echo $num13; ?></span>
                        <span class="result-content">Делители: [<?php echo implode(', ', $divisors13); ?>]</span>
                    </div>
                </div>
            </div>

            <!-- Задача 14 -->
            <?php
            $arr14 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
            $sum14 = 0;
            $count14 = 0;
            foreach ($arr14 as $num) {
                if ($sum14 > 10) {
                    break;
                }
                $sum14 += $num;
                $count14++;
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">14</span>
                    <span class="task-title">Сумма первых элементов</span>
                </div>
                <div class="task-description">
                    Дан массив [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]. Узнайте, сколько первых элементов массива нужно сложить, чтобы сумма получилась больше 10.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];<br><span style="color: #ffb86c;">$sum</span> = 0;<br><span style="color: #ffb86c;">$count</span> = 0;<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$num</span>) {<br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$sum</span> > 10) <span style="color: #50fa7b;">break</span>;<br>    <span style="color: #ffb86c;">$sum</span> += <span style="color: #ffb86c;">$num</span>;<br>    <span style="color: #ffb86c;">$count</span>++;<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Количество элементов</span>
                        <span class="result-content"><?php echo $count14; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Сумма</span>
                        <span class="result-content"><?php echo $sum14; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Проверка</span>
                        <span class="result-content">Сумма первых <?php echo $count14; ?> элементов = <?php echo array_sum(array_slice($arr14, 0, $count14)); ?> (больше 10)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>