import pytest
from src.library import Library

# ----------------------------------------------------------------------
# Задание 1: @pytest.mark.parametrize
# ----------------------------------------------------------------------

# 1.1. Параметризованный тест для add_book (корректные данные)
@pytest.mark.parametrize("title, author", [
    ("Книга А", "Автор А"),
    ("Книга Б", "Автор Б"),
    ("Книга В", "Автор В"),
    ("Книга Г", "Автор Г"),
])
def test_add_book_valid(empty_library, title, author):
    # Arrange
    # Act
    empty_library.add_book(title, author)
    # Assert
    info = empty_library.get_book_info(title)
    assert info is not None
    assert info['author'] == author
    assert info['available'] is True

# 1.2. Параметризованный тест для add_book (невалидные случаи)
@pytest.mark.parametrize("title, author, duplicate_title", [
    ("Книга Д", "Автор Д", "Книга Д"),   # дубликат
    ("Книга Е", "Автор Е", "Книга Е"),
    ("Книга Ж", "Автор Ж", "Книга Ж"),
    ("Книга З", "Автор З", "Книга З"),
])
def test_add_book_invalid(empty_library, title, author, duplicate_title):
    # Сначала добавляем книгу
    empty_library.add_book(title, author)
    # Пытаемся добавить дубликат
    with pytest.raises(ValueError, match=f"Книга '{duplicate_title}' уже есть"):
        empty_library.add_book(duplicate_title, author)

# 1.3. Параметризованный тест для get_available_count (разные состояния)
@pytest.mark.parametrize("actions, expected_count", [
    ([], 0),                                          # пустая
    ([("add", "Кн1", "Ав1")], 1),                     # одна доступная
    ([("add", "Кн2", "Ав2"), ("add", "Кн3", "Ав3")], 2),
    ([("add", "Кн4", "Ав4"), ("issue", "Кн4")], 0),   # добавили и выдали
])
def test_get_available_count(empty_library, actions, expected_count):
    for action, *args in actions:
        if action == "add":
            empty_library.add_book(args[0], args[1])
        elif action == "issue":
            empty_library.issue_book(args[0])
    assert empty_library.get_available_count() == expected_count

# ----------------------------------------------------------------------
# Задание 2: scope (function vs module)
# ----------------------------------------------------------------------

def test_readonly_books_count_1(library_readonly):
    print(f"ID library_readonly: {id(library_readonly)}")
    assert library_readonly.get_available_count() == 5

def test_readonly_books_count_2(library_readonly):
    print(f"ID library_readonly: {id(library_readonly)}")
    assert library_readonly.get_available_count() == 5
    # ID должен быть одинаковым, т.к. scope=module

def test_empty_library_id_1(empty_library):
    print(f"ID empty_library: {id(empty_library)}")
    assert empty_library.get_available_count() == 0

def test_empty_library_id_2(empty_library):
    print(f"ID empty_library: {id(empty_library)}")
    assert empty_library.get_available_count() == 0
    # ID должен быть разным, т.к. scope=function

# ----------------------------------------------------------------------
# Задание 3: yield фикстура (library)
# ----------------------------------------------------------------------

def test_issue_book_reduces_available(library):
    # В библиотеке изначально 3 доступные книги
    assert library.get_available_count() == 3
    assert library.get_issued_count() == 0

    library.issue_book("1984")
    assert library.get_available_count() == 2
    assert library.get_issued_count() == 1

    library.issue_book("Война и мир")
    assert library.get_available_count() == 1
    assert library.get_issued_count() == 2

def test_return_book_increases_available(library):
    library.issue_book("Гарри Поттер и отсутствие Фролова")
    assert library.get_available_count() == 2
    assert library.get_issued_count() == 1

    library.return_book("Гарри Поттер и отсутствие Фролова")
    assert library.get_available_count() == 3
    assert library.get_issued_count() == 0

def test_state_preserved_between_tests(library):
    # Проверяем, что фикстура создаётся заново для каждого теста
    # В этом тесте библиотека снова 3 доступные книги
    assert library.get_available_count() == 3
    assert library.get_issued_count() == 0