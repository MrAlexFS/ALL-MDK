<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Практическая работа №14-15: Серверные сценарии PHP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #1E2A3A 0%, #2C3E50 100%);
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
            background: linear-gradient(135deg, #1E2A3A 0%, #2C3E50 100%);
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
            box-shadow: 0 4px 10px rgba(44, 62, 80, 0.3);
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
            border-left: 4px solid #2C3E50;
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
            max-height: 250px;
            overflow-y: auto;
        }

        .result-content.scrollable {
            max-height: 250px;
            overflow-y: auto;
        }

        .result-table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
        }

        .result-table th {
            background: #38a169;
            color: white;
            padding: 8px;
            font-weight: 600;
            text-align: left;
        }

        .result-table td {
            border: 1px solid #9ae6b4;
            padding: 6px 10px;
            color: #22543d;
        }

        .result-table tr:nth-child(even) {
            background: #f0fff4;
        }

        .color-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 12px;
            padding: 5px;
        }

        .color-item {
            text-align: center;
        }

        .color-box {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            margin: 0 auto 5px;
            border: 1px solid #ccc;
        }

        .color-hex {
            font-size: 10px;
            font-family: monospace;
        }

        .keyword { color: #ff79c6; }
        .string { color: #f1fa8c; }
        .comment { color: #6272a4; }
        .function { color: #50fa7b; }
        .variable { color: #ffb86c; }

        .section-title {
            grid-column: 1 / -1;
            margin: 30px 0 15px;
            color: white;
            font-size: 2rem;
            font-weight: 600;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
            border-left: 6px solid #ffd700;
            padding-left: 20px;
        }

        .developer-card {
            background: white;
            border-radius: 12px;
            padding: 15px;
            color: #2d3748;
        }

        .developer-card h3 {
            color: #22543d;
            margin-bottom: 15px;
            font-size: 1.2rem;
        }

        .developer-card p {
            margin-bottom: 8px;
        }

        .developer-card ul {
            margin-left: 20px;
            margin-top: 5px;
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
            
            .color-grid {
                grid-template-columns: repeat(3, 1fr);
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
            <h1>Практическая работа №14-15</h1>
            <p>Создание серверных сценариев с использованием технологии PHP</p>
        </div>

        <div class="tasks-grid">
            <!-- ЗАДАНИЕ 1 -->
            <div class="section-title">📦 Задание №1: Переменные и вывод данных</div>

            <?php
            // Задание 1 - базовый вывод
            $product1 = "чайник";
            $price1 = 300;
            $product2 = "кофейник";
            $price2 = 150;
            $product3 = "кипятильник";
            $price3 = 270;
            
            $average_price = ($price1 + $price2 + $price3) / 3;
            
            // Табличный вывод
            $product1_tab = "чайник";
            $price1_tab = 1503;
            $product2_tab = "кофейник";
            $price2_tab = 1120;
            $product3_tab = "кипятильник";
            $price3_tab = 220;
            
            $average_tab = ($price1_tab + $price2_tab + $price3_tab) / 3;
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">1.1</span>
                    <span class="task-title">Базовый вывод</span>
                </div>
                <div class="task-description">
                    Создать три переменные с названиями товаров и соответствующие им цены. Вывести на экран и рассчитать среднюю цену.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$product1</span> = <span style="color: #f1fa8c;">"чайник"</span>;<br><span style="color: #ffb86c;">$price1</span> = 300;<br><span style="color: #ffb86c;">$product2</span> = <span style="color: #f1fa8c;">"кофейник"</span>;<br><span style="color: #ffb86c;">$price2</span> = 150;<br><span style="color: #ffb86c;">$product3</span> = <span style="color: #f1fa8c;">"кипятильник"</span>;<br><span style="color: #ffb86c;">$price3</span> = 270;<br><span style="color: #ffb86c;">$average_price</span> = (<span style="color: #ffb86c;">$price1</span> + <span style="color: #ffb86c;">$price2</span> + <span style="color: #ffb86c;">$price3</span>) / 3;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"$product1 => $price1 руб\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"$product2 => $price2 руб\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"$product3 => $price3 руб\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Средняя цена: " . round(<span style="color: #ffb86c;">$average_price</span>, 2) . " руб"</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Товар 1</span>
                        <span class="result-content"><?php echo "$product1 => $price1 руб"; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Товар 2</span>
                        <span class="result-content"><?php echo "$product2 => $price2 руб"; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Товар 3</span>
                        <span class="result-content"><?php echo "$product3 => $price3 руб"; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Средняя цена</span>
                        <span class="result-content"><?php echo round($average_price, 2) . " руб"; ?></span>
                    </div>
                </div>
            </div>

            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">1.2</span>
                    <span class="task-title">Табличный вывод</span>
                </div>
                <div class="task-description">
                    Оформить вывод данных о товарах в виде HTML таблицы (тест с другими ценами).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$product1</span> = <span style="color: #f1fa8c;">"чайник"</span>;<br><span style="color: #ffb86c;">$price1</span> = 1503;<br><span style="color: #ffb86c;">$product2</span> = <span style="color: #f1fa8c;">"кофейник"</span>;<br><span style="color: #ffb86c;">$price2</span> = 1120;<br><span style="color: #ffb86c;">$product3</span> = <span style="color: #f1fa8c;">"кипятильник"</span>;<br><span style="color: #ffb86c;">$price3</span> = 220;<br><span style="color: #ffb86c;">$average</span> = (<span style="color: #ffb86c;">$price1</span> + <span style="color: #ffb86c;">$price2</span> + <span style="color: #ffb86c;">$price3</span>) / 3;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'&lt;table&gt;'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'&lt;tr&gt;&lt;th&gt;Товар&lt;/th&gt;&lt;th&gt;Цена (руб)&lt;/th&gt;&lt;/tr&gt;'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"&lt;tr&gt;&lt;td&gt;$product1&lt;/td&gt;&lt;td&gt;"</span> . <span style="color: #50fa7b;">number_format</span>(<span style="color: #ffb86c;">$price1</span>, 0, <span style="color: #f1fa8c;">''</span>, <span style="color: #f1fa8c;">' '</span>) . <span style="color: #f1fa8c;">"&lt;/td&gt;&lt;/tr&gt;"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"&lt;tr&gt;&lt;td&gt;$product2&lt;/td&gt;&lt;td&gt;"</span> . <span style="color: #50fa7b;">number_format</span>(<span style="color: #ffb86c;">$price2</span>, 0, <span style="color: #f1fa8c;">''</span>, <span style="color: #f1fa8c;">' '</span>) . <span style="color: #f1fa8c;">"&lt;/td&gt;&lt;/tr&gt;"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"&lt;tr&gt;&lt;td&gt;$product3&lt;/td&gt;&lt;td&gt;"</span> . <span style="color: #50fa7b;">number_format</span>(<span style="color: #ffb86c;">$price3</span>, 0, <span style="color: #f1fa8c;">''</span>, <span style="color: #f1fa8c;">' '</span>) . <span style="color: #f1fa8c;">"&lt;/td&gt;&lt;/tr&gt;"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"&lt;tr&gt;&lt;td colspan='2'&gt;&lt;strong&gt;Средняя цена: "</span> . <span style="color: #50fa7b;">number_format</span>(<span style="color: #ffb86c;">$average</span>, 2, <span style="color: #f1fa8c;">'.'</span>, <span style="color: #f1fa8c;">' '</span>) . <span style="color: #f1fa8c;">" руб&lt;/strong&gt;&lt;/td&gt;&lt;/tr&gt;"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'&lt;/table&gt;'</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Таблица</span>
                        <span class="result-content scrollable">
                            <table class="result-table">
                                <tr><th>Товар</th><th>Цена (руб)</th></tr>
                                <tr><td><?php echo $product1_tab; ?></td><td><?php echo number_format($price1_tab, 0, '', ' '); ?></td></tr>
                                <tr><td><?php echo $product2_tab; ?></td><td><?php echo number_format($price2_tab, 0, '', ' '); ?></td></tr>
                                <tr><td><?php echo $product3_tab; ?></td><td><?php echo number_format($price3_tab, 0, '', ' '); ?></td></tr>
                                <tr><td colspan="2"><strong>Средняя цена: <?php echo number_format($average_tab, 2, '.', ' '); ?> руб</strong></td></tr>
                            </table>
                        </span>
                    </div>
                </div>
            </div>

            <!-- ЗАДАНИЕ 2 -->
            <div class="section-title">🏆 Задание №2: Условные инструкции</div>

            <?php
            // Определение самого дорогого товара
            $product1_max = "чайник";
            $price1_max = 300;
            $product2_max = "кофейник";
            $price2_max = 150;
            $product3_max = "кипятильник";
            $price3_max = 260;
            
            // Метод с if-elseif-else
            if ($price1_max >= $price2_max && $price1_max >= $price3_max) {
                $max_price = $price1_max;
                $max_product = $product1_max;
            } elseif ($price2_max >= $price1_max && $price2_max >= $price3_max) {
                $max_price = $price2_max;
                $max_product = $product2_max;
            } else {
                $max_price = $price3_max;
                $max_product = $product3_max;
            }
            
            // Метод вытеснения для минимальной цены
            $min_price = $price1_max;
            $min_product = $product1_max;
            
            if ($price2_max < $min_price) {
                $min_price = $price2_max;
                $min_product = $product2_max;
            }
            if ($price3_max < $min_price) {
                $min_price = $price3_max;
                $min_product = $product3_max;
            }
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">Максимум и минимум</span>
                </div>
                <div class="task-description">
                    Определить самый дорогой товар (if-elseif-else) и самый дешевый (метод вытеснения).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$product1</span> = <span style="color: #f1fa8c;">"чайник"</span>;<br><span style="color: #ffb86c;">$price1</span> = 300;<br><span style="color: #ffb86c;">$product2</span> = <span style="color: #f1fa8c;">"кофейник"</span>;<br><span style="color: #ffb86c;">$price2</span> = 150;<br><span style="color: #ffb86c;">$product3</span> = <span style="color: #f1fa8c;">"кипятильник"</span>;<br><span style="color: #ffb86c;">$price3</span> = 260;<br><br><span style="color: #6272a4;">// Поиск максимума</span><br><span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$price1</span> >= <span style="color: #ffb86c;">$price2</span> && <span style="color: #ffb86c;">$price1</span> >= <span style="color: #ffb86c;">$price3</span>) {<br>    <span style="color: #ffb86c;">$max_price</span> = <span style="color: #ffb86c;">$price1</span>;<br>    <span style="color: #ffb86c;">$max_product</span> = <span style="color: #ffb86c;">$product1</span>;<br>} <span style="color: #50fa7b;">elseif</span> (<span style="color: #ffb86c;">$price2</span> >= <span style="color: #ffb86c;">$price1</span> && <span style="color: #ffb86c;">$price2</span> >= <span style="color: #ffb86c;">$price3</span>) {<br>    <span style="color: #ffb86c;">$max_price</span> = <span style="color: #ffb86c;">$price2</span>;<br>    <span style="color: #ffb86c;">$max_product</span> = <span style="color: #ffb86c;">$product2</span>;<br>} <span style="color: #50fa7b;">else</span> {<br>    <span style="color: #ffb86c;">$max_price</span> = <span style="color: #ffb86c;">$price3</span>;<br>    <span style="color: #ffb86c;">$max_product</span> = <span style="color: #ffb86c;">$product3</span>;<br>}<br><br><span style="color: #6272a4;">// Поиск минимума (вытеснение)</span><br><span style="color: #ffb86c;">$min_price</span> = <span style="color: #ffb86c;">$price1</span>;<br><span style="color: #ffb86c;">$min_product</span> = <span style="color: #ffb86c;">$product1</span>;<br><span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$price2</span> < <span style="color: #ffb86c;">$min_price</span>) {<br>    <span style="color: #ffb86c;">$min_price</span> = <span style="color: #ffb86c;">$price2</span>;<br>    <span style="color: #ffb86c;">$min_product</span> = <span style="color: #ffb86c;">$product2</span>;<br>}<br><span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$price3</span> < <span style="color: #ffb86c;">$min_price</span>) {<br>    <span style="color: #ffb86c;">$min_price</span> = <span style="color: #ffb86c;">$price3</span>;<br>    <span style="color: #ffb86c;">$min_product</span> = <span style="color: #ffb86c;">$product3</span>;<br>}<br><br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Самый дорогой: $max_product - $max_price руб\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Самый дешевый: $min_product - $min_price руб"</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Товары</span>
                        <span class="result-content"><?php echo "$product1_max ($price1_max), $product2_max ($price2_max), $product3_max ($price3_max)"; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Максимум</span>
                        <span class="result-content"><?php echo "$max_product - $max_price руб"; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Минимум</span>
                        <span class="result-content"><?php echo "$min_product - $min_price руб"; ?></span>
                    </div>
                </div>
            </div>

            <!-- ЗАДАНИЕ 3 -->
            <div class="section-title">⚙️ Задание №3: Функции пользователя</div>

            <?php
            // Функция для определения максимальной цены
            function findMaxPrice($prod1, $pr1, $prod2, $pr2, $prod3, $pr3) {
                if ($pr1 >= $pr2 && $pr1 >= $pr3) {
                    return "Самый дорогой: $prod1 ($pr1 руб)";
                } elseif ($pr2 >= $pr1 && $pr2 >= $pr3) {
                    return "Самый дорогой: $prod2 ($pr2 руб)";
                } else {
                    return "Самый дорогой: $prod3 ($pr3 руб)";
                }
            }
            
            // Функция проверки пароля
            function checkPassword($input_pass) {
                $correct_pass = "12345";
                return ($input_pass == $correct_pass) ? "Пароль верный" : "Ошибка в пароле";
            }
            
            $test_calls = [
                findMaxPrice("телевизор", 500, "плеер", 200, "колонки", 350),
                findMaxPrice("ноутбук", 800, "планшет", 600, "телефон", 450),
                findMaxPrice("стол", 120, "стул", 80, "шкаф", 250)
            ];
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">3.1</span>
                    <span class="task-title">Функция поиска максимума</span>
                </div>
                <div class="task-description">
                    Функция с шестью параметрами для определения товара с максимальной ценой.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">function</span> findMaxPrice(<span style="color: #ffb86c;">$prod1</span>, <span style="color: #ffb86c;">$pr1</span>, <span style="color: #ffb86c;">$prod2</span>, <span style="color: #ffb86c;">$pr2</span>, <span style="color: #ffb86c;">$prod3</span>, <span style="color: #ffb86c;">$pr3</span>) {<br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$pr1</span> >= <span style="color: #ffb86c;">$pr2</span> && <span style="color: #ffb86c;">$pr1</span> >= <span style="color: #ffb86c;">$pr3</span>) {<br>        <span style="color: #50fa7b;">return</span> <span style="color: #f1fa8c;">"Самый дорогой: $prod1 ($pr1 руб)"</span>;<br>    } <span style="color: #50fa7b;">elseif</span> (<span style="color: #ffb86c;">$pr2</span> >= <span style="color: #ffb86c;">$pr1</span> && <span style="color: #ffb86c;">$pr2</span> >= <span style="color: #ffb86c;">$pr3</span>) {<br>        <span style="color: #50fa7b;">return</span> <span style="color: #f1fa8c;">"Самый дорогой: $prod2 ($pr2 руб)"</span>;<br>    } <span style="color: #50fa7b;">else</span> {<br>        <span style="color: #50fa7b;">return</span> <span style="color: #f1fa8c;">"Самый дорогой: $prod3 ($pr3 руб)"</span>;<br>    }<br>}<br><br><span style="color: #50fa7b;">echo</span> findMaxPrice(<span style="color: #f1fa8c;">"телевизор"</span>, 500, <span style="color: #f1fa8c;">"плеер"</span>, 200, <span style="color: #f1fa8c;">"колонки"</span>, 350) . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> findMaxPrice(<span style="color: #f1fa8c;">"ноутбук"</span>, 800, <span style="color: #f1fa8c;">"планшет"</span>, 600, <span style="color: #f1fa8c;">"телефон"</span>, 450) . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> findMaxPrice(<span style="color: #f1fa8c;">"стол"</span>, 120, <span style="color: #f1fa8c;">"стул"</span>, 80, <span style="color: #f1fa8c;">"шкаф"</span>, 250);</pre>
                </div>
                <div class="task-result">
                    <?php foreach ($test_calls as $index => $result): ?>
                    <div class="result-item">
                        <span class="result-label">Тест <?php echo $index + 1; ?></span>
                        <span class="result-content"><?php echo $result; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">3.2</span>
                    <span class="task-title">Функция проверки пароля</span>
                </div>
                <div class="task-description">
                    Функция с return для проверки пароля. Правильный пароль: 12345
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">function</span> checkPassword(<span style="color: #ffb86c;">$pass</span>) {<br>    <span style="color: #ffb86c;">$correct</span> = <span style="color: #f1fa8c;">"12345"</span>;<br>    <span style="color: #50fa7b;">return</span> (<span style="color: #ffb86c;">$pass</span> == <span style="color: #ffb86c;">$correct</span>) ? <span style="color: #f1fa8c;">"Пароль верный"</span> : <span style="color: #f1fa8c;">"Ошибка в пароле"</span>;<br>}<br><br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Пароль 12345: "</span> . checkPassword(<span style="color: #f1fa8c;">"12345"</span>) . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Пароль qwerty: "</span> . checkPassword(<span style="color: #f1fa8c;">"qwerty"</span>) . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Пароль пустой: "</span> . checkPassword(<span style="color: #f1fa8c;">""</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Пароль "12345"</span>
                        <span class="result-content"><?php echo checkPassword("12345"); ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Пароль "qwerty"</span>
                        <span class="result-content"><?php echo checkPassword("qwerty"); ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Пароль ""</span>
                        <span class="result-content"><?php echo checkPassword(""); ?></span>
                    </div>
                </div>
            </div>

            <!-- ЗАДАНИЕ 4 -->
            <div class="section-title">🔄 Задание №4: Циклы while и for</div>

            <?php
            // Задача с инфляцией (while)
            $price_while = 100;
            $inflation_while = 10;
            $year_while = 2024;
            $inflation_rate = 3.5;
            
            $inflation_data_while = [];
            while ($price_while <= 150) {
                $inflation_data_while[] = [
                    'year' => $year_while,
                    'price' => round($price_while, 2),
                    'inflation' => round($inflation_while, 2)
                ];
                $price_while *= (1 + $inflation_while / 100);
                $inflation_while += $inflation_rate;
                $year_while++;
            }
            
            // Задача с инфляцией (for - 5 лет)
            $price_for = 100;
            $inflation_for = 10;
            $inflation_data_for = [];
            for ($year = 2024; $year <= 2029; $year++) {
                $inflation_data_for[] = [
                    'year' => $year,
                    'price' => round($price_for, 2),
                    'inflation' => round($inflation_for, 2)
                ];
                $price_for *= (1 + $inflation_for / 100);
                $inflation_for += $inflation_rate;
            }
            
            // Задача со снижением инфляции
            $price_complex = 100;
            $inflation_complex = 10;
            $inflation_data_complex = [];
            for ($year = 2024; $year <= 2034; $year++) {
                $inflation_data_complex[] = [
                    'year' => $year,
                    'price' => round($price_complex, 2),
                    'inflation' => round($inflation_complex, 2)
                ];
                $price_complex *= (1 + $inflation_complex / 100);
                
                if ($price_complex >= 170) {
                    $inflation_complex -= $inflation_rate;
                } else {
                    $inflation_complex += $inflation_rate;
                }
            }
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4.1</span>
                    <span class="task-title">Цикл while (до 150р)</span>
                </div>
                <div class="task-description">
                    Рост цены с инфляцией +3.5% ежегодно до превышения 150р.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$price</span> = 100;<br><span style="color: #ffb86c;">$inflation</span> = 10;<br><span style="color: #ffb86c;">$year</span> = 2024;<br><span style="color: #ffb86c;">$data</span> = [];<br><br><span style="color: #50fa7b;">while</span> (<span style="color: #ffb86c;">$price</span> <= 150) {<br>    <span style="color: #ffb86c;">$data</span>[] = [<br>        <span style="color: #f1fa8c;">'year'</span> => <span style="color: #ffb86c;">$year</span>,<br>        <span style="color: #f1fa8c;">'price'</span> => <span style="color: #50fa7b;">round</span>(<span style="color: #ffb86c;">$price</span>, 2),<br>        <span style="color: #f1fa8c;">'inflation'</span> => <span style="color: #50fa7b;">round</span>(<span style="color: #ffb86c;">$inflation</span>, 2)<br>    ];<br>    <span style="color: #ffb86c;">$price</span> *= (1 + <span style="color: #ffb86c;">$inflation</span> / 100);<br>    <span style="color: #ffb86c;">$inflation</span> += 3.5;<br>    <span style="color: #ffb86c;">$year</span>++;<br>}<br><br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$data</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$row</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Год: {$row['year']}, Цена: {$row['price']} руб, Инфляция: {$row['inflation']}%\n"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Таблица</span>
                        <span class="result-content scrollable">
                            <table class="result-table">
                                <tr><th>Год</th><th>Цена (руб)</th><th>Инфляция (%)</th></tr>
                                <?php foreach ($inflation_data_while as $row): ?>
                                <tr><td><?php echo $row['year']; ?></td><td><?php echo $row['price']; ?></td><td><?php echo $row['inflation']; ?></td></tr>
                                <?php endforeach; ?>
                            </table>
                        </span>
                    </div>
                </div>
            </div>

            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4.2</span>
                    <span class="task-title">Цикл for (5 лет)</span>
                </div>
                <div class="task-description">
                    Прогноз на 5 лет с помощью цикла for.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$price</span> = 100;<br><span style="color: #ffb86c;">$inflation</span> = 10;<br><span style="color: #ffb86c;">$data</span> = [];<br><br><span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$year</span> = 2024; <span style="color: #ffb86c;">$year</span> <= 2029; <span style="color: #ffb86c;">$year</span>++) {<br>    <span style="color: #ffb86c;">$data</span>[] = [<br>        <span style="color: #f1fa8c;">'year'</span> => <span style="color: #ffb86c;">$year</span>,<br>        <span style="color: #f1fa8c;">'price'</span> => <span style="color: #50fa7b;">round</span>(<span style="color: #ffb86c;">$price</span>, 2),<br>        <span style="color: #f1fa8c;">'inflation'</span> => <span style="color: #50fa7b;">round</span>(<span style="color: #ffb86c;">$inflation</span>, 2)<br>    ];<br>    <span style="color: #ffb86c;">$price</span> *= (1 + <span style="color: #ffb86c;">$inflation</span> / 100);<br>    <span style="color: #ffb86c;">$inflation</span> += 3.5;<br>}<br><br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$data</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$row</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Год: {$row['year']}, Цена: {$row['price']} руб, Инфляция: {$row['inflation']}%\n"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Таблица</span>
                        <span class="result-content scrollable">
                            <table class="result-table">
                                <tr><th>Год</th><th>Цена (руб)</th><th>Инфляция (%)</th></tr>
                                <?php foreach ($inflation_data_for as $row): ?>
                                <tr><td><?php echo $row['year']; ?></td><td><?php echo $row['price']; ?></td><td><?php echo $row['inflation']; ?></td></tr>
                                <?php endforeach; ?>
                            </table>
                        </span>
                    </div>
                </div>
            </div>

            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4.3</span>
                    <span class="task-title">Снижение инфляции</span>
                </div>
                <div class="task-description">
                    При достижении 170р инфляция начинает снижаться на 3.5% ежегодно.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$price</span> = 100;<br><span style="color: #ffb86c;">$inflation</span> = 10;<br><span style="color: #ffb86c;">$data</span> = [];<br><br><span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$year</span> = 2024; <span style="color: #ffb86c;">$year</span> <= 2034; <span style="color: #ffb86c;">$year</span>++) {<br>    <span style="color: #ffb86c;">$data</span>[] = [<br>        <span style="color: #f1fa8c;">'year'</span> => <span style="color: #ffb86c;">$year</span>,<br>        <span style="color: #f1fa8c;">'price'</span> => <span style="color: #50fa7b;">round</span>(<span style="color: #ffb86c;">$price</span>, 2),<br>        <span style="color: #f1fa8c;">'inflation'</span> => <span style="color: #50fa7b;">round</span>(<span style="color: #ffb86c;">$inflation</span>, 2)<br>    ];<br>    <span style="color: #ffb86c;">$price</span> *= (1 + <span style="color: #ffb86c;">$inflation</span> / 100);<br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$price</span> >= 170) {<br>        <span style="color: #ffb86c;">$inflation</span> -= 3.5;<br>    } <span style="color: #50fa7b;">else</span> {<br>        <span style="color: #ffb86c;">$inflation</span> += 3.5;<br>    }<br>}<br><br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$data</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$row</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Год: {$row['year']}, Цена: {$row['price']} руб, Инфляция: {$row['inflation']}%\n"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Таблица</span>
                        <span class="result-content scrollable">
                            <table class="result-table">
                                <tr><th>Год</th><th>Цена (руб)</th><th>Инфляция (%)</th></tr>
                                <?php foreach ($inflation_data_complex as $row): ?>
                                <tr><td><?php echo $row['year']; ?></td><td><?php echo $row['price']; ?></td><td><?php echo $row['inflation']; ?></td></tr>
                                <?php endforeach; ?>
                            </table>
                        </span>
                    </div>
                </div>
            </div>

            <!-- ЗАДАНИЕ 5 -->
            <div class="section-title">📚 Задание №5: Индексированные массивы</div>

            <?php
            // Создание массива
            $products5 = array("телефон", "ноутбук", "планшет", "часы", "наушники");
            
            // Добавление элементов
            $products5[] = "колонки";
            $products5[] = "мышь";
            
            // Сортировка
            $products5_sorted = $products5;
            sort($products5_sorted);
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">5.1</span>
                    <span class="task-title">Создание и обработка</span>
                </div>
                <div class="task-description">
                    Создать массив из 5 элементов, добавить еще 2, вывести через цикл for.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$products</span> = <span style="color: #50fa7b;">array</span>(<span style="color: #f1fa8c;">"телефон"</span>, <span style="color: #f1fa8c;">"ноутбук"</span>, <span style="color: #f1fa8c;">"планшет"</span>, <span style="color: #f1fa8c;">"часы"</span>, <span style="color: #f1fa8c;">"наушники"</span>);<br><span style="color: #ffb86c;">$products</span>[] = <span style="color: #f1fa8c;">"колонки"</span>;<br><span style="color: #ffb86c;">$products</span>[] = <span style="color: #f1fa8c;">"мышь"</span>;<br><br><span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = 0; <span style="color: #ffb86c;">$i</span> < <span style="color: #50fa7b;">count</span>(<span style="color: #ffb86c;">$products</span>); <span style="color: #ffb86c;">$i</span>++) {<br>    <span style="color: #50fa7b;">echo</span> (<span style="color: #ffb86c;">$i</span> + 1) . <span style="color: #f1fa8c;">". "</span> . <span style="color: #ffb86c;">$products</span>[<span style="color: #ffb86c;">$i</span>] . <span style="color: #f1fa8c;">"\n"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Исходный</span>
                        <span class="result-content scrollable"><?php echo implode(" | ", $products5); ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Всего</span>
                        <span class="result-content"><?php echo count($products5); ?> элементов</span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Вывод циклом</span>
                        <span class="result-content scrollable"><?php 
                            for ($i = 0; $i < count($products5); $i++) {
                                echo ($i + 1) . ". " . $products5[$i] . "\n";
                            }
                        ?></span>
                    </div>
                </div>
            </div>

            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">5.2</span>
                    <span class="task-title">Сортировка массива</span>
                </div>
                <div class="task-description">
                    Сортировка массива в алфавитном порядке с помощью sort().
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$products</span> = <span style="color: #50fa7b;">array</span>(<span style="color: #f1fa8c;">"телефон"</span>, <span style="color: #f1fa8c;">"ноутбук"</span>, <span style="color: #f1fa8c;">"планшет"</span>, <span style="color: #f1fa8c;">"часы"</span>, <span style="color: #f1fa8c;">"наушники"</span>, <span style="color: #f1fa8c;">"колонки"</span>, <span style="color: #f1fa8c;">"мышь"</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"До сортировки: "</span> . <span style="color: #50fa7b;">implode</span>(<span style="color: #f1fa8c;">" | "</span>, <span style="color: #ffb86c;">$products</span>) . <span style="color: #f1fa8c;">"\n"</span>;<br><br><span style="color: #50fa7b;">sort</span>(<span style="color: #ffb86c;">$products</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"После сортировки: "</span> . <span style="color: #50fa7b;">implode</span>(<span style="color: #f1fa8c;">" | "</span>, <span style="color: #ffb86c;">$products</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">До сортировки</span>
                        <span class="result-content scrollable"><?php echo implode(" | ", $products5); ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">После сортировки</span>
                        <span class="result-content scrollable"><?php echo implode(" | ", $products5_sorted); ?></span>
                    </div>
                </div>
            </div>

            <!-- ЗАДАНИЕ 6 -->
            <div class="section-title">🔑 Задание №6: Ассоциативные массивы</div>

            <?php
            // Создание ассоциативного массива
            $products6 = array(
                "телефон" => 15000,
                "ноутбук" => 45000,
                "планшет" => 20000
            );
            
            // Добавление элементов
            $products6["часы"] = 8000;
            $products6["наушники"] = 3000;
            $products6["колонки"] = 5000;
            
            // Подсчет суммы
            $total_price = array_sum($products6);
            $total_items = count($products6);
            
            // Сортировки
            $price_asc = $products6;
            asort($price_asc); // по возрастанию цены
            
            $price_desc = $products6;
            arsort($price_desc); // по убыванию цены
            
            $key_asc = $products6;
            ksort($key_asc); // по алфавиту ключей
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">6.1</span>
                    <span class="task-title">Ассоциативный массив</span>
                </div>
                <div class="task-description">
                    Создать массив ТОВАР=>ЦЕНА, вывести через foreach, подсчитать сумму и количество.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$products</span> = [<br>    <span style="color: #f1fa8c;">"телефон"</span> => 15000,<br>    <span style="color: #f1fa8c;">"ноутбук"</span> => 45000,<br>    <span style="color: #f1fa8c;">"планшет"</span> => 20000<br>];<br><span style="color: #ffb86c;">$products</span>[<span style="color: #f1fa8c;">"часы"</span>] = 8000;<br><span style="color: #ffb86c;">$products</span>[<span style="color: #f1fa8c;">"наушники"</span>] = 3000;<br><span style="color: #ffb86c;">$products</span>[<span style="color: #f1fa8c;">"колонки"</span>] = 5000;<br><br><span style="color: #ffb86c;">$total_price</span> = 0;<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$products</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$name</span> => <span style="color: #ffb86c;">$price</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"$name: $price руб\n"</span>;<br>    <span style="color: #ffb86c;">$total_price</span> += <span style="color: #ffb86c;">$price</span>;<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Всего товаров: "</span> . <span style="color: #50fa7b;">count</span>(<span style="color: #ffb86c;">$products</span>) . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Общая стоимость: $total_price руб"</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Товары</span>
                        <span class="result-content scrollable">
                            <table class="result-table">
                                <tr><th>Товар</th><th>Цена (руб)</th></tr>
                                <?php foreach ($products6 as $name => $price): ?>
                                <tr><td><?php echo $name; ?></td><td><?php echo number_format($price, 0, '', ' '); ?></td></tr>
                                <?php endforeach; ?>
                                <tr><td><strong>ИТОГО:</strong></td><td><strong><?php echo number_format($total_price, 0, '', ' '); ?> руб</strong></td></tr>
                                <tr><td><strong>Количество:</strong></td><td><strong><?php echo $total_items; ?></strong></td></tr>
                            </table>
                        </span>
                    </div>
                </div>
            </div>

            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">6.2</span>
                    <span class="task-title">Сортировка ассоциативного массива</span>
                </div>
                <div class="task-description">
                    Сортировка по цене (asort, arsort) и по названию (ksort).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$products</span> = [<br>    <span style="color: #f1fa8c;">"телефон"</span> => 15000,<br>    <span style="color: #f1fa8c;">"ноутбук"</span> => 45000,<br>    <span style="color: #f1fa8c;">"планшет"</span> => 20000,<br>    <span style="color: #f1fa8c;">"часы"</span> => 8000,<br>    <span style="color: #f1fa8c;">"наушники"</span> => 3000,<br>    <span style="color: #f1fa8c;">"колонки"</span> => 5000<br>];<br><br><span style="color: #ffb86c;">$price_asc</span> = <span style="color: #ffb86c;">$products</span>;<br><span style="color: #50fa7b;">asort</span>(<span style="color: #ffb86c;">$price_asc</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"По возрастанию цены:\n"</span>;<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$price_asc</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$name</span> => <span style="color: #ffb86c;">$price</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"  $name: $price руб\n"</span>;<br>}<br><br><span style="color: #ffb86c;">$price_desc</span> = <span style="color: #ffb86c;">$products</span>;<br><span style="color: #50fa7b;">arsort</span>(<span style="color: #ffb86c;">$price_desc</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"По убыванию цены:\n"</span>;<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$price_desc</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$name</span> => <span style="color: #ffb86c;">$price</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"  $name: $price руб\n"</span>;<br>}<br><br><span style="color: #ffb86c;">$key_asc</span> = <span style="color: #ffb86c;">$products</span>;<br><span style="color: #50fa7b;">ksort</span>(<span style="color: #ffb86c;">$key_asc</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"По алфавиту:\n"</span>;<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$key_asc</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$name</span> => <span style="color: #ffb86c;">$price</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"  $name: $price руб\n"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">По возр. цены</span>
                        <span class="result-content scrollable">
                            <table class="result-table">
                                <?php foreach ($price_asc as $name => $price): ?>
                                <tr><td><?php echo $name; ?></td><td><?php echo $price; ?></td></tr>
                                <?php endforeach; ?>
                            </table>
                        </span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">По убыв. цены</span>
                        <span class="result-content scrollable">
                            <table class="result-table">
                                <?php foreach ($price_desc as $name => $price): ?>
                                <tr><td><?php echo $name; ?></td><td><?php echo $price; ?></td></tr>
                                <?php endforeach; ?>
                            </table>
                        </span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">По алфавиту</span>
                        <span class="result-content scrollable">
                            <table class="result-table">
                                <?php foreach ($key_asc as $name => $price): ?>
                                <tr><td><?php echo $name; ?></td><td><?php echo $price; ?></td></tr>
                                <?php endforeach; ?>
                            </table>
                        </span>
                    </div>
                </div>
            </div>

            <!-- ЗАДАНИЕ 7 -->
            <div class="section-title">👤 Задание №7: Информация о разработчике</div>

            <?php
            $developer_name = "Иван Петров";
            $developer_age = 28;
            $developer_skills = ["PHP", "JavaScript", "HTML/CSS", "MySQL", "Git", "Laravel", "React"];
            $developer_exp = 5;
            $developer_email = "ivan.petrov@example.com";
            $developer_education = "Высшее, МГУ, факультет ВМК";
            $developer_hobbies = ["Чтение", "Путешествия", "Фотография"];
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">7</span>
                    <span class="task-title">Визитная карточка</span>
                </div>
                <div class="task-description">
                    Страница с форматированной информацией о разработчике.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$name</span> = <span style="color: #f1fa8c;">"Иван Петров"</span>;<br><span style="color: #ffb86c;">$age</span> = 28;<br><span style="color: #ffb86c;">$skills</span> = [<span style="color: #f1fa8c;">"PHP"</span>, <span style="color: #f1fa8c;">"JavaScript"</span>, <span style="color: #f1fa8c;">"HTML/CSS"</span>, <span style="color: #f1fa8c;">"MySQL"</span>, <span style="color: #f1fa8c;">"Git"</span>, <span style="color: #f1fa8c;">"Laravel"</span>, <span style="color: #f1fa8c;">"React"</span>];<br><span style="color: #ffb86c;">$exp</span> = 5;<br><span style="color: #ffb86c;">$email</span> = <span style="color: #f1fa8c;">"ivan.petrov@example.com"</span>;<br><span style="color: #ffb86c;">$education</span> = <span style="color: #f1fa8c;">"Высшее, МГУ, факультет ВМК"</span>;<br><span style="color: #ffb86c;">$hobbies</span> = [<span style="color: #f1fa8c;">"Чтение"</span>, <span style="color: #f1fa8c;">"Путешествия"</span>, <span style="color: #f1fa8c;">"Фотография"</span>];<br><br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"&lt;div class='developer-card'&gt;"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"&lt;h3&gt;👨‍💻 $name&lt;/h3&gt;"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"&lt;p&gt;&lt;strong&gt;Возраст:&lt;/strong&gt; $age лет&lt;/p&gt;"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"&lt;p&gt;&lt;strong&gt;Опыт:&lt;/strong&gt; $exp лет&lt;/p&gt;"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"&lt;p&gt;&lt;strong&gt;Email:&lt;/strong&gt; &lt;a href='mailto:$email'&gt;$email&lt;/a&gt;&lt;/p&gt;"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"&lt;p&gt;&lt;strong&gt;Образование:&lt;/strong&gt; $education&lt;/p&gt;"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"&lt;p&gt;&lt;strong&gt;Навыки:&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;"</span>;<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$skills</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$skill</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"&lt;li&gt;$skill&lt;/li&gt;"</span>;<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"&lt;/ul&gt;"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"&lt;p&gt;&lt;strong&gt;Хобби:&lt;/strong&gt; "</span> . <span style="color: #50fa7b;">implode</span>(<span style="color: #f1fa8c;">", "</span>, <span style="color: #ffb86c;">$hobbies</span>) . <span style="color: #f1fa8c;">"&lt;/p&gt;"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"&lt;/div&gt;"</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">О разработчике</span>
                        <span class="result-content scrollable">
                            <div class="developer-card">
                                <h3 style="margin: 0 0 15px 0;">👨‍💻 <?php echo $developer_name; ?></h3>
                                <p><strong>Возраст:</strong> <?php echo $developer_age; ?> лет</p>
                                <p><strong>Опыт:</strong> <?php echo $developer_exp; ?> лет</p>
                                <p><strong>Email:</strong> <a href="mailto:<?php echo $developer_email; ?>"><?php echo $developer_email; ?></a></p>
                                <p><strong>Образование:</strong> <?php echo $developer_education; ?></p>
                                <p><strong>Навыки:</strong></p>
                                <ul style="margin-left: 20px;">
                                    <?php foreach ($developer_skills as $skill): ?>
                                    <li><?php echo $skill; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <p><strong>Хобби:</strong> <?php echo implode(", ", $developer_hobbies); ?></p>
                            </div>
                        </span>
                    </div>
                </div>
            </div>

            <!-- ЗАДАНИЕ 8 -->
            <div class="section-title">🎨 Задание №8: Таблица цветов HTML</div>

            <?php
            $hex_values = ['00', '33', '66', '99', 'CC', 'FF'];
            $color_table = [];
            $color_info = [];
            
            foreach ($hex_values as $r) {
                foreach ($hex_values as $g) {
                    foreach ($hex_values as $b) {
                        $hex = "#$r$g$b";
                        $color_table[] = $hex;
                        $color_info[] = [
                            'hex' => $hex,
                            'r' => hexdec($r),
                            'g' => hexdec($g),
                            'b' => hexdec($b)
                        ];
                        if (count($color_table) >= 36) break 3;
                    }
                }
            }
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">8</span>
                    <span class="task-title">Таблица цветов</span>
                </div>
                <div class="task-description">
                    Генерация таблицы цветов с использованием dechex и hexdec.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$values</span> = [<span style="color: #f1fa8c;">'00'</span>, <span style="color: #f1fa8c;">'33'</span>, <span style="color: #f1fa8c;">'66'</span>, <span style="color: #f1fa8c;">'99'</span>, <span style="color: #f1fa8c;">'CC'</span>, <span style="color: #f1fa8c;">'FF'</span>];<br><span style="color: #ffb86c;">$colors</span> = [];<br><br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$values</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$r</span>) {<br>    <span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$values</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$g</span>) {<br>        <span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$values</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$b</span>) {<br>            <span style="color: #ffb86c;">$hex</span> = <span style="color: #f1fa8c;">"#$r$g$b"</span>;<br>            <span style="color: #ffb86c;">$colors</span>[] = [<br>                <span style="color: #f1fa8c;">'hex'</span> => <span style="color: #ffb86c;">$hex</span>,<br>                <span style="color: #f1fa8c;">'r'</span> => <span style="color: #50fa7b;">hexdec</span>(<span style="color: #ffb86c;">$r</span>),<br>                <span style="color: #f1fa8c;">'g'</span> => <span style="color: #50fa7b;">hexdec</span>(<span style="color: #ffb86c;">$g</span>),<br>                <span style="color: #f1fa8c;">'b'</span> => <span style="color: #50fa7b;">hexdec</span>(<span style="color: #ffb86c;">$b</span>)<br>            ];<br>            <span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">count</span>(<span style="color: #ffb86c;">$colors</span>) >= 36) <span style="color: #50fa7b;">break</span> 3;<br>        }<br>    }<br>}<br><br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$colors</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$c</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"&lt;div style='display:inline-block; width:60px; text-align:center;'&gt;"</span>;<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"&lt;div style='width:40px; height:40px; background: {$c['hex']}; border:1px solid #ccc; border-radius:4px; margin:0 auto;'&gt;&lt;/div&gt;"</span>;<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"&lt;div&gt;{$c['hex']}&lt;/div&gt;"</span>;<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"&lt;div&gt;{$c['r']},{$c['g']},{$c['b']}&lt;/div&gt;"</span>;<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"&lt;/div&gt;"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Цвета</span>
                        <span class="result-content scrollable">
                            <div class="color-grid">
                                <?php foreach ($color_info as $color): ?>
                                <div class="color-item">
                                    <div class="color-box" style="background: <?php echo $color['hex']; ?>;"></div>
                                    <div class="color-hex"><?php echo $color['hex']; ?></div>
                                    <div class="color-hex"><?php echo "{$color['r']},{$color['g']},{$color['b']}"; ?></div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </span>
                    </div>
                </div>
            </div>

            <!-- ЗАДАНИЕ 9 -->
            <div class="section-title">🎲 Задание №9: Случайные числа</div>

            <?php
            $target_sum = 100;
            $sum = 0;
            $numbers = [];
            $iterations = 0;
            
            while ($sum < $target_sum) {
                $num = rand(1, 20);
                $numbers[] = $num;
                $sum += $num;
                $iterations++;
            }
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">9</span>
                    <span class="task-title">Генерация до достижения суммы</span>
                </div>
                <div class="task-description">
                    Генерировать случайные числа (1-20), пока их сумма не станет >= заданного значения.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$target</span> = 100;<br><span style="color: #ffb86c;">$sum</span> = 0;<br><span style="color: #ffb86c;">$numbers</span> = [];<br><span style="color: #ffb86c;">$iterations</span> = 0;<br><br><span style="color: #50fa7b;">while</span> (<span style="color: #ffb86c;">$sum</span> < <span style="color: #ffb86c;">$target</span>) {<br>    <span style="color: #ffb86c;">$num</span> = <span style="color: #50fa7b;">rand</span>(1, 20);<br>    <span style="color: #ffb86c;">$numbers</span>[] = <span style="color: #ffb86c;">$num</span>;<br>    <span style="color: #ffb86c;">$sum</span> += <span style="color: #ffb86c;">$num</span>;<br>    <span style="color: #ffb86c;">$iterations</span>++;<br>}<br><br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Цель: $target\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Числа: "</span> . <span style="color: #50fa7b;">implode</span>(<span style="color: #f1fa8c;">" + "</span>, <span style="color: #ffb86c;">$numbers</span>) . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Сумма: $sum\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Итераций: $iterations"</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Цель</span>
                        <span class="result-content"><?php echo $target_sum; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Числа</span>
                        <span class="result-content scrollable"><?php echo implode(" + ", $numbers); ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Сумма</span>
                        <span class="result-content"><?php echo $sum; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Итераций</span>
                        <span class="result-content"><?php echo $iterations; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>