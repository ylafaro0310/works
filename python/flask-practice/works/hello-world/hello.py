from flask import Flask, render_template
from markupsafe import escape
app = Flask(__name__)

@app.route('/')
def index():
    return 'Index Page'

@app.route('/hello')
def hello():
    return 'Hello, World!'

@app.route('/user/')
@app.route('/user/<username>')
def user(username=None):
    return render_template('user.html', name=username)

@app.route('/post/<int:id>')
def post(id):
    return 'Post ID %d' % id