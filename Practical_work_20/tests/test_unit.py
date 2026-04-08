import pytest
from src.library import Library

@pytest.mark.unit
@pytest.mark.smoke
def test_initial_state(library):
    """Проверка начального состояния библиотеки (smoke)."""
    assert library.get_available_count() == 3
    assert library.get_issued_count() == 0

@pytest.mark.unit
def test_get_book_info_existing(library):
    """Информация о существующей книге."""
    info = library.get_book_info("1984")
    assert info["author"] == "George Orwell"
    assert info["available"] is True

@pytest.mark.unit
def test_get_book_info_nonexistent(library):
    """Информация о несуществующей книге возвращает None."""
    assert library.get_book_info("Unknown") is None

@pytest.mark.unit
@pytest.mark.parametrize("title,author,expected_count,should_raise", [
    ("New Book", "Author", 4, False),
    ("", "Author", None, True),
    ("NoAuthor", "", None, True),
    ("1984", "Duplicate", None, True),
])
def test_add_book_param(library, title, author, expected_count, should_raise):
    """Параметризованный тест добавления книги (корректные и некорректные данные)."""
    if should_raise:
        with pytest.raises(ValueError):
            library.add_book(title, author)
    else:
        library.add_book(title, author)
        assert library.get_available_count() == expected_count

@pytest.mark.unit
@pytest.mark.critical
def test_issue_and_return_cycle(library):
    """Критический тест: выдача и возврат книги изменяют счётчики."""
    initial_available = library.get_available_count()
    library.issue_book("1984")
    assert library.get_available_count() == initial_available - 1
    assert library.get_issued_count() == 1
    library.return_book("1984")
    assert library.get_available_count() == initial_available
    assert library.get_issued_count() == 0