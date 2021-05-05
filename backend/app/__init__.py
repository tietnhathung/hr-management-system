import redis
from configparser import ConfigParser
import threading
from flask import Flask
from flask_sqlalchemy import SQLAlchemy

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+pymysql://root:@localhost/hr-management-system'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = True
db = SQLAlchemy(app)

config = ConfigParser(interpolation=None)
config.read('config.ini')

dbr = redis.Redis(host='localhost', port=6379, db=0, charset="utf-8", decode_responses=True)

def schedule_jods(schedule_jod):
    cease_continuous_run = threading.Event()
    class ScheduleThread(threading.Thread):
        @classmethod
        def run(cls):
            while not cease_continuous_run.is_set():
                schedule_jod.run_pending()
    continuous_thread = ScheduleThread()
    continuous_thread.start()
    return cease_continuous_run