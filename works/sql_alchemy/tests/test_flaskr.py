import os
import tempfile

import pytest

from app import create_app
from flaskr.database import db

@pytest.fixture
def client():
    app = create_app()

    with app.test_client() as client:
        yield client
    with app.app_context():
        db.session.rollback()

def test_empty_db(client):
    rv = client.get('/')
    assert b'Hello world' in rv.data

def test_index(client):
    rv = client.get('/users')
    assert b'200' in rv.data

def test_create(client):
    rv = client.post('/users', json={
    })
    assert b'name is required' in rv.data

    rv = client.post('/users', json={
        'name': 'pytest'
    })
    assert b'200' in rv.data

    rv = client.get('/users')
    assert b'pytest' in rv.data