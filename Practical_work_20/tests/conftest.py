import pytest
from src.library import Library

@pytest.fixture
def library():
    """Фикстура с yield, создаёт библиотеку с тремя книгами."""
    lib = Library()
    yield lib
    print("\n[TEARDOWN] library fixture finished")

@pytest.fixture
def empty_library():
    """Пустая библиотека."""
    return Library()

@pytest.fixture(scope="module")
def library_readonly():
    """Библиотека с областью module, не изменяется."""
    return Library()

@pytest.fixture(autouse=True)
def log_tests(request):
    """Автоматический логгер начала и конца теста."""
    print(f"\n[SETUP] Starting test: {request.node.name}")
    yield
    print(f"[TEARDOWN] Finished test: {request.node.name}")