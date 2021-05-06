from flask import Flask
from flask_sqlalchemy import SQLAlchemy
import redis
from app import config

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = config['DATABASE']['Mysql']
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = True

db = SQLAlchemy(app)

dbr = redis.Redis(host=config['DATABASE']['RedisHost'], port=config['DATABASE']['RedisPost'], db=0, charset="utf-8", decode_responses=True)
