"""
Модуль для расчёта оценок студентов.
"""

from typing import List, Union


class GradeCalculator:
    """
    Калькулятор для работы с оценками.
    Поддерживает:
    - перевод баллов в буквенную оценку (A, B, C, D, F)
    - среднее арифметическое
    - медиану
    - взвешенную оценку
    - описание оценки
    """

    # Таблица соответствия баллов и оценок
    GRADE_TABLE = [
        (90, "A", "Отлично"),
        (80, "B", "Хорошо"),
        (70, "C", "Удовлетворительно"),
        (60, "D", "Неудовлетворительно"),
        (0,  "F", "Не сдано"),
    ]

    def calculate_grade(self, score: Union[int, float]) -> str:
        """
        Переводит числовой балл (0–100) в буквенную оценку.

        Args:
            score: количество баллов

        Returns:
            буквенная оценка (A, B, C, D, F)

        Raises:
            TypeError: если score не число
            ValueError: если score вне диапазона 0–100
        """
        if not isinstance(score, (int, float)):
            raise TypeError("Баллы должны быть числом")
        if score < 0 or score > 100:
            raise ValueError("Баллы должны быть в диапазоне от 0 до 100")

        for threshold, grade, _ in self.GRADE_TABLE:
            if score >= threshold:
                return grade
        return "F"

    def calculate_average(self, grades: List[Union[int, float]]) -> float:
        """
        Вычисляет среднее арифметическое списка оценок.

        Args:
            grades: список числовых оценок

        Returns:
            среднее значение (0, если список пуст)

        Raises:
            TypeError: если элемент не число
        """
        if not grades:
            return 0.0

        if not all(isinstance(g, (int, float)) for g in grades):
            raise TypeError("Все оценки должны быть числами")

        return sum(grades) / len(grades)

    def calculate_median(self, grades: List[Union[int, float]]) -> float:
        """
        Вычисляет медиану списка оценок.

        Args:
            grades: список числовых оценок

        Returns:
            медианное значение (0, если список пуст)
        """
        if not grades:
            return 0.0

        sorted_grades = sorted(grades)
        n = len(sorted_grades)
        mid = n // 2
        if n % 2 == 0:
            return (sorted_grades[mid - 1] + sorted_grades[mid]) / 2
        else:
            return float(sorted_grades[mid])

    def calculate_weighted_grade(self, scores: List[Union[int, float]], weights: List[float]) -> float:
        """
        Вычисляет взвешенную оценку.

        Args:
            scores: список баллов
            weights: список весов (сумма должна быть равна 1)

        Returns:
            взвешенная оценка, округлённая до двух знаков

        Raises:
            ValueError: если длины списков не совпадают или сумма весов не равна 1
        """
        if len(scores) != len(weights):
            raise ValueError("Количество баллов и весов должно совпадать")

        total_weight = sum(weights)
        if abs(total_weight - 1.0) > 1e-6:
            raise ValueError(f"Сумма весов должна быть равна 1, получено {total_weight}")

        weighted_sum = sum(s * w for s, w in zip(scores, weights))
        return round(weighted_sum, 2)

    def get_grade_description(self, grade: str) -> str:
        """
        Возвращает текстовое описание буквенной оценки.

        Args:
            grade: буквенная оценка (A, B, C, D, F)

        Returns:
            описание (например, "Отлично")

        Raises:
            ValueError: если оценка неизвестна
        """
        for _, g, desc in self.GRADE_TABLE:
            if g == grade:
                return desc
        raise ValueError(f"Неизвестная оценка: {grade}")