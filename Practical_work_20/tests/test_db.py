import pytest

@pytest.mark.db
@pytest.mark.slow
def test_issue_return_loop(library):
    """Цикл выдача → возврат для всех книг (имитация работы с БД)."""
    books = ["1984", "Brave New World", "Fahrenheit 451"]
    for title in books:
        library.issue_book(title)
        assert library.get_book_info(title)["available"] is False
    for title in books:
        library.return_book(title)
        assert library.get_book_info(title)["available"] is True
    assert library.get_available_count() == 3

@pytest.mark.db
@pytest.mark.slow
@pytest.mark.skip(reason="Тест временно отключён для демонстрации skip")
def test_skipped_db_operation(library):
    """Этот тест всегда пропускается."""
    # Не выполняется
    pass

@pytest.mark.db
@pytest.mark.slow
def test_count_consistency_after_operations(library):
    """Проверка согласованности счётчиков после множества операций."""
    for _ in range(3):
        library.issue_book("1984")
        library.return_book("1984")
    assert library.get_available_count() == 3
    assert library.get_issued_count() == 0