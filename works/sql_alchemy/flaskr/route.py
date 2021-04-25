from flask import Flask, Blueprint, make_response, jsonify, request, current_app
from flaskr.database import db
from flaskr.models import *
from flaskr.validate import validate
from flask_jwt import jwt_required
from werkzeug.security import generate_password_hash, check_password_hash

api = Blueprint('api', __name__)

@api.route('/users', methods=['GET'])
def index():
    user_schema = UserSchema(many=True)
    return make_response(jsonify({
        'code': 200,
        'users': user_schema.dump(User.query.all())
  }))

@api.route('/users', methods=['POST'])
def create():
    valid, message = validate(request)
    if valid == False:
        return make_response(jsonify({
            'code': 400,
            'message': message
        }))
    name = request.json['name']
    password = generate_password_hash(request.json['password'])
    user = User(name=name,password=password)
    db.session.add(user)
    db.session.commit()
    return make_response(jsonify({
        'code': 200
    }))

@api.route('/users/<int:user_id>', methods=['GET'])
@jwt_required()
def show(user_id):
    user_schema = UserSchema()
    user = User.query.filter_by(id=user_id).first()
    return make_response(jsonify({
        'code': 200,
        'user': user_schema.dump(user)
  }))

@api.route('/users/<int:user_id>', methods=['PUT'])
def update(user_id):
    if not request.is_json:
        return make_response(jsonify({
            'code': 400,
            'message': 'Request data should be json.'
        }))
    user = User.query.filter_by(id=user_id).first()
    name = request.json['name']
    user.name = name
    db.session.add(user)
    db.session.commit()
    return make_response(jsonify({
        'code': 200
    }))

@api.route('/users/<int:user_id>', methods=['DELETE'])
def delete(user_id):
    user = User.query.filter_by(id=user_id).first()
    db.session.delete(user)
    db.session.commit()
    return make_response(jsonify({
        'code': 200
    }))
