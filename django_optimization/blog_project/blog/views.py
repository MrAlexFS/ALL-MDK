from django.shortcuts import render
from .models import Post

def post_list_bad(request):
    posts = Post.objects.all()  # 1 запрос
    return render(request, 'blog/post_list_bad.html', {'posts': posts})

def post_list_good(request):
    # select_related для ForeignKey, prefetch_related для ManyToMany
    posts = Post.objects.select_related('author', 'category').prefetch_related('tags')
    return render(request, 'blog/post_list_good.html', {'posts': posts})