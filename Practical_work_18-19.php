<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Практическая работа №18-19: Обработка данных на форме</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #6B46C1 0%, #9F7AEA 100%);
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
            background: linear-gradient(135deg, #ffffff 0%, #f0e6ff 100%);
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

        .header-sub {
            color: rgba(255,255,255,0.8);
            font-size: 1.1rem;
            margin-top: 10px;
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
            color: #6B46C1;
            margin-bottom: 20px;
            font-size: 1.8rem;
            border-bottom: 2px solid #9F7AEA;
            padding-bottom: 10px;
        }

        .theory-section h3 {
            color: #6B46C1;
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

        .keyword { color: #ff79c6; }
        .string { color: #f1fa8c; }
        .comment { color: #6272a4; }
        .function { color: #50fa7b; }
        .variable { color: #ffb86c; }

        .tasks-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(550px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
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
            background: linear-gradient(135deg, #6B46C1 0%, #9F7AEA 100%);
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
            box-shadow: 0 4px 10px rgba(159, 122, 234, 0.3);
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
            border-left: 4px solid #9F7AEA;
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
            border-color: #9F7AEA;
            box-shadow: 0 0 0 3px rgba(159, 122, 234, 0.1);
        }

        .btn {
            background: linear-gradient(135deg, #6B46C1 0%, #9F7AEA 100%);
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
            box-shadow: 0 4px 12px rgba(159, 122, 234, 0.4);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn-success {
            background: linear-gradient(135deg, #38a169 0%, #48bb78 100%);
        }

        .radio-group, .checkbox-group {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 5px;
        }

        .radio-item, .checkbox-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .radio-item input, .checkbox-item input {
            width: auto;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin: 10px 0;
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

        .section-title {
            grid-column: 1 / -1;
            margin: 20px 0;
            color: white;
            font-size: 2rem;
            font-weight: 600;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
            border-left: 6px solid #ffd700;
            padding-left: 20px;
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
                max-height: 300px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Практическая работа №18-19</h1>
            <p>Обработка данных на форме</p>
            <div class="header-sub">Цель: изучение основных конструкций языка PHP для работы с формами</div>
        </div>

        <!-- ТЕОРЕТИЧЕСКИЕ СВЕДЕНИЯ -->
        <div class="theory-section">
            <h2>📚 Теоретические сведения</h2>
            
            <h3>Работа с формами в PHP</h3>
            <p>Для работы с формами в PHP используются два основных метода передачи данных:</p>
            <ul>
                <li><strong>GET</strong> - данные передаются через URL (видимы пользователю, ограничены по размеру)</li>
                <li><strong>POST</strong> - данные передаются в теле запроса (не видны пользователю, нет ограничений)</li>
            </ul>

            <h3>Получение данных из формы</h3>
            <p>Данные из формы доступны через суперглобальные массивы:</p>
            <ul>
                <li><strong>$_GET['имя_поля']</strong> - для метода GET</li>
                <li><strong>$_POST['имя_поля']</strong> - для метода POST</li>
                <li><strong>$_REQUEST['имя_поля']</strong> - для обоих методов</li>
            </ul>

            <div class="code-example">
                <pre><span style="color: #6272a4;">// Получение данных из формы</span><br><span style="color: #ffb86c;">$name</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'name'</span>] ?? <span style="color: #f1fa8c;">''</span>;<br><span style="color: #ffb86c;">$email</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'email'</span>] ?? <span style="color: #f1fa8c;">''</span>;</pre>
            </div>

            <h3>Отправка email через PHP</h3>
            <p>Функция mail() используется для отправки электронных писем:</p>
            <div class="code-example">
                <pre><span style="color: #ffb86c;">$to</span> = <span style="color: #f1fa8c;">"user@example.com"</span>;<br><span style="color: #ffb86c;">$subject</span> = <span style="color: #f1fa8c;">"Тема письма"</span>;<br><span style="color: #ffb86c;">$message</span> = <span style="color: #f1fa8c;">"Текст сообщения"</span>;<br><span style="color: #ffb86c;">$result</span> = <span style="color: #50fa7b;">mail</span>(<span style="color: #ffb86c;">$to</span>, <span style="color: #ffb86c;">$subject</span>, <span style="color: #ffb86c;">$message</span>);<br><span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$result</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Письмо отправлено"</span>;<br>} <span style="color: #50fa7b;">else</span> {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Ошибка отправки"</span>;<br>}</pre>
            </div>
        </div>

        <!-- ЗАДАНИЕ 2: Форма с данными пользователя -->
        <div class="section-title">📝 Задание №2: Форма с личными данными</div>

        <div class="tasks-grid">
            <?php
            // Обработка формы из задания 2
            $form2_submitted = isset($_POST['form2_submit']);
            $form2_data = [];
            if ($form2_submitted) {
                $form2_data = [
                    'fio' => $_POST['fio'] ?? '',
                    'address' => $_POST['address'] ?? '',
                    'email' => $_POST['email'] ?? '',
                    'password' => $_POST['password'] ?? ''
                ];
            }
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2.1</span>
                    <span class="task-title">Форма с обработкой (2 файла)</span>
                </div>
                <div class="task-description">
                    HTML-форма с полями Ф.И.О., Адрес, Email, Пароль для отправки данных PHP-обработчику.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #6272a4;">&lt;!-- Файл form.html --&gt;</span><br>&lt;form method=<span style="color: #f1fa8c;">"POST"</span> action=<span style="color: #f1fa8c;">"process.php"</span>&gt;<br>    &lt;div&gt;<br>        &lt;label&gt;Ф.И.О.:&lt;/label&gt;<br>        &lt;input type=<span style="color: #f1fa8c;">"text"</span> name=<span style="color: #f1fa8c;">"fio"</span> required&gt;<br>    &lt;/div&gt;<br>    &lt;div&gt;<br>        &lt;label&gt;Адрес:&lt;/label&gt;<br>        &lt;input type=<span style="color: #f1fa8c;">"text"</span> name=<span style="color: #f1fa8c;">"address"</span> required&gt;<br>    &lt;/div&gt;<br>    &lt;div&gt;<br>        &lt;label&gt;Email:&lt;/label&gt;<br>        &lt;input type=<span style="color: #f1fa8c;">"email"</span> name=<span style="color: #f1fa8c;">"email"</span> required&gt;<br>    &lt;/div&gt;<br>    &lt;div&gt;<br>        &lt;label&gt;Пароль:&lt;/label&gt;<br>        &lt;input type=<span style="color: #f1fa8c;">"password"</span> name=<span style="color: #f1fa8c;">"password"</span> required&gt;<br>    &lt;/div&gt;<br>    &lt;button type=<span style="color: #f1fa8c;">"submit"</span> name=<span style="color: #f1fa8c;">"form2_submit"</span>&gt;Отправить&lt;/button&gt;<br>&lt;/form&gt;<br><br><span style="color: #6272a4;">&lt;!-- Файл process.php --&gt;</span><br><span style="color: #ffb86c;">$fio</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'fio'</span>] ?? <span style="color: #f1fa8c;">''</span>;<br><span style="color: #ffb86c;">$address</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'address'</span>] ?? <span style="color: #f1fa8c;">''</span>;<br><span style="color: #ffb86c;">$email</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'email'</span>] ?? <span style="color: #f1fa8c;">''</span>;<br><span style="color: #ffb86c;">$password</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'password'</span>] ?? <span style="color: #f1fa8c;">''</span>;<br><br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"&lt;h2&gt;Полученные данные:&lt;/h2&gt;"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Ф.И.О.: "</span> . <span style="color: #50fa7b;">htmlspecialchars</span>(<span style="color: #ffb86c;">$fio</span>) . <span style="color: #f1fa8c;">"&lt;br&gt;"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Адрес: "</span> . <span style="color: #50fa7b;">htmlspecialchars</span>(<span style="color: #ffb86c;">$address</span>) . <span style="color: #f1fa8c;">"&lt;br&gt;"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Email: "</span> . <span style="color: #50fa7b;">htmlspecialchars</span>(<span style="color: #ffb86c;">$email</span>) . <span style="color: #f1fa8c;">"&lt;br&gt;"</span>;<br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Пароль: "</span> . <span style="color: #50fa7b;">htmlspecialchars</span>(<span style="color: #ffb86c;">$password</span>);</pre>
                </div>
                <div class="task-result">
                    <div class="form-container">
                        <form method="POST">
                            <div class="form-group">
                                <label>Ф.И.О.:</label>
                                <input type="text" name="fio" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Адрес:</label>
                                <input type="text" name="address" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Пароль:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" name="form2_submit" class="btn">Отправить</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2.2</span>
                    <span class="task-title">Результат обработки (один файл)</span>
                </div>
                <div class="task-description">
                    Вывод полученных данных из формы (обработка в одном файле).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #6272a4;">// Единый файл form.php</span><br><span style="color: #ffb86c;">$form_submitted</span> = <span style="color: #50fa7b;">isset</span>(<span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'form2_submit'</span>]);<br><br><span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$form_submitted</span>) {<br>    <span style="color: #ffb86c;">$fio</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'fio'</span>] ?? <span style="color: #f1fa8c;">''</span>;<br>    <span style="color: #ffb86c;">$address</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'address'</span>] ?? <span style="color: #f1fa8c;">''</span>;<br>    <span style="color: #ffb86c;">$email</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'email'</span>] ?? <span style="color: #f1fa8c;">''</span>;<br>    <span style="color: #ffb86c;">$password</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'password'</span>] ?? <span style="color: #f1fa8c;">''</span>;<br>    <br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"&lt;div class='alert-success'&gt;✅ Данные получены!&lt;/div&gt;"</span>;<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Ф.И.О.: "</span> . <span style="color: #50fa7b;">htmlspecialchars</span>(<span style="color: #ffb86c;">$fio</span>) . <span style="color: #f1fa8c;">"&lt;br&gt;"</span>;<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Адрес: "</span> . <span style="color: #50fa7b;">htmlspecialchars</span>(<span style="color: #ffb86c;">$address</span>) . <span style="color: #f1fa8c;">"&lt;br&gt;"</span>;<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Email: "</span> . <span style="color: #50fa7b;">htmlspecialchars</span>(<span style="color: #ffb86c;">$email</span>) . <span style="color: #f1fa8c;">"&lt;br&gt;"</span>;<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Пароль: "</span> . <span style="color: #50fa7b;">htmlspecialchars</span>(<span style="color: #ffb86c;">$password</span>);<br>}</pre>
                </div>
                <div class="task-result">
                    <?php if ($form2_submitted): ?>
                        <div class="alert alert-success">
                            <strong>✅ Данные успешно получены!</strong>
                        </div>
                        <?php foreach ($form2_data as $key => $value): ?>
                        <div class="result-item">
                            <span class="result-label"><?php echo strtoupper($key); ?></span>
                            <span class="result-content"><?php echo htmlspecialchars($value); ?></span>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-info">
                            Заполните форму слева и нажмите "Отправить"
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- ЗАДАНИЕ 3: Проверка пароля -->
            <?php
            $correct_password = "php123";
            $password_result = '';
            $show_congrats = false;
            
            if (isset($_POST['check_password'])) {
                $user_password = $_POST['user_password'] ?? '';
                if ($user_password === $correct_password) {
                    $password_result = "success";
                    $show_congrats = true;
                } else {
                    $password_result = "error";
                }
            }
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">3</span>
                    <span class="task-title">Проверка пароля</span>
                </div>
                <div class="task-description">
                    Проверка пароля пользователя. Правильный пароль: <strong>php123</strong>
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$correct</span> = <span style="color: #f1fa8c;">"php123"</span>;<br><br><span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">isset</span>(<span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'check_password'</span>])) {<br>    <span style="color: #ffb86c;">$user_pass</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'user_password'</span>] ?? <span style="color: #f1fa8c;">''</span>;<br>    <br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$user_pass</span> === <span style="color: #ffb86c;">$correct</span>) {<br>        <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"✅ Пароль верный! Добро пожаловать!"</span>;<br>        <span style="color: #6272a4;">// header("Location: congrats.php");</span><br>    } <span style="color: #50fa7b;">else</span> {<br>        <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"❌ Ошибка в пароле. Попробуйте снова."</span>;<br>    }<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="form-container">
                        <form method="POST">
                            <div class="form-group">
                                <label>Введите пароль:</label>
                                <input type="password" name="user_password" class="form-control" required>
                            </div>
                            <button type="submit" name="check_password" class="btn">Проверить</button>
                        </form>
                        
                        <?php if ($password_result === 'success'): ?>
                            <div class="alert alert-success" style="margin-top: 15px;">
                                ✅ Пароль верный! Добро пожаловать!
                            </div>
                            <?php if ($show_congrats): ?>
                            <div class="alert alert-success" style="margin-top: 10px;">
                                🎉 ПОЗДРАВЛЯЕМ! Вы успешно авторизовались!
                            </div>
                            <?php endif; ?>
                        <?php elseif ($password_result === 'error'): ?>
                            <div class="alert alert-error" style="margin-top: 15px;">
                                ❌ Ошибка в пароле. Попробуйте снова.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- ЗАДАНИЕ 4: Отправка email -->
            <?php
            $mail_result = '';
            if (isset($_POST['send_mail'])) {
                $to = $_POST['to'] ?? '';
                $subject = $_POST['subject'] ?? '';
                $message = $_POST['message'] ?? '';
                
                // Имитация отправки (на локальном сервере mail не работает)
                if (!empty($to) && !empty($subject) && !empty($message)) {
                    $mail_sent = true; // mail($to, $subject, $message);
                    $mail_result = $mail_sent ? 'success' : 'error';
                } else {
                    $mail_result = 'empty';
                }
            }
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4</span>
                    <span class="task-title">Отправка email</span>
                </div>
                <div class="task-description">
                    Форма для отправки электронного письма (имитация на локальном сервере).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$go</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'mail_ok'</span>] ?? <span style="color: #f1fa8c;">''</span>;<br><br><span style="color: #50fa7b;">if</span> (!<span style="color: #ffb86c;">$go</span>) {<br>    <span style="color: #6272a4;">// HTML-код формы для написания письма</span><br>} <span style="color: #50fa7b;">else</span> {<br>    <span style="color: #ffb86c;">$to</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'to'</span>];<br>    <span style="color: #ffb86c;">$subject</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'subject'</span>];<br>    <span style="color: #ffb86c;">$message</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'message'</span>];<br>    <span style="color: #ffb86c;">$mail</span> = <span style="color: #50fa7b;">mail</span>(<span style="color: #ffb86c;">$to</span>, <span style="color: #ffb86c;">$subject</span>, <span style="color: #ffb86c;">$message</span>);<br>    <br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$mail</span> == <span style="color: #f1fa8c;">true</span>) {<br>        <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Письмо отправлено"</span>;<br>    } <span style="color: #50fa7b;">else</span> {<br>        <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Не удалось отправить"</span>;<br>    }<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="form-container">
                        <form method="POST">
                            <div class="form-group">
                                <label>Кому (Email):</label>
                                <input type="email" name="to" class="form-control" value="test@example.com" required>
                            </div>
                            <div class="form-group">
                                <label>Тема письма:</label>
                                <input type="text" name="subject" class="form-control" value="Тестовое письмо" required>
                            </div>
                            <div class="form-group">
                                <label>Сообщение:</label>
                                <textarea name="message" class="form-control" rows="4" required>Привет! Это тестовое сообщение.</textarea>
                            </div>
                            <button type="submit" name="send_mail" class="btn btn-success">Отправить письмо</button>
                        </form>
                        
                        <?php if ($mail_result === 'success'): ?>
                            <div class="alert alert-success" style="margin-top: 15px;">
                                ✅ Письмо успешно отправлено!
                            </div>
                        <?php elseif ($mail_result === 'error'): ?>
                            <div class="alert alert-error" style="margin-top: 15px;">
                                ❌ Ошибка при отправке письма.
                            </div>
                        <?php elseif ($mail_result === 'empty'): ?>
                            <div class="alert alert-error" style="margin-top: 15px;">
                                ❌ Заполните все поля!
                            </div>
                        <?php endif; ?>
                        
                        <div class="alert alert-info" style="margin-top: 10px;">
                            <small>ℹ️ На локальном сервере отправка писем не работает. Здесь демонстрируется только интерфейс.</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ЗАДАНИЕ 5: Калькулятор -->
            <?php
            $calc_result = '';
            if (isset($_POST['calculate'])) {
                $num1 = floatval($_POST['num1'] ?? 0);
                $num2 = floatval($_POST['num2'] ?? 0);
                $operation = $_POST['operation'] ?? '+';
                
                switch ($operation) {
                    case '+': $calc_result = $num1 + $num2; break;
                    case '-': $calc_result = $num1 - $num2; break;
                    case '*': $calc_result = $num1 * $num2; break;
                    case '/': 
                        $calc_result = ($num2 != 0) ? $num1 / $num2 : 'Ошибка: деление на ноль';
                        break;
                }
            }
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">5</span>
                    <span class="task-title">Калькулятор</span>
                </div>
                <div class="task-description">
                    Программа-калькулятор для выполнения арифметических операций над двумя числами.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$num1</span> = <span style="color: #50fa7b;">floatval</span>(<span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'num1'</span>] ?? 0);<br><span style="color: #ffb86c;">$num2</span> = <span style="color: #50fa7b;">floatval</span>(<span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'num2'</span>] ?? 0);<br><span style="color: #ffb86c;">$operation</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'operation'</span>] ?? <span style="color: #f1fa8c;">'+'</span>;<br><br><span style="color: #50fa7b;">switch</span> (<span style="color: #ffb86c;">$operation</span>) {<br>    <span style="color: #50fa7b;">case</span> <span style="color: #f1fa8c;">'+'</span>: <span style="color: #ffb86c;">$result</span> = <span style="color: #ffb86c;">$num1</span> + <span style="color: #ffb86c;">$num2</span>; <span style="color: #50fa7b;">break</span>;<br>    <span style="color: #50fa7b;">case</span> <span style="color: #f1fa8c;">'-'</span>: <span style="color: #ffb86c;">$result</span> = <span style="color: #ffb86c;">$num1</span> - <span style="color: #ffb86c;">$num2</span>; <span style="color: #50fa7b;">break</span>;<br>    <span style="color: #50fa7b;">case</span> <span style="color: #f1fa8c;">'*'</span>: <span style="color: #ffb86c;">$result</span> = <span style="color: #ffb86c;">$num1</span> * <span style="color: #ffb86c;">$num2</span>; <span style="color: #50fa7b;">break</span>;<br>    <span style="color: #50fa7b;">case</span> <span style="color: #f1fa8c;">'/'</span>: <span style="color: #ffb86c;">$result</span> = (<span style="color: #ffb86c;">$num2</span> != 0) ? <span style="color: #ffb86c;">$num1</span> / <span style="color: #ffb86c;">$num2</span> : <span style="color: #f1fa8c;">'Ошибка: деление на ноль'</span>; <span style="color: #50fa7b;">break</span>;<br>    <span style="color: #50fa7b;">default</span>: <span style="color: #ffb86c;">$result</span> = <span style="color: #f1fa8c;">'Неизвестная операция'</span>;<br>}<br><br><span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Результат: $result"</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="form-container">
                        <form method="POST">
                            <div class="form-group">
                                <label>Число 1:</label>
                                <input type="number" name="num1" class="form-control" step="any" value="<?php echo $_POST['num1'] ?? 10; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Число 2:</label>
                                <input type="number" name="num2" class="form-control" step="any" value="<?php echo $_POST['num2'] ?? 5; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Операция:</label>
                                <div class="radio-group">
                                    <label class="radio-item">
                                        <input type="radio" name="operation" value="+" <?php echo (!isset($_POST['operation']) || $_POST['operation'] == '+') ? 'checked' : ''; ?>> +
                                    </label>
                                    <label class="radio-item">
                                        <input type="radio" name="operation" value="-" <?php echo (isset($_POST['operation']) && $_POST['operation'] == '-') ? 'checked' : ''; ?>> -
                                    </label>
                                    <label class="radio-item">
                                        <input type="radio" name="operation" value="*" <?php echo (isset($_POST['operation']) && $_POST['operation'] == '*') ? 'checked' : ''; ?>> *
                                    </label>
                                    <label class="radio-item">
                                        <input type="radio" name="operation" value="/" <?php echo (isset($_POST['operation']) && $_POST['operation'] == '/') ? 'checked' : ''; ?>> /
                                    </label>
                                </div>
                            </div>
                            <button type="submit" name="calculate" class="btn">Вычислить</button>
                        </form>
                        
                        <?php if ($calc_result !== ''): ?>
                        <div class="result-item" style="margin-top: 15px;">
                            <span class="result-label">Результат</span>
                            <span class="result-content"><?php echo $calc_result; ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- ЗАДАНИЕ 6: Анкета пользователя -->
            <?php
            $programming_languages = ['PHP', 'JavaScript', 'Python', 'Java', 'C++', 'Ruby', 'Go', 'Swift'];
            $birth_date = '';
            $age = '';
            
            if (isset($_POST['submit_survey'])) {
                $selected_langs = $_POST['languages'] ?? [];
                $lang_count = count($selected_langs);
                
                if (isset($_POST['birthdate'])) {
                    $birth = new DateTime($_POST['birthdate']);
                    $today = new DateTime();
                    $age = $today->diff($birth)->y;
                }
            }
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">6</span>
                    <span class="task-title">Анкета пользователя</span>
                </div>
                <div class="task-description">
                    Ввод и обработка анкеты с вычислением возраста и количества языков программирования.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$langs</span> = [<span style="color: #f1fa8c;">'PHP'</span>, <span style="color: #f1fa8c;">'JavaScript'</span>, <span style="color: #f1fa8c;">'Python'</span>, <span style="color: #f1fa8c;">'Java'</span>, <span style="color: #f1fa8c;">'C++'</span>, <span style="color: #f1fa8c;">'Ruby'</span>, <span style="color: #f1fa8c;">'Go'</span>, <span style="color: #f1fa8c;">'Swift'</span>];<br><br><span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">isset</span>(<span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'submit_survey'</span>])) {<br>    <span style="color: #ffb86c;">$fullname</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'fullname'</span>] ?? <span style="color: #f1fa8c;">''</span>;<br>    <span style="color: #ffb86c;">$email</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'email'</span>] ?? <span style="color: #f1fa8c;">''</span>;<br>    <span style="color: #ffb86c;">$selected</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'languages'</span>] ?? [];<br>    <br>    <span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">isset</span>(<span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'birthdate'</span>])) {<br>        <span style="color: #ffb86c;">$birth</span> = <span style="color: #50fa7b;">new</span> DateTime(<span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'birthdate'</span>]);<br>        <span style="color: #ffb86c;">$today</span> = <span style="color: #50fa7b;">new</span> DateTime();<br>        <span style="color: #ffb86c;">$age</span> = <span style="color: #ffb86c;">$today</span>-><span style="color: #50fa7b;">diff</span>(<span style="color: #ffb86c;">$birth</span>)-><span style="color: #ffb86c;">y</span>;<br>    }<br>    <br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"&lt;h3&gt;Результаты анкеты&lt;/h3&gt;"</span>;<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Ф.И.О.: "</span> . <span style="color: #50fa7b;">htmlspecialchars</span>(<span style="color: #ffb86c;">$fullname</span>) . <span style="color: #f1fa8c;">"&lt;br&gt;"</span>;<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Email: "</span> . <span style="color: #50fa7b;">htmlspecialchars</span>(<span style="color: #ffb86c;">$email</span>) . <span style="color: #f1fa8c;">"&lt;br&gt;"</span>;<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Возраст: $age лет&lt;br&gt;"</span>;<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Языки: "</span> . <span style="color: #50fa7b;">count</span>(<span style="color: #ffb86c;">$selected</span>) . <span style="color: #f1fa8c;">" шт.: "</span> . <span style="color: #50fa7b;">implode</span>(<span style="color: #f1fa8c;">', '</span>, <span style="color: #ffb86c;">$selected</span>);<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="form-container">
                        <form method="POST">
                            <div class="form-group">
                                <label>Ф.И.О.:</label>
                                <input type="text" name="fullname" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Дата рождения:</label>
                                <input type="date" name="birthdate" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Какие языки программирования знаете?</label>
                                <div class="checkbox-group">
                                    <?php foreach ($programming_languages as $lang): ?>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="languages[]" value="<?php echo $lang; ?>"> <?php echo $lang; ?>
                                    </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <button type="submit" name="submit_survey" class="btn">Отправить анкету</button>
                        </form>
                        
                        <?php if (isset($_POST['submit_survey'])): ?>
                        <div style="margin-top: 20px;">
                            <div class="alert alert-success">
                                <strong>✅ Анкета обработана!</strong>
                            </div>
                            <div class="result-item">
                                <span class="result-label">Ф.И.О.</span>
                                <span class="result-content"><?php echo htmlspecialchars($_POST['fullname'] ?? ''); ?></span>
                            </div>
                            <div class="result-item">
                                <span class="result-label">Email</span>
                                <span class="result-content"><?php echo htmlspecialchars($_POST['email'] ?? ''); ?></span>
                            </div>
                            <div class="result-item">
                                <span class="result-label">Возраст</span>
                                <span class="result-content"><?php echo $age ?: 'не указан'; ?> лет</span>
                            </div>
                            <div class="result-item">
                                <span class="result-label">Языки</span>
                                <span class="result-content"><?php echo $lang_count; ?> языков: <?php echo implode(', ', $selected_langs); ?></span>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- ЗАДАНИЕ 7: Тест -->
            <?php
            $test_score = 0;
            $test_max = 4;
            $test_result_message = '';
            
            if (isset($_POST['submit_test'])) {
                $answers = [
                    'q1' => $_POST['q1'] ?? '',
                    'q2' => $_POST['q2'] ?? '',
                    'q3' => $_POST['q3'] ?? '',
                    'q4' => $_POST['q4'] ?? ''
                ];
                
                // Правильные ответы
                if ($answers['q1'] === 'php') $test_score++;
                if ($answers['q2'] === 'js') $test_score++;
                if ($answers['q3'] === 'mysql') $test_score++;
                if ($answers['q4'] === 'html') $test_score++;
                
                if ($test_score == 4) {
                    $test_result_message = "Отлично! Вы знаете всё!";
                } elseif ($test_score >= 3) {
                    $test_result_message = "Хорошо! Но есть куда расти.";
                } elseif ($test_score >= 2) {
                    $test_result_message = "Удовлетворительно. Повторите материал.";
                } else {
                    $test_result_message = "Вам нужно подучить основы.";
                }
            }
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">7</span>
                    <span class="task-title">Тест по веб-технологиям</span>
                </div>
                <div class="task-description">
                    Тест из 4 вопросов с начислением баллов. Проверьте свои знания!
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$score</span> = 0;<br><span style="color: #ffb86c;">$max</span> = 4;<br><br><span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">isset</span>(<span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'submit_test'</span>])) {<br>    <span style="color: #ffb86c;">$answers</span>[<span style="color: #f1fa8c;">'q1'</span>] = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'q1'</span>] ?? <span style="color: #f1fa8c;">''</span>;<br>    <span style="color: #ffb86c;">$answers</span>[<span style="color: #f1fa8c;">'q2'</span>] = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'q2'</span>] ?? <span style="color: #f1fa8c;">''</span>;<br>    <span style="color: #ffb86c;">$answers</span>[<span style="color: #f1fa8c;">'q3'</span>] = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'q3'</span>] ?? <span style="color: #f1fa8c;">''</span>;<br>    <span style="color: #ffb86c;">$answers</span>[<span style="color: #f1fa8c;">'q4'</span>] = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'q4'</span>] ?? <span style="color: #f1fa8c;">''</span>;<br>    <br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$answers</span>[<span style="color: #f1fa8c;">'q1'</span>] === <span style="color: #f1fa8c;">'php'</span>) <span style="color: #ffb86c;">$score</span>++;<br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$answers</span>[<span style="color: #f1fa8c;">'q2'</span>] === <span style="color: #f1fa8c;">'js'</span>) <span style="color: #ffb86c;">$score</span>++;<br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$answers</span>[<span style="color: #f1fa8c;">'q3'</span>] === <span style="color: #f1fa8c;">'mysql'</span>) <span style="color: #ffb86c;">$score</span>++;<br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$answers</span>[<span style="color: #f1fa8c;">'q4'</span>] === <span style="color: #f1fa8c;">'html'</span>) <span style="color: #ffb86c;">$score</span>++;<br>    <br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Результат: $score из $max&lt;br&gt;"</span>;<br>    <br>    <span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$score</span> == 4) {<br>        <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Отлично! Вы знаете всё!"</span>;<br>    } <span style="color: #50fa7b;">elseif</span> (<span style="color: #ffb86c;">$score</span> >= 3) {<br>        <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Хорошо! Но есть куда расти."</span>;<br>    } <span style="color: #50fa7b;">elseif</span> (<span style="color: #ffb86c;">$score</span> >= 2) {<br>        <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Удовлетворительно. Повторите материал."</span>;<br>    } <span style="color: #50fa7b;">else</span> {<br>        <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Вам нужно подучить основы."</span>;<br>    }<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="form-container">
                        <form method="POST">
                            <div class="form-group">
                                <label>1. Какой язык используется для серверной разработки?</label>
                                <div class="radio-group">
                                    <label class="radio-item"><input type="radio" name="q1" value="html"> HTML</label>
                                    <label class="radio-item"><input type="radio" name="q1" value="css"> CSS</label>
                                    <label class="radio-item"><input type="radio" name="q1" value="php"> PHP</label>
                                    <label class="radio-item"><input type="radio" name="q1" value="js"> JavaScript</label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>2. Какой язык добавляет интерактивность на страницу?</label>
                                <div class="radio-group">
                                    <label class="radio-item"><input type="radio" name="q2" value="html"> HTML</label>
                                    <label class="radio-item"><input type="radio" name="q2" value="css"> CSS</label>
                                    <label class="radio-item"><input type="radio" name="q2" value="php"> PHP</label>
                                    <label class="radio-item"><input type="radio" name="q2" value="js"> JavaScript</label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>3. Какая СУБД часто используется с PHP?</label>
                                <div class="radio-group">
                                    <label class="radio-item"><input type="radio" name="q3" value="mysql"> MySQL</label>
                                    <label class="radio-item"><input type="radio" name="q3" value="mongo"> MongoDB</label>
                                    <label class="radio-item"><input type="radio" name="q3" value="redis"> Redis</label>
                                    <label class="radio-item"><input type="radio" name="q3" value="pg"> PostgreSQL</label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>4. Какой язык отвечает за структуру страницы?</label>
                                <div class="radio-group">
                                    <label class="radio-item"><input type="radio" name="q4" value="html"> HTML</label>
                                    <label class="radio-item"><input type="radio" name="q4" value="css"> CSS</label>
                                    <label class="radio-item"><input type="radio" name="q4" value="php"> PHP</label>
                                    <label class="radio-item"><input type="radio" name="q4" value="js"> JavaScript</label>
                                </div>
                            </div>
                            
                            <button type="submit" name="submit_test" class="btn">Проверить тест</button>
                        </form>
                        
                        <?php if (isset($_POST['submit_test'])): ?>
                        <div style="margin-top: 20px;">
                            <div class="result-item">
                                <span class="result-label">Результат</span>
                                <span class="result-content"><?php echo $test_score; ?> из <?php echo $test_max; ?></span>
                            </div>
                            <div class="alert alert-success" style="margin-top: 10px;">
                                <?php echo $test_result_message; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- ДОПОЛНИТЕЛЬНАЯ ИНФОРМАЦИЯ -->
        <div class="theory-section" style="margin-top: 20px;">
            <h2>📌 Важные замечания</h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                <div style="background: #f7fafc; border-radius: 12px; padding: 20px;">
                    <h3 style="color: #6B46C1; margin-bottom: 10px;">Методы передачи данных</h3>
                    <p><strong>GET:</strong> Данные в URL, есть ограничение по длине, можно сохранить ссылку.</p>
                    <p><strong>POST:</strong> Данные в теле запроса, нет ограничений, безопаснее.</p>
                </div>
                
                <div style="background: #f7fafc; border-radius: 12px; padding: 20px;">
                    <h3 style="color: #6B46C1; margin-bottom: 10px;">Безопасность форм</h3>
                    <p>Всегда используйте <strong>htmlspecialchars()</strong> при выводе пользовательских данных.</p>
                    <p>Проверяйте и валидируйте данные перед использованием.</p>
                </div>
                
                <div style="background: #f7fafc; border-radius: 12px; padding: 20px;">
                    <h3 style="color: #6B46C1; margin-bottom: 10px;">Отправка email</h3>
                    <p>Функция <strong>mail()</strong> требует настроенного SMTP-сервера.</p>
                    <p>На локальном сервере обычно не работает без дополнительной настройки.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>