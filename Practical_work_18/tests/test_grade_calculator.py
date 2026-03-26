"""
Тесты для класса GradeCalculator
"""

import pytest
from src.grade_calculator import GradeCalculator


# ==================== Тесты для calculate_grade ====================

def test_calculate_grade_95_returns_A(calculator):
    # Arrange
    score = 95

    # Act
    result = calculator.calculate_grade(score)

    # Assert
    assert result == "A"


def test_calculate_grade_85_returns_B(calculator):
    assert calculator.calculate_grade(85) == "B"


def test_calculate_grade_75_returns_C(calculator):
    assert calculator.calculate_grade(75) == "C"


def test_calculate_grade_65_returns_D(calculator):
    assert calculator.calculate_grade(65) == "D"


def test_calculate_grade_50_returns_F(calculator):
    assert calculator.calculate_grade(50) == "F"


def test_calculate_grade_100_returns_A_boundary(calculator):
    # граничное значение
    assert calculator.calculate_grade(100) == "A"


def test_calculate_grade_0_returns_F_boundary(calculator):
    assert calculator.calculate_grade(0) == "F"


def test_calculate_grade_89_returns_B(calculator):
    assert calculator.calculate_grade(89) == "B"


def test_calculate_grade_90_returns_A(calculator):
    assert calculator.calculate_grade(90) == "A"


def test_calculate_grade_negative_raises_value_error(calculator):
    with pytest.raises(ValueError) as exc_info:
        calculator.calculate_grade(-10)
    assert "диапазоне" in str(exc_info.value).lower() or "0 до 100" in str(exc_info.value)


def test_calculate_grade_above_100_raises_value_error(calculator):
    with pytest.raises(ValueError):
        calculator.calculate_grade(150)


def test_calculate_grade_string_raises_type_error(calculator):
    with pytest.raises(TypeError):
        calculator.calculate_grade("не число")


# ==================== Тесты для calculate_average ====================

def test_calculate_average_positive_numbers(calculator, grades_factory):
    # Arrange
    grades = grades_factory(85, 90, 95)

    # Act
    result = calculator.calculate_average(grades)

    # Assert
    assert result == 90.0


def test_calculate_average_empty_list_returns_zero(calculator):
    assert calculator.calculate_average([]) == 0.0


def test_calculate_average_single_element(calculator):
    assert calculator.calculate_average([85]) == 85.0


def test_calculate_average_with_negative_numbers(calculator, grades_factory):
    grades = grades_factory(-10, 0, 10)
    assert calculator.calculate_average(grades) == 0.0


def test_calculate_average_mixed_types_raises_type_error(calculator):
    with pytest.raises(TypeError):
        calculator.calculate_average([85, "90", 95])


# ==================== Тесты для calculate_median ====================

def test_calculate_median_odd_count(calculator, grades_factory):
    grades = grades_factory(70, 80, 90, 85, 75)
    assert calculator.calculate_median(grades) == 80.0


def test_calculate_median_even_count(calculator, grades_factory):
    grades = grades_factory(70, 80, 90, 100)
    assert calculator.calculate_median(grades) == 85.0


def test_calculate_median_empty_list_returns_zero(calculator):
    assert calculator.calculate_median([]) == 0.0


def test_calculate_median_single_element(calculator):
    assert calculator.calculate_median([85]) == 85.0


# ==================== Тесты для calculate_weighted_grade ====================

def test_calculate_weighted_grade_equal_weights(calculator, student_data_factory):
    # Arrange
    student = student_data_factory("Тест", [90, 85, 95])
    # веса равны 1/3

    # Act
    result = calculator.calculate_weighted_grade(student['scores'], student['weights'])

    # Assert
    assert result == 90.0


def test_calculate_weighted_grade_different_weights(calculator):
    scores = [90, 85, 95]
    weights = [0.5, 0.3, 0.2]
    assert calculator.calculate_weighted_grade(scores, weights) == 89.5


def test_calculate_weighted_grade_weights_sum_not_one_raises_error(calculator):
    scores = [90, 85, 95]
    weights = [0.5, 0.3, 0.1]  # сумма 0.9
    with pytest.raises(ValueError) as exc_info:
        calculator.calculate_weighted_grade(scores, weights)
    assert "сумма весов" in str(exc_info.value).lower()


def test_calculate_weighted_grade_lists_length_mismatch_raises_error(calculator):
    scores = [90, 85]
    weights = [0.5, 0.3, 0.2]
    with pytest.raises(ValueError):
        calculator.calculate_weighted_grade(scores, weights)


# ==================== Тесты для get_grade_description ====================

def test_get_grade_description_A_returns_otlichno(calculator):
    assert calculator.get_grade_description("A") == "Отлично"


def test_get_grade_description_B_returns_horosho(calculator):
    assert calculator.get_grade_description("B") == "Хорошо"


def test_get_grade_description_F_returns_ne_sdano(calculator):
    assert calculator.get_grade_description("F") == "Не сдано"


def test_get_grade_description_invalid_grade_raises_error(calculator):
    with pytest.raises(ValueError) as exc_info:
        calculator.get_grade_description("Z")
    assert "неизвестная" in str(exc_info.value).lower()