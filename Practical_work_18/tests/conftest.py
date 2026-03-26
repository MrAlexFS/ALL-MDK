import pytest
from src.grade_calculator import GradeCalculator


@pytest.fixture
def calculator():
    """Фикстура, возвращающая экземпляр калькулятора."""
    return GradeCalculator()


@pytest.fixture
def grades_factory():
    """
    Фабрика для быстрого создания списков оценок.
    """
    def _make_grades(*values):
        return list(values)
    return _make_grades


@pytest.fixture
def student_data_factory():
    """
    Фабрика для создания данных студента: имя, оценки, веса.
    """
    def _make_student(name: str, scores: list, weights: list = None):
        if weights is None:
            # по умолчанию равные веса
            weights = [1.0 / len(scores)] * len(scores)
        return {
            'name': name,
            'scores': scores,
            'weights': weights
        }
    return _make_student