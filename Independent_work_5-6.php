<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Самостоятельная работа: Формы в PHP</title>
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

        textarea.form-control {
            resize: vertical;
            min-height: 80px;
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
            <h1>Самостоятельная работа</h1>
            <p>Формы в PHP</p>
        </div>

        <!-- ПРИМЕРЫ РЕШЕНИЯ ЗАДАЧ -->
        <div class="example-section">
            <h2>📚 Примеры решения задач</h2>
            
            <h3>Задача №1. Простая форма</h3>
            <p>Спросите город пользователя с помощью формы. Результат запишите в переменную $city. Выведите на экран фразу 'Ваш город: %Город%'.</p>
            <div class="code-example">
                <pre>&lt;form action="" method="GET"&gt;
    &lt;input type="text" name="city"&gt;
    &lt;input type="submit"&gt;
&lt;/form&gt;
&lt;?php
if (!empty($_REQUEST['city'])) {
    $city = $_REQUEST['city'];
    echo 'Ваш город: '.$city;
}
?&gt;</pre>
            </div>
            <?php
            $city_example = isset($_GET['city_example']) ? strip_tags($_GET['city_example']) : '';
            ?>
            <div class="form-container" style="margin-top: 15px;">
                <form method="GET">
                    <div class="form-group">
                        <label>Ваш город:</label>
                        <input type="text" name="city_example" class="form-control" value="<?php echo htmlspecialchars($city_example); ?>">
                    </div>
                    <button type="submit" class="btn">Отправить</button>
                </form>
                <?php if ($city_example): ?>
                    <div class="alert alert-success" style="margin-top: 15px;">
                        Ваш город: <?php echo htmlspecialchars($city_example); ?>
                    </div>
                <?php endif; ?>
            </div>

            <h3 style="margin-top: 30px;">Задача №2. Запрет ввода тегов</h3>
            <p>Решите предыдущую задачу так, чтобы пользователь не мог вводить теги и сломать нам сайт.</p>
            <div class="code-example">
                <pre>&lt;?php
if (isset($_REQUEST['city'])) {
    $city = strip_tags($_REQUEST['city']);
    echo 'Ваш город: '.$city;
}
?&gt;</pre>
            </div>

            <h3 style="margin-top: 30px;">Задача №3. Скрываем форму после отправки</h3>
            <p>Сделайте так, чтобы форма после отправки скрывалась.</p>
            <div class="code-example">
                <pre>&lt;?php
if (!isset($_REQUEST['city'])) {
    // показываем форму
?&gt;
    &lt;form action="" method="GET"&gt;
        &lt;input type="text" name="city"&gt;
        &lt;input type="submit"&gt;
    &lt;/form&gt;
&lt;?php
} else {
    $city = strip_tags($_REQUEST['city']);
    echo 'Ваш город: '.$city;
}
?&gt;</pre>
            </div>
        </div>

        <div class="tasks-grid">
            <!-- Задача 1 -->
            <?php
            $name1 = isset($_GET['name1']) ? strip_tags($_GET['name1']) : '';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">1</span>
                    <span class="task-title">Приветствие пользователя</span>
                </div>
                <div class="task-description">
                    Спросите имя пользователя с помощью формы. Результат запишите в переменную $name. Выведите на экран фразу 'Привет, %Имя%'.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$name</span> = <span style="color: #50fa7b;">isset</span>(<span style="color: #ffb86c;">$_GET</span>[<span style="color: #f1fa8c;">'name'</span>]) ? <span style="color: #50fa7b;">strip_tags</span>(<span style="color: #ffb86c;">$_GET</span>[<span style="color: #f1fa8c;">'name'</span>]) : <span style="color: #f1fa8c;">''</span>;<br><span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$name</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Привет, $name"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="form-container">
                        <form method="GET">
                            <div class="form-group">
                                <label>Ваше имя:</label>
                                <input type="text" name="name1" class="form-control" value="<?php echo htmlspecialchars($name1); ?>">
                            </div>
                            <button type="submit" class="btn">Отправить</button>
                        </form>
                        <?php if ($name1): ?>
                            <div class="alert alert-success" style="margin-top: 15px;">
                                Привет, <?php echo htmlspecialchars($name1); ?>!
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Задача 2 -->
            <?php
            $name2 = isset($_GET['name2']) ? strip_tags($_GET['name2']) : '';
            $age2 = isset($_GET['age2']) ? (int)$_GET['age2'] : '';
            $message2 = isset($_GET['message2']) ? strip_tags($_GET['message2']) : '';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">Анкета пользователя</span>
                </div>
                <div class="task-description">
                    Спросите у пользователя имя, возраст, а также попросите его ввести сообщение (в textarea). Выведите эти данные на экран. Позаботьтесь о том, чтобы пользователь не мог вводить теги.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$name</span> = <span style="color: #50fa7b;">strip_tags</span>(<span style="color: #ffb86c;">$_GET</span>[<span style="color: #f1fa8c;">'name'</span>] ?? <span style="color: #f1fa8c;">''</span>);<br><span style="color: #ffb86c;">$age</span> = (<span style="color: #50fa7b;">int</span>)(<span style="color: #ffb86c;">$_GET</span>[<span style="color: #f1fa8c;">'age'</span>] ?? 0);<br><span style="color: #ffb86c;">$message</span> = <span style="color: #50fa7b;">strip_tags</span>(<span style="color: #ffb86c;">$_GET</span>[<span style="color: #f1fa8c;">'message'</span>] ?? <span style="color: #f1fa8c;">''</span>);<br><br><span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$name</span> && <span style="color: #ffb86c;">$age</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Привет, $name, $age лет.\nТвое сообщение: $message"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="form-container">
                        <form method="GET">
                            <div class="form-group">
                                <label>Имя:</label>
                                <input type="text" name="name2" class="form-control" value="<?php echo htmlspecialchars($name2); ?>">
                            </div>
                            <div class="form-group">
                                <label>Возраст:</label>
                                <input type="number" name="age2" class="form-control" value="<?php echo htmlspecialchars($age2); ?>">
                            </div>
                            <div class="form-group">
                                <label>Сообщение:</label>
                                <textarea name="message2" class="form-control"><?php echo htmlspecialchars($message2); ?></textarea>
                            </div>
                            <button type="submit" class="btn">Отправить</button>
                        </form>
                        <?php if ($name2 && $age2): ?>
                            <div class="alert alert-success" style="margin-top: 15px;">
                                <strong>Привет, <?php echo htmlspecialchars($name2); ?>, <?php echo htmlspecialchars($age2); ?> лет.</strong><br>
                                Твое сообщение: <?php echo htmlspecialchars($message2); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Задача 3 -->
            <?php
            $age3 = isset($_GET['age3']) ? (int)$_GET['age3'] : '';
            $form_submitted3 = isset($_GET['age3']);
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">3</span>
                    <span class="task-title">Скрытие формы после отправки</span>
                </div>
                <div class="task-description">
                    Спросите возраст пользователя. Если форма была отправлена и введен возраст, то выведите его на экран, а форму уберите. Если же форма не была отправлена - просто покажите ее.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">if</span> (!<span style="color: #50fa7b;">isset</span>(<span style="color: #ffb86c;">$_GET</span>[<span style="color: #f1fa8c;">'age'</span>])) {<br>    <span style="color: #6272a4;">// показываем форму</span><br>} <span style="color: #50fa7b;">else</span> {<br>    <span style="color: #ffb86c;">$age</span> = (<span style="color: #50fa7b;">int</span>)<span style="color: #ffb86c;">$_GET</span>[<span style="color: #f1fa8c;">'age'</span>];<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Ваш возраст: $age"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="form-container">
                        <?php if (!$form_submitted3): ?>
                            <form method="GET">
                                <div class="form-group">
                                    <label>Ваш возраст:</label>
                                    <input type="number" name="age3" class="form-control">
                                </div>
                                <button type="submit" class="btn">Отправить</button>
                            </form>
                        <?php else: ?>
                            <div class="alert alert-success">
                                Ваш возраст: <?php echo htmlspecialchars($age3); ?> лет
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Задача 4 -->
            <?php
            $correct_login = "admin";
            $correct_password = "12345";
            
            $login4 = isset($_POST['login4']) ? trim($_POST['login4']) : '';
            $password4 = isset($_POST['password4']) ? trim($_POST['password4']) : '';
            $auth_result4 = '';
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_auth'])) {
                if ($login4 === $correct_login && $password4 === $correct_password) {
                    $auth_result4 = 'Доступ разрешен!';
                } else {
                    $auth_result4 = 'Доступ запрещен!';
                }
            }
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4</span>
                    <span class="task-title">Авторизация</span>
                </div>
                <div class="task-description">
                    Спросите у пользователя логин и пароль (в браузере должен быть звездочками). Сравните их с логином admin и паролем 12345. Если все верно - выведите 'Доступ разрешен!', в противном случае - 'Доступ запрещен!'. Скрипт должен обрезать концевые пробелы.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$correct_login</span> = <span style="color: #f1fa8c;">"admin"</span>;<br><span style="color: #ffb86c;">$correct_pass</span> = <span style="color: #f1fa8c;">"12345"</span>;<br><br><span style="color: #ffb86c;">$login</span> = <span style="color: #50fa7b;">trim</span>(<span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'login'</span>] ?? <span style="color: #f1fa8c;">''</span>);<br><span style="color: #ffb86c;">$password</span> = <span style="color: #50fa7b;">trim</span>(<span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'password'</span>] ?? <span style="color: #f1fa8c;">''</span>);<br><br><span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$login</span> === <span style="color: #ffb86c;">$correct_login</span> && <span style="color: #ffb86c;">$password</span> === <span style="color: #ffb86c;">$correct_pass</span>) {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Доступ разрешен!"</span>;<br>} <span style="color: #50fa7b;">else</span> {<br>    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Доступ запрещен!"</span>;<br>}</pre>
                </div>
                <div class="task-result">
                    <div class="form-container">
                        <form method="POST">
                            <div class="form-group">
                                <label>Логин:</label>
                                <input type="text" name="login4" class="form-control" value="<?php echo htmlspecialchars($login4); ?>">
                            </div>
                            <div class="form-group">
                                <label>Пароль:</label>
                                <input type="password" name="password4" class="form-control">
                            </div>
                            <button type="submit" name="submit_auth" class="btn">Войти</button>
                        </form>
                        <?php if ($auth_result4): ?>
                            <div class="alert <?php echo $auth_result4 === 'Доступ разрешен!' ? 'alert-success' : 'alert-error'; ?>" style="margin-top: 15px;">
                                <?php echo $auth_result4; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Задача 5 -->
            <?php
            $name5 = isset($_GET['name5']) ? strip_tags($_GET['name5']) : '';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">5</span>
                    <span class="task-title">Сохранение значения поля</span>
                </div>
                <div class="task-description">
                    Спросите имя пользователя с помощью формы. Результат запишите в переменную $name. Сделайте так, чтобы после отправки формы значения ее полей не пропадали.
                </div>
                <div class="task-solution">
                    <pre>&lt;input type="text" name="name" value="&lt;?php echo htmlspecialchars($name); ?&gt;"&gt;</pre>
                </div>
                <div class="task-result">
                    <div class="form-container">
                        <form method="GET">
                            <div class="form-group">
                                <label>Ваше имя:</label>
                                <input type="text" name="name5" class="form-control" value="<?php echo htmlspecialchars($name5); ?>">
                            </div>
                            <button type="submit" class="btn">Отправить</button>
                        </form>
                        <?php if ($name5): ?>
                            <div class="alert alert-success" style="margin-top: 15px;">
                                Привет, <?php echo htmlspecialchars($name5); ?>!
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Задача 6 -->
            <?php
            $name6 = isset($_GET['name6']) ? strip_tags($_GET['name6']) : '';
            $message6 = isset($_GET['message6']) ? strip_tags($_GET['message6']) : '';
            ?>
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">6</span>
                    <span class="task-title">Сохранение значений в textarea</span>
                </div>
                <div class="task-description">
                    Спросите у пользователя имя, а также попросите его ввести сообщение (textarea). Сделайте так, чтобы после отправки формы значения его полей не пропадали.
                </div>
                <div class="task-solution">
                    <pre>&lt;input type="text" name="name" value="&lt;?php echo htmlspecialchars($name); ?&gt;"&gt;<br>&lt;textarea name="message"&gt;&lt;?php echo htmlspecialchars($message); ?&gt;&lt;/textarea&gt;</pre>
                </div>
                <div class="task-result">
                    <div class="form-container">
                        <form method="GET">
                            <div class="form-group">
                                <label>Ваше имя:</label>
                                <input type="text" name="name6" class="form-control" value="<?php echo htmlspecialchars($name6); ?>">
                            </div>
                            <div class="form-group">
                                <label>Сообщение:</label>
                                <textarea name="message6" class="form-control"><?php echo htmlspecialchars($message6); ?></textarea>
                            </div>
                            <button type="submit" class="btn">Отправить</button>
                        </form>
                        <?php if ($name6 && $message6): ?>
                            <div class="alert alert-success" style="margin-top: 15px;">
                                <strong>Привет, <?php echo htmlspecialchars($name6); ?>!</strong><br>
                                Ваше сообщение: <?php echo htmlspecialchars($message6); ?>
                            </div>
                        <?php elseif ($name6): ?>
                            <div class="alert alert-success" style="margin-top: 15px;">
                                Привет, <?php echo htmlspecialchars($name6); ?>!
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>