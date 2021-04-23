from flask import Flask, make_response, jsonify, request
from flaskr.database import init_db
from flaskr.route import api

def create_app():
    app = Flask(__name__)
    app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+pymysql://default:default@mysql/sql_alchemy?charset=utf8'
    app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
    app.config['SQLALCHEMY_ECHO'] = False
    init_db(app)
    
    app.register_blueprint(api)

    return app

app = create_app()

@app.route('/')
def hello():
    return 'Hello world!'

if __name__ == '__main__':
    app.run("0.0.0.0", debug=True)