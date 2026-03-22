<?php
// ==================== ВСЕ ОПЕРАЦИИ С COOKIE ДОЛЖНЫ БЫТЬ В САМОМ НАЧАЛЕ ====================

// Задача 1: Запись куки при первом заходе
if (!isset($_COOKIE['test'])) {
    setcookie('test', '123', time() + 3600 * 24 * 30, '/');
    $cookie_message1 = 'Куки "test" созданы! Значение: 123';
} else {
    $cookie_message1 = 'Значение куки "test": ' . $_COOKIE['test'];
}

// Задача 2: Удаление куки
$delete_message = '';
if (isset($_POST['delete_cookie'])) {
    setcookie('test', '', time() - 3600, '/');
    $delete_message = 'Куки "test" удалены! Обновите страницу, чтобы увидеть результат.';
}

// Задача 3: Счетчик посещений
if (!isset($_COOKIE['visit_counter'])) {
    setcookie('visit_counter', 1, time() + 3600 * 24 * 365, '/');
    $visit_message = 'Вы посетили наш сайт 1 раз!';
} else {
    $count = $_COOKIE['visit_counter'] + 1;
    setcookie('visit_counter', $count, time() + 3600 * 24 * 365, '/');
    $visit_message = 'Вы посетили наш сайт ' . $count . ' раз!';
}

// Задача 4: День рождения
$birthday_message = '';
$birthday_form = true;
$user_birthday = $_COOKIE['user_birthday'] ?? '';
$birthday_info = '';

if (isset($_POST['save_birthday'])) {
    $birthday = $_POST['birthday'] ?? '';
    if ($birthday) {
        setcookie('user_birthday', $birthday, time() + 3600 * 24 * 365, '/');
        $birthday_message = 'Дата рождения сохранена!';
        $user_birthday = $birthday;
        $birthday_form = false;
    }
}

if (isset($_POST['clear_birthday'])) {
    setcookie('user_birthday', '', time() - 3600, '/');
    $birthday_message = 'Дата рождения удалена!';
    $user_birthday = '';
    $birthday_form = true;
}

// Вычисляем информацию о дне рождения
if ($user_birthday) {
    $birthday_form = false;
    $today = new DateTime();
    $birth_date = new DateTime($user_birthday);
    $current_year = $today->format('Y');
    $birthday_this_year = new DateTime($user_birthday);
    $birthday_this_year->setDate($current_year, $birth_date->format('m'), $birth_date->format('d'));
    
    if ($birthday_this_year < $today) {
        $birthday_this_year->modify('+1 year');
    }
    
    $diff = $today->diff($birthday_this_year);
    $days_left = $diff->days;
    
    // Проверка, сегодня ли день рождения
    if ($birth_date->format('m-d') == $today->format('m-d')) {
        $birthday_info = '<div class="alert alert-warning" style="background: #fef3c7; border-color: #fcd34d;">
            <span class="birthday-cake">🎂🎉🎈</span>
            <strong>С ДНЕМ РОЖДЕНИЯ!</strong> 🎂🎉🎈<br>
            Поздравляем вас с этим замечательным днем! Желаем счастья, здоровья и успехов!
        </div>';
    } else {
        $birthday_info = '<div class="alert alert-info">
            До вашего дня рождения осталось <strong>' . $days_left . '</strong> дней!
        </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аудиторная самостоятельная работа №10: Куки в PHP</title>
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
            max-width: 1200px;
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

        .info-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 30px;
            text-align: center;
        }

        .info-section p {
            color: #4a5568;
            font-size: 1.1rem;
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
            max-height: 200px;
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
            border-color: #e67e22;
            box-shadow: 0 0 0 3px rgba(230, 126, 34, 0.1);
        }

        .btn {
            background: linear-gradient(135deg, #2c3e50 0%, #e67e22 100%);
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

        .btn-danger {
            background: linear-gradient(135deg, #c0392b 0%, #e74c3c 100%);
        }

        .btn-danger:hover {
            box-shadow: 0 4px 12px rgba(192, 57, 43, 0.4);
        }

        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin: 15px 0;
        }

        .alert-success {
            background: #c6f6d5;
            border: 1px solid #9ae6b4;
            color: #22543d;
        }

        .alert-error {
            background: #fed7d7;
            border: 1px solid #fc8181;
            color: #742a2a;
        }

        .alert-info {
            background: #bee3f8;
            border: 1px solid #90cdf4;
            color: #2c5282;
        }

        .alert-warning {
            background: #fef3c7;
            border: 1px solid #fcd34d;
            color: #92400e;
        }

        .birthday-cake {
            font-size: 2rem;
            margin-right: 10px;
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

        .counter {
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            color: #e67e22;
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
                max-height: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Аудиторная самостоятельная работа №10</h1>
            <p>Работа с куки в PHP</p>
        </div>

        <div class="info-section">
            <p>🍪 Куки (cookies) — это небольшие фрагменты данных, которые сервер отправляет браузеру пользователя. 
            Браузер сохраняет их и отправляет обратно при следующих запросах к тому же серверу.</p>
        </div>

        <div class="tasks-grid">
            <!-- Задача 1 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">1</span>
                    <span class="task-title">Запись и чтение куки</span>
                </div>
                <div class="task-description">
                    По заходу на страницу запишите в куки с именем test текст '123'. Затем обновите страницу и выведите содержимое этой куки на экран.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">if</span> (!<span style="color: #50fa7b;">isset</span>(<span style="color: #ffb86c;">$_COOKIE</span>[<span style="color: #f1fa8c;">'test'</span>])) {
    <span style="color: #50fa7b;">setcookie</span>(<span style="color: #f1fa8c;">'test'</span>, <span style="color: #f1fa8c;">'123'</span>, <span style="color: #50fa7b;">time</span>() + 3600);
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Куки созданы!"</span>;
} <span style="color: #50fa7b;">else</span> {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Значение куки: "</span> . <span style="color: #ffb86c;">$_COOKIE</span>[<span style="color: #f1fa8c;">'test'</span>];
}</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Результат</span>
                        <span class="result-content"><?php echo $cookie_message1; ?></span>
                    </div>
                </div>
            </div>

            <!-- Задача 2 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">Удаление куки</span>
                </div>
                <div class="task-description">
                    Удалите куки с именем test.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">setcookie</span>(<span style="color: #f1fa8c;">'test'</span>, <span style="color: #f1fa8c;">''</span>, <span style="color: #50fa7b;">time</span>() - 3600, <span style="color: #f1fa8c;">'/'</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="form-container">
                        <form method="POST">
                            <button type="submit" name="delete_cookie" class="btn btn-danger">🗑️ Удалить куки test</button>
                        </form>
                        <?php if ($delete_message): ?>
                            <div class="alert alert-success" style="margin-top: 15px;"><?php echo $delete_message; ?></div>
                        <?php endif; ?>
                        <?php if (isset($_COOKIE['test'])): ?>
                            <div class="alert alert-info" style="margin-top: 15px;">Текущее значение куки: <strong><?php echo $_COOKIE['test']; ?></strong></div>
                        <?php else: ?>
                            <div class="alert alert-info" style="margin-top: 15px;">Куки "test" не существуют или были удалены.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Задача 3 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">3</span>
                    <span class="task-title">Счетчик посещений</span>
                </div>
                <div class="task-description">
                    Сделайте счетчик посещения сайта посетителем. Каждый раз, заходя на сайт, он должен видеть надпись: 'Вы посетили наш сайт % раз!'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">if</span> (!<span style="color: #50fa7b;">isset</span>(<span style="color: #ffb86c;">$_COOKIE</span>[<span style="color: #f1fa8c;">'visit_counter'</span>])) {
    <span style="color: #50fa7b;">setcookie</span>(<span style="color: #f1fa8c;">'visit_counter'</span>, 1, <span style="color: #50fa7b;">time</span>() + 3600 * 24 * 365);
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Вы посетили наш сайт 1 раз!"</span>;
} <span style="color: #50fa7b;">else</span> {
    <span style="color: #ffb86c;">$count</span> = <span style="color: #ffb86c;">$_COOKIE</span>[<span style="color: #f1fa8c;">'visit_counter'</span>] + 1;
    <span style="color: #50fa7b;">setcookie</span>(<span style="color: #f1fa8c;">'visit_counter'</span>, <span style="color: #ffb86c;">$count</span>, <span style="color: #50fa7b;">time</span>() + 3600 * 24 * 365);
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Вы посетили наш сайт $count раз!"</span>;
}</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Счетчик</span>
                        <span class="result-content counter"><?php echo $visit_message; ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Информация</span>
                        <span class="result-content">Обновите страницу (F5), чтобы увеличить счетчик</span>
                    </div>
                </div>
            </div>

            <!-- Задача 4 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4</span>
                    <span class="task-title">День рождения</span>
                </div>
                <div class="task-description">
                    Спросите дату рождения пользователя. При следующем заходе на сайт напишите, сколько дней осталось до его дня рождения. Если сегодня день рождения пользователя - поздравьте его!
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$birthday</span> = <span style="color: #ffb86c;">$_COOKIE</span>[<span style="color: #f1fa8c;">'user_birthday'</span>] ?? <span style="color: #f1fa8c;">''</span>;
<span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$birthday</span>) {
    <span style="color: #ffb86c;">$today</span> = <span style="color: #50fa7b;">new</span> DateTime();
    <span style="color: #ffb86c;">$birth_date</span> = <span style="color: #50fa7b;">new</span> DateTime(<span style="color: #ffb86c;">$birthday</span>);
    <span style="color: #ffb86c;">$birthday_this_year</span> = <span style="color: #50fa7b;">new</span> DateTime(<span style="color: #ffb86c;">$birthday</span>);
    <span style="color: #ffb86c;">$birthday_this_year</span>-><span style="color: #50fa7b;">setDate</span>(<span style="color: #ffb86c;">$today</span>-><span style="color: #50fa7b;">format</span>(<span style="color: #f1fa8c;">'Y'</span>), ...);
    <span style="color: #ffb86c;">$diff</span> = <span style="color: #ffb86c;">$today</span>-><span style="color: #50fa7b;">diff</span>(<span style="color: #ffb86c;">$birthday_this_year</span>);
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"До дня рождения осталось {$diff->days} дней"</span>;
}</pre>
                </div>
                <div class="task-result">
                    <div class="form-container">
                        <?php if ($birthday_form && !$user_birthday): ?>
                            <form method="POST">
                                <div class="form-group">
                                    <label>Введите вашу дату рождения:</label>
                                    <input type="date" name="birthday" class="form-control" required>
                                </div>
                                <button type="submit" name="save_birthday" class="btn">Сохранить</button>
                            </form>
                        <?php elseif ($user_birthday && !$birthday_form): ?>
                            <div class="alert alert-info">
                                <strong>Ваша дата рождения:</strong> <?php echo date('d.m.Y', strtotime($user_birthday)); ?>
                            </div>
                            <?php echo $birthday_info; ?>
                            <form method="POST" style="margin-top: 15px;">
                                <button type="submit" name="clear_birthday" class="btn btn-danger">🗑️ Удалить дату рождения</button>
                            </form>
                        <?php endif; ?>
                        <?php if ($birthday_message): ?>
                            <div class="alert alert-success" style="margin-top: 15px;"><?php echo $birthday_message; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Дополнительная информация о всех куки -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">ℹ️</span>
                    <span class="task-title">Все сохраненные куки</span>
                </div>
                <div class="task-description">
                    Список всех куки, сохраненных на вашем компьютере для этого сайта.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">print_r</span>(<span style="color: #ffb86c;">$_COOKIE</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Куки</span>
                        <span class="result-content multiline">
                            <?php
                            if (empty($_COOKIE)) {
                                echo 'Нет сохраненных куки';
                            } else {
                                foreach ($_COOKIE as $key => $value) {
                                    echo "<strong>$key</strong>: " . htmlspecialchars($value) . "<br>";
                                }
                            }
                            ?>
                        </span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Примечание</span>
                        <span class="result-content">Куки хранятся в браузере и отправляются на сервер при каждом запросе</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>