from flask import Flask, make_response, jsonify, request
from flaskr.database import init_db, db
from flaskr.models import *

def create_app():
    app = Flask(__name__)
    app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+pymysql://default:default@mysql/sql_alchemy?charset=utf8'
    app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
    app.config['SQLALCHEMY_ECHO'] = False
    init_db(app)
    
    return app

app = create_app()

@app.route('/')
def hello():
    return 'Hello world!'

@app.route('/users', methods=['GET'])
def index():
    user_schema = UserSchema(many=True)
    return make_response(jsonify({
        'code': 200,
        'users': user_schema.dump(User.query.all())
  }))

@app.route('/users', methods=['POST'])
def create():
    name = "test"#request.form['name']
    user = User(name=name)
    db.session.add(user)
    db.session.commit()
    return make_response(jsonify({
        'code': 200
    }))


if __name__ == '__main__':
    app.run("0.0.0.0", debug=True)