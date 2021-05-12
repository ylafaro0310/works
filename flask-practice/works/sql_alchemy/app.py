from flask import Flask, make_response, jsonify, request
from dotenv import load_dotenv
from flask_jwt import JWT, jwt_required, current_identity
from werkzeug.security import generate_password_hash, check_password_hash
import os
from flaskr.database import init_db
from flaskr.route import api
from flaskr.models import *

load_dotenv(override=True)

def authenticate(username,password):
    user = User.query.filter_by(name=username).first()
    user_schema = UserSchema()

    if check_password_hash(user.password, password):
        return user
    return None

def identity(payload):
    username = payload['identity']
    user = User.query.filter_by(name=username).first()
    user_schema = UserSchema()
    return user_schema.dump(user)

def create_app():
    app = Flask(__name__)
    app.config['SQLALCHEMY_DATABASE_URI'] = os.getenv('SQLALCHEMY_DATABASE_URI')
    app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
    app.config['SQLALCHEMY_ECHO'] = False
    app.config['SECRET_KEY'] = 'super-secret'
    init_db(app)
    
    jwt = JWT(app, authenticate, identity)

    app.register_blueprint(api)

    @app.route('/',methods=['GET'])
    def index():
        return 'Hello world!'

    return app

app = create_app()


if __name__ == '__main__':
    app.run("0.0.0.0", debug=True)