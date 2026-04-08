import pytest
import time
import os

@pytest.mark.api
@pytest.mark.slow
def test_api_with_delay(library):
    """Тест с имитацией задержки API-запроса."""
    time.sleep(2)
    # Представим, что это ответ от внешнего API
    info = library.get_book_info("1984")
    assert info["author"] == "George Orwell"

@pytest.mark.api
@pytest.mark.slow
@pytest.mark.xfail(reason="Ожидаемый сбой при добавлении дубликата через API")
def test_api_add_duplicate_xfail(library):
    """Ожидаемо падающий тест (xfail) из-за дубликата."""
    # API должен вернуть ошибку, но мы намеренно не обрабатываем
    library.add_book("1984", "Duplicate via API")
    # Тест упадёт, но pytest пометит его как xfail

@pytest.mark.api
@pytest.mark.slow
@pytest.mark.skipif(os.getenv("CI") == "true", reason="Только локально")
def test_local_only_api(library):
    """Тест выполняется только локально, пропускается в CI."""
    # Например, обращение к локальному сервису
    assert library.get_available_count() > 0

@pytest.mark.api
@pytest.mark.slow
def test_api_issue_multiple(library):
    """Имитация массовой выдачи через API."""
    for title in ["1984", "Brave New World"]:
        library.issue_book(title)
    assert library.get_issued_count() == 2