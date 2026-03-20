<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Практическая работа 28-29: Работа с базой данных в PHP</title>
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

        .data-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-top: 15px;
        }

        .data-table th {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: 600;
        }

        .data-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #e2e8f0;
        }

        .data-table tr:hover {
            background: #f7fafc;
        }

        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            transition: transform 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-danger {
            background: linear-gradient(135deg, #c0392b 0%, #e74c3c 100%);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f39c12 0%, #f1c40f 100%);
        }

        .form-container {
            background: white;
            border-radius: 16px;
            padding: 25px;
            margin: 20px 0;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
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

        .tasks-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
            margin-top: 30px;
        }

        .task-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
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
            flex-shrink: 0;
        }

        .task-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2d3748;
        }

        .task-description {
            background: #f7fafc;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 0.95rem;
            color: #4a5568;
            border-left: 4px solid #2a5298;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        @media (max-width: 768px) {
            body {
                padding: 20px 10px;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Практическая работа 28-29</h1>
            <p>Создание базы данных на языке PHP. Организация связей Web-страницы с БД</p>
        </div>

        <?php
        // ==================== ИНСТРУКЦИЯ ПО НАСТРОЙКЕ ====================
        echo '<div class="alert alert-info">';
        echo '<strong>🔧 Инструкция по настройке OpenServer:</strong><br>';
        echo '1. Запустите OpenServer (зеленый флажок)<br>';
        echo '2. В меню OpenServer выберите "Настройки" → "Модули"<br>';
        echo '3. В разделе "MySQL" выберите любую версию (например, MySQL-8.0 или MySQL-5.7)<br>';
        echo '4. Нажмите "Сохранить" и перезапустите сервер<br>';
        echo '5. Убедитесь, что в трее появился значок MySQL<br>';
        echo '6. Так же, убедитесь в том что пароль совпадает с вашим. Например $password = "root";';
        echo '</div>';
        
        // ==================== НАСТРОЙКА ПОДКЛЮЧЕНИЯ К БД ====================
        // Для OpenServer стандартные настройки:
        $host = 'localhost';
        $user = 'root';
        $password = 'root';  // В OpenServer пароль по умолчанию пустой
        $port = 3306;     // Стандартный порт MySQL
        $dbname = 'practice_db';
        
        $connection_error = false;
        $error_message = '';
        
        // Пробуем подключиться с разными параметрами
        try {
            // Создаем подключение
            $conn = @new mysqli($host, $user, $password, '', $port);
            
            // Проверяем подключение
            if ($conn->connect_error) {
                $connection_error = true;
                $error_message = "Ошибка подключения: " . $conn->connect_error;
                
                // Пробуем альтернативные варианты
                echo '<div class="alert alert-error">';
                echo '<strong>❌ Не удалось подключиться к MySQL!</strong><br>';
                echo 'Проверьте, что MySQL запущен в OpenServer.<br>';
                echo 'Для этого:<br>';
                echo '1. Нажмите на флажок OpenServer в трее<br>';
                echo '2. Выберите "Настройки" → "Модули"<br>';
                echo '3. В разделе "MySQL" выберите MySQL-8.0 или MySQL-5.7<br>';
                echo '4. Нажмите "Сохранить" и перезапустите сервер<br><br>';
                echo 'Техническая информация: ' . $conn->connect_error;
                echo '</div>';
            } else {
                echo '<div class="alert alert-success">✅ Подключение к MySQL успешно!</div>';
                
                // Создание базы данных, если не существует
                $conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
                $conn->select_db($dbname);
                
                // Создание таблицы workers
                $conn->query("
                    CREATE TABLE IF NOT EXISTS workers (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        name VARCHAR(50) NOT NULL,
                        age INT NOT NULL,
                        salary INT NOT NULL
                    )
                ");
                
                // Проверка и добавление начальных данных, если таблица пуста
                $result = $conn->query("SELECT COUNT(*) as count FROM workers");
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    if ($row['count'] == 0) {
                        $conn->query("INSERT INTO workers (name, age, salary) VALUES 
                            ('Дима', 23, 400),
                            ('Петя', 25, 500),
                            ('Вася', 23, 500),
                            ('Коля', 30, 1000),
                            ('Иван', 27, 500),
                            ('Кирилл', 28, 1000)
                        ");
                        echo '<div class="alert alert-success">✅ Начальные данные добавлены в таблицу workers</div>';
                    }
                }
                
                // Создание таблицы pages для задач LIKE
                $conn->query("
                    CREATE TABLE IF NOT EXISTS pages (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        author VARCHAR(50) NOT NULL,
                        article TEXT NOT NULL
                    )
                ");
                
                // Проверка и добавление данных в pages
                $result = $conn->query("SELECT COUNT(*) as count FROM pages");
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    if ($row['count'] == 0) {
                        $conn->query("INSERT INTO pages (author, article) VALUES 
                            ('Петров', 'В своей статье рассказывает о машинах.'),
                            ('Иванов', 'Написал статью об инфляции.'),
                            ('Сидоров', 'Придумал новый химический элемент.'),
                            ('Осокина', 'Также писала о машинах.'),
                            ('Ветров', 'Написал статью о том, как разрабатывать элементы дизайна.')
                        ");
                        echo '<div class="alert alert-success">✅ Начальные данные добавлены в таблицу pages</div>';
                    }
                }
                
                // ==================== ОБРАБОТКА ДЕЙСТВИЙ ====================
                $message = '';
                
                // Добавление работника
                if (isset($_POST['add_worker'])) {
                    $name = $conn->real_escape_string($_POST['name']);
                    $age = intval($_POST['age']);
                    $salary = intval($_POST['salary']);
                    
                    if ($name && $age && $salary) {
                        if ($conn->query("INSERT INTO workers (name, age, salary) VALUES ('$name', $age, $salary)")) {
                            $message = "✅ Работник '$name' успешно добавлен!";
                        } else {
                            $message = "❌ Ошибка при добавлении: " . $conn->error;
                        }
                    } else {
                        $message = "❌ Заполните все поля!";
                    }
                }
                
                // Удаление работника
                if (isset($_GET['del_id'])) {
                    $del_id = intval($_GET['del_id']);
                    if ($conn->query("DELETE FROM workers WHERE id = $del_id")) {
                        $message = "✅ Работник удален!";
                    } else {
                        $message = "❌ Ошибка при удалении: " . $conn->error;
                    }
                    // Перенаправление для очистки GET параметра
                    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
                    exit;
                }
                
                // Редактирование работника
                $edit_worker = null;
                if (isset($_GET['edit_id'])) {
                    $edit_id = intval($_GET['edit_id']);
                    $result = $conn->query("SELECT * FROM workers WHERE id = $edit_id");
                    if ($result && $result->num_rows > 0) {
                        $edit_worker = $result->fetch_assoc();
                    }
                }
                
                if (isset($_POST['update_worker'])) {
                    $update_id = intval($_POST['update_id']);
                    $name = $conn->real_escape_string($_POST['name']);
                    $age = intval($_POST['age']);
                    $salary = intval($_POST['salary']);
                    
                    if ($conn->query("UPDATE workers SET name='$name', age=$age, salary=$salary WHERE id=$update_id")) {
                        $message = "✅ Работник '$name' успешно обновлен!";
                    } else {
                        $message = "❌ Ошибка при обновлении: " . $conn->error;
                    }
                    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
                    exit;
                }
                
                // ==================== ВЫПОЛНЕНИЕ SQL ЗАПРОСОВ ДЛЯ ЗАДАЧ ====================
                
                // Задача 1: первые 6 записей
                $result1 = $conn->query("SELECT * FROM workers LIMIT 6");
                $workers1 = ($result1 && $result1->num_rows > 0) ? $result1->fetch_all(MYSQLI_ASSOC) : [];
                
                // Задача 2: со второй, 3 штуки
                $result2 = $conn->query("SELECT * FROM workers LIMIT 1, 3");
                $workers2 = ($result2 && $result2->num_rows > 0) ? $result2->fetch_all(MYSQLI_ASSOC) : [];
                
                // Задача 3: по возрастанию зарплаты
                $result3 = $conn->query("SELECT * FROM workers ORDER BY salary ASC");
                $workers3 = ($result3 && $result3->num_rows > 0) ? $result3->fetch_all(MYSQLI_ASSOC) : [];
                
                // Задача 4: по убыванию зарплаты
                $result4 = $conn->query("SELECT * FROM workers ORDER BY salary DESC");
                $workers4 = ($result4 && $result4->num_rows > 0) ? $result4->fetch_all(MYSQLI_ASSOC) : [];
                
                // Задача 5: со второго по возрастанию возраста
                $result5 = $conn->query("SELECT * FROM workers ORDER BY age ASC LIMIT 1, 5");
                $workers5 = ($result5 && $result5->num_rows > 0) ? $result5->fetch_all(MYSQLI_ASSOC) : [];
                
                // Задача 6: подсчет всех работников
                $result6 = $conn->query("SELECT COUNT(*) as total FROM workers");
                $total_workers = ($result6 && $result6->num_rows > 0) ? $result6->fetch_assoc()['total'] : 0;
                
                // Задача 7: подсчет с зарплатой 300$
                $result7 = $conn->query("SELECT COUNT(*) as total FROM workers WHERE salary = 300");
                $salary300_count = ($result7 && $result7->num_rows > 0) ? $result7->fetch_assoc()['total'] : 0;
                
                // Задача 8: фамилия заканчивается на "ов"
                $result8 = $conn->query("SELECT * FROM pages WHERE author LIKE '%ов'");
                $authors_ov = ($result8 && $result8->num_rows > 0) ? $result8->fetch_all(MYSQLI_ASSOC) : [];
                
                // Задача 9: статья содержит "элемент"
                $result9 = $conn->query("SELECT * FROM pages WHERE article LIKE '%элемент%'");
                $articles_element = ($result9 && $result9->num_rows > 0) ? $result9->fetch_all(MYSQLI_ASSOC) : [];
                
                // Задача 10: возраст начинается с 3, далее одна цифра
                $result10 = $conn->query("SELECT * FROM workers WHERE age LIKE '3_'");
                $workers_age_3x = ($result10 && $result10->num_rows > 0) ? $result10->fetch_all(MYSQLI_ASSOC) : [];
                
                // Задача 11: имя заканчивается на "я"
                $result11 = $conn->query("SELECT * FROM workers WHERE name LIKE '%я'");
                $workers_name_ya = ($result11 && $result11->num_rows > 0) ? $result11->fetch_all(MYSQLI_ASSOC) : [];
                
                if ($message) {
                    echo '<div class="alert alert-success">' . $message . '</div>';
                }
                ?>
                
                <!-- ТАБЛИЦА WORKERS -->
                <div class="task-card">
                    <div class="task-header">
                        <span class="task-number">📊</span>
                        <span class="task-title">Таблица workers (все записи)</span>
                    </div>
                    <div class="task-description">
                        Таблица с работниками. Включены функции: добавление, удаление, редактирование.
                    </div>
                    
                    <!-- Форма добавления -->
                    <div class="form-container">
                        <h3>➕ Добавить нового работника</h3>
                        <form method="POST">
                            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr auto; gap: 10px;">
                                <input type="text" name="name" placeholder="Имя" class="form-control" required>
                                <input type="number" name="age" placeholder="Возраст" class="form-control" required>
                                <input type="number" name="salary" placeholder="Зарплата" class="form-control" required>
                                <button type="submit" name="add_worker" class="btn">Добавить</button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Таблица с работниками -->
                    <table class="data-table">
                        <thead>
                            <tr><th>ID</th><th>Имя</th><th>Возраст</th><th>Зарплата</th><th>Действия</th> </thead>
                        <tbody>
                            <?php
                            $workers = $conn->query("SELECT * FROM workers ORDER BY id");
                            if ($workers && $workers->num_rows > 0) {
                                while ($worker = $workers->fetch_assoc()): ?>
                                 <tr>
                                    <td><?php echo $worker['id']; ?></td>
                                    <td><?php echo htmlspecialchars($worker['name']); ?></td>
                                    <td><?php echo $worker['age']; ?></td>
                                    <td><?php echo $worker['salary']; ?>$</td>
                                    <td class="action-buttons">
                                        <a href="?edit_id=<?php echo $worker['id']; ?>" class="btn btn-warning">✏️ Редактировать</a>
                                        <a href="?del_id=<?php echo $worker['id']; ?>" class="btn btn-danger" onclick="return confirm('Удалить работника?')">🗑️ Удалить</a>
                                    </td>
                                 </tr>
                            <?php 
                                endwhile;
                            } else {
                                echo '<tr><td colspan="5" style="text-align: center;">Нет данных</td></tr>';
                            }
                            ?>
                        </tbody>
                     </table>
                    
                    <!-- Форма редактирования -->
                    <?php if (isset($edit_worker) && $edit_worker): ?>
                    <div class="edit-form" style="background: #f7fafc; border-radius: 12px; padding: 20px; margin-top: 20px;">
                        <h3>✏️ Редактирование работника</h3>
                        <form method="POST">
                            <input type="hidden" name="update_id" value="<?php echo $edit_worker['id']; ?>">
                            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr auto; gap: 10px;">
                                <input type="text" name="name" value="<?php echo htmlspecialchars($edit_worker['name']); ?>" class="form-control" required>
                                <input type="number" name="age" value="<?php echo $edit_worker['age']; ?>" class="form-control" required>
                                <input type="number" name="salary" value="<?php echo $edit_worker['salary']; ?>" class="form-control" required>
                                <button type="submit" name="update_worker" class="btn">Сохранить</button>
                            </div>
                        </form>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- ЗАДАЧИ -->
                <div class="tasks-grid">
                    <!-- Задача 1: LIMIT -->
                    <div class="task-card">
                        <div class="task-header">
                            <span class="task-number">1</span>
                            <span class="task-title">LIMIT: первые 6 записей</span>
                        </div>
                        <div class="task-description">
                            SQL: <code>SELECT * FROM workers LIMIT 6;</code>
                        </div>
                        <table class="data-table">
                            <thead><tr><th>ID</th><th>Имя</th><th>Возраст</th><th>Зарплата</th></tr></thead>
                            <tbody>
                                <?php foreach ($workers1 as $w): ?>
                                <tr><td><?php echo $w['id']; ?></td><td><?php echo $w['name']; ?></td><td><?php echo $w['age']; ?></td><td><?php echo $w['salary']; ?>$</td></tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Задача 2: LIMIT со смещением -->
                    <div class="task-card">
                        <div class="task-header">
                            <span class="task-number">2</span>
                            <span class="task-title">LIMIT: со второй, 3 штуки</span>
                        </div>
                        <div class="task-description">
                            SQL: <code>SELECT * FROM workers LIMIT 1, 3;</code>
                        </div>
                        <table class="data-table">
                            <thead><tr><th>ID</th><th>Имя</th><th>Возраст</th><th>Зарплата</th></tr></thead>
                            <tbody>
                                <?php foreach ($workers2 as $w): ?>
                                <tr><td><?php echo $w['id']; ?></td><td><?php echo $w['name']; ?></td><td><?php echo $w['age']; ?></td><td><?php echo $w['salary']; ?>$</td></tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Задача 3: ORDER BY ASC -->
                    <div class="task-card">
                        <div class="task-header">
                            <span class="task-number">3</span>
                            <span class="task-title">ORDER BY: по возрастанию зарплаты</span>
                        </div>
                        <div class="task-description">
                            SQL: <code>SELECT * FROM workers ORDER BY salary ASC;</code>
                        </div>
                        <table class="data-table">
                            <thead><tr><th>ID</th><th>Имя</th><th>Возраст</th><th>Зарплата</th></tr></thead>
                            <tbody>
                                <?php foreach ($workers3 as $w): ?>
                                <tr><td><?php echo $w['id']; ?></td><td><?php echo $w['name']; ?></td><td><?php echo $w['age']; ?></td><td><?php echo $w['salary']; ?>$</td></tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Задача 4: ORDER BY DESC -->
                    <div class="task-card">
                        <div class="task-header">
                            <span class="task-number">4</span>
                            <span class="task-title">ORDER BY: по убыванию зарплаты</span>
                        </div>
                        <div class="task-description">
                            SQL: <code>SELECT * FROM workers ORDER BY salary DESC;</code>
                        </div>
                        <table class="data-table">
                            <thead><tr><th>ID</th><th>Имя</th><th>Возраст</th><th>Зарплата</th></tr></thead>
                            <tbody>
                                <?php foreach ($workers4 as $w): ?>
                                <tr><td><?php echo $w['id']; ?></td><td><?php echo $w['name']; ?></td><td><?php echo $w['age']; ?></td><td><?php echo $w['salary']; ?>$</td></tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Задача 5: ORDER BY + LIMIT -->
                    <div class="task-card">
                        <div class="task-header">
                            <span class="task-number">5</span>
                            <span class="task-title">ORDER BY + LIMIT: со второго по возрасту</span>
                        </div>
                        <div class="task-description">
                            SQL: <code>SELECT * FROM workers ORDER BY age ASC LIMIT 1, 5;</code>
                        </div>
                        <table class="data-table">
                            <thead><tr><th>ID</th><th>Имя</th><th>Возраст</th><th>Зарплата</th></tr></thead>
                            <tbody>
                                <?php foreach ($workers5 as $w): ?>
                                <tr><td><?php echo $w['id']; ?></td><td><?php echo $w['name']; ?></td><td><?php echo $w['age']; ?></td><td><?php echo $w['salary']; ?>$</td></tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Задача 6: COUNT -->
                    <div class="task-card">
                        <div class="task-header">
                            <span class="task-number">6</span>
                            <span class="task-title">COUNT: всех работников</span>
                        </div>
                        <div class="task-description">
                            SQL: <code>SELECT COUNT(*) FROM workers;</code>
                        </div>
                        <div class="alert alert-info">📊 Всего работников: <strong><?php echo $total_workers; ?></strong></div>
                    </div>
                    
                    <!-- Задача 7: COUNT с условием -->
                    <div class="task-card">
                        <div class="task-header">
                            <span class="task-number">7</span>
                            <span class="task-title">COUNT: с зарплатой 300$</span>
                        </div>
                        <div class="task-description">
                            SQL: <code>SELECT COUNT(*) FROM workers WHERE salary = 300;</code>
                        </div>
                        <div class="alert alert-info">📊 Работников с зарплатой 300$: <strong><?php echo $salary300_count; ?></strong></div>
                    </div>
                    
                    <!-- Задача 8: LIKE -->
                    <div class="task-card">
                        <div class="task-header">
                            <span class="task-number">8</span>
                            <span class="task-title">LIKE: фамилия заканчивается на "ов"</span>
                        </div>
                        <div class="task-description">
                            SQL: <code>SELECT * FROM pages WHERE author LIKE '%ов';</code>
                        </div>
                        <table class="data-table">
                            <thead><tr><th>ID</th><th>Автор</th><th>Статья</th></tr></thead>
                            <tbody>
                                <?php foreach ($authors_ov as $a): ?>
                                <tr><td><?php echo $a['id']; ?></td><td><?php echo $a['author']; ?></td><td><?php echo $a['article']; ?></td></tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Задача 9: LIKE с "элемент" -->
                    <div class="task-card">
                        <div class="task-header">
                            <span class="task-number">9</span>
                            <span class="task-title">LIKE: статья содержит "элемент"</span>
                        </div>
                        <div class="task-description">
                            SQL: <code>SELECT * FROM pages WHERE article LIKE '%элемент%';</code>
                        </div>
                        <table class="data-table">
                            <thead><tr><th>ID</th><th>Автор</th><th>Статья</th></tr></thead>
                            <tbody>
                                <?php foreach ($articles_element as $a): ?>
                                <tr><td><?php echo $a['id']; ?></td><td><?php echo $a['author']; ?></td><td><?php echo $a['article']; ?></td></tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Задача 10: возраст 3_ -->
                    <div class="task-card">
                        <div class="task-header">
                            <span class="task-number">10</span>
                            <span class="task-title">LIKE: возраст начинается с 3, далее одна цифра</span>
                        </div>
                        <div class="task-description">
                            SQL: <code>SELECT * FROM workers WHERE age LIKE '3_';</code>
                        </div>
                        <table class="data-table">
                            <thead><tr><th>ID</th><th>Имя</th><th>Возраст</th><th>Зарплата</th></tr></thead>
                            <tbody>
                                <?php foreach ($workers_age_3x as $w): ?>
                                <tr><td><?php echo $w['id']; ?></td><td><?php echo $w['name']; ?></td><td><?php echo $w['age']; ?></td><td><?php echo $w['salary']; ?>$</td></tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Задача 11: имя заканчивается на "я" -->
                    <div class="task-card">
                        <div class="task-header">
                            <span class="task-number">11</span>
                            <span class="task-title">LIKE: имя заканчивается на "я"</span>
                        </div>
                        <div class="task-description">
                            SQL: <code>SELECT * FROM workers WHERE name LIKE '%я';</code>
                        </div>
                        <table class="data-table">
                            <thead><tr><th>ID</th><th>Имя</th><th>Возраст</th><th>Зарплата</th></tr></thead>
                            <tbody>
                                <?php foreach ($workers_name_ya as $w): ?>
                                <tr><td><?php echo $w['id']; ?></td><td><?php echo $w['name']; ?></td><td><?php echo $w['age']; ?></td><td><?php echo $w['salary']; ?>$</td></tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <?php
                $conn->close();
            }
        } catch (Exception $e) {
            echo '<div class="alert alert-error">❌ Ошибка: ' . $e->getMessage() . '</div>';
        }
        ?>
    </div>
</body>
</html>