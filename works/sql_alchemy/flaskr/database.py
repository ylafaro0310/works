from flask_sqlalchemy import SQLAlchemy
from flask_marshmallow import Marshmallow
from flask_migrate import Migrate

db = SQLAlchemy()
ma = Marshmallow()
def init_db(app):
    db.init_app(app)
    Marshmallow(app)
    Migrate(app, db)
