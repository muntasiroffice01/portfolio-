from django.shortcuts import render, get_object_or_404
from .models import Project, Blog, Experience, Message

def home(request):
    return render(request, 'core/index.html')

def about(request):
    experiences = Experience.objects.all().order_by('-created_at')
    return render(request, 'core/about.html', {'experiences': experiences})

def projects(request):
    projects = Project.objects.all().order_by('-created_at')
    return render(request, 'core/projects.html', {'projects': projects})

def blog(request):
    blogs = Blog.objects.all().order_by('-created_at')
    return render(request, 'core/blog.html', {'blogs': blogs})

def blog_detail(request, slug):
    blog = get_object_or_404(Blog, slug=slug)
    return render(request, 'core/blog_detail.html', {'blog': blog})

def contact(request):
    success = False
    if request.method == 'POST':
        name = request.POST.get('name')
        email = request.POST.get('email')
        message = request.POST.get('message')
        if name and email and message:
            Message.objects.create(name=name, email=email, message=message)
            success = True
    return render(request, 'core/contact.html', {'success': success})
