<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Практическая работа №24-26: Файловый ввод-вывод в PHP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #2c3e50 0%, #27ae60 100%);
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
            background: linear-gradient(135deg, #ffffff 0%, #d5f4e6 100%);
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

        .theory-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .theory-section h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 1.8rem;
            border-bottom: 2px solid #27ae60;
            padding-bottom: 10px;
        }

        .theory-section h3 {
            color: #2c3e50;
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

        .tasks-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(600px, 1fr));
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
            background: linear-gradient(135deg, #2c3e50 0%, #27ae60 100%);
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
            box-shadow: 0 4px 10px rgba(39, 174, 96, 0.3);
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
            border-left: 4px solid #27ae60;
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
            max-height: 500px;
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
        }

        .vote-form {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin: 10px 0;
        }

        .vote-option {
            margin: 10px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .vote-option input {
            margin-right: 10px;
        }

        .vote-option label {
            font-size: 1rem;
            cursor: pointer;
        }

        .btn {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
            width: 100%;
            margin-top: 15px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(39, 174, 96, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #c0392b 0%, #e74c3c 100%);
        }

        .btn-danger:hover {
            box-shadow: 0 4px 12px rgba(192, 57, 43, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f39c12 0%, #f1c40f 100%);
        }

        .btn-warning:hover {
            box-shadow: 0 4px 12px rgba(243, 156, 18, 0.4);
        }

        .btn-info {
            background: linear-gradient(135deg, #3498db 0%, #5dade2 100%);
        }

        .result-chart {
            margin-top: 15px;
        }

        .chart-bar {
            display: flex;
            align-items: center;
            margin: 10px 0;
            gap: 10px;
        }

        .chart-label {
            width: 100px;
            font-weight: 600;
        }

        .chart-bar-line {
            flex: 1;
            height: 25px;
            background: linear-gradient(90deg, #27ae60, #2ecc71);
            border-radius: 12px;
            transition: width 0.3s ease;
        }

        .chart-value {
            width: 60px;
            text-align: right;
            font-weight: 600;
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

        .file-list {
            list-style: none;
            padding: 0;
        }

        .file-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #e9ecef;
        }

        .file-list li:last-child {
            border-bottom: none;
        }

        .delete-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.8rem;
        }

        .delete-btn:hover {
            background: #c0392b;
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
            
            .chart-label {
                width: 80px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Практическая работа №24-26</h1>
            <p>Организация файлового ввода-вывода в PHP</p>
        </div>

        <!-- ТЕОРЕТИЧЕСКИЕ СВЕДЕНИЯ -->
        <div class="theory-section">
            <h2>📚 Теоретические сведения</h2>
            
            <h3>Основные функции для работы с файлами в PHP</h3>
            <ul>
                <li><strong>fopen()</strong> - открывает файл или URL</li>
                <li><strong>fread()</strong> - читает содержимое файла</li>
                <li><strong>fwrite()</strong> - записывает данные в файл</li>
                <li><strong>fclose()</strong> - закрывает открытый файл</li>
                <li><strong>file_get_contents()</strong> - читает содержимое файла в строку</li>
                <li><strong>file_put_contents()</strong> - записывает данные в файл</li>
                <li><strong>file_exists()</strong> - проверяет существование файла</li>
                <li><strong>unlink()</strong> - удаляет файл</li>
            </ul>

            <h3>Режимы открытия файлов</h3>
            <ul>
                <li><strong>"r"</strong> - чтение (указатель в начале)</li>
                <li><strong>"w"</strong> - запись (создает новый или очищает существующий)</li>
                <li><strong>"a"</strong> - запись в конец файла (добавление)</li>
                <li><strong>"r+"</strong> - чтение и запись (указатель в начале)</li>
                <li><strong>"w+"</strong> - чтение и запись (создает новый или очищает)</li>
            </ul>

            <div class="code-example">
                <pre><span style="color: #6272a4;">// Пример чтения из файла</span>
<span style="color: #ffb86c;">$file</span> = <span style="color: #50fa7b;">fopen</span>(<span style="color: #f1fa8c;">"data.txt"</span>, <span style="color: #f1fa8c;">"r"</span>);
<span style="color: #ffb86c;">$content</span> = <span style="color: #50fa7b;">fread</span>(<span style="color: #ffb86c;">$file</span>, <span style="color: #50fa7b;">filesize</span>(<span style="color: #f1fa8c;">"data.txt"</span>));
<span style="color: #50fa7b;">fclose</span>(<span style="color: #ffb86c;">$file</span>);

<span style="color: #6272a4;">// Пример записи в файл</span>
<span style="color: #ffb86c;">$file</span> = <span style="color: #50fa7b;">fopen</span>(<span style="color: #f1fa8c;">"data.txt"</span>, <span style="color: #f1fa8c;">"w"</span>);
<span style="color: #50fa7b;">fwrite</span>(<span style="color: #ffb86c;">$file</span>, <span style="color: #f1fa8c;">"Новая запись"</span>);
<span style="color: #50fa7b;">fclose</span>(<span style="color: #ffb86c;">$file</span>);</pre>
            </div>
        </div>

        <div class="tasks-grid">
            <!-- ЗАДАНИЕ 2: Голосование -->
            <?php
            // Директория для хранения файлов голосования
            $vote_dir = __DIR__ . '/votes/';
            
            // Создаем директорию если её нет
            if (!file_exists($vote_dir)) {
                mkdir($vote_dir, 0777, true);
            }
            
            // Инициализация файлов голосования
            $vote_files = ['5.txt', '4.txt', '3.txt', '2.txt'];
            foreach ($vote_files as $file) {
                $filepath = $vote_dir . $file;
                if (!file_exists($filepath)) {
                    file_put_contents($filepath, '0');
                }
            }
            
            // Обработка голосования
            $vote_message = '';
            if (isset($_POST['vote_submit'])) {
                $vote_value = $_POST['vote'] ?? '';
                if ($vote_value && in_array($vote_value, [2, 3, 4, 5])) {
                    $filepath = $vote_dir . $vote_value . '.txt';
                    $current_votes = (int)file_get_contents($filepath);
                    $current_votes++;
                    file_put_contents($filepath, $current_votes);
                    $vote_message = "Спасибо за ваш голос! Вы оценили магазин на {$vote_value} баллов.";
                } else {
                    $vote_message = "Пожалуйста, выберите оценку.";
                }
            }
            
            // Чтение результатов голосования
            $results = [];
            $labels = [
                5 => 'Отлично',
                4 => 'Хорошо',
                3 => 'Удовлетворительно',
                2 => 'Плохо'
            ];
            $max_votes = 0;
            
            foreach ($vote_files as $file) {
                $vote_num = (int)basename($file, '.txt');
                $filepath = $vote_dir . $file;
                $count = (int)file_get_contents($filepath);
                $results[$vote_num] = $count;
                if ($count > $max_votes) {
                    $max_votes = $count;
                }
            }
            
            // Масштабирование для диаграммы (максимум 40 символов)
            $scale = $max_votes > 0 ? 40 / $max_votes : 1;
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2</span>
                    <span class="task-title">Голосование "Оценка магазина"</span>
                </div>
                <div class="task-description">
                    Создайте форму для голосования с вопросом "Как вы оцениваете наш магазин?" и вариантами ответов в виде radio-button.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$vote_dir</span> = <span style="color: #f1fa8c;">'votes/'</span>;
<span style="color: #ffb86c;">$vote_files</span> = [<span style="color: #f1fa8c;">'5.txt'</span>, <span style="color: #f1fa8c;">'4.txt'</span>, <span style="color: #f1fa8c;">'3.txt'</span>, <span style="color: #f1fa8c;">'2.txt'</span>];

<span style="color: #6272a4;">// Инициализация файлов с нулем</span>
<span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$vote_files</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$file</span>) {
    <span style="color: #50fa7b;">if</span> (!<span style="color: #50fa7b;">file_exists</span>(<span style="color: #ffb86c;">$vote_dir</span> . <span style="color: #ffb86c;">$file</span>)) {
        <span style="color: #50fa7b;">file_put_contents</span>(<span style="color: #ffb86c;">$vote_dir</span> . <span style="color: #ffb86c;">$file</span>, <span style="color: #f1fa8c;">'0'</span>);
    }
}

<span style="color: #6272a4;">// Обработка голосования</span>
<span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">isset</span>(<span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'vote_submit'</span>])) {
    <span style="color: #ffb86c;">$vote_value</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'vote'</span>] ?? <span style="color: #f1fa8c;">''</span>;
    <span style="color: #ffb86c;">$filepath</span> = <span style="color: #ffb86c;">$vote_dir</span> . <span style="color: #ffb86c;">$vote_value</span> . <span style="color: #f1fa8c;">'.txt'</span>;
    <span style="color: #ffb86c;">$votes</span> = (<span style="color: #50fa7b;">int</span>)<span style="color: #50fa7b;">file_get_contents</span>(<span style="color: #ffb86c;">$filepath</span>);
    <span style="color: #ffb86c;">$votes</span>++;
    <span style="color: #50fa7b;">file_put_contents</span>(<span style="color: #ffb86c;">$filepath</span>, <span style="color: #ffb86c;">$votes</span>);
}</pre>
                </div>
                <div class="task-result">
                    <div class="vote-form">
                        <form method="POST">
                            <p><strong>Как вы оцениваете наш магазин?</strong></p>
                            <div class="vote-option">
                                <input type="radio" name="vote" value="5" id="vote5" checked>
                                <label for="vote5">⭐ Отлично (5)</label>
                            </div>
                            <div class="vote-option">
                                <input type="radio" name="vote" value="4" id="vote4">
                                <label for="vote4">👍 Хорошо (4)</label>
                            </div>
                            <div class="vote-option">
                                <input type="radio" name="vote" value="3" id="vote3">
                                <label for="vote3">👌 Удовлетворительно (3)</label>
                            </div>
                            <div class="vote-option">
                                <input type="radio" name="vote" value="2" id="vote2">
                                <label for="vote2">👎 Плохо (2)</label>
                            </div>
                            <button type="submit" name="vote_submit" class="btn">Проголосовать</button>
                        </form>
                        <?php if ($vote_message): ?>
                            <div class="alert alert-success" style="margin-top: 15px;">
                                <?php echo $vote_message; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div style="margin-top: 20px;">
                        <h3>📊 Результаты голосования</h3>
                        <div class="result-chart">
                            <?php foreach ($results as $rating => $count): ?>
                            <div class="chart-bar">
                                <div class="chart-label"><?php echo $labels[$rating]; ?> (<?php echo $rating; ?>)</div>
                                <div class="chart-bar-line" style="width: <?php echo $count * $scale; ?>px;"></div>
                                <div class="chart-value"><?php echo $count; ?> чел.</div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="alert alert-info" style="margin-top: 15px;">
                            📈 Максимальное количество голосов: <?php echo $max_votes; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Управление файлами голосования -->
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">2.1</span>
                    <span class="task-title">Управление файлами голосования</span>
                </div>
                <div class="task-description">
                    Создание и удаление файлов голосования. Инициализация счетчиков.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #6272a4;">// Создание файлов с нулевыми значениями</span>
<span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">initVoteFiles</span>() {
    <span style="color: #ffb86c;">$files</span> = [<span style="color: #f1fa8c;">'2.txt'</span>, <span style="color: #f1fa8c;">'3.txt'</span>, <span style="color: #f1fa8c;">'4.txt'</span>, <span style="color: #f1fa8c;">'5.txt'</span>];
    <span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$files</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$file</span>) {
        <span style="color: #50fa7b;">file_put_contents</span>(<span style="color: #ffb86c;">$file</span>, <span style="color: #f1fa8c;">'0'</span>);
    }
}

<span style="color: #6272a4;">// Удаление файлов голосования</span>
<span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">clearVoteFiles</span>() {
    <span style="color: #ffb86c;">$files</span> = [<span style="color: #f1fa8c;">'2.txt'</span>, <span style="color: #f1fa8c;">'3.txt'</span>, <span style="color: #f1fa8c;">'4.txt'</span>, <span style="color: #f1fa8c;">'5.txt'</span>];
    <span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$files</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$file</span>) {
        <span style="color: #50fa7b;">unlink</span>(<span style="color: #ffb86c;">$file</span>);
    }
}</pre>
                </div>
                <div class="task-result">
                    <div class="vote-form">
                        <?php
                        // Обработка инициализации
                        if (isset($_POST['init_files'])) {
                            foreach ($vote_files as $file) {
                                file_put_contents($vote_dir . $file, '0');
                            }
                            echo '<div class="alert alert-success">✅ Файлы голосования созданы и обнулены!</div>';
                        }
                        
                        // Обработка удаления
                        if (isset($_POST['clear_files'])) {
                            foreach ($vote_files as $file) {
                                $filepath = $vote_dir . $file;
                                if (file_exists($filepath)) {
                                    unlink($filepath);
                                }
                            }
                            echo '<div class="alert alert-success">🗑️ Файлы голосования удалены!</div>';
                        }
                        ?>
                        <form method="POST" style="display: inline-block; width: 48%; margin-right: 4%;">
                            <button type="submit" name="init_files" class="btn btn-info">Создать/обнулить файлы</button>
                        </form>
                        <form method="POST" style="display: inline-block; width: 48%;">
                            <button type="submit" name="clear_files" class="btn btn-danger">Удалить все файлы</button>
                        </form>
                        
                        <div style="margin-top: 20px;">
                            <h4>📁 Текущие файлы в папке votes:</h4>
                            <ul class="file-list">
                                <?php
                                $files = scandir($vote_dir);
                                foreach ($files as $file) {
                                    if ($file != '.' && $file != '..') {
                                        $filepath = $vote_dir . $file;
                                        $content = file_get_contents($filepath);
                                        echo "<li><strong>$file</strong> - $content голосов</li>";
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ЗАДАНИЕ 3: Телефонный справочник -->
            <?php
            $phonebook_file = __DIR__ . '/phonebook.txt';
            
            // Создание файла если его нет
            if (!file_exists($phonebook_file)) {
                file_put_contents($phonebook_file, "");
            }
            
            // Обработка добавления контакта
            $add_message = '';
            if (isset($_POST['add_contact'])) {
                $name = trim($_POST['name'] ?? '');
                $phone = trim($_POST['phone'] ?? '');
                
                if ($name && $phone) {
                    $existing = file_get_contents($phonebook_file);
                    $new_entry = $name . ':' . $phone . "\n";
                    file_put_contents($phonebook_file, $existing . $new_entry);
                    $add_message = "✅ Контакт '$name' добавлен!";
                } else {
                    $add_message = "❌ Заполните все поля!";
                }
            }
            
            // Обработка поиска
            $search_results = [];
            if (isset($_POST['search_contact'])) {
                $search_name = trim($_POST['search_name'] ?? '');
                if ($search_name) {
                    $lines = file($phonebook_file);
                    foreach ($lines as $line) {
                        list($name, $phone) = explode(':', trim($line), 2);
                        if (stripos($name, $search_name) !== false) {
                            $search_results[] = ['name' => $name, 'phone' => $phone];
                        }
                    }
                }
            }
            
            // Чтение всех контактов
            $all_contacts = [];
            if (file_exists($phonebook_file)) {
                $lines = file($phonebook_file);
                foreach ($lines as $line) {
                    $line = trim($line);
                    if ($line) {
                        $parts = explode(':', $line, 2);
                        if (count($parts) == 2) {
                            $all_contacts[] = ['name' => $parts[0], 'phone' => $parts[1]];
                        }
                    }
                }
            }
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">3</span>
                    <span class="task-title">Телефонный справочник</span>
                </div>
                <div class="task-description">
                    Приложение для работы с телефонным справочником. Сохранение нескольких номеров для одного абонента.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$phonebook_file</span> = <span style="color: #f1fa8c;">'phonebook.txt'</span>;

<span style="color: #6272a4;">// Добавление контакта</span>
<span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">addContact</span>(<span style="color: #ffb86c;">$name</span>, <span style="color: #ffb86c;">$phone</span>) {
    <span style="color: #ffb86c;">$entry</span> = <span style="color: #ffb86c;">$name</span> . <span style="color: #f1fa8c;">':'</span> . <span style="color: #ffb86c;">$phone</span> . <span style="color: #f1fa8c;">"\n"</span>;
    <span style="color: #50fa7b;">file_put_contents</span>(<span style="color: #ffb86c;">$GLOBALS</span>[<span style="color: #f1fa8c;">'phonebook_file'</span>], <span style="color: #ffb86c;">$entry</span>, FILE_APPEND);
}

<span style="color: #6272a4;">// Поиск контакта</span>
<span style="color: #50fa7b;">function</span> <span style="color: #ffb86c;">searchContact</span>(<span style="color: #ffb86c;">$name</span>) {
    <span style="color: #ffb86c;">$results</span> = [];
    <span style="color: #ffb86c;">$lines</span> = <span style="color: #50fa7b;">file</span>(<span style="color: #ffb86c;">$GLOBALS</span>[<span style="color: #f1fa8c;">'phonebook_file'</span>]);
    <span style="color: #50fa7b;">foreach</span> (<span style="color: #ffb86c;">$lines</span> <span style="color: #50fa7b;">as</span> <span style="color: #ffb86c;">$line</span>) {
        <span style="color: #50fa7b;">if</span> (<span style="color: #50fa7b;">stripos</span>(<span style="color: #ffb86c;">$line</span>, <span style="color: #ffb86c;">$name</span>) !== false) {
            <span style="color: #ffb86c;">$results</span>[] = <span style="color: #50fa7b;">trim</span>(<span style="color: #ffb86c;">$line</span>);
        }
    }
    <span style="color: #50fa7b;">return</span> <span style="color: #ffb86c;">$results</span>;
}</pre>
                </div>
                <div class="task-result">
                    <div class="vote-form">
                        <h3>➕ Добавить контакт</h3>
                        <form method="POST">
                            <div class="form-group">
                                <label>Имя:</label>
                                <input type="text" name="name" class="form-control" required style="width: 100%; padding: 8px; margin: 5px 0;">
                            </div>
                            <div class="form-group">
                                <label>Телефон:</label>
                                <input type="text" name="phone" class="form-control" required style="width: 100%; padding: 8px; margin: 5px 0;">
                            </div>
                            <button type="submit" name="add_contact" class="btn">Добавить</button>
                        </form>
                        <?php if ($add_message): ?>
                            <div class="alert alert-success" style="margin-top: 10px;"><?php echo $add_message; ?></div>
                        <?php endif; ?>
                        
                        <h3 style="margin-top: 20px;">🔍 Поиск контакта</h3>
                        <form method="POST">
                            <div class="form-group">
                                <label>Введите имя для поиска:</label>
                                <input type="text" name="search_name" class="form-control" style="width: 100%; padding: 8px; margin: 5px 0;">
                            </div>
                            <button type="submit" name="search_contact" class="btn btn-info">Найти</button>
                        </form>
                        
                        <?php if ($search_results): ?>
                            <div class="alert alert-info" style="margin-top: 10px;">
                                <strong>Результаты поиска:</strong><br>
                                <?php foreach ($search_results as $contact): ?>
                                    • <?php echo htmlspecialchars($contact['name']); ?>: <?php echo htmlspecialchars($contact['phone']); ?><br>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        
                        <h3 style="margin-top: 20px;">📞 Все контакты</h3>
                        <?php if ($all_contacts): ?>
                            <ul class="file-list">
                                <?php foreach ($all_contacts as $contact): ?>
                                    <li><strong><?php echo htmlspecialchars($contact['name']); ?></strong>: <?php echo htmlspecialchars($contact['phone']); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <div class="alert alert-info">Справочник пуст. Добавьте первый контакт!</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- ЗАДАНИЕ 4: Проверка доступности сервера -->
            <?php
            $server_status = '';
            $server_address = '';
            if (isset($_POST['check_server'])) {
                $server_address = trim($_POST['server_address'] ?? '');
                if ($server_address) {
                    $ch = curl_init($server_address);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_NOBODY, true);
                    curl_exec($ch);
                    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);
                    
                    if ($http_code > 0) {
                        $server_status = "✅ Сервер доступен (HTTP код: $http_code)";
                    } else {
                        $server_status = "❌ Сервер недоступен или не отвечает";
                    }
                } else {
                    $server_status = "❌ Введите адрес сервера";
                }
            }
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">4</span>
                    <span class="task-title">Проверка доступности сервера</span>
                </div>
                <div class="task-description">
                    Приложение для проверки доступности сервера, адрес которого введен пользователем.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$server</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'server_address'</span>] ?? <span style="color: #f1fa8c;">''</span>;
<span style="color: #ffb86c;">$ch</span> = <span style="color: #50fa7b;">curl_init</span>(<span style="color: #ffb86c;">$server</span>);
<span style="color: #50fa7b;">curl_setopt</span>(<span style="color: #ffb86c;">$ch</span>, CURLOPT_TIMEOUT, 5);
<span style="color: #50fa7b;">curl_setopt</span>(<span style="color: #ffb86c;">$ch</span>, CURLOPT_RETURNTRANSFER, true);
<span style="color: #50fa7b;">curl_setopt</span>(<span style="color: #ffb86c;">$ch</span>, CURLOPT_NOBODY, true);
<span style="color: #50fa7b;">curl_exec</span>(<span style="color: #ffb86c;">$ch</span>);
<span style="color: #ffb86c;">$http_code</span> = <span style="color: #50fa7b;">curl_getinfo</span>(<span style="color: #ffb86c;">$ch</span>, CURLINFO_HTTP_CODE);
<span style="color: #50fa7b;">curl_close</span>(<span style="color: #ffb86c;">$ch</span>);

<span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$http_code</span> > 0) {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Сервер доступен (HTTP код: $http_code)"</span>;
} <span style="color: #50fa7b;">else</span> {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Сервер недоступен"</span>;
}</pre>
                </div>
                <div class="task-result">
                    <div class="vote-form">
                        <form method="POST">
                            <div class="form-group">
                                <label>Введите адрес сервера (http:// или https://):</label>
                                <input type="text" name="server_address" class="form-control" value="https://google.com" style="width: 100%; padding: 8px; margin: 5px 0;">
                            </div>
                            <button type="submit" name="check_server" class="btn">Проверить доступность</button>
                        </form>
                        <?php if ($server_status): ?>
                            <div class="alert <?php echo strpos($server_status, '✅') !== false ? 'alert-success' : 'alert-error'; ?>" style="margin-top: 15px;">
                                <?php echo $server_status; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- ЗАДАНИЕ 5: Получение информации с удаленного сервера -->
            <?php
            $weather_data = '';
            $weather_error = '';
            if (isset($_POST['get_weather'])) {
                $city = trim($_POST['city'] ?? 'Moscow');
                $api_url = "https://wttr.in/{$city}?format=%l:+%c+%t+%w+%h";
                
                $ch = curl_init($api_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                $response = curl_exec($ch);
                $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
                
                if ($http_code == 200 && $response) {
                    $weather_data = $response;
                } else {
                    $weather_error = "Не удалось получить данные о погоде. Попробуйте позже.";
                }
            }
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">5</span>
                    <span class="task-title">Прогноз погоды</span>
                </div>
                <div class="task-description">
                    Приложение для получения и отображения информации, полученной с удаленного сервера (прогноз погоды).
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$city</span> = <span style="color: #ffb86c;">$_POST</span>[<span style="color: #f1fa8c;">'city'</span>] ?? <span style="color: #f1fa8c;">'Moscow'</span>;
<span style="color: #ffb86c;">$api_url</span> = <span style="color: #f1fa8c;">"https://wttr.in/{$city}?format=%l:+%c+%t+%w+%h"</span>;

<span style="color: #ffb86c;">$ch</span> = <span style="color: #50fa7b;">curl_init</span>(<span style="color: #ffb86c;">$api_url</span>);
<span style="color: #50fa7b;">curl_setopt</span>(<span style="color: #ffb86c;">$ch</span>, CURLOPT_RETURNTRANSFER, true);
<span style="color: #ffb86c;">$response</span> = <span style="color: #50fa7b;">curl_exec</span>(<span style="color: #ffb86c;">$ch</span>);
<span style="color: #50fa7b;">curl_close</span>(<span style="color: #ffb86c;">$ch</span>);

<span style="color: #50fa7b;">echo</span> <span style="color: #ffb86c;">$response</span>;</pre>
                </div>
                <div class="task-result">
                    <div class="vote-form">
                        <form method="POST">
                            <div class="form-group">
                                <label>Введите город (на английском):</label>
                                <input type="text" name="city" class="form-control" value="Moscow" style="width: 100%; padding: 8px; margin: 5px 0;">
                            </div>
                            <button type="submit" name="get_weather" class="btn btn-info">Получить погоду</button>
                        </form>
                        <?php if ($weather_data): ?>
                            <div class="alert alert-info" style="margin-top: 15px; font-family: monospace;">
                                <?php echo nl2br(htmlspecialchars($weather_data)); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($weather_error): ?>
                            <div class="alert alert-error" style="margin-top: 15px;">
                                <?php echo $weather_error; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- ЗАДАНИЕ 6: Файлообменник -->
            <?php
            $upload_dir = __DIR__ . '/uploads/';
            $max_total_size = 50 * 1024 * 1024; // 50 MB общий лимит
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf', 'text/plain', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            
            // Создаем директорию если её нет
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            // Функция для расчета общего размера файлов
            function getTotalUploadSize($dir) {
                $total = 0;
                $files = scandir($dir);
                foreach ($files as $file) {
                    if ($file != '.' && $file != '..') {
                        $total += filesize($dir . $file);
                    }
                }
                return $total;
            }
            
            // Обработка загрузки файла
            $upload_message = '';
            if (isset($_POST['upload_file'])) {
                $total_size = getTotalUploadSize($upload_dir);
                
                if ($total_size >= $max_total_size) {
                    $upload_message = "❌ Достигнут общий лимит хранения файлов (50 MB)";
                } elseif (isset($_FILES['user_file']) && $_FILES['user_file']['error'] == 0) {
                    $file = $_FILES['user_file'];
                    $file_type = $file['type'];
                    $file_size = $file['size'];
                    $file_name = basename($file['name']);
                    $file_path = $upload_dir . $file_name;
                    
                    if (!in_array($file_type, $allowed_types)) {
                        $upload_message = "❌ Тип файла не разрешен. Разрешены: изображения, PDF, TXT, DOC, DOCX";
                    } elseif ($total_size + $file_size > $max_total_size) {
                        $upload_message = "❌ Загрузка этого файла превысит общий лимит хранения";
                    } elseif (move_uploaded_file($file['tmp_name'], $file_path)) {
                        $upload_message = "✅ Файл '$file_name' успешно загружен!";
                    } else {
                        $upload_message = "❌ Ошибка при загрузке файла";
                    }
                } else {
                    $upload_message = "❌ Выберите файл для загрузки";
                }
            }
            
            // Обработка удаления файла
            if (isset($_POST['delete_file'])) {
                $file_to_delete = basename($_POST['delete_file']);
                $file_path = $upload_dir . $file_to_delete;
                if (file_exists($file_path)) {
                    unlink($file_path);
                    $upload_message = "🗑️ Файл '$file_to_delete' удален";
                }
            }
            
            // Получение списка файлов
            $uploaded_files = [];
            if (file_exists($upload_dir)) {
                $files = scandir($upload_dir);
                foreach ($files as $file) {
                    if ($file != '.' && $file != '..') {
                        $file_path = $upload_dir . $file;
                        $uploaded_files[] = [
                            'name' => $file,
                            'size' => filesize($file_path),
                            'modified' => date('d.m.Y H:i:s', filemtime($file_path))
                        ];
                    }
                }
            }
            
            $total_used = getTotalUploadSize($upload_dir);
            $total_percent = ($total_used / $max_total_size) * 100;
            ?>
            
            <div class="task-card">
                <div class="task-header">
                    <span class="task-number">6</span>
                    <span class="task-title">Файлообменник</span>
                </div>
                <div class="task-description">
                    Приложение-файлообменник с ограничением общего дискового лимита и списком разрешенных типов файлов.
                </div>
                <div class="task-solution">
                    <pre><span style="color: #ffb86c;">$upload_dir</span> = <span style="color: #f1fa8c;">'uploads/'</span>;
<span style="color: #ffb86c;">$max_total_size</span> = 50 * 1024 * 1024; <span style="color: #6272a4;">// 50 MB</span>
<span style="color: #ffb86c;">$allowed_types</span> = [<span style="color: #f1fa8c;">'image/jpeg'</span>, <span style="color: #f1fa8c;">'image/png'</span>, <span style="color: #f1fa8c;">'application/pdf'</span>];

<span style="color: #6272a4;">// Проверка общего лимита</span>
<span style="color: #ffb86c;">$total_size</span> = <span style="color: #50fa7b;">getTotalUploadSize</span>(<span style="color: #ffb86c;">$upload_dir</span>);
<span style="color: #50fa7b;">if</span> (<span style="color: #ffb86c;">$total_size</span> + <span style="color: #ffb86c;">$file_size</span> > <span style="color: #ffb86c;">$max_total_size</span>) {
    <span style="color: #50fa7b;">echo</span> <span style="color: #f1fa8c;">"Превышен лимит"</span>;
}</pre>
                </div>
                <div class="task-result">
                    <div class="vote-form">
                        <div class="alert alert-info">
                            <strong>📊 Использование дискового пространства:</strong><br>
                            Использовано: <?php echo round($total_used / 1024 / 1024, 2); ?> MB из <?php echo $max_total_size / 1024 / 1024; ?> MB<br>
                            <div class="chart-bar" style="margin-top: 5px;">
                                <div class="chart-bar-line" style="width: <?php echo $total_percent; ?>%; background: linear-gradient(90deg, #3498db, #5dade2);"></div>
                                <div class="chart-value"><?php echo round($total_percent, 1); ?>%</div>
                            </div>
                        </div>
                        
                        <h3>📤 Загрузить файл</h3>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Выберите файл:</label>
                                <input type="file" name="user_file" class="form-control" style="width: 100%; padding: 8px; margin: 5px 0;">
                                <small>Разрешены: изображения (JPG, PNG, GIF), PDF, TXT, DOC, DOCX</small>
                            </div>
                            <button type="submit" name="upload_file" class="btn">Загрузить</button>
                        </form>
                        <?php if ($upload_message): ?>
                            <div class="alert <?php echo strpos($upload_message, '✅') !== false || strpos($upload_message, '🗑️') !== false ? 'alert-success' : 'alert-error'; ?>" style="margin-top: 10px;">
                                <?php echo $upload_message; ?>
                            </div>
                        <?php endif; ?>
                        
                        <h3 style="margin-top: 20px;">📁 Загруженные файлы</h3>
                        <?php if ($uploaded_files): ?>
                            <ul class="file-list">
                                <?php foreach ($uploaded_files as $file): ?>
                                    <li>
                                        <div>
                                            <strong><?php echo htmlspecialchars($file['name']); ?></strong><br>
                                            <small>Размер: <?php echo round($file['size'] / 1024, 2); ?> KB | Дата: <?php echo $file['modified']; ?></small>
                                        </div>
                                        <form method="POST" style="margin: 0;">
                                            <input type="hidden" name="delete_file" value="<?php echo htmlspecialchars($file['name']); ?>">
                                            <button type="submit" class="delete-btn">Удалить</button>
                                        </form>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <div class="alert alert-info">Файлов пока нет. Загрузите первый файл!</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>