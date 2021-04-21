from flask import Flask
from database import init_db
import models

def create_app():
    app = Flask(__name__)
    app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+pymysql://default:default@mysql/sql_alchemy?charset=utf8'
    app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
    app.config['SQLALCHEMY_ECHO'] = False
    init_db(app)

    return app

app = create_app()

if __name__ == '__main__':
    app.run()