<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Практическая работа: Дата и время в PHP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #E67E22 0%, #D35400 100%);
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
            background: linear-gradient(135deg, #ffffff 0%, #ffe0b0 100%);
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
            background: linear-gradient(135deg, #E67E22 0%, #D35400 100%);
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
            border-left: 4px solid #E67E22;
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

        .week-days {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 10px 0;
        }

        .week-day {
            background: #38a169;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.9rem;
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

        .form-container {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin: 10px 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #4a5568;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #E67E22;
            box-shadow: 0 0 0 3px rgba(230, 126, 34, 0.1);
        }

        .btn {
            background: linear-gradient(135deg, #E67E22 0%, #D35400 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
            width: 100%;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(230, 126, 34, 0.4);
        }

        .btn:active {
            transform: translateY(0);
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
            <p>Дата и время в PHP: timestamp, date, mktime, strtotime</p>
        </div>

        <div class="tasks-grid">
            <!-- TIMESTAMP: time и mktime -->
            <div class="section-title">⏱️ Timestamp: time и mktime</div>

            <!-- Задача 1 -->
            <?php
            $timestamp1 = time();
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">1</span>
                    <span class="task-title">Текущий timestamp</span>
                </div>
                <div class="task-description">
                    Выведите текущее время в формате timestamp.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$timestamp</span> = <span style="color: #50fa7b;">time</span>();<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$timestamp</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-content"><?php echo $timestamp1; ?></span>
                </div>
            </div>

            <!-- Задача 2 -->
            <?php
            $timestamp2 = mktime(0, 0, 0, 3, 1, 2025);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">Timestamp 1 марта 2025</span>
                </div>
                <div class="task-description">
                    Выведите 1 марта 2025 года в формате timestamp.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$timestamp</span> = <span style="color: #50fa7b;">mktime</span>(0, 0, 0, 3, 1, 2025);<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$timestamp</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-content"><?php echo $timestamp2; ?></span>
                </div>
            </div>

            <!-- Задача 3 -->
            <?php
            $timestamp3 = mktime(0, 0, 0, 12, 31, date('Y'));
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">3</span>
                    <span class="task-title">Timestamp 31 декабря</span>
                </div>
                <div class="task-description">
                    Выведите 31 декабря текущего года в формате timestamp. Скрипт должен работать независимо от года.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$timestamp</span> = <span style="color: #50fa7b;">mktime</span>(0, 0, 0, 12, 31, <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'Y'</span>));<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$timestamp</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-content"><?php echo $timestamp3; ?></span>
                </div>
            </div>

            <!-- Задача 4 -->
            <?php
            $seconds4 = time() - mktime(13, 12, 59, 3, 15, 2000);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4</span>
                    <span class="task-title">Секунд с 15.03.2000 13:12:59</span>
                </div>
                <div class="task-description">
                    Найдите количество секунд, прошедших с 13:12:59 15-го марта 2000 года до настоящего момента.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$seconds</span> = <span style="color: #50fa7b;">time</span>() - <span style="color: #50fa7b;">mktime</span>(13, 12, 59, 3, 15, 2000);<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$seconds</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-content"><?php echo number_format($seconds4, 0, '', ' '); ?> секунд</span>
                </div>
            </div>

            <!-- Задача 5 -->
            <?php
            $seconds_today = time() - mktime(7, 23, 48, date('m'), date('d'), date('Y'));
            $hours5 = floor($seconds_today / 3600);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">5</span>
                    <span class="task-title">Часов с 7:23:48</span>
                </div>
                <div class="task-description">
                    Найдите количество целых часов, прошедших с 7:23:48 текущего дня до настоящего момента.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$seconds</span> = <span style="color: #50fa7b;">time</span>() - <span style="color: #50fa7b;">mktime</span>(7, 23, 48, <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'m'</span>), <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'d'</span>), <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'Y'</span>));<br><span style="color: #ffb86c;">$hours</span> = <span style="color: #50fa7b;">floor</span>(<span style="color: #ffb86c;">$seconds</span> / 3600);<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$hours</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-content"><?php echo $hours5; ?> часов</span>
                </div>
            </div>

            <!-- Функция date -->
            <div class="section-title">📅 Функция date</div>

            <!-- Задача 6 -->
            <?php
            $year6 = date('Y');
            $month6 = date('m');
            $day6 = date('d');
            $hour6 = date('H');
            $minute6 = date('i');
            $second6 = date('s');
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">6</span>
                    <span class="task-title">Текущие дата и время</span>
                </div>
                <div class="task-description">
                    Выведите на экран текущий год, месяц, день, час, минуту, секунду.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Год: "</span> . <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'Y'</span>) . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Месяц: "</span> . <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'m'</span>) . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"День: "</span> . <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'d'</span>) . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Час: "</span> . <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'H'</span>) . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Минута: "</span> . <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'i'</span>) . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Секунда: "</span> . <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'s'</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Год</span>
                        <span class="result-content"><?php echo $year6; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Месяц</span>
                        <span class="result-content"><?php echo $month6; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">День</span>
                        <span class="result-content"><?php echo $day6; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Час</span>
                        <span class="result-content"><?php echo $hour6; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Минута</span>
                        <span class="result-content"><?php echo $minute6; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Секунда</span>
                        <span class="result-content"><?php echo $second6; ?></span>
                    </div>
                </div>
            </div>

            <!-- Задача 7 -->
            <?php
            $format1 = date('Y-m-d');
            $format2 = date('d.m.Y');
            $format3 = date('d.m.y');
            $format4 = date('H:i:s');
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">7</span>
                    <span class="task-title">Форматы даты</span>
                </div>
                <div class="task-description">
                    Выведите текущую дату-время в форматах '2025-12-31', '31.12.2025', '31.12.13', '12:59:59'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'Y-m-d'</span>) . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'d.m.Y'</span>) . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'d.m.y'</span>) . <span style="color: #f1fa8c;">"\n"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'H:i:s'</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Y-m-d</span>
                        <span class="result-content"><?php echo $format1; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">d.m.Y</span>
                        <span class="result-content"><?php echo $format2; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">d.m.y</span>
                        <span class="result-content"><?php echo $format3; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">H:i:s</span>
                        <span class="result-content"><?php echo $format4; ?></span>
                    </div>
                </div>
            </div>

            <!-- Задача 8 -->
            <?php
            $date8 = date('d.m.Y', mktime(0, 0, 0, 2, 12, 2025));
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">8</span>
                    <span class="task-title">Форматирование даты</span>
                </div>
                <div class="task-description">
                    С помощью функций mktime и date выведите 12 февраля 2025 года в формате '12.02.2025'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$timestamp</span> = <span style="color: #50fa7b;">mktime</span>(0, 0, 0, 2, 12, 2025);<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'d.m.Y'</span>, <span style="color: #ffb86c;">$timestamp</span>);</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-content"><?php echo $date8; ?></span>
                </div>
            </div>

            <!-- Задача 9 -->
            <?php
            $week = ['вс', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб'];
            $current_day_num = date('w');
            $current_day_word = $week[$current_day_num];
            
            $day2006_num = date('w', mktime(0, 0, 0, 6, 6, 2006));
            $day2006_word = $week[$day2006_num];
            
            $birthday_num = date('w', mktime(0, 0, 0, 3, 20, 1995)); // пример дня рождения
            $birthday_word = $week[$birthday_num];
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">9</span>
                    <span class="task-title">Дни недели</span>
                </div>
                <div class="task-description">
                    Выведите название текущего дня недели, день недели 06.06.2006 и ваш день рождения.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$week</span> = [<span style="color: #f1fa8c;">'вс'</span>, <span style="color: #f1fa8c;">'пн'</span>, <span style="color: #f1fa8c;">'вт'</span>, <span style="color: #f1fa8c;">'ср'</span>, <span style="color: #f1fa8c;">'чт'</span>, <span style="color: #f1fa8c;">'пт'</span>, <span style="color: #f1fa8c;">'сб'</span>];<br><br><span style="color: #ffb86c;">$current</span> = <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'w'</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Сегодня: "</span> . <span style="color: #ffb86c;">$week</span>[<span style="color: #ffb86c;">$current</span>] . <span style="color: #f1fa8c;">"\n"</span>;<br><br><span style="color: #ffb86c;">$day2006</span> = <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'w'</span>, <span style="color: #50fa7b;">mktime</span>(0, 0, 0, 6, 6, 2006));<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"06.06.2006: "</span> . <span style="color: #ffb86c;">$week</span>[<span style="color: #ffb86c;">$day2006</span>] . <span style="color: #f1fa8c;">"\n"</span>;<br><br><span style="color: #ffb86c;">$birthday</span> = <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'w'</span>, <span style="color: #50fa7b;">mktime</span>(0, 0, 0, 3, 20, 1995));<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"День рождения: "</span> . <span style="color: #ffb86c;">$week</span>[<span style="color: #ffb86c;">$birthday</span>];</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Сегодня</span>
                        <span class="result-content"><?php echo $current_day_word; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">06.06.2006</span>
                        <span class="result-content"><?php echo $day2006_word; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">День рождения</span>
                        <span class="result-content"><?php echo $birthday_word; ?> (пример: 20.03.1995)</span>
                    </div>
                </div>
            </div>

            <!-- Задача 10 -->
            <?php
            $months = ['январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 
                      'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь'];
            $current_month_num = date('n') - 1; // date('n') возвращает 1-12
            $current_month_word = $months[$current_month_num];
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">10</span>
                    <span class="task-title">Название месяца</span>
                </div>
                <div class="task-description">
                    Выведите на экран название текущего месяца с помощью массива $month и функции date.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$months</span> = [<span style="color: #f1fa8c;">'январь'</span>, <span style="color: #f1fa8c;">'февраль'</span>, <span style="color: #f1fa8c;">'март'</span>, ...];<br><span style="color: #ffb86c;">$month_num</span> = <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'n'</span>) - 1;<br><span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$months</span>[<span style="color: #ffb86c;">$month_num</span>];</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-content"><?php echo $current_month_word; ?></span>
                </div>
            </div>

            <!-- Задача 11 -->
            <?php
            $days_in_month = date('t');
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">11</span>
                    <span class="task-title">Дней в текущем месяце</span>
                </div>
                <div class="task-description">
                    Найдите количество дней в текущем месяце. Скрипт должен работать независимо от месяца.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$days</span> = <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'t'</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"В текущем месяце $days дней"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-content"><?php echo $days_in_month; ?> дней</span>
                </div>
            </div>

            <!-- Задача 12 -->
            <?php
            $leap_year_result = '';
            if (isset($_POST['check_year'])) {
                $year = intval($_POST['year'] ?? 0);
                if ($year > 0) {
                    $is_leap = checkdate(2, 29, $year);
                    $leap_year_result = $is_leap ? "Год $year - високосный" : "Год $year - не високосный";
                }
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">12</span>
                    <span class="task-title">Високосный год</span>
                </div>
                <div class="task-description">
                    Пользователь вводит год, скрипт определяет високосный ли год.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$year</span> = <span style="color: #50fa7b;">intval</span>(<span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'year'</span>] ?? 0);<br><span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$year</span> > 0) {<br>    <span style="color: #ffb86c;">$is_leap</span> = <span style="color: #50fa7b;">checkdate</span>(2, 29, <span style="color: #ffb86c;">$year</span>);<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$is_leap</span> ? <span style="color: #f1fa8c;">"Год $year - високосный"</span> : <span style="color: #f1fa8c;">"Год $year - не високосный"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="form-container">
                        <form method="POST">
                            <div class="form-group">
                                <label>Введите год (4 цифры):</label>
                                <input type="number" name="year" class="form-control" min="1" max="9999" required>
                            </div>
                            <button type="submit" name="check_year" class="btn">Проверить</button>
                        </form>
                        <?php if ($leap_year_result): ?>
                            <div class="alert alert-success" style="margin-top: 15px;">
                                <?php echo $leap_year_result; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Задача 13 -->
            <?php
            $date13_result = '';
            if (isset($_POST['check_date13'])) {
                $date_str = $_POST['date'] ?? '';
                $parts = explode('.', $date_str);
                if (count($parts) == 3) {
                    $day = intval($parts[0]);
                    $month = intval($parts[1]);
                    $year = intval($parts[2]);
                    
                    if (checkdate($month, $day, $year)) {
                        $timestamp = mktime(0, 0, 0, $month, $day, $year);
                        $week_days = ['вс', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб'];
                        $week_day_num = date('w', $timestamp);
                        $week_day_word = $week_days[$week_day_num];
                        $date13_result = "Дата: $date_str, день недели: $week_day_word";
                    } else {
                        $date13_result = "Некорректная дата";
                    }
                }
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">13</span>
                    <span class="task-title">День недели по дате</span>
                </div>
                <div class="task-description">
                    Введите дату в формате '31.12.2025'. Скрипт определит день недели.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$date_str</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'date'</span>] ?? <span style="color: #f1fa8c;">''</span>;<br><span style="color: #ffb86c;">$parts</span> = <span style="color: #50fa7b;">explode</span>(<span style="color: #f1fa8c;">'.'</span>, <span style="color: #ffb86c;">$date_str</span>);<br><br><span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">count</span>(<span style="color: #ffb86c;">$parts</span>) == 3) {<br>    <span style="color: #ffb86c;">$day</span> = <span style="color: #50fa7b;">intval</span>(<span style="color: #ffb86c;">$parts</span>[0]);<br>    <span style="color: #ffb86c;">$month</span> = <span style="color: #50fa7b;">intval</span>(<span style="color: #ffb86c;">$parts</span>[1]);<br>    <span style="color: #ffb86c;">$year</span> = <span style="color: #50fa7b;">intval</span>(<span style="color: #ffb86c;">$parts</span>[2]);<br>    <br>    <span style="color: #ffb86c;">$timestamp</span> = <span style="color: #50fa7b;">mktime</span>(0, 0, 0, <span style="color: #ffb86c;">$month</span>, <span style="color: #ffb86c;">$day</span>, <span style="color: #ffb86c;">$year</span>);<br>    <span style="color: #ffb86c;">$week_days</span> = [<span style="color: #f1fa8c;">'вс'</span>, <span style="color: #f1fa8c;">'пн'</span>, <span style="color: #f1fa8c;">'вт'</span>, <span style="color: #f1fa8c;">'ср'</span>, <span style="color: #f1fa8c;">'чт'</span>, <span style="color: #f1fa8c;">'пт'</span>, <span style="color: #f1fa8c;">'сб'</span>];<br>    <span style="color: #ffb86c;">$week_day</span> = <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'w'</span>, <span style="color: #ffb86c;">$timestamp</span>);<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"День недели: "</span> . <span style="color: #ffb86c;">$week_days</span>[<span style="color: #ffb86c;">$week_day</span>];<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="form-container">
                        <form method="POST">
                            <div class="form-group">
                                <label>Введите дату (дд.мм.гггг):</label>
                                <input type="text" name="date" class="form-control" placeholder="31.12.2025" required>
                            </div>
                            <button type="submit" name="check_date13" class="btn">Определить</button>
                        </form>
                        <?php if ($date13_result): ?>
                            <div class="alert alert-success" style="margin-top: 15px;">
                                <?php echo $date13_result; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Задача 14 -->
            <?php
            $date14_result = '';
            if (isset($_POST['check_date14'])) {
                $date_str = $_POST['date'] ?? '';
                $parts = explode('-', $date_str);
                if (count($parts) == 3) {
                    $year = intval($parts[0]);
                    $month = intval($parts[1]);
                    $day = intval($parts[2]);
                    
                    if (checkdate($month, $day, $year)) {
                        $timestamp = mktime(0, 0, 0, $month, $day, $year);
                        $months = ['январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 
                                  'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь'];
                        $month_name = $months[$month - 1];
                        $date14_result = "Дата: $date_str, месяц: $month_name";
                    } else {
                        $date14_result = "Некорректная дата";
                    }
                }
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">14</span>
                    <span class="task-title">Название месяца</span>
                </div>
                <div class="task-description">
                    Введите дату в формате '2025-12-31'. Скрипт определит название месяца.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$date_str</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'date'</span>] ?? <span style="color: #f1fa8c;">''</span>;<br><span style="color: #ffb86c;">$parts</span> = <span style="color: #50fa7b;">explode</span>(<span style="color: #f1fa8c;">'-'</span>, <span style="color: #ffb86c;">$date_str</span>);<br><br><span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">count</span>(<span style="color: #ffb86c;">$parts</span>) == 3) {<br>    <span style="color: #ffb86c;">$year</span> = <span style="color: #50fa7b;">intval</span>(<span style="color: #ffb86c;">$parts</span>[0]);<br>    <span style="color: #ffb86c;">$month</span> = <span style="color: #50fa7b;">intval</span>(<span style="color: #ffb86c;">$parts</span>[1]);<br>    <span style="color: #ffb86c;">$day</span> = <span style="color: #50fa7b;">intval</span>(<span style="color: #ffb86c;">$parts</span>[2]);<br>    <br>    <span style="color: #ffb86c;">$timestamp</span> = <span style="color: #50fa7b;">mktime</span>(0, 0, 0, <span style="color: #ffb86c;">$month</span>, <span style="color: #ffb86c;">$day</span>, <span style="color: #ffb86c;">$year</span>);<br>    <span style="color: #ffb86c;">$months</span> = [<span style="color: #f1fa8c;">'январь'</span>, <span style="color: #f1fa8c;">'февраль'</span>, ...];<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Месяц: "</span> . <span style="color: #ffb86c;">$months</span>[<span style="color: #ffb86c;">$month</span> - 1];<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="form-container">
                        <form method="POST">
                            <div class="form-group">
                                <label>Введите дату (гггг-мм-дд):</label>
                                <input type="text" name="date" class="form-control" placeholder="2025-12-31" required>
                            </div>
                            <button type="submit" name="check_date14" class="btn">Определить</button>
                        </form>
                        <?php if ($date14_result): ?>
                            <div class="alert alert-success" style="margin-top: 15px;">
                                <?php echo $date14_result; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Сравнение дат -->
            <div class="section-title">⚖️ Сравнение дат</div>

            <!-- Задача 15 -->
            <?php
            $compare_result = '';
            if (isset($_POST['compare_dates'])) {
                $date1_str = $_POST['date1'] ?? '';
                $date2_str = $_POST['date2'] ?? '';
                
                $parts1 = explode('-', $date1_str);
                $parts2 = explode('-', $date2_str);
                
                if (count($parts1) == 3 && count($parts2) == 3) {
                    $timestamp1 = mktime(0, 0, 0, intval($parts1[1]), intval($parts1[2]), intval($parts1[0]));
                    $timestamp2 = mktime(0, 0, 0, intval($parts2[1]), intval($parts2[2]), intval($parts2[0]));
                    
                    if ($timestamp1 > $timestamp2) {
                        $compare_result = "Первая дата ($date1_str) больше";
                    } elseif ($timestamp2 > $timestamp1) {
                        $compare_result = "Вторая дата ($date2_str) больше";
                    } else {
                        $compare_result = "Даты равны";
                    }
                }
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">15</span>
                    <span class="task-title">Сравнение дат</span>
                </div>
                <div class="task-description">
                    Введите две даты в формате '2025-12-31'. Определите, какая из них больше.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$date1</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'date1'</span>] ?? <span style="color: #f1fa8c;">''</span>;<br><span style="color: #ffb86c;">$date2</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'date2'</span>] ?? <span style="color: #f1fa8c;">''</span>;<br><br><span style="color: #ffb86c;">$t1</span> = <span style="color: #50fa7b;">strtotime</span>(<span style="color: #ffb86c;">$date1</span>);<br><span style="color: #ffb86c;">$t2</span> = <span style="color: #50fa7b;">strtotime</span>(<span style="color: #ffb86c;">$date2</span>);<br><br><span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$t1</span> > <span style="color: #ffb86c;">$t2</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Первая дата больше"</span>;<br>} <span style="color: #50fa7b;">elseif</span> (<span style="color: #ffb86c;">$t2</span> > <span style="color: #ffb86c;">$t1</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Вторая дата больше"</span>;<br>} <span style="color: #50fa7b;">else</span> {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Даты равны"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="form-container">
                        <form method="POST">
                            <div class="form-group">
                                <label>Первая дата (гггг-мм-дд):</label>
                                <input type="text" name="date1" class="form-control" placeholder="2025-12-31" required>
                            </div>
                            <div class="form-group">
                                <label>Вторая дата (гггг-мм-дд):</label>
                                <input type="text" name="date2" class="form-control" placeholder="2025-01-01" required>
                            </div>
                            <button type="submit" name="compare_dates" class="btn">Сравнить</button>
                        </form>
                        <?php if ($compare_result): ?>
                            <div class="alert alert-success" style="margin-top: 15px;">
                                <?php echo $compare_result; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- На strtotime -->
            <div class="section-title">🔄 Работа с strtotime</div>

            <!-- Задача 16 -->
            <?php
            $convert16_result = '';
            if (isset($_POST['convert16'])) {
                $date_str = $_POST['date'] ?? '';
                $timestamp = strtotime($date_str);
                if ($timestamp) {
                    $new_format = date('d-m-Y', $timestamp);
                    $convert16_result = "Исходная дата: $date_str, преобразованная: $new_format";
                }
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">16</span>
                    <span class="task-title">Преобразование формата</span>
                </div>
                <div class="task-description">
                    Дана дата в формате '2025-12-31'. Преобразуйте ее в формат '31-12-2025'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$date</span> = <span style="color: #f1fa8c;">'2025-12-31'</span>;<br><span style="color: #ffb86c;">$timestamp</span> = <span style="color: #50fa7b;">strtotime</span>(<span style="color: #ffb86c;">$date</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'d-m-Y'</span>, <span style="color: #ffb86c;">$timestamp</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="form-container">
                        <form method="POST">
                            <div class="form-group">
                                <label>Введите дату (гггг-мм-дд):</label>
                                <input type="text" name="date" class="form-control" placeholder="2025-12-31" value="2025-12-31" required>
                            </div>
                            <button type="submit" name="convert16" class="btn">Преобразовать</button>
                        </form>
                        <?php if ($convert16_result): ?>
                            <div class="alert alert-success" style="margin-top: 15px;">
                                <?php echo $convert16_result; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Задача 17 -->
            <?php
            $convert17_result = '';
            if (isset($_POST['convert17'])) {
                $datetime_str = $_POST['datetime'] ?? '';
                $timestamp = strtotime($datetime_str);
                if ($timestamp) {
                    $new_format = date('H:i:s d.m.Y', $timestamp);
                    $convert17_result = "Исходная дата-время: $datetime_str, преобразованная: $new_format";
                }
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">17</span>
                    <span class="task-title">Преобразование даты-времени</span>
                </div>
                <div class="task-description">
                    Введите дату-время в формате '2025-12-31T12:13:59'. Преобразуйте в '12:13:59 31.12.2025'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$datetime</span> = <span style="color: #f1fa8c;">'2025-12-31T12:13:59'</span>;<br><span style="color: #ffb86c;">$timestamp</span> = <span style="color: #50fa7b;">strtotime</span>(<span style="color: #ffb86c;">$datetime</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'H:i:s d.m.Y'</span>, <span style="color: #ffb86c;">$timestamp</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="form-container">
                        <form method="POST">
                            <div class="form-group">
                                <label>Введите дату-время (гггг-мм-ддTчч:мм:сс):</label>
                                <input type="text" name="datetime" class="form-control" placeholder="2025-12-31T12:13:59" value="2025-12-31T12:13:59" required>
                            </div>
                            <button type="submit" name="convert17" class="btn">Преобразовать</button>
                        </form>
                        <?php if ($convert17_result): ?>
                            <div class="alert alert-success" style="margin-top: 15px;">
                                <?php echo $convert17_result; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Прибавление и отнимание дат -->
            <div class="section-title">➕ Прибавление и отнимание дат</div>

            <!-- Задача 18 -->
            <?php
            $date18 = '2025-12-31';
            $date_obj = date_create($date18);
            
            date_modify($date_obj, '+2 days');
            $plus2days = date_format($date_obj, 'Y-m-d');
            
            date_modify($date_obj, '-2 days'); // возвращаем
            date_modify($date_obj, '+1 month +3 days');
            $plus1month3days = date_format($date_obj, 'Y-m-d');
            
            date_modify($date_obj, '-1 month -3 days'); // возвращаем
            date_modify($date_obj, '+1 year');
            $plus1year = date_format($date_obj, 'Y-m-d');
            
            date_modify($date_obj, '-1 year'); // возвращаем
            date_modify($date_obj, '-3 days');
            $minus3days = date_format($date_obj, 'Y-m-d');
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">18</span>
                    <span class="task-title">Операции с датами</span>
                </div>
                <div class="task-description">
                    К дате '2025-12-31' прибавьте 2 дня, 1 месяц и 3 дня, 1 год. Отнимите 3 дня.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$date</span> = <span style="color: #50fa7b;">date_create</span>(<span style="color: #f1fa8c;">'2025-12-31'</span>);<br><br><span style="color: #50fa7b;">date_modify</span>(<span style="color: #ffb86c;">$date</span>, <span style="color: #f1fa8c;">'+2 days'</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"+2 дня: "</span> . <span style="color: #50fa7b;">date_format</span>(<span style="color: #ffb86c;">$date</span>, <span style="color: #f1fa8c;">'Y-m-d'</span>) . <span style="color: #f1fa8c;">"\n"</span>;<br><br><span style="color: #50fa7b;">date_modify</span>(<span style="color: #ffb86c;">$date</span>, <span style="color: #f1fa8c;">'-2 days'</span>);<br><span style="color: #50fa7b;">date_modify</span>(<span style="color: #ffb86c;">$date</span>, <span style="color: #f1fa8c;">'+1 month +3 days'</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"+1 месяц +3 дня: "</span> . <span style="color: #50fa7b;">date_format</span>(<span style="color: #ffb86c;">$date</span>, <span style="color: #f1fa8c;">'Y-m-d'</span>) . <span style="color: #f1fa8c;">"\n"</span>;<br><br><span style="color: #50fa7b;">date_modify</span>(<span style="color: #ffb86c;">$date</span>, <span style="color: #f1fa8c;">'-1 month -3 days'</span>);<br><span style="color: #50fa7b;">date_modify</span>(<span style="color: #ffb86c;">$date</span>, <span style="color: #f1fa8c;">'+1 year'</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"+1 год: "</span> . <span style="color: #50fa7b;">date_format</span>(<span style="color: #ffb86c;">$date</span>, <span style="color: #f1fa8c;">'Y-m-d'</span>) . <span style="color: #f1fa8c;">"\n"</span>;<br><br><span style="color: #50fa7b;">date_modify</span>(<span style="color: #ffb86c;">$date</span>, <span style="color: #f1fa8c;">'-1 year'</span>);<br><span style="color: #50fa7b;">date_modify</span>(<span style="color: #ffb86c;">$date</span>, <span style="color: #f1fa8c;">'-3 days'</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"-3 дня: "</span> . <span style="color: #50fa7b;">date_format</span>(<span style="color: #ffb86c;">$date</span>, <span style="color: #f1fa8c;">'Y-m-d'</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Исходная</span>
                        <span class="result-content">2025-12-31</span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">+2 дня</span>
                        <span class="result-content"><?php echo $plus2days; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">+1 месяц +3 дня</span>
                        <span class="result-content"><?php echo $plus1month3days; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">+1 год</span>
                        <span class="result-content"><?php echo $plus1year; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">-3 дня</span>
                        <span class="result-content"><?php echo $minus3days; ?></span>
                    </div>
                </div>
            </div>

            <!-- Задачи -->
            <div class="section-title">⭐ Задачи</div>

            <!-- Задача 19 -->
            <?php
            $now = time();
            $new_year = mktime(0, 0, 0, 1, 1, date('Y') + 1);
            $days_to_new_year = ceil(($new_year - $now) / (60 * 60 * 24));
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">19</span>
                    <span class="task-title">Дней до Нового Года</span>
                </div>
                <div class="task-description">
                    Узнайте сколько дней осталось до Нового Года. Скрипт должен работать в любом году.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$now</span> = <span style="color: #50fa7b;">time</span>();<br><span style="color: #ffb86c;">$new_year</span> = <span style="color: #50fa7b;">mktime</span>(0, 0, 0, 1, 1, <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'Y'</span>) + 1);<br><span style="color: #ffb86c;">$days</span> = <span style="color: #50fa7b;">ceil</span>(($<span style="color: #ffb86c;">new_year</span> - <span style="color: #ffb86c;">$now</span>) / (60 * 60 * 24));<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"До Нового Года осталось $days дней"</span>;</pre>
                </div>
                <div class="task-result">
                    <span class="result-label">Результат</span>
                    <span class="result-content"><?php echo $days_to_new_year; ?> дней</span>
                </div>
            </div>

            <!-- Задача 20 -->
            <?php
            $fridays_result = [];
            if (isset($_POST['find_fridays'])) {
                $year = intval($_POST['year'] ?? date('Y'));
                $fridays = [];
                
                for ($month = 1; $month <= 12; $month++) {
                    for ($day = 1; $day <= 31; $day++) {
                        if (checkdate($month, $day, $year)) {
                            $timestamp = mktime(0, 0, 0, $month, $day, $year);
                            if (date('w', $timestamp) == 5 && date('j', $timestamp) == 13) { // 5 = пятница
                                $fridays[] = date('d.m.Y', $timestamp);
                            }
                        }
                    }
                }
                $fridays_result = $fridays;
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">20</span>
                    <span class="task-title">Пятницы 13-е</span>
                </div>
                <div class="task-description">
                    Найдите все пятницы 13-е в указанном году.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$year</span> = <span style="color: #50fa7b;">intval</span>(<span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'year'</span>] ?? <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'Y'</span>));<br><span style="color: #ffb86c;">$fridays</span> = [];<br><br><span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$month</span> = 1; <span style="color: #ffb86c;">$month</span> <= 12; <span style="color: #ffb86c;">$month</span>++) {<br>    <span style="color: #50fa7b;">for</span> (<span style="color: #ffb86c;">$day</span> = 1; <span style="color: #ffb86c;">$day</span> <= 31; <span style="color: #ffb86c;">$day</span>++) {<br>        <span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">checkdate</span>(<span style="color: #ffb86c;">$month</span>, <span style="color: #ffb86c;">$day</span>, <span style="color: #ffb86c;">$year</span>)) {<br>            <span style="color: #ffb86c;">$timestamp</span> = <span style="color: #50fa7b;">mktime</span>(0, 0, 0, <span style="color: #ffb86c;">$month</span>, <span style="color: #ffb86c;">$day</span>, <span style="color: #ffb86c;">$year</span>);<br>            <span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'w'</span>, <span style="color: #ffb86c;">$timestamp</span>) == 5 && <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'j'</span>, <span style="color: #ffb86c;">$timestamp</span>) == 13) {<br>                <span style="color: #ffb86c;">$fridays</span>[] = <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'d.m.Y'</span>, <span style="color: #ffb86c;">$timestamp</span>);<br>            }<br>        }<br>    }<br>}<br><br><span style="color: #50fa7b;">print_r</span>(<span style="color: #ffb86c;">$fridays</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="form-container">
                        <form method="POST">
                            <div class="form-group">
                                <label>Введите год:</label>
                                <input type="number" name="year" class="form-control" value="<?php echo date('Y'); ?>" required>
                            </div>
                            <button type="submit" name="find_fridays" class="btn">Найти</button>
                        </form>
                        <?php if (!empty($fridays_result)): ?>
                            <div class="alert alert-success" style="margin-top: 15px;">
                                <strong>Пятницы 13-е:</strong><br>
                                <?php echo implode('<br>', $fridays_result); ?>
                            </div>
                        <?php elseif (isset($_POST['find_fridays'])): ?>
                            <div class="alert alert-info" style="margin-top: 15px;">
                                В этом году нет пятниц 13-го
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Задача 21 -->
            <?php
            $date_100days_ago = date('d.m.Y', strtotime('-100 days'));
            $week_days = ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'];
            $day_num_100 = date('w', strtotime('-100 days'));
            $day_word_100 = $week_days[$day_num_100];
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">21</span>
                    <span class="task-title">100 дней назад</span>
                </div>
                <div class="task-description">
                    Узнайте какой день недели был 100 дней назад.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$timestamp</span> = <span style="color: #50fa7b;">strtotime</span>(<span style="color: #f1fa8c;">'-100 days'</span>);<br><span style="color: #ffb86c;">$week_days</span> = [<span style="color: #f1fa8c;">'вс'</span>, <span style="color: #f1fa8c;">'пн'</span>, <span style="color: #f1fa8c;">'вт'</span>, <span style="color: #f1fa8c;">'ср'</span>, <span style="color: #f1fa8c;">'чт'</span>, <span style="color: #f1fa8c;">'пт'</span>, <span style="color: #f1fa8c;">'сб'</span>];<br><span style="color: #ffb86c;">$day_num</span> = <span style="color: #50fa7b;">date</span>(<span style="color: #f1fa8c;">'w'</span>, <span style="color: #ffb86c;">$timestamp</span>);<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"100 дней назад был "</span> . <span style="color: #ffb86c;">$week_days</span>[<span style="color: #ffb86c;">$day_num</span>];</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Дата</span>
                        <span class="result-content"><?php echo $date_100days_ago; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">День недели</span>
                        <span class="result-content"><?php echo $day_word_100; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>