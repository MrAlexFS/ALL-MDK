<?php
// Включаем отображение ошибок для отладки
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Запускаем сессию в самом начале
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Практическая работа №30: Отслеживание сеансов (session)</title>
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
            background: linear-gradient(135deg, #ffffff 0%, #c0e0ff 100%);
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
            max-height: 250px;
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
            border-color: #2a5298;
            box-shadow: 0 0 0 3px rgba(42, 82, 152, 0.1);
        }

        .btn {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
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
            box-shadow: 0 4px 12px rgba(42, 82, 152, 0.4);
        }

        .btn-small {
            padding: 8px 16px;
            width: auto;
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

        .nav-links {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .nav-link {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 500;
            transition: transform 0.2s;
        }

        .nav-link:hover {
            transform: translateY(-2px);
        }

        .counter {
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            color: #2c3e50;
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
            
            .nav-links {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Практическая работа №30</h1>
            <p>Отслеживание сеансов (session) в PHP</p>
        </div>

        <!-- Навигация между страницами для задач 2 и 4 -->
        <div class="nav-links">
            <a href="?page=1" class="nav-link">📌 Задача 1,3,5 (текущая страница)</a>
            <a href="?page=2" class="nav-link">📄 Задача 2: Первая страница</a>
            <a href="?page=3" class="nav-link">📄 Задача 2: Вторая страница</a>
            <a href="?page=4" class="nav-link">🌍 Задача 4: Выбор страны</a>
            <a href="?page=5" class="nav-link">🌍 Задача 4: Показать страну</a>
            <a href="?page=6" class="nav-link">📧 Задача 6: Регистрация</a>
        </div>

        <?php
        // Обработка параметра page
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        
        // ==================== ЗАДАЧА 1 ====================
        // По заходу на страницу запишите в сессию текст 'test'
        if (!isset($_SESSION['task1_text'])) {
            $_SESSION['task1_text'] = 'test';
            $task1_message = 'Текст "test" записан в сессию при первом заходе!';
        } else {
            $task1_message = 'Содержимое сессии: <strong>' . htmlspecialchars($_SESSION['task1_text']) . '</strong>';
        }
        
        // ==================== ЗАДАЧА 3 ====================
        // Счетчик обновления страницы
        if (!isset($_SESSION['page_counter'])) {
            $_SESSION['page_counter'] = 0;
            $counter_message = 'Вы еще не обновляли страницу (первый заход)';
        } else {
            $_SESSION['page_counter']++;
            $counter_message = 'Вы обновили страницу ' . $_SESSION['page_counter'] . ' раз(а)';
        }
        
        // ==================== ЗАДАЧА 5 ====================
        // Время захода пользователя
        if (!isset($_SESSION['visit_time'])) {
            $_SESSION['visit_time'] = time();
            $time_message = 'Вы только что зашли на сайт!';
        } else {
            $seconds_ago = time() - $_SESSION['visit_time'];
            $time_message = 'Вы зашли на сайт ' . $seconds_ago . ' секунд назад';
        }
        
        // ==================== ЗАДАЧА 2 ====================
        // Двухстраничная сессия
        if ($page == 2) {
            // Первая страница - запись в сессию
            if (!isset($_SESSION['task2_data'])) {
                $_SESSION['task2_data'] = 'Данные, записанные на первой странице!';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">Страница 1: Запись в сессию</span>
                </div>
                <div class="task-description">
                    На этой странице данные записаны в сессию. Перейдите на вторую страницу, чтобы их увидеть.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">session_start</span>();
<span style="color: #ffb86c;">$_SESSION</span>[<span style="color: #f1fa8c;">'task2_data'</span>] = <span style="color: #f1fa8c;">'Данные, записанные на первой странице!'</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Данные в сессии</span>
                        <span class="result-content"><?php echo htmlspecialchars($_SESSION['task2_data']); ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Инструкция</span>
                        <span class="result-content">Перейдите на <a href="?page=3">вторую страницу</a> для просмотра данных</span>
                    </div>
                </div>
            </div>
            <?php
        } elseif ($page == 3) {
            // Вторая страница - чтение из сессии
            $task2_data = isset($_SESSION['task2_data']) ? $_SESSION['task2_data'] : 'Данные не найдены. Сначала перейдите на первую страницу.';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">Страница 2: Чтение из сессии</span>
                </div>
                <div class="task-description">
                    На этой странице отображаются данные, записанные в сессию на первой странице.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">session_start</span>();
<span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$_SESSION</span>[<span style="color: #f1fa8c;">'task2_data'</span>] ?? <span style="color: #f1fa8c;">'Данные не найдены'</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Данные из сессии</span>
                        <span class="result-content"><?php echo htmlspecialchars($task2_data); ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Инструкция</span>
                        <span class="result-content"><a href="?page=2">← Вернуться на первую страницу</a></span>
                    </div>
                </div>
            </div>
            <?php
        } 
        // ==================== ЗАДАЧА 4 ====================
        elseif ($page == 4) {
            // Форма выбора страны
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['country'])) {
                $_SESSION['user_country'] = $_POST['country'];
                $country_message = 'Страна "' . htmlspecialchars($_SESSION['user_country']) . '" сохранена!';
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4</span>
                    <span class="task-title">Выбор страны</span>
                </div>
                <div class="task-description">
                    Выберите вашу страну. Данные сохранятся в сессию и будут доступны на следующей странице.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">session_start</span>();
<span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$_SERVER</span>[<span style="color: #f1fa8c;">'REQUEST_METHOD'</span>] == <span style="color: #f1fa8c;">'POST'</span>) {
    <span style="color: #ffb86c;">$_SESSION</span>[<span style="color: #f1fa8c;">'user_country'</span>] = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'country'</span>];
}</pre>
                </div>
                <div class="task-result">
                    <div class="form-container">
                        <form method="POST">
                            <div class="form-group">
                                <label>Выберите вашу страну:</label>
                                <select name="country" class="form-control" required>
                                    <option value="">-- Выберите страну --</option>
                                    <option value="Россия" <?php echo (isset($_SESSION['user_country']) && $_SESSION['user_country'] == 'Россия') ? 'selected' : ''; ?>>Россия</option>
                                    <option value="Беларусь" <?php echo (isset($_SESSION['user_country']) && $_SESSION['user_country'] == 'Беларусь') ? 'selected' : ''; ?>>Беларусь</option>
                                    <option value="Казахстан" <?php echo (isset($_SESSION['user_country']) && $_SESSION['user_country'] == 'Казахстан') ? 'selected' : ''; ?>>Казахстан</option>
                                    <option value="Украина" <?php echo (isset($_SESSION['user_country']) && $_SESSION['user_country'] == 'Украина') ? 'selected' : ''; ?>>Украина</option>
                                    <option value="Другая" <?php echo (isset($_SESSION['user_country']) && $_SESSION['user_country'] == 'Другая') ? 'selected' : ''; ?>>Другая</option>
                                </select>
                            </div>
                            <button type="submit" class="btn">Сохранить страну</button>
                        </form>
                        <?php if (isset($country_message)): ?>
                            <div class="alert alert-success" style="margin-top: 15px; background: #c6f6d5; padding: 10px; border-radius: 8px;">
                                <?php echo $country_message; ?>
                            </div>
                        <?php endif; ?>
                        <div style="margin-top: 15px;">
                            <a href="?page=5" class="btn btn-small" style="display: inline-block; text-align: center;">Перейти на страницу просмотра →</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } elseif ($page == 5) {
            // Страница отображения страны
            $user_country = isset($_SESSION['user_country']) ? $_SESSION['user_country'] : 'Страна не выбрана. Сначала выберите страну на предыдущей странице.';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4</span>
                    <span class="task-title">Отображение страны</span>
                </div>
                <div class="task-description">
                    Ваша страна, сохраненная в сессии.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">session_start</span>();
<span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$_SESSION</span>[<span style="color: #f1fa8c;">'user_country'</span>] ?? <span style="color: #f1fa8c;">'Страна не выбрана'</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">Ваша страна</span>
                        <span class="result-content"><?php echo htmlspecialchars($user_country); ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Инструкция</span>
                        <span class="result-content"><a href="?page=4">← Вернуться к выбору страны</a></span>
                    </div>
                </div>
            </div>
            <?php
        }
        // ==================== ЗАДАЧА 6 ====================
        elseif ($page == 6) {
            // Обработка формы регистрации
            $registration_success = false;
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
                $_SESSION['user_data'] = [
                    'first_name' => $_POST['first_name'] ?? '',
                    'last_name' => $_POST['last_name'] ?? '',
                    'email' => $_POST['email'] ?? '',
                    'password' => $_POST['password'] ?? ''
                ];
                $registration_success = true;
            }
            
            // Получаем email из сессии (если был сохранен)
            $saved_email = isset($_SESSION['user_data']['email']) ? $_SESSION['user_data']['email'] : '';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">6</span>
                    <span class="task-title">Регистрация с автозаполнением email</span>
                </div>
                <div class="task-description">
                    Сначала введите email в первой форме. Затем во второй форме поле email заполнится автоматически.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #6272a4;">// Сохранение email в сессию</span>
<span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">isset</span>(<span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'save_email'</span>])) {
    <span style="color: #ffb86c;">$_SESSION</span>[<span style="color: #f1fa8c;">'temp_email'</span>] = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'email_input'</span>];
}

<span style="color: #6272a4;">// Автозаполнение поля email</span>
<span style="color: #ffb86c;">$saved_email</span> = <span style="color: #ffb86c;">$_SESSION</span>[<span style="color: #f1fa8c;">'temp_email'</span>] ?? <span style="color: #f1fa8c;">''</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="form-container">
                        <h3>📧 Шаг 1: Введите ваш email</h3>
                        <form method="POST">
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" name="email_input" class="form-control" required>
                            </div>
                            <button type="submit" name="save_email" class="btn">Сохранить email</button>
                        </form>
                        
                        <?php
                        // Сохранение email из первой формы
                        if (isset($_POST['save_email'])) {
                            $_SESSION['temp_email'] = $_POST['email_input'];
                            echo '<div class="alert alert-success" style="margin-top: 15px; background: #c6f6d5; padding: 10px; border-radius: 8px;">✅ Email сохранен! Теперь заполните форму регистрации.</div>';
                        }
                        
                        // Получаем сохраненный email
                        $saved_email = isset($_SESSION['temp_email']) ? $_SESSION['temp_email'] : '';
                        ?>
                        
                        <h3 style="margin-top: 30px;">📝 Шаг 2: Заполните форму регистрации</h3>
                        <form method="POST">
                            <div class="form-group">
                                <label>Имя:</label>
                                <input type="text" name="first_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Фамилия:</label>
                                <input type="text" name="last_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($saved_email); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Пароль:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" name="register" class="btn">Зарегистрироваться</button>
                        </form>
                        
                        <?php if ($registration_success): ?>
                            <div class="alert alert-success" style="margin-top: 15px; background: #c6f6d5; padding: 10px; border-radius: 8px;">
                                <strong>✅ Регистрация успешна!</strong><br>
                                Имя: <?php echo htmlspecialchars($_SESSION['user_data']['first_name']); ?><br>
                                Фамилия: <?php echo htmlspecialchars($_SESSION['user_data']['last_name']); ?><br>
                                Email: <?php echo htmlspecialchars($_SESSION['user_data']['email']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
        } 
        // ==================== ГЛАВНАЯ СТРАНИЦА (ЗАДАЧИ 1, 3, 5) ====================
        else {
            ?>
            <div class="tasks-grid">
                <!-- Задача 1 -->
                <div class="task-card">
                    <div class="task-header">
                        <span class="task-number">1</span>
                        <span class="task-title">Запись и чтение из сессии</span>
                    </div>
                    <div class="task-description">
                        По заходу на страницу запишите в сессию текст 'test'. Затем обновите страницу и выведите содержимое сессии на экран.
                    </div>
                    <div class="task-solution">
                        <pre><span style="color: #50fa7b;">session_start</span>();
<span style="color: #50fa7b;">if</span> (!<span style="color: #50fa7b;">isset</span>(<span style="color: #ffb86c;">$_SESSION</span>[<span style="color: #f1fa8c;">'task1_text'</span>])) {
    <span style="color: #ffb86c;">$_SESSION</span>[<span style="color: #f1fa8c;">'task1_text'</span>] = <span style="color: #f1fa8c;">'test'</span>;
}
<span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$_SESSION</span>[<span style="color: #f1fa8c;">'task1_text'</span>];</pre>
                    </div>
                    <div class="task-result">
                        <div class="result-item">
                            <span class="result-label">Результат</span>
                            <span class="result-content"><?php echo $task1_message; ?></span>
                        </div>
                        <div class="result-item">
                            <span class="result-label">Обновите страницу</span>
                            <span class="result-content">Чтобы увидеть, что данные сохранились</span>
                        </div>
                    </div>
                </div>
                
                <!-- Задача 3 -->
                <div class="task-card">
                    <div class="task-header">
                        <span class="task-number">3</span>
                        <span class="task-title">Счетчик обновлений страницы</span>
                    </div>
                    <div class="task-description">
                        Счетчик обновления страницы пользователем. Данные хранятся в сессии.
                    </div>
                    <div class="task-solution">
                        <pre><span style="color: #50fa7b;">session_start</span>();
<span style="color: #50fa7b;">if</span> (!<span style="color: #50fa7b;">isset</span>(<span style="color: #ffb86c;">$_SESSION</span>[<span style="color: #f1fa8c;">'page_counter'</span>])) {
    <span style="color: #ffb86c;">$_SESSION</span>[<span style="color: #f1fa8c;">'page_counter'</span>] = 0;
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Вы еще не обновляли страницу"</span>;
} <span style="color: #50fa7b;">else</span> {
    <span style="color: #ffb86c;">$_SESSION</span>[<span style="color: #f1fa8c;">'page_counter'</span>]++;
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Вы обновили страницу "</span> . <span style="color: #ffb86c;">$_SESSION</span>[<span style="color: #f1fa8c;">'page_counter'</span>] . <span style="color: #f1fa8c;">" раз(а)"</span>;
}</pre>
                    </div>
                    <div class="task-result">
                        <div class="result-item">
                            <span class="result-label">Счетчик</span>
                            <span class="result-content counter"><?php echo $_SESSION['page_counter']; ?></span>
                        </div>
                        <div class="result-item">
                            <span class="result-label">Сообщение</span>
                            <span class="result-content"><?php echo $counter_message; ?></span>
                        </div>
                        <div class="result-item">
                            <span class="result-label">Обновите страницу</span>
                            <span class="result-content">Чтобы увеличить счетчик (F5 или Ctrl+R)</span>
                        </div>
                    </div>
                </div>
                
                <!-- Задача 5 -->
                <div class="task-card">
                    <div class="task-header">
                        <span class="task-number">5</span>
                        <span class="task-title">Время захода на сайт</span>
                    </div>
                    <div class="task-description">
                        Запишите в сессию время захода пользователя на сайт. При обновлении страницы выводите сколько секунд назад пользователь зашел на сайт.
                    </div>
                    <div class="task-solution">
                        <pre><span style="color: #50fa7b;">session_start</span>();
<span style="color: #50fa7b;">if</span> (!<span style="color: #50fa7b;">isset</span>(<span style="color: #ffb86c;">$_SESSION</span>[<span style="color: #f1fa8c;">'visit_time'</span>])) {
    <span style="color: #ffb86c;">$_SESSION</span>[<span style="color: #f1fa8c;">'visit_time'</span>] = <span style="color: #50fa7b;">time</span>();
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Вы только что зашли на сайт!"</span>;
} <span style="color: #50fa7b;">else</span> {
    <span style="color: #ffb86c;">$seconds</span> = <span style="color: #50fa7b;">time</span>() - <span style="color: #ffb86c;">$_SESSION</span>[<span style="color: #f1fa8c;">'visit_time'</span>];
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Вы зашли на сайт $seconds секунд назад"</span>;
}</pre>
                    </div>
                    <div class="task-result">
                        <div class="result-item">
                            <span class="result-label">Время захода</span>
                            <span class="result-content"><?php echo date('H:i:s', $_SESSION['visit_time'] ?? time()); ?></span>
                        </div>
                        <div class="result-item">
                            <span class="result-label">Информация</span>
                            <span class="result-content"><?php echo $time_message; ?></span>
                        </div>
                        <div class="result-item">
                            <span class="result-label">Обновите страницу</span>
                            <span class="result-content">Чтобы увидеть, как увеличивается время</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Дополнительная информация -->
            <div class="task-card" style="margin-top: 25px;">
                <div class="task-header">
                    <span class="task-number">ℹ️</span>
                    <span class="task-title">Информация о сессии</span>
                </div>
                <div class="task-description">
                    Текущие данные, хранящиеся в сессии:
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">ID сессии</span>
                        <span class="result-content"><?php echo session_id(); ?></span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Данные сессии</span>
                        <span class="result-content">
                            <?php
                            echo '<pre style="margin:0; font-family: monospace;">';
                            print_r($_SESSION);
                            echo '</pre>';
                            ?>
                        </span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Действия</span>
                        <span class="result-content">
                            <a href="?destroy=1" class="btn-small" style="background: #e74c3c; color: white; padding: 5px 10px; border-radius: 5px; text-decoration: none;">🗑️ Очистить сессию</a>
                        </span>
                    </div>
                </div>
            </div>
            
            <?php
            // Очистка сессии
            if (isset($_GET['destroy'])) {
                session_destroy();
                echo '<script>window.location.href = "?";</script>';
            }
        }
        ?>
    </div>
</body>
</html>