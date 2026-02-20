from .models import Profile

def profile_context(request):
    profile = Profile.objects.first()
    tech_list = []
    if profile and profile.tech_stack:
        tech_list = [tech.strip() for tech in profile.tech_stack.split(',')]
    return {
        'profile': profile,
        'tech_list': tech_list
    }
