from flask import Flask, make_response, jsonify, request
from dotenv import load_dotenv
import os
from flaskr.database import init_db
from flaskr.route import api

load_dotenv(override=True)

def create_app():
    app = Flask(__name__)
    app.config['SQLALCHEMY_DATABASE_URI'] = os.getenv('SQLALCHEMY_DATABASE_URI')
    app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
    app.config['SQLALCHEMY_ECHO'] = False
    init_db(app)
    
    app.register_blueprint(api)

    @app.route('/',methods=['GET'])
    def index():
        return 'Hello world!'

    return app

app = create_app()


if __name__ == '__main__':
    app.run("0.0.0.0", debug=True)