from django.urls import path
from . import views

urlpatterns = [
    path('bad/', views.post_list_bad, name='post_list_bad'),
    path('good/', views.post_list_good, name='post_list_good'),
]