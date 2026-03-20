<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Практическая работа 11-12: Функции работы со строками в PHP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #8B5CF6 0%, #6366F1 100%);
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
            background: linear-gradient(135deg, #ffffff 0%, #f0f0ff 100%);
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
            background: linear-gradient(135deg, #8B5CF6 0%, #6366F1 100%);
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
            box-shadow: 0 4px 10px rgba(99, 102, 241, 0.3);
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
            border-left: 4px solid #6366F1;
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

        .result-value pre {
            background: transparent;
            padding: 0;
            margin: 0;
            color: #22543d;
        }

        .pyramid-line {
            font-family: monospace;
            line-height: 1.2;
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
                width: 35px;
                height: 35px;
                font-size: 1rem;
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
            <h1>Практическая работа 11-12</h1>
            <p>Функции работы со строками в PHP</p>
        </div>

        <div class="tasks-grid">
            <!-- РАБОТА С РЕГИСТРОМ -->
            <div class="section-title">🔠 Работа с регистром символов</div>

            <!-- Задача 1 -->
            <?php
            $str1 = 'php';
            $result1 = strtoupper($str1);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">1</span>
                    <span class="task-title">strtoupper</span>
                </div>
                <div class="task-description">
                    Дана строка 'php'. Сделайте из нее строку 'PHP'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'php'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">strtoupper</span>(<span style="color: #ffb86c;">$str</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result1; ?></span>
                </div>
            </div>

            <!-- Задача 2 -->
            <?php
            $str2 = 'PHP';
            $result2 = strtolower($str2);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">strtolower</span>
                </div>
                <div class="task-description">
                    Дана строка 'PHP'. Сделайте из нее строку 'php'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'PHP'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">strtolower</span>(<span style="color: #ffb86c;">$str</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result2; ?></span>
                </div>
            </div>

            <!-- Задача 3 -->
            <?php
            $str3 = 'london';
            $result3 = ucfirst($str3);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">3</span>
                    <span class="task-title">ucfirst</span>
                </div>
                <div class="task-description">
                    Дана строка 'london'. Сделайте из нее строку 'London'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'london'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">ucfirst</span>(<span style="color: #ffb86c;">$str</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result3; ?></span>
                </div>
            </div>

            <!-- Задача 4 -->
            <?php
            $str4 = 'London';
            $result4 = lcfirst($str4);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4</span>
                    <span class="task-title">lcfirst</span>
                </div>
                <div class="task-description">
                    Дана строка 'London'. Сделайте из нее строку 'london'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'London'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">lcfirst</span>(<span style="color: #ffb86c;">$str</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result4; ?></span>
                </div>
            </div>

            <!-- Задача 5 -->
            <?php
            $str5 = 'london is the capital of great britain';
            $result5 = ucwords($str5);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">5</span>
                    <span class="task-title">ucwords</span>
                </div>
                <div class="task-description">
                    Дана строка 'london is the capital of great britain'. Сделайте из нее строку 'London Is The Capital Of Great Britain'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'london is the capital of great britain'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">ucwords</span>(<span style="color: #ffb86c;">$str</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php echo $result5; ?></span>
                </div>
            </div>

            <!-- Задача 6 -->
            <?php
            $str6 = 'LONDON';
            $result6 = ucfirst(strtolower($str6));
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">6</span>
                    <span class="task-title">Комбинация функций</span>
                </div>
                <div class="task-description">
                    Дана строка 'LONDON'. Сделайте из нее строку 'London'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'LONDON'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">ucfirst</span>(<span style="color: #50fa7b;">strtolower</span>(<span style="color: #ffb86c;">$str</span>));</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result6; ?></span>
                </div>
            </div>

            <!-- strlen -->
            <div class="section-title">📏 Работа с strlen</div>

            <!-- Задача 7 -->
            <?php
            $str7 = 'html css php';
            $length7 = strlen($str7);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">7</span>
                    <span class="task-title">strlen</span>
                </div>
                <div class="task-description">
                    Дана строка 'html css php'. Найдите количество символов в этой строке.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'html css php'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">strlen</span>(<span style="color: #ffb86c;">$str</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $length7; ?></span>
                </div>
            </div>

            <!-- Задача 8 -->
            <?php
            $password = 'qwerty123';
            $check_result = (strlen($password) > 5 && strlen($password) < 10) ? 'Пароль подходит' : 'Нужно придумать другой пароль';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">8</span>
                    <span class="task-title">Проверка пароля</span>
                </div>
                <div class="task-description">
                    Если количество символов пароля больше 5-ти и меньше 10-ти, то выведите сообщение о том, что пароль подходит.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$password</span> = <span style="color: #f1fa8c;">'qwerty123'</span>;<br><span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">strlen</span>(<span style="color: #ffb86c;">$password</span>) > 5 && <span style="color: #50fa7b;">strlen</span>(<span style="color: #ffb86c;">$password</span>) < 10) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'Пароль подходит'</span>;<br>} <span style="color: #50fa7b;">else</span> {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'Нужно придумать другой пароль'</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $check_result; ?></span>
                </div>
            </div>

            <!-- substr -->
            <div class="section-title">✂️ Работа с substr</div>

            <!-- Задача 9 -->
            <?php
            $str9 = 'html css php';
            $html = substr($str9, 0, 4);
            $css = substr($str9, 5, 3);
            $php = substr($str9, 9, 3);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">9</span>
                    <span class="task-title">Вырезание слов</span>
                </div>
                <div class="task-description">
                    Дана строка 'html css php'. Вырежьте из нее слово 'html', 'css' и 'php'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'html css php'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">substr</span>(<span style="color: #ffb86c;">$str</span>, 0, 4) . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">substr</span>(<span style="color: #ffb86c;">$str</span>, 5, 3) . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">substr</span>(<span style="color: #ffb86c;">$str</span>, 9, 3);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php echo "$html\n$css\n$php"; ?></span>
                </div>
            </div>

            <!-- Задача 10 -->
            <?php
            $str10 = 'Hello, World!';
            $last3 = substr($str10, -3);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">10</span>
                    <span class="task-title">Последние 3 символа</span>
                </div>
                <div class="task-description">
                    Дана строка. Вырежите и выведите на экран последние 3 символа этой строки.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'Hello, World!'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">substr</span>(<span style="color: #ffb86c;">$str</span>, -3);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $last3; ?></span>
                </div>
            </div>

            <!-- Задача 11 -->
            <?php
            $str11 = 'http://example.com';
            $check11 = (substr($str11, 0, 7) == 'http://') ? 'да' : 'нет';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">11</span>
                    <span class="task-title">Проверка начала</span>
                </div>
                <div class="task-description">
                    Проверьте, что строка начинается на 'http://'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'http://example.com'</span>;<br><span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">substr</span>(<span style="color: #ffb86c;">$str</span>, 0, 7) == <span style="color: #f1fa8c;">'http://'</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'да'</span>;<br>} <span style="color: #50fa7b;">else</span> {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'нет'</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $check11; ?></span>
                </div>
            </div>

            <!-- Задача 12 -->
            <?php
            $str12 = 'https://example.com';
            $check12 = (substr($str12, 0, 7) == 'http://' || substr($str12, 0, 8) == 'https://') ? 'да' : 'нет';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">12</span>
                    <span class="task-title">http или https</span>
                </div>
                <div class="task-description">
                    Проверьте, что строка начинается на 'http://' или 'https://'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'https://example.com'</span>;<br><span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">substr</span>(<span style="color: #ffb86c;">$str</span>, 0, 7) == <span style="color: #f1fa8c;">'http://'</span> || <span style="color: #50fa7b;">substr</span>(<span style="color: #ffb86c;">$str</span>, 0, 8) == <span style="color: #f1fa8c;">'https://'</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'да'</span>;<br>} <span style="color: #50fa7b;">else</span> {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'нет'</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $check12; ?></span>
                </div>
            </div>

            <!-- Задача 13 -->
            <?php
            $str13 = 'image.png';
            $check13 = (substr($str13, -4) == '.png') ? 'да' : 'нет';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">13</span>
                    <span class="task-title">Проверка окончания .png</span>
                </div>
                <div class="task-description">
                    Проверьте, что строка заканчивается на '.png'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'image.png'</span>;<br><span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">substr</span>(<span style="color: #ffb86c;">$str</span>, -4) == <span style="color: #f1fa8c;">'.png'</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'да'</span>;<br>} <span style="color: #50fa7b;">else</span> {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'нет'</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $check13; ?></span>
                </div>
            </div>

            <!-- Задача 14 -->
            <?php
            $str14 = 'image.jpg';
            $check14 = (substr($str14, -4) == '.png' || substr($str14, -4) == '.jpg') ? 'да' : 'нет';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">14</span>
                    <span class="task-title">.png или .jpg</span>
                </div>
                <div class="task-description">
                    Проверьте, что строка заканчивается на '.png' или '.jpg'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'image.jpg'</span>;<br><span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">substr</span>(<span style="color: #ffb86c;">$str</span>, -4) == <span style="color: #f1fa8c;">'.png'</span> || <span style="color: #50fa7b;">substr</span>(<span style="color: #ffb86c;">$str</span>, -4) == <span style="color: #f1fa8c;">'.jpg'</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'да'</span>;<br>} <span style="color: #50fa7b;">else</span> {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'нет'</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $check14; ?></span>
                </div>
            </div>

            <!-- Задача 15 -->
            <?php
            $str15 = 'Hello, world!';
            $result15 = (strlen($str15) > 5) ? substr($str15, 0, 5) . '...' : $str15;
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">15</span>
                    <span class="task-title">Обрезка строки</span>
                </div>
                <div class="task-description">
                    Если в строке более 5 символов, вырежите первые 5 и добавьте троеточие.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'Hello, world!'</span>;<br><span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">strlen</span>(<span style="color: #ffb86c;">$str</span>) > 5) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">substr</span>(<span style="color: #ffb86c;">$str</span>, 0, 5) . <span style="color: #f1fa8c;">'...'</span>;<br>} <span style="color: #50fa7b;">else</span> {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$str</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result15; ?></span>
                </div>
            </div>

            <!-- str_replace -->
            <div class="section-title">🔄 Работа с str_replace</div>

            <!-- Задача 16 -->
            <?php
            $str16 = '31.12.2013';
            $result16 = str_replace('.', '-', $str16);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">16</span>
                    <span class="task-title">Замена точек</span>
                </div>
                <div class="task-description">
                    Дана строка '31.12.2013'. Замените все точки на дефисы.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'31.12.2013'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">str_replace</span>(<span style="color: #f1fa8c;">'.'</span>, <span style="color: #f1fa8c;">'-'</span>, <span style="color: #ffb86c;">$str</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result16; ?></span>
                </div>
            </div>

            <!-- Задача 17 -->
            <?php
            $str17 = 'abcabc';
            $result17 = str_replace(['a', 'b', 'c'], [1, 2, 3], $str17);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">17</span>
                    <span class="task-title">Множественная замена</span>
                </div>
                <div class="task-description">
                    Замените в строке все буквы 'a' на 1, 'b' на 2, 'c' на 3.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'abcabc'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">str_replace</span>([<span style="color: #f1fa8c;">'a'</span>, <span style="color: #f1fa8c;">'b'</span>, <span style="color: #f1fa8c;">'c'</span>], [1, 2, 3], <span style="color: #ffb86c;">$str</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result17; ?></span>
                </div>
            </div>

            <!-- Задача 18 -->
            <?php
            $str18 = '1a2b3c4b5d6e7f8g9h0';
            $result18 = str_replace(range(0, 9), '', $str18);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">18</span>
                    <span class="task-title">Удаление цифр</span>
                </div>
                <div class="task-description">
                    Дана строка '1a2b3c4b5d6e7f8g9h0'. Удалите из нее все цифры.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'1a2b3c4b5d6e7f8g9h0'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">str_replace</span>(<span style="color: #50fa7b;">range</span>(0, 9), <span style="color: #f1fa8c;">''</span>, <span style="color: #ffb86c;">$str</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result18; ?></span>
                </div>
            </div>

            <!-- strtr -->
            <div class="section-title">🔄 Работа с strtr</div>

            <!-- Задача 19 -->
            <?php
            $str19 = 'abcabc';
            $result19_1 = strtr($str19, ['a' => 1, 'b' => 2, 'c' => 3]);
            $result19_2 = strtr($str19, 'abc', '123');
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">19</span>
                    <span class="task-title">strtr два способа</span>
                </div>
                <div class="task-description">
                    Замените буквы 'a' на 1, 'b' на 2, 'c' на 3 двумя способами.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'abcabc'</span>;<br><br><span style="color: #6272a4;">// Способ 1 (массив замен)</span><br><span style="color: #ffb86c;">$result1</span> = <span style="color: #50fa7b;">strtr</span>(<span style="color: #ffb86c;">$str</span>, [<span style="color: #f1fa8c;">'a'</span> => 1, <span style="color: #f1fa8c;">'b'</span> => 2, <span style="color: #f1fa8c;">'c'</span> => 3]);<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Способ 1: $result1\n"</span>;<br><br><span style="color: #6272a4;">// Способ 2 (две строки)</span><br><span style="color: #ffb86c;">$result2</span> = <span style="color: #50fa7b;">strtr</span>(<span style="color: #ffb86c;">$str</span>, <span style="color: #f1fa8c;">'abc'</span>, <span style="color: #f1fa8c;">'123'</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Способ 2: $result2"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline">Способ 1: <?php echo $result19_1; ?><br>Способ 2: <?php echo $result19_2; ?></span>
                </div>
            </div>

            <!-- substr_replace -->
            <div class="section-title">✂️ Работа с substr_replace</div>

            <!-- Задача 20 -->
            <?php
            $str20 = 'Hello, world!';
            $result20 = substr_replace($str20, '!!!', 3, 5);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">20</span>
                    <span class="task-title">substr_replace</span>
                </div>
                <div class="task-description">
                    Вырежите подстроку с 3-го символа, 5 штук и вставьте '!!!'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'Hello, world!'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">substr_replace</span>(<span style="color: #ffb86c;">$str</span>, <span style="color: #f1fa8c;">'!!!'</span>, 3, 5);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result20; ?></span>
                </div>
            </div>

            <!-- strpos, strrpos -->
            <div class="section-title">🔍 Работа с strpos, strrpos</div>

            <!-- Задача 21 -->
            <?php
            $str21 = 'abc abc abc';
            $pos21 = strpos($str21, 'b');
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">21</span>
                    <span class="task-title">Первое вхождение</span>
                </div>
                <div class="task-description">
                    Определите позицию первой буквы 'b' в строке 'abc abc abc'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'abc abc abc'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">strpos</span>(<span style="color: #ffb86c;">$str</span>, <span style="color: #f1fa8c;">'b'</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $pos21; ?></span>
                </div>
            </div>

            <!-- Задача 22 -->
            <?php
            $str22 = 'abc abc abc';
            $pos22 = strrpos($str22, 'b');
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">22</span>
                    <span class="task-title">Последнее вхождение</span>
                </div>
                <div class="task-description">
                    Определите позицию последней буквы 'b' в строке 'abc abc abc'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'abc abc abc'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">strrpos</span>(<span style="color: #ffb86c;">$str</span>, <span style="color: #f1fa8c;">'b'</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $pos22; ?></span>
                </div>
            </div>

            <!-- Задача 23 -->
            <?php
            $str23 = 'abc abc abc';
            $pos23 = strpos($str23, 'b', 3);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">23</span>
                    <span class="task-title">Поиск с позиции</span>
                </div>
                <div class="task-description">
                    Найдите позицию первой 'b' при поиске с позиции 3.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'abc abc abc'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">strpos</span>(<span style="color: #ffb86c;">$str</span>, <span style="color: #f1fa8c;">'b'</span>, 3);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $pos23; ?></span>
                </div>
            </div>

            <!-- Задача 24 -->
            <?php
            $str24 = 'aaa aaa aaa aaa aaa';
            $first_space = strpos($str24, ' ');
            $second_space = strpos($str24, ' ', $first_space + 1);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">24</span>
                    <span class="task-title">Второй пробел</span>
                </div>
                <div class="task-description">
                    Определите позицию второго пробела в строке 'aaa aaa aaa aaa aaa'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'aaa aaa aaa aaa aaa'</span>;<br><span style="color: #ffb86c;">$first</span> = <span style="color: #50fa7b;">strpos</span>(<span style="color: #ffb86c;">$str</span>, <span style="color: #f1fa8c;">' '</span>);<br><span style="color: #ffb86c;">$second</span> = <span style="color: #50fa7b;">strpos</span>(<span style="color: #ffb86c;">$str</span>, <span style="color: #f1fa8c;">' '</span>, <span style="color: #ffb86c;">$first</span> + 1);<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$second</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $second_space; ?></span>
                </div>
            </div>

            <!-- Задача 25 -->
            <?php
            $str25 = 'Hello.. World!';
            $has_double_dot = (strpos($str25, '..') !== false) ? 'есть' : 'нет';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">25</span>
                    <span class="task-title">Две точки подряд</span>
                </div>
                <div class="task-description">
                    Проверьте, что в строке есть две точки подряд.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'Hello.. World!'</span>;<br><span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">strpos</span>(<span style="color: #ffb86c;">$str</span>, <span style="color: #f1fa8c;">'..'</span>) !== <span style="color: #f1fa8c;">false</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'есть'</span>;<br>} <span style="color: #50fa7b;">else</span> {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'нет'</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $has_double_dot; ?></span>
                </div>
            </div>

            <!-- Задача 26 -->
            <?php
            $str26 = 'http://example.com';
            $check26 = (strpos($str26, 'http://') === 0) ? 'да' : 'нет';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">26</span>
                    <span class="task-title">Начинается на http://</span>
                </div>
                <div class="task-description">
                    Проверьте, что строка начинается на 'http://' с помощью strpos.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'http://example.com'</span>;<br><span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">strpos</span>(<span style="color: #ffb86c;">$str</span>, <span style="color: #f1fa8c;">'http://'</span>) === 0) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'да'</span>;<br>} <span style="color: #50fa7b;">else</span> {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'нет'</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $check26; ?></span>
                </div>
            </div>

            <!-- explode, implode -->
            <div class="section-title">🔀 Работа с explode, implode</div>

            <!-- Задача 27 -->
            <?php
            $str27 = 'html css php';
            $array27 = explode(' ', $str27);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">27</span>
                    <span class="task-title">explode</span>
                </div>
                <div class="task-description">
                    Разбейте строку 'html css php' на массив.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'html css php'</span>;<br><span style="color: #ffb86c;">$arr</span> = <span style="color: #50fa7b;">explode</span>(<span style="color: #f1fa8c;">' '</span>, <span style="color: #ffb86c;">$str</span>);<br><span style="color: #50fa7b;">print_r</span>(<span style="color: #ffb86c;">$arr</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php print_r($array27); ?></span>
                </div>
            </div>

            <!-- Задача 28 -->
            <?php
            $array28 = ['html', 'css', 'php'];
            $str28 = implode(', ', $array28);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">28</span>
                    <span class="task-title">implode</span>
                </div>
                <div class="task-description">
                    Создайте строку из массива ['html', 'css', 'php'] с разделителем запятая.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [<span style="color: #f1fa8c;">'html'</span>, <span style="color: #f1fa8c;">'css'</span>, <span style="color: #f1fa8c;">'php'</span>];<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">implode</span>(<span style="color: #f1fa8c;">', '</span>, <span style="color: #ffb86c;">$arr</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $str28; ?></span>
                </div>
            </div>

            <!-- Задача 29 -->
            <?php
            $date29 = '2013-12-31';
            $arr29 = explode('-', $date29);
            $result29 = $arr29[2] . '.' . $arr29[1] . '.' . $arr29[0];
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">29</span>
                    <span class="task-title">Формат даты</span>
                </div>
                <div class="task-description">
                    Преобразуйте дату '2013-12-31' в формат '31.12.2013'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$date</span> = <span style="color: #f1fa8c;">'2013-12-31'</span>;<br><span style="color: #ffb86c;">$arr</span> = <span style="color: #50fa7b;">explode</span>(<span style="color: #f1fa8c;">'-'</span>, <span style="color: #ffb86c;">$date</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$arr</span>[2] . <span style="color: #f1fa8c;">'.'</span> . <span style="color: #ffb86c;">$arr</span>[1] . <span style="color: #f1fa8c;">'.'</span> . <span style="color: #ffb86c;">$arr</span>[0];</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result29; ?></span>
                </div>
            </div>

            <!-- str_split -->
            <div class="section-title">✂️ Работа с str_split</div>

            <!-- Задача 30 -->
            <?php
            $str30 = '1234567890';
            $array30 = str_split($str30, 2);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">30</span>
                    <span class="task-title">str_split по 2 символа</span>
                </div>
                <div class="task-description">
                    Разбейте строку '1234567890' на массив по 2 символа.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'1234567890'</span>;<br><span style="color: #ffb86c;">$arr</span> = <span style="color: #50fa7b;">str_split</span>(<span style="color: #ffb86c;">$str</span>, 2);<br><span style="color: #50fa7b;">print_r</span>(<span style="color: #ffb86c;">$arr</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php print_r($array30); ?></span>
                </div>
            </div>

            <!-- Задача 31 -->
            <?php
            $str31 = '1234567890';
            $array31 = str_split($str31, 1);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">31</span>
                    <span class="task-title">str_split по 1 символу</span>
                </div>
                <div class="task-description">
                    Разбейте строку '1234567890' на массив из отдельных цифр.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'1234567890'</span>;<br><span style="color: #ffb86c;">$arr</span> = <span style="color: #50fa7b;">str_split</span>(<span style="color: #ffb86c;">$str</span>);<br><span style="color: #50fa7b;">print_r</span>(<span style="color: #ffb86c;">$arr</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php print_r($array31); ?></span>
                </div>
            </div>

            <!-- Задача 32 -->
            <?php
            $str32 = '1234567890';
            $arr32 = str_split($str32, 2);
            $result32 = implode('-', $arr32);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">32</span>
                    <span class="task-title">Форматирование без цикла</span>
                </div>
                <div class="task-description">
                    Сделайте из строки '1234567890' строку '12-34-56-78-90' без цикла.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'1234567890'</span>;<br><span style="color: #ffb86c;">$arr</span> = <span style="color: #50fa7b;">str_split</span>(<span style="color: #ffb86c;">$str</span>, 2);<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">implode</span>(<span style="color: #f1fa8c;">'-'</span>, <span style="color: #ffb86c;">$arr</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result32; ?></span>
                </div>
            </div>

            <!-- trim -->
            <div class="section-title">✂️ Работа с trim, ltrim, rtrim</div>

            <!-- Задача 33 -->
            <?php
            $str33 = '  Hello, World!  ';
            $result33 = trim($str33);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">33</span>
                    <span class="task-title">trim</span>
                </div>
                <div class="task-description">
                    Очистите строку от концевых пробелов.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'  Hello, World!  '</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'"'</span> . <span style="color: #50fa7b;">trim</span>(<span style="color: #ffb86c;">$str</span>) . <span style="color: #f1fa8c;">'"'</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value">"<?php echo $result33; ?>"</span>
                </div>
            </div>

            <!-- Задача 34 -->
            <?php
            $str34 = '/php/';
            $result34 = trim($str34, '/');
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">34</span>
                    <span class="task-title">trim с символами</span>
                </div>
                <div class="task-description">
                    Удалите концевые слеши из строки '/php/'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'/php/'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">trim</span>(<span style="color: #ffb86c;">$str</span>, <span style="color: #f1fa8c;">'/'</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result34; ?></span>
                </div>
            </div>

            <!-- Задача 35 -->
            <?php
            $str35 = 'слова слова слова';
            $result35 = rtrim($str35, '.') . '.';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">35</span>
                    <span class="task-title">Гарантированная точка</span>
                </div>
                <div class="task-description">
                    Сделайте так, чтобы в конце строки гарантированно стояла точка.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'слова слова слова'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">rtrim</span>(<span style="color: #ffb86c;">$str</span>, <span style="color: #f1fa8c;">'.'</span>) . <span style="color: #f1fa8c;">'.'</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result35; ?></span>
                </div>
            </div>

            <!-- strrev -->
            <div class="section-title">🔄 Работа с strrev</div>

            <!-- Задача 36 -->
            <?php
            $str36 = '12345';
            $result36 = strrev($str36);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">36</span>
                    <span class="task-title">strrev</span>
                </div>
                <div class="task-description">
                    Сделайте из строки '12345' строку '54321'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'12345'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">strrev</span>(<span style="color: #ffb86c;">$str</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result36; ?></span>
                </div>
            </div>

            <!-- Задача 37 -->
            <?php
            $word37 = 'madam';
            $is_palindrome = ($word37 == strrev($word37)) ? 'да, палиндром' : 'нет, не палиндром';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">37</span>
                    <span class="task-title">Палиндром</span>
                </div>
                <div class="task-description">
                    Проверьте, является ли слово 'madam' палиндромом.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$word</span> = <span style="color: #f1fa8c;">'madam'</span>;<br><span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$word</span> == <span style="color: #50fa7b;">strrev</span>(<span style="color: #ffb86c;">$word</span>)) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'да, палиндром'</span>;<br>} <span style="color: #50fa7b;">else</span> {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'нет, не палиндром'</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $is_palindrome; ?></span>
                </div>
            </div>

            <!-- str_shuffle -->
            <div class="section-title">🎲 Работа с str_shuffle</div>

            <!-- Задача 38 -->
            <?php
            $str38 = 'abcdef';
            $shuffled38 = str_shuffle($str38);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">38</span>
                    <span class="task-title">str_shuffle</span>
                </div>
                <div class="task-description">
                    Перемешайте символы строки в случайном порядке.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'abcdef'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">str_shuffle</span>(<span style="color: #ffb86c;">$str</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $shuffled38; ?> (случайный порядок)</span>
                </div>
            </div>

            <!-- Задача 39 -->
            <?php
            $letters39 = range('a', 'z');
            shuffle($letters39);
            $random39 = implode('', array_slice($letters39, 0, 6));
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">39</span>
                    <span class="task-title">Случайные буквы без повторов</span>
                </div>
                <div class="task-description">
                    Создайте строку из 6 случайных маленьких латинских букв без повторов.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$letters</span> = <span style="color: #50fa7b;">range</span>(<span style="color: #f1fa8c;">'a'</span>, <span style="color: #f1fa8c;">'z'</span>);<br><span style="color: #50fa7b;">shuffle</span>(<span style="color: #ffb86c;">$letters</span>);<br><span style="color: #ffb86c;">$random</span> = <span style="color: #50fa7b;">implode</span>(<span style="color: #f1fa8c;">''</span>, <span style="color: #50fa7b;">array_slice</span>(<span style="color: #ffb86c;">$letters</span>, 0, 6));<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$random</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $random39; ?></span>
                </div>
            </div>

            <!-- number_format -->
            <div class="section-title">🔢 Работа с number_format</div>

            <!-- Задача 40 -->
            <?php
            $num40 = '12345678';
            $formatted40 = number_format($num40, 0, '', ' ');
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">40</span>
                    <span class="task-title">number_format</span>
                </div>
                <div class="task-description">
                    Сделайте из строки '12345678' строку '12 345 678'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$num</span> = <span style="color: #f1fa8c;">'12345678'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">number_format</span>(<span style="color: #ffb86c;">$num</span>, 0, <span style="color: #f1fa8c;">''</span>, <span style="color: #f1fa8c;">' '</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $formatted40; ?></span>
                </div>
            </div>

            <!-- str_repeat -->
            <div class="section-title">🔁 Работа с str_repeat</div>

            <!-- Задача 41 -->
            <?php
            $pyramid41 = '';
            for ($i = 1; $i <= 9; $i++) {
                $pyramid41 .= str_repeat('x', $i) . "\n";
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">41</span>
                    <span class="task-title">Пирамида из x</span>
                </div>
                <div class="task-description">
                    Нарисуйте пирамиду из 9 рядов с помощью str_repeat.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = 1; <span style="color: #ffb86c;">$i</span> <= 9; <span style="color: #ffb86c;">$i</span>++) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">str_repeat</span>(<span style="color: #f1fa8c;">'x'</span>, <span style="color: #ffb86c;">$i</span>) . <span style="color: #f1fa8c;">"\n"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline pyramid-line"><?php echo $pyramid41; ?></span>
                </div>
            </div>

            <!-- Задача 42 -->
            <?php
            $pyramid42 = '';
            for ($i = 1; $i <= 9; $i++) {
                $pyramid42 .= str_repeat((string)$i, $i) . "\n";
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">42</span>
                    <span class="task-title">Пирамида из цифр</span>
                </div>
                <div class="task-description">
                    Нарисуйте пирамиду из цифр: 1, 22, 333, ... 999999999.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = 1; <span style="color: #ffb86c;">$i</span> <= 9; <span style="color: #ffb86c;">$i</span>++) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">str_repeat</span>((<span style="color: #f1fa8c;">string</span>)<span style="color: #ffb86c;">$i</span>, <span style="color: #ffb86c;">$i</span>) . <span style="color: #f1fa8c;">"\n"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline pyramid-line"><?php echo $pyramid42; ?></span>
                </div>
            </div>

            <!-- strip_tags и htmlspecialchars -->
            <div class="section-title">🏷️ Работа с strip_tags и htmlspecialchars</div>

            <!-- Задача 43 -->
            <?php
            $str43 = 'html, <b>php</b>, js';
            $stripped43 = strip_tags($str43);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">43</span>
                    <span class="task-title">strip_tags</span>
                </div>
                <div class="task-description">
                    Удалите теги из строки 'html, &lt;b&gt;php&lt;/b&gt;, js'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'html, &lt;b&gt;php&lt;/b&gt;, js'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">strip_tags</span>(<span style="color: #ffb86c;">$str</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $stripped43; ?></span>
                </div>
            </div>

            <!-- Задача 44 -->
            <?php
            $str44 = 'html, <b>php</b>, <i>js</i>, <u>css</u>';
            $stripped44 = strip_tags($str44, '<b><i>');
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">44</span>
                    <span class="task-title">strip_tags с исключениями</span>
                </div>
                <div class="task-description">
                    Удалите все теги, кроме &lt;b&gt; и &lt;i&gt;.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'html, &lt;b&gt;php&lt;/b&gt;, &lt;i&gt;js&lt;/i&gt;, &lt;u&gt;css&lt;/u&gt;'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">strip_tags</span>(<span style="color: #ffb86c;">$str</span>, <span style="color: #f1fa8c;">'&lt;b&gt;&lt;i&gt;'</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $stripped44; ?></span>
                </div>
            </div>

            <!-- Задача 45 -->
            <?php
            $str45 = 'html, <b>php</b>, js';
            $escaped45 = htmlspecialchars($str45);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">45</span>
                    <span class="task-title">htmlspecialchars</span>
                </div>
                <div class="task-description">
                    Выведите строку 'html, &lt;b&gt;php&lt;/b&gt;, js' как есть (браузер не должен преобразовать теги).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'html, &lt;b&gt;php&lt;/b&gt;, js'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">htmlspecialchars</span>(<span style="color: #ffb86c;">$str</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $escaped45; ?></span>
                </div>
            </div>

            <!-- chr и ord -->
            <div class="section-title">🔢 Работа с chr и ord</div>

            <!-- Задача 46 -->
            <?php
            $codes46 = [
                'a' => ord('a'),
                'b' => ord('b'),
                'c' => ord('c'),
                'пробел' => ord(' ')
            ];
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">46</span>
                    <span class="task-title">ord</span>
                </div>
                <div class="task-description">
                    Узнайте код символов 'a', 'b', 'c', пробела.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'a: '</span> . <span style="color: #50fa7b;">ord</span>(<span style="color: #f1fa8c;">'a'</span>) . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'b: '</span> . <span style="color: #50fa7b;">ord</span>(<span style="color: #f1fa8c;">'b'</span>) . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'c: '</span> . <span style="color: #50fa7b;">ord</span>(<span style="color: #f1fa8c;">'c'</span>) . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'пробел: '</span> . <span style="color: #50fa7b;">ord</span>(<span style="color: #f1fa8c;">' '</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline"><?php 
                        echo "a: {$codes46['a']}\nb: {$codes46['b']}\nc: {$codes46['c']}\nпробел: {$codes46['пробел']}";
                    ?></span>
                </div>
            </div>

            <!-- Задача 47 -->
            <?php
            $lower_start = ord('a');
            $lower_end = ord('z');
            $upper_start = ord('A');
            $upper_end = ord('Z');
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">47</span>
                    <span class="task-title">Границы ASCII</span>
                </div>
                <div class="task-description">
                    Определите границы букв английского алфавита в таблице ASCII.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'a-z: '</span> . <span style="color: #50fa7b;">ord</span>(<span style="color: #f1fa8c;">'a'</span>) . <span style="color: #f1fa8c;">'-'</span> . <span style="color: #50fa7b;">ord</span>(<span style="color: #f1fa8c;">'z'</span>) . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'A-Z: '</span> . <span style="color: #50fa7b;">ord</span>(<span style="color: #f1fa8c;">'A'</span>) . <span style="color: #f1fa8c;">'-'</span> . <span style="color: #50fa7b;">ord</span>(<span style="color: #f1fa8c;">'Z'</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value multiline">a-z: <?php echo $lower_start; ?>-<?php echo $lower_end; ?><br>A-Z: <?php echo $upper_start; ?>-<?php echo $upper_end; ?></span>
                </div>
            </div>

            <!-- Задача 48 -->
            <?php
            $char48 = chr(33);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">48</span>
                    <span class="task-title">chr</span>
                </div>
                <div class="task-description">
                    Выведите на экран символ с кодом 33.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">chr</span>(33);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value">'<?php echo $char48; ?>'</span>
                </div>
            </div>

            <!-- Задача 49 -->
            <?php
            $random_upper = chr(rand(65, 90));
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">49</span>
                    <span class="task-title">Случайная большая буква</span>
                </div>
                <div class="task-description">
                    Запишите в переменную случайный символ - большую букву латинского алфавита.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #50fa7b;">chr</span>(<span style="color: #50fa7b;">rand</span>(65, 90));<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$str</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $random_upper; ?></span>
                </div>
            </div>

            <!-- Задача 50 -->
            <?php
            $len50 = 8;
            $random50 = '';
            for ($i = 0; $i < $len50; $i++) {
                $random50 .= chr(rand(97, 122));
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">50</span>
                    <span class="task-title">Случайная строка из маленьких букв</span>
                </div>
                <div class="task-description">
                    Создайте случайную строку заданной длины из маленьких латинских букв.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$len</span> = 8;<br><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">''</span>;<br><span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = 0; <span style="color: #ffb86c;">$i</span> < <span style="color: #ffb86c;">$len</span>; <span style="color: #ffb86c;">$i</span>++) {<br>    <span style="color: #ffb86c;">$str</span> .= <span style="color: #50fa7b;">chr</span>(<span style="color: #50fa7b;">rand</span>(97, 122));<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$str</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $random50; ?></span>
                </div>
            </div>

            <!-- Задача 51 -->
            <?php
            $letter51 = 'G';
            $case51 = (ord($letter51) >= 65 && ord($letter51) <= 90) ? 'большая' : 'маленькая';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">51</span>
                    <span class="task-title">Определение регистра</span>
                </div>
                <div class="task-description">
                    Определите, буква 'G' маленькая или большая.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$letter</span> = <span style="color: #f1fa8c;">'G'</span>;<br><span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">ord</span>(<span style="color: #ffb86c;">$letter</span>) >= 65 && <span style="color: #50fa7b;">ord</span>(<span style="color: #ffb86c;">$letter</span>) <= 90) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'большая'</span>;<br>} <span style="color: #50fa7b;">else</span> {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">'маленькая'</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value">Буква '<?php echo $letter51; ?>' - <?php echo $case51; ?></span>
                </div>
            </div>

            <!-- strchr, strrchr -->
            <div class="section-title">🔍 Работа с strchr, strrchr</div>

            <!-- Задача 52 -->
            <?php
            $str52 = 'ab-cd-ef';
            $result52 = strchr($str52, '-');
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">52</span>
                    <span class="task-title">strchr</span>
                </div>
                <div class="task-description">
                    С помощью функции strchr выведите на экран строку '-cd-ef' из 'ab-cd-ef'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'ab-cd-ef'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">strchr</span>(<span style="color: #ffb86c;">$str</span>, <span style="color: #f1fa8c;">'-'</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result52; ?></span>
                </div>
            </div>

            <!-- Задача 53 -->
            <?php
            $str53 = 'ab-cd-ef';
            $result53 = strrchr($str53, '-');
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">53</span>
                    <span class="task-title">strrchr</span>
                </div>
                <div class="task-description">
                    С помощью функции strrchr выведите на экран строку '-ef' из 'ab-cd-ef'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'ab-cd-ef'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">strrchr</span>(<span style="color: #ffb86c;">$str</span>, <span style="color: #f1fa8c;">'-'</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result53; ?></span>
                </div>
            </div>

            <!-- strstr -->
            <div class="section-title">🔍 Работа с strstr</div>

            <!-- Задача 54 -->
            <?php
            $str54 = 'ab--cd--ef';
            $result54 = strstr($str54, '-cd');
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">54</span>
                    <span class="task-title">strstr</span>
                </div>
                <div class="task-description">
                    С помощью функции strstr выведите на экран строку '-cd--ef' из 'ab--cd--ef'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'ab--cd--ef'</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">strstr</span>(<span style="color: #ffb86c;">$str</span>, <span style="color: #f1fa8c;">'-cd'</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result54; ?></span>
                </div>
            </div>

            <!-- Задачи -->
            <div class="section-title">⭐ Задачи</div>

            <!-- Задача 55 -->
            <?php
            $str55 = 'var_test_text';
            $parts55 = explode('_', $str55);
            $result55 = $parts55[0];
            for ($i = 1; $i < count($parts55); $i++) {
                $result55 .= ucfirst($parts55[$i]);
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">55</span>
                    <span class="task-title">snake_case в camelCase</span>
                </div>
                <div class="task-description">
                    Преобразуйте строку 'var_test_text' в 'varTestText'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$str</span> = <span style="color: #f1fa8c;">'var_test_text'</span>;<br><span style="color: #ffb86c;">$parts</span> = <span style="color: #50fa7b;">explode</span>(<span style="color: #f1fa8c;">'_'</span>, <span style="color: #ffb86c;">$str</span>);<br><span style="color: #ffb86c;">$result</span> = <span style="color: #ffb86c;">$parts</span>[0];<br><span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$i</span> = 1; <span style="color: #ffb86c;">$i</span> < <span style="color: #50fa7b;">count</span>(<span style="color: #ffb86c;">$parts</span>); <span style="color: #ffb86c;">$i</span>++) {<br>    <span style="color: #ffb86c;">$result</span> .= <span style="color: #50fa7b;">ucfirst</span>(<span style="color: #ffb86c;">$parts</span>[<span style="color: #ffb86c;">$i</span>]);<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$result</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo $result55; ?></span>
                </div>
            </div>

            <!-- Задача 56 -->
            <?php
            $array56 = [123, 456, 789, 321, 654, 987, 234, 567];
            $result56 = [];
            foreach ($array56 as $num) {
                if (strpos((string)$num, '3') !== false) {
                    $result56[] = $num;
                }
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">56</span>
                    <span class="task-title">Поиск цифры 3</span>
                </div>
                <div class="task-description">
                    Выведите все числа из массива, в которых есть цифра 3.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$arr</span> = [123, 456, 789, 321, 654, 987, 234, 567];<br><span style="color: #ffb86c;">$result</span> = [];<br><span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$arr</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$num</span>) {<br>    <span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">strpos</span>((<span style="color: #f1fa8c;">string</span>)<span style="color: #ffb86c;">$num</span>, <span style="color: #f1fa8c;">'3'</span>) !== <span style="color: #f1fa8c;">false</span>) {<br>        <span style="color: #ffb86c;">$result</span>[] = <span style="color: #ffb86c;">$num</span>;<br>    }<br>}<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">implode</span>(<span style="color: #f1fa8c;">' '</span>, <span style="color: #ffb86c;">$result</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-value"><?php echo implode(' ', $result56); ?></span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>