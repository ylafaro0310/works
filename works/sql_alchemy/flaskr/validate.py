from flaskr.models.User import User

def validate(request):
    if not request.is_json:
        return False, 'Request data should be json.'
    
    for key in User.columns:
        if not key in request.json:
            return False, 'name is required'

    return True, ''