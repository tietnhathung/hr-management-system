from flask import Flask
from logging.config import dictConfig
from flask_sqlalchemy import SQLAlchemy
import redis
from app import config

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = config['DATABASE']['Mysql']
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = True

db = SQLAlchemy(app)

dbr = redis.Redis(host=config['DATABASE']['RedisHost'], port=config['DATABASE']['RedisPost'], db=0, charset="utf-8", decode_responses=True)

dictConfig({
    'version': 1,
    'formatters': {'default': {
        'format': '[%(asctime)s] %(levelname)s in %(module)s: %(message)s',
    }},
    'handlers': {'wsgi': {
        'class': 'logging.StreamHandler',
        'stream': 'ext://flask.logging.wsgi_errors_stream',
        'formatter': 'default'
    }},
    'root': {
        'level': 'INFO',
        'handlers': ['wsgi']
    }
})