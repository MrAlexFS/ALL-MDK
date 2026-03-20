<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Практическая работа №27: Основы работы с базами данных SQL в PHP</title>
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

        .table-info {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 30px;
            overflow-x: auto;
        }

        .table-info h3 {
            color: #1e3c72;
            margin-bottom: 15px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        .data-table th {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 10px;
            text-align: left;
        }

        .data-table td {
            border: 1px solid #e2e8f0;
            padding: 8px 10px;
        }

        .data-table tr:nth-child(even) {
            background: #f7fafc;
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
            max-height: 120px;
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
            gap: 8px;
            box-shadow: 0 4px 8px rgba(72, 187, 120, 0.1);
            max-height: 200px;
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
            padding: 6px 12px;
            border-radius: 12px;
            color: #1e293b;
            font-weight: 500;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            word-break: break-word;
            flex: 1;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .sql-query {
            font-family: monospace;
            background: #f7fafc;
            padding: 5px 10px;
            border-radius: 8px;
            color: #2d3748;
            font-size: 0.85rem;
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
                max-height: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Практическая работа №27</h1>
            <p>Основы работы с базами данных SQL в PHP</p>
        </div>

        <!-- ТАБЛИЦА ДЛЯ ЗАДАЧ -->
        <div class="table-info">
            <h3>📊 Таблица workers (исходное состояние)</h3>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>age</th>
                        <th>salary</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>1</td><td>Дима</td><td>23</td><td>400</td></tr>
                    <tr><td>2</td><td>Петя</td><td>25</td><td>500</td></tr>
                    <tr><td>3</td><td>Вася</td><td>23</td><td>500</td></tr>
                    <tr><td>4</td><td>Коля</td><td>30</td><td>1000</td></tr>
                    <tr><td>5</td><td>Иван</td><td>27</td><td>500</td></tr>
                    <tr><td>6</td><td>Кирилл</td><td>28</td><td>1000</td></tr>
                </tbody>
            </table>
            <p style="margin-top: 15px; font-size: 0.9rem; color: #4a5568;">* Для выполнения запросов INSERT, DELETE, UPDATE используется временная таблица. Результаты отображаются в консоли выполнения.</p>
        </div>

        <div class="tasks-grid">
            <!-- SELECT -->
            <div class="section-title">🔍 SELECT (Выборка данных)</div>

            <!-- Задача 1 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">1</span>
                    <span class="task-title">Выбрать работника с id=3</span>
                </div>
                <div class="task-description">
                    Выбрать работника с id = 3.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">SELECT</span> * <span style="color: #50fa7b;">FROM</span> workers <span style="color: #50fa7b;">WHERE</span> id = 3;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">SELECT * FROM workers WHERE id = 3;</span>
                    </div>
                </div>
            </div>

            <!-- Задача 2 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">Выбрать работников с зарплатой 1000$</span>
                </div>
                <div class="task-description">
                    Выбрать работников с зарплатой 1000$.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">SELECT</span> * <span style="color: #50fa7b;">FROM</span> workers <span style="color: #50fa7b;">WHERE</span> salary = 1000;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">SELECT * FROM workers WHERE salary = 1000;</span>
                    </div>
                </div>
            </div>

            <!-- Задача 3 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">3</span>
                    <span class="task-title">Выбрать работников в возрасте 23 года</span>
                </div>
                <div class="task-description">
                    Выбрать работников в возрасте 23 года.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">SELECT</span> * <span style="color: #50fa7b;">FROM</span> workers <span style="color: #50fa7b;">WHERE</span> age = 23;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">SELECT * FROM workers WHERE age = 23;</span>
                    </div>
                </div>
            </div>

            <!-- Задача 4 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4</span>
                    <span class="task-title">Выбрать работников с зарплатой более 400$</span>
                </div>
                <div class="task-description">
                    Выбрать работников с зарплатой более 400$.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">SELECT</span> * <span style="color: #50fa7b;">FROM</span> workers <span style="color: #50fa7b;">WHERE</span> salary > 400;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">SELECT * FROM workers WHERE salary > 400;</span>
                    </div>
                </div>
            </div>

            <!-- Задача 5 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">5</span>
                    <span class="task-title">Выбрать работников с зарплатой ≥ 500$</span>
                </div>
                <div class="task-description">
                    Выбрать работников с зарплатой равной или большей 500$.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">SELECT</span> * <span style="color: #50fa7b;">FROM</span> workers <span style="color: #50fa7b;">WHERE</span> salary >= 500;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">SELECT * FROM workers WHERE salary >= 500;</span>
                    </div>
                </div>
            </div>

            <!-- Задача 6 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">6</span>
                    <span class="task-title">Выбрать работников с зарплатой НЕ равной 500$</span>
                </div>
                <div class="task-description">
                    Выбрать работников с зарплатой НЕ равной 500$.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">SELECT</span> * <span style="color: #50fa7b;">FROM</span> workers <span style="color: #50fa7b;">WHERE</span> salary != 500;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">SELECT * FROM workers WHERE salary != 500;</span>
                    </div>
                </div>
            </div>

            <!-- Задача 7 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">7</span>
                    <span class="task-title">Выбрать работников с зарплатой ≤ 900$</span>
                </div>
                <div class="task-description">
                    Выбрать работников с зарплатой равной или меньшей 900$.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">SELECT</span> * <span style="color: #50fa7b;">FROM</span> workers <span style="color: #50fa7b;">WHERE</span> salary <= 900;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">SELECT * FROM workers WHERE salary <= 900;</span>
                    </div>
                </div>
            </div>

            <!-- Задача 8 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">8</span>
                    <span class="task-title">Зарплата и возраст Васи</span>
                </div>
                <div class="task-description">
                    Узнайте зарплату и возраст Васи.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">SELECT</span> name, age, salary <span style="color: #50fa7b;">FROM</span> workers <span style="color: #50fa7b;">WHERE</span> name = 'Вася';</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">SELECT name, age, salary FROM workers WHERE name = 'Вася';</span>
                    </div>
                </div>
            </div>

            <!-- OR и AND -->
            <div class="section-title">🔗 OR и AND (Сложные условия)</div>

            <!-- Задача 9 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">9</span>
                    <span class="task-title">Возраст от 25 до 28 лет</span>
                </div>
                <div class="task-description">
                    Выбрать работников в возрасте от 25 (не включительно) до 28 лет (включительно).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">SELECT</span> * <span style="color: #50fa7b;">FROM</span> workers <span style="color: #50fa7b;">WHERE</span> age > 25 <span style="color: #50fa7b;">AND</span> age <= 28;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">SELECT * FROM workers WHERE age > 25 AND age <= 28;</span>
                    </div>
                </div>
            </div>

            <!-- Задача 10 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">10</span>
                    <span class="task-title">Выбрать работника Петю</span>
                </div>
                <div class="task-description">
                    Выбрать работника Петю.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">SELECT</span> * <span style="color: #50fa7b;">FROM</span> workers <span style="color: #50fa7b;">WHERE</span> name = 'Петя';</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">SELECT * FROM workers WHERE name = 'Петя';</span>
                    </div>
                </div>
            </div>

            <!-- Задача 11 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">11</span>
                    <span class="task-title">Выбрать Петю и Васю</span>
                </div>
                <div class="task-description">
                    Выбрать работников Петю и Васю.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">SELECT</span> * <span style="color: #50fa7b;">FROM</span> workers <span style="color: #50fa7b;">WHERE</span> name = 'Петя' <span style="color: #50fa7b;">OR</span> name = 'Вася';</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">SELECT * FROM workers WHERE name = 'Петя' OR name = 'Вася';</span>
                    </div>
                </div>
            </div>

            <!-- Задача 12 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">12</span>
                    <span class="task-title">Все, кроме Петя</span>
                </div>
                <div class="task-description">
                    Выбрать всех, кроме работника Петя.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">SELECT</span> * <span style="color: #50fa7b;">FROM</span> workers <span style="color: #50fa7b;">WHERE</span> name != 'Петя';</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">SELECT * FROM workers WHERE name != 'Петя';</span>
                    </div>
                </div>
            </div>

            <!-- Задача 13 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">13</span>
                    <span class="task-title">Возраст 27 или зарплата 1000$</span>
                </div>
                <div class="task-description">
                    Выбрать всех работников в возрасте 27 лет или с зарплатой 1000$.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">SELECT</span> * <span style="color: #50fa7b;">FROM</span> workers <span style="color: #50fa7b;">WHERE</span> age = 27 <span style="color: #50fa7b;">OR</span> salary = 1000;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">SELECT * FROM workers WHERE age = 27 OR salary = 1000;</span>
                    </div>
                </div>
            </div>

            <!-- Задача 14 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">14</span>
                    <span class="task-title">Сложное условие 1</span>
                </div>
                <div class="task-description">
                    Выбрать всех работников в возрасте от 23 лет (включительно) до 27 лет (не включительно) или с зарплатой 1000$.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">SELECT</span> * <span style="color: #50fa7b;">FROM</span> workers <span style="color: #50fa7b;">WHERE</span> (age >= 23 <span style="color: #50fa7b;">AND</span> age < 27) <span style="color: #50fa7b;">OR</span> salary = 1000;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">SELECT * FROM workers WHERE (age >= 23 AND age < 27) OR salary = 1000;</span>
                    </div>
                </div>
            </div>

            <!-- Задача 15 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">15</span>
                    <span class="task-title">Сложное условие 2</span>
                </div>
                <div class="task-description">
                    Выбрать всех работников в возрасте от 23 лет до 27 лет или с зарплатой от 400$ до 1000$.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">SELECT</span> * <span style="color: #50fa7b;">FROM</span> workers <span style="color: #50fa7b;">WHERE</span> (age >= 23 <span style="color: #50fa7b;">AND</span> age <= 27) <span style="color: #50fa7b;">OR</span> (salary >= 400 <span style="color: #50fa7b;">AND</span> salary <= 1000);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">SELECT * FROM workers WHERE (age >= 23 AND age <= 27) OR (salary >= 400 AND salary <= 1000);</span>
                    </div>
                </div>
            </div>

            <!-- Задача 16 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">16</span>
                    <span class="task-title">Сложное условие 3</span>
                </div>
                <div class="task-description">
                    Выбрать всех работников в возрасте 27 лет или с зарплатой не равной 400$.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">SELECT</span> * <span style="color: #50fa7b;">FROM</span> workers <span style="color: #50fa7b;">WHERE</span> age = 27 <span style="color: #50fa7b;">OR</span> salary != 400;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">SELECT * FROM workers WHERE age = 27 OR salary != 400;</span>
                    </div>
                </div>
            </div>

            <!-- INSERT -->
            <div class="section-title">➕ INSERT (Добавление данных)</div>

            <!-- Задача 17 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">17</span>
                    <span class="task-title">Добавить Никиту (синтаксис 1)</span>
                </div>
                <div class="task-description">
                    Добавьте нового работника Никиту, 26 лет, зарплата 300$. Воспользуйтесь первым синтаксисом.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">INSERT INTO</span> workers <span style="color: #50fa7b;">SET</span> name='Никита', age=26, salary=300;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">INSERT INTO workers SET name='Никита', age=26, salary=300;</span>
                    </div>
                </div>
            </div>

            <!-- Задача 18 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">18</span>
                    <span class="task-title">Добавить Светлану (синтаксис 2)</span>
                </div>
                <div class="task-description">
                    Добавьте нового работника Светлану с зарплатой 1200$. Воспользуйтесь вторым синтаксисом.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">INSERT INTO</span> workers (name, salary) <span style="color: #50fa7b;">VALUES</span> ('Светлана', 1200);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">INSERT INTO workers (name, salary) VALUES ('Светлана', 1200);</span>
                    </div>
                </div>
            </div>

            <!-- Задача 19 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">19</span>
                    <span class="task-title">Добавить двух работников</span>
                </div>
                <div class="task-description">
                    Добавьте двух новых работников одним запросом: Ярослава (1200$, 30 лет) и Петра (1000$, 31 год).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">INSERT INTO</span> workers (name, age, salary) <span style="color: #50fa7b;">VALUES</span> ('Ярослав', 30, 1200), ('Петр', 31, 1000);</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">INSERT INTO workers (name, age, salary) VALUES ('Ярослав', 30, 1200), ('Петр', 31, 1000);</span>
                    </div>
                </div>
            </div>

            <!-- DELETE -->
            <div class="section-title">🗑️ DELETE (Удаление данных)</div>

            <!-- Задача 20 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">20</span>
                    <span class="task-title">Удалить работника с id=7</span>
                </div>
                <div class="task-description">
                    Удалите работника с id=7.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">DELETE FROM</span> workers <span style="color: #50fa7b;">WHERE</span> id = 7;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">DELETE FROM workers WHERE id = 7;</span>
                    </div>
                </div>
            </div>

            <!-- Задача 21 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">21</span>
                    <span class="task-title">Удалить Колю</span>
                </div>
                <div class="task-description">
                    Удалите Колю.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">DELETE FROM</span> workers <span style="color: #50fa7b;">WHERE</span> name = 'Коля';</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">DELETE FROM workers WHERE name = 'Коля';</span>
                    </div>
                </div>
            </div>

            <!-- Задача 22 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">22</span>
                    <span class="task-title">Удалить всех с возрастом 23 года</span>
                </div>
                <div class="task-description">
                    Удалите всех работников, у которых возраст 23 года.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">DELETE FROM</span> workers <span style="color: #50fa7b;">WHERE</span> age = 23;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">DELETE FROM workers WHERE age = 23;</span>
                    </div>
                </div>
            </div>

            <!-- UPDATE -->
            <div class="section-title">✏️ UPDATE (Обновление данных)</div>

            <!-- Задача 23 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">23</span>
                    <span class="task-title">Васе зарплату 200$</span>
                </div>
                <div class="task-description">
                    Поставьте Васе зарплату в 200$.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">UPDATE</span> workers <span style="color: #50fa7b;">SET</span> salary = 200 <span style="color: #50fa7b;">WHERE</span> name = 'Вася';</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">UPDATE workers SET salary = 200 WHERE name = 'Вася';</span>
                    </div>
                </div>
            </div>

            <!-- Задача 24 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">24</span>
                    <span class="task-title">Работнику id=4 возраст 35 лет</span>
                </div>
                <div class="task-description">
                    Работнику с id=4 поставьте возраст 35 лет.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">UPDATE</span> workers <span style="color: #50fa7b;">SET</span> age = 35 <span style="color: #50fa7b;">WHERE</span> id = 4;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">UPDATE workers SET age = 35 WHERE id = 4;</span>
                    </div>
                </div>
            </div>

            <!-- Задача 25 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">25</span>
                    <span class="task-title">Зарплату 500$ сделать 700$</span>
                </div>
                <div class="task-description">
                    Всем, у кого зарплата 500$ сделайте ее 700$.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">UPDATE</span> workers <span style="color: #50fa7b;">SET</span> salary = 700 <span style="color: #50fa7b;">WHERE</span> salary = 500;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">UPDATE workers SET salary = 700 WHERE salary = 500;</span>
                    </div>
                </div>
            </div>

            <!-- Задача 26 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">26</span>
                    <span class="task-title">Работникам с id от 2 до 5 возраст 23</span>
                </div>
                <div class="task-description">
                    Работникам с id больше 2 и меньше 5 включительно поставьте возраст 23.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">UPDATE</span> workers <span style="color: #50fa7b;">SET</span> age = 23 <span style="color: #50fa7b;">WHERE</span> id > 2 <span style="color: #50fa7b;">AND</span> id <= 5;</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">UPDATE workers SET age = 23 WHERE id > 2 AND id <= 5;</span>
                    </div>
                </div>
            </div>

            <!-- Задача 27 -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">27</span>
                    <span class="task-title">Васю на Женю + зарплата 900$</span>
                </div>
                <div class="task-description">
                    Поменяйте Васю на Женю и прибавьте ему зарплату до 900$.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #50fa7b;">UPDATE</span> workers <span style="color: #50fa7b;">SET</span> name = 'Женя', salary = 900 <span style="color: #50fa7b;">WHERE</span> name = 'Вася';</pre>
                </div>
                <div class="task-result">
                    <div class="result-item">
                        <span class="result-label">SQL запрос</span>
                        <span class="result-content">UPDATE workers SET name = 'Женя', salary = 900 WHERE name = 'Вася';</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>