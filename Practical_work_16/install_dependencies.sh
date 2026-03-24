#!/bin/bash
# Скрипт для установки всех зависимостей

echo "Установка Python зависимостей..."
pip install -r requirements.txt

# Установка Chrome WebDriver для Selenium (опционально)
if command -v chromedriver &> /dev/null; then
    echo "ChromeDriver уже установлен"
else
    echo "Установка ChromeDriver..."
    if [[ "$OSTYPE" == "linux-gnu"* ]]; then
        sudo apt-get install chromium-chromedriver
    elif [[ "$OSTYPE" == "darwin"* ]]; then
        brew install chromedriver
    fi
fi

# Установка Allure (опционально)
if command -v allure &> /dev/null; then
    echo "Allure уже установлен"
else
    echo "Для установки Allure выполните:"
    echo "  macOS: brew install allure"
    echo "  Linux: sudo apt-add-repository ppa:qameta/allure"
    echo "         sudo apt-get update"
    echo "         sudo apt-get install allure"
fi

echo "Установка завершена!"