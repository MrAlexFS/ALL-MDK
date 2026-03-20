<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Практическая работа №9: Строки, HTML теги, логические значения</title>
    <style>
        /* Современный сброс стилей и базовая типографика */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #16a085 0%, #27ae60 100%);
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
            background: linear-gradient(135deg, #ffffff 0%, #e0ffe0 100%);
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
            background: linear-gradient(135deg, #16a085 0%, #27ae60 100%);
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
            box-shadow: 0 4px 10px rgba(39, 174, 96, 0.3);
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
            border-left: 4px solid #27ae60;
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
            max-height: 250px;
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

        .result-value.scrollable {
            max-height: 200px;
            overflow-y: auto;
            font-family: 'Inter', monospace;
        }

        .result-value img {
            max-width: 100%;
            border-radius: 10px;
            margin-top: 10px;
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

        /* Адаптивность */
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Практическая работа №9</h1>
            <p>Строки, HTML теги, логические значения и NULL в PHP</p>
        </div>

        <div class="tasks-grid">
            <!-- СТРОКИ В PHP -->
            <div class="section-title">📝 Строки в PHP</div>

            <!-- Задача №1 -->
            <?php
            $str1 = 'hello';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">1</span>
                    <span class="task-title">Простая строка</span>
                </div>
                <div class="task-description">
                    Создайте переменную $str и присвойте ей строку 'hello'. Выведите значение этой переменной на экран.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'hello'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$str</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $str1; ?></span>
                </div>
            </div>

            <!-- Задача №2 -->
            <?php
            $str2_a = 'abc';
            $str2_b = 'def';
            $result2 = $str2_a . $str2_b;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">Конкатенация 1</span>
                </div>
                <div class="task-description">
                    Создайте переменную с текстом 'abc' и переменную с текстом 'def'. Выведите строку 'abcdef'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$a</span> = <span style="color: #f1fa8c;">'abc'</span>;<br><span style="color: #ffb86c;">$b</span> = <span style="color: #f1fa8c;">'def'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$a</span> . <span style="color: #ffb86c;">$b</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result2; ?></span>
                </div>
            </div>

            <!-- Задача №3 -->
            <?php
            $str3_a = 'hello';
            $str3_b = 'world';
            $result3 = $str3_a . ' ' . $str3_b;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">3</span>
                    <span class="task-title">Конкатенация с пробелом</span>
                </div>
                <div class="task-description">
                    Создайте переменную 'hello' и 'world'. Выведите строку 'hello world'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$a</span> = <span style="color: #f1fa8c;">'hello'</span>;<br><span style="color: #ffb86c;">$b</span> = <span style="color: #f1fa8c;">'world'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$a</span> . <span style="color: #f1fa8c;">' '</span> . <span style="color: #ffb86c;">$b</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result3; ?></span>
                </div>
            </div>

            <!-- Задача №4 -->
            <?php
            $str4 = 'Hello, PHP!';
            $length4 = strlen($str4);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4</span>
                    <span class="task-title">Длина строки (лат.)</span>
                </div>
                <div class="task-description">
                    Запишите в переменную какую-нибудь строку. Выведите на экран длину строки.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'Hello, PHP!'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Строка: $str\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Длина: "</span> . <span style="color: #50fa7b;">strlen</span>(<span style="color: #ffb86c;">$str</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline">Строка: "<?php echo $str4; ?>"<br>Длина: <?php echo $length4; ?></span>
                </div>
            </div>

            <!-- Задача №5 -->
            <?php
            $str5 = 'Привет, мир!';
            $length5 = mb_strlen($str5, 'UTF-8');
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">5</span>
                    <span class="task-title">Длина строки (кир.)</span>
                </div>
                <div class="task-description">
                    Запишите в переменную кириллическую строку. Выведите на экран длину строки.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'Привет, мир!'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Строка: $str\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Длина: "</span> . <span style="color: #50fa7b;">mb_strlen</span>(<span style="color: #ffb86c;">$str</span>, <span style="color: #f1fa8c;">'UTF-8'</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline">Строка: "<?php echo $str5; ?>"<br>Длина: <?php echo $length5; ?></span>
                </div>
            </div>

            <!-- РАБОТА С HTML ТЕГАМИ -->
            <div class="section-title">🎨 Работа с HTML тегами</div>

            <!-- Задача №1 (HTML) -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">1</span>
                    <span class="task-title">Курсивный текст</span>
                </div>
                <div class="task-description">
                    С помощью тега &lt;i&gt; выведите на экран курсивный текст.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'&lt;i&gt;Это курсивный текст&lt;/i&gt;'</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo '<i>Это курсивный текст</i>'; ?></span>
                </div>
            </div>

            <!-- Задача №2 (HTML) -->
            <?php
            ob_start();
            for ($i = 1; $i <= 9; $i++) {
                echo $i . "<br>";
            }
            $numbers_html = ob_get_clean();
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">Столбец чисел</span>
                </div>
                <div class="task-description">
                    С помощью тега &lt;br&gt; выведите на экран столбец чисел от 1 до 9.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = 1; <span style="color: #ffb86c;">$i</span> <= 9; <span style="color: #ffb86c;">$i</span>++) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$i</span> . <span style="color: #f1fa8c;">'&lt;br&gt;'</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value scrollable"><?php echo $numbers_html; ?></span>
                </div>
            </div>

            <!-- Задача №3 (HTML) -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">3</span>
                    <span class="task-title">Картинка</span>
                </div>
                <div class="task-description">
                    С помощью тега &lt;img&gt; выведите на экран какую-нибудь картинку.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'&lt;img src="https://via.placeholder.com/150" alt="placeholder"&gt;'</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo '<img src="https://via.placeholder.com/150" alt="placeholder" style="max-width:100%; border-radius:8px;">'; ?></span>
                </div>
            </div>

            <!-- Задача №4 (HTML) -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4</span>
                    <span class="task-title">Поле ввода</span>
                </div>
                <div class="task-description">
                    С помощью тега &lt;input&gt; выведите на экран инпут с каким-нибудь текстом.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'&lt;input type="text" value="Введите текст"&gt;'</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo '<input type="text" value="Введите текст" style="padding:8px; border-radius:8px; border:1px solid #ccc; width:100%;">'; ?></span>
                </div>
            </div>

            <!-- Задача №5 (HTML) -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">5</span>
                    <span class="task-title">Текстовая область</span>
                </div>
                <div class="task-description">
                    С помощью тега &lt;textarea&gt; выведите на экран многострочное поле ввода с текстом.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'&lt;textarea rows="4"&gt;Многострочный текст&lt;/textarea&gt;'</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo '<textarea rows="4" style="padding:8px; border-radius:8px; border:1px solid #ccc; width:100%;">Многострочный текст</textarea>'; ?></span>
                </div>
            </div>

            <!-- ЛОГИЧЕСКИЕ ЗНАЧЕНИЯ -->
            <div class="section-title">✓ Логические значения</div>

            <!-- Задача №1 (логические) -->
            <?php
            $bool1 = true;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">1</span>
                    <span class="task-title">Значение true</span>
                </div>
                <div class="task-description">
                    Присвойте переменной значение true. Выведите эту переменную на экран.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$var</span> = <span style="color: #f1fa8c;">true</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$var</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $bool1 ? 'true (1)' : 'false (пусто)'; ?></span>
                </div>
            </div>

            <!-- Задача №2 (логические) -->
            <?php
            $bool2 = false;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">Значение false</span>
                </div>
                <div class="task-description">
                    Присвойте переменной значение false. Выведите эту переменную на экран.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$var</span> = <span style="color: #f1fa8c;">false</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$var</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $bool2 ? 'true (1)' : 'false (пусто)'; ?></span>
                </div>
            </div>

            <!-- ЗНАЧЕНИЕ NULL -->
            <div class="section-title">∅ Значение NULL</div>

            <!-- Задача №1 (NULL) -->
            <?php
            $null1 = null;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">1</span>
                    <span class="task-title">Значение null</span>
                </div>
                <div class="task-description">
                    Присвойте переменной значение null. Выведите эту переменную на экран.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$var</span> = <span style="color: #f1fa8c;">null</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$var</span>;<br><span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">is_null</span>(<span style="color: #ffb86c;">$var</span>)) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">" — переменная равна null"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php 
                        echo "null (ничего не выводится)";
                        if (is_null($null1)) {
                            echo " — переменная равна null";
                        }
                    ?></span>
                </div>
            </div>

            <!-- Задача №2 (NULL) -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">Необъявленная переменная</span>
                </div>
                <div class="task-description">
                    Выведите на экран значение любой необъявленной переменной.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #6272a4;">// Попытка вывести необъявленную переменную</span><br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$undefined</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value scrollable"><?php 
                        echo "Будет ошибка: Notice: Undefined variable<br>";
                        echo "Подавляем ошибку с @: ";
                        echo @$undefined;
                    ?></span>
                </div>
            </div>

            <!-- ДОПОЛНИТЕЛЬНЫЕ ПРИМЕРЫ -->
            <div class="section-title">📊 Дополнительные примеры</div>

            <!-- Демонстрация var_dump -->
            <?php
            $demo_true = true;
            $demo_false = false;
            $demo_null = null;
            
            ob_start();
            var_dump($demo_true);
            $dump_true = ob_get_clean();
            
            ob_start();
            var_dump($demo_false);
            $dump_false = ob_get_clean();
            
            ob_start();
            var_dump($demo_null);
            $dump_null = ob_get_clean();
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">+</span>
                    <span class="task-title">var_dump() примеры</span>
                </div>
                <div class="task-description">
                    Как на самом деле выглядят true, false и null при выводе через var_dump()
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$var_true</span> = true;<br><span style="color: #ffb86c;">$var_false</span> = false;<br><span style="color: #ffb86c;">$var_null</span> = null;<br><br><span style="color: #50fa7b;">var_dump</span>(<span style="color: #ffb86c;">$var_true</span>);<br><span style="color: #50fa7b;">var_dump</span>(<span style="color: #ffb86c;">$var_false</span>);<br><span style="color: #50fa7b;">var_dump</span>(<span style="color: #ffb86c;">$var_null</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo $dump_true;
                        echo $dump_false;
                        echo $dump_null;
                    ?></span>
                </div>
            </div>

            <!-- Сравнение strlen и mb_strlen -->
            <?php
            $test_str = 'Привет! Hello!';
            $len_latin = strlen($test_str);
            $len_utf8 = mb_strlen($test_str, 'UTF-8');
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">+</span>
                    <span class="task-title">strlen vs mb_strlen</span>
                </div>
                <div class="task-description">
                    Сравнение работы strlen и mb_strlen на смешанной строке
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'Привет! Hello!'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Строка: $str\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"strlen(): "</span> . <span style="color: #50fa7b;">strlen</span>(<span style="color: #ffb86c;">$str</span>) . <span style="color: #f1fa8c;">" (считает байты)\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"mb_strlen(): "</span> . <span style="color: #50fa7b;">mb_strlen</span>(<span style="color: #ffb86c;">$str</span>, <span style="color: #f1fa8c;">'UTF-8'</span>) . <span style="color: #f1fa8c;">" (считает символы)"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "Строка: \"$test_str\"\n";
                        echo "strlen(): $len_latin (считает байты)\n";
                        echo "mb_strlen(): $len_utf8 (считает символы)";
                    ?></span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>